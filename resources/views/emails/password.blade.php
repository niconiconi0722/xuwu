<!DOCTYPE html>
<html>
<head>
    <title>虚无-重置密码</title>
    <meta charset="utf-8">
    <style>
        body {background-color: #ccc}
    </style>
</head>
<body>
    <div style="text-align: center">
        <a href="{{ url(config('app.url').route('password.reset', $token, false)) }}">点此重置密码</a>
        <p>如果点击链接无效，请手动复制以下URL至浏览器：<br>{{ url(config('app.url').route('password.reset', $token, false)) }}</p>
    </div>
</body>
</html>