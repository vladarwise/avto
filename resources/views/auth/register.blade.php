<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация нового пользователя</title>
    <link href="{{asset('/service/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/service/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('/service/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/service/css/style.css')}}" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content">
                <h2 class="font-bold">Регистрация</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="m-t" role="form"  method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Имя" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Пароль" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Повторите пароль" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Регистрация</button>
                            <a href="/password/reset">
                                <small>Забыл пароль?</small>
                            </a>
                            <p class="text-muted text-center">
                                <small>У вас есть акаунт?</small>
                            </p>
                            <a class="btn btn-sm btn-white btn-block" href="/">Войти</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">©2016 Все права защищены. </div>
        <div class="col-md-6 text-right">
                <small><strong>Copyright</strong> <a href="http://wiseweb.pro">WiseWEB</a> &copy; 2016</small>         
        </div>
    </div>
</div>

</body>

</html>

