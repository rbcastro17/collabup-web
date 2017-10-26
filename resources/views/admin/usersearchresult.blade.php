@extends('admin')

@section('title')
Search Result for | "{{$query}}"
@endsection

@section('content')


<div class="ui two column grid container stackable">
@if($results->count() == 0)
	 <div class="ui container">
     <br>
     <br>     
     
           <div class="ui segment">
		 
             <h3 class="text-center">Your Search term found no result   </h3>

           </div> 
        </div>		
	@else	
		 <div class="ui container">
 <br>
 <div class="ui segment">
<center><h1>Users</h1></center>
<h3 class="text-center">Search result for "{{$query}}"   </h3>
 </div> 
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
  <form action="{{action('GroupController@showsearchmemberresult')}}" method = 'GET'>
<div class="ui fluid action input">		
  <input type="text" name="search" placeholder="Search Members...">
  <button class="ui button" type="submit">Search</button>
</div>
<form>
</div>
</div>

@foreach($results as $result)		

<div class="ui middle aligned divided list">
<div class="item">
    <div class ="right floated content">
    
    @if($result->active == 1)

<a class="ui button" href="{{route('account.deactivate.admin',$result->id)}}">Deactivate</a>
@else
<a class="ui button" href="{{route('account.activate.admin',$result->id)}}">Activate</a>
@endif

    </div>
    <img class="ui avatar image" src="/images/{{$result->image}}"/>
    <div class="content">
{{$result->first_name. " ". $result->last_name}}
    </div>
   </div> 
</div>
@endforeach
</div>
@endif		 
    
</div>	 
<div class="col-md-2 wrapper"></div>
@endsection