@extends('master')
@section('title')
Event Scheduler
@endsection

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

@section('content')
{!! $calendar->generate() !!}

<div id="fullcalendar-scheduler" ></div>

<h2>List of Event </h2>
<hr>
<div class="ui middle aligned divided list">
@foreach($events as $event)
  <div class="item">
    <div class="right floated content">

    <?php
        $now = Carbon\Carbon::now();
        $start_duration = Carbon\Carbon::parse($event['start_duration']);
        $end_duration =Carbon\Carbon::parse($event['end_duration']);

        $s_diff_to_current = $start_duration->diffInDays($now);
        $e_diff_to_current = $end_duration->diffInDays($now);
   
    ?>
    @if($s_diff_to_current == 0)
    <font color="blue"> <b>It is currently starting!</b></font>
    @elseif($start_duration->gt($now) && $end_duration->gt($now))
    <font color="green" ><b>Started {{$s_diff_to_current}} day(s) ago</b></font>
    @elseif($start_duration->gt($now))
   Starts in <b>{{$s_diff_to_current}} day(s)</b> &nbsp;
    @else
  <font color="red">  <b>Ended</b></font>
    @endif

    </div>
    <div class="content">
     <h3> Event Title: {{$event['title']}} in <b>></b><a href="{{route('group.show',$event['group_id'])}}"> {{$event['group_name']}} </a></h3>
     
     <h5>{{$event['body']}}</h5>
    <br>
    </div>
  
  </div>

@endforeach

  </div>

  <br>
  <br>
  <br>
  <br>
@endsection