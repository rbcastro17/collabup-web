@extends('master')

@section('title')
Edit Group
@endsection

@section('content')

<br>
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

        <div class="field{{$errors->has('group_limit')? ' error' : ''}}" >
        <label for="">Group Limit  <i class="users icon"></i></label>
        <div class="ui left icon input">
                      <select name="group_limit">
           @for ($i = 1; $i < 100; $i++)    
           @if($group->group_limit == $i)  
            <option value="{{$i}}" selected>{{$i}}</option>
           @else
<option value="{{$i}}" >{{$i}}</option>
           @endif 
            @endfor
            </select>
        </div>
    </div>


    <div class="field{{$errors->has('group_name')? ' error' : ''}}" >
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
    <button type="submit" class="ui green button">Update</button>
</form>
@endsection