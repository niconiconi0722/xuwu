<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', '虚无')</title>

        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/css.css">
        <link rel="stylesheet" href="/css/particles.css">
        @yield('css')
    </head>
    <body>
        <div id="particles-js"></div>
        <div class="container-fluid">
            <div class="cb-slideshow-text-container">
                @yield('content')
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/particles.js"></script>
        @yield('script')
    </body>
</html>