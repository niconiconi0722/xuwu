@extends('layouts.app')

@section('content')
	<div class="article">
		<h1>论坛</h1>
		<hr>
		@if (count($articles))
			<div class="container-fluid">
				<ul class="nav order">
					<li><a href="{{ Request::url() }}?order=default">最新发布</a></li>
					<li><a href="{{ Request::url() }}?order=reply">最后回复</a></li>
					<li>
					@if (Auth::check())
						<a href="{{ route('articles.create') }}">发布新贴</a>
					@else
						<a href="{{ route('articles.create') }}">登录并发布新贴</a>
					@endif
					</li>
				</ul>
			</div>			
			<table class="table table-hover">
				<thead>
					<th>标题</th>
					<th>发布时间</th>
					<th>回复时间</th>
					<th></th>
				</thead>
			    <tbody>
					@foreach ($articles as $article)
						@include('articles._article_list')
					@endforeach
			    </tbody>
			</table>
			{{ $articles->appends(Request::except('page'))->links() }}
		@endif

		
	</div>
@endsection
