<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Group;

use App\Member;

use App\Notification;

use App\Files;

use App\Folder;

use App\Comment;

use App\Post;

use App\AuditTrail;

use App\Mail\MobileConfirmation;

use App\Mail\MobileSendForgetCode;

use App\PasswordReset;

use App\Announcement;

class MobileController extends Controller
{

	public function getaudit(){
		$audits = AuditTrail::all();
		$array = array();
		foreach($audits as $audit){
			array_push($array,[
				'user' => $audit->user->first_name. " ".$audit->user->last_name,
				'description' =>$audit->description,
				'created_at' =>$audit->created_at->diffForHumans()	
			]
			);
		}	
		return ['result' => $array];
	}

 
	public function register(Request $request){
	$user  = new User;
	
	if($request != null){
	$user->first_name = $request->first_name;
	$user->last_name = $request->last_name;
	$user->middle_name = $request->middle_name;
	$user->active = 0;
	$user->role = 1;
	$user->username = $request->username;
	$user->password =bcrypt($request->password);
	$user->email =  $request->email;
	$user->code = str_random(5);
	$user->save();
	Mail::to($request->email)->send(new MobileConfirmation($user->first_name,$user->code));
	echo "success";
	}
	else{
	echo "error";	
	}
	}

	
	public function sendforgetcode(Request $request){
		$email= $request->email;
	$code = str_random(6);	
	$token = str_random(64);

	PasswordReset::create(['email'=>$email, 'code' => $code, 'token'=>$token]);
	Mail::to($email)->send(new MobileSendForgetCode($email,$code));	
	echo "success";

	}
	
		public function changeinpassword(Request $request){
	$id = $request->id;		
	$password = $request->password;

	User::where('id','=',$id)->update(['password'=>bcrypt($password)]);
		echo "success";
	}


	public function changepassword(Request $request){
	$password = $request->newpassword;
	$code = $request->code;
	$user = PasswordReset::where(['code'=> $code])->first();

	User::where('email', $user->email)->update(['password'=>bcrypt($password)]);
		echo "success";

		PasswordReset::where('code', $code)->delete();
	}

	public function deletepost(){
		Post::where('id', $request->id)->delete();
		return "success";
	}

	public function updatepost(Request $request){
		Post::where('id',$request->id)->update(['id', $request->body]);
		return "success";
	}
	
	public function activateuser(Request $request){
	$code = $request->code;
	User::where('code', $code)->update(['active'=> '1']);
		echo "success";

	}
	
	public function getownactivities(Request $request){
		$id = $request->id;
		//echo $id; die();
		//$id = 1;
		
		$user = User::where('id','=',$id)->first();

		$posts = Post::where("user_id", $id)->get();

		
		$result = array();
		foreach($posts as $post){	
		$gid = $post->group_id;
	   // $group_data = Group::where('id','=',$gid)->first();
		//dd($group_data);
		array_push($result, array(
			'post_id' => $post->id,
			'user_id' => $id,
			'name' => $user->first_name.' '.$user->last_name,
		//	'group'=> $group_data->group_name, 
			'body' => $post->body,
			'time' => $post->updated_at->diffForHumans()	
		));
		}
		
		return ['result'=> $result];
	}

	public function getactivities(Request $request){
		$id = $request->group_id;
		//$id = 2;
	$posts=	Post::where('group_id',$id)->orderBy('created_at', 'desc')->get();
	$result = array();
	foreach($posts as $post){
		
		array_push($result, array(
			"post_id" => $post->id,
			"user_id" => $id,
			"name"	=> $post->user->first_name.' '.$post->user->last_name,
			"body" => $post->body,
			"image" => asset('image/',$post->user->image),
			"time" => $post->created_at->diffForHumans()
		));
	}

	return ["result" => $result];

	}

	public function getallgroups(Request $request){

		$id = $request->id;
		$role = $request->role;
		//$id = 1;
		//$role = "head";

		$result = array();
		if($role == "member"){
			$members = Member::where('user_id', $id)->get();
			
			foreach($members as $member){
				array_push($result,
				[
					"group_id" => $member->group_id,
					"group_name" => $member->group->group_name,
					"description" => $member->group->description
				]);

			}
			return ['result' => $result];
		}else if($role=="head"){
			$groups = Group::where('group_owner', $id)->get();
			//dd($groups);
			foreach($groups as $group){
				array_push($result,[
					"group_id" => $group->id,
					"group_name" => $group->group_name,
					"description" => $group->description,
				]);
			}
			return ["result"=>$result];
		}
		else{
			return "invalid";
		}

	}

	public function adminlogin(Request $request){
		$email = $request->email;
		$password = $request->password;
		$check = User::where(['email'=>$request->email, 'role' => 3])->first();
		$response = array();
		if(password_verify($request->password,$check->password)){
		array_push($response,array(
			"id" => $check->id,
			"email" => $email,
			"image" => $check->image,
			"name" => $check->first_name." ".$check->last_name
		));	
		return ['result' => $response];
		}else{
			echo "invalid";
		}
	}


	public function login(Request $request){
		$user = User::where('email', $request->email)->first();
		$response = array();		
		if(password_verify($request->password,$user->password)){
		$role = $user->role;
$member = Member::where('id', '=', $user->id)->first();				
	if($role == '1'){
			$result = array();
		array_push($result,array( 
		"id" => $user->id,
		"role" => 'member',
		"email" => $user->email,
		"username" => $user->username,
		"password"=> $request->password,
		"image" => $user->image,
		"active" => $user->active,
		"name" => $user->first_name. " ". $user->last_name, 
		"status" => "success"
		));
		echo json_encode(array('result'=> $result));
		} 	
		elseif($role == '2'){
			$result = array();
		array_push($result,array( 
		"id" => $user->id,
		"role" => 'head',
		"email" => $user->email,
		"username" => $user->username,
		"password"=> $request->password,
		"image" => $user->image,
		"active" => $user->active,
		"name" => $user->first_name. " ". $user->last_name, 
		"status" => "success"
		));
		echo json_encode(array('result'=> $result));
		}
		
		}else{
			echo "Invalid";
		}		
	}
	
	public function confirm($code){ 
	$user = User::where('code', '=', $code)->update('active', '1');	
	echo "success";
	}
	
	
	public function forgetpass(Request $request){
	$new_pass = $request->new_pass;
	$code = $request->code;
	
	if(User::where("")->update('password', brcrypt($newpass))){
	echo "success";
	}else{
		echo "error";
	}
	}
	
	public function resetpass(Request $request){
	$old_pass = $request->old_pass;
	$new_pass = $request->new_pass;
	$confirm = $request->confirm;
	}
	
	public function verify($code){
	$user = DB::table('users')->where('code', $code)->update(['active' =>1]);	
	
	return redirect(route('ok'));
	}

	public function verified(){
	return view('confirmed');	
	}
	
	
	public function addpost(Request $request){
	$group_id = $request->group_id;
	$user_id = $request->user_id;
	$body = $request->body;

	$post = new Post;
	$post->user_id = $user_id;
	$post->group_id = $group_id;
	$post->body = $body;
	$post->ref = str_random(7);
	$post->save();

	echo "success";
	
	}	
	
	public function viewevents ($id){
		  $group = Group::find($id)->first();
	   $events  = Event::where('id')->get();
      
		echo $events->toJson();
	}

	public function getNoOfHead(){

	$user = User::all()->count();
			
	}	
	public function fetchcomments(Request $request){
	$post_id = $request->id;
//	$post_id = 6;
	$comments = Comment::where('post_id', $post_id)->get();
 $result = array();
 
 foreach($comments as $row){
 array_push($result,array(
 
 "name"=> $row->user->first_name." ". $row->user->last_name,    
     "body"=>$row->body,
 "date" => $row->created_at->diffForHumans()    
 ));
 }
 //Displaying the array in json format 
 return ['result'=>$result];
	}
        
public function fetchpost(Request $request){
	$post_id = $request->post_id;

	$row = Post::where('id', $post_id)->first();
 	$result = array();

 array_push($result,array(
 "id"=> $post_id,
 "name"=> $row->user->first_name." ".$row->user->last_name,   
 "body"=>$row->body,
 "created_at" => $row->created_at->diffForHumans()    
 ));

 return ['result' => $result];
	}

	public function fetchmembers(Request $request){
		$group_id = $request->group_id;
		//$group_id = 1;
		$members = Member::where('group_id', $group_id)->get();
		$result = array();	
	foreach($members as $member){
		array_push($result,array(
			"id" => $member->user->id,
			"name" => $member->user->first_name." ".$member->user->last_name,
			"email" => $member->email,
			"date_joined" => $member->created_at->diffForHumans()	
		));
	}
	return ['result' => $result];
	
	}
	public function fetchoneannouncement(Request $request){
	$ann = Announcement::where('id',$request->id)->first();
	$res = [];
	array_push($res,[
	"id"=> $ann->id,
	"title" => $ann->title,
	"body" => $ann->body
	]);
	return ['result'=>$res];
	}

        public function fetchannouncement(){
	$comments = Announcement::all();
 $result = array();
 
 foreach($comments as $row){

 array_push($result,array(
 "id"=>$row->id,
 "author_id"=> $row->user->first_name,   
 "body"=>$row->body,
 "created_at" => $row->created_at->diffForHumans()    
 ));

 }

 return ['result' => $result];
	}




	public function uploadImage(){
		
		$upload_path = '';
		
		$upload_url =
		$response = array();
	}

	public function addComment(Request $request){
		$id = $request->id;
		$post_id = $request->post_id;
		
		$user = User::where("id", $id)->first();
		$post = Post::where("id", $post_id)->first();
		$group_id = $post->group_id;	
		Comment::create([
			"user_id" => $request->id,
			"post_id" => $post_id,
			"body" => $request->body,
			"group_id" => $group_id
		]);

		return "success";
	}
	
	public function chatlogin(Request $request){
		$email  = $request->email;
		$password = $request->password;

		$user = User::where('email', '=', $email)->first();
		$result = array();	
		if(password_verify($password, $user->password)){
			array_push($result, [
				"username" => $user->username,
				"email" => $user->email,
				"id" => $user->id,
				"role" => $user->role
			]);
			return ["result" => $result];
		}else{
			echo "invalid";
		}
	}

	public function getgroupschat(Request $request){
			
		$id = $request->user_id;
		$role = $request->role;
		
		$result = array();
		if($role == "1" || $role == "member"){
		$members = Member::where('user_id','=', $id)->get();
		
		foreach($members as $member){	
		
			array_push($result, [
				"group_id" => $member->group_id,
				"group_name" => $member->group->group_name,
				"code" => $member->group->code,
				"description" => $member->group->description,
				"group_owner" => $member->user->username,
				"ok" => $member->group->hasChat
			]);
	
		}

	    }else if($role == "2" || $role == "head"){
		$groups = Group::where('group_owner', '=', $id)->get();	
		foreach($groups as $group){
			array_push($result, [
				"group_id" => $group->id,
				"group_name" => $group->group_name,
				"code" => $group->code,
				"description" => $group->description,
				"group_owner" => $group->user->username,
				"ok" => $group->hasChat
				]);
			
		}
	    }else{
			return "null";
		}
		return ["result" => $result];
	}

		public function fetchfolders(Request $request){
			$group_id = $request->group_id;
			$folders = Folder::where('group_id', $group_id)->get();
			$result = array();

			foreach($folders as $folder){
				array_push($result, [
					"id" => $folder->id,
					"name" => $folder->name,
					"description" => $folder->description 
				]);
			}
			return ["result" => $result];
		}

		public function fetchfiles(Request $request){
			$folder_id = $request->folder_id;
			$files = Files::where('folder_id', $folder_id)->get();
			$result = array();
			foreach($files as $file){
					array_push($result,[
					"file_name" => $file->file_name,
					"view_url"=> $file->download_link,
					"file_owner" => $file->user->username
						]);
			}

			return ["result"=> $result];

		}

		public function hasChat(Request $request){
			
			Group::where('id', $request->group_id)->update(['hasChat' => 'Yes']);
		}

		public function addgroup (Request $request){
			$user_id = $request->user_id;
			$role = $request->role;
			$group = new Group;
		
			$group->user_id = $user_id;
			$group->role = $role;
			$post->save();
			echo "success";
		}
	}
