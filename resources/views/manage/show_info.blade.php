@extends('manage.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>Thong tin học viên</h2>
            <div class="panel-body">
                <div class="form-group" style="padding-bottom: 20px;">
                    <div class="col-md-12" style="font-weight: 600; font-size: 1.5rem"><span style="font-weight: 400">Tên:</span> {{ $user['name'] }}</div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="font-weight: 600; font-size: 1.5rem"><span style="font-weight: 400">Email:</span> {{ $user['email'] }}</div>
                </div>
            </div>
            <h3>Ket qua</h3>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Mon</th>
                        <th>Ma De</th>
                        <th>Ngay thi</th>
                        <th>Điểm</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($results))
                        @foreach($results as $key => $result)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">{{ $result['name'] }}</a></td>
                                <td>{{ $result['exam_id'] }}</td>
                                <td>{{ date('Y-m-d', strtotime($result['date'])) }}</td>
                                <td>{{ $result['mark'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
