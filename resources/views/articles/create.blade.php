@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('articles.store') }}" class="col-sm-12 form-horizontal center-vertical">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label text-center">标题</label>
			<div class="col-sm-10">
				<input type="text" id="title" class="form-control" name="title" reqired value="{{ old('title') }}">
			</div>
		</div>

		<div class="form-group">
			<label for="content" class="col-sm-2 control-label text-center">内容</label>
			<div class="col-sm-10">
				<textarea class="form-control" name="content"  rows="10">{{ old('content') }}</textarea>
			</div>
		</div>

		<div class="form-group">
			  <button type="submit" class="btn btn-black center-btn" >发布</button>
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