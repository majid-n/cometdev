@foreach ($posts as $post)
    <?php 
        $totallikes = $post->likes()->count();    # Total this Post Likes
        $isliked    = $post->isliked();           # Does this user Liked it before?
    ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 portfolio-item">
        <div class="shadow">
            <a class="portfolio-link" id="{{ $post->id }}">
                <div class="postimg">
                    <img src="{{ asset('images/portfolioThumb/'.$post->thumb) }}" class="img-responsive transition" alt="{{ $post->title }}">
                </div>
            </a>
            <div class="ribbon"><span>{{ $post->cat->title }}</span></div>
            <div class="portfolio-caption">
                <div class="portfolio-ajaxloader">
                    <img src="{{ asset('img/svg/3dots.svg') }}" width="45">
                </div>
                <div class="portfolio-like">
                    <h4>{{ $post->title }}</h4>

                    @if(  $isliked === 0  )
                    <span id="{{ $post->id }}" class="glyphicon glyphicon-heart enable transitionfast likePost"></span>
                    @else
                    <span id="{{ $post->id }}" class="glyphicon glyphicon-heart disable transitionfast likePost"></span>
                    @endif
                    @if( $totallikes > 0 )
                    <p class="likecount">{{ $totallikes }}</p>
                    @else
                    <p class="likecount"></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach