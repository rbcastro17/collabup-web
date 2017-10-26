@extends('admin')

@section('title')
Add Admin
@endsection

@section('content')

<br>
<br>
<br>
<br>

<form action="{{action('AdminController@addAdmin')}}" method="post" class="ui form" style="margin-top: -100px">
    {{csrf_field()}}
    <div class="field{{$errors->has('first_name')? ' error' : ''}}">
        <label for="">First Name</label>
        <div class="ui left icon input"><input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{Request::old('first_name')}}"><i class="user icon"></i></div>
    </div>
    <div class="field{{$errors->has('middle_name')? ' error' : ''}}">
        <label for="">Middle Name</label>
        <div class="ui left icon input"><input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" value="{{Request::old('middle_name')}}"><i class="user icon"></i></div>
    </div>
    <div class="field{{$errors->has('last_name')? ' error' : ''}}">
        <label for="">Last Name</label>
        <div class="ui left icon input"><input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{Request::old('last_name')}}"><i class="user icon"></i></div>
    </div>
    <div class="field{{$errors->has('email')? ' error' : ''}}">
        <label for="">Email</label>
        <div class="ui left icon input"><input type="email" name="email" id="email" placeholder="Email" value="{{Request::old('email')}}"><i class="mail icon"></i></div>
    </div>
    <div class="field{{$errors->has('username')? ' error' : ''}}">
        <label for="">Username</label>
        <div class="ui left icon input"><input type="text" name="username" id="username" placeholder="Username" value="{{Request::old('username')}}"><i class="user icon"></i></div>
    </div>
    <div class="field{{$errors->has('password')? ' error' : ''}}">
        <label for="">Password</label>
        <div class="ui left icon input"><input type="password" name="password" id="password" placeholder="Password"><i class="lock icon"></i></div>
    </div>
    <div class="field">
        <label for="">Confirm Password</label>
        <div class="ui left icon input"><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"><i class="lock icon"></i></div>
    </div>
    <br>
    <button type="submit" class="ui green button">Submit</button>
</form>
@endsection