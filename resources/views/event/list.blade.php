@extends('master')

@section('title')
EVENTS
@endsection

@section('content')
<div class="ui horizontal divider"><i class="icon calendar outline green icon"></i> Events</div>
<table class="ui celled green table">
    <thead>
    <tr>
        <th>NAME</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
    <tr>
        <td>{{$event->name}}</td>
        <td>{{$event->startDateTime->diffForHumans()}}</td>
        <td>{{$event->endDateTime->diffForHumans()}}</td>
        <td>
        <div class="ui buttons">
        <a href="{{route('event.edit',['gid'=>$group->id, 'id' => $event->id])}}" class="ui inverted green button"><h3><i class="add to calendar green icon"></i></h3></a>
        <div class="or"></div>
        <a href="{{route('event.delete',['gid'=>$group->id,'id' => $event->id])}}" class="ui inverted red button"><h3><i class="delete to calendar red icon"></i></h3></a></td>
        </div>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection