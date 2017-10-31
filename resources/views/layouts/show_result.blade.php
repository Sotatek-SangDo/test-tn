@extends('layouts.app')
@section('script')
    <style type="text/css">
        .result-header {
            font-size: 2.6em;
            font-weight: 600;
            text-align: center;
            color: #000;
        }
        .re-mark {
            width: 100%;
            text-align: center;
            line-height: 1.5em;
        }
        .re-mark span:nth-child(1) {
            color: #000;
            font-weight: 600;
            font-size: 1.5em;
        }
        .re-mark span:nth-child(2) {
            color: red;
            font-weight: 600;
            font-size: 2em;
        }
        .sentence-error {
            width: 45%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 30px auto 0 auto;
        }
        .sentence-error li{
            width: 11%;
            box-sizing: border-box;
            margin: 0;
            color: red;
            font-weight: 600;
        }
        .text {
            font-size: 1.6em;
            color: #000;
            width: 100%;
            display: block;
            margin-top: 30px;
            text-align: center;
            line-height: 1em;
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
        <h1 class="result-header">{{ $mess }}</h1>
    </div>
</div>
@endsection
