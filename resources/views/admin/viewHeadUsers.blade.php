@extends('admin')***

@section('title')
List of Head User
@endsection

@section('content')

<br>
<br>
<br>
<br>
@foreach($users as $user)
<div class="ui middle aligned divided list">
  <div class="item">
    <div class="right floated content">
      <a class="ui purple button" href="{{route('view.profile', $user->id)}}">View</a>
      <a class="ui green button" href="{{route('user.activate', $user->id)}}">Activate</a>
      <a class="ui red button" href="{{route('user.deactivate', $user->id)}}">Deactivate</a>
    </div>
   <img class="ui avatar image" src="/images/{{$user->image}}">
    <div class="content">
      {{$user->username}}
    </div>
  </div>
  </div>

@endforeach
@endsection