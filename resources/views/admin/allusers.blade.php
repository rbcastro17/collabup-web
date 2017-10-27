@extends('admin')
@section('title')
All Users | CollabUP
@endsection
@section('content')
<br>
<br>
<br>
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
  <form action="/account/search" method = 'GET'>
<div class="ui fluid action input">	
  <input type="text" name="search" placeholder="Search Members...">
  <button class="ui button" type="submit">Search</button>
</div>
<form>
</div>
<br>
<br>
<div clas="ui statistics">
<div class="statistic">
<div class="value">
{{$users->count()}}
</div>

</div>
<div class class="label">
Total Users
</div>
</div>
@foreach($users as $user)

<div class="ui middle aligned divided list">
<div class="item">
    <div class ="right floated content">
    
    @if($user->active == 1)

<a class="ui button" href="{{route('account.deactivate.admin',$user->id)}}">Deactivate</a>
@else
<a class="ui button" href="{{route('account.activate.admin',$user->id)}}">Activate</a>
@endif

    </div>
    <img class="ui avatar image" src="{{url('images/'.$user->image)}}"/>
    <div class="content">
    <?php
    $role;
    if($user->role == 1){
      $role = 'Member';
    }else{
      $role = 'Head User';
    }
    ?>
 <a href ="{{route('view.profile',$user->id)}}" class="header" data-tooltip="Role: {{$role}}  Username: {{$user->username}}">{{$user->first_name. " ". $user->last_name}}</a>
    </div>
   </div> 
</div>
@endforeach

@endsection
