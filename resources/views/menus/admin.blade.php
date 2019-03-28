@extends('layouts.app')

@section('content')
    <div class="content-scroll">
        <table class="table table-hover">
            <tr>
                <td><a href="{{ route('users.index') }}">用户管理</a></td>
            </tr>
            <tr>
                <td><a href="{{ route('record') }}">回复删除记录</a></td>
            </tr>
        </table>
    </div>
@endsection