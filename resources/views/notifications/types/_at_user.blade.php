<div>
    <a href="{{ route('notifications.show', $notification->id) }}">
        <div>
            <span>
                {{ $notification->data['do_user_id'] }}
            </span>
            <p> @了你 </p>
        </div>
    </a>
</div>
