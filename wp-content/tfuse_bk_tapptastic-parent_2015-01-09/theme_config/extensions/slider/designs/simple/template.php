<?php $title = isset($view_variables['general']['slider_title']) ? $view_variables['general']['slider_title'] : '';?>
<?php $content = isset($view_variables['general']['slider_content']) ? $view_variables['general']['slider_content'] : '';?>
<?php $uniq = rand(1,1000);?>

<div class="container-fluid">
    <div class="row inner screenshots">
        <div class="col-sm-5 col-md-4 col-lg-3">
            <div class="screenshot-meta">
                <h2><?php echo $title;?></h2>

                <div class="screenshot-controls">
                    <a class="prev prev_screen<?php echo $uniq;?>" id="prev_screen" href="#"><i class="icon-arrow-left"></i><span><?php _e('PREV','tfuse');?></span></a>
                    <div class="screenshot-counter slider_carousel_counter<?php echo $uniq;?>"><span><?php _e('SCREENS','tfuse');?></span><div id="screenshot_pager" class="screenshot_pager<?php echo $uniq;?>"></div><span><?php _e('OF','tfuse');?></span><span id="counter" class="slider_counter<?php echo $uniq;?>"></span></div>
                    <a class="next next_screen<?php echo $uniq;?>" id="next_screen" href="#"><span><?php _e('NEXT','tfuse');?></span><i class="icon-arrow-right"></i></a>
                </div>

                <div class="slider_text">
                    <?php echo do_shortcode($content);?>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-md-8 col-lg-9">
            <div class="screenshot-carousel slider_carousel<?php echo $uniq;?>">
                <?php foreach ($view_variables['slides'] as $slide):?>
                    <div class="carousel-item">
                        <img src="<?php echo $slide['slide_src'];?>" alt="">
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<script>
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

            jQuery(".slider_carousel<?php echo $uniq;?>").caroufredsel( {
                swipe: {
                    onTouch: true
                },
                mousewheel: true,
                prev: '.prev_screen<?php echo $uniq;?>',
                next: '.next_screen<?php echo $uniq;?>',

                infinite: false,
                circular: false,
                auto: false,
                width: '100%',
                scroll: {
                    items : 1
                } ,
                pagination: {
                    container: ".screenshot_pager<?php echo $uniq;?>",
                    deviation: getDeviation()
                }
            });
            
             if (jQuery('#screenshot_pager').hasClass('hidden')) {
                jQuery('.screenshot-controls').addClass('hidden');
               } else {
                jQuery('.screenshot-controls').removeClass('hidden');
               }
        }

        screenshot_carousel();

        jQuery(window).resize(function() {
            screenshot_carousel();
        });

    });

    jQuery(document).ready(function(){        
        jQuery('.slider_carousel<?php echo $uniq;?>').parents('.container').removeAttr('class');
        
        if ( jQuery('.slider_carousel<?php echo $uniq;?> .carousel-item').length > 3 ) {
        jQuery(".slider_carousel_counter<?php echo $uniq;?>").css('display','inline-block');
        var screenshot_counter = jQuery('.slider_carousel<?php echo $uniq;?> .carousel-item').length ;
        jQuery(".slider_counter<?php echo $uniq;?>").text(screenshot_counter ); }

    });
</script>