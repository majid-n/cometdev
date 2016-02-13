<nav class="navbar navbar-default navbar-shrink navbar-fixed-top shadow">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle slide-top shadow" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="comet-comet"></span>
            </button>
            <a class="navbar-brand scroll visible-xs" href="#home"><img src='{{ asset('img/logo/comet_fa.png') }}'></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <!-- navbar right -->
            <ul class="nav navbar-nav navbar-right">


                @if( $user = Sentinel::check() )
                    <!-- user small-->
                    <li class="dropdown visible-xs">

                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="transitionfast shadow pull-left" src="{{ asset('images/profile/'.$user->photo) }}" alt="{{ $user->fullName() }}">
                            <span class="caret"></span>
                            {{ $user->fullName() }}
                        </a>

                        <ul class="dropdown-menu">
                            @if( $user->inRole('admins') )
                                <li class="dropdown-header">.:&nbsp;&nbsp;مدیریت&nbsp;&nbsp;:.</li>
                                <li><a class="closeonclick" href="">پنل مدیریت <i class="fa fa-tachometer yellow"></i></a></li>
                                <li><a class="closeonclick" href="">مدیریت پست ها <i class="fa fa-briefcase yellow"></i></a></li>
                                <li><a class="closeonclick" href="">مدیریت دسته ها <i class="fa fa-th-list yellow"></i></a></li>
                                <li><a class="closeonclick" href="">مدیریت پیام ها <i class="fa fa-envelope yellow"></i></a></li>
                                <li><a class="closeonclick" href="">مدیریت کاربران <i class="fa fa-users yellow"></i></a></li>
                                <li role="separator" class="divider"></li>
                            @endif
                            <li><a class="closeonclick" href="{{ route('user.show', ['user' => $user->id]) }}">صفحه شخصی <i class="fa fa-user yellow"></i></a></li>
                            <li><a class="closeonclick" href="#">تنظیمات <i class="fa fa-cog yellow"></i></a></li>
                            <li><a class="closeonclick" href="{{ route('logout') }}">خروج <i class="fa fa-sign-out yellow"></i></a></li>
                        </ul>
                    </li>
                @endif

                <li><a class="closeonclick" href="{{ url('/#contact') }}">تماس با ما</a></li>

                <!-- register and login -->
                <li>
                    <a class="scroll closeonclick" href="{{ route('post.index') }}">پروژه ها</a>
                    @if( $totalnewposts > 0 )
                        <span class="badge backYellow shadow hidden-xs" data-toggle="tooltipfa" data-placement="bottom" title="پروژه های جدید" data-number="{{ $totalnewposts }}"></span>
                        <span class="badge backYellow shadow visible-xs" data-number="{{ $totalnewposts }}"></span>
                    @endif
                </li>

                <li><a class="scroll closeonclick" href="{{ url('/#services') }}">سرویس ها</a></li>

                <li><a class="scroll closeonclick" href="{{ url('/#about') }}">درباره ما</a></li>

                <li><a class="scroll closeonclick" href="{{ url('/') }}">صفحه اصلی</a></li>

                <!-- logo -->
                <a class="hidden-xs scroll" href="#home"><img class="logo" src='{{ asset('img/logo/comet_fa.png') }}'></a>
            </ul>
            <!-- navbar left -->
            <ul class="nav navbar-nav navbar-left">

                @if( $user = Sentinel::check() )
                    <!-- user big -->
                    <li class="dropdown userdropdown hidden-xs">

                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="transitionfast shadow" src="{{ asset('images/profile/'.$user->photo) }}" alt="{{ $user->fullName() }}">
                            <div>
                                <p class="transitionfast text-shadow">{{ $user->fullName() }}</p>
                                <small class="transitionfast text-shadow">{{ $user->resume->jobtitle }}</small>
                            </div>
                            
                        </a>

                        <ul class="dropdown-menu">
                            <i class="fa fa-caret-up fa-2x transitionfast"></i>

                            @if( $user->inRole('admins') )
                                <li class="dropdown-header">.:&nbsp;&nbsp;مدیریت&nbsp;&nbsp;:.</li>
                                <li><a href="">پنل مدیریت <i class="fa fa-tachometer yellow"></i></a></li>
                                <li><a href="">مدیریت پست ها <i class="fa fa-briefcase yellow"></i></a></li>
                                <li><a href="">مدیریت دسته ها <i class="fa fa-th-list yellow"></i></a></li>
                                <li><a href="">مدیریت پیام ها <i class="fa fa-envelope yellow"></i></a></li>
                                <li><a href="">مدیریت کاربران <i class="fa fa-users yellow"></i></a></li>
                                <li role="separator" class="divider"></li>
                            @endif
                            <li><a href="#">تنظیمات <i class="fa fa-cog yellow"></i></a></li>
                            <li><a href="{{ route('logout') }}">خروج <i class="fa fa-sign-out yellow"></i></a></li>
                        </ul>
                    </li>
                @else
                    <!-- register and login -->
                    <li><a class="yellow hidden-xs" href="{{ route('login') }}">ورود <i class="fa fa-sign-in"></i></a></li>
                    <li><a class="yellow hidden-xs" href="{{ route('register') }}">ثبت نام <i class="fa fa-user-plus"></i></a></li>
                    <li class="btn-group col-xs-12 visible-xs">
                        <a class="btn btn-primary col-xs-6 btn-noback transtionfast closeonclick" href="{{ route('login') }}">ورود <i class="fa fa-sign-in"></i></a>
                        <a class="btn btn-primary col-xs-6 btn-noback transtionfast closeonclick" href="{{ route('register') }}">ثبت نام <i class="fa fa-user-plus"></i></a>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
<!-- Notification Sound -->
<div id="Sound" style="display:none;"></div>