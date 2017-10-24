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
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload de toan: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input upload" placeholder="File" type="text" id="uploadFile" readonly/>
                        <input type="hidden" name="action" value="math">
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" id="uploadBtn" name="import" accept=".xlsx,.xls" onchange="changeUpload('#uploadBtn')">
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                        <input class="mdl-textfield__input query-form" type="text" name="class" id="time" value="10" readonly tabIndex="-1">
                        <label for="time" class="mdl-textfield__label">Lớp</label>
                        <ul for="time" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <li class="mdl-menu__item">10</li>
                            <li class="mdl-menu__item">11</li>
                            <li class="mdl-menu__item">12</li>
                        </ul>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Upload</button>
                </form>
            </div>

            <div class="upload-exel col-md-12">
                <form method="post" action="{{ route('post-exam') }}" id="math" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload de toan1: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input upload" placeholder="File" type="text" id="uploadFile" readonly/>
                        <input type="hidden" name="action" value="math1">
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" id="uploadBtn1" name="import" accept=".xlsx,.xls" onchange="changeUpload('#uploadBtn1')">
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                        <input class="mdl-textfield__input query-form" type="text" name="class" id="time1" value="10" readonly tabIndex="-1">
                        <label for="time1" class="mdl-textfield__label">Lớp</label>
                        <ul for="time1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <li class="mdl-menu__item">10</li>
                            <li class="mdl-menu__item">11</li>
                            <li class="mdl-menu__item">12</li>
                        </ul>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Upload</button>
                </form>
            </div>

            <div class="upload-exel col-md-12">
                <form method="post" action="{{ route('post-exam') }}" id="math" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload de ly: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input upload" placeholder="File" type="text" id="uploadFile" readonly/>
                        <input type="hidden" name="action" value="ly">
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" id="uploadBtnL" name="import" accept=".xlsx,.xls" onchange="changeUpload('#uploadBtnL')">
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                        <input class="mdl-textfield__input query-form" type="text" name="class" id="time2" value="10" readonly tabIndex="-1">
                        <label for="time2" class="mdl-textfield__label">Lớp</label>
                        <ul for="time2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <li class="mdl-menu__item">10</li>
                            <li class="mdl-menu__item">11</li>
                            <li class="mdl-menu__item">12</li>
                        </ul>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Upload</button>
                </form>
            </div>

            <div class="upload-exel col-md-12">
                <form method="post" action="{{ route('post-exam') }}" id="math" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload de hoa: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input upload" placeholder="File" type="text" id="uploadFile" readonly/>
                        <input type="hidden" name="action" value="hoa">
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" id="uploadBtnH" name="import" accept=".xlsx,.xls" onchange="changeUpload('#uploadBtnH')">
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                        <input class="mdl-textfield__input query-form" type="text" name="class" id="time3" value="10" readonly tabIndex="-1">
                        <label for="time3" class="mdl-textfield__label">Lớp</label>
                        <ul for="time3" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <li class="mdl-menu__item">10</li>
                            <li class="mdl-menu__item">11</li>
                            <li class="mdl-menu__item">12</li>
                        </ul>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Upload</button>
                </form>
            </div>

            <div class="upload-exel col-md-12">
                <form method="post" action="{{ route('post-exam') }}" id="math" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label class="col-xs-2 col-md-2" style="padding: 28px 0"> Upload de anh: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input upload" placeholder="File" type="text" id="uploadFile" readonly/>
                        <input type="hidden" name="action" value="anh">
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i>
                            <input type="file" id="uploadBtnA" name="import" accept=".xlsx,.xls" onchange="changeUpload('#uploadBtnA')">
                        </div>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth class">
                        <input class="mdl-textfield__input query-form" type="text" name="class" id="time4" value="10" readonly tabIndex="-1">
                        <label for="time4" class="mdl-textfield__label">Lớp</label>
                        <ul for="time4" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <li class="mdl-menu__item">10</li>
                            <li class="mdl-menu__item">11</li>
                            <li class="mdl-menu__item">12</li>
                        </ul>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection
