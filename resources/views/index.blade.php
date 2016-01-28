@extends('layouts.template')

@section('seo')
    <!-- Add Schema -->
    <script type="application/ld+json">
      {
        "@context" : "http://schema.org",
        "@type" : "Organization",
        "description" : "طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد.",
        "name" : "name of the site",
        "url" : "link of the site",
        "logo": "logo of the site",
        "email": "info email",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.5",
            "reviewCount": "152"
          },
        "founders":[
                  <?php //foreach ($Admins as $key => $Admin):?>
                    {
                      "@type": "Person",
                      "image": name ofthe person",
                      "jobTitle": "job title",
                      "email":"email"
                    }<?php //if( (count($Admins)-1) !== $key ) echo ","; ?>
                  <?php //endforeach; ?>
                  ],
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
          "twitter link",
          "facebook link"
        ]
      }
    </script>

    <meta name="description" content="طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد."/>
    <meta name="keywords" content="طراحی و توسعه کامت,طراحی سایت,کامت,طراحی سایت کامت,ساخت وب سایت کامت,وب سایت,طراحی,توسعه,طراحی کامت,ساخت وب سایت"/>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="twitter name with at sign">
    <meta name="twitter:title" content="title of the page">
    <meta name="twitter:description" content="طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد.">
    <meta name="twitter:creator" content="twitter name with at sign">
    <meta name="twitter:image:src" content="large picture for twitter share">

    <!-- Open Graph data -->
    <meta property="og:title" content="title of the page" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="link of the page" />
    <meta property="og:image" content="large picture for other social network share" />
    <meta property="og:description" content="طراحی ، توسعه و مدیریت وب سایت تخصص ماست و تلاش ما در راستای انجام پروژه در بهترین حالت ممکن می باشد بنابراین کامت با خلق محصولات دیجیتال، طراحی وب سایت های پویا و پروژه های چند منظوره به شرکت ها و برندها کمک می کند تا پیشرفت چشمگیری در دنیای ارتباطات داشته باشند. کامت نسبت به مشتریان خود در طول انجام پروژه و پس از اتمام آن، با توجه به اهداف پروژه، متعهد است و همچنین خدمت به مشتریان از اهداف اصلی این گروه می باشد." />
    <meta property="og:site_name" content="the name of the site" />
@endsection

@section('css')
    <link href="{{ asset('css/comet.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Header Section -->
    <header>
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
    @if( $TotalPosts > 0 )
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">پروژه ها</h2>
                </div>
            </div>
            <div class="row masonry">

                @foreach($Posts as $Post)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 portfolio-item">
                    <div class="shadow">
                        <a id="{{ $Post->id }}" class="portfolio-link">
                            <div class="postimg">
                                <img src="{{ asset('images/portfolioThumb/'.$Post->thumb) }}" class="img-responsive transition" alt='{{ $Post->title }}'>
                            </div>
                        </a>
                        <div class="ribbon"><span>{{ $Post->cat->title }}</span></div> 
                        <div class="portfolio-caption">
                            <div class="portfolio-ajaxloader">
                                <img src="{{ asset('img/svg/3dots.svg') }}" width="45">
                            </div>
                            <div class="portfolio-like">
                                <h4>{{ $Post->title }}</h4>
                                    @if( $Post->isLiked() === 0 )
                                    <span id="{{ $Post->id }}" class="glyphicon glyphicon-heart enable transitionfast likePost"></span>
                                    @else
                                    <span id="{{ $Post->id }}" class="glyphicon glyphicon-heart disable transitionfast likePost"></span>
                                    @endif
                                @if( $Post->likes()->count() > 0 )
                                    <p class="likecount">{{ $Post->likes()->count() }}</p>
                                @else
                                    <p class="likecount"></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if( $TotalPosts > config('app.POSTS_LIMITS') && $LastPage > 1 )
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
                    <span class="glyphicon glyphicon-heart" data-toggle="tooltipfa" data-placement="top" title="مجموع لایک ها"></span>
                    <p class="yellow text-shadow">{{ $TotalLikes }}</p>
                </div>
                <div class="PortfolioNav-item text-center">
                    <span data-toggle="tooltipfa" data-placement="top" title="مجموع پروژه ها" class="glyphicon glyphicon-briefcase"></span>
                    <p class="green text-shadow">{{ $TotalPosts }}</p>
                </div>
                <div class="PortfolioNav-item text-center">
                    <span data-toggle="tooltipfa" data-placement="top" title="مجموع صفحات" class="glyphicon glyphicon-inbox"></span>
                    <p class="cyan text-shadow LastPage">{{ $LastPage }}</p>
                </div>
                <div class="PortfolioNav-item text-center">
                    <span data-toggle="tooltipfa" data-placement="top" title="صفحه در حال مشاهده" class="glyphicon glyphicon-eye-open"></span>
                    <p class="pink text-shadow">{{ $Page }}</p>
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
    <section id="contact">
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
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                {{ Form::text('name',null, array('class' => 'form-control transitionslow', 'placeholder' => 'نام و نام خانوادگی')) }}
                            </div>
                        </div>


                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                {{ Form::text('mail',null, array('class' => 'form-control transitionslow', 'placeholder' => 'پست الکترونیک')) }}
                                
                            </div>

                        </div>
                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                                {{ Form::text('tel',null, array('class' => 'form-control transitionslow', 'placeholder' => 'شماره تماس')) }}
                            </div>
                        </div>
                    
                        <div class="form-group shadow">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-align-left"></span></span>
                                {{ Form::textarea('des',null, array('class' => 'form-control transitionslow', 'placeholder' => 'توضیحات')) }}
                            </div>
                        </div>
                        <div class="btn-group btn-group-lg shadow" role="group" aria-label="...">
                            {!! Form::button('<span class="glyphicon glyphicon-retweet"></span>', array('class' => 'btn btn-default', 'type' => 'reset')) !!}
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
                            <span class="glyphicon glyphicon-qrcode"></span>
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
    <script src='{{ asset('js/chart.min.js') }}'></script>
    <script src='{{ asset('js/comet.func.js') }}'></script>
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
            // Skills();
            PortfolioModalSetup();
            PostsLikeSetup();
            PortfolioPaginationSetup();
            ContactFormSetup();
        });
    </script>
@endsection