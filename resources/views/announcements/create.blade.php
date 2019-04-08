@extends('layouts.app')

@section('content')
    <a href="{{ route('announcements.index') }}">返回</a>

    <form action="{{ route('announcements.store') }}" method="POST" class="col-sm-12 form-horizontal center-vertical">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title" class="col-sm-2 control-label text-center">标题：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label text-center">内容：</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="content" id="content" rows="10">{{ old('content') }}</textarea>
            </div>
        </div>
        @can('changePriority', App\Models\Announcement::class)
            <div class="form-group">
                <label for="priority" class="col-sm-2 control-label text-center">优先级</label>
                <div class="col-sm-10">
                    <input type="number" name="priority" value="0" id="priority" class="form-control col-xl-4">
                </div>
            </div>
        @endcan
        <div class="form-group">
            <button type="submit" class="btn btn-black center-btn">发布</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $('textarea').on('keydown', function (event) {
            if (event.which == 13 && event.ctrlKey) {
                $('form').submit()
            }
        })
    </script>
@endsection