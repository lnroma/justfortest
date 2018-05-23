<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="js cssanimations csstransitions">
<head>
    <meta charset="utf-8">
    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}
    @if(isset($h1))
    <title>{{ $h1 }}</title>
    @else
        <title>pisec.online</title>
    @endif
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    {!! Socket::javascript() !!}
    <script src="/vendor/socket/socket.js"></script>
    <script src="/js/socket.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
</head>
<?php
$route = Route::current()->getName();
?>
<body class="body-index">
@if(!Auth::guest())
<input type="hidden" value="{{Auth::user()->id}}" id="user_id" />
       @endif
<header>
    <div class="header-container">
        <div class="header-logo">
            <a href="/"><img class="header-logo__img" src="/images/logo.png" alt="Logo"></a>
        </div>
        <div class="menu-container">
            <ul class="menu">
                <?php /**  ?> <li class="menu-item"><span class="li_bg li_bg1 <?php if ($route == 'events') echo 'selected' ?>"></span>
                <a href="/events/">
                <img src="/images/li1.png" alt="menu_img">
                </a>
                <?php if($events): ?>
                <div class="menu-item__messages"><?php echo $events ?></div>
                <?php endif; ?>
                </li>
                 * */ ?>
                {{--<li class="menu-item"><span class="li_bg li_bg2"></span>--}}
                {{--<a href="/comunity/">--}}
                {{--<img src="/images/li2.png" alt="menu_img">--}}
                {{--</a>--}}
                {{--</li>--}}
                <li class="menu-item"><span class="li_bg li_bg3 <?php if ($route == 'home') echo 'selected' ?>"></span>
                    <a href="/home">
                        <img src="/images/li3.png" alt="menu_img">
                    </a>
                </li>
                <li class="menu-item"><span
                            class="li_bg li_bg4 <?php if ($route == 'conversations_list') echo 'selected' ?>"></span>
                    <a href="/messages/list">
                        <img src="/images/li4.png" alt="menu_img">
                    </a>
                    <div class="menu-item__messages js-message-count"><?php echo $messages_count ?></div>
                </li>
                <li class="menu-item"><span
                            class="li_bg li_bg5 <?php if ($route == 'profile') echo 'selected' ?>"></span>
                    <a href="/profile">
                        <img src="/images/li5.png" alt="menu_img">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
<div class="container">
    @if(!Auth::guest() && !Auth::user()->getAvatar())
        <div class="alert alert-info">
            У вас не загружен аватар, загрузите его что бы привлечь внимание.
            <a href="/profile">Загрузиить!</a>
        </div>
        @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif
    @yield('content')
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
    <a href="{{ url('/logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        Выход
    </a>

    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</footer>
</body>
</html>
