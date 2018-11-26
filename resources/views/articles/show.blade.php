<h2>{{ $article->title }}</h2>

@can('destroy', $article)
    <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit">删除贴子</button>
    </form>
@endcan

<p>{{ $article->user->ni_cheng }}</p>
<p>{!! $article->content !!}</p>

<hr>

@if (count($replies))
    @foreach ($replies as $reply)
        @include('articles._reply_list')
    @endforeach
@endif

{{ $replies->links() }}

@if (Auth::check())
    <a href="{{ route('articles.replies.create', $article->id) }}">回復</a>
@else
    <a href="{{ route('articles.replies.create', $article->id) }}">登录并回复</a>
@endif
