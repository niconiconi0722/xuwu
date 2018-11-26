<li>
    <a href="{{ route('articles.show', $article->id) }}">
        <span>{{ $article->title }}</span>
        <span>发布于{{ $article->created_at }}</span>
        <span>回复于{{ $article->updated_at }}</span>
        @can('destroy', $article)
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit">删除贴子</button>
            </form>
        @endcan
    </a>
</li>
