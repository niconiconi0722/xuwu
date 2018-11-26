@extends('layouts.app')

@section('content')
    <div id="chatroom">
        <chat-form submit-route="{{ route('chats.store', $room->id) }}"></chat-form>
        <chat-list :initial-chats="{{ json_encode($chats) }}" :room-id="{{ $room->id }}"></chat-list>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
