@extends('master')
@section('title')
Event Scheduler
@endsection
@section('content')
<script>
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script>
document.getElementById("start").defaultValue = "2015-01-02T11:42:13.510";
document.getElementById("end").defaultValue = "2015-01-02T11:42:13.510";
</script>
<br>
<h3>Edit Event</h3>
<br>

                <form action="{{route('event.update', $event->id)}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                   <input type="hidden" name="_method" value="PUT">
                   <input type="hidden" name="id" value="{{$event->id}}">
                    <div class ="ui two column grid">

                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="text" name="title" id="body" placeholder="Do you have anything in mind?" value="{{$event->title}}">
                        </div>
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <textarea name="body" id="body" placeholder="Do you have anything in mind?" >{{$event->body}}</textarea>
                        </div>
                        
                            <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="datetime-local" name="start" id="start" placeholder="Do you have anything in mind?" value="{{$event->start_duration}}">
                        </div>
                            <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="datetime-local" name="end" id="end" placeholder="Do you have anything in mind?" value="{{$event->end_duration}}">
                        </div>                        
                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>

@endsection