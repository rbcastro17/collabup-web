@extends('master')

@section('title')

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Notifications</div>

                <div class="panel-body">
                        <ul class="list-group">
                              
							  @foreach($nots as $not)
							  
							  <div class="ui list">
  <div class="item">
    <img class="ui avatar image" src="{{URL::to('/')}}/images/Capture.jpg">
    <div class="content">
      <a class="header">{{$not->data['name']}}</a>
      <div class="description">{{$not->data['message']}} <a>
	  <!--
	  <b>Arrested Development</b>
	  -->
	  </a> {{$not->created_at->diffForHumans()}}</div>
    </div>
  </div>
  </div>
							  <!--
                                    <li class="list-group-item">
                                           {{ $not->data['name'] }} &nbsp; {{ $not->data['message'] }} <span class="pull-right">{{ $not->created_at->diffForHumans() }}</span>
                                    </li>
                              -->
							  @endforeach
                        </ul>
                </div>
            </div> 	
        </div>
    </div>
</div>
@endsection
