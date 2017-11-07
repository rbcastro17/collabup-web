
<script src="//code.jquery.com/jquery.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"> </script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <div class="ui fixed inverted menu">
    <div class="ui container">
      <a href="{{url('/')}}" class="header item">
        <i class="cloud blue icon"></i>
        CollabUp
      </a>
      <a href="{{url('/')}}" class="item">Home</a>
    
      <script>

   var pusher = new Pusher('5d377285b7b6c50f7729', {
        encrypted: true,
        cluster: 'ap1'
      });
      
      var channel = pusher.subscribe('{{Auth::user()->id}}');
  
</script>
      <?php
      $notif = App\AppNotification::where([['reciever_id', '=', Auth::user()->id], ['unread', '=', true]])->get();
      $notifCount = $notif->count();
      ?>
      <script>
      channel.bind('App\\Events\\SendAppNotification', function(data){
        var ExistingNotif = Number(document.getElementById("notif-count").innerHTML);

        var currCount = ExistingNotif + 1 ;
        toastr.success('New Notification');
        
        document.getElementById("notif-count").innerHTML= currCount;
        
  });
      </script>
      
      <a href="{{url('notifications')}}" class="item" ><i class="alarm icon"> 
      

      <span id="notif-count" class="badge">{{$notif->count()}}</span>
      
      </i></a>
<div class="item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
@if(Auth::check())

@if(Auth::user()->role != 3)
<form action="{{action('GroupController@showsearchresult')}}" method="GET">
<div class="ui tiny icon input">
  <input type="text" name="search" placeholder="Search...">
  <button class="ui button" type="submit">Search</button>
</div>
</form>
@endif
      <div class="ui simple right dropdown item">
      <img class="ui avatar image" src="{{asset('images/'.Auth::user()->image )}}">
        {{Auth::user()->first_name." ".Auth::user()->last_name}}
        <i class="dropdown icon"></i>
        <div class="menu">
        @if(Auth::user()->role == 1)
          <a class="item" href="{{route('upgrade')}}">Upgrade Your Account</a>
         
        @endif
          <a class="item" href="{{route('account.edit', Auth::user()->id)}}">Your Profile</a>
          <div class="divider"></div>
          <div class="header">Header Item</div>
          <div class="item">
            <i class="dropdown icon"></i>
            About CollabUp
            <div class="menu">
              <a class="item" href="#">Project Overview</a>
              <a class="item" href="#">Terms and Condition</a>
            </div>
          </div>
          <a class="item" href="{{route('logout')}}">Logout</a>
        </div>
      </div>
      @endif
    </div>
  </div>