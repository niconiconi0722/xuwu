<header class="head clearflx">
    @if (Auth::check())
        <nav>
            <ul>
                <li class="peason"><span>
                    <a href="{{ route('users.edit', Auth::user()->id) }}">
                        <img src="{{ Auth::user()->iconpath }}" alt="{{ Auth::user()->id }}">
                    </a>
                </span></li>
                <li class="out"><span>
                    <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" name="button"><img src="/img/log_out.png"></button>
                    </form>
                </span></li>
                <li class="search"><span>
                    <a><img src="/img/search_black.png"></a>
                </span></li>
            </ul>
        </nav>
    @else
        <a href="{{ route('users.create') }}">注册</a>
        <a href="{{ route('login') }}">登录</a>
    @endif
</header>
