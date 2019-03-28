@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <tr>
            <td>操作内容</td>
            <td>操作用户</td>
            <td>被操作的内容</td>
            <td>所属用户</td>
            <td>操作时间</td>
        </tr>
        @each('records._record_list', $records, 'record')
    </table>
    {{ $records->links() }}
@endsection