@extends('manage.app')
@section('script')
     <style type="text/css">
        .mdl-button--file input {
            cursor: pointer;
            height: 100%;
            right: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 300px;
            z-index: 4;
        }

        .mdl-textfield--file .mdl-textfield__input {
            box-sizing: border-box;
            width: calc(100% - 32px);
        }
        .mdl-textfield--file .mdl-button--file {
            right: 0;
        }
    </style>
    <script type="text/javascript">
       function changeUpload(id) {
            var input = $(id);
            if(typeof input[0].files[0].name != undefined) {
                input.parent().parent().parent().submit();
                input.val('');
            }

       }
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sach de</h2>
            @if(Session::has('success'))
                <div class="message col-md-12">
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                </div>
                @php Session::forget('success') @endphp
            @endif
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Mã Đề</th>
                        <th>Môn</th>
                        <th>Thời gian làm bài</th>
                        <th>Lop</th>
                        <th style="text-align: left;">Hiển thị kết quả</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($exams))
                        @foreach($exams as $key => $exam)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">{{ $exam['exam_id'] }}</td>
                                <td>{{ $exam['name'] }}</td>
                                <td>{{ $exam['time_test'] }}</td>
                                <td>{{ $exam['class'] }}</td>
                                <td>
                                    <form action="/manage/exam-change" method="POST" id="show">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $exam['exam_id'] }}">
                                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
                                            <input type="checkbox" id="switch-1" name="is_show" class="mdl-switch__input" @if($exam['is_show']) checked @endif onclick="$('#show').submit()">
                                            <span class="mdl-switch__label"></span>
                                        </label>
                                    </form>
                                </td>
                                <td>
                                    <div class="upload-exel">
                                        <form method="post" action="{{ route('post-result') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                                                <input class="mdl-textfield__input upload" placeholder="upload file đáp án" type="text" id="uploadFile" readonly/>
                                                <input type="hidden" name="subject_name" value="{{ $exam['name'] }}">
                                                <input type="hidden" name="exam_id" value="{{ $exam['exam_id'] }}">
                                                <input type="hidden" name="class" value="{{ $exam['class'] }}">
                                                <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                                    <i class="material-icons">attach_file</i>
                                                    <input type="file" id="uploadBtn" name="import" accept=".xlsx,.xls" onchange="changeUpload('#uploadBtn')">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if(count($exams))
                {{ $exams->links('layouts.pagination') }}
            @endif
        </div>
    </div>
@endsection
