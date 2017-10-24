@extends('layouts.app')
@section('script')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h1>Kết quả bài thi</h1>
        <div class="re-mark">
            <span>Điểm thi: </span>
            <span>{{ $mark }}</span>
        </div>

        <div class="error">
            @if(count($error))
                <span> Các câu lỗi: </span>
                @foreach($error as $val)
                    <span>{{ $val }}</span>
                @endforeach
            @else
                <span>Khong co cau nao loi</span>
            @endif
        </div>
    </div>
</div>
@endsection
