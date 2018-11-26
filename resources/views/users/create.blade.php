<!DOCTYPE html>
<html>
<head>
    <title>注册</title>
</head>
<body>
@include('common.error')

<form action="{{ route('users.store') }}" method="post" class="subscribe-form" id="f_sign_up" autocomplete="off">
    <div class="row form-section">
    <div class="col-md-7 col-sm-7 col-xs-7">
        {{ csrf_field() }}

        <input name="ni_cheng" type="text" class="form-control" id="sign_up_ni_cheng" placeholder="Your name" reqired value="{{ old('ni_cheng') }}"/>
        <input name="username" type="text" class="form-control" placeholder="Your id" reqired value="{{ old('username') }}"/>
        <input name="password" type="password" class="form-control" placeholder="password" reqired/>
        <input name="password_confirmation" type="password" class="form-control" placeholder="password confirm" reqired/>
        <input name="email" type="text" class="form-control" id="contact_email" placeholder="Your Email..." value="{{ old('email') }}"/>
      </div>

        <button type="submit">注册</button>
    </div>
</form>
</body>
</html>
