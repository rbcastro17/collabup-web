@extends('master')
@section('title')
Announcement | {{$ann->title}}
@endsection

@section('content')

           <div class="ui list segment">
          
           <div class="item">
                  <img class="ui avatar image" src="{{asset('images/'.$ann->user->image)}}">
                  <div class="content">
                    <div class="header" data-tooltip="View Profile Of {{$ann->user->first_name}}"><h3><a href="{{route('group.member.profile', $ann->user->id)}}">{{$ann->user->first_name}} {{$ann->user->last_name}} </a></h3>
                    @if(Auth::user()->role == 3)
                    <a   href="{{url('edit/'.$ann->id.'/status/'.$group_id)}}"> Edit </a> |
                    <a href="{{route('status.delete',$ann->id)}}">Delete </a>
                    @endif
                    </div>
                    <div class="description">
                    <i data-tooltip ="Created in: {{$ann->created_at->diffForHumans()}} "><small>Last Edited</small> {{$ann->updated_at->diffForHumans()}} </i>
                    
                    <p style="font-size: 16px">{{$ann->body}}</p>
                    <BR>
                    </div>
                  </div>
            
            </div>
            


            
            

@endsection