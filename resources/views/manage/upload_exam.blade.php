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
        .class {
            margin-right: 30px;
        }
    </style>
    <script type="text/javascript">
       function changeUpload(id) {
            var input = $(id);
            if(typeof input[0].files[0].name != undefined) {
                input.parent().parent().find('.upload').val(input[0].files[0].name);
            }

       }
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="upload-exel col-md-12">
                <form method="post" action="{{ route('post-exam') }}" id="math" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload de : </label>
                    <div class="col-xs-10 col-md-10">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                            <input class="mdl-textfield__input query-form" type="text" name="class" id="time" value="10" readonly tabIndex="-1">
                            <label for="time" class="mdl-textfield__label">Lớp</label>
                            <ul for="time" class="mdl-menu mdl-menu--bottom-lèt mdl-js-menu">
                                <li class="mdl-menu__item">10</li>
                                <li class="mdl-menu__item">11</li>
                                <li class="mdl-menu__item">12</li>
                            </ul>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                            <input class="mdl-textfield__input query-form" type="text" name="action" id="action" value="math" readonly tabIndex="-1">
                            <label for="action" class="mdl-textfield__label">Mon hoc</label>
                            <ul for="action" class="mdl-menu mdl-menu--bottom-lèt mdl-js-menu">
                                <li class="mdl-menu__item">math</li>
                                <li class="mdl-menu__item">math1</li>
                                <li class="mdl-menu__item">ly</li>
                                <li class="mdl-menu__item">hoa</li>
                                <li class="mdl-menu__item">anh</li>
                            </ul>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="num" name="num" placeholder="Nhập số câu của đề">
                            <label class="mdl-textfield__label" for="num"></label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                            <input class="mdl-textfield__input upload" placeholder="upload ảnh đề thi" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                <i class="material-icons">attach_file</i>
                                <input type="file" id="uploadBtn" name="import[]" accept="image/*" onchange="changeUpload('#uploadBtn')">
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                            <input class="mdl-textfield__input upload" placeholder="upload ảnh đề thi" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                <i class="material-icons">attach_file</i>
                                <input type="file" id="uploadImg" name="import[]" accept="image/*" onchange="changeUpload('#uploadImg')">
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                            <input class="mdl-textfield__input upload" placeholder="upload ảnh đề thi" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                <i class="material-icons">attach_file</i>
                                <input type="file" id="uploadBtn1" name="import[]" accept="image/*" onchange="changeUpload('#uploadBtn1')">
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                            <input class="mdl-textfield__input upload" placeholder="upload ảnh đề thi" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                <i class="material-icons">attach_file</i>
                                <input type="file" id="uploadBtn2" name="import[]" accept="image/*" onchange="changeUpload('#uploadBtn2')">
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                            <input class="mdl-textfield__input upload" placeholder="upload ảnh đề thi" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                <i class="material-icons">attach_file</i>
                                <input type="file" id="uploadBtn3" name="import[]" accept="image/*" onchange="changeUpload('#uploadBtn3')">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Tải lên</button>
                </form>
            </div>
        </div>
    </div>
@endsection
