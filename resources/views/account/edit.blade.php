@extends('master')


@section('title')
Edit Profile
@endsection


@section('content')
<form action="{{route('account.update')}}" method="post" enctype="multipart/form-data" class="ui form">
{{method_field('put')}}
{{csrf_field()}}
	<div class="field">
		<label for="">First Name</label>
		<div class="ui left icon input"><input type="text" name="first_name" id="first_name" value="{{$user->first_name}}"><i class="user icon"></i></div>
	</div>
	<div class="field">
		<label for="">Middle Name</label>
		<div class="ui left icon input"><input type="text" name="middle_name" id="middle_name" value="{{$user->middle_name}}"><i class="user icon"></i></div>
	</div>
	<div class="field">
		<label for="">Last Name</label>
		<div class="ui left icon input"><input type="text" name="last_name" id="last_name" value="{{$user->last_name}}"><i class="user icon"></i></div>
	</div>
	<div class="field">
		<label for="">Username</label>
		<div class="ui left icon input"><input type="text" name="username" id="username" value="{{$user->username}}"><i class="user icon"></i></div>
	</div>
	<div class="field">
	<label for="">Image</label>
		<div class="ui left icon input">  <input type="file" name="image" accept="image/*"> <i class="user icon"></i></div>
	</div>
	<button type="submit" class="ui green button">Update</button>
</form>
<br>
<br>

	<div class="field">
	<h4>Change Password</h4>
	<label for=""></label>
		<div class="ui left icon input"><a href="{{route('resetpage')}}"> Current Password: **********  </a><i class="password icon"></i></div>
	</div>

@endsection