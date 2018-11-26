@extends('layouts.app')

@section('content')
    @if (count($articles))
        <h1>论坛</h1>
            <div class="container-fluid">
                <ul class="nav navbar-nav order">
                    <li><a href="{{ Request::url() }}?order=default">最新发布</a></li>
                    <li><a href="{{ Request::url() }}?order=reply">最后回复</a></li>
                </ul>
            </div>
        <ul>
            @foreach ($articles as $article)
                <li>
                    @include('articles._article_list')
                </li>
            @endforeach
        </ul>

        {{ $articles->appends(Request::except('page'))->links() }}
    @endif

    @if (Auth::check())
        <div><a href="{{ route('articles.create') }}">发布新贴</a></div>
    @else
        <a href="{{ route('articles.create') }}">登录并发布新贴</a>
    @endif
@endsection
