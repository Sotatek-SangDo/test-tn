<?php

namespace App\Http\Controllers;

use Log;
use Excel;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Concerns\hasFile;
use App\Exam;
use Illuminate\Support\Facades\Session;
use App\Consts;
use App\Subject;
use App\User;
use DB;
use App\ExamResult;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\ResultTest;
use Auth;
use App\Http\Services\UploadService;
use App\ExamPhoto;
use Carbon\Carbon;
use App\News;

class AdminController extends Controller
{
    public function __construct(UploadService $upload)
    {
        $this->uploadService = $upload;
    }

    public function layoutUploadExam()
    {
        return view('manage.upload_exam');
    }

    public function import(Request $request)
    {
        if($request->hasFile('import'))
        {
            $action = $request['action'];
            $examId = $this->getExamID($action);
            $subjectId = $this->getSubjectID($action);
            $exam = new Exam();
            $exam->subject_id = $subjectId;
            $exam->exam_id = $examId;
            $exam->class = $request['class'];
            $exam->start_time = $request['start_time'];
            $exam->end_time = $request['end_time'];
            $exam->num_sentence = $request['num'];
            $exam->save();
            $this->addExamPhoto($examId, $request['import']);
            Session::put('success', 'Upload exam success');
            return redirect()->route('list-exam');
        } else {
            return back();
        }

    }

    public function addExamPhoto($examId, $arrPhoto)
    {
        foreach ($arrPhoto as $photo) {
            $examPhoto = new ExamPhoto();
            $examPhoto->exam_id = $examId;
            $examPhoto->photo = $this->uploadService->uploadImg($photo);
            $examPhoto->save();
        }
        return true;
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

    public function getExamID($action)
    {
        switch ($action) {
            case Consts::MATH:
                $prifix = 'T';
                break;
            case Consts::MATH_1:
                $prifix = 'M';
                break;
            case Consts::LY:
                $prifix = 'L';
                break;
            case Consts::HOA:
                $prifix = 'H';
                break;
            default:
                $prifix = 'A';
                break;
        }
        return $prifix . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9);
    }

    public function ShowExam()
    {
        $exams = Exam::selectRaw('exams.exam_id, exams.id, subjects.name, subjects.time_test, exams.class as class, exams.is_show')
                        ->join('subjects', 'subjects.id', '=', 'exams.subject_id')
                        ->paginate(Consts::LIMIT);
        return view('manage.exam_list', ['exams' => $exams]);
    }
    public function getSubjectByName($name)
    {
        $subject = Subject::where('name', $name)->first();
        return $subject->id;
    }
    public function uploadResult(Request $request)
    {
        if($request->hasFile('import'))
        {
            $subjectId = $this->getSubjectByName($request['subject_name']);
            $examId = $request['exam_id'];
            $class = $request['class'];
            $path = $request->file('import')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                $data = $data->toArray();
                for($i=0;$i<count($data);$i++) {
                    unset($data[$i]['0']);
                    $data[$i]['subject_id'] = $subjectId;
                    $data[$i]['exam_id'] = $examId;
                    $data[$i]['class'] = $class;
                    $dataImported[] = $data[$i];
                }
            }
            ExamResult::insert($dataImported);
            Session::put('success', 'Upload result success');
        }
        return redirect()->route('list-exam');
    }

    public function ShowResult()
    {
        $results = ExamResult::selectRaw('exam_results.exam_id, subjects.name, subjects.time_test, exam_results.class')
                        ->join('subjects', 'subjects.id', '=', 'exam_results.subject_id')
                        ->groupBy('exam_results.exam_id')
                        ->groupBy('subjects.name')
                        ->groupBy('exam_results.class')
                        ->groupBy('subjects.time_test')
                        ->paginate(Consts::LIMIT);
        return view('manage.result_list', ['results' => $results]);
    }

    public function showUser()
    {
        $users = User::where('is_admin', '!=', User::TYPE_ADMIN)
                    ->paginate(Consts::LIMIT);
        return view('manage.list_user', ['users' => $users]);
    }
    public function showUploadImg()
    {
        return view('manage.upload_img');
    }

    public function uploadImg(Request $request)
    {
        $file = $request['file'];
        if (is_file($file)) {
            $res = [];
            $fileName = str_replace(".", "", microtime(true)) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, File::get($file));
            $res["path"] = Storage::disk('public')->url($fileName);
            return view('manage.upload_img_result', ['res' => $res]);
        }
        return back();
    }

    public function userInfo($email)
    {
        $user = User::selectRaw('id, name, email')
                    ->where('email', $email)
                    ->first();
        $results = ResultTest::selectRaw('date, subjects.name, mark, result_tests.exam_id')
                            ->join('subjects', 'subjects.id', '=', 'result_tests.subject_id')
                            ->where('result_tests.user_id', $user['id'])
                            ->get();
        return view('manage.show_info', ['user' => $user, 'results' => $results ]);
    }
    public function changeActive(Request $request)
    {
        $user = User::findOrFail($request['id']);

        if($request['is_active'] == Consts::ACTIVE) {
            $user->is_active = 1;
        }else {
            $user->is_active = 0;

        }
        $user->save();
        return back();
    }

    public function changeShow(Request $request)
    {
        if($request['is_show'] == Consts::ACTIVE) {
            $show = 1;
        }else {
            $show = 0;
        }
        ResultTest::where('exam_id', $request['id'])->update(['is_show' => $show]);
        Exam::where('exam_id', $request['id'])->update(['is_show' => $show]);
        return back();
    }

    public function news()
    {
        return view('manage.add_news');
    }

    public function store(Request $request)
    {
        $new = new News();
        $new->title = $request['title'];
        $new->content = $request['content'];
        $new->thumbnail = $this->uploadService->uploadImg($request['import']);
        $new->save();
        return redirect()->route('list-news');
    }

    public function showNews()
    {
        $news = News::all();
        return view('manage.list_news', ['news' => $news]);
    }

    public function destroy(Request $request, $id)
    {
        $new = News::findOrFail($id);
        $new->delete();
        return redirect()->route('list-news');
    }

    public function destroyExam(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('list-exam');
    }
}
