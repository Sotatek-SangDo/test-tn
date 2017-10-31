@extends('layouts.app')
@section('script')
    <style type="text/css">
        .item {
            width: 100%;
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
        .item .material-icons {
            padding-right: 30px;
            float: left;
        }
        .item {
            background: #eaeaea;
            box-shadow: 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12), 0 2px 4px -1px rgba(0,0,0,.2);
        }
        .mdl-grid mdl-cell {
            background:#fefefe;
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
        .test {
            padding-left: 10%;
        }
        .demo-list-item {
            width: 100%;
        }
    </style>
     <script type="text/javascript">
        window.localStorage.removeItem('start');
    </script>
@endsection
@section('content')
<div class="mdl-grid mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet mdl-card mdl-shadow--4dp" style="text-align: center; margin: 3% auto;">
    <div class="test">
        <h1>Danh sách bài test</h1>
        <ul class="demo-list-item mdl-list">
            <li class="mdl-list__item item">
                <a href="{{ url('/test?mon=math') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Đề thi Toán</span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/test?mon=math1') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Đề thi Toán 1 tiết </span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/test?mon=ly') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Đề thi Lý</span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/test?mon=hoa') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Đề thi Hóa</span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/test?mon=anh') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Đề thi Anh</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="test">
        <h1>Danh sách kết quả</h1>
        <ul class="demo-list-item mdl-list">
            <li class="mdl-list__item item">
                <a href="{{ url('/result/math') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Kết quả Toán</span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/result/math1') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Kết quả Toán 1 tiết </span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/result/ly') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Kết quả Lý</span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/result/hoa') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Kết quả Hóa</span>
                </a>
            </li>
            <li class="mdl-list__item item">
                <a href="{{ url('/result/anh') }}">
                    <i class="material-icons">border_color</i>
                    <span class="mdl-list__item-primary-content">Kết quả Anh</span>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
