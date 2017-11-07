@extends('master')
@section('title')
Event Scheduler
@endsection
@section('content')
<script>
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

<br>
<h3>Edit Event: {{$event->title}}</h3>
<br>

                <form action="{{route('event.update', $event->id)}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                   <input type="hidden" name="_method" value="PUT">
                   <input type="hidden" name="id" value="{{$event->id}}">
                    <div class ="ui two column grid">

                        <div class="field{{$errors->has('title')? ' error':''}} thirteen wide column">
                            <input type="text" name="title" id="body" placeholder="Do you have anything in mind?" value="{{$event->title}}">
                        </div>
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <textarea name="body" id="body" placeholder="Do you have anything in mind?" >{{$event->body}}</textarea>
                        </div>
                        
                            <div class="field{{$errors->has('start')? ' error':''}} thirteen wide column">
                            <input type="datetime-local" name="start" id="start" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($event->start_duration))}}">
                        </div>
                            <div class="field{{$errors->has('end')? ' error':''}} thirteen wide column">
                            <input type="datetime-local" name="end" id="end"  value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($event->end_duration))}}">
                        </div>                        
                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>

@endsection