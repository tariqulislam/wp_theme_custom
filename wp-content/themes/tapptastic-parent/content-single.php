<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Tapptastic 1.0
 */
global $post;

$image_args = tfuse_get_image();

$uniq = rand(1,100);

?>
<div class="spinner">
    <div class="wBall" id="wBall_1">
        <div class="wInnerBall">
        </div>
    </div>
    <div class="wBall" id="wBall_2">
        <div class="wInnerBall">
        </div>
    </div>
    <div class="wBall" id="wBall_3">
        <div class="wInnerBall">
        </div>
    </div>
    <div class="wBall" id="wBall_4">
        <div class="wInnerBall">
        </div>
    </div>
    <div class="wBall" id="wBall_5">
        <div class="wInnerBall">
        </div>
    </div>
</div>
<!--/ Loading Spinner -->
<?php if($post->post_type == 'gallery'):?>
<div class="entry-header entry-header-gallery invisible" <?php echo $image_args['style'];?>>
    <h2 class="header-title invisible">Check out a selection of our best works from <span class="blue-text">apps</span> to <span class="green-text">design work</span></h2>
</div>
<section class="adv-filter adv-filter-gallery">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                    <div class="entry-meta">
                        <?php _e('By','tfuse')?> <span class="byline"><span class="author vcard"><?php the_author_posts_link() ?></span></span>
                        <?php _e('on','tfuse')?> <span class="entry-date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="bookmark"><time class="entry-date" ><?php echo get_the_date(); ?></time></a></span>
                        <?php _e('in','tfuse')?> <span class="cat-links"><?php tfuse_get_term_list($post->post_type,$post->ID); ?></span>
                    </div>
            </div>
        </div>
    </div>
</section>
<?php else:?>
    <div class="entry-header invisible" <?php echo $image_args['style'];?>>
        <h1 class="entry-title invisible"><?php echo get_the_title($post->ID);?></h1>
            <div class="entry-meta invisible">
                <?php _e('By','tfuse')?> <span class="byline"><span class="author vcard"><?php the_author_posts_link() ?></span></span>
                <?php _e('on','tfuse')?> <span class="entry-date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" rel="bookmark"><time class="entry-date" ><?php echo get_the_date(); ?></time></a></span>
                <?php _e('in','tfuse')?> <span class="cat-links"><?php tfuse_get_term_list($post->post_type,$post->ID); ?></span>
            </div>
    </div>
<?php endif;?>

<div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1">
    <div class="entry-content">
        <?php if($post->post_type == 'gallery'):?>
            <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));?>
            <?php if(!empty($image)):?>
                <p><a href="<?php echo $image;?>" rel="prettyPhoto"><img src="<?php echo $image;?>" /></a></p>
            <?php endif;?>
        <?php endif;?>
        <?php the_content(); ?> 
        <div class="clear"></div>
        <?php wp_link_pages(); ?>
    </div>
        <?php if($post->post_type == 'post'): $tag = get_the_tags(); ?>
            <?php  if (!empty($tag)) :?>
                <div class="entry-meta">
                    <span class="tag-links"><?php the_tags( '', ', ', '');?></span>
                </div>
            <?php endif;?>
        <?php endif;?>
</div>

<script>
    jQuery(function($) {
        jQuery('.entry-header').prepend('<img src="<?php echo $image_args['img'] ;?>" alt="" class="testimage<?php echo $uniq;?> hidden" />');
		jQuery('.spinner').css('top', jQuery('.entry-header').outerHeight()/2-16);

        jQuery('.testimage<?php echo $uniq;?>').on('load', function(){
            jQuery('.spinner, .testimage<?php echo $uniq;?>').remove();
            jQuery(".entry-header, .menu-button").removeClass('invisible').addClass('animated fadeIn');

            setTimeout(function(){
                jQuery(".entry-header .entry-title,.entry-header .header-title").removeClass('invisible').addClass('animated fadeInLeft');
                jQuery(".entry-header .entry-meta").removeClass('invisible').addClass('animated fadeInRight');
                jQuery(".header-logo").removeClass('invisible').addClass('animated fadeInDown');
            }, 200);
        });
    });
</script>