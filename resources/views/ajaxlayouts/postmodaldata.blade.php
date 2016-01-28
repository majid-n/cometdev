<?php 
	# Add Usefull Classes
	use App\Classes\Time;
	use App\Classes\Validation;

	$TotalLikes = $Post->likes()->count();    # Total this Post Likes
	$isLiked    = $Post->isliked();			# Does this user Liked it before?
?>

<div class="modal-body">
	<!-- Modal Body -->
	<div class="modalEl" style="display:none;">
		<div class="portfolio-modalimg">
			<img src="{{ asset('images/portfolio/'.$Post->image) }}" class="img-responsive" alt="{{ $Post->title }}">
		<div class="ribbon"><span>{{ $Post->cat->title }}</span></div>
		</div>
		<div class="text-center cometModalTxt">
			<h2 class="hidden-xs yellow">{{ $Post->title }}</h2>
			<h4 class="visible-xs yellow">{{ $Post->title }}</h4>
			<p>{{ $Post->description }}</p>
		</div>
	</div>
</div>

<div class="modal-footer" style="display:none;">
	<!-- Modal Footer -->
	<div>
		<img src="{{ asset('img/svg/3dots.svg') }}">
		@if( $isLiked === 0 )
		<span id="{{ $Post->id }}" class="glyphicon glyphicon-heart transitionfast enable transitionfast likePost"></span>
		@else
		<span id="{{ $Post->id }}" class="glyphicon glyphicon-heart disable transitionfast likePost"></span>
		@endif

		@if( $TotalLikes > 0 )
		<p>{{ $TotalLikes }}</p>
		@else
		<p><b class="hidden-xs">لایک کنید!</b><b class="visible-xs">0</b></p>
		@endif

	</div>
	<div>
		<span class="glyphicon glyphicon-calendar"></span>
		<time datetime="{{ Time::ChangeFormat($Post->time) }}">{{ Time::DateFa($Post->time) }}</time>
	</div>

	@if( Validation::HasValue($Post->link) )
	<div>
		<span class="glyphicon glyphicon-eye-open"></span>
		<a href="{{ $Post->link }}"><span class="hidden-xs">مشاهده پروژه</span><span class="visible-xs">مشاهده</span></a>
	</div>
	@endif

<div>