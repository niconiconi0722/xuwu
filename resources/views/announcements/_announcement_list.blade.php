<li>
    <a href="{{ route('announcements.show', $announcement->id) }}">
        <span>{{ $announcement->title }}</span>
        <span>发布于{{ $announcement->updated_at }}</span>
        @can('destroy', $announcement)
            <form action="{{ route('announcements.destroy', $announcement) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit">删除</button>
            </form>
        @endcan
    </a>
</li>