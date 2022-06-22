<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

   // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm(){
            return view( 'auth.login' );
    }





    public function login(Request $request)
    {

        $this->validate($request,[
            'email'=> 'required|email',
            'password'=> 'required|min:3'
        ]);


        $email = $request->email;
        $password= $request->password;
        //$remember= $request->remember;


        //$credentials = $request->only('email', 'password');
       // if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user_type = Auth::user()->user_type;
                        if($user_type==0){//Admin
                            return redirect()->route('super-admin.home');
                        } elseif($user_type==1){
                            return redirect()->route('admin.home');
                        } elseif($user_type==2){//Patient
                            return redirect()->route('home');
                        }


        } else{
            return back()->with('error','Invalid login credential, Please try again');
        }


    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
