@extends('layouts.app')

@section('content')
<p>你正在回復帖子：{{ $article->title }}
<form method="POST" action="{{ route('articles.replies.store', $article->id) }}">
    {{ csrf_field() }}
    <label>内容：</label>
    <textarea name="content">{{ old('content') }}</textarea>
    <input type="submit" value="发布">
</form>
@endsection
