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

class PostController extends Controller
{
    public function create(Request $request, $id){
        $this->validate($request, ['body' => 'required|max:1000']);

      //  $group = Group::where('group_owner', Auth::user()->id)->where('id', $id)->get();
        $group = Group::where('group_owner', Auth::user()->id)->where('id',$id)->first();
        $member = Member::where('group_id', $id)->get();

  
            Post::create([
                'body' => $request->body,
                'user_id' => Auth::user()->id,
                'group_id' => $id,
		        'ref' => str_random(10),
                'type' => 'text',
                'isReported' => false,
                
                ]);

		//	User::find(1)->notify(new \App\Notifications\NewPost(\App\Group::find($id),Auth::user()));
        

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
