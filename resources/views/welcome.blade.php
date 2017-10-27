<!DOCTYPE html>
<html lang="en">
    <head>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
<link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('favicon/manifest.json')}}">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
		CollabUp | Collaboration at its finest
		</title>
  <style type="text/css">

    .hidden.menu {
      display: none;
    }

    .masthead.segment {
      min-height: 700px;
      padding: 1em 0em;
    }
    .masthead .logo.item img {
      margin-right: 1em;
    }
    .masthead .ui.menu .ui.button {
      margin-left: 0.5em;
    }
    .masthead h1.ui.header {
      margin-top: 3em;
      margin-bottom: 0em;
      font-size: 4em;
      font-weight: normal;
    }
    .masthead h2 {
      font-size: 1.7em;
      font-weight: normal;
    }

    .ui.vertical.stripe {
      padding: 8em 0em;
    }
    .ui.vertical.stripe h3 {
      font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
      clear: both;
    }
    .ui.vertical.stripe p {
      font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }
    .quote.stripe.segment {
      padding: 0em;
    }

    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }

    .footer.segment {
      padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
      display: none;
    }

    @media only screen and (max-width: 700px) {
      .ui.fixed.menu {
        display: none !important;
      }
      .secondary.pointing.menu .item,
      .secondary.pointing.menu .menu {
        display: none;
      }
      .secondary.pointing.menu .toc.item {
        display: block;
      }
      .masthead.segment {
        min-height: 350px;
      }
      .masthead h1.ui.header {
        font-size: 2em;
        margin-top: 1.5em;
      }
      .masthead h2 {
        margin-top: 0.5em;
        font-size: 1.5em;
      }
    }
    .landing-image {
    background-image: url('<?php echo asset("assets/collab-bg.jpg")?>') !important;
    background-size: cover !important;
    background-color: rgba(0, 0, 0, 0.5);
    
}




  </style>	
	
		<script src="{{asset('js/jquery.min.js')}}"></script>
		<script src="{{asset('js/semantic.min.js')}}"></script>
  <!--
  <script src="{{asset('js/visibility.js')}}"></script>
  <script src="{{asset('js/sidebar.js')}}"></script>
  <script src="{{asset('js/transition.js')}}"></script>
-->
  <link rel="stylesheet" type="text/css" href="{{asset('css/icon.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/semantic.min.css')}}">



</head>
<body class="landing">      
 <script type="text/javascript">
            var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 3600000); // 1 hour 

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            setInterval(refreshToken, 3600000); // 1 hour 

        </script>


<div class="ui huge top fixed hidden menu">
  <div class="ui  container">
    <a href="#home"class="active item">CollabUP</a>
    <a href="#work" class="item">About Us</a>
    <a href="#company" class="item">What is CollabUp?</a>
 
</div>
    <div class="right menu">
      <div class="item">
        
        <div class="ui buttons">
  <a class="ui purple button" href="{{url('signup')}}">Sign Up</a>
  <div class="or"></div>
  <a class="ui teal button" href="{{url('signin')}}">Login</a>
</div>

      </div>
    </div>
  </div>
</div>

<!-- Page Contents -->


<div class="pusher">
  <div class="ui inverted vertical masthead landing-image center aligned segment">

    <div  class="ui text container">
      <h1 class="ui inverted header">
      <p style="font-size: 100px">  CollabUp </p>
      </h1> 
      <h2>Collaboration at its finest.</h2>

    </div>

  </div>
<div id="start" class="ui vertical stripe segment">

 <div class="ui middle aligned stackable grid container">

      <div class="row">

        <div class="eight wide inverted column">

<form action="{{route('auth.register')}}" method="post" class="ui form" style="margin-top: -100px">
    {{csrf_field()}} 
 <h4 class="ui horizontal divider header">
  <i class="user icon"></i>
  Personal Information
</h4> 
   <br>
  <div class="ui form">
  <div class="three fields">
     
     <div class="field{{$errors->has('first_name')? ' error' : ''}}">
        <label for="">First Name</label>
        <div><input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{Request::old('first_name')}}">
        </div>
    </div>
    <div class="field{{$errors->has('middle_name')? ' error' : ''}}">
        <label for="">Middle Name</label>
        <div><input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" value="{{Request::old('middle_name')}}">			</div>
    </div>
    <div class="field{{$errors->has('last_name')? ' error' : ''}}">
        <label for="">Last Name</label>
        <div><input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{Request::old('last_name')}}">
        </div>
    </div>
    
     </div>
	</div>

  <br>
   
   <div class="ui form">
  <div class="two fields">
    
    <div class="field{{$errors->has('email')? ' error' : ''}}">
        <label for="">Email</label>
        <div><input type="email" name="email" id="email" placeholder="Email" value="{{Request::old('email')}}"></div>
    </div>
    <div class="field{{$errors->has('username')? ' error' : ''}}">
        <label for="">Username</label>
        <div><input type="text" name="username" id="username" placeholder="Username" value="{{Request::old('username')}}"></div>
    </div>    
    </div>
	</div>
   
   <div class="ui form">
  <div class="two fields">
    
    <div class="field{{$errors->has('password')? ' error' : ''}}">
        <label for="">Password</label>
        <div><input type="password" name="password" id="password" placeholder="Password"></div>
    </div>
    <div class="field">
        <label for="">Confirm Password</label>
        <div><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        </div>
    </div>
    
    </div>
	</div>
  
   
<h4 class="ui horizontal divider header">
  <i class="circle notched icon"></i>
  Captcha
</h4>
    <center>
    <div class="field{{$errors->has('g-recaptcha-response')? ' error' : ''}}">
        {!! app('captcha')->display() !!}
    </div>  
<br>
    <button type="submit" class="ui green button">Sign Me Up!</button>
     </center>
</form>

 </div>

 <div class="eight wide column ">
<h1 class="ui horizontal divider header">Already have an account?</h1>
<form action="{{route('auth.login')}}" method="post" class="ui form">
{{csrf_field()}}
    
    <div class="field{{$errors->has('email')? ' error':''}}">
        <label for="">Email</label>
        <div class="ui left icon input"><input type="email" name="email" id="email" placeholder="Email"><i class="mail icon"></i></div>
    </div>
    <div class="field{{$errors->has('password')? ' error':''}}">
        <label for="">Password</label>
        <div class="ui left icon input"><input type="password" name="password" id="password" placeholder="Password"><i class="icon lock"></i></div>
    </div>
    <br>
    <button type="submit" class="ui green button">Login</button>
</form>
    </div>

    </div>

  </div>
  </div>

<div class="ui inverted">



  <div class="ui inverted vertical footer segment">
    <div class="ui container">
      <div class="ui stackable inverted divided equal height stackable grid">
        <div class="three wide column">
          <h4 class="ui inverted header">&nbsp;</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">&nbsp;</a>

          </div>
        </div>
        <div class="three wide column">
          <h4 class="ui inverted header">Services</h4>
          <div class="ui inverted link list">
            <a href="#" class="item">&nbsp;</a>
          </div>
        </div>
        <div class="seven wide column">
          <h4 class="ui inverted header"></h4>
          <p>.</p>
        </div>
      </div>
    </div>
  </div>
</div>

	</body>
