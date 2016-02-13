@extends('layouts.template')

@section('seo')
    <!-- Add Schema -->
    <script type="application/ld+json">
      {
        "@context" : "http://schema.org",
        "@type" : "Organization",
        "description" : "طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد.",
        "name" : "گروه طراحی و توسعه کامت",
        "url" : "{{ url()->current() }}",
        "logo": "{{ asset('img/logo/comdet_fa.png') }}",
        "email": "{{ config('app.info_email') }}",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.5",
            "reviewCount": "152"
          },
        "foundingDate":"2015",
        "location": {
          "@type": "Place",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Tehran",
            "addressRegion": "Iran"
          }
        },
        "sameAs" : [
          "https://twitter.com/{{ config('app.twitter') }}",
          "https://facebook.com/{{ config('app.facebook') }}"
        ]
      }
    </script>

    <meta name="description" content="طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد."/>
    <meta name="keywords" content="طراحی و توسعه کامت,طراحی سایت,کامت,طراحی سایت کامت,ساخت وب سایت کامت,وب سایت,طراحی,توسعه,طراحی کامت,ساخت وب سایت"/>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ '@'.config('app.twitter') }}">
    <meta name="twitter:title" content="گروه طراحی و توسعه کامت">
    <meta name="twitter:description" content="طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد.">
    <meta name="twitter:creator" content="{{ '@'.config('app.twitter') }}">
    <meta name="twitter:image:src" content="{{ asset('images/banner/0/0/1/banner_large.jpg') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="گروه طراحی و توسعه کامت" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/banner/0/0/1/banner_large.jpg') }}" />
    <meta property="og:description" content="طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد." />
    <meta property="og:site_name" content="کامت" />
@endsection

@section('title')
    {{ 'گروه طراحی و توسعه کامت' }}
@endsection

@section('nav')
    @include('layouts.nav')
@stop

@section('content')
    <!-- Header Section -->
    <header style="background-image:url({{ asset('img/backgrounds/'.array_shift($background)) }});">
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading text-shadow">طـــراحی <b class="yellow">خاص</b> و منحصــر بـه فرد</div>
                <a href="#about" class="btn btn-xl btn-noback transition scroll HoverAnimation">میخوای بیشتر بدونی ؟<span class="comet-telescope"></span></a>
            </div>
            <img class="mockup img-responsive hidden-xs" src="{{ asset('img/stuff/header_mac.png') }}">
        </div>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-heading"><b class="yellow">کامِت</b> چیست؟</h2>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-justify">
                    <p>طراحی، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام <a class="cyan pointer scroll" href="#portfolio"><b>پروژه</b></a> در بهترین حالت ممکن می باشد بنابراین <b class="yellow">کامت</b> با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. <b class="yellow">کامت</b> نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد.</p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-justify">
                    <p><b class="yellow">کامت</b> از افرادی با تجربه و علاقه مند به طراحی تشکیل شده است که هدف اصلی این گروه طراحی و توسعه وب با بهره گیری از بروزترین نرم افزارها و کدها می باشد، همچنین این گروه تمام تمرکز خود را صرف طراحی و توسعه وب متناسب با نیاز مشتری کرده است. ما معتقدیم که ایده ها می توانند از هر جایی یا هر شخصی بوجود بیایند و این اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section -->
    <section id="services" class="bg-light-gray">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <img src="{{ asset('img/stuff/responsive.png') }}" class="img-responsive ResponsiveMockup">
                    <h2 class="section-heading">طراحی واکنش گرا</h2>
                </div>
                <div class="col-lg-12 text-justify">
                    <p>امروزه کاربران از بیشمار نمایشگر در ابعاد بزرگ و کوچک برای دستیابی به صفحات اینترنت استفاده می کنند. همان طور که در معماری، با بهره گرفتن از تكنولوژی مدرن این امكان را فراهم می آورند تا بتوان اجزاء و تجهیزات مختلف را به طور خودكار كنترل نمود، طراحی وب سایت واکنش گرا نیز رویکرد مناسبی است که طراحان وب را قادر می سازد تا با پیاده سازی وب سایت انعطاف پذیر، نسبت به تغییر دستگاه کاربران واکنش دهد. تا چندی پیش برای نمایش یک وب سایت در موبایل، طراحی و برنامه نویسی مجزا انجام می‌شد. در این نوع طراحی، سرور با توجه به شناسه مرورگر کاربر تشخیص می داد که کاربر سایت را با موبایل بازدید می کند در این حالت محتوای موبایل را در همان آدرس به او نشان می‌داد اما در طراحی واکنش گرا ساختار لایه‌های سایت به صورت شناور طراحی می‌شوند که باعث تنظیم عرض صفحه، سایز متن و ... در ابعاد مختلف می شود که این کار به صورت کاملا خودکار انجام می‌شود. <b class="yellow">کامت</b> با استفاده از فریم ورک هایی چون  <b class="cyan lato">BootStrap</b>  و  <b class="cyan lato">Materialize</b>  این قابلیت را برای وب سایت شما فراهم می کند.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading specialHeading">سرویس ها</h2>
                    <h3 class="section-subheading text-muted">سرویس های ارائه شده توسط <b class="yellow">کامت</b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/icons/1.jpg">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <img src='{{ asset('img/icons/php.png') }}' data-toggle="tooltip" data-placement="top" title="PHP">
                                    <img src='{{ asset('img/icons/laravel.png') }}' data-toggle="tooltip" data-placement="top" title="Laravel PHP Framework">
                                    <img src='{{ asset('img/icons/sql.png') }}' data-toggle="tooltip" data-placement="top" title="MySQL">
                                    <h4 class="subheading cyan">هسته ای قدرتمند و ایمن!</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">گروه <b class="yellow">کامت</b> با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه <b class="lato cyan">PHP</b> و فریمورک هایی چون <b class="lato cyan">Laravel</b>، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/icons/2.jpg">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <img src='{{ asset('img/icons/html.png') }}' data-toggle="tooltip" data-placement="top" title="HTML5">
                                    <img src='{{ asset('img/icons/css.png') }}' data-toggle="tooltip" data-placement="top" title="CSS3">
                                    <img src='{{ asset('img/icons/bootstrap.png') }}' data-toggle="tooltip" data-placement="top" title="Bootstrap CSS Framework">
                                    <h4 class="subheading cyan">ساختاری بهینه و واکنش گرا</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">همانطور که می دانید <b class="lato cyan">HTML</b> و <b class="lato cyan">CSS</b> زبان های برنامه نویسی هستند که ساختار و ظاهر وب سایت را تشکیل می دهند. گروه <b class="yellow">کامت</b> با استفاده از اخرین نسخه این زبان ها و همچنین با بهره گیری از به روزترین فریم ورک ها از جمله <b class="lato cyan">BootStrap</b> و <b class="lato cyan">Materialize</b> میتواند، ساختار و ظاهری بهینه و زیبا متناسب با نیاز شما طراحی کند.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/icons/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <img src='{{ asset('img/icons/js.png') }}' data-toggle="tooltip" data-placement="top" title="JavaScript">
                                    <img src='{{ asset('img/icons/jquery.png') }}' data-toggle="tooltip" data-placement="top" title="jQuery Library">
                                    <img src='{{ asset('img/icons/ajax.png') }}' data-toggle="tooltip" data-placement="top" title="Ajax">
                                    <img src='{{ asset('img/icons/angularjs.png') }}' data-toggle="tooltip" data-placement="top" title="AngularJS">
                                    <h4 class="subheading cyan">ایجاد محیطی کاربر پسند و سریع</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted"><b class="lato cyan">jQuery</b> یک کتابخانه جاوااسکریپت سبک ‌وزنِ چند مرورگری است که استانداردهای بالایی برای طراحی و عملکرد وب سایت ها فراهم می نماید . یکی از قابلیت های این کتابخانه <b class="lato cyan">Ajax</b> می باشد که قادر است محتویات صفحه را بدون بارگزاری مجدد کل صفحه به روز رسانی کند . <b class="yellow">کامت</b> با بهره مندی از این قابلیت می تواند محیطی کاربر پسند و پویا را برای وب سایت شما فراهم کند.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/icons/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <img src='{{ asset('img/icons/seo.png') }}' data-toggle="tooltip" data-placement="top" title="SEO Management">
                                    <h4 class="subheading cyan">بهینه سازی موتورهای جستجو</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">همانطور که میدانید وب‌ سایت هایی که دارای بالاترین رتبه و بیشترین تکرار در صفحه نتایج موتورهای جستجو باشند، دارای بیشترین بازدید می باشند . <b class="yellow">کامت</b> با مدیریت محتوا و مهندسی <b class="lato cyan">SEO</b> این امکان را برای بالابردن تعداد بازدید سایت شما فراهم می کند، در واقع عملیاتی است که در نتیجه آن بازدید یک وب ‌سایت را در صفحه نتایج موتورهای جستجو که خواه طبیعی و یا الگوریتمی باشد، به صورت چشمگیری افزایش می دهد.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img src="{{ asset('img/icons/5.jpg') }}" class="img-circle img-responsive">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- Portfolio Section -->
    @if( $totalposts > 0 )
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">پروژه ها</h2>
                </div>
            </div>
            <div class="row masonry">
                @foreach($posts as $post)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 portfolio-item">
                    <div class="shadow">
                        <a id="{{ $post->id }}" class="portfolio-link">
                            <div class="postimg">
                                <img src="{{ asset('images/portfolioThumb/'.$post->thumb) }}" class="img-responsive transition" alt='{{ $post->title }}'>
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

                                    @if( $post->isLiked( $user ) === 0 )
                                        <i id="{{ $post->id }}" class="fa fa-heart enable transitionfast likePost"></i>
                                    @else
                                        <i id="{{ $post->id }}" class="fa fa-heart disable transitionfast likePost"></i>
                                    @endif

                                    @if( $post->likes()->count() > 0 )
                                        <p class="likecount">{{ $post->likes()->count() }}</p>
                                    @else
                                        <p class="likecount"></p>
                                    @endif

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if( $totalposts > config('app.posts_per_page') && $lastpage > 1 )
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="btn btn-xl btn-primary transition loadmorePortfolio HoverAnimation">مشاهده پروژه های بیشتر<span class="Spin"></span><span class="comet-sattelite"></span></button>
                </div>
            </div>
            @endif
        </div>
        <div class="container-fluid PortfolioNav">
            <div class="row text-center">
                <div class="PortfolioNav-item text-center">
                    <i class="fa fa-heart" data-toggle="tooltipfa" data-placement="top" title="مجموع لایک ها"></i>
                    <p class="yellow text-shadow">{{ $totallikes }}</p>
                </div>
                <div class="PortfolioNav-item text-center">
                    <i data-toggle="tooltipfa" data-placement="top" title="مجموع پروژه ها" class="fa fa-briefcase"></i>
                    <p class="green text-shadow">{{ $totalposts }}</p>
                </div>
                <div class="PortfolioNav-item text-center">
                    <i data-toggle="tooltipfa" data-placement="top" title="مجموع صفحات" class="fa fa-inbox"></i>
                    <p class="cyan text-shadow LastPage">{{ $lastpage }}</p>
                </div>
                <div class="PortfolioNav-item text-center">
                    <i data-toggle="tooltipfa" data-placement="top" title="صفحه در حال مشاهده" class="fa fa-eye"></i>
                    <p class="pink text-shadow">{{ $page }}</p>
                </div>
            </div>
        </div>
    </section>
    @else
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center noPortfolio">
                    <span class="comet-sattelite animated tada infinite"></span>
                    <p>در حال حاضر پروژه ای موجود نیست.</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" style="background-image:url({{ asset('img/backgrounds/'.array_shift($background)) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-shadow">با ما تماس بگیرید</h2>
                </div>

                <!-- form -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    {!! Form::open(array('method' => 'post', 'class' => 'ContactForm')) !!}
                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                {{ Form::text('fullname',null, array('class' => 'form-control transitionslow', 'placeholder' => 'نام و نام خانوادگی')) }}
                            </div>
                        </div>


                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {{ Form::text('email',null, array('class' => 'form-control transitionslow', 'placeholder' => 'پست الکترونیک')) }}
                                
                            </div>

                        </div>
                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                {{ Form::text('tel',null, array('class' => 'form-control transitionslow', 'placeholder' => 'شماره تماس')) }}
                            </div>
                        </div>
                    
                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-align-left"></i></span>
                                {{ Form::textarea('des',null, array('class' => 'form-control transitionslow', 'placeholder' => 'توضیحات', 'rows' => 7)) }}
                            </div>
                        </div>
                        <div class="btn-group btn-group-lg shadow" role="group" aria-label="...">
                            {!! Form::button('<i class="fa fa-retweet"></i>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
                            {!! Form::button('ارســــــــال<span class="Spin"></span><span class="comet-spaceman"></span>', array('class' => 'btn btn-xl HoverAnimation', 'id' => 'submit', 'type' => 'submit')) !!}
                        </div>
                    {!! Form::close() !!}

                </div>

                <!-- Qr Section -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="text-center QRCode">
                        <img class="shadow radius5" src='{{ asset('img/stuff/qrcode.png') }}'>
                        <div>
                            <img width="180" src='{{ asset('img/logo/logofashadow.png') }}'>
                            <p>به دفتر تلفنت اضافه کن !</p>
                            <i class="fa fa-qrcode"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src='{{ asset('js/imageloaded.min.js') }}'></script>
    <script src='{{ asset('js/masonry.min.js') }}'></script>
@endsection

@section('customjs')
    <script type="text/javascript">
        $(document).ready(function() {
            AjaxSetup();
            LayoutFixer();
            MockUpAnimation();
            NavigationSetup();
            Scroll();
            Counter('.navbar-nav .badge');
            Tooltip();
            Masonry('.masonry','.portfolio-item','.portfolio-item');
            HoverAnimation();
            PortfolioModalSetup();
            PostsLikeSetup();
            PortfolioPaginationSetup();
            ContactFormSetup();
        });
    </script>
@endsection
