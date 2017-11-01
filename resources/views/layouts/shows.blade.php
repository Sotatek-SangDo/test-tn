@extends('layouts.app')
@section('script')

@endsection
@section('content')
    <div class="mdl-grid portfolio-max-width">
        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Tin tức mới</h2>
            </div>
            <div class="mdl-card__media">
                <img class="article-image" src="{{ $new['thumbnail'] }}" border="0" alt="">
            </div>
            <div class="mdl-grid portfolio-copy">
                <h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">{{ $new['title'] }}</h3>
                <div class="mdl-cell mdl-cell--12-col mdl-card__supporting-text no-padding">
                    {!! $new['content'] !!}
                </div>
            </div>
        </div>
    </div>
@endsection
