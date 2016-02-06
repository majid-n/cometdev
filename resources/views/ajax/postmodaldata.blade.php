<?php 
	# Add Usefull Classes
	use App\Classes\Time;
	use App\Classes\Validation;

	$totallikes = $post->likes()->count();    # Total this Post Likes
	$isliked    = $post->isLiked();			  # Does this user Liked it before?
?>

<div class="modal-body">
	<!-- Modal Body -->
	<div class="modalEl" style="display:none;">
		<div class="portfolio-modalimg">
			<img src="{{ asset('images/portfolio/'.$post->image) }}" class="img-responsive" alt="{{ $post->title }}">
		<div class="ribbon"><span>{{ $post->cat->title }}</span></div>
		</div>
		<div class="text-center cometModalTxt">
			<h2 class="hidden-xs yellow">{{ $post->title }}</h2>
			<h4 class="visible-xs yellow">{{ $post->title }}</h4>
			<p>{{ $post->description }}</p>
		</div>
	</div>
</div>

<div class="modal-footer" style="display:none;">
	<!-- Modal Footer -->
	<div>
		<img src="{{ asset('img/svg/3dots.svg') }}">
		@if( $isliked === 0 )
		<i id="{{ $post->id }}" class="fa fa-heart transitionfast enable transitionfast likePost"></i>
		@else
		<i id="{{ $post->id }}" class="fa fa-heart disable transitionfast likePost"></i>
		@endif

		@if( $totallikes > 0 )
		<p>{{ $totallikes }}</p>
		@else
		<p><b class="hidden-xs">لایک کنید!</b><b class="visible-xs">0</b></p>
		@endif

	</div>
	<div>
		<i class="fa fa-calendar"></i>
		<time datetime="{{ Time::ChangeFormat($post->time) }}">{{ Time::DateFa($post->time) }}</time>
	</div>

	@if( Validation::HasValue($post->link) )
	<div>
		<i class="fa fa-eye-open"></i>
		<a href="{{ $post->link }}"><span class="hidden-xs">مشاهده پروژه</span><span class="visible-xs">مشاهده</span></a>
	</div>
	@endif

<div>