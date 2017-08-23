jQuery(document).ready(function() {
    var $ = jQuery,
        screenRes = $(window).width(),
        screenHeight = $(window).height(),
        html = $('html');

    // IE<8 Warning
    if (html.hasClass("ie6") || html.hasClass("ie7")) {
        $("body").empty().html('UPDATE YOUR BROWSER');
    }

    // Remove outline in IE
    $("a, input, textarea").attr("hideFocus", "true").css("outline", "none");

    // prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
    if($('a').is('[data-rel]') && screenRes > 600) {
        $('a[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
        });
        $("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
    }

    // About Us Articles

    function aboutLayout () {
        $('.about-us .entry-header').each(function(){
            var $this = $(this),
                headerHeight = $this.height(),
                contentHeight = $this.siblings('.entry-content').height();
            $this.css('margin-top', (contentHeight-headerHeight)/2);
        })
    }

    aboutLayout ();
    $(window).resize(function() {
        aboutLayout ()
    })

});
//videojs.options.flash.swf = "js/video-js.swf";
//videojs("video1", {
//        "height": "auto",
//        "width": "auto"
//}).ready(function() {
//    var myPlayer = this; // Store the video object
//    var aspectRatio = 145 / 194; // Make up an aspect ratio
//    function resizeVideoJS() {
//        // Get the parent element's actual width
//        var width = document.getElementById(myPlayer.id()).parentElement.offsetWidth;
//        // Set width to fill parent element, Set height
//        myPlayer.width(width).height(width * aspectRatio);
//    }
//    resizeVideoJS(); // Initialize the function
//    window.addEventListener("resize", resizeVideoJS, false); // Call the function on resize
//    $('#main-slider').on('slid.bs.carousel', function () {
//        resizeVideoJS();
//
//
//    })
//});

jQuery(function() {
    jQuery('nav#menu')
        .mmenu()
        .on('opening.mm', function() {
            jQuery(".menu-button").css({
                'left': jQuery("#menu").width()
            })                
        })
        .on('closing.mm', function(){
            jQuery(".menu-button").css({
                'left': 0
            }) 
        });
});

jQuery(window).load(function(){

        function screenshot_carousel() {
            var getDeviation = function() {
				var screenRes = jQuery(window).width();
				if (screenRes >= 1853) return 3;
				if (screenRes < 977) return 0;
				if (screenRes < 1240) return 1;
				if (screenRes < 1265) return 2;
				if (screenRes < 1400) return 1;
				if (screenRes < 1853) return 2;
			};

            jQuery(".screenshot-carousel").caroufredsel( {
                swipe: {
                    onTouch: true
                },
                mousewheel: true,
                prev: '#prev_screen',
                next: '#next_screen',

                infinite: false,
                circular: false,
                auto: false,
                width: '100%',
                scroll: {
                    items : 1
                } ,
                pagination: {
                    container: "#screenshot_pager",
                    deviation: getDeviation()
                }
            });
        }

        screenshot_carousel();

        jQuery(window).resize(function() {
            screenshot_carousel();
        });

    });

    jQuery(document).ready(function(){
        if ( jQuery('.screenshot-carousel .carousel-item').length > 3 ) {
        jQuery(".screenshot-counter").css('display','inline-block');
        var screenshot_counter = jQuery('.screenshot-carousel .carousel-item').length ;
        jQuery("#counter").text(screenshot_counter ); }

    });
    
    jQuery(document).ready(function($) {

        $('.testimage').load(function(){
            $(".main-header .spinner, .main-header .testimage").remove();
            $(".main-slider").removeClass('invisible').addClass('animated fadeIn');
            $(".header-logo").removeClass('invisible').addClass('animated fadeInDown');

            var slider = $('#main-slider'),
                animateClass;

            slider.carousel({
                interval: 7500
            });

            slider.find('[data-animate-in]').addClass('animated');

            function animateSlide() {
                slider.find('.item').removeClass('current');

                slider.find('.active').addClass('current').find('[data-animate-in]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-in');
                    $this.addClass(animateClass)
                });

                slider.find('.active').find('[data-animate-out]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-out');
                    $this.removeClass(animateClass)
                });
            }
            function animateSlideEnd() {
                slider.find('.active').find('[data-animate-in]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-in');
                    $this.removeClass(animateClass)
                });
                slider.find('.active').find('[data-animate-out]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-out');
                    $this.addClass(animateClass)
                });
            }

            animateSlide();

            slider.on('slid.bs.carousel', function () {
                animateSlide();
            });
            slider.on('slide.bs.carousel', function () {
                animateSlideEnd();
            });
        });
    });
    
       jQuery(window).on('load',function(){
        jQuery('ul.dropdown').prepend('<li class="close-menu"><i class="icon-close"></i></li>');
        jQuery('.close-menu').on('click', function(){
            jQuery("#menu").trigger( "close.mm");
        });
    });
    
    jQuery(document).ready(function($) {
        var firstSection = $('#main').children('section').eq(0);
        
        var slider_exist = firstSection.find('#main-slider');

        if(slider_exist.hasClass('main-slider'))
        {
            $('#masthead').css('min-height', '0');
        }
        else if (!firstSection.hasClass('main-header')) {
            $('#masthead').css('min-height', '300px');
            $('.spinner').css('display', 'none');
            $(".header-logo, .menu-button").removeClass('invisible');
        }
        
        
        $('.main-header').has('.main-slider, .post').css('padding-top', 0);
    });

 jQuery(document).ready(function($) {
        jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
        });
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
        });
