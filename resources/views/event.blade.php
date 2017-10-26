@extends('master')

@section('title')
Events
@endsection

@section('content')
<div class="container">
    <iframe src="https://calendar.google.com/calendar/embed?src=usda2n6raatsug2bvp3lnr6n2k%40group.calendar.google.com&ctz=Asia/Manila" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>
<a href="{{route('event.list',$group->id)}}" class="fluid ui green button"><i class="calendar icon"></i> List of Events</a>
<div class="ui horizontal divider">OR</div>
<form action="{{route('event.create',$group->id)}}" method="POST" class="ui form">
        <div class="field">
            <label for="">Event Name</label>
            <div class="ui left icon input">
                <input type="text" name="name" id="name" placeholder="Event name">
                <i class="calendar icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">Start Time</label>
            <div class="ui left icon input">
                <input type="datetime" name="start_date" id="start_date">
                <i class="calendar icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">End Time</label>
            <div class="ui left icon input">
                <input type="datetime" name="end_date" id="end_date">
                <i class="calendar icon"></i>
            </div>
        </div>
        <button type="submit" class="ui green button"><i class="add to calendar icon"></i> Create Event</button>
        {{csrf_field()}}
</form>
@endsection