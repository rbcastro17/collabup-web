@extends('master')

@section('title')
Members 
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@section('content')

<div class="ui two column grid container stackable">
@if($members->count() == 0)
	 <div class="ui container">
     <br>
     <br>     
     
           <div class="ui segment">
		 
             <h3 class="text-center">This group has no members yet.   </h3>

           </div> 
        </div>		
	@else	
		 <div class="ui container">
 <br>
 <div class="ui segment">
<center><h1>Members</h1></center>
 </div> 
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
  <form action="{{action('GroupController@showsearchmemberresult')}}" method = 'GET'>
<div class="ui fluid action input">
   <input type="hidden" name="group" value="$group">		
  <input type="text" name="search" placeholder="Search Members...">
  <button class="ui button" type="submit">Search</button>
</div>
<form>
</div>
</div>
 <div class="ui segment">
		
		<a href="{{url('profile')}}"> {{$group_info->first_name . ' '. $group_info->last_name}} </a><h3> -- Owner --</h3>


           </div> 

@foreach($members as $member)		

 <div class="ui segment">
		 @if($member->email == $group_info->email)
		 {{$member->email}} <h3> -- Owner --</h3>
		@else
    	  <a href="{{route('group.member.profile', $member->user_id)}}">{{$member->user->first_name. " ". $member->user->last_name}} </a>
       @endif
         @if(Auth::user()->role==2 )
    &nbsp; &nbsp; &nbsp; &nbsp; 
    <form action="{{route('member.delete', $member->user_id)}}" method="POST">
    {{csrf_field()}}

    <input type = "hidden" name="id" value="{{$member->user_id}}">

    <a class="ui red button" href="{{route('member.delete', $member->user_id)}}"> Remove </a>
    </form>
    @endif  
           </div> 
@endforeach
</div>
@endif		 
    
</div>	 
<div class="col-md-2 wrapper"></div>
@endsection
