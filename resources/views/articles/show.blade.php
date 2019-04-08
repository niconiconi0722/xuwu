@extends('layouts.app')

@section('content')
    <a href="{{ route('articles.index') }}">返回</a>

    <div class="article">
        <div class="row">
            <div class="content-scroll col-md-11">
        	    <h2>{{ $article->title }}</h2>
                <div class="row">
                	<div class="col-sm-3">
                        <img class="img-responsive center-block user-icon-xs" src="{{ $article->user->iconpath }}" alt="{{ $article->user->username }}">
                		<p class="text-center">{{ $article->user->ni_cheng }}</p>
                	</div>
                	<div class="col-sm-8 wrap">
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
                </div>

                <h5 class="page-header"></h5>

        		@if (count($replies))
        			@foreach ($replies as $reply)
        				@include('articles._reply_list')
        			@endforeach
        		@else
        			<p>暂无回复。</p>
        		@endif
            </div>
        </div>

        <div class="row">
        	<div class="col-sm-11">{{ $replies->links() }}</div>

            <div class="col-sm-11">
            	@if (Auth::check())
            		<a href="{{ route('articles.replies.create', $article->id) }}" class="btn btn-black" >回复</a>
            	@else
            		<a href="{{ route('articles.replies.create', $article->id) }}" class="btn btn-black" >登录并回复</a>
            	@endif
            </div>
        </div>
    </div>
@endsection