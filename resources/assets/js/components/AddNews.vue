<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 colxs-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">add news</div>
                    <div class="panel-body">
                        <form action="/manage/news/store" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" :value="token">
                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">Title</label>
                                <div class="col-md-10">
                                    <input id="email" type="text" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">Anh</label>
                                <div class="col-md-10">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                                        <input class="mdl-textfield__input upload" placeholder="upload ảnh" type="text" id="uploadFile" readonly/>
                                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                                            <i class="material-icons">attach_file</i>
                                            <input type="file" id="uploadBtn" name="import" accept="image/*" @change="changeUpload('#uploadBtn')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-2 control-label">Content</label>
                                <div class="col-md-10">
                                    <quill-editor v-model="content"
                                        ref="myQuillEditor"
                                        :options="editorOption"
                                        @blur="onEditorBlur($event)"
                                        @focus="onEditorFocus($event)"
                                        @ready="onEditorReady($event)">
                                    </quill-editor>
                                </div>
                                <input type="hidden" name="content" :value="content">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editorOption: {
                },
                token: '',
                content: ''
            }
        },
        methods: {
            onEditorBlur(editor) {
              // console.log('editor blur!', editor)
            },
            onEditorFocus(editor) {
              // console.log('editor focus!', editor)
            },
            onEditorReady(editor) {
              // console.log('editor ready!', editor)
            },
            changeUpload(id) {
                let input = $(id);
                if(typeof input[0].files[0].name != undefined) {
                    input.parent().parent().find('.upload').val(input[0].files[0].name);
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
            this.token = $('#token').attr('content');
        }
    }
</script>
<style scoped>
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
    .container{
        margin-top: 5%;
    }
</style>

