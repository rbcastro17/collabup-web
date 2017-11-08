@extends('master')

@section('title')
{{$group->group_name}}
@endsection
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>	

<script src="{{asset('js/jquery.min.js')}}"></script>
@section('content')

<?php
$requestSent = false;

foreach($requests as $request){
    if($request->user_id = Auth::user()->id && $request->group_id == $group->group_id ){
        $requestSent = true;
    }
}

?>

<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
        <div class="ui container">
            <div class="wrapper">
<?php if($isAllowed || Auth::user()->role==2 && Auth::user()->id == $group->group_owner):?>
                <form action="{{route('post.create',$group->id)}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                    <div class ="ui two column grid">
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="text" name="body" id="body" placeholder="Do you have anything in mind?" value="{{Request::old('body')}}">
                            <input type="hidden" name="group_id" value="{{$group->id}}"/>
                        </div>
                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>
<?php endif;?>                
           </div>
        </div>
		 <div class="ui container">
             <div class="ui segment">
@if(Auth::user()->role == 2 && Auth::user()->id == $group->group_owner)
<a href="{{url('createFolderPage',$group->id)}}" class="ui right labeled icon button"><i class="user icon"></i>Create Folder</a>
@endif
@if(Auth::user()->role == 2 && Auth::user()->id == $group->group_owner|| $isAllowed)
<a href="{{route('requests', $group->id)}}" class="ui right labeled icon button"><i class="users icon"></i>Member Requests</a>
<a href="{{route('invite', $group->id)}}" class="ui right labeled icon button"><i class="users icon"></i>Invite Users</a>

@endif
<a href="{{route('members', $group->id)}}" class="ui right labeled icon button">
<i class="users icon"></i>

Members
</a>

@if(Auth::user()->role == 2 && Auth::user()->id == $group->group_owner)
<a href="{{route('requests', $group->id)}}" class="ui right labeled icon button"><i class="users icon"></i>
Requests
</a>

@endif

@if($requestSent)
<a class="ui violet button" disabled>Request Sent</a>
@else
<a class="ui violet button" href="{{route('request',$group->id)}}">Join Group</a>
@endif

</div>
		 </div>
@if($folders->count() == 0)
		   <br>
        <div class="ui container">
           <div class="ui segment">
             <h3 class="text-center">This group has no Folder.   </h3>
           </div> 
        </div>
        @else 
<legend><h1>	Folders 	</h1>	</legend>			
<table class="ui celled table hover">
			@foreach($folders as $folder)	
<tr onclick="window.document.location='{{route('folder.specific', $folder->id)}}';">
			<td>{{$folder->name}} 
             @if(Auth::user()->role==2)
| <a href="{{url('folder/'.$folder->id.'/'.$group_id.'/edit')}}">Edit</a>
| <a href="{{route('delete.folder', $folder->id)}}">Delete</a>
    @endif  
             <i class="folder icon"><td>
	<b>{{$folder->created_at->diffForHumans()}}</b>
    
</tr>
	@endforeach



</table>	
	@endif
        <br>
         @if($posts->count() == 0)
					 
		   <br>
        <div class="ui container">
          
           <div class="ui segment">
		 
             <h3 class="text-center">Timeline is empty.   </h3>
			 
           </div> 
	   
        </div>
        @else 
        @foreach($posts as $post)
<div class ="ui modal edit-{{$post->id}}">
Hey
</div>
        <div class="ui list segment">
           <div class="item">
                  <img class="ui avatar image" src="{{asset('images/'.$post->user->image)}}">
                  <div class="content">
                    <div class="header" data-tooltip="View Profile Of {{$post->user->first_name}}"><h3><a href="{{route('group.member.profile', $post->user->id)}}">{{$post->user->first_name}} {{$post->user->last_name}} </a></h3>
                    @if(Auth::user()->role == 2 || Auth::user()->id == $post->user->id)
                    <a href="{{url('/edit/'. $post->id.'/status/'.$group->id)}}">
                    
                     Edit <i class="edit icon"></i>   </a> |
                    <a href="{{route('status.delete',$post->id)}}">Delete <i class="erase icon"></i></a>
                    @endif
                    |<a href="#">Report<i class="protect icon"></i></a>
                    </div>
                    <div class="description">
                    <i data-tooltip ="Created in: {{$post->created_at->diffForHumans()}} "><small>Last Edited</small> {{$post->updated_at->diffForHumans()}} </i>
                    
                    <p style="font-size: 28px">{{$post->body}}</p></div>
                  </div>
            </div>
            
            <div class="ui horizontal divider">Comments</div>
            <div class="ui comments">
                @if($post->comments->count() > 0)
                @foreach($post->comments as $comment)
                    <div class="comment">
                        <div class="content">
                            <a class="author">{{$comment->user->first_name}} {{$comment->user->last_name}}</a>
                            <div class="metadata">
                                <span class="date">{{$comment->created_at->diffForHumans()}}</span>
                            </div>
                            <div class="text">{{$comment->body}}</div>
                        </div>
                    </div>
                    
                @endforeach
                @else
                <h4 class="text-center">No Comments</h4>
                @endif
            <br>

            <?php if($isAllowed || Auth::user()->role == 2):?>
            <form action="{{route('comment',['id'=> $group->id, 'post'=>$post->id])}}" method="POST" class="ui form">
                <div class="field{{$errors->has('body')? ' error' : ''}}">
                    <textarea name="body" id="body" cols="30" rows="3" class="form-control" placeholder="Comment something here..."
					style="resize:none"
					></textarea>
                </div>
                <div class="field">
                    <button type="submit" class="ui light blue button"><i class="chat icon"></i> Submit</button> 
                </div>
                {{csrf_field()}}
            </form>
            
            <?php endif;?>
            </div>
			
        </div>
         @endforeach         
        @endif
    </div>

</div>
<div class="col-md-2 wrapper"></div>
@endsection
