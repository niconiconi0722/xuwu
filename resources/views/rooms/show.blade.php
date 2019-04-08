@extends('layouts.app')

@section('content')
    <div id="chatroom">
        <room-option submit-route="{{ route('rooms.destroy', $room) }}" :initial-room="{{ json_encode($room) }}" :current-user="{{ Auth::user() }}"></room-option>
        <chat-form submit-route="{{ route('chats.store', $room->id) }}"></chat-form>
        <div class="content-scroll col-sm-12">
            <chat-list :initial-chats="{{ json_encode($chats) }}" :room="{{ $room }}" :current-user="{{ Auth::user() }}"></chat-list>
        </div>
    </div>
@endsection