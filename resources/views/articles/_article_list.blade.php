<tr id="article-{{$article->id}}" data-link="{{ route('articles.show', $article->id) }}" onclick="openArticle(this.dataset.link)" onmouseenter="showDetail(this.id)" onmouseleave="hiddenDetail(this.id)">
        <td style="width: 300px">{{ $article->title }}</td>
    	<td class="transparent-text">{{ $article->user->ni_cheng }}</td>
        <td class="transparent-text">发帖时间：{{ $article->created_at->diffForHumans() }}</td>
    	<td>
    	@can('destroy', $article)
    		<form action="{{ route('articles.destroy', $article->id) }}" method="POST">
    			{{ csrf_field() }}
    			{{ method_field('DELETE') }}
    			<button type="submit" class="btn btn-black">删除贴子</button>
    		</form>
    	@endcan
	    </td>
</tr>