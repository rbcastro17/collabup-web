<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentController extends Controller
{
    public function comment(Request $request, $id, $post)
    {
        $this->validate($request,[
                'body' => 'required|max:1000'
            ]);

        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'post_id' => $post,
            'group_id' => $id
        ]);

        return redirect()->back();
    }
}
