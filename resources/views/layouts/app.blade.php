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
        @yield('css')
    </head>
    <body>
        <div class="container">
            <div class="row">
                @include('layouts._header')
            </div>

            <div class="row">
				<div class="col-sm-2">
                    @include('layouts._nav')
				</div>
                <div class="col-sm-8">
					<nav class="content">
						<nav class="main_forum">
							@include('common.error')
							@include('common.message')
							@yield('content')
							<ul></ul>
						</nav>
						<nav class="chartroom">
							<ul></ul>
						</nav>
						<nav class="wu">
							<ul></ul>
						</nav>
						<nav class="wu">
							<ul></ul>
						</nav>
					</nav>
				</div>
				<div class="col-sm-2">
					<!--chart-->
					<nav class="chart">

					</nav>
				</div>
            </div>
        </div>

		<script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
		<script src="/js/app.js"></script>
        <script src="/js/jquery.blink.js"></script>
        @yield('script')
    </body>
</html>