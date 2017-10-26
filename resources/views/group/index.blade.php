@extends('master')

@section('title')
Group
@endsection

@section('content')
<h2 class="ui header">
    <i class="users icon"></i>
        <div class="content">
            Groups
            <div class="sub header">More the fun</div>
        </div>
</h2>
@if(Auth::user()->role == 2)
<script>
function showCreateModal(){
  $('.ui.modal.create')
  .modal('show')
;
}
</script>

<button data-tooltip="Create a Group" class="right ui blue button" onClick="showCreateModal()"><i class="users icon"></i> Create Group</button>

<div class="ui modal create">
<div class="header">Create A Group </div>
<div class="content">
<form action="{{route('group.store')}}" method="post" class="ui form">
    {{csrf_field()}}
    <div class="field{{$errors->has('group_name')? ' error' : ''}}">
        <label for="">Group Name</label>
        <div class="ui left icon input">
            <input type="text" name="group_name" id="group_name" class="form-control" placeholder="Group Name">
            <i class="users icon"></i>
        </div>
    </div>
        <div class="field{{$errors->has('group_type')? ' error' : ''}}" >
        <label for="">Group Type  <i class="users icon"></i></label>
        <div class="ui left icon input">
        <div>
             </div>
        <select name="group_type">
            <option value="1" selected>Open</option>
              <option value="2">Closed</option>
                <option value="3" >Hidden</option>
            </select>
        </div>
     </div>

     <div class="field{{$errors->has('category')? ' error' : ''}}" >
        <label for="">Category  <i class="users icon"></i></label>
        <div class="ui left icon input">
        <div>
             </div>
        <select name="category">
            @foreach($cs as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
            </select>
        </div>
     </div>

    <div class="field{{$errors->has('description')? ' error':''}}">
        <label for="">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="resize:none"></textarea>
    </div>
    <br>
    <button type="submit" class="ui green button">Create Group</button>
</form>

</div>
</div>



@if($groups->count() == 0)
<h3>No Groups Yet</h3>
@else

    @foreach($groups as $group)
    <script>
function showEditModal{{$group->id}}(){
  $('.ui.modal.edit-{{$group->id}}')
  .modal('show')
;
}
</script>
    <div class="ui card">
  <div class="content">
    <div class="header"><a href="{{url('group/'.$group->id)}}">{{$group->group_name}} </a>&nbsp; 
    <button class="ui blue button" data-tooltip="Edit this?" id="edit-{{$group->id}}" type="button" onclick="showEditModal{{$group->id}}()"><i class="align justify icon"  ></i></button> 
   <a href="{{route('group.destroy',$group->id)}}"><i class="trash icon"></i></a>
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

<!--Modal For Edit-->
@if(Auth::user()->role== 2)
<div class="ui modal edit-{{$group->id}}">
	<div class="header">Edit This Group?</div>
	<div class="content">
 
  <form action="{{action('GroupController@update', $group->id)}}" method="post" class="ui form">
    {{method_field('put')}}
  	{{csrf_field()}}
    <div class="field{{$errors->has('group_name')? ' error' : ''}}" >
        <label for="">Group Name</label>
        <div class="ui left icon input">
            <input type="text" name="group_name" id="group_name" class="form-control" value="{{$group->group_name}}" >
            <i class="users icon"></i>
        </div>
    </div>
    <div class="field{{$errors->has('type')? ' error' : ''}}" >
        <label for="">Group Type  <i class="users icon"></i></label>
        <div class="ui left icon input">
            <select name="type">
            <option value="1"@if($group->type == 1)
                selected 
                @endif
                >Open
            </option>
            <option value="2"@if($group->type == 2)
            selected
                @endif
            >Closed
            </option>
            <option value="3" @if($group->type == 3)
                selected
                @endif
            >Hidden
            </option>
            </select>
           
        </div>
    </div>

    <div class="field{{$errors->has('group_description')? ' error' : ''}}" >
        <label for="">Group Description</label>
        <div class="ui left icon input">
            <textarea type="text"row="5" name="group_description" id="group_name" class="form-control" 
            style="resize:none"
            >{{$group->description}}</textarea>
        </div>
    </div>

    <br>
    <div class="action">
    <button type="submit" class="ui green button">Update Group's Info</button>
    </div>
</form>
  </div>
</div>
@endif
    
    @endforeach
@endif

@else
@if($groups->count() == 0)
<h3>No Groups Found</h3>
@else

@foreach($groups as $groupe)

<div class="ui link card">
  <div class="content">
    <div class="header"><a href="{{route('group.show', $groupe->group->id)}}" class="header">{{ $groupe->group->group_name }}</a></div>
    <div class="meta">
      <span class="category"></span>
    </div>
    <div class="description">
      <p></p>
    </div>
  </div>
  <div class="extra content">
    <div class="right floated author">
      <img class="ui avatar image" src="{{asset('images/'.$groupe->user->image)}}"> {{$groupe->user->first_name}}
    </div>
  </div>
</div>
<br>
<hr >

@endforeach
@endif

@endif

{{$groups->links()}}
@endsection