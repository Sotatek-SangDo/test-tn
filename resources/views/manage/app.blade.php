<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/getmdl-select.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <style type="text/css">
        input {
            height: 30px !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            border-bottom: 1px solid #ededed !important;
            margin-bottom: 0 !important;
        }
        input:focus:invalid:focus {
            border-color: : #ffffff;
        }
    </style>
    @yield('script')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/manage') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                @auth
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                           <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Upload
                               </a>
                               <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('upload-exam') }}">Đề Thi</a>
                                    </li>
                                </ul>
                           </li>
                           <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   Danh sách
                               </a>
                               <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('list-exam') }}">Đề Thi</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('list-result') }}">Kết Quả</a>
                                    </li>
                                </ul>
                           </li>
                           <li class="dropdown">
                                <a href="{{ route('hoc-vien') }}">Danh sách học viên</a>
                           </li>
                           <li class="dropdown">
                                <a href="{{ route('news') }}">Thêm tin tức</a>
                           </li>
                        </ul>

                        <!-- Right Side Of Navbar -->

                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('manage-logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                    </div>
                @endauth
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script-footer')
</body>
</html>
