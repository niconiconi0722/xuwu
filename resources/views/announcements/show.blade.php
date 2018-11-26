@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <div>
                        <p>{{ $announcement->title }}</p>
                    </div>
                    <div>
                        <p>{{ $announcement->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
