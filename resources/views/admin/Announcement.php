@extends('admin')

@section('title')
Announcement Page
@endsection

<br>
<br>
<br>
<br>

@section('content')
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
        <div class="ui container">
            <div class="wrapper">
                <form action="{{route('post.create',$group->id)}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                    <div class ="ui two column grid">
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="text" name="body" id="body" placeholder="Do you have anything in mind?" value="{{Request::old('body')}}">
                        </div>
                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>
           </div>
        </div>

        <br>
         @if($posts->count() == 0)
        <div class="ui container">
          
           <div class="ui segment">
             <h3 class="text-center">Timeline is empty.</h3>
           </div>        
        </div>
        @else 
        @foreach($posts as $post)
        <div class="ui list segment">
           <div class="item">
                  <img class="ui avatar image" src="{{asset('images/avatar.ico')}}">
                  <div class="content">
                    <div class="header"><h3>{{$post->user->first_name}} {{$post->user->last_name}}</h3></div>
                    <div class="description"><p>{{$post->body}}</p></div>
                  </div>
            </div>
            <div class="ui horizontal divider">Comments</div>
            <div class="ui comments">
                @if($post->comments->count() > 0)
                @foreach($post->comments as $comment)
                    <div class="comment">
                        <a class="avatar"><img src="{{asset('images/avatar.ico')}}" alt=""></a>
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
            <form action="{{route('comment',['id'=> $group->id, 'post'=>$post->id])}}" method="POST" class="ui form">
                <div class="field{{$errors->has('body')? ' error' : ''}}">
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Comment..."></textarea>
                </div>
                <div class="field">
                    <button type="submit" class="ui green button"><i class="chat icon"></i> Submit</button> 
                </div>
                {{csrf_field()}}
            </form>
            </div>
        </div>
         @endforeach         
        @endif
    </div>
</div>
<div class="col-md-2 wrapper"></div>
@endsection