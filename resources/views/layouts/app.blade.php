<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <meta name="description" content="thi trac nghiem online">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src = "https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script> -->
    <!-- <script src="https://code.getmdl.io/1.3.0/material.min.js"></script> -->
    <script src="{{ asset('js/getmdl-select.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.grey-pink.min.css" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    @yield('script')
</head>

<body>
    <div id="app" class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Thi trac nghiem online</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link {{ Request::is('/') ? 'is-active' : '' }}" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                    @guest
                        <a class="mdl-navigation__link {{ Request::is('login') ? 'is-active' : '' }}" href="{{ route('login') }}">Đăng nhập</a>
                        <a class="mdl-navigation__link {{ Request::is('register') ? 'is-active' : '' }}" href="{{ route('register') }}">Đăng kí</a>
                    @else
                        <a class="mdl-navigation__link {{ Request::is('user/info') ? 'is-active' : '' }}" href="{{ route('info') }}">Thông tin tài khoản</a>
                        <a class="mdl-navigation__link {{ Request::is('user/update') ? 'is-active' : '' }}" href="{{ route('update-user') }}">Update tài khoản</a>
                        <a class="mdl-navigation__link" href="#">Hi {{ Auth::user()->name }}
                            <i class="glyphicon glyphicon-log-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    @endguest
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                 <a class="mdl-navigation__link {{ Request::is('/') ? 'is-active' : '' }}" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                    @guest
                        <a class="mdl-navigation__link {{ Request::is('login') ? 'is-active' : '' }}" href="{{ route('login') }}">Đăng nhập</a>
                        <a class="mdl-navigation__link {{ Request::is('register') ? 'is-active' : '' }}" href="{{ route('register') }}">Đăng kí</a>
                    @else
                        <a class="mdl-navigation__link {{ Request::is('user/info') ? 'is-active' : '' }}" href="{{ route('info') }}">Thông tin tài khoản</a>
                        <a class="mdl-navigation__link {{ Request::is('user/update') ? 'is-active' : '' }}" href="{{ route('update-user') }}">Update tài khoản</a>
                        <a class="mdl-navigation__link" href="#">Hi {{ Auth::user()->name }}
                            <i class="glyphicon glyphicon-log-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    @endguest
            </nav>
        </div>
        <main class="">
            <div class="container">
                @yield('content')
            </div>
            <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                    <div class="mdl-logo">Product by SH team.</div>
                </div>
                <div class="mdl-mini-footer__right-section">
                    <ul class="mdl-mini-footer__link-list">
                        <li><a href="#">Giúp đỡ</a></li>
                        <li><a href="#">Liên Hệ</a></li>
                    </ul>
                </div>
            </footer>
        </main>
    </div>
    <script type="text/javascript">
        $(function() {
            $('.mdl-navigation__link').hover(function() {
                $(this).toggleClass('is-active');
            })
        })
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
