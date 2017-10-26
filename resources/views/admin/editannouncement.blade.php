@extends('admin')

@section('title')
Announcement Page
@endsection

<br>
<br>
<br>
<br>

@section('content')
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
        <div class="ui container">
            <div class="wrapper">
                <form action="{{action('AnnouncementController@update', $a->id)}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                <input type="hidden" name="_method" value='PUT'>
                    <div class ="ui two column grid">
                    
                        <div class="field{{$errors->has('title')? ' error':''}} thirteen wide column">
                    <label>Title</label>
                            <input type="text" name="title" id="body" placeholder="Your Title" value="{{$a->title}}">
                        </div>
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                           <label>Body</label>
                            <textarea name="body" id="body"   style="resize:none">{{$a->body}}</textarea>
                        </div>

                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>
           </div>
        </div>
      
    </div>
</div>
<div class="col-md-2 wrapper"></div>
@endsection