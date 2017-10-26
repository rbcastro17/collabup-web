@extends('master')

@section('title')
Create Folder
@endsection

@section('content')
<br>
<br>
<br>

<form action="{{route('do.folder',$group->id)}}" method="post" class="ui form">
    {{csrf_field()}}
    <div class="field{{$errors->has('name')? ' error' : ''}}">
        <label for="">Folder Name</label>
        <div class="ui left icon input">
            <input type="text" name="name" id="name" class="form-control" placeholder="Folder Name">
            <i class="users icon"></i>
        </div>
    </div>
        <div class="field{{$errors->has('name')? ' error' : ''}}">
        <label for="">Folder Description</label>
        <div class="ui left icon input">
            <textarea type="text" name="description" id="description" class="form-control" placeholder="Folder Name"
             style="resize:none"
            >
            </textarea>
            
        </div>
    </div>
    <br>
    <button type="submit" class="ui green button">Create Folder</button>
</form>
@endsection