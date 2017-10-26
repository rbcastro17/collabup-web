<!DOCTYPE html>
<html lang="">
    <head>
	<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @include('partials.css')
    </head>
    <body>
        {{-- Navigation --}}
        @include('partials.navigation')
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
                    @include('partials.alert')
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="//code.jquery.com/jquery.js"></script>
        @include('partials.js')
    </body>
</html>
