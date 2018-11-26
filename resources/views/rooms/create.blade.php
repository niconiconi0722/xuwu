@extends('layouts.app')

@section('content')
    <form action="{{ route('rooms.store') }}" method="POST">
        {{ csrf_field() }}

        <input type="text" name="name" value="{{ old('name') }}">
        <textarea name="description">{{ old('description') }}</textarea>
        <!-- <input type="number"> -->
        <button type="submit">创建</button>
    </form>
@endsection
