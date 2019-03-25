@extends('layouts.app')

@section('content')
	<div class="article">
		@if (count($articles))
			<div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
        				<ul class="nav order">
        					<li><a href="{{ Request::url() }}?order=default">最新发布</a></li>
        					<li><a href="{{ Request::url() }}?order=reply">最后回复</a></li>
        					<li>
        					@if (Auth::check())
        						<a href="{{ route('articles.create') }}"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
        					@else
        						<a href="{{ route('articles.create') }}">登录并发布新贴</a>
        					@endif
        					</li>
        				</ul>
                    </div>
                    <div class="content-scroll">
            			<table class="table table-hover">
        					@foreach ($articles as $article)
        						@include('articles._article_list')
        					@endforeach
                        </table>
                    </div>
                    {{ $articles->appends(Request::except('page'))->links() }}
                </div>
            </div>
		@endif
	</div>
@endsection

@section('script')
    <script>
        function openArticle(link) {
            window.location = link
        }

        function showDetail(listId) {
            $("#" + listId + " .transparent-text").css("color", "black")
        }

        function hiddenDetail(listId) {
            $("#" + listId + " .transparent-text").css("color", "transparent")
        }
    </script>
@endsection