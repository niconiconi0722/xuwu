@extends('layouts.app')

@section('content')
    @if (count($announcements))
        <div class="container-fluid">
            <div class="row">
                <div class="content-scroll col-md-12">
                    <table class="table table-hover">
                        @each('announcements._announcement_list', $announcements, 'announcement')
                    </table>
                </div>
            </div>
        </div>

        {{ $announcements->links() }}
    @endif

    @can('save', App\Models\Announcement::class)
        <span class="pull-right">
            <a href="{{ route('announcements.create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>
        </span>
    @endcan
@endsection