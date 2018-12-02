@extends('layouts.app')

@section('content')
    <form action="{{ route('rooms.store') }}" method="POST">
        {{ csrf_field() }}

        <input type="text" name="name" value="{{ old('name') }}">
        <textarea name="description">{{ old('description') }}</textarea>
        <input type="number" name="max_users" max="20" min="1" value="15">
        <button type="submit">创建</button>
    </form>
@endsection
