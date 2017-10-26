@extends("admin")

@section('title')
Audit Trail | CollabUP
@endsection

@section('content')
<br>
<br>
<h3>Audit Trail</h3>
@foreach($audits as $audit)

        <div class="ui list segment">
           <div class="item">
                  <img class="ui avatar image" src="{{url('images').'/'. $audit->user->image}}">
                  <div class="content">
                    <div class="header" data-tooltip="View Profile Of {{$audit->user->first_name}}"></div>
                    <div class="description">
                    <small>Last Edited</small> {{$audit->updated_at->diffForHumans()}} </i>
                    
                    <p>{{$audit->description}}</p></div>
                  </div>
            </div>
            </div>
@endforeach

@endsection
