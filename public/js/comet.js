
var ModalParent,
    $Masonry,
    totalpage    = parseInt($('#configuration input[name="TotalPage"]').val()),
    page         = 1,
    SkillsLoaded = false;



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
    // $.ajaxSetup({
    //     type     : 'POST',
    //     dataType : 'JSON',
    //     // cache    : false,
    //     headers  : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    // });

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
        $(this).find('.modal-body').html('');
        $(this).find('.modal-footer').remove();
        ModalParent = undefined;
    });

    // Open Portfolio
    $('body').on('click', '.portfolio-link', function(event) {

        event.preventDefault();
        AjaxLoaderModal();

        var el          = $(this),
            PID         = el.attr('id'),
            Modal       = $('#cometModal'),
            ModalBody   = Modal.find('.modal-body'),
            ModalLoader = ModalBody.find('.cometModalLoader');

        $.ajax({
            url: 'ajax/modaldata.php',
            data: {data: PID}
        })
        .done(function(data) {

            if( data.result === true ) {

                ModalLoader.fadeTo(500,0,function(){

                    ModalBody.html(data.modalBody);
                    ModalBody.after(data.modalFooter);
                    ModalBody.find('.modalEl').fadeIn(500);
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
        });
    });

    // Like Portfolio
    $('body').on('click', '.enable', function(event) {
        event.preventDefault();
        var target    = $(event.target),
            PID       = target.attr('id'),
            TotalNav  = $('.PortfolioNav-item p.yellow'),
            ModalOpen = isCometModalOpen();

        if( ModalOpen ) {

            var LikeSpan            = ModalParent.parents('.portfolio-item').find('.portfolio-like span.enable'),
                LikeParagraph       = ModalParent.parents('.portfolio-item').find('.portfolio-like .likecount'),
                Loader              = target.parent().find('img'),
                ModalLikeParagraph  = target.parent().find('p'),
                ModalLikeSpan       = target,
                FadeElement         = target;

        }else{

            var LikeSpan      = target.parent('.portfolio-like').find('span.enable'),
                LikeParagraph = target.parent('.portfolio-like').find('.likecount'),
                Loader        = target.parents('.portfolio-caption').find('.portfolio-ajaxloader'),
                FadeElement   = target.parent('.portfolio-like');

        }

        FadeElement.fadeTo(400,0,function(){
            Loader.show(400);     
        });
       

        $.ajax({
            url: 'likepost',
            data: {pid: PID}
        })
        .done(function(data) {
            console.log(data);
            if(data.result === true ){

                if( ModalOpen ) {
                    ModalLikeSpan.removeAttr('id').removeClass('enable').addClass('disable animated infinite pulse');
                    ModalLikeParagraph.html(data.totalPostLikes);
                }

                LikeSpan.removeAttr('id').removeClass('enable').addClass('disable animated infinite pulse');
                LikeParagraph.html(data.totalPostLikes);
                TotalNav.html(data.totalLikes);
                

            }else{

                if( ModalOpen ) {
                    $('.modal').modal('hide');
                }

                ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
            }
        })
        .fail(function(data) {
            console.log(data);
            if( ModalOpen ) {
                $('.modal').modal('hide');
            }
            
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

        target.prop('disabled',true);

        if( page < totalpage && page > 0 && typeof page !== 'undefined' && typeof page === 'number' && page !== undefined && page !== null ) {
            
            page++;

            if( ButtonSpan.hasClass('tada') ){
                ButtonSpan.removeClass('animated infinite tada');
            }

            ButtonSpan.fadeTo(500, 0, function() {
                ButtonLoader.show(500);
            });

            $.ajax({
                url: 'ajax/paginationpost.php',
                data: {page : page}
            })
            .done(function(data) {

                if(data.result === true){

                    MasonryAddItem(data.html,'.masonry');
                    PageViewed.html(page);

                }else{
                    ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
                }
            })
            .fail(function() {
                ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
            })
            .always(function() {

                ButtonLoader.hide(500, function() {
                    ButtonSpan.fadeTo(500,1);
                });

                if( page === totalpage ) {
                    target.parents('.row').remove();
                }else{
                    target.prop('disabled',false);
                }
            });
        }else{
            ShowErr("صفحه مورد نظر موجود نمی باشد.","ban-circle yellow");   
        }
    });

    // Contact Form Ajax
    $('body').on('submit','.ContactForm',function(event) {

        event.preventDefault();

        var target      = $(this),
            data        = target.serialize(),
            submitBtn   = target.find('#submit'),
            Loader      = target.find('#submit span.Spin'),
            contactForm = $('.ContactForm'),
            FadedSpan   = target.find('#submit span.comet-spaceman');

        if( FadedSpan.hasClass('tada') ){
            FadedSpan.removeClass('animated inifite tada');
        }

        submitBtn.prop('disabled',true);

        FadedSpan.fadeTo(500,0, function() {
            Loader.show(300);
        });

       //Ajax
       $.ajax({
           url: 'ajax/support.php',
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

                if ( typeof errorArray[key] === 'boolean' && errorArray[key] !== false ) {

                    span.addClass('hasErr');
                    input.css('background', '#FFE281');

                } else {

                    if ( span.hasClass('hasErr') ) {
                        span.removeClass('hasErr');
                        input.css('background', '#FFF');
                    }
                }
            }

            if( data.hasError === true ) {

                var errorArrayDes = data.errorsDes,
                    ErrorData = "";

                for ( key in errorArrayDes ) {

                    if ( typeof errorArrayDes[key] === 'string' && errorArrayDes[key] !== null ) {
                        ErrorData += "<p class=\"errtxt\"><span class=\"glyphicon glyphicon-ban-circle yellow\"></span>"+errorArrayDes[key]+"</p>"
                    }
                }

                $('#ErrModal').find('.modal-body').html(ErrorData);
                PlaySound();
                $('#ErrModal').modal('show');
                
            }

            if( data.result === true ) {
                ShowErr("پیام شما با موفقیت ارسال شد.","ok green");
            }

            if( data.result === 'wait' ) {
                ShowErr("شما لحظاتی پیش یک پیام با موفقیت ارسال کرده اید، لطفا بعدا تلاش کنید.","ban-circle yellow");
            }

            if( data.result === 'fail' ) {
                ShowErr("خطا در اتصال به پایگاه داده ، لطفا دوباره امتحان کنید !","ban-circle yellow");
            }

            if( data.result !== false ) {
                contactForm.find('input').val('');
                contactForm.find('textarea').val('');
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
});

