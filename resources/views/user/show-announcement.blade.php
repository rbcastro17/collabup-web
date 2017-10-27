@extends('master')

@section('title')
Announcements as of <?php
$mytime = Carbon\Carbon::now();
echo $mytime->toFormattedDateString();
?>

@endsection

@section('content')

@if(Auth::user()->role== 3)
<div class="ui two column grid container stackable">
    <div class="thirteen wide column">
        <div class="ui container">
            <div class="wrapper">
                <form action="{{action('AnnouncementController@store')}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                    <div class ="ui two column grid">
                    
                        <div class="field{{$errors->has('title')? ' error':''}} thirteen wide column">
                    <label>Title</label>
                            <input type="text" name="title" id="title" placeholder="Your Title" value="{{Request::old('title')}}">
                        </div>
                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                           <label>Body</label>
                            <textarea name="body" id="body"   style="resize:none">{{Request::old('body')}}Something to Announce</textarea>
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
<h3>
Announcements as of <?php
$mytime = Carbon\Carbon::now();
echo $mytime->toFormattedDateString();
?>
</h3>
@if($anns->count() == 0 )
<h4>There are no announcement(s) yet. (┛◉Д◉)┛彡┻━┻</h4>

@else
@foreach($anns as $ann)
<div class="ui relaxed divided list">
  <div class="item">
    <i class="large github middle aligned icon"></i>
    <div class="content">
      <a class="header">{{$ann->title}}</a>
      <div class="description">{{str_limit($ann->body,100)}}</div>

      <div class="description">{{$ann->updated_at->diffForHumans()}}</div>1
    </div>  
    <br>
      <a class="item" href="{{route('ann.edit',$ann->id)}}">Edit</a>&nbsp; &nbsp; | &nbsp;&nbsp;<a class="item" href="{{route('ann.destroy',$ann->id)}}">Delete</a>
  </div>  
  </div>
@endforeach

@endif
@else

<h2>
Announcements as of <?php
$mytime = Carbon\Carbon::now();
echo $mytime->toFormattedDateString();
?>
</h2>
@if($anns->count() == 0)
<h3>There are no announcements yet (┛◉Д◉)┛彡┻━┻
</h3>
@else
@foreach($anns as $ann)

<div class="ui relaxed divided list">
  <div class="item">
    <i class="large github middle aligned icon"></i>
    <div class="content">
      <a class="header">{{$ann->title}}</a>
      <div class="description">{{str_limit($ann->body,100)}}</div>
      <div class="description">{{$ann->updated_at->diffForHumans()}}</div>
    </div>
  </div>
  </div>
@endforeach
@endif

@endif

<center>{{$anns->links()}}</center>
@endsection
