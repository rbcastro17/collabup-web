<!DOCTYPE html>
<html lang="en">
    <head>
	<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @include('partials.css')

        @yield('head-js')
    </head>
    <body>
        {{-- Navigation --}}
        @include('partials.navigation')
        {{-- Content--}}
        <div class="ui two column grid stackable container">
            @if(Auth::check())
            <div class="two wide column">
                <br>
                <br>
                @include('partials.side-navigation')
            </div>
           
            <div class="fourteen wide centered column">
                    @include('partials.alert')
                    <br>
                    @yield('content')
            </div>
              
        </div>
        <script src="//code.jquery.com/jquery.js"></script>
        @include('partials.js')
        @endif
    </body>
</html>
