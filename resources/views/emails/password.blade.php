<!DOCTYPE html>
<html>
<head>
    <title>虚无-重置密码</title>
    <meta charset="utf-8">
</head>
<body>
<a href="{{ url(config('app.url').route('password.reset', $token, false)) }}">点此重置密码</a>
<p>如果点击链接无效，请手动复制以下URL至浏览器：{{ url(config('app.url').route('password.reset', $token, false)) }}</p>
</body>
</html>
