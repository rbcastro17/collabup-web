
        <div class="column" id="sidebar">
        <div class="ui secondary vertical fluid menu">
          @if(Auth::user()->role == 3)
          <a class="item" href="{{url('admin/dashboard')}}">Dashboard</a> 
          <a class="item" href="{{url('audit')}}">Audit Trail </a>
          <a href="{{route('addAdminPage')}}" class="item">Add Admin</a>
          <a href="{{route('ViewAdmins')}}" class="item">List of Admins</a>
          <a href="{{url('allusers')}}" class="item">View App Users</a>
          <a href="{{url('categories')}}" class="item"> Manage Categories</a>
	  @else
          <a class="item" href="{{url('dashboard')}}">Dashboard</a>
          @endif
          <a class="item" href="{{url('profile')}}">My Profile</a>
          @if(Auth::user()->role == 2)
          <a class="item" href="{{url('groups')}}">Manage Groups</a>
          <a class="item" href="{{url('calendar')}}">Manage Events</a> 
          @elseif(Auth::user()->role == 1)
          <a class="item" href="{{url('groups')}}">My Groups</a>
          <a class="item" href="{{url('discover/category')}}">Discover!</a>
          <a class="item" href="{{url('calendar')}}">Events</a> 
          @endif
          @if(Auth::user()->role =1 || Auth::user()->role = 2)
          <a class="item" href="{{route('current.announcement')}}">Announcements</a>
         
        @endif

        </div>
        </div>
  <style type="text/css">
    body {
      display: relative;
    }
    
    #sidebar {
      position: fixed;
      top: 51.8px;
      left: 0;
      bottom: 0;
      width: 18%;
      background-color: #f5f5f5;
      padding: 0px;
    }
    #sidebar .ui.menu {
      margin: 2em 0 0;
      font-size: 16px;
    }
    #sidebar .ui.menu > a.item {
      color: #337ab7;
      border-radius: 0 !important;
    }
    #sidebar .ui.menu > a.item.active {
      background-color: #337ab7;
      color: white;
      border: none !important;
    }
    #sidebar .ui.menu > a.item:hover {
      background-color: #4f93ce;
      color: white;
    }
    
    #content {
      margin-left: 19%;
      width: 81%;
      margin-top: 3em;
      padding-left: 3em;
      float: left;
    }
    #content > .ui.grid {
      padding-right: 4em;
      padding-bottom: 3em;
    }
    #content h1 {
      font-size: 36px;
    }
    #content .ui.divider:not(.hidden) {
      margin: 0;
    }
    #content table.ui.table {
      border: none;
    }
    #content table.ui.table thead th {
      border-bottom: 2px solid #eee !important;
    }
  </style>