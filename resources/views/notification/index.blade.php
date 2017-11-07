@extends('master')

@section('title')
Notifications ({{$notifications->count()}})
@endsection

@section('content')


<h2>App Notification</h2>

<div class="ui celled list">
  @if($notifications->count() == 0)
  <h4>No New Notification</h4>
  @else
  @foreach($notifications as $n)

  <div class="item">
    <img class="ui avatar image" src="{{asset('images/'.$n->user->image)}}">
    <div class="content">
      <div class="header">
      @if($n->type != 3)
      {{$n->user->first_name. " ".$n->user->last_name}}
      @else
      Admin
      @endif
      </div>
      @if($n->type ==1)
        Posted A Status in {{$n->group->group_name}}
        <br>
        <form action ="{{url('notification/post')}}">
     <input type="hidden" name="ref" value="{{$n->ref}}">
      <button class="ui button" type="submit">See More...</button>
        </form>
      @elseif($n->type== 2)
        Created An Event in {{$n->group->group_name}}
      <form action ="{{url('notification/event')}}">
     <input type="hidden" name="ref" value="{{$n->ref}}">
      <button class="ui button" type="submit">See More...</button>
        </form>
      @elseif($n->type== 3)
      Posted A New Announcement!
      <form action ="{{url('notification/announcement')}}">
     <input type="hidden" name="ref" value="{{$n->ref}}">
      <button class="ui button" type="submit">See More...</button>
        </form>

      @elseif($n->type == 5)  
      Uploaded A New File in {{$n->group->group_name}}
      <form action ="{{url('notification/file')}}">
     <input type="hidden" name="ref" value="{{$n->ref}}">
      <button class="ui button" type="submit">See More...</button>
        </form>
      
      @else

      @endif
      
    </div>
  </div>
  @endforeach
  @endif
  </div>
@endsection