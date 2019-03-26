@extends('layouts.app')

@section('content')
    <div class="content-scroll">
        <table class="table table-hover">
            <tr>
                <td><a href="{{ route('users.index') }}">用户管理</a></td>
            </tr>
            <!-- <tr>
                <td></td>
            </tr> -->
        </table>
    </div>
@endsection