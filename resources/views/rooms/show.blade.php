@extends('layouts.app')

@section('content')
    <div id="chatroom">
        <chat-form submit-route="{{ route('chats.store') }}"></chat-form>
        <chat-list :initial-chats="{{ json_encode($chats) }}" :room-id="1"></chat-list>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
