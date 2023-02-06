<?php

namespace App\Http\Controllers\Auth\Admin;
/**
 * Admin Login Controller
 *
 * @author  Prajwal Rai <prajwal.iar@gmail.com>
 *
 */
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;

    use ThrottlesLogins;

    /**
     * Max login attempts allowed.
     */
    protected $maxAttempts = 3;

    /**
     * Number of minutes to lock the login.
     */
    protected $decayMinutes = 2;



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function showLoginForm()
    {
        return view('auth.admin.login');
    }


    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);
        //check if the user has too many login attempts.
        if($this->hasTooManyLoginAttempts($request)){

            //fire the lock-event
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout
            return $this->sendLockoutResponse($request);
        }

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'active'],$request->remember)){
            // if successful, the redirect to intend location
            Setting::increment('visitors',1);
            $notify[]=['success','Successfully login as admin'];
            return redirect()->intended(route('dashboard'))->withNotify($notify);
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);
        $notify[]=['error',trans('auth.failed')];

        //if unsuccessfull then redirect back to login form
        return back()
            ->withInput($request->only('email','remember'))
            ->withNotify($notify);;
    }

    public function logout(Request $request)
    {
        $admin=$this->guard()->user();
        if(!empty($admin)){
            $this->guard()->logout();
        }
        return redirect()->route('admin.login')->with('success','Successfully logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function credentials(Request $request)
    {
        return ['email'=>$request->input('email'),'password'=>$request->input('password'),'status'=>'active'];
    }

    // Username used in ThrottlesLogins trait
    public function username(){
        return 'email';
    }
}
