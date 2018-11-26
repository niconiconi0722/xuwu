@extends('layouts.app')

@section('content')
    <form action="{{ route('announcements.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">标题：</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="content">内容：</label>
            <textarea name="content" id="content">{{ old('content') }}</textarea>
        </div>
        @can('changePriority', App\Models\Announcement::class)
            <div class="form-group">
                <label for="priority">优先级</label>
                <input type="number" name="priority" value="0" id="priority">
            </div>
        @endcan
        <button>提交</button>
    </form>
@endsection
