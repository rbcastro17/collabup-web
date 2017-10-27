@extends('master')

@section('title')
Edit Folder
@endsection

@section('content')
<br>
<br>
<br>

<form action="{{route('update.folder')}}" method="post" class="ui form">
    {{csrf_field()}}
   <input type ="hidden" name="group_id" value="{{$group_id}}"> 
    <input type="hidden" name="_method" value="put"/>
    <input type="hidden" name="id" value ="{{$folder->id}}">
    <div class="field{{$errors->has('name')? ' error' : ''}}">
        <label for="">Folder Name</label>
        <div class="ui left icon input">
            <input type="text" name="name" id="name" class="form-control" placeholder="Folder Name" 
            value="{{$folder->name}}">
            <i class="users icon"></i>
        </div>
    </div>
    
    <div class="field{{$errors->has('name')? ' error' : ''}}">
        <label for="">Folder Description</label>
        <div class="ui left icon input">
            <textarea type="text" name="description" id="description" class="form-control" placeholder="Description" 
            style="resize:none">{{$folder->description}}</textarea>
        </div>
    </div>

    <br>

    <button type="submit" class="ui green button">Create Folder</button>
</form>
@endsection