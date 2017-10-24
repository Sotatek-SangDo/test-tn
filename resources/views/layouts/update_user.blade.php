@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cập nhập tài khoản</div>
                @auth
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('updated') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user['name'] }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                                <label for="class" class="col-md-4 control-label">Lớp</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="class">
                                        <option @if($user['class'] == '10') selected="selected" @endif value="10">10</option>
                                        <option @if($user['class'] == '11') selected="selected" @endif value="11">11</option>
                                        <option @if($user['class'] == '12') selected="selected" @endif value="12">12</option>
                                    </select>
                                    @if ($errors->has('class'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Cập nhập
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
