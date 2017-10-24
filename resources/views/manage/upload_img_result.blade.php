@extends('manage.app')
@section('script')
    <style type="text/css">
        .path {
            font-size: 18px;
            color: #000;
            margin-top: 30px;
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <span class="path">{{ $res['path'] }}</span>
        </div>
    </div>
@endsection
