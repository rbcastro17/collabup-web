<!DOCTYPE html>
<html lang="en">
    <head>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
<link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/favicon/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/favicon/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/favicon/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicon/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/favicon/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/favicon/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/favicon/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/favicon/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/favicon/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
<link rel="manifest" href="/manifest.json">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
	

 <script>
  $(document)
    .ready(function() {

      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;
      // create sidebar and attach to menu open
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;

    })
  ;
  </script>

<!-- Smooth Scrolling JS-->
<script>
window.scroll({
  top: 2500, 
  left: 0, 
  behavior: 'smooth' 
});

window.scrollBy({ 
  top: 100, // could be negative value
  left: 0, 
  behavior: 'smooth' 
});

document.querySelector('.hello').scrollIntoView({ 
  behavior: 'smooth' 
});

</script>
<script>

$(function() {
	var $window = $(window), $document = $(document),
		transitionSupported = typeof document.body.style.transitionProperty === "string", // detect CSS transition support
		scrollTime = 1; // scroll time in seconds

	$(document).on("click", "a[href*=#]:not([href=#])", function(e) {
		var target, avail, scroll, deltaScroll;
    
		if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
			target = $(this.hash);
			target = target.length ? target : $("[id=" + this.hash.slice(1) + "]");

			if (target.length) {
				avail = $document.height() - $window.height();

				if (avail > 0) {
					scroll = target.offset().top;
          
					if (scroll > avail) {
						scroll = avail;
					}
				} else {
					scroll = 0;
				}

				deltaScroll = $window.scrollTop() - scroll;

				// if we don't have to scroll because we're already at the right scrolling level,
				if (!deltaScroll) {
					return; // do nothing
				}

				e.preventDefault();
				
				if (transitionSupported) {
					$("html").css({
						"margin-top": deltaScroll + "px",
						"transition": scrollTime + "s ease-in-out"
					}).data("transitioning", scroll);
				} else {
					$("html, body").stop(true, true) 
					.animate({
						scrollTop: scroll + "px"
					}, scrollTime * 1000);
					
					return;
				}
			}
		}
	});

	if (transitionSupported) {
		$("html").on("transitionend webkitTransitionEnd msTransitionEnd oTransitionEnd", function(e) {
			var $this = $(this),
				scroll = $this.data("transitioning");
			
			if (e.target === e.currentTarget && scroll) {
				$this.removeAttr("style").removeData("transitioning");
				
				$("html, body").scrollTop(scroll);
			}
		});
	}
});
</script>

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


<div class="ui large top fixed hidden menu">
  <div class="ui container">
    <a href="#home"class="active item">Home</a>
    <a href="#work" class="item">About Us</a>
    <a href="#company" class="item">What is CollabUp?</a>
    <a href="#contact" class="item">Contact Us</a>
   
 
</div>
    <div class="right menu">
      <div class="item">
        <a class="fluid ui button" href="#start">Log in</a>
      </div>
      <div class="item">
        <a class="ui primary button" href="#start">Sign Up</a>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
  <a href="#home" class="active item">Home</a>
  <a href="#work" class="item">Work</a>
  <a href="#contact" class="item">Careers</a>
   <div class="ui huge icon input">
  <input type="text" placeholder="Search...">
  <div class="ui button">
  <p style="font-size:18px;">
  Search
  </p>
  </div>
</div>
   <div class="right menu">
      <div class="item">
        <a href="#start" class="ui button" href="/signin">Log in</a>
      </div>
      <div class="item">
        <a href="#start"class="ui primary button" href="#start">Sign Up</a>
      </div>
    </div>
</div>


<!-- Page Contents -->
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment">

    <div id="home" class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
        <a href="#home"class="active item">Home</a>
        <a href="#work"class="item">Work</a>
 
        <a href="#contact"class="item">Contact Us</a>
        <div class="right item">
          <a href ="#start"class="ui inverted button">Log in</a>
          <a href = "#start"class="ui inverted button">Sign Up</a>
        </div>
      </div>
    </div>

    <div  class="ui text container">
      <h1 class="ui inverted header">
        CollabUp
      </h1>
      <h2>Collaboration at its finest.</h2>
      <div class="ui huge primary button">Edited <i class="right arrow icon"></i></div>
    </div>

  </div>
<div id="start" class="ui vertical stripe segment">

 <div class="ui middle aligned stackable grid container">

      <div class="row">

        <div class="eight wide column">

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
      
  <div id="work" class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
      <div class="sixteen wide column">
        <H3>FORGET PASSWORD</H3>
      <form action="{{route('sendforgetcode')}}" method="post" class="ui form">
{{csrf_field()}}
    
    <div class="field{{$errors->has('email')? ' error':''}}">
        <label for="">Email</label>
        <div class="ui left icon input"><input type="email" name="email" id="email" placeholder="Email"><i class="mail icon"></i></div>
    </div>
    <br>
    <button type="submit" class="ui green button">Send</button>
</form>

</div>
      </div>
    </center>
    </div>
  </div>



  <div id="contact" class="ui vertical stripe segment">
    <div class="ui text container">
      <h3 class="ui header">Contact Us</h3>
     <p>Input fields here</p>
    
    </div>
  </div>


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
