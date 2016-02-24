<nav class="navbar navbar-default navbar-shrink navbar-fixed-top shadow">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle slide-top shadow" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="comet-comet"></span>
            </button>
            <a class="navbar-brand scroll visible-xs transitionfast" href="#home"><img class="transitionfast" src='{{ asset('img/logo/comet_fa.png') }}'></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <!-- navbar right -->
            <ul class="nav navbar-nav navbar-right">

                @if( $user = Sentinel::check() )
                    @define $avgrates = floatval($user->profileRates()->avg('score'))
                    <!-- user small-->
                    <li class="dropdown userdropdown visible-xs">

                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="transitionfast shadow pull-left" src="{{ asset('images/profile/'.$user->photo) }}" alt="{{ $user->fullName() }}">
                            @if( isset($avgrates) )
                            <p class="transitionfast pull-left"><i class="fa fa-star yellow"></i>{{ $avgrates }}</p>
                            @endif
                            <p class="username">{{ $user->fullName() }}<span class="caret"></span></p>
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
                            <li><a class="closeonclick" href="{{ route('user.edit', ['user' => $user->id]) }}">تنظیمات <i class="fa fa-cog yellow"></i></a></li>
                            <li><a class="closeonclick" href="{{ route('logout') }}">خروج <i class="fa fa-sign-out yellow"></i></a></li>
                        </ul>
                    </li>
                @endif

                <li><a class="closeonclick" href="{{ url('/#contact') }}">تماس با ما</a></li>

                <li>
                    <a class="closeonclick" href="{{ route('post.index') }}">پروژه ها</a>
                    @if( $totalnewposts > 0 )
                        <span class="badge backYellow shadow hidden-xs transitionfast" data-toggle="tooltipfa" data-placement="bottom" title="پروژه های جدید" data-number="{{ $totalnewposts }}"></span>
                        <span class="badge backYellow shadow visible-xs transitionfast" data-number="{{ $totalnewposts }}"></span>
                    @endif
                </li>

                <li><a class="closeonclick" href="{{ url('/#services') }}">سرویس ها</a></li>

                <li><a class="closeonclick" href="{{ url('/#about') }}">درباره ما</a></li>

                <li><a class="closeonclick" href="{{ route('home') }}">صفحه اصلی</a></li>

                <!-- logo -->
                <a class="hidden-xs scroll" href="#home"><img class="logo" src='{{ asset('img/logo/comet_fa.png') }}'></a>
            </ul>
            <!-- navbar left -->
            <ul class="nav navbar-nav navbar-left">

                @if( $user = Sentinel::check() )
                    <!-- user big -->
                    <li class="dropdown userdropdown hidden-xs">
                        @if( isset($avgrates) )
                            <!-- rates -->
                            <select class="navrate" data-rate="{{ $avgrates }}">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <span class="navratenum transitionfast">{{ $avgrates }}</span>
                        @endif
                        <!-- Toggle -->
                        <a data-toggle="dropdown" class="transitionfast dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="transitionfast shadow" src="{{ asset('images/profile/'.$user->photo) }}" alt="{{ $user->fullName() }}">
                      
                            <div class="transitionfast userinfo">
                                <p class="transitionfast text-shadow">{{ $user->fullName() }}</p>

                                @if( isset($avgrates) )
                                <p class="transitionfast navratenum"><i class="fa fa-star yellow"></i>{{ $avgrates }}</p>
                                @endif

                                @if( isset( $user->resume->jobtitle ) )
                                    <small class="transitionfast text-shadow">{{ $user->resume->jobtitle }}</small>
                                @else
                                    <small class="transitionfast text-shadow lato">{{ $user->email }}</small>
                                @endif
                            </div>
                        </a>

                        <!-- dropdown -->
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
                            <li><a class="closeonclick" href="{{ route('user.show', ['user' => $user->id]) }}">صفحه شخصی <i class="fa fa-user yellow"></i></a></li>
                            <li><a href="{{ route('user.edit', ['user' => $user->id]) }}">تنظیمات <i class="fa fa-cog yellow"></i></a></li>
                            <li><a href="{{ route('logout') }}">خروج <i class="fa fa-sign-out yellow"></i></a></li>
                        </ul>
                    </li>
                @else
                    <!-- register and login -->
                    <li class="dropdown loginDropdown hidden-xs">

                        <a class="dropdown-toggle transitionfast" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" href="#">
                            <i class="fa fa-user-plus transitionfast"></i>
                            <div class=" transitionfast">
                                <p class="transitionfast text-shadow">ثبت نام</p>
                                <small class="transitionfast text-shadow">ورود به سایت</small>
                            </div>
                        </a>

                        <div class="dropdown-menu">
                            <i class="fa fa-caret-up fa-2x transitionfast"></i>
                            <div class="col-md-12">
                                <div class="row">
                                    {!! Form::open(array('route' => 'login')) !!}
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                {!! Form::email('email', null, array('placeholder' => 'پست الکترنیکی', 'class' => 'form-control loginSize')) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                                {!! Form::password('password', array('placeholder' => ' کلمه عبور', 'class' => 'form-control loginSize')) !!}
                                            </div>
                                            <a role="button" class="pull-left forget" href="{{ route('forgot') }}">فراموشی کلمه عبور</a>
                                        </div>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="remember" class="onoffswitch-checkbox" id="myonoffswitch">
                                            <label class="onoffswitch-label" for="myonoffswitch">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>

                                        {!! Form::button('<i class="fa fa-sign-in"></i> ورود', array('class' => 'btn btn-primary loginSize transtionfast','type' => 'submit')) !!}
                                        <hr class="hline">
                                        <a class="btn btn-info loginSize transtionfast" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> ثبت نام</a>

                                        <div class="cometName">
                                            <i class="comet comet-comet"></i>
                                            <span class="lato">Comet Design &amp; Developement</span>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="btn-group col-xs-12 visible-xs">
                        <a class="btn btn-primary col-xs-6 transtionfast closeonclick" href="{{ route('login') }}">ورود <i class="fa fa-sign-in"></i></a>
                        <a class="btn btn-info col-xs-6 transtionfast closeonclick" href="{{ route('register') }}">ثبت نام <i class="fa fa-user-plus"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        
    </div>
</nav>
<!-- Notification Sound -->
<div id="Sound" style="display:none;"></div>