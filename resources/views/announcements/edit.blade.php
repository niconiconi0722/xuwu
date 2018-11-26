@extends('layouts.app')

@section('content')
    <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="title">标题：</label>
            <input type="text" name="title" id="title" value="{{ $announcement->title }}">
        </div>
        <div class="form-group">
            <label for="content">内容：</label>
            <textarea name="content" id="content">{{ $announcement->content }}</textarea>
        </div>
        @can('changePriority', $announcement)
            <div class="form-group">
                <label for="priority">优先级</label>
                <input type="number" name="priority" value="{{ $announcement->priority }}" id="priority">
            </div>
        @endcan
        <button>提交</button>
    </form>
@endsection
