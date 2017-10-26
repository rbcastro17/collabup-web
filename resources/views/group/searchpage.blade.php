@extends('master')

@section('title')
Search Groups | CollabUp - Collaboration at its finest.
@endsection


<script src="{{asset('js/jquery.min.js')}}"></script>
@section('content')
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
  <form action="{{action('GroupController@showsearchresult')}}" method = 'GET'>
<div class="ui fluid action input">
  <input type="text" name="search" placeholder="Search...">
  <button class="ui button" type="submit">Search</button>
</div>
<form>
</div>
</div>

<div class="col-md-2 wrapper"></div>
@endsection
