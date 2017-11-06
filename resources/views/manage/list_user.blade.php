@extends('manage.app')
@section('script')
	<style type="text/css">
		.paginations {
    max-width: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
}
.paginations li {
    list-style: none;
    float: left;
    height: 30px;
    width: 30px;
    font-size: 16px;
    text-align: center;
}
li.disabled {
    color: #999999;
}
li.active {
    color: #3f51b7;
    font-weight: 700;
}
.paginations li a:before {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: #3f51b7;
  visibility: hidden;
  -webkit-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transition: all 0.3s ease-in-out 0s;
  transition: all 0.3s ease-in-out 0s;
}
.paginations li a {
    width: 100%;
    height: 100%;
    display: block;
    position: relative;
}
.paginations li a:hover:before {
  visibility: visible;
  -webkit-transform: scaleX(1);
  transform: scaleX(1);
}
li:hover a{
    color: #3f51b7;
    font-weight: 700;
    text-decoration: none;
}
nav {
    width: 100%;
    margin-top: 20px;
}
	</style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sach học viên</h2>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Tên</th>
                        <th>Email</th>
                        <th>Lớp</th>
                        <th style="text-align: left;">Kích hoạt</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($users))
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><a href="/manage/info-user/{{$user['email']}}">{{ $user['name'] }}</a></td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['class'] }}</td>
                                <td>
                                    <form action="/manage/user-change" method="POST" id="form{{$key}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $user['id'] }}">
                                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch{{$key}}">
                                            <input type="checkbox" id="switch{{$key}}" name="is_active" class="mdl-switch__input" @if($user['is_active']) checked @endif onclick="$('#form{{$key}}').submit()">
                                            <span class="mdl-switch__label"></span>
                                        </label>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if(count($users))
                {{ $users->links('layouts.pagination') }}
            @endif
        </div>
    </div>
@endsection
