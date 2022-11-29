<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

//        $this->validate($request,[
//            'email'=> 'required|email',
//            'password'=> 'required|min:3'
//        ]);



        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   // required and email format validation
            'password' => 'required|min:3', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {
            return back()->withInput()->withErrors($validator);
            // validation failed redirect back to form
        } else {


            $email = $request->email;
            $password = $request->password;
            //$remember= $request->remember;


            //$credentials = $request->only('email', 'password');
            // if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user_type = Auth::user()->user_type;
                if ($user_type == 0) {//Admin
                    return redirect()->route('super-admin.home');
                } elseif ($user_type == 1) {
                    return redirect()->route('admin.home');
                } elseif ($user_type == 2) {//Patient
                    return redirect()->route('home');
                }


            } else {
//              return back()->withErrors([
//                     'email' => 'The provided credentials do not match our records.',
//          ]);

                return back()->with('error', 'Invalid login credential, Please try again');
            }
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
