@extends('manage.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sach dap an</h2>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Mã Đề</th>
                        <th>Môn</th>
                        <th>Thời gian làm bài</th>
                        <th>Lop</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($results))
                        @foreach($results as $key => $result)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">{{ $result['exam_id'] }}</td>
                                <td>{{ $result['name'] }}</td>
                                <td>{{ $result['time_test'] }}</td>
                                <td>{{ $result['class'] }}</td>
                                <td>
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if(count($results))
                {{ $results->links('layouts.pagination') }}
            @endif
        </div>
    </div>
@endsection
