<tr>
	<td style="width: 300px"><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
	<td>{{ $article->created_at }}</td>
	<td>{{ $article->updated_at }}</td>
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
