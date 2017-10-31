<?php
namespace App\Http\Controllers\Manage;
use App\User;
use Validator;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'manage';
    protected $guard = 'admin';
    protected $afterLogout = '/manage/login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('manage.index');
    }

    public function login(Request $request){
        $this->validateLogin($request);
        $credentials = Input::only('username', 'password');
        if (!Auth::attempt($credentials))
        {
            return Redirect::back()->with('msg', 'Invalid credentials');
        }
        if (Auth::user()->isAdmin())
        {
            return Redirect::to($this->redirectTo);
        }
        $this->logout($request);
        return Redirect::back()->with('msg', 'User is not admin!');
    }
    public function showLoginForm()
    {
        if(!Auth::check()){
            return view('manage.login');
        }
        return redirect($this->redirectTo);
    }
    protected function guard()
    {
        return Auth::guard($this->guard);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($this->afterLogout);
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
    }
}
