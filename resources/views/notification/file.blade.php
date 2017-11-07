@extends('master')
@section('title')
New File! 
@endsection

@section('content')

<div class="ui styled fluid accordion">
  <div class="active title">
    <i class="dropdown icon"></i>
   <h3><a href="{{$file->view_link}}">Announcement: {{$file->file_name}} </a>    </h3>
  </div>
  <div class="active content">
    <a href="{{$file->download_link}}">Download This</a>
  </div>
  
</div>
@endsection