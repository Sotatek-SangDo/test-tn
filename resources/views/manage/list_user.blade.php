@extends('manage.app')
@section('script')

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
                        <th style="text-align: left;">Kích hoạt</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($users))
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><a href="/manage/info-user/{{$user['email']}}">{{ $user['name'] }}</a></td>
                                <td>{{ $user['email'] }}</td>
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
