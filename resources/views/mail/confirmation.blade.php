<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test Confirmation</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="text-center">Hello {{$name}}</h1>
        <div class="container">
            <div class="wrapper">
                <h3 class="text-center">Email Confirmation</h3>
                <h5>Welcome to the CollabUp Family</h5>
				<a href="{{route('activate', ['code' => $code])}}">Confirm my account</a>
            </div>
        </div>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
