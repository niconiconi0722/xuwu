@extends('layouts.app')

@section('content')
    @each('users._userList', $users, 'user')
    {{ $users->links() }}
@endsection
