@extends('master')

@section('title')
Discover Groups | CollabUP Collaborations at its finest
@endsection

@section('content')
<br>
<br>
<h2>Discover New Groups!</h2>
<script src="{{asset('js/jquery.min.js')}}"></script>

<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
  <form action="{{action('GroupController@discoverbycategory')}}" method = 'GET' class="ui form">
<div class="ui fluid action input">
<div class="field{{$errors->has('category')? ' error' : ''}}" >

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

<div class="col-md-2 wrapper"></div>
@endsection
