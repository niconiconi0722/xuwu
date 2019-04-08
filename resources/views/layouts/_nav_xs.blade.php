<ul class="nav nav-pills justify-content-center">
    <li>
        <a href="{{ route('announcements.index') }}" class="nav-item"><small>公告</small></a>
    </li>
    <li>
        <a href="{{ route('articles.index') }}" class="nav-item"><small>论坛</small></a>
    </li>
    <li>
        <a href="{{ route('rooms.index') }}" class="nav-item"><small>聊天室</small></a>
    </li>
    @auth
        @if (Auth::user()->isAdmin())
            <li>
                <a href="{{ route('menus.admin') }}" class="nav-item"><small>后台</small></a>
            </li>
        @endif
    @endauth
    <li>
        <a href="{{ route('notifications.index') }}">
            <span class="
            @auth
                {{ Auth::user()->notification_count > 0 ? 'notifications-blink' : 'notifications-default' }}
            @endauth">
                通知
            </span>
        </a>
    </li>
    <li>
        <a href="https://tieba.baidu.com/f?kw=%E8%99%9A%E6%97%A0_ain&ie=utf-8" target="_blank">
            贴吧
        </a>
    </li>
    <li>
        <a href="{{ route('menus.link') }}">
            友情连接
        </a>
    </li>
</ul>