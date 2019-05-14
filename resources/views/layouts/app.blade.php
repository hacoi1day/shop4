<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{ asset('') }}">
    <title>Shop | @yield('title')</title>

    {{--    Load Boostrap--}}
    <link rel="stylesheet" href="asset/lib/bootstrap/bootstrap.min.css">


    {{--    Load font-awesome--}}
    <link rel="stylesheet" href="asset/lib/font-awesome/css/all.css">
    <script src="asset/lib/font-awesome/js/all.js"></script>
    {{--    ckeditor--}}
    <script src="ckeditor/ckeditor.js"></script>
    {{--    ckfinder--}}
    <script src="ckfinder/ckfinder.js"></script>

    <link rel="stylesheet" href="asset/css/style.css">

    @yield('css')
</head>
<body>
    @include('layouts.components.navbar')

    @include('layouts.components.search')

    @yield('content')

    @include('layouts.components.footer')

    @yield('js')

    <script src="asset/lib/bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="asset/lib/bootstrap/popper.min.js"></script>
    <script src="asset/lib/bootstrap/bootstrap.min.js"></script>
</body>
</html>