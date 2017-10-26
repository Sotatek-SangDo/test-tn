<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consts;
use App\Subject;
use App\Exam;
use App\ExamResult;
use App\User;
use Auth;
use Log;
use Carbon\Carbon;
use App\ResultTest;
use App\ExamPhoto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->now = Carbon::now();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test(Request $request)
    {
        return view('layouts.test', ['subject' => $request['mon']]);
    }
    public function getSubjectID($action)
    {
        switch ($action) {
            case Consts::MATH:
                $name = 'Toán';
                break;
            case Consts::MATH_1:
                $name = 'Toán1';
                break;
            case Consts::LY:
                $name = 'Lý';
                break;
            case Consts::HOA:
                $name = 'Hóa';
                break;
            default:
                $name = 'Anh';
                break;
        }
        return $this->getSubjectByName($name);
    }
    public function getSubjectByName($name)
    {
        $subject = Subject::where('name', $name)->first();
        return $subject->id;
    }

    public function getExam($subject)
    {
        $subjectId = $this->getSubjectID($subject);
        $examId = $this->getLastestExam($subjectId);
        $class = Auth::user()->class;
        $exams = Exam::selectRaw('exams.exam_id, subjects.id as id, subjects.name, subjects.time_test, exams.class, exams.num_sentence')
                    ->join('subjects', 'subjects.id', '=', 'exams.subject_id')
                    ->where('exams.class', $class)
                    ->where('exam_id', $examId)
                    ->get();
        $photos = ExamPhoto::select('photo')
                        ->where('exam_id', $examId)
                        ->get();
        return [
            'exam' => $exams,
            'photo' => $photos
        ];
    }

    public function getLastestExam($subjectId)
    {
        $exam = Exam::select('exam_id')
                    ->where('subject_id', $subjectId)
                    ->where('class', Auth::user()->class)
                    ->groupBy('subject_id')
                    ->groupBy('exam_id')
                    ->first();
        return $exam['exam_id'];
    }

    public function updateLayout()
    {
        $user = User::find(Auth::user()->id);
        return view('layouts.update_user', ['user' => $user]);
    }

    public function getMark(Request $request)
    {
        if(isset($request['_action']) && $request['_action'] == 'get-mark') {
            $class = $request['class'];
            $examId = $request['exam_id'];
            $anwsers = $request['ans'];
            $subjectId = $request['subject'];
            $results = $this->getResult($anwsers, $subjectId, $examId, $class);
            $mark = $results['mark'];
            $error = $results['error'];
            return view('layouts.show_result', ['mark' => $mark, 'error' => $error]);
        }
        return back();
    }

    public function getResult($data, $subjectId, $examId, $class)
    {
        $mark = 0;
        $error = [];
        $results = $this->getExamResult($subjectId, $examId, $class);
        $num = $results['numResult'];
        $examResult = $results['examResult'];
        $oneMarkOfSentence = 10 / $num;
        for($i = 0 ; $i < count($data); $i++) {
            if($examResult[$i]['ans'] == $data[$i+1]) {
                $mark += $oneMarkOfSentence;
            }else {
                array_push($error, $i+1);
            }
        }
        $this->setMark($mark, $subjectId, $examId);
        return [
            'error' => $error,
            'mark' => $mark
        ];
    }
    public function setMark($mark, $subjectId, $examId)
    {
        $result = new ResultTest();
        $result->subject_id = $subjectId;
        $result->user_id = Auth()->user()->id;
        $result->date = $this->now;
        $result->mark = $mark;
        $result->exam_id = $examId;
        $result->save();
        return true;
    }

    public function getExamResult($subjectId, $examId, $class)
    {
        $result = ExamResult::selectRaw('ans')
                            ->where('subject_id', $subjectId)
                            ->where('exam_id', $examId)
                            ->where('class', $class)
                            ->get();
        return [
            'examResult' => $result,
            'numResult' => $result->count()
        ];
    }

    public function updateUser(Request $request)
    {
        $user = User::find(Auth()->user()->id);
        $user->name = $request['name'];
        $user->class = $request['class'];
        $user->save();
        return redirect()->route('home');
    }

    public function showInfo()
    {
        $user = User::find(Auth::user()->id);
        $results = ResultTest::selectRaw('date, subjects.name, mark, result_tests.exam_id')
                            ->join('subjects', 'subjects.id', '=', 'result_tests.subject_id')
                            ->where('result_tests.user_id', $user['id'])
                            ->get();
        return view('layouts.show_info', ['user' => $user, 'results' => $results ]);
    }
}
