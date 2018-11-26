@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('articles.store') }}">
    {{ csrf_field() }}
    <label>标题：</label>
    <input type="text" name="title"value="{{ old('title') }}" >
    <label>内容：</label>
    <textarea name="content">{{ old('content') }}</textarea>
    <input type="submit" value="发布">
</form>
@endsection
