<td>
    <a href="{{ route('notifications.show', $notification->id) }}">
        <div>
            <span>
                {{ $notification->data['user_id'] }}
            </span>
            <p> 回复了 </p>
            <p>
                {{ $notification->data['article_id'] }}
            </p>
            <p> 内容为 </p>
            <p>
                {!! $notification->data['reply_id'] !!}
            </p>
        </div>
    </a>
</td>
