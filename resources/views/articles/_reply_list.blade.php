<div id="reply_{{ $reply->id }}" class="row">
    <div class="col-sm-3">
        <img class="img-responsive center-block user-icon-xs" src="{{ $reply->user->iconpath }}" alt="{{ $reply->user->username }}">
        <p class="text-center">{{ $reply->user->ni_cheng }}</p>
    </div>
    <div class="col-md-8">
        <div class="wrap">
            <p>{!! $reply->content !!}</p>
        </div>
        <div class="text-right text-muted text-sm">
            <span>回复于：{{ $reply->created_at }}</span>
            <div>
                @can('destroy', $reply)
                    <form action="{{ route('articles.replies.destroy', [$article->id, $reply->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-black col-sm-2">删除</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
<h5 class="page-header"></h5>