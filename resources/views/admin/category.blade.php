@extends('admin')

@section('title', 'Application Management | Manage Categories')

@section('content')

<h2 class="ui header">
    <i class="users icon"></i>
        <div class="content">
            Categories <a onclick="createCategoryModal()"> <i class="add circle icon"></i>    </a>
            <div class="sub header">Sorting Collaborations</div>
        </div>
</h2>
<br>
<br>
<script>
function createCategoryModal(){
    $('.ui.modal.create')
  .modal('show');

}
</script>
@foreach($categorys as $category)
<script>
function showdeletemodal{{$category->ref}}(){
    $('.ui.basic.modal.{{$category->ref}}')
  .modal('show');
}
</script>
@endforeach


<div class="ui modal create">
  <i class="close icon"></i>
  <div class="header">
    Create A Category
  </div>
    <div class="content">
    <form action="{{action('AdminController@storecategory')}}" method="post" class="ui form">
    {{csrf_field()}}
    <div class="field{{$errors->has('category_name')? ' error' : ''}}">
        <label for="">Category Name</label>
        <div class="ui left icon input">
            <input type="text" name="category_name" id="group_name" class="form-control" placeholder="Category Name Here...">
            <i class="users icon"></i>
        </div>
    </div>

    <div class="field{{$errors->has('category_description')? ' error':''}}">
        <label for="">Category Description</label>
        <textarea name="category_description" id="description" cols="30" rows="10" class="form-control" style="resize:none"></textarea>
    </div>
    <br>
    <button type="submit" class="ui green button">Create Category</button>
</form>
    </div>
</div>

@if($categorys->count() == 0)
<h2>No Categories Yet! <a onclick="createCategoryModal()">Create one now! <i class="add circle icon"></i>    </a></h2>
@else


@foreach($categorys as $category)
<div class="ui image label">
  <img src="{{asset('images/category.png')}}">
  {{$category->name}}
  <a onclick="showdeletemodal{{$category->ref}}()"><i class="delete icon"></i></a>
</div>

<div class="ui basic modal {{$category->ref}}">
  <div class="ui icon header">
    <i class="archive icon"></i>
    Delete this Category? {{$category->name}}
  </div>
  <div class="content">
    <p>Deleting this category can cause complaints to application users that are using this tag</p>
  </div>
  <div class="actions">
    <div class="ui red basic cancel inverted button">
      <i class="remove icon"></i>
      No
    </div>
    <a class="ui green ok inverted button" href="{{route('delete.category',$category->id)}}">
      <i class="checkmark icon"></i>
      Yes
    </a>
  </div>
</div>
@endforeach
@endif


@endsection
