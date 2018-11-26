<!DOCTYPE>
<html>
<head>
    <title></title>
</head>
<body>
    @include('common.message')
    @include('common.error')
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <input type="text" name="username" value="{{ old('username') }}">
        <input type="password" name="password">

        <div>
            <label for="captcha">验证码</label>
            <input id="captcha" name="captcha">
            <img src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击更换图片">
        </div>

        <input type="submit">

        <a href="{{ route('password.request') }}">忘记密码（仅限绑定过邮箱的用户）</a>
    </form>
</body>
</html>
