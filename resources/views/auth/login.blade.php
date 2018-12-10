@extends('layouts.common')


@section('title')
	登录
@stop

@section('content')
	@include('common.message')
    @include('common.error')
	<form method="POST" action="{{ route('login') }}" class="col-sm-offset-3 col-sm-6 form-horizontal center-vertical" >
        {{ csrf_field() }}
		<div class="form-group">
			<label for="username" class="col-sm-2 control-label">用户名</label>
			<div class="col-sm-10">
			  <input type="text" id="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="用户名">
			</div>
		</div>
		
		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">密码</label>
			<div class="col-sm-10">
			  <input type="password" id="password" class="form-control" name="password" value="{{ old('username') }}" placeholder="密码">
			</div>
		</div>
		
		<div class="form-group">
			<label for="captcha" class="col-sm-2 control-label">验证码</label>
			<div class="col-sm-10">
				<input class="form-control col-sm-4" id="captcha" name="captcha" >
				<img class="col-sm-4" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击更换图片">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-black col-sm-4">登录</button>
			</div>
			
		</div>
		<a class="col-sm-offset-2 col-sm-10" href="{{ route('password.request') }}">忘记密码（仅限绑定过邮箱的用户）</a>

        
    </form>
@stop

@section('script')
	
@stop


