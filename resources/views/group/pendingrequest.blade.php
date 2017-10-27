@extends('master')

@section('title')
Group Request 
@endsection


<script src="{{asset('js/jquery.min.js')}}"></script>
@section('content')
<h3>Group Requests</h3>
@foreach($requests as $request)
<div class="ui cards">
  <div class="card">
    <div class="content">
      <img class="right floated mini ui image" src="{{asset('images/avatar.jpg')}}">
      <div class="header">
        {{$request->user->first_name." ". $request->user->last_name}}
      </div>
      
      <div class="meta">
        {{$request->created_at->diffForHumans()}}
      </div>
      <div class="description">
        {{$request->first_name}} requested permission to join your group
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
    <?php 
    $id =$request->user->id;
    ?>
        <a class="ui basic green button" href='{{url("group/$id/$group_id/$request->id/accept")}}'>Approve</a>
        <a class="ui basic red button" href='{{url("group/$request->id/delete")}}'>Decline</a>
      </div>
    </div>
  </div>
  @endforeach

@endsection
