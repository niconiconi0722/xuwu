@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="content-scroll col-md-11">
            <h2>{{ $announcement->title }}</h2>
            <div class="col-sm-3">
                <img class="img-responsive center-block" src="{{ $announcement->user->iconpath }}" alt="{{ $announcement->user->username }}">
                <p class="text-center">{{ $announcement->user->ni_cheng }}</p>
            </div>
            <div class="col-sm-8 wrap">
                <p>{!! nl2br($announcement->content) !!}</p>
            </div>
        </div>
    </div>
    <div class="row">
        @can('save', $announcement)
            <a href="{{ route('announcements.edit', $announcement->id) }}" class="col-sm-2">
                <button class="btn btn-black">编辑公告</button>
            </a>
        @endcan
        @can('destroy', $announcement)
            <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="col-sm-2">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-black">删除公告</button>
            </form>
        @endcan
    </div>
@endsection