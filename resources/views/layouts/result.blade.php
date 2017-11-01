@extends('layouts.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h3>Kết quả</h3>
            @if(count($results))
                @foreach($results as $keys => $result)
                    <h4>Mã đề {{ $exams[$keys]['exam_id'] }}</h4>
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric">stt</th>
                                <th>Tên</th>
                                <th>Ngay thi</th>
                                <th>Điểm</th>
                                <th>Mã Đề</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($result))
                                @foreach($result as $key => $val)
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">{{ $key+1 }}</a></td>
                                        <td>{{ $val['name'] }}</td>
                                        <td>{{ date('Y-m-d', strtotime($val['date'])) }}</td>
                                        <td>{{ $val['mark'] }}</td>
                                        <td>{{ $val['exam_id'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                @endforeach
            @endif
        </div>
    </div>
@endsection
