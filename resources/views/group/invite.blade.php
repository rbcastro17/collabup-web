@extends('master')
@section('title')
Invite Members
@endsection
@section('content')
<h3 class="ui header">
    <i class="mail icon"></i>
    <div class="content">Invite someone
        <div class="sub header">to join your group. Code: {{$group->code}}</div>
    </div>
</h3>
<form action="{{route('invite.send',['id' => Request::segment(2),'code'=>$group->code])}}" method="POST" class="ui form">
    {{csrf_field()}}
    <div class="field{{$errors->has('email')? ' error' : ''}}">
        <label for="">Email</label>
        <div class="ui left icon input"><input type="email" name="email" id="email"><i class="mail icon"></i></div>
    </div>
    <button type="submit" class="ui green button"><i class="mail icon"></i>Send</button>
</form>
@endsection