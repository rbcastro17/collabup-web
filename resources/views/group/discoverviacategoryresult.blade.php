@extends('master')

@section('title')
Discover Groups | CollabUP Collaborations at its finest
@endsection


<script src="{{asset('js/jquery.min.js')}}"></script>
@section('content')
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
  <form action="{{action('GroupController@discoverbycategory')}}" method = 'GET' class="ui form">
<div class="ui fluid action input">
<div class="field{{$errors->has('category')? ' error' : ''}}" >
<label for="">Category  <i class="users icon"></i></label>
<div class="ui left icon input">
<div>
     </div>
<select name="category_ref">
    @foreach($cs as $c)
    <option value="{{$c->ref}}">{{$c->name}}</option>
    @endforeach
    </select>
</div>
</div>
  <button class="ui blue button" type="submit">Discover</button>
</div>
<form>
</div>
</div>

@if($groups->count() == 0)
<h2>There is no groups yet in {{$category_name}}  :(</h2>
@else
<h2>Groups with category "{{$category_name}}" [{{$groups->count()}}]</h2>
@foreach($groups as $group)
<div class="ui card">
  <div class="content">
    <div class="header">
   
    <a href="{{url('group/'.$group->id)}}">{{$group->group_name}} </a>&nbsp; 
    @if(Auth::user()->role == 2 && Auth::user()->id == $group->group_owner)
    <button class="ui blue button" data-tooltip="Edit this?" id="edit-{{$group->id}}" type="button" onclick="showEditModal{{$group->id}}()"><i class="align justify icon"  ></i></button> 
   <a><i class="trash icon"></i></a>

    @endif
    </div>
  </div>
  <div class="content">
    <h4 class="ui sub header" >Group Info</h4>
    <div class="ui small feed">
      <div class="event">
        <div class="content">
          <div class="summary" data-tooltip="{{$group->description}}">
             {{str_limit($group->description, 100)}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif

<div class="col-md-2 wrapper"></div>
@endsection
