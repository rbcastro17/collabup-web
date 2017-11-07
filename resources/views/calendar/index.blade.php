@extends('master')
@section('title')
Event Scheduler
@endsection


<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

  <script src="{{asset('js/fullcalendar.js')}}"></script>
<script src="{{asset('js/moment.js')}}"></script>


@section('content')
{!! $calendar->generate() !!}


<div id="fullcalendar-scheduler" ></div>

<h2>Create an Event</h2>
<h3>

<form action="{{route('event.store')}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                  
                    <div class ="ui two column grid">

                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="text" name="title" id="body" placeholder="Do you have anything in mind?" >
                        </div>
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <textarea name="body" id="body" placeholder="Do you have anything in mind?" > </textarea>
                        </div>
                        
                            <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="datetime-local" name="start_date" id="start" placeholder="Do you have anything in mind?" >
                        </div>
                        
                            <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="datetime-local" name="end_date" id="end" placeholder="Do you have anything in mind?" >
                        </div>     
                   <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">                         
                  <select name="group" class = "ui large icon input" >
                  @foreach($groups as $group)
                  <option value="{{$group->id}}">{{$group->group_name}}</option>
                  @endforeach
                  </select>
                  </div>
                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>

<h2>List of Event </h2>
<hr>
<div class="ui middle aligned divided list">
@foreach($events as $event)

  <div class="item">
   
    <div class="right floated content">
    <?php
        $now = Carbon\Carbon::now();
        $start_duration = Carbon\Carbon::parse($event->start_duration);
        $end_duration =Carbon\Carbon::parse($event->end_duration);

        $s_diff_to_current = $start_duration->diffInDays($now);
        $e_diff_to_current = $end_duration->diffInDays($now);
   
    ?>
    @if($s_diff_to_current == 0)
    <b>It is currently starting</b>
    @elseif($start_duration->gt($now) && $end_duration->gt($now))
    <b>Started {{$s_diff_to_current}} day(s) ago</b>
    @elseif($start_duration->gt($now))
   Starts in <b>{{$s_diff_to_current}} day(s)</b> &nbsp;
    @else
    Ended
    @endif
    
    


      <a class="ui button" href="{{route('event.editpage', $event->id)}}">Edit</a>
      <a class="ui button" href="{{route('event.delete', $event->id)}}">Delete</a>
    </div>
    
    <div class="content">
     <p> {{$event->title}} in {{$event->group->group_name}} </p>
    
   
    </div>
  
  </div>

@endforeach

  </div>

  <br>
  <br>
  <br>
  <br>
@endsection