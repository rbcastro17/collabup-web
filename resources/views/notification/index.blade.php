@extends('master')

@section('title')

@endsection

@section('content')


<h2>App Notification</h2>

<div class="ui celled list">
  
  @foreach($notifications as $n)

  <div class="item">
    <img class="ui avatar image" src="{{asset('images/'.$n->user->image)}}">
    <div class="content">
      <div class="header">{{$n->user->first_name. " ".$n->user->last_name}}</div>
      @if($n->type ==1)
        Posted A Status in {{$n->group->group_name}}
        <br>
        <form action ="{{url('post')}}">
     <input type="hidden" name="ref" value="{{$n->ref}}">
      <button class="ui button" type="submit">See More...</button>
        </form>
      @elseif($n->type== 2)

      @elseif($n->type== 3)

      @else

      @endif
      
    </div>
  </div>
  @endforeach
  </div>
@endsection