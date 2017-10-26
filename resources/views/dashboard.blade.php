@extends('master')

@section('title')
    Dashboard
@endsection

@section('content')
  <div class="column">
          <div class="ui grid">
            <div class="row">
              <h1 class="ui huge header">
                Dashboard
              </h1>
            </div>
            <div class="ui divider"></div>
            <div class="four column center aligned row">
              <div class="column">
                <img class="ui centered small circular image" src="{{asset('images/'.Auth::user()->image)}}" />
                <div class="ui hidden divider"></div>
                <a class="ui large green label" href="{{url('profile')}}">
                  My Profile
                </a>
                <p>
									Visit My Account Activities
                </p>
              </div>
              <div class="column">
                <img class="ui centered small circular image" src="http://www.gingercreek.org/wp-content/uploads/2014/03/small-groups-icon.png" />
                <div class="ui hidden divider"></div>
             
                  @if(Auth::user()->role == 2)
						   <a class="ui large blue label" data-tooltip="Manage Groups that you created" href="{{url('groups')}}">		
                	Manage Your Groups
								  </a>
                	@else
							   <a class="ui large blue label" data-tooltip="Visit groups that you joined">	
                	Visit Your Groups
							  </a>	
                	@endif  
                <p>
                  Visit Your Groups
                </p>
              </div>
							@if(Auth::user()->role ==1)
              <div class="column">
                <img class="ui centered small circular image" src="http://codestart.com/img/upgrade_modal/upgrade-icon.png" />
                <div class="ui hidden divider"></div>
                <a class="ui large pink label" href="{{route('upgrade')}}" data-tooltip="Do more for your account">
                  Upgrade Your Account
                </a>
                <p>
                   Change your Status And Start Making Groups
                </p>
              </div>
							@endif
              <div class="column">
                <img class="ui centered small circular image" src="http://www.appliedelectronics.com/images/calendar-icon.png" />
                <div class="ui hidden divider"></div>
                <div class="ui large red label">
                  Events
                </div>
                <p>
                  See Your Events
                </p>
              </div>
            </div>
            <div class="ui hidden section divider"></div>
            <div class="row">
              <h1 class="ui huge header">
                Upcoming Events
              </h1>
            </div>
            <div class="ui divider"></div>
            <div class="row">
  
          </div>
        </div>
      </div>
    </div>

@endsection
