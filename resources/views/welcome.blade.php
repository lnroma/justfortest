        <!DOCTYPE html>
<html lang="ru" class="js cssanimations csstransitions">
<head>
    <meta charset="utf-8">
    <title>«Pisec» — рядом с вами жаждут знакомства!</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body class="body-index">
<header>
    <div class="header-container">
        <div class="header-logo">
            <a href=""><img class="header-logo__img" src="images/logo.png" alt="Logo"></a>
        </div>
        <div class="menu-container">

        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class=" search-item col-md-8">
            <h1>Вокруг вас тысячи людей жаждущих знакомства. Наидите их!
                На сайте уже более 595 328 человек. И вы можете найти свою любовь
            </h1>
            <h2>
                {{--Лучшие анкеты на сайте:<br/>--}}
                {{--slider--}}
            </h2>
        </div>
        <div class=" search-item col-md-4" style="padding-top: 10px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Войти на сайт
                </div>
                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail адрес</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Пароль</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить
                                меня
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Войти
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    </div>
                    <div class="col-md-8 col-md-offset-4">
                        или
                        <a href="{{route('register')}}">
                            Зарегистрироваться
                        </a>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>

    </div>
</div>
<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <a href=""><img class="footer-logo__img" src="/images/logo.png" alt="Logo"></a>
        </div>
        <div class="footer-up">
            <a href=""><img src="/images/up.png" alt="Logo">наверх</a>
        </div>
    </div>
</footer>
</body>
</html>