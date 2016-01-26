// Shrink Navigation on Scroll
function NavigationShrink() {
    Shrink();

    $(window).scroll(function(){
        Shrink();
    });
}
function Shrink(){
    var ScrollY = ( window.pageYOffset || $(document.documentElement).scrollTop ),
        header  = $('.navbar-default');

    if ( ScrollY >= 70 ) {
        header.addClass('navbar-shrink');
    }else{
        header.removeClass('navbar-shrink');
    }
}
// Mockup Animation
function MockUpAnimation(){
    var MockUp = $('.mockup');
    if( $(window).scrollTop() < ($(window).height()/4) ){
        MockUp.stop().animate({paddingTop: ($(window).scrollTop()) + "px"}, 2000);
    }else{
        MockUp.stop().animate({paddingTop: "150px"}, 2000);
    }

    $(window).scroll(function(){

        if( $(window).scrollTop() < ($(window).height()/4) ){
           MockUp.stop().animate({paddingTop: ($(window).scrollTop()) + "px"}, 2000);
        }

    });
}
// Responsive Header Padding and backgrounds
function LayoutFixer(){
    var ContactArea = $('#contact'),
        Header      = $('header'),
        HeaderTxt   = Header.find('.intro-text'),
        Padding     = Math.ceil($(window).height()/2-HeaderTxt.height());


    Header.css({
        'padding-top': Padding+80,
        'padding-bottom': Padding-80,
        'background':'url('+$('#configuration input[name="HeaderBack"]').val()+')',
        'background-size':'cover'
    });

    ContactArea.css({
        'background':'url('+$('#configuration input[name="ContactBack"]').val()+')',
        'background-size':'cover'
    });

    $(window).resize(function(event) {
        Header.css({
            'padding-top': Padding+80,
            'padding-bottom': Padding-80
        });
    });
}
// Setup tooltips
function Tooltip(){

    var Default = $('[data-toggle="tooltip"]'),
        Persian = $('[data-toggle="tooltipfa"]'),
        Options = {
            template : "<div class=\"tooltip\" role=\"tooltip\"><div class=\"tooltip-arrow\"></div><div class=\"tooltip-inner tooltip-fa\"></div></div>",
            container: "body"
        };
        
    Default.tooltip({container: 'body'});
    Persian.tooltip(Options);

    $(window).scroll(function(){
        Default.tooltip('hide');
        Persian.tooltip('hide');
    });
}
// Error Function
function ShowErr(errtxt,glyph){

    var content = "<p class=\"errtxt\"><span class=\"glyphicon glyphicon-"+glyph+"\"></span>"+errtxt+"</p>";

    if( $('body').hasClass('modal-open') && $('.modal-backdrop').length > 0 ){
        $('.modal').modal('hide');
        $('.modal').one('hidden.bs.modal', function(event) {
            $('#ErrModal').find('.modal-body').html(content);
            PlaySound();
            $('#ErrModal').modal('show');
        });
    }else{
        $('#ErrModal').find('.modal-body').html(content);
        PlaySound();
        $('#ErrModal').modal('show');
    }
}
// Animation Numbers
function Counter(element){
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
          easing: 'easeOutQuart',
          start: function(){
            target.addClass('startCounting');
          },
          step: function () {
            target.text(Math.round(this.Counter)+lastChar);
          },
          complete: function(){
            target.addClass('finishcounter');
            target.removeClass('startCounting');
          }
        });
    }else{
        target.addClass('finishcounter');
    }
  });
}
// Scroll to Target
function Scroll(offset){
    $('body').on('click','.scroll',function(event) {
        event.preventDefault();
        target = $(this).attr('href');
        $('html,body').animate({
            scrollTop: $(target).offset().top-offset
        }, 2000, "easeInOutQuart");
    });
}
// is Comet Modal Open or not?
function isCometModalOpen(){
     return typeof ModalParent === 'object' && ModalParent !== undefined && ModalParent !== null && $('body').hasClass('modal-open') && $('#cometModal').hasClass('in') && $('.modal-backdrop').length > 0;
}
// Init Masonry
function Masonry(element,columnW,item){

    var imgLoader = imagesLoaded($(element));

    imgLoader.on('done', function() {

        $Masonry = $(element).masonry({
            percentPosition: true,
            columnWidth: columnW,
            itemSelector: item
        });
    });

    imgLoader.on('fail', function() {
      ShowErr("یک یا چند عکس از پروژه ها باگذاری نشده است. لطفا مجددا تلاش کنید","ban-circle yellow");
      $('#ErrModal').on('hide.bs.modal', function() {window.location.reload()});
    });
}
//add item to Masonry
function MasonryAddItem(data,element){

    var $Data = $(data);
    $Masonry.append($Data);

    var imgLoader = imagesLoaded($(element));

    imgLoader.on('done', function() {
        $Masonry.masonry( 'appended', $Data );
    });

    imgLoader.on('fail', function() {
      ShowErr("یک یا چند عکس از پروژه ها باگذاری نشده است. لطفا مجددا تلاش کنید","ban-circle yellow");
      $('#ErrModal').on('hide.bs.modal', function() {window.location.reload()});
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
// Skills Function
function LoadSkills(){
    
    Skills();
    
    $(window).scroll(function(event) {
        Skills();
    });
}
function Skills(){
    if( typeof SkillsLoaded === 'boolean' && SkillsLoaded === false && $('#team:in-viewport').length ){
        
        SkillsLoaded = true;

        $('.skill').each(function () {

            var skilledPercentage = $(this).attr('skilled-pct'),
                skilledColour     = $(this).attr('skilled-color'),
                options = {
                    responsive:false,
                    maintainAspectRatio: false,
                    showTooltips: false,
                    animationEasing: "easeOut",
                    animationSteps: 40,
                    onAnimationComplete: function () {
                        //setup the font and center it's position
                        this.chart.ctx.font = 'bold 1em yekan';
                        this.chart.ctx.fillStyle = '#555';
                        this.chart.ctx.textAlign = 'center';
                        this.chart.ctx.textBaseline = 'middle';
                        //put the pabel together based on the given 'skilled' percentage
                        var valueLabel = this.segments[0].value;
                        //find the center point
                        var x = this.chart.canvas.clientWidth / 2;
                        var y = this.chart.canvas.clientHeight / 2;
                        //hack to center different fonts
                        var x_fix = 0;
                        var y_fix = 0;
                        //render the text
                        this.chart.ctx.fillText(valueLabel, x + x_fix, y + y_fix);
                    }
                },
                data = [
                    {
                        value: skilledPercentage,
                        color: skilledColour
                    },
                    {
                        value: 10 - skilledPercentage,
                        color: '#ffffff'
                    }
                ];

            var ctx      = $(this).get(0).getContext("2d");
            chart        = new Chart(ctx).Doughnut(data,options);
        });
        
    }
}
// Play Sound
function PlaySound(){
    $('#Sound').html('');
    $("<audio autoplay><source src=\"sound/NotificationSound.mp3\".mp3' type='audio/mpeg'></audio>").appendTo('#Sound');
}