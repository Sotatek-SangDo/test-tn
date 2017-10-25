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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($users))
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><a href="/manage/info-user/{{$user['email']}}">{{ $user['name'] }}</a></td>
                                <td>{{ $user['email'] }}</td>
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
            @if(count($users))
                {{ $users->links('layouts.pagination') }}
            @endif
        </div>
    </div>
@endsection
