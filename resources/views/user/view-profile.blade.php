@extends('master')

@section('title')
{{Auth::user()->first_name.' '.Auth::user()->last_name}} | CollabUP Profile
@endsection

@section('content')
<div class="ui centered card">
  <div class="image">
    <img src="{{url('/images/'.Auth::user()->image)}}">
  </div>
  <div class="content">
    <div class="header"><center>{{Auth::user()->first_name. " " . Auth::user()->last_name}}</center></div>
    <div class="description">
    <p>@ {{Auth::user()->username}}</p>

    <a href="{{route('account.edit')}}">Edit Profile</a>
    </div>
  </div>
</div>
<br>



<h2>Recent Activities</h2>

       @if($posts->count() == 0)
				 
		   <br>
        <div class="ui container">
          
           <div class="ui segment">
		 
             <h3 class="text-center">Timeline is empty.   </h3>
			 
           </div> 
	   
        </div>
        @else 
        @foreach($posts as $post)
        <div class="ui list segment">
           <div class="item">
                  <img class="ui avatar image" src="{{asset('images/'.$post->user->image)}}">
                  <div class="content">
                    <div class="header"><h3>{{$post->user->first_name}} {{$post->user->last_name}}</h3>
                    {{$post->created_at->diffForHumans()}}
                    </div>
                    <div class="description"><p>{{$post->body}}</p></div>
                  </div>
            </div>
            <div class="ui horizontal divider">Comments</div>
            <div class="ui comments">
                @if($post->comments->count() > 0)
                @foreach($post->comments as $comment)
                    <div class="comment">
                     <img  width="30" height="30" src="{{asset('images/'.$comment->user->image)}}">
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
            </div>
        </div>
         @endforeach         
        @endif
    </div>
    <br>
    <br>
   <center> {{$posts->links()}}</center>
</div>
<div class="col-md-2 wrapper"></div>
@endsection
