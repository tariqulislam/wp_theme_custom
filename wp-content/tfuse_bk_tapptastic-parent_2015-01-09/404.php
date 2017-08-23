<?php get_header(); ?>
<?php
$default_image = tfuse_options('default_bg');

if(!empty($default_image))
{
    $img = $default_image;
    $style = 'style="background-image: url('.$default_image.');"';
}
else
{
    $style = 'style="background: #131619 url('.get_template_directory_uri().'/images/pattern.png'.');"';
    $img = get_template_directory_uri().'/images/pattern.png';
}
?>
<div id="main" class="site-main">
    <!-- .Main Section -->
    <section class="main-header">
        <div class="container-fluid">
            <div class="row">
                <div id="content" class="site-content" role="main">
                    <article class="post post-details">
                        <div class="entry-header page_404" <?php echo $style;?>>
                            <h1 class="entry-title"><?php _e('Page 404','tfuse');?></h1>
                        </div>
                        <div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1">
                            <div class="entry-content">
                                <p><?php _e('Page not found', 'tfuse') ?></p>
                                <p><?php _e('The page you were looking for doesn&rsquo;t seem to exist', 'tfuse') ?>.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- .Main Section -->
</div>
<script>
    jQuery(function($) {
        jQuery('.entry-header').prepend('<img src="<?php echo $img ;?>" alt="" class="testimage hidden">');
        jQuery('.spinner').css('top', jQuery('.entry-header').outerHeight()/2-16);

        jQuery('.testimage').on('load',function(){
            jQuery(".entry-header, .menu-button").removeClass('invisible').addClass('animated fadeIn');

            setTimeout(function(){
                jQuery(".entry-header .entry-title").removeClass('invisible').addClass('animated fadeInLeft');
                jQuery(".entry-header .entry-meta").removeClass('invisible').addClass('animated fadeInRight');
                jQuery(".header-logo").removeClass('invisible').addClass('animated fadeInDown');
            }, 200);
        });
    });
</script>
<?php get_footer();?>
