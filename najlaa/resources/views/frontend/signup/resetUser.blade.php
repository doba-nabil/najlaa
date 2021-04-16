<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password Code</title>
</head>
<body style="text-align: center">
<h2>
    Welcome to Najla
    <br>
    {{$user['name']}}
</h2>
<br/>
Your registered email-id is
<br/>
 {{$user['email']}}
<br/>
<br/>
Reset Code
<br/>
 <h1 style="color: darkred"> {{ $code }} </h1>
</body>
</html>