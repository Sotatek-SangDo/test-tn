@extends('layouts.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h3>Kết quả</h3>
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
                    @if(count($results))
                        @foreach($results as $key => $result)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">{{ $key+1 }}</a></td>
                                <td>{{ $result['name'] }}</td>
                                <td>{{ date('Y-m-d', strtotime($result['date'])) }}</td>
                                <td>{{ $result['mark'] }}</td>
                                <td>{{ $result['exam_id'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
