@extends('layouts.common')


@section('title')
	虚无
@stop

@section('content')
	<div class="center-vertical">
		
		<form action="{{ route('index.auth') }}" method="POST" class="form-horizontal center-vertical">
			<div class="m-auto center-logo">
				<h1>symbol</h1>
			</div>
			
			{{ csrf_field() }}
			<input class="form-control short-width" type="password" name="password">
		</form>
	</div>
	
@stop

@section('script')
	
@stop




