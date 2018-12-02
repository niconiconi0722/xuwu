@extends('layouts.app')

@section('content')
    <div id="chatroom">
        <room-option submit-route="{{ route('rooms.destroy', $room) }}" :initial-room="{{ json_encode($room) }}" :current-user="{{ Auth::user() }}"></room-option>
        <chat-form submit-route="{{ route('chats.store', $room->id) }}"></chat-form>
        <chat-list :initial-chats="{{ json_encode($chats) }}" :room-id="{{ $room->id }}" :current-user="{{ Auth::user() }}"></chat-list>
    </div>
@endsection
