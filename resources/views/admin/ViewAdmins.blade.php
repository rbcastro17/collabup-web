@extends('admin')***

@section('title')
List of Admins
@endsection

@section('content')
<script>
function showCreateAdmin(){
  $('.ui.modal.create')
  .modal('show')
;
}
</script>

<h3>List Of Admins <button class="ui button" onClick="showCreateAdmin()"><i class="add user icon"></i></button></a>

<div class="ui modal create">
<i class="close icon"></i>
<div class="header">
<h2>Create Another Admin</h2>
</div>
<div class="content">
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
    <button type="submit" class="ui green button">Submit</button>
</form>
</div>
</div>

@if($users->count() == 0)
<h4>:( Looks like youre the only admin at the moment <a href="{{url('addAdminPage')}}">Try adding Admins now!</a></h4>
@else
@foreach($users as $user)
<div class="ui middle aligned divided list">
  <div class="item">
    <div class="right floated content">
      <form action="{{route('delete.admin')}}" method="POST">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$user->id}}"/>
      <button class="ui red button" >Remove</button>
      </form>
    </div>
   <img class="ui avatar image" src="/images/{{$user->image}}">
    <div class="content">
      {{$user->username}}
    </div>
  </div>
  </div>

@endforeach
@endif
@endsection