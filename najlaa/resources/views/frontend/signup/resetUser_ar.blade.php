<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>كود اعادة تعيين الرقم السري</title>
</head>
<body style="text-align: center">
<h2>
    مرحبا بكـ في نجلاء
    <br>
    {{$user['name']}}
</h2>
<br/>
بريدك الخاص هو
<br/>
 {{$user['email']}}
<br/>
<br/>
كود اعادة تعيين الرقم السري الخاص بكـ
<br/>
 <h1 style="color: darkred"> {{ $code }} </h1>
</body>
</html>