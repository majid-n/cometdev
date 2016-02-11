@foreach ($posts as $post)
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

                    @if( $user = Sentinel::check() )

                        <?php $totallikes = $post->likes()->count(); # Total this Post Likes ?>

                        @if( $post->isLiked( $user ) === 0 )
                            <i id="{{ $post->id }}" class="fa fa-heart enable transitionfast likePost"></i>
                        @else
                            <i id="{{ $post->id }}" class="fa fa-heart disable transitionfast likePost"></i>
                        @endif

                        @if( $totallikes > 0 )
                            <p class="likecount">{{ $totallikes }}</p>
                        @else
                            <p class="likecount"></p>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach