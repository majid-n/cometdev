@foreach ($Posts as $Post)
    <?php 
        $TotalLikes = $Post->totalLikes();      # Total this Post Likes
        $isLiked    = $Post->isliked();         # Does this user Liked it before?
    ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 portfolio-item">
        <div class="shadow">
            <a class="portfolio-link" id="{{ $Post->id }}">
                <div class="postimg">
                    <img src="{{ asset('images/portfolioThumb/'.$Post->thumb) }}" class="img-responsive transition" alt="{{ $Post->title }}">
                </div>
            </a>
            <div class="ribbon"><span>{{ $Post->cat->title }}</span></div>
            <div class="portfolio-caption">
                <div class="portfolio-ajaxloader">
                    <img src="{{ asset('img/svg/3dots.svg') }}" width="45">
                </div>
                <div class="portfolio-like">
                    <h4>{{ $Post->title }}</h4>

                    @if(  $isLiked === 0  )
                    <span id="{{ $Post->id }}" class="glyphicon glyphicon-heart enable transitionfast likePost"></span>
                    @else
                    <span id="{{ $Post->id }}" class="glyphicon glyphicon-heart disable transitionfast likePost"></span>
                    @endif
                    @if( $TotalLikes > 0 )
                    <p class="likecount">{{ $TotalLikes }}</p>
                    @else
                    <p class="likecount"></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach