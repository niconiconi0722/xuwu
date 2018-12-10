@extends('layouts.app')

@section('content')

<div class="article">
	<h2>{{ $article->title }}</h2>
	<div class="article-info">
		<p>{{ $article->user->ni_cheng }}</p>
	</div>
	<div class="article-content">
		<p>{!! $article->content !!}</p>
	</div>
	<div class="col-sm-12">
		@can('destroy', $article)
			<form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="col-sm-2">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button type="submit" class="btn btn-black " >删除贴子</button>
			</form>
		@endcan
		@if (Auth::check())
			<a href="{{ route('articles.replies.create', $article->id) }}" class="btn btn-black col-sm-2" >回复</a>
		@else
			<a href="{{ route('articles.replies.create', $article->id) }}" class="btn btn-black col-sm-2" >登录并回复</a>
		@endif
	</div>
	
	<h5 class="page-header"></h5>
	
	<div class="article-reply col-sm-12">
		@if (count($replies))
			@foreach ($replies as $reply)
				@include('articles._reply_list')
			@endforeach
		@else
			<p>暂无回复。</p>
		@endif
	</div>

	
	{{ $replies->links() }}

	@if (Auth::check())
		<a href="{{ route('articles.replies.create', $article->id) }}" class="btn btn-black" >回复</a>
	@else
		<a href="{{ route('articles.replies.create', $article->id) }}" class="btn btn-black" >登录并回复</a>
	@endif

	@endsection
	
</div>








