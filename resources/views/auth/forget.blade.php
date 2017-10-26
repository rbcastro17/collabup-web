@extends('master')

@section('title')
Login
@endsection

@section('content')
<form action="{{route('auth.login')}}" method="post" class="ui form">
{{csrf_field()}}
    <div class="ui segment">
    <div class="field{{$errors->has('email')? ' error':''}}">
        <label for="">Email</label>
        <div class="ui left icon input"><input type="email" name="email" id="email" placeholder="Email"><i class="mail icon"></i></div>
    </div>
    <br>
    <button type="submit" class="ui green button">Request Renewal of Password</button>
    </div>
</form>
@endsection