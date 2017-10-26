<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <title>@yield('title')</title>
        @include('partials.css')
		
    </head>
    <body >
	<div id="app">
        {{-- Navigation --}}
        @include('partials.out-navigation')
        {{-- Content--}}
        <div class="ui two column grid stackable container">
            @if(Auth::check())
            <div class="four wide column">
                <br>
                <br>
                <br>
                <br>
                <br>
                @include('partials.side-navigation')
            </div>
            @endif
            <div class="twelve wide centered column">
                <div class="wrapper">
                    {{-- Main Content --}}
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    @if(Auth::check())
                    @include('partials.alert')
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>

        @if(Auth::check())
        <notification></notification>
        @endif

        <script src="/js/app.js"></script>
        <script src="/js/semantic.min.js"></script>        
        <script src="{{asset('js/jquery.min.js')}}"></script>
        @include('partials.js')
        </div>
    </body>
</html>
