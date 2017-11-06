@extends('master')
@section('title')

@endsection

@section('content')

<a href="{{url('group/'.$group_id)}}" class="ui blue button" ><h3> Visit The Group</h3></a>

        <div class="ui list segment">
           <div class="item">
                  <img class="ui avatar image" src="{{asset('images/'.$post->user->image)}}">
                  <div class="content">
                    <div class="header" data-tooltip="View Profile Of {{$post->user->first_name}}"><h3><a href="{{route('group.member.profile', $post->user->id)}}">{{$post->user->first_name}} {{$post->user->last_name}} </a></h3>
                    @if(Auth::user()->role == 2 || Auth::user()->id == $post->user->id)
                    <a  onclick="showEditModal-{{$post->id}}()"> Edit <i class="edit icon"></i>   </a> |
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

            <form action="{{route('comment',['id'=> $group_id, 'post'=>$post->id])}}" method="POST" class="ui form">
                <div class="field{{$errors->has('body')? ' error' : ''}}">
                    <textarea name="body" id="body"  rows="3" class="form-control" placeholder="Comment something here..."
					style="resize:none"
					></textarea>
                </div>
                <div class="field">
                    <button type="submit" class="ui light blue button"><i class="chat icon"></i> Submit</button> 
                </div>
                {{csrf_field()}}
            </form>

            </div>
			
        </div>
        
    </div>

@endsection