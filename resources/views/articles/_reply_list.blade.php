<div id="reply_{{ $reply->id }}">
    <div>{{ $reply->user->username }}</div>
    <div>{!! $reply->content !!}</div>
    <span>回復于：{{ $reply->created_at }}</span>
    @can('destroy', $reply)
        <form action="{{ route('articles.replies.destroy', [$article->id, $reply->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit">删除</button>
        </form>
    @endcan
</div>
