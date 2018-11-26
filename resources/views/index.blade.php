<!DOCTYPE html>
<html>
<head>
    <title>虚无</title>
    <script src="/js/app.js"></script>
</head>
<body>
    <h1>symbol</h1>
    <form action="{{ route('index.auth') }}" method="POST">
        {{ csrf_field() }}
        <input type="password" name="password">
    </form>
</body>
</html>
