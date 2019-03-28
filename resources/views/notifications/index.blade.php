@extends('layouts.app')

@section('content')
<div class="notifications">
    <div class="container-fluid">
        <ul class="nav order">
            <li><a href="{{ Request::url() }}?cate=all">全部通知</a></li>
            <li><a href="{{ Request::url() }}?cate=articlereplied">文章被回复</a></li>
            <li><a href="{{ Request::url() }}?cate=atuser">@我的消息</a></li>
            <li><a href="{{ Request::url() }}?cate=announce">公告</a></li>
        </ul>
    </div>
    <table class="table table-hover">
        @if (count($notifications))
            @foreach ($notifications as $notification)
                @include('notifications.types._'.snake_case(class_basename($notification->type)))
            @endforeach
        @else
            <tr>
                <td>暂无通知</td>
            </tr>
        @endif
    </table>
    {{ $notifications->appends(Request::except('page'))->links() }}
</div>

@endsection