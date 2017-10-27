@extends('master')

@section('title')
Search Result For "{{$query}}" | CollabUp
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

<h3>Search Groups</h3>
@if($result->count() == 0)

<h3>0 matches for: {{$query}} </h3>
@else 
<div class="ui middle aligned divided list">
 <h3>{{$result->count(). " " .str_plural('match', $result->count())}}  for: {{$query}} </h3>
 @foreach($result as $results)
  <div class="item">
    <div class="right floated content">
    @if(Auth::user()->role == 1)
    @if($results->type == 1)
      <a class="ui teal button" href="{{route('group.show', $results->id)}}">View</a>
     @else
      <button class="ui teal button" disabled>View</button>
     @endif 
     @else
     <?php
     $gid = $results->id;
     ?>
 <a class="ui teal button" href="{{route('group.show', $results->id)}}">View</a>     
     @endif

    </div>
    <i class="group icon"> </i>
    <div class="content">
      <b>{{$results->group_name}}</b>

    </div>
  </div>
  @endforeach
  </div>
@endif

</div>
</div>

<div class="col-md-2 wrapper"></div>
@endsection
