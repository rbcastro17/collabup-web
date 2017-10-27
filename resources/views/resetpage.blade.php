@extends('master')


@section('title')
Change Password
@endsection


@section('content')
<form action="{{route('account.update')}}" method="post" enctype="multipart/form-data" class="ui form">
{{method_field('put')}}
{{csrf_field()}}
	<div class="field">
		<label for="">Old Password</label>
		<div class="ui left icon input"><input type="password" name="old_password" id="first_name" ><i class="user icon"></i></div>
	</div>
	<div class="field">
		<label for="">New Password</label>
		<div class="ui left icon input"><input type="password" name="new_password" id="middle_name" ><i class="user icon"></i></div>
	</div>
	<div class="field">
		<label for="">Confirm Password</label>
		<div class="ui left icon input"><input type="password" name="confirm_password" id="last_name"><i class="user icon"></i></div>
	</div>
    <br>
    <br>
    <button type="submit" class="ui blue button">Change Password</button>
</form>
<br>
<br>



@endsection