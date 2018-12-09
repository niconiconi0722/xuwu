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
    </head>
    <body>
        <div>

            @include('layouts._header')

            <!-- main -->
            <div class="main">
				<div class="col-sm-2">
					<ul class="list-group menu">
						<a href="/articles/" class="forum list-group-item">论坛</a>
						<a href="#" class="room list-group-item">聊天室</a>
						<a href="#" class="none list-group-item">...</a>
						<a href="#" class="none_ list-group-item">...</a>
					</ul>
<!--
					<nav class="menu_main">
						<ul class="menu">
							<li class="forum"><a href="#">论坛</a></li>
							<li class="room"><a href="#">聊天室</a></li>
							<li class="none"><a href="#">...</a></li>
							<li class="none_"><a href="#">...</a></li>
						</ul>
					</nav>
					-->
					<!--tool-->
					<div class="tool clearflx">
						<div class="row">
							<div class="col-sm-6 
								@auth
									{{ Auth::user()->notification_count > 0 ? 'notifications-toggle' : 'notifications-default' }}
								@endauth
							">
								<a href="{{ route('notifications.index') }}">
									<img src="/img/ring.png">
								</a>
							</div>
							<div class="col-sm-6 tieba">
								<a href="https://tieba.baidu.com/f?kw=%E8%99%9A%E6%97%A0_ain&ie=utf-8" target="_blank">
									<img src="/img/tie.png">
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 letter">
								<a href="#">
									<img src="/img/letter.png">
								</a>
							</div>
							<div class="col-sm-6 link">
								<a href="#">
									<img src="/img/link.png">
								</a>
							</div>
						</div>
						<!--<ul class="tool_left">
							<li class="ring"><a href="{{ route('notifications.index') }}">
								<span class="
									@auth
										{{ Auth::user()->notification_count > 0 ? 'notifications-toggle' : 'notifications-default' }}
									@endauth
								">
									<img src="/img/ring.png">
								</span>
							</a></li>
							<li class="tieba"><span><img src="/img/tie.png"></span></li>
						</ul>
						<ul class="tool_right">
							<li class="letter"><span><img src="/img/letter.png"></span></li>
							<li class="link"><a href="https://tieba.baidu.com/f?kw=%E8%99%9A%E6%97%A0_ain&ie=utf-8"><span><img src="/img/link.png"></span></a></li>
						</ul>-->
					</div>
				</div >
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
		<script src="/js/query.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
		<script src="/js/app.js"></script>
        @yield('script')
    </body>
</html>
