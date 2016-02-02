<nav class="navbar navbar-default navbar-fixed-top shadow">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle slide-top shadow" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="comet-comet"></span>
            </button>
            <a class="navbar-brand scroll" href="#home"><img src='{{ asset('img/logo/comet_fa.png') }}'></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">نام و نام خانوادگی <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('post.index') }}">مدیریت پست ها</a></li>
                    <li><a href="#">ADMIN</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Another action</a></li>
                  </ul>
                </li>
                
                <li><a class="scroll" href="#contact">تماس با ما</a></li>
                <li>
                    <a class="scroll" href="#portfolio">پروژه ها</a>
                    @if( $totalnewposts > 0 )
                    <span class="badge backYellow shadow hidden-xs" data-toggle="tooltipfa" data-placement="bottom" title="پروژه های جدید" data-number="{{ $totalnewposts }}"></span>
                    <span class="badge backYellow shadow visible-xs" data-number="{{ $totalnewposts }}"></span>
                    @endif
                </li>
                <li><a class="scroll" href="#services">سرویس ها</a></li>
                <li><a class="scroll" href="#about">درباره ما</a></li>
            </ul>
        </div>

    </div>
</nav>
<!-- Notification Sound -->
<div id="Sound" style="display:none;"></div>