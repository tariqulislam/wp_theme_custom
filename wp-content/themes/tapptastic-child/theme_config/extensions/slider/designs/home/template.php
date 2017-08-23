<?php 
$bg_def = tfuse_options('default_bg');
if (!empty($view_variables['general']['slider_bg'])) 
{
    $bg = 'background-image: url('.$view_variables['general']['slider_bg'].')';
    $image_load = $view_variables['general']['slider_bg'];
}
elseif (!empty($bg_def))
{
    $bg =  'background-image: url('.$bg_def.')';
    $image_load = $bg_def;
}
else
{
    $bg = 'background: #131619 url('.get_template_directory_uri().'/images/pattern.png);';
    $image_load = get_template_directory_uri().'/images/pattern.png';
}
ob_start();
$uniq = rand(1,1000);
?>
<!-- Main Slider -->
<div id="my_slider" class="main-slider carousel slide  home-slider<?php echo $uniq;?> invisible">
    <ul class="slide_down_text"><li>We're on when you are.</li></ul>
    <div class="carousel-inner">
        <?php 
            $k = 0; 
            foreach ($view_variables['slides'] as $slide):
                $class = ($k == 0) ? 'active' : '';?>
                <div class="item <?php echo $class;?>" style="<?php echo $bg;?>">
                    <div class="carousel-caption">
                        <h2 data-animate-in="fadeInLeft" data-animate-out="fadeOutRight">
                            <?php echo $slide['slide_title'];?>
                        </h2>
                        <div class="slider_text">
                            <?php echo do_shortcode($slide['slide_content']); ?>
                        </div>                        
                    </div>
                <?php if($slide['slide_type'] == 'img'): ?>
                    <div class="slider-caption iPhone-apps" data-animate-in="fadeInUpSmall" data-animate-out="fadeOutDown">
                        <img src="<?php echo $slide['slide_src'];?>" alt="">
                    </div>
                <?php else: ?>
                    <div class="slider-caption iPad-apps" data-animate-in="fadeInUpSmall" data-animate-out="fadeOutDown">
                        <div class="inner">
                            <?php 
                                preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $slide['slide_video'], $video_id);
                                if(!empty($video_id)): ?>
                                    <iframe width="776" height="580" src="http://www.youtube.com/embed/<?php echo $video_id[0]?>"></iframe>
                            <?php elseif(strpos($slide['slide_video'],"vimeo.com") == true): ?>
                                    <iframe src="<?php echo $slide['slide_video'];?>?title=0&amp;byline=0&amp;portrait=0" width="776" height="580"></iframe>
                            <?php elseif(strpos($slide['slide_video'],"iframe") == true):
                                    echo $slide['slide_video'];
                                else: ?>
                                    <video id="video<?php echo $k;?>" controls preload="auto" poster="<?php echo $slide['slide_poster'];?>" class="video-js vjs-default-skin">
                                        <source src="<?php echo $slide['slide_video'];?>" type="video/mp4">
                                    </video>
                                    <script>
                                        jQuery(document).ready(function(){
                                            videojs.options.flash.swf = "<?php echo get_template_directory_uri();?>/js/video-js.swf";
                                            videojs("video<?php echo $k;?>", {
                                                    "height": "auto",
                                                    "width": "auto"
                                                }).ready(function() {
                                                    var myPlayer = this;
                                                    var aspectRatio = 145 / 194;
                                                    function resizeVideoJS() {
                                                        var width = document.getElementById(myPlayer.id()).parentElement.offsetWidth;
                                                        myPlayer.width(width).height(width * aspectRatio);
                                                    }
                                                    resizeVideoJS();
                                                    window.addEventListener("resize", resizeVideoJS, false);
                                                    jQuery('.home-slider<?php echo $uniq;?>')
                                                        .on('slid.bs.carousel', function () {
                                                            resizeVideoJS();
                                                        });
                                                });
                                        });
                                    </script>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        <?php $k++; endforeach; ?>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#my_slider" data-slide="prev"><i class="icon-arrow-left"></i></a>
    <a class="right carousel-control" href="#my_slider" data-slide="next"><i class="icon-arrow-right"></i></a>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php 
            $c = 0; 
            foreach ($view_variables['slides'] as $slide):
                $class = ($c == 0) ? 'class="active"' : '';?>
                <li data-target="#my_slider" data-slide-to="<?php echo $c;?>" <?php echo $class;?>></li>
        <?php $c++; endforeach; ?>
    </ol>
</div>
<!-- Main Slider -->
<script>
    jQuery(document).ready(function($) {
        jQuery('.main-slider').parents('.container').removeAttr('class');
        $('.main-slider').prepend('<img src="<?php echo $image_load;?>" alt="" class="testimage<?php echo $uniq;?> hidden">');
        $('.testimage<?php echo $uniq;?>').load(function(){
            $("#my_slider p").each(function(){
                $( this ).replaceWith( $(this).html() );
            });
            $(".main-header .spinner, .main-header .testimage<?php echo $uniq;?>").remove();
            $(".main-slider, .menu-button").removeClass('invisible').addClass('animated fadeIn');
            $(".header-logo").removeClass('invisible').addClass('animated fadeInDown');
            var slider = $('#my_slider'),animateClass;
            slider.carousel({interval: 7500});
            slider.find('[data-animate-in]').addClass('animated');
            function animateSlide() {
                slider.find('.item').removeClass('current');
                slider.find('.active').addClass('current').find('[data-animate-in]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-in');
                    $this.addClass(animateClass);
                });
                slider.find('.active').find('[data-animate-out]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-out');
                    $this.removeClass(animateClass);
                });
            };
            function animateSlideEnd() {
                slider.find('.active').find('[data-animate-in]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-in');
                    $this.removeClass(animateClass);
                });
                slider.find('.active').find('[data-animate-out]').each(function () {
                    var $this = $(this);
                    animateClass = $this.data('animate-out');
                    $this.addClass(animateClass);
                });
            };
            animateSlide();
            slider.on('slid.bs.carousel', function () {
                animateSlide();
            });
            slider.on('slide.bs.carousel', function () {
                animateSlideEnd();
            });
            if (Modernizr.touch) {
                slider.find('.carousel-inner').swipe( {
                    swipeLeft: function() {
                        $(this).parent().carousel('prev');
                    },
                    swipeRight: function() {
                        $(this).parent().carousel('next');
                    },
                    threshold: 30
                });
            }
        });
});
</script><?php 

    $output = ob_get_clean();
    $output = str_replace(array("\n","\r","  "), "", $output);
    echo $output;
?>