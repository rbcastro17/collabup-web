@extends('master')
@section('title')
{{$event->title}}
@endsection

@section('content')


<div class="ui styled fluid accordion">
  <div class="active title">
    <i class="dropdown icon"></i>
   <h3> {{$event->title}} In <a data-tooltip="Click To View Group"href="{{url('group/'.$event->group->id)}}">{{$event->group->group_name}}</a>    </h3>
  </div>
  <div class="active content">
    <p>{{$event->body}}</p>
  </div>
  <div class="active title">
    <i class="dropdown icon"></i>
    Starts In
  </div>
  <div class="active content">
  <?php
    $start_event = new Carbon\Carbon($event->start_duration);
  ?>
    <p>{{$start_event->toDayDateTimeString()}}</p>
  </div>
  <div class="active title">
    <i class="dropdown icon"></i>
    Ends In
  </div>
  <?php
    $end_event = new Carbon\Carbon($event->end_duration);
  ?>
  <div class="active content">
    <p>{{$end_event->toDayDateTimeString()}}</p>
  </div>
</div>
@endsection