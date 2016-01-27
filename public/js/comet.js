
var ModalParent,
    $Masonry,
    SkillsLoaded = false,
    Page         = 1,
    LastPage     = parseInt($('.LastPage').html());

$(document).ready(function() {

    //Fix header Padding on All devices
    LayoutFixer();
    window.addEventListener("orientationchange", function() {
        LayoutFixer();
    }, false);

    MockUpAnimation();
    NavigationShrink();
    Scroll(0);
    Counter('.navbar-nav .badge');
    Tooltip();
    Masonry('.masonry','.portfolio-item','.portfolio-item');
    HoverAnimation();
    LoadSkills();

    // Ajax Setup
    $.ajaxSetup({
        dataType : 'JSON',
        cache    : false,
        headers  : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 50
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

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
            url  : 'ModalPost',
            type : 'POST',
            data : {pid: PID}
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
        .fail(function(data) {
            Modal.modal('hide');
            ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
        })
        .always(function(){
            ModalLoader.remove();
        });
    });

    // Like Portfolio
    $('body').on('click', '.likePost', function(event) {

        event.preventDefault();
        var target    = $(event.target),
            PID       = target.attr('id'),
            TotalNav  = $('.PortfolioNav-item p.yellow'),
            ModalOpen = isCometModalOpen();

        if( ModalOpen ) {

            var LikeSpan            = ModalParent.parents('.portfolio-item').find('.portfolio-like span'),
                LikeParagraph       = ModalParent.parents('.portfolio-item').find('.portfolio-like .likecount'),
                Loader              = target.parent().find('img'),
                ModalLikeParagraph  = target.parent().find('p'),
                ModalLikeSpan       = target,
                FadeElement         = target;

        }else{

            var LikeSpan      = target.parent('.portfolio-like').find('span'),
                LikeParagraph = target.parent('.portfolio-like').find('.likecount'),
                Loader        = target.parents('.portfolio-caption').find('.portfolio-ajaxloader'),
                FadeElement   = target.parent('.portfolio-like');

        }

        FadeElement.fadeTo(400,0,function(){
            Loader.fadeTo(400,1);     
        });
       

        $.ajax({
            url  : 'LikePost',
            type : 'POST',
            data : {pid: PID}
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
                    if( parseInt(data.totalPostLikes) === 0 ) ModalLikeParagraph.html("لایک کنید!");
                    else ModalLikeParagraph.html(data.totalPostLikes);
                }

                if( parseInt(data.totalPostLikes) === 0 ) LikeParagraph.html('');
                else LikeParagraph.html(data.totalPostLikes);
                TotalNav.html(data.totalLikes);

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

            Loader.fadeTo(400,0,function(){
                FadeElement.fadeTo(400,1);
            });
        });
    });

    // Portfolio Paginations
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
                url  : 'PaginatePost?page='+Page
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

    // Contact Form Ajax
    $('body').on('submit','.ContactForm',function(event) {

        event.preventDefault();

        var target       = $(this),
            data         = target.serialize(),
            submitBtn    = target.find('#submit'),
            Loader       = target.find('#submit span.Spin'),
            contactForm  = $('.ContactForm'),
            FadedSpan    = target.find('#submit span.comet-spaceman'),
            hasErrorSpan = contactForm.find('.form-group span.glyphicon'),
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
            url: 'ContactForm',
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

                var span  = input.parent('div').find('.glyphicon');

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
                        ErrorData += "<p class=\"errtxt\"><span class=\"glyphicon glyphicon-ban-circle yellow\"></span>"+errorArray[error][item]+"</p>"
                    }
                      
                }

                $('#ErrModal').find('.modal-body').html(ErrorData);
                PlaySound();
                $('#ErrModal').modal('show');
            }
       })
       .fail(function(data) {
            ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
       })
       .always(function() {
            Loader.hide(300, function() {
               FadedSpan.fadeTo(300,1);
               submitBtn.prop('disabled',false);
            });
       });
    });
});

