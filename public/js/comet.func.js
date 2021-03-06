var ModalParent,
    $Masonry,
    Page         = 1,
    LastPage     = parseInt($('.LastPage').html());

// Get Config Val
function GetValue(type){
    var Config = $('#configuration');
    return base64decode(Config.find('input[name="'+type+'"]').val());
}
//Encode and Decode
function base64encode(string){
    return btoa(string);
}
function base64decode(string){
    return atob(string);
}
// Add Css background to element
function Background(element,image){
    element.css({'background-image':'url('+image+')','background-size':'cover'});
}
// Setup tooltips
function Tooltip(){

    var Default        = '[data-toggle="tooltip"]',
        Persian        = '[data-toggle="tooltipfa"]',
        PersianOptions = {
                            // selector : Persian,
                            template : "<div class=\"tooltip\" role=\"tooltip\"><div class=\"tooltip-arrow\"></div><div class=\"tooltip-inner tooltip-fa\"></div></div>",
                            container: 'body',
                        },
        DefaultOptions = {
                            // selector : Default,
                            container: 'body',
                        },
        hideTooltip    = function() {
                            $(Default).tooltip('hide');
                            $(Persian).tooltip('hide');
                        },
        InitTooltip    = function() {
                            $(Default).tooltip(DefaultOptions);
                            $(Persian).tooltip(PersianOptions);
                        };
        
    InitTooltip();

    $(window).scroll(function(){ hideTooltip() });
    $(window).resize(function(event){ hideTooltip() });
    window.addEventListener("orientationchange", function() { hideTooltip() }, false);
}
// Check Modal is Open or not?
function isOpenModal(){
    return $('body').hasClass('modal-open') && $('.modal-backdrop').length > 0 && $('.modal').hasClass('in');
}
// is Comet Modal Open or not?
function isOpenCometModal(){
    return typeof ModalParent === 'object' && ModalParent !== undefined && ModalParent !== null && isOpenModal();
}
// Detect Touch Screen
function isTouch(){
    return !!('ontouchstart' in window) || !!('msmaxtouchpoints' in window.navigator);
}
//Ajax Setup
function AjaxSetup(){
    $.ajaxSetup({
        dataType : 'JSON',
        cache    : false,
        headers  : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
}
// Error Function
function ShowErr(errtxt,glyph){

    var content  = "<p class=\"errtxt\"><i class=\"fa fa-"+glyph+"\"></i>"+errtxt+"</p>",
        Modal    = $('.modal'),
        ErrModal = $('#ErrModal');

    if( isOpenModal() ) {

        Modal.modal('hide');
        Modal.one('hidden.bs.modal', function(event) {
            ErrModal.find('.modal-body').html(content);
            ErrModal.modal('show');
            PlaySound();
        });
    } else {

        ErrModal.find('.modal-body').html(content);
        ErrModal.modal('show');
        PlaySound();
    }
}
// Shrink Navigation on Scroll
function NavigationSetup() {

    var Shrink          = function() {

                            var ScrollY = ( window.pageYOffset || $(document.documentElement).scrollTop ),
                                Header  = $('.navbar-default');

                            if ( ScrollY >= 70 ) Header.addClass('navbar-shrink');
                            else Header.removeClass('navbar-shrink');
                        },
        ScrollSpy       = function() {

                            $('body').scrollspy({
                                target : '.navbar-fixed-top',
                                offset : 50
                            });
                        };

    Shrink();
    ScrollSpy();

    $(window).scroll(function(){ Shrink() });
}
// Close Nav on click in small Device
function CloseNavOnClick() {
    $('.closeonclick').click(function() {
        $('.navbar-toggle:visible').click();
    });
}
// Mockup Animation
function MockUpAnimation(){

    var MockUp = $('.mockup'),
        Moving = function(){

                    if( $(window).scrollTop() < ($(window).height()/4) ) MockUp.stop().animate({paddingTop: ($(window).scrollTop()) + "px"}, 2000);
                    else MockUp.stop().animate({paddingTop: "150px"}, 2000);
                };

    Moving();

    $(window).scroll(function(){ Moving() });
}
// Set element horizintalcenter of window on resize or orientation change usefull for form
function SetCenter(element){

    var gap             = 30,
        defaultMargin   = 10,
        elementHeight   = $(element).outerHeight();
        stopResoloution = 767,
        makeCenter      = function() {

                            if( canResize() ) {

                              margin = Math.ceil( ( $(window).height() - elementHeight )/2 ) - gap;

                              if( margin > defaultMargin ) $(element).css({'margin-top': margin,'margin-bottom': margin});
                              else $(element).css({'margin-top':defaultMargin,'margin-bottom': defaultMargin});

                            }else{

                              $(element).css({'margin-top':defaultMargin,'margin-bottom': defaultMargin});

                            }
                        },
        canResize       = function () {
                            return $(window).height() > elementHeight && $(window).height() > stopResoloution;
                        };


    makeCenter();

    $(window).resize(function(event) { makeCenter() });
    window.addEventListener("orientationchange", function() { makeCenter() }, false);
}
// Responsive Header Padding and backgrounds
function LayoutFixer(){

    var ContactArea = $('#contact'),
        Header      = $('header'),
        HeaderTxt   = Header.find('.intro-text'),
        FixPaddding = function() {

                        var Padding = Math.ceil($(window).height()/2-HeaderTxt.height());

                        Header.css({
                            'padding-top': Padding+80,
                            'padding-bottom': Padding-80,
                        });
                    };
        

    FixPaddding();

    $(window).resize(function(event) { FixPaddding() });
    window.addEventListener("orientationchange", function() { FixPaddding() }, false);
}
// File Input customization
function fileInput() {

    $( 'input[type="file"]' ).each( function() {

        var $input   = $( this ),
            $label   = $( 'input[type="text"].fileInputText' ),
            labelVal = $label.val();

        $input.on( 'change', function( event ) {

            var fileName = '';

            if( this.files && this.files.length > 1 ) 
                fileName = ( $(this).data( 'multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else if( event.target.value )
                fileName = event.target.value.split( '\\' ).pop();
            if( fileName )
                $label.val( fileName );
            else
                $label.val( labelVal );
        });

        // Firefox bug fix
        $input
        .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
        .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
    });
}
// ReadOnly Rating
function ReadonlyRate(element){
    $(element).barrating({
        theme: 'fontawesome-stars',
        readonly: true
    });
    $(element).barrating('set', Math.floor( $(element).data('rate')) );
}
// Select input Init
function SelectInit(){

    var select    = $('.form-group select'),
        badge     = $('.selectBadge'),
        checkItem = function(element) {

                        number = element.find('option:selected').data('title');
                        
                        if( number > 0) badge.html(number);
                        else badge.html('');
                    };

    checkItem(select);
    select.on('change', function() { checkItem($(this)) });
    $('button[type="reset"]').click(function() { $('.selectBadge').html('') });
}
// Animation Numbers
function Counter(element){

    // Default Value for element 
    element = typeof element === 'undefined' ? 'span.badge' : element;

    $(element).each(function () {

        var target    = $(this);
        var value     = target.data('number');
        var lastChar  = "";

        if( value != 0 && !target.hasClass('finishcounter') && !target.hasClass('startCounting')) {

            if( value.length > 0 && value.match(/(k|m|t|b)/i) ){

                lastChar = value.charAt(value.length-1);

                if( lastChar =='K' || lastChar =='M' || lastChar =='T' || lastChar =='B' ) {
                    value = value.substring(0, value.length-1);
                }
            }

            jQuery({ Counter: 0 }).animate({ Counter: value }, {

                duration: 5000,
                easing  :   'easeOutQuart',
                start   :   function() { target.addClass('startCounting') },
                step    :   function() { target.text(Math.round(this.Counter)+lastChar) },
                complete:   function() {
                                target.addClass('finishcounter');
                                target.removeClass('startCounting');
                            }
            });
        }else target.addClass('finishcounter');
    });
}
// Scroll to Target
function Scroll(offset){

    // Default Value for element 
    offset = typeof offset === 'undefined' ? 0 : offset;

    $('body').on('click','.scroll',function(event) {

        event.preventDefault();

        target = $(this).attr('href');
        $('html,body').animate({ scrollTop: $(target).offset().top-offset }, 2000, "easeInOutQuart");
    });
}
// Init Masonry
function Masonry(element,columnW,item){

    var imgLoader = imagesLoaded($(element)),
        ModalErr  = $('#ErrModal');

    $Masonry = $(element).masonry({
        percentPosition : true,
        columnWidth     : columnW,
        itemSelector    : item,
        isFitWidth      : false
    });

    $Masonry.imagesLoaded( function() {
        $Masonry.masonry('layout');
    });

    $Masonry.one( 'layoutComplete', function(event, laidOutItems) {
        // do something on layout complete
    });

    imgLoader.on('fail', function() {
        ShowErr("یک یا چند عکس از پروژه ها باگذاری نشده است. لطفا مجددا تلاش کنید","ban-circle yellow");
        ModalErr.on('hide.bs.modal', function() {window.location.reload()});
    });
}
//add item to Masonry
function MasonryAddItem(data,element){

    var imgLoader   = imagesLoaded($(element)),
        $Data       = $(data),
        ModalErr    = $('#ErrModal');

    $Masonry.append($Data).masonry( 'appended', $Data );

    $Masonry.imagesLoaded( function() {
        $Masonry.masonry('layout');
    });

    imgLoader.on('fail', function() {
        ShowErr("یک یا چند عکس از پروژه ها باگذاری نشده است. لطفا مجددا تلاش کنید","ban-circle yellow");
        ModalErr.on('hide.bs.modal', function() {window.location.reload()});
    });
}
//Hover animation
function HoverAnimation(){

    $('.HoverAnimation').hover(function() {
       $(this).find('span[class*="comet"]').addClass('animated infinite tada');
    }, function() {
       $(this).find('span[class*="comet"]').removeClass('animated infinite tada');
    });
}
// Play Sound
function PlaySound(){
    $('#Sound').html('');
    $("<audio autoplay><source src=\"sound/NotificationSound.mp3\".mp3' type='audio/mpeg'></audio>").appendTo('#Sound');
}
// Modal Portfolio Setup
function PortfolioModalSetup(){

    // clear modal on close
    $('body').on('hide.bs.modal','#cometModal', function() {
        $(this).find('.modal-body').remove();
        $(this).find('.modal-footer').remove();
        $(this).find('.cometModalLoader').remove();
        ModalParent = undefined;
    });

    // Open Portfolio
    $('body').on('click', '.portfolio-link', function(event) {

        event.preventDefault();

        var Loader = "<div class=\"cometModalLoader\"><img src=\"img/svg/3dots.svg\" width=\"64\"></div>";
        $('#cometModal').find('.modal-content').append(Loader);
        $('#cometModal').modal('show');

        var el          = $(this),
            PID         = el.attr('id'),
            Modal       = $('#cometModal'),
            ModalHeader = Modal.find('.modal-header'),
            ModalLoader = Modal.find('.modal-content .cometModalLoader');

        $.ajax({
            url  : 'post/'+PID,
            type : 'GET'
        })
        .done(function(data) {

            if( data.result === true ) {

                ModalLoader.fadeTo(500,0,function(){
                    ModalHeader.after(data.modaldata);
                    Modal.find('.modal-body .modalEl').fadeIn(500);
                    Modal.find('.modal-footer').fadeIn(500);
                    ModalParent = el;
                });

            }else{

                Modal.modal('hide');
                ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
            }
        })
        .fail(function() {
            Modal.modal('hide');
            ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
        })
        .always(function(){
            ModalLoader.remove();
        });
    });
}
// Posts Likes
function PostsLikeSetup(){

    // Like Portfolio
    $('body').on('click', '.likePost', function(event) {

        event.preventDefault();
        var target    = $(event.target),
            PID       = target.attr('id'),
            TotalNav  = $('.PortfolioNav-item p.yellow'),
            ModalOpen = isOpenCometModal();

        if( ModalOpen ) {

            var LikeSpan            = ModalParent.parents('.portfolio-item').find('.portfolio-like i'),
                LikeParagraph       = ModalParent.parents('.portfolio-item').find('.portfolio-like .likecount'),
                Loader              = target.parent().find('img'),
                ModalLikeParagraph  = target.parent().find('p'),
                ModalLikeSpan       = target,
                FadeElement         = target;

        }else{

            var LikeSpan      = target.parent('.portfolio-like').find('i'),
                LikeParagraph = target.parent('.portfolio-like').find('.likecount'),
                Loader        = target.parents('.portfolio-caption').find('.portfolio-ajaxloader'),
                FadeElement   = target.parent('.portfolio-like');

        }

        FadeElement.fadeOut(400,function(){
            Loader.fadeIn(400);     
        });
       

        $.ajax({
            url  : 'post/'+PID+'/like',
            type : 'GET',
        })
        .done(function(data) {
            if(data.result === true ){

                if( data.status === 'like' ) {
                    if( ModalOpen ) ModalLikeSpan.removeClass('enable').addClass('disable');
                    LikeSpan.removeClass('enable').addClass('disable');
                }

                if( data.status === 'unlike' ) {
                    if( ModalOpen ) ModalLikeSpan.removeClass('disable').addClass('enable');
                    LikeSpan.removeClass('disable').addClass('enable');
                }

                if( ModalOpen ) {
                    if( parseInt(data.totalpostlikes) === 0 ) ModalLikeParagraph.html("لایک کنید!");
                    else ModalLikeParagraph.html(data.totalpostlikes);
                }

                if( parseInt(data.totalpostlikes) === 0 ) LikeParagraph.html('');
                else LikeParagraph.html(data.totalpostlikes);
                TotalNav.html(data.totallikes);

            }else{

                if( ModalOpen ) $('.modal').modal('hide');
                ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
            }
        })
        .fail(function() {
            if( ModalOpen ) $('.modal').modal('hide');
            ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
        })
        .always(function() {

            Loader.fadeOut(400,function(){
                FadeElement.fadeIn(400);
            });
        });
    });
}
// Portfolio Pagination
function PortfolioPaginationSetup(){

    $('body').on('click', '.loadmorePortfolio', function(event) {

        event.preventDefault();

        var target       = $(this),
            ButtonSpan   = $('.loadmorePortfolio span.comet-sattelite'),
            ButtonLoader = $('.loadmorePortfolio span.Spin'),
            PageViewed   = $('.PortfolioNav-item p.pink');
            TotalPages   = $('.PortfolioNav-item p.cyan');

        target.prop('disabled',true);

        if( ButtonSpan.hasClass('tada') ){
            ButtonSpan.removeClass('animated infinite tada');
        }

        ButtonSpan.fadeTo(500, 0, function() {
            ButtonLoader.show(500);
        });

        if( Page < LastPage && Page > 0 && typeof Page !== 'undefined' && typeof Page === 'number' && Page !== undefined && Page !== null ) {

            Page++;

            $.ajax({
                type : 'GET',
                url  : 'post?page='+Page
            })
            .done(function(data) {

                if(data.result === true){

                    Page     = data.page;
                    LastPage = data.lastpage;
                    MasonryAddItem(data.html,'.masonry');
                    PageViewed.html(Page);
                    TotalPages.html(LastPage);
                    if( Page >= LastPage ) target.parents('.row').remove();

                }else{
                    target.parents('.row').remove();
                    ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
                }
            })
            .fail(function() {
                ShowErr("خطا در اتصال به پایگاه داده ، لطفا اتصال اینترت خود را چک کنید !","ban-circle yellow");
            })
            .always(function() {

                ButtonLoader.hide(500, function() {
                    ButtonSpan.fadeTo(500,1);
                });

                target.prop('disabled',false);
            });
        }else{
            target.parents('.row').remove();
            ShowErr("صفحه مورد نظر موجود نمی باشد. لطفا دوباره امتحان کنید !","ban-circle yellow");
        }
    });
}
// Conatct form
function ContactFormSetup(){

    $('body').on('submit','.ContactForm',function(event) {

        event.preventDefault();

        var target       = $(this),
            data         = target.serialize(),
            submitBtn    = target.find('#submit'),
            Loader       = target.find('#submit span.Spin'),
            contactForm  = $('.ContactForm'),
            FadedSpan    = target.find('#submit span.comet-spaceman'),
            hasErrorSpan = contactForm.find('.form-group i.fa'),
            FormInput    = contactForm.find('input'),
            FormTextarea = contactForm.find('textarea');

        if( FadedSpan.hasClass('tada') ){
            FadedSpan.removeClass('animated inifite tada');
        }

        submitBtn.prop('disabled',true);

        FadedSpan.fadeTo(500,0, function() {
            Loader.show(300);
        });

        hasErrorSpan.removeClass('hasErr');
        FormInput.css('background', '#FFF');
        FormTextarea.css('background', '#FFF');

       //Ajax
       $.ajax({
            type: 'POST',
            url: 'support',
            data: {data: data}
       })
       .done(function(data) {

            var errorArray  = data.errors;

            for ( key in errorArray ) {

                if( key !== 'des' ){
                    var input = contactForm.find( "input[name= "+ key +"]" );
                }else{
                    var input = contactForm.find( "textarea[name= "+ key +"]" );
                }

                var span  = input.parent('div').find('span i.fa');

                span.addClass('hasErr');
                input.css('background', '#FFE281');
            }

            if( data.result === 'success' ) {
                contactForm.find('input').val('');
                contactForm.find('textarea').val('');
                ShowErr("پیام شما با موفقیت ارسال شد.","ok green");
            }

            if( data.result === 'wait' )    ShowErr("شما لحظاتی پیش یک پیام با موفقیت ارسال کرده اید، لطفا بعدا تلاش کنید.","ban-circle yellow");
            if( data.result === 'fail' )    ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");

            if( data.result === 'error' ) {

                var  ErrorData = "";

                for ( error in errorArray ) {

                    for( item in errorArray[error] ) {
                        ErrorData += "<p class=\"errtxt\"><i class=\"fa fa-exclamation yellow\"></i>"+errorArray[error][item]+"</p>"
                    }
                      
                }

                $('#ErrModal').find('.modal-body').html(ErrorData);
                PlaySound();
                $('#ErrModal').modal('show');
            }
       })
       .fail(function() {
            ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
       })
       .always(function() {
            Loader.hide(300, function() {
               FadedSpan.fadeTo(300,1);
               submitBtn.prop('disabled',false);
            });
       });
    });
}
// Fucking Notify
function Notify(params){

    var icon        = 'icon'        in params ? params.icon     : 'exclamation',
        title       = 'title'       in params ? params.title    : 'خطا',
        message     = 'message'     in params ? params.message  : 'لطفا مجددا تلاش کنید.',
        element     = 'element'     in params ? params.element  : 'body',
        position    = 'position'    in params ? params.position : 'fixed',
        align       = 'align'       in params ? params.align    : 'right',
        from        = 'from'        in params ? params.from     : 'bottom',
        enter       = 'enter'       in params ? params.enter    : 'bounceInUp',
        exit        = 'exit'        in params ? params.exit     : 'flipOutX',
        delay       = 'delay'       in params ? params.delay    : 5000,
        over        = 'over'        in params ? params.over     : 'pause',
        type        = 'type'        in params ? params.type     : 'info',
        interval    = 'interval'    in params ? params.interval : 2,
        init        = function(){
            $.notify(
                {
                    icon        : 'fa fa-'+icon,
                    title       : title,
                    message     : message
                },
                {
                    element     : element,
                    position    : position,
                    placement   : {
                        align : align,
                        from  : from
                    },
                    type        : type,
                    animate     : {
                        enter: 'animated '+enter,
                        exit: 'animated '+exit
                    },
                    delay       : delay,
                    mouse_over  : over,
                    offset      :{
                        y:30,
                        x:30
                    }
                }
            );
        };

    setTimeout(init, interval*1000);
}