@extends('admin')

@section('title')
Dashboard | {{Auth::user()->first_name. " ". Auth::user()->last_name}}
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
                <img class="ui centered small circular image" src="{{asset('images/category.png')}}" />
                <div class="ui hidden divider"></div>
             
			   <a class="ui large blue label" data-tooltip="Manage these Categories" href="{{url('categories')}}">		
                	Categories</a>

                <p>
                 Manage Collaborative Categories
                </p>
              </div>
            
            
            
            
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
             
			   <a class="ui large blue label" data-tooltip="Manage Groups that you created" href="{{url('groups')}}">		
                	Audit Trail</a>

                <p>
                  View Administrator's Activities
                </p>
              </div>

              <div class="column">
                <img class="ui centered small circular image" src="http://www.appliedelectronics.com/images/calendar-icon.png" />
                <div class="ui hidden divider"></div>
                <div class="ui large red label">
                  Statistics
                </div>
                <p>
                  View the Site's  Statistics
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
