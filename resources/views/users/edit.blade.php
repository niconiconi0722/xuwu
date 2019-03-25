@extends('layouts.common')

@section('title')
	虚无 - 个人主页
@stop

@section('css')
	<link href="/head/cropper.min.css" rel="stylesheet">
	<link href="/head/sitelogo.css" rel="stylesheet">
@stop

@section('content')
	@include('common.error')
	<form method="POST" action="{{ route('users.update', $user->id) }}" class="col-sm-offset-3 col-sm-6 form-horizontal center-vertical">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		<div class="col-sm-12">
			<div id="icon">
				<img alt="icon" src="{{ $user->iconpath }}">
			</div>
			<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#avatar-modal" style="margin: 10px;">修改头像</button>
		</div>

		<div class="form-group">
			<label for="username" class="col-sm-2 control-label">名称</label>
			<div class="col-sm-8">
				<input type="text" id="username" class="form-control" name="username" READONLY value="{{ $user->username }}">
			</div>
		</div>

		<div class="form-group">
			<label for="ni_cheng" class="col-sm-2 control-label">昵称</label>
			<div class="col-sm-8">
				<input type="text" id="ni_cheng" class="form-control" name="ni_cheng" reqired value="{{ $user->ni_cheng }}">
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">邮箱</label>
			<div class="col-sm-8">
				<input type="text" id="email" class="form-control" name="email" reqired value="{{ $user->email }}">
			</div>
		</div>

		<div class="form-group">
			<label for="old_password" class="col-sm-2 control-label">旧密码</label>
			<div class="col-sm-8">
				<input type="password" id="old_password" class="form-control" name="old_password" reqired >
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">修改密码</label>
			<div class="col-sm-8">
				<input type="password" id="password" class="form-control" name="password" reqired >
			</div>
		</div>

		<div class="form-group">
			<label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
			<div class="col-sm-8">
				<input type="password" id="password_confirmation" class="form-control" name="password_confirmation" reqired >
			</div>
		</div>

		<div class="form-group">
			  <button type="submit" class="btn btn-black btn-center" >保存修改</button>
		</div>

		<div class="col-sm-12">
			<span class="row center-btn">用户创建于{{ $user->created_at }}</span>
			<span class="row center-btn">用户资料最后修改于{{ $user->updated_at }}</span>
		</div>

	</form>



	@include('users._upload')

@stop

@section('script')
	<script src="/head/cropper.js"></script>
    <script src="/head/sitelogo.js"></script>
@stop







<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>虚无-个人主页</title>

    <script src="/head/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link href="/head/cropper.min.css" rel="stylesheet">
    <link href="/head/sitelogo.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">

    <script src="/head/bootstrap.min.js"></script>


    <style type="text/css">

    </style>


</head>

<body><!-- <script src="/demos/googlegg.js"></script> -->



</body>
</html>
