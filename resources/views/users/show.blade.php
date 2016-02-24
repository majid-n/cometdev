@extends('layouts.template')

@section('seo')
	<meta name="description" content="{{ $user->resume->bio }}"/>
	<meta name="title" content="{{ $user->fullName() }}"/>
	<meta name="keywords" content="{{ str_slug($user->resume->bio, ",") }}"/>

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="{{ '@'.config('app.twitter') }}">
	<meta name="twitter:title" content="{{ $user->fullName() }}">
	<meta name="twitter:description" content="{{ $user->resume->bio }}">
	<meta name="twitter:creator" content="{{ '@'.config('app.twitter') }}">
	<meta name="twitter:image:src" content="{{ asset('images/profile/'.$user->photo) }}">

	<!-- Open Graph data -->
	<meta property="og:title" content="{{ $user->fullName() }}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:image" content="{{ asset('images/profile/'.$user->photo) }}" />
	<meta property="og:description" content="{{ $user->resume->bio }}" />
	<meta property="og:site_name" content="کامت" />
@stop

@section('nav')
	@include('layouts.smallnav')
@stop

@section('content')

	<section class="container-fluid usersection" itemscope itemtype="http://schema.org/Person">
		<div class="row text-center">
			<div class="usercover">
				<div class="coveroverlay"></div>
				<img class="img-responsive" src="{{ asset('images/cover/'.$user->cover) }}" alt="{{ $user->fullName() }} Cover">
			</div>

			<div class="userprofilepic">
				<img class="img-circle img-thumbnail img-responsive" itemprop="image" src="{{ asset('images/profile/'.$user->photo) }}" alt="{{ $user->fullName() }}">
				<h2 class="text-shadow" itemprop="name">{{ $user->fullName() }}</h2>
				<p class="text-shadow" itemprop="jobtitle"><i class="fa fa-briefcase yellow"></i>{{ $user->resume->jobtitle }}</p>
				<select class="userrate" data-rate="{{ floatval($user->profileRates()->avg('score')) }}">
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5">5</option>
				</select>
				<div class="usermedal">
					<img src="{{ asset('images/stuff/medal1.png') }}" alt="">
					<span class="yellow text-shadow">{{ floatval($user->profileRates()->avg('score')) }}<b>امتیاز</b></span>
				</div>
			</div>
		</div>
	</section>


	<section class="normalsection userinfo">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 userskill">
					<i class="fa fa-bar-chart yellow headericon"></i>
					<h3 class="text-right headertitle">مهارت ها</h3>
					<div class="text-center">
						<div class="circleprogress" data-value="8.5">
							<span></span>
						</div>

						<div class="circleprogress" data-value="4.8">
							<span></span>
						</div>

						<div class="circleprogress" data-value="6.7">
							<span></span>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 userbio">
					<i class="fa fa-info-circle yellow headericon"></i>
					<h3 class="text-right headertitle">بیوگرافی</h3>
					<blockquote cite="http://example.com/facts">
						<p class="text-justify">
							<i class="fa fa-fw fa-quote-right"></i>
							{{ $user->resume->bio }}
							<i class="fa fa-fw fa-quote-left"></i>
						</p>
					</blockquote>
				</div>
			</div>
		</div>
	</section>


	<section class="usertimeline container normalsection">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading specialHeading">خط زمانی</h2>
                <h3 class="section-subheading text-muted">تاریخچه <b class="cyan">تحصیلات</b> و <b class="yellow">تجربیات</b></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image backYellow">
                            <i class="fa fa-lg fa-briefcase"></i>
                        </div> 
                        <div class="timeline-panel">
                        	<i class="fa fa-caret-right fa-2x"></i>
                            <div class="timeline-body">
                            	<time class="subheading cyan" datetime="2011-01-12">90 - 93</time>
                                <p class="text-muted">گروه <b class="yellow">کامت</b> با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه <b class="lato cyan">PHP</b> و فریمورک هایی چون <b class="lato cyan">Laravel</b>، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image backCyan">
                            <i class="fa fa-lg fa-book"></i>
                        </div>
                        <div class="timeline-panel">
                        	<i class="fa fa-caret-left fa-2x hidden-xs"></i>
                        	<i class="fa fa-caret-right fa-2x visible-xs"></i>
                            <div class="timeline-body">
                                <p class="text-muted">همانطور که می دانید <b class="lato cyan">HTML</b> و <b class="lato cyan">CSS</b> زبان های برنامه نویسی هستند که ساختار و ظاهر وب سایت را تشکیل می دهند. گروه <b class="yellow">کامت</b> با استفاده از اخرین نسخه این زبان ها و همچنین با بهره گیری از به روزترین فریم ورک ها از جمله <b class="lato cyan">BootStrap</b> و <b class="lato cyan">Materialize</b> میتواند، ساختار و ظاهری بهینه و زیبا متناسب با نیاز شما طراحی کند.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image backYellow">
                            <i class="fa fa-lg fa-briefcase"></i>
                        </div>
                        <div class="timeline-panel">
                        	<i class="fa fa-caret-right fa-2x"></i>
                            <div class="timeline-body">
                                <p class="text-muted">همانطور که می دانید <b class="lato cyan">HTML</b> و <b class="lato cyan">CSS</b> زبان های برنامه نویسی هستند که ساختار و ظاهر وب سایت را تشکیل می دهند. گروه <b class="yellow">کامت</b> با استفاده از اخرین نسخه این زبان ها و همچنین با بهره گیری از به روزترین فریم ورک ها از جمله <b class="lato cyan">BootStrap</b> و <b class="lato cyan">Materialize</b> میتواند، ساختار و ظاهری بهینه و زیبا متناسب با نیاز شما طراحی کند.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image backCyan">
                            <i class="fa fa-lg fa-book"></i>
                        </div>
                        <div class="timeline-panel">
                        	<i class="fa fa-caret-left fa-2x hidden-xs"></i>
                        	<i class="fa fa-caret-right fa-2x visible-xs"></i>
                            <div class="timeline-body">
                                <p class="text-muted">همانطور که می دانید <b class="lato cyan">HTML</b> و <b class="lato cyan">CSS</b> زبان های برنامه نویسی هستند که ساختار و ظاهر وب سایت را تشکیل می دهند. گروه <b class="yellow">کامت</b> با استفاده از اخرین نسخه این زبان ها و همچنین با بهره گیری از به روزترین فریم ورک ها از جمله <b class="lato cyan">BootStrap</b> و <b class="lato cyan">Materialize</b> میتواند، ساختار و ظاهری بهینه و زیبا متناسب با نیاز شما طراحی کند.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image backYellow">
                            <i class="fa fa-lg fa-briefcase"></i>
                        </div>
                        <div class="timeline-panel">
                        	<i class="fa fa-caret-right fa-2x"></i>
                            <div class="timeline-body">
                                <p class="text-muted">همانطور که می دانید <b class="lato cyan">HTML</b> و <b class="lato cyan">CSS</b> زبان های برنامه نویسی هستند که ساختار و ظاهر وب سایت را تشکیل می دهند. گروه <b class="yellow">کامت</b> با استفاده از اخرین نسخه این زبان ها و همچنین با بهره گیری از به روزترین فریم ورک ها از جمله <b class="lato cyan">BootStrap</b> و <b class="lato cyan">Materialize</b> میتواند، ساختار و ظاهری بهینه و زیبا متناسب با نیاز شما طراحی کند.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image backYellow">
                            <i class="fa fa-lg fa-briefcase"></i>
                        </div>
                        <div class="timeline-panel">
                        	<i class="fa fa-caret-right fa-2x"></i>
                            <div class="timeline-body">
                                <p class="text-muted">همانطور که می دانید <b class="lato cyan">HTML</b> و <b class="lato cyan">CSS</b> زبان های برنامه نویسی هستند که ساختار و ظاهر وب سایت را تشکیل می دهند. گروه <b class="yellow">کامت</b> با استفاده از اخرین نسخه این زبان ها و همچنین با بهره گیری از به روزترین فریم ورک ها از جمله <b class="lato cyan">BootStrap</b> و <b class="lato cyan">Materialize</b> میتواند، ساختار و ظاهری بهینه و زیبا متناسب با نیاز شما طراحی کند.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img src="{{ asset('img/icons/5.jpg') }}" class="img-circle img-responsive">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
	</section>

<div>
	<h1>{{ $user->first_name.' '.$user->last_name }}</h1>
	<p>{{ $user->email }}</p>
	<p>{{ $user->resume->jobtitle }}</p>
	<p>{{ $user->resume->bio }}</p>
	<p>{{ $user->resume->duty }}</p>
	<p>total likes : {{ $user->likes()->count() }}</p>
	<p>total comments : {{ $user->comments()->count() }}</p>
	<p>total profile comments : {{ $user->profileComments()->count() }}</p>
	<p>profile avg rate : {{ $user->profileRates()->avg('score') }}</p>
	<p>total rates : {{ $user->rates()->count() }}</p>
	<p>Role : {{ $user->roles()->first()->name }}</p>

	@foreach( $comments as $comment )

		<img src="{{ asset('images/profile/'.$comment->fromUser->photo) }}" width="50">
		<h6>{{ $comment->fromUser->first_name." ".$comment->fromUser->last_name }}</h6>
		<p>{{ $comment->text }}</p>

	@endforeach

	{!! Form::open(array('method' => 'post', 'route' => array('admin.user.destroy', $user->id))) !!}
	    
	    {!! method_field('DELETE') !!}
	    
	    {!! Form::button('delete', array('type' => 'submit')) !!}
	{!! Form::close() !!}

</div>

@stop


@section('js')
	<script src="{{ asset('js/circle-progress.js') }}" type="text/javascript"></script>
@stop


@section('customjs')
	<script type="text/javascript">
		$(document).ready(function() {
			$('select.userrate').barrating({
			    theme: 'fontawesome-stars'
			});
			$('select.userrate').barrating('set', Math.floor( $('select.userrate').data('rate')) );

			$('.circleprogress').each(function(index, el) {
				$(el).circleProgress({
				    value: $(el).data('value')/10,
				    size: 75,
				    fill: { gradient: ['#fed136', '#fec503'] },
				    animation: {
				        duration: 3000,
				        easing: 'circleProgressEasing'
				    }
				}).on('circle-animation-progress', function(event, progress, stepValue) {
	    			$(el).find('span').html((stepValue*10).toFixed(1));
				});
			});
			

			var timelineBlocks = $('.timeline li'),
				offset = 0.8;

			//hide timeline blocks which are outside the viewport
			hideBlocks(timelineBlocks, offset);

			//on scolling, show/animate timeline blocks when enter the viewport
			$(window).on('scroll', function(){
				(!window.requestAnimationFrame) 
					? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
					: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
			});

			function hideBlocks(blocks, offset) {
				blocks.each(function(){
					( $(this).offset().top > $(window).scrollTop()+$(window).height()*offset ) && $(this).find('.timeline-image, .timeline-panel').addClass('is-hidden');
				});
			}

			function showBlocks(blocks, offset) {
				blocks.each(function(i,el){

					if( $(window).width() > 767 ) {
						if( $(el).hasClass('timeline-inverted') ) addClass = 'zoomInRight';
						else addClass = 'zoomInLeft';
					}else{
						addClass = 'bounceInLeft';
					}

					if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.timeline-image').hasClass('is-hidden') ) {
						$(this).find('.timeline-image').removeClass('is-hidden').addClass('animated bounceIn');
						$(this).find('.timeline-panel').removeClass('is-hidden').addClass('animated '+addClass);
					} 
				});
			}
		});
	</script>
@stop