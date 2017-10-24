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
            }

       }
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="upload-exel col-md-12">
                <form method="post" action="{{ route('post-img') }}" id="math" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload ảnh </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input upload" placeholder="File" type="text" id="uploadFile" readonly/>
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" id="uploadBtn" name="file" accept="file" onchange="changeUpload('#uploadBtn')">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
