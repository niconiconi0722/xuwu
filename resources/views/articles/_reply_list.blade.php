<div class="article-content" id="reply_{{ $reply->id }}" class="col-sm-12 form-horizontal center-vertical">
    <p>{{ $reply->user->username }}</p>
    <p>{!! $reply->content !!}</p>
    <span>回复于：{{ $reply->created_at }}</span>
    @can('destroy', $reply)
        <form action="{{ route('articles.replies.destroy', [$article->id, $reply->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-black col-sm-2">删除</button>
        </form>
    @endcan
</div>
<h5 class="page-header"></h5>
