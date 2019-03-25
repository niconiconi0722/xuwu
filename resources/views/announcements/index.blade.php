@extends('layouts.app')

@section('content')
    <ul>
        @each('announcements._announcement_list', $announcements, 'announcement')
    </ul>
@endsection