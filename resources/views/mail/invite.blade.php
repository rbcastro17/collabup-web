<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1 class="text-center">Hello World</h1>
        <div class="container">
            <div class="wrapper">
                <h3 class="text-center">You've been invited</h3>
                <h5>Hello you have been in invited to join a group in collabup. Click the link bellow to join</h5>
                <a href="{{route('invite.active',['id'=>$code,'email'=>$email])}}">Click me</a>
            </div>
        </div>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
