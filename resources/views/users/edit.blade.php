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
    <script src="/head/cropper.js"></script>
    <script src="/head/sitelogo.js"></script>

    <style type="text/css">
    .avatar-btns button {
        height: 35px;
    }
    </style>


</head>

<body><!-- <script src="/demos/googlegg.js"></script> -->

@include('common.error')

<form method="POST" action="{{ route('users.update', $user->id) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <label for="username">名称</label>
    <input type="text" name="username" READONLY value="{{ $user->username }}">

    <label for="ni_cheng">昵称</label>
    <input type="text" name="ni_cheng" value="{{ $user->ni_cheng }}">

    <label for="email">邮箱</label>
    <input type="text" name="email" value="{{ $user->email }}">

    <label for="email">旧密码</label>
    <input type="password" name="old_password">
    <label for="email">修改密码</label>
    <input type="password" name="password">
    <label for="email">确认密码</label>
    <input type="password" name="password_confirmation">

    <button type="submit">保存修改</button>

    <div id="icon">
        <img alt="icon" src="{{ $user->iconpath }}">
    </div>
    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#avatar-modal" style="margin: 10px;">修改头像</button>

</form>

<div>
    <span>用户创建于{{ $user->created_at }}</span>
    <span>用户资料最后修改于{{ $user->updated_at }}</span>
</div>

@include('users._upload')

</body>
</html>
