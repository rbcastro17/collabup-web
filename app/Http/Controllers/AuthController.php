<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Member;

use App\User;

use App\PasswordReset;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Session;

//use Mail;

use App\Mail\Confirmation;

//use App\PasswordReset;

use Laravolt\Avatar\Facade as Avatar;

use App\Mail\SendForgetPassword;
//use App\Mail\ForgetPassword;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    

    public function register(Request $request)
    {

        set_time_limit(0);
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
           'g-recaptcha-response' => 'required|captcha',
        ]);

        $code = str_random(6);
        $file_name = $request->username.".png";
        $name= $request->first_name." ".$request->last_name;
    
    
    dd($image_url);
        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 1,
            'code' => $code,
            'active' => false,
			'image' => 'avatar.png',
        ]);
    $name = $request->first_name. ' '. $request->last_name;
    $email  =$request->email;      
Mail::to($email)->send(new Confirmation($name,$code,$email));
        return redirect()->back();
    }

    public function login(Request $request)
    {
       $this->validate($request,['email' => 'required|email', 'password' => 'required']);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        if(Auth::user()->active == 0){
            return redirect()->back()->withInfo('Not yet verified');
        }

         if(Auth::user()->role == 3){
            return redirect()->route('admin.index');
         } 
		 else{	
			 return redirect()->route('dashboard');
         }	
		}	
		else{
            return redirect()->back()->withInfo('Credentials does not match our records.');
        }
    }

       public function sendcode(Request $request){

       $email = $request->email;
       $user  = User::where('email', $email)->count();
       if($user == 1){
       $code = str_random(5);
       $token = str_random(64);
        PasswordReset::create([
            "email" => $email,
            "code" => $code,
            "token" => $token,
    ]);
        Mail::to($email)->send(new SendForgetPassword($email, $code,$token));
                return redirect()->back();
       }else{
            return redirect("/");
       }

    }
    public function logout()
    {
        Auth::logout();
        Cache::flush();
        Session::flush();
        return redirect("/");
        // return redirect(property_exists($this, '/') ? $this->redirectAfterLogout : '/');
    }
}
