<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Восстановление пароля</title>
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
                    <h2 class="font-bold">Восстановление пароля</h2>
                    <p>
                        Введите свой Email адресс для восстановления пароля.
                        С помощью функции восстановления пароля вы можете заменить забытый пароль на новый.
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif
                            <form class="m-t" role="form" method="POST" action="{{ url('/password/email') }}">
                                {{ csrf_field() }}

								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
										@if ($errors->has('email'))
											<span class="help-block">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
								</div>
								
                                <button type="submit" class="btn btn-primary block full-width m-b">Восстановить</button>

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



