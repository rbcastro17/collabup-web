<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

//use Illuminate\Support\Facade\Mail;

use App\User;

use App\Post;

use App\Member;

use App\Announcement;

use App\PasswordReset;

use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Hash;

use App\Mail\Confirmation;

use App\Mail\SendForgetPassword;

use Illuminate\Support\Facades\Mail;

use App\AppNotification;

use App\GroupRequest;

use App\Event;

use App\Files;


class UserController extends Controller
{
    /*
    |
    |
    |   Anything that involves editing the user should belong here.
    |
    |
    |
    */

    public function account_upgrade()
    {
        //Temporary code, will change when implemented Laravel Cart
        $user = User::find(Auth::user()->id);

        $user->role = 2; //2 = Head User, 3 = Admin
        $user->save();

//		Member::where('email',$user->email)->delete(); 

        return redirect()->back();
    }


	public function sendForget(Request $request){
	//Mail::to($request->email)->send(new );
	}

	
	public function forgetpage(){
	//dd($_SESSION);
		return view('auth.forget');
	}

	public function forget_password($code){

	}

	public function upload_picture(Request $request, $id)
	{

	$this->validate($request, ['image' => 'required|image',]);
		$image = $request->file('image');
		$image->move('images/',$image->getClientOriginalName());
		$filename = 'images/'.$image->getClientOriginalName();

		Image::make($filename)->resize(500,500)->save();

		$user = User::find($id);
		$user->image = $image->getClientOriginalName();
		$user->save();

	return redirect()->back()->withInfo('File uploaded');

	}

	public function update_profile(Request $request)
	{
		$this->validate($request,[
				'first_name' => 'min:3',
				'middle_name' => 'min:2',
				'last_name' => 'min:2',
				'username' => 'min:2',
				
			]);

		$this->validate($request, ['image' => 'required|image',]);
		$image = $request->file('image');
		$image->move('images/',$image->getClientOriginalName());
		$filename = 'images/'.$image->getClientOriginalName();
		Image::make($filename)->resize(500,500)->save();
		
		User::find(Auth::user()->id)->update(['image'=> $image->getClientOriginalName(),'first_name' => $request->first_name, 'middle_name' => $request->middle_name, 'last_name' => $request->last_name, 'username' => $request->username]);
	
		 if(Auth::check()) {
              if(Auth::user()->role == 3){
				return redirect()->route('dashboard')->withInfo('Profile Updated');
			  }
		 else {
			return redirect()->route('dashboard')->withInfo('Profile Updated');			
		 }
		 }
		 
	}

	public function edit_profile(){
		$user = User::find(Auth::user()->id);
		return view('account.edit',['user' => $user]);
	}

	 public function resetpage() {
        $user = User::find(Auth::user()->id);
        return view('resetpage', ['user' => $user]);
    }

	public function resetinpassword(){
		$id = Auth::user()->id;

		$this->validate($request, ["old_password" => "required|min:6",
			"new_password" => "required|min:6",
			"confirm_password"=> "required|min:6"]		
		);
		if(password_verify($request->old_password, Auth::user()->password)){
			User::where()->update(["password" => bcrypt($request->new_password)]);
		return redirect('dashboard');
		}
	}


	public function resetoutpasswordpage($token){
		$data['token'] = $token; 
return view('auth.resetout',$data);
	}
	public function resetoutpassword(Request $request){
		$token = $request->token;
		$reset = PasswordReset::where('token', $token)->first();
		$email = $reset->email;
		$user = User::where('email', $email)->first();

		$this->validate($request, ["password" => "required|min:6" , "password_confirmation" => "required|min:6"]);	
		if($request->password == $request->password_confirmation){
			User::where('email', $email)->update(['password' => bcrypt($request->password)]);	
			PasswordReset::where("token", $token)->delete();
			return redirect("/");
		}else{
			echo "fail";
		}
	}

    public function resetpassword(Request $request, $id) {
	    $this->validate($request, ['oldpassword' => 'required', 'password' => 'required|min:6', 'password_confirmation' => 'required|min:6']);
        if (!Hash::check($request->oldpassword,  Auth::user()->password)) {
            return redirect()->back()->withInfo('Wrong password');
        } else {
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back();
        }
		}
	public function activateuser($code){
		$user = User::where('code', '=', $code)->update(['active' => 1, 'code' => str_random(7)]);
		return redirect('/');	
	}


    protected function validator(array $data) {
        return Validator::make($data, [
                    'password' => 'required|min:6|confirmed',
                    'newpassword' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6|confirmed',
        ]);
    }
    public function notifications()
   {
       Auth::user()->unreadNotifications->markAsRead();
       return view('group.nots')->with('nots', Auth::user()->notifications);
   }


   public function requestJoinGroup($group_id){
	GroupRequest::create([
		'user_id' => Auth::user()->id,
		'group_id' => $group_id
	]);

	return redirect()->back();
   }


   public function showannouncements(){
	   $data['anns'] = Announcement::orderBy('updated_at', 'desc')->paginate(5);
	   return view('user.show-announcement', $data);
   }

   public function showprofile(){
	$data['posts'] = Post::where('user_id', Auth::user()->id)->latest()->paginate(15);
	return view('user.view-profile',$data);
   }

   public function notificationpage(){

		$data['notifications'] = AppNotification::where([['unread','=' , true], ['reciever_id' ,'=', Auth::user()->id]])->get();
		return view('notification.index',$data);
   }

   public function readpostnotification(Request $request){

	AppNotification::where('ref', '=', $request->ref)->update(['unread' => false]);
	$notif = AppNotification::where('ref','=', $request->ref)->first();
	$data['group_id'] = $notif->group_id;
	$data['post'] = Post::where('ref', '=', $notif->ref)->first();	
	//dd($data['post']);
	return view('notification.post', $data);
	}   

	public function readeventnotification(Request $request){
		
			AppNotification::where('ref', '=', $request->ref)->update(['unread' => false]);
			$notif = AppNotification::where('ref','=', $request->ref)->first();
			$data['group_id'] = $notif->group_id;
			$data['event'] = Event::where('ref', '=', $notif->ref)->first();	
			
			return view('notification.event', $data);
			}   

			public function readannouncementnotification(Request $request){
				
					AppNotification::where('ref', '=', $request->ref)->update(['unread' => false]);
					$notif = AppNotification::where('ref','=', $request->ref)->first();

					$data['event'] = Announcement::where('ref', '=', $notif->ref)->first();	
					
					return view('notification.announcement', $data);
					}   
					public function readfilenotification(Request $request){
						AppNotification::where('ref', '=', $request->ref)->update(['unread' => false]);
						$notif = AppNotification::where('ref','=', $request->ref)->first();
						$data['file'] = Files::where('ref', '=', $request->ref)->first();
						return view('notification.file', $data);
					}
		}
