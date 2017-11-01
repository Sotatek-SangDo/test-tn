@extends('layouts.app')
@section('script')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center; font-size: 4rem">Tin tức</h3>
            <div class="mdl-grid portfolio-max-width">
            @if(count($news))
                @foreach($news as $new)
                    <div class="mdl-grid mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__media mdl-cell mdl-cell--12-col-tablet" style="background-color: #fff">
                        <img class="article-image" src="{{$new['thumbnail']}}" border="0" alt="">
                    </div>
                    <div class="mdl-cell mdl-cell--8-col">
                        <h2 class="mdl-card__title-text">{{$new['title']}}</h2>
                       <!--  <div class="mdl-card__supporting-text padding-top">
                            <span>Posted 2 days ago</span>
                            <div id="tt1" class=" icon material-icons portfolio-share-btn">share</div>
                            <div class="mdl-tooltip" for="tt1">
                                Share via social media
                            </div>
                        </div> -->
                        <div class="mdl-card__supporting-text no-left-padding">
                            {!! str_limit($new['content'], 100) !!}
                        </div>
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
