<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Group;
use App\Member;
use App\Comment;
use App\User;
use App\Report;
use App\AppNotification;

use App\Events\SendAppNotification;

class PostController extends Controller
{
    public function create(Request $request, $id){
        $this->validate($request, ['body' => 'required|max:1000']);
        $group = Group::where('id', '=', $id)->first();
       $members;
       $alert_head; 
       if($group->id == Auth::user()->id){
                $members = Member::where('group_id', '=', $id)->get();
        }else{
           $members = Member::where([['group_id', '=', $id], ['user_id','!=', Auth::user()->id]])->get(); 
        $alert_head = true;
        }        

        $ref = str_random(10);
            Post::create([
                'body' => $request->body,
                'user_id' => Auth::user()->id,
                'group_id' => $id,
		        'ref' => $ref,
                'type' => 'text',
                'isReported' => false,
                ]);
                
                foreach($members as $m){

                    event(new SendAppNotification(Auth::user()->id,$m->user_id,$ref,$id,1));
                
                    AppNotification::create([
                        'user_id' => Auth::user()->id,
                        'reciever_id' => $m->user_id,
                        'ref' => $ref,
                        'group_id' => $id,
                        'type' => 1
                    ]);
                }
                if($alert_head == true){
                  $head = $group->group_owner;
                    event(new SendAppNotification(Auth::user()->id,$head,$ref,$id,1));
                    
                        AppNotification::create([
                            'user_id' => Auth::user()->id,
                            'reciever_id' => $head,
                            'ref' => $ref,
                            'group_id' => $id,
                            'type' => 1
                        ]);
                }
        return redirect()->back();
    }

    public function post($id)
    {
        $post = Post::find($id);
        $comment = Comment ::where('post_id',$id)->get();
        return view('group.post');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
		$post -> delete($id);

        return redirect()->back();


    }
	public function NewPost ($id)
	{
		$resp = Auth::user()->NewPost($id);//receiving notif
		$group = \App\Group::find(Auth::user()->id);
	User::find($id)->notify(new \App\Notifications\NewPost($group,Auth::user()) );
		return $resp;
	}

    public function reportpost(Request $request){
       // $report 
    }
}
