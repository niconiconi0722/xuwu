@extends('layouts.app')

@section('content')
    @each('users._user_list', $users, 'user')
    {{ $users->links() }}
@endsection
