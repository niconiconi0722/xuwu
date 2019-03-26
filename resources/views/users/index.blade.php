@extends('layouts.app')

@section('content')
    @if (count($users))
        <div class="content-scroll col-sm-12">
            <table class="table table-hover">
                @each('users._user_list', $users, 'user')
            </table>
        </div>
        <div class="col-sm-12">
            {{ $users->links() }}
        </div>
    @else
        <p>暂无用户</p>
    @endif
@endsection