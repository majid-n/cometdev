@foreach ($Posts as $Post)
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 portfolio-item">
        <div class="shadow">
            <a class="portfolio-link" id="{{ $Post->id }}">
                <div class="postimg">
                    <img src="{{ asset('img/portfolioThumb/'.$Post->thumb) }}" class="img-responsive transition" alt="{{ $Post->title }}">
                </div>
            </a>
            <div class="ribbon"><span>{{ $Post->type }}</span></div>
            <div class="portfolio-caption">
                <div class="portfolio-ajaxloader">
                    <img src="{{ asset('img/svg/3dots.svg') }}" width="45">
                </div>
                <div class="portfolio-like">
                    <h4>{{ $Post->title }}</h4>

                    @if( $Post->isLiked() === 0  )
                    <span id="{{ $Post->id }}" class="glyphicon glyphicon-heart enable transitionfast"></span>
                    @else
                    <span id="{{ $Post->id }}" class="glyphicon glyphicon-heart disable transitionfast"></span>
                    @endif
                    @if( $Post->totalLikes() > 0 )
                    <p class="likecount">{{ $Post->totalLikes() }}</p>
                    @else
                    <p class="likecount"></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach