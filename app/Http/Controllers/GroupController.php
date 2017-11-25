<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Invite;
use Auth;
use App\GroupRequest;
use App\User;
use App\Group;
use App\Member;
use App\Post;
use App\Folder;
use App\Files;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Events\SendAppNotification;
use App\AppNotification;

class GroupController extends Controller
{
   
    public function index()
    {

        if(Auth::user()->role == 2){
        $categories = Category::all();
        $groups = Group::where('group_owner', Auth::user()->id)->paginate(5);
      
        return view('group.index', ['groups' => $groups, 'cs' => $categories]);
        }else{
    	$data['groups'] = Member::where('user_id', Auth::user()->id)->paginate(5);
        return view('group.index', $data);	
        }
    }

    public function create()
    {
        return view('group.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[  
            'group_name' => 'required',
            'description' => 'required',
        ]);

        Group::create([
            'group_name' => $request->group_name,
            'group_limit' => $request->group_limit,
            'description' => $request->description,
            'code' => str_random(5),
            'category_id' => $request->category,
            'type' => $request->group_type,
            'group_owner' => Auth::user()->id,
        ]);

        return redirect("groups");
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);
        $members = Member::where('group_id', $id)->get();
        $posts = Post::where('group_id', $id)->latest()->orderBy('created_at','desc')->get();
        $comments = Post::where('group_id', $id)->get();
        $folders = Folder::where('group_id', $id)->get();
        $requests = GroupRequest::where('group_id', $id)->get();


        return view('group.show', [

            'requests' => $requests,
            'group'=>$group,'members'=>$members,'posts'=>$posts, 'comments' => $comments, 'folders' => $folders, 'group_id' => $id]);
    }

    public function edit($id)
    {
        $group = Group::find($id);

        return view('group.edit', ['group' => $group]);
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request,['group_name' => 'required', 'group_description' =>'required|max:300' ]);
		
		Group::find($id)->update(['group_name' => trim($request->group_name), 'type' => $request->type,
         'description' =>trim($request->group_description)]);   
        return redirect()->action('GroupController@index')->withInfo('Group Updated');
    }


    public function destroy($id)
    {
        $group = Group::find($id);
        $group -> delete($id);
        Member::where('group_id', '=', $id)->delete();
        return redirect()->back();
		
		
    }

    public function invite_members($id)
    {
        $group = Group::find($id);
        return view('group.invite',['group'=>$group]);
    }

    public function send_invite(Request $request,$id,$code)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);
	$user = User::where('email', '=', $request->email)->first();
	$role = $user->role;
		if($role == '2' || $role == '3'){
		 return redirect()->route('group.show',$id)->withInfo('This Email is invalid with that transaction.');	
		}else{
	    Mail::to($request->email)->send(new Invite($request->email,$code));
        return redirect()->route('group.show',$id)->withInfo('Invite sent');
		}
	}

public function requestGroup($id){ //$id = group_id
$user_id = Auth::user()->id;
GroupRequest::create([]);
}


public function showMemberRequest($id){  // lists of Group request $id = group_id
}

    public function invite($code, $email)
    {
        $group = Group::where('code', $code)->first();
        $member = Member::where('email', $email)->first();
 		$user = User::where('email', '=', $email)->first();
         if($member == null){
           Member::create([
               'user_id' => $user->id,
                'email' => $email,
                'group_id' => $group->id,
            ]);

            return redirect()->route('group.show', $group->id)->withInfo('Group Joined');
			}
            else{
                abort(404);
            }
        
    }
	public function createFolderPage($id){
		$group = Group::find($id);
		return view ('group.folder',['group'=>$group]);
		
	}
	public function createFolder(Request $request,$id){
	
	 $this->validate($request,[
            'name' => 'required',
            'description' => 'required|max:1000'
        ]);
        $ref = str_random(48);
        Folder::create([
            'name' => $request->name,
            'group_id' => $id,
            'root_folder_id' => $request->root_folder_id,
            'container_folder_id' => $request->container_folder_id,
            'postion' => $request->position,
            'description' => $request->description,
            'ref' => $ref
        ]);
            $members = Member::where('group_id', '=', $id)->get();
              foreach($members as $m){

                event(new SendAppNotification(Auth::user()->id, $m->user_id,$ref,$id,8));
                
                AppNotification::create([
                    'user_id' => Auth::user()->id,
                    'reciever_id' => $m->user_id,
                    'ref' => $ref,
                    'group_id'=> $id,
                    'type' => 8
                
                    ]);
              
                  }  
        return redirect()->route('group.show',$id);
	}
	public function deletefile($id){
		Files::where('id', $id)->delete();
		return redirect()->back();
	}
	public function showFolder($id){
		 $folders = Folder::where('id', $id)->first();
		 $files = Files::where('folder_id',$id)->get();
        
	return view('group.showfolder',['files'=> $files, 'folders'=>$folders]);	
	}

public function savelink(Request $request, $id){
    
    $result = json_decode($request->result_upload);
    $ref = str_random(40);
	$data = new Files;
    $data->folder_id = $id;
    $data->file_name = $result->name;
    $data->file_owner = Auth::user()->id;
	$data->download_link = $result->downloadUrl;
	$data->view_link = $result->url;
	$data->icon = $result->iconUrl;    
    $data->ref = $ref; 
    $data->save();
    
    $folder = Folder::where('id', '=', $id)->first();
    $members = Member::where('group_id', '=', $folder->group_id)->get();
      
    foreach($members as $m){
        AppNotification::create([
            "user_id" => Auth::user()->id,
            "reciever_id"=> $m->user_id,
             "ref"=> $ref,
             "group_id" =>$m->group_id,
             "type" => 4
        ]);
        event(new SendAppNotification(Auth::user()->id, $m->user_id, $ref, $m->group_id,4));
    }
	return redirect()->route('folder.specific', $id);
}
public function getmembers($id){
	$members = Member::where('group_id', '=', $id)->get();
	$group_infos = Group::where("id",$id)->first();
    $group_owner = User::where("id",$group_infos->group_owner)->first();
	return view('group.members', ['members'=>$members, "group_info" => $group_owner]);
}

public function memberrequests($id){
   $data['requests']=  GroupRequest::where('group_id', '=', $id)->get();
   $data['group_id']= $id;
    return view('group.pendingrequest',$data);
}

public function acceptrequest($request){
        $group_request = GroupRequest::where('ref', '=', $request)->first();
   // dd($group_request);
        $user = User::where('id','=', $group_request->user_id)->first();
    
        $email = $user->email;
    
    Member::create([
        "user_id" => $user->id,
        "email" =>$email,
        "group_id" => $group_request->group->id,
    ]);

    event(new SendAppNotification(Auth::user()->id, $user->id, $group_request->ref, $group_request->group_id,6)); 
    
    AppNotification::create([
        'user_id' => Auth::user()->id,
        'reciever_id' => $user->id,
        'ref' => $group_request->ref,
        'group_id' => $group_request->group_id,
        'type' => 6
    ]);
   
    AppNotification::where([['type', '=', 5], ['ref', '=', $group_request->ref]])->delete();
    $group_request->delete();    

    return redirect()->back();

}

public function deleterequest($id){

    $group_request = GroupRequest::where('id', '=', $id)->first();

    event(new SendAppNotification(Auth::user()->id, $user->id, $group_request->ref, $group_request->group_id,7)); 
    
    AppNotification::create([
        'user_id' => Auth::user()->id,
        'reciever_id' => $group_request->group->group_owner,
        'ref' => $group_request->ref,
        'group_id' => $group_request->group_id,
        'type' => 7
    ]);
    return redirect()->back();
}
public function deletefolder($id){
    Folder::where("id",$id)->delete();
    return redirect()->back();
}
public function showsearchresult(Request $request){
$search = $request->search;
if(Auth::user()->role == 2){
$condition = array(
                array('group_name', 'like', '%'.$search.'%')
             );
}else{
$condition = array(
                array('group_name', 'like', '%'.$search.'%'),
                array('type', '!=', 3)
             );


}
$data['group_requests'] = GroupRequest::where('user_id', Auth::user()->id);
$data['result'] = Group::where($condition)->get();
$data['query'] = $search;
return view('group.resultpage',$data);
}

public function editFolderPage($id,$group_id){
    $data['group_id'] = $group_id;
    $data['folder'] = Folder::where('id', $id)->first();
    return view('group.editfolder',$data);
}

public function updatefolder(Request $request){
 
    $id = $request->id;
    $group_id = $request->group_id;
    $folder = Folder::find($id);
    $folder->name = $request->name;
    $folder->description= $request->description;
    $folder->save();

    return redirect()->route('group.show', $group_id);
}

    public function viewmemberprofile($id){
        $data['user'] = User::where('id',$id)->first();

        $data['posts'] = Post::where('user_id', $id)->latest()->get();
        
        $data['group'] = $id;
        if($id == Auth::user()->id){
            return redirect('profile');
        }else{
 return view('group.viewmemberprofile',$data);
        }
       
    }

    public function showsearchmemberresult(Request $request){
$search = $request->search;
$group = $request->group;


//$condition = array('first_name', 'like', '%'.$search.'%');

$data['result'] = Member::all();
$data['query'] = $search;
return view('group.resultpage',$data);
}

public function deletemember($id){
    if(Auth::user()->role == 2){
    Member::where('user_id', $id)->delete();
    return redirect()->back();
    }else{
        return redirect()->back();
    }

}

public function editstatuspage($id,$group_id){
   
if(Auth::user()->role == 2){
//$post = Post::where(['id', $id])-first();    
$data['post'] = Post::where('id', $id)->first();
$data['group_id'] = $group_id;

return view('group.editstatus',$data);
}else if(Auth::user()->role == 1){
//$post = Post::where(['id', $id])-first();    
$data['post'] = Post::where(['id' => $id, "user_id" => Auth::user()->id])->first();
$data['group_id'] = $group_id;

return view('group.editstatus',$data);
}

else{
    abort(404);
}
}

public function updatestatus(Request $request){
    $post = Post::where('id', $request->id)->update(['body' => $request->body]);
    $group_id = $request->group_id;    
    return redirect('group/'.$group_id);

}

public function deletestatus($id){
    $check = Post::where('user_id',Auth::user()->id)->first();

if(Auth::user()->role == 2 ){
Post::where('id', $id)->delete();
return redirect()->back();
}else if(Auth::user()->role == 1){
Post::where(["user_id" => Auth::user()->id, "id"=>$id])->delete();
return redirect()->back();
}else{
    abort(404);
}
}

public function fromfolder(Request $request){
    session_start();
    $data['folder_id'] = $_SESSION['folder_id'];
    return view('group.onedrive', $data);

}

public function saveonedrive(Request $request){
    $folder_id = $request->folder_id;
$json = $request->result_upload;   
$decoded_json = json_decode($json,true);
$ref = str_random(40);
    $file = new Files;
    $file->folder_id = $folder_id;
    $file->file_name = $decoded_json['value'][0]['name'];
    $file->file_owner = Auth::user()->id;
    $file->icon = "https://ssl.gstatic.com/docs/doclist/images/icon_10_generic_list.png";
    $file->ref = $ref;
    $file->view_link = $decoded_json['value'][0]["@microsoft.graph.downloadUrl"];
    $file->download_link = $decoded_json['value'][0]["@microsoft.graph.downloadUrl"];
    $file->save();

    $folder = Folder::where('id', '=', $folder_id)->first();
    $members = Member::where('group_id', '=', $folder->group_id)->get();
    
    foreach($members as $m){
        AppNotification::create([
           "user_id"=> Auth::user()->id, 
            "reciever_id"=> $m->user_id,
           "ref"=> $ref,
            "group_id" => $m->group_id, 
           "type"=> 5]);
           event(new SendAppNotification(Auth::user()->id, $m->user_id, $ref, $m->group_id,5));
        }
        
       
    return redirect()->route('folder.specific', $folder_id);      

}
    public function discoverbycategorypage(){
        $data['cs'] = Category::where('id', '!=', 1)->get();
        return view('group.discoverviacategory',$data);
    }
    public function discoverbycategory(Request $request){
        $data['cs'] = Category::where('id', '!=', 1)->get();
     
      $category = Category::where('ref','=', $request->category_ref)->first();
      $data['groups'] = Group::where('category_id', '=', $category->id)->get();
      $data['category_name'] = $category->name;  
      
      return view('group.discoverviacategoryresult',$data);
    }

    public function storereport(Request $request){
        $this->validate($request,[
            'description' => 'required|max:200'
        ]);
        Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'reference' => str_random(10),
            'author_id' => Auth::user()->id,
        ]);
    
    return back()->with('Successfully Reported the Post.');
    }

    public function group_chat(Request $request){
        
        $data['group'] = Group::where('code', '=', $request->code)->first(); 
        if($data['group']->hasChat == 'no'){
            Group::where('code', '=', $request->code)->update(['hasChat'=>'yes']);
        }

        return view('chat.chat',$data);        
    }


}
