@extends('master')

@section('title')
Reset Password
@endsection

@section('content')
<br>
<br>
<br>
<form action="{{route('resetpassword',Auth::user()->id)}}" method="post" class="ui form" style="margin-top: -100px">
    {{method_field('put')}}{{csrf_field()}}

    <div class="field{{$errors->has('password')? ' error' : ''}}">
        <label for="">New Password</label>
        <div class="ui left icon input"><input type="password" name="password" id="password" placeholder="New Password"><i class="lock icon"></i></div>
    </div>
    <div class="field{{$errors->has('password_confirmation')? ' error' : ''}}">
        <label for="">Confirm Password</label>
        <div class="ui left icon input"><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"><i class="lock icon"></i></div>
    </div>
     <br>
    <button type="submit" class="ui green button">Reset Password</button>
</form>

@endsection