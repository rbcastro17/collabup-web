

@extends('master')

@section('title')
Edit Post
@endsection

@section('content')
<br>
<h3>Edit this Post?</h3>
<br>

                <form action="{{route('status.update')}}" method="POST" class="ui large form">
                <div class="ui segment">
                {{csrf_field()}}
                   <input type="hidden" name="_method" value="PUT">
                   <input type="hidden" name="id" value="{{$post->id}}">
                   <input type="hidden" name="group_id" value="{{$group_id}}">
                    <div class ="ui two column grid">

                        <div class="field{{$errors->has('body')? ' error':''}} thirteen wide column">
                            <input type="text" name="body" id="body" placeholder="Do you have anything in mind?" value="{{$post->body}}">
                        </div>
                        <div class="field right one wide column">
                            <button type="submit" class="ui green extra huge button"><i class="chat icon"></i></button>
                        </div>
                    </div>
                </div>
                </form>
@endsection
