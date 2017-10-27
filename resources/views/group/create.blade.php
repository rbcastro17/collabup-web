@extends('master')

@section('title')
Create Group
@endsection

@section('content')

<br>
<br>

<form action="{{route('group.store')}}" method="post" class="ui form">
    {{csrf_field()}}
    <div class="field{{$errors->has('group_name')? ' error' : ''}}">
        <label for="">Group Name</label>
        <div class="ui left icon input">
            <input type="text" name="group_name" id="group_name" class="form-control" placeholder="Group Name">
            <i class="users icon"></i>
        </div>
    </div>
        <div class="field{{$errors->has('group_limit')? ' error' : ''}}" >
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

    <div class="field{{$errors->has('description')? ' error':''}}">
        <label for="">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="resize:none"></textarea>
    </div>
    <br>
    <button type="submit" class="ui green button">Create Group</button>
</form>
@endsection