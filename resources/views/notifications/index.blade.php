@extends('layouts.app')

@section('content')
    <a href="{{ Request::url() }}?cate=all">全部通知</a>
    <a href="{{ Request::url() }}?cate=articlereplied">文章被回复</a>
    <a href="{{ Request::url() }}?cate=atuser">@我的消息</a>
    <a href="{{ Request::url() }}?cate=announce">公告</a>

    @if (count($notifications))
        @foreach ($notifications as $notification)
            @include('notifications.types._'.snake_case(class_basename($notification->type)))
        @endforeach

        {{ $notifications->appends(Request::except('page'))->links() }}
    @else
        <p>暂无通知</p>
    @endif
@endsection
