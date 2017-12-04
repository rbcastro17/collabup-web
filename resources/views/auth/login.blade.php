@extends('layouts.outpage')

@section('title')
Login
@endsection
<center><h2>Login your account</h2></center>
<br>
<br>
<br>
<br>
<br>
<br>
@section('content')
<form action="{{route('auth.login')}}" method="post" class="ui form">
{{csrf_field()}}
    <div class="ui segment">
    <div class="field{{$errors->has('email')? ' error':''}}">
        <label for="">Email</label>
        <div class="ui left icon input"><input type="text" name="email" id="email" placeholder="Email"><i class="mail icon"></i></div>
        @if($errors->has('email'))
        <div class="ui negative message">
  <i class="close icon"></i>
  <div class="header">
   <p>{{$errors->first('email')}}</p>
  </div>

        @endif
    </div>
    <div class="field{{$errors->has('password')? ' error':''}}">
        <label for="">Password</label>
        <div class="ui left icon input"><input type="password" name="password" id="password" placeholder="Password"><i class="icon lock"></i></div>
    </div>
    <br>
    <button type="submit" class="ui blue button">Sign in</button>
    </div>
</form>
@endsection