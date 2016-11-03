<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
    <link href="{{ asset("/service/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{ asset("/service/font-awesome/css/font-awesome.css")}}" rel="stylesheet">
    <link href="{{ asset("/service/css/animate.css")}}" rel="stylesheet">
    <link href="{{ asset("/service/css/style.css")}}" rel="stylesheet">

</head>

<body class="gray-bg">
				<ul class="nav navbar-top-links navbar-right">
					<li>
                    <a href="<?php echo env('APP_URL_RUS','#');?>">
                        RUS
                    </a>
					</li>
					<li>
                    <a href="<?php echo env('APP_URL_EN','#');?>">
                        ENG
                    </a>
					</li>
                </ul>
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6">
           <?php
            echo \App\Models\Settings::where('name', 'main_text')->first()->value;
            ?>
        </div>
        <div class="col-md-6">

            <div class="ibox-content">
                <form class="m-t" role="form"  method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="Пароль" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>

                    <a href="/password/reset">
                        <small>Забыл пароль?</small>
                    </a>
                    <p class="text-muted text-center">
                        <small>Еще нет акаунта?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="/register">Зарегестрируйтесь</a>
                </form>
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
