<ul class="list-group menu">
    <a href="{{ route('announcements.index') }}" class="list-group-item text-center"><small>公告</small></a>
    <a href="{{ route('articles.index') }}" class="forum list-group-item text-center"><small>论坛</small></a>
    <a href="{{ route('rooms.index') }}" class="room list-group-item text-center"><small>聊天室</small></a>
</ul>

<div class="tool clearflx">
    <div class="row">
        <div class="col-sm-6
            @auth
                {{ Auth::user()->notification_count > 0 ? 'notifications-toggle' : 'notifications-default' }}
            @endauth
        ">
            <a href="{{ route('notifications.index') }}">
                <img src="/img/ring.png">
            </a>
        </div>
        <div class="col-sm-6 tieba">
            <a href="https://tieba.baidu.com/f?kw=%E8%99%9A%E6%97%A0_ain&ie=utf-8" target="_blank">
                <img src="/img/tie.png">
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 letter">
            <a href="#">
                <img src="/img/letter.png">
            </a>
        </div>
        <div class="col-sm-6 link">
            <a href="#">
                <img src="/img/link.png">
            </a>
        </div>
    </div>
</div>