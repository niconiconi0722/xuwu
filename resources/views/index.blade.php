@extends('layouts.common')

@section('title')
	虚无
@stop

@section('css')
    <style>
        body {
            background-color: black;
        }
    </style>
@stop

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-responsive" src="/img/symbol.png">

                    <form action="{{ route('index.auth') }}" method="POST" class="form-horizontal center-vertical">
                        {{ csrf_field() }}
                        <input class="form-control short-width" type="password" name="password" autofocus>
                    </form>
                </div>
            </div>
        </div>
@stop

@section('script')

@stop