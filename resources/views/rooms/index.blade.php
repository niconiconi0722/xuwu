@extends('layouts.app')

@section('content')
    <ul>
        @each('rooms._room_list', $rooms, 'room')
    </ul>
    <a href="{{ route('rooms.create') }}">新建房间</a>
@endsection
