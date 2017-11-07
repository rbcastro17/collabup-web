@extends('master')

@section('title')
Editing {{$event->name}}
@endsection

@section('content')
<h2 class="ui header">
    <i class="calendar icon"></i>
    <div class="content"> {{$event->name}}
        <div class="sub header">will end {{$event->endDateTime->diffForHumans()}}</div>
    </div>
</h2>
<form action="{{route('event.update',['gid' => $group->id,'id'=>$event->id])}}" method="POST" class="ui form">
{{method_field('PUT')}}
{{csrf_field()}}
    <div class="wrapper">
        <div class="field">
            <label for="">Event name</label>
            <div class="ui left icon input">
                <input type="text" name="name" id="name" value="{{$event->name}}">
                <i class="calendar icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">New Start Date : {{$event->startDateTime}}</label>
            <div class="ui left icon input">
                <input type="datetime-local" name="start" id="start" value="{{$event->start_duration}}">
                <i class="calendar icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">New End Date : {{$event->endDateTime}}</label>
            <div class="ui left icon input">
                <input type="datetime-local" name="end" id="end" value="{{$event->endDateTime}}">
                <i class="calendar icon"></i>
            </div>
        </div>
        <button type="submit" class="ui green button">Update</button>
    </div>
</form>
@endsection