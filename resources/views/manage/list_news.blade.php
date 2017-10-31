@extends('manage.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sach tin tức</h2>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">id</th>
                        <th style="text-align: left;">title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($news))
                        @foreach($news as $key => $new)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">{{ $key+1 }}</a></td>
                                <td style="text-align: left;">{{ $new['title'] }}</td>
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
        </div>
    </div>
@endsection
