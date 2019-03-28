@extends('layouts.app')

@section('content')
    <form action="{{ route('rooms.store') }}" method="POST" class="col-sm-12 form-horizontal center-vertical">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label text-center">房间名称</label>
            <div class="col-sm-10">
                <input type="text" id="name" class="form-control" name="name" reqired value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label text-center">房间描述</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description"  rows="5">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="max_users" class="col-sm-2 control-label text-center">最大人数</label>
            <div class="col-sm-10">
                <input class="col-sm-2" type="number" name="max_users" max="20" min="1" value="15">
            </div>
        </div>

        <div class="form-group">
              <button type="submit" class="btn btn-black center-btn">创建</button>
        </div>
    </form>
@endsection