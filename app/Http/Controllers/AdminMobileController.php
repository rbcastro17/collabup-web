<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Announcement;

class AdminMobileController extends Controller
{

		public function alladmin(){
			$admins = User::all();
			$result= array();
			foreach($admins as $admin){
			array_push($result,array(
			"id"=>$admin->id,
			"first_name"=>$admin->first_name,
			"middle_name"=>$admin->middle_name,
			"last_name"=>$admin->last_name,
			"active"=>$admin->active,
			"username"=>$admin->username,
			"email"=>$admin->email,
			"role"=>$admin->role
		));
			}

			return ["result"=>$result];
		}

		public function alluser(){
			$users  = User::where('role', '!=', 3)->get();
			$response = array();
			foreach($users as $user){
				array_push($response, array(
			"id"=>$user->id,
			"first_name"=>$user->first_name,
			"middle_name"=>$user->middle_name,
			"last_name"=>$user->last_name,
			"active"=>$user->active,
			"username"=>$user->username,
			"email"=>$user->email,
			"role"=>$user->role
		));	}
		return ["result"=> $response];
		}
		public function addannouncement(Request $request){
			Announcement::create([
				"user_id" => $request->user_id,
				"title" => $request->title,
				"body" => $request->body,
				"ref" => str_random(6)
			]);
			return "success";
		}
		public function activateuser(Request $request){
			$id = $request->id;
			User::where('id','=',$id)->update(["active"=>1]);
			return "activated";
		}

		public function deactivate(Request $request){
			$id = $request->id;
			User::where('id','=',$id)->update(["active"=>0]);
			return "deactivated";
		}

		public function updateannouncement(Request $request){
		
		Announcement::where('id','=', $request->id)->update(['body'=>$request->body]);
		}
		public function deleteannouncement(Request $request){
			$id = $request->id;
			 Announcement::where('id', '=',$id)->delete();
			 return "success";
		}

		public function allannouncement(){
		$announcements = Announcement::all();
		
		$response = array();

		foreach($announcements as $ann){
			$user = User::where("id", $ann)->first();
			array_push($response,array(
				"id" => $ann->id,
				"body" => $ann->body,
				"user_id" => $user->first_name." ".$user->last_name 
			));
			return ["result" => $response];	
		}

		}

    	public function login(Request $request){
        
		$user = User::where(["email"=> $request->email,"role"=>3])->first();
		$response = array();		
		if(password_verify($request->password,$user->password)){
		
			$result = array();
		array_push($result,array( 
		"id" => $user->id,
		"email" => $user->email,
		"password"=> $request->password,
		"image" => $user->image,
		"name" => $user->first_name. " ". $user->last_name, 
		));
		return ['result' => $result];
		 		
		}else{
			return "Invalid";
		}		
	}

    public function getusers(){
        $users = User::where('role', '!=', 3)->get();
        $result = array();
        foreach($users as $user){
            array_push($result,array(
              "id" => $user->id,
               "name" => $user->first_name. " ". $user->middle_name. " ". $user->last_name,
               "active" => $user->active,
               "username" => $user->username,
               "email" => $user->email,
               "role" => $user->role
             ));
        		return ["result" => $result];
        }

        }

	public function membersOnly(){
	$users = User::where('role', 1)->get();
	$result = [];
	foreach($users as $user){
	array_push($result, [
	"id" => $user->id,
	"name" => $user->first_name. " ".$user->middle_name . " ". $user->last_name,
	"email" => $user->email
	]);	
	}
	
	}

	public function fetchuserinfo(Request $request){
	$user = User::where('id', $request->id)->first();
	$result = [];
	array_push($result,[
	'id' => $user->id,
	'name'=> $user->first_name. " ".$user->last_name,
	'username' => $user->username,
	'email' => $user->email,
	'image' => $user->image,
	'active' => $user->active
	]);

	return ['result'=>$result];
	}
}
