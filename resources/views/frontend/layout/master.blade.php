<!DOCTYPE html>
<html lang="ar">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.layout.head')
</head>
<body>
<!-- end navbar  -->
@include('frontend.layout.header')
<input type="hidden" value="{{URL::to('/')}}" id="base_url">
@section('frontend-main')
@show
@include('frontend.layout.footer')
</body>
</html>