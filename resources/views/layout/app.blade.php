<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="shortcut icon" href="{{asset('public/images/logo/favicon.png')}}" type="image/png">

    <script src="{{ asset('assets/js/base/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/base/slick.min.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/scss/app.scss','resources/js/app.js'])

    <title>@yield('title')</title>
</head>
<body>
<div id="app">
    @include('layout.header')
{{--    @include('layout.modal.product')--}}
{{--    @include('layout.modal.add-cart')--}}
    @yield('content')
    @include('layout.footer')
    @include('layout.scroll')
</div>
</body>
</html>
