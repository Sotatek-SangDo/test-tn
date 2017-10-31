@extends('layouts.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center;">Tin tức</h3>
            <div class="mdl-grid portfolio-max-width">
                @if(count($news))
                    @foreach($news as $new)
                        <div class="mdl-cell mdl-card mdl-shadow--4dp portfolio-card">
                            <div class="mdl-card__media">
                                <img class="article-image" src="{{$new['thumbnail']}}" border="0" alt="">
                            </div>
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">{{$new['title']}}</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                {!! str_limit($new['content'], 100) !!}
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/news/{{$new['id']}}">Xem thêm</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
