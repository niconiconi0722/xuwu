<tr>
    <td>
        <a href="{{ route('notifications.show', $notification->id) }}">
<!--             <div>
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
            </div> -->
            <p class="col-sm-4">有人回复了你</p>
        </a>
    </td>
</tr>