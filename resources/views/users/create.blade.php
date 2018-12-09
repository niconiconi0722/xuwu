@extends('layouts.common')


@section('title')
	注册
@stop

@section('content')
	@include('common.error')
	<form action="{{ route('users.store') }}" method="post" class="col-sm-offset-3 col-sm-6 form-horizontal center-vertical" id="f_sign_up" autocomplete="off">
		{{ csrf_field() }}
		<!--<div class="row form-section">
			
			
			
			<div class="col-md-7 col-sm-7 col-xs-7">
				
				<input name="ni_cheng" type="text" class="form-control" id="sign_up_ni_cheng" placeholder="Your name" reqired value="{{ old('ni_cheng') }}"/>
				<input name="username" type="text" class="form-control" placeholder="Your id" reqired value="{{ old('username') }}"/>
				<input name="password" type="password" class="form-control" placeholder="password" reqired/>
				<input name="password_confirmation" type="password" class="form-control" placeholder="password confirm" reqired/>
				<input name="email" type="text" class="form-control" id="contact_email" placeholder="Your Email..." value="{{ old('email') }}"/>
			</div>

			<button type="submit" class="btn btn-success">注册</button>
		</div>
		-->
		
		<div class="form-group">
			<label for="sign_up_ni_cheng" class="col-sm-2 control-label">昵称</label>
			<div class="col-sm-10">
				<input type="text" id="sign_up_ni_cheng" class="form-control" name="ni_cheng" reqired value="{{ old('ni_cheng') }}" placeholder="Your name">
			</div>
		</div>
		
		<div class="form-group">
			<label for="username" class="col-sm-2 control-label">用户名</label>
			<div class="col-sm-10">
			  <input type="text" id="username" class="form-control" name="username" reqired value="{{ old('username') }}" placeholder="Your id">
			</div>
		</div>
		
		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">密码</label>
			<div class="col-sm-10">
			  <input type="password" id="password" class="form-control" name="password" reqired placeholder="password">
			</div>
		</div>
		
		<div class="form-group">
			<label for="password_confirmation" class="col-sm-2 control-label">密码确认</label>
			<div class="col-sm-10">
			  <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" reqired placeholder="password confirm">
			</div>
		</div>
		
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">邮箱</label>
			<div class="col-sm-10">
			  <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Your Email...">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-black col-sm-4">注册</button>
			</div>
		</div>

	</form>
@stop

@section('script')
	
@stop


