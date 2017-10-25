@extends('layouts.app')
@section('script')
    <style type="text/css">
        .item {
            width: 50%;
            height: 60px;
            background: #f1f1f1;
            border-radius: 5px;
            margin-bottom: 8px;
            position: relative;
        }
        .item a{
            width: 100%;
            color: #333;
        }
        .material-icons {
            padding-right: 30px;
            float: left;
        }
        .mdl-list__item:after {
            content: '';
            position: absolute;
            top: 20px;
            right: 15px;
            height: 25px;
            width: 25px;
            border-top: 3px solid;
            border-right: 3px solid;
            color: #333;
            transform: rotate(45deg);
        }
        span.mdl-list__item-primary-content {
            font-size: 24px;
            font-weight: 600;
        }
    </style>
     <script type="text/javascript">
        window.localStorage.removeItem('start');
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="test">
        <h1>Danh sách bài test</h1>
            <ul class="demo-list-item mdl-list">
                <li class="mdl-list__item item">
                    <a href="{{ url('/test?mon=math') }}">
                        <i class="material-icons">border_color</i>
                        <span class="mdl-list__item-primary-content">Toán</span>
                    </a>
                </li>
                <li class="mdl-list__item item">
                    <a href="{{ url('/test?mon=math1') }}">
                        <i class="material-icons">border_color</i>
                        <span class="mdl-list__item-primary-content">Toán 1</span>
                    </a>
                </li>
                <li class="mdl-list__item item">
                    <a href="{{ url('/test?mon=ly') }}">
                        <i class="material-icons">border_color</i>
                        <span class="mdl-list__item-primary-content">Lý</span>
                    </a>
                </li>
                <li class="mdl-list__item item">
                    <a href="{{ url('/test?mon=hoa') }}">
                        <i class="material-icons">border_color</i>
                        <span class="mdl-list__item-primary-content">Hóa</span>
                    </a>
                </li>
                <li class="mdl-list__item item">
                    <a href="{{ url('/test?mon=anh') }}">
                        <i class="material-icons">border_color</i>
                        <span class="mdl-list__item-primary-content">Anh</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
