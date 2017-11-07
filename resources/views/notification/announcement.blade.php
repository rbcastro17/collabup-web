@extends('master')
@section('title')

@endsection

@section('content')

<div class="ui styled fluid accordion">
  <div class="active title">
    <i class="dropdown icon"></i>
   <h3>Announcement: {{$event->title}}     </h3>
  </div>
  <div class="active content">
    <p>{{$event->body}}</p>
  </div>
  
</div>
@endsection