<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Tapptastic 1.0
 */
 global $more;
    $more = apply_filters('tfuse_more_tag',0); 
?>
<article class="post row">
    <div class="entry-header col-sm-5">
        <div class="entry-meta"><h3><?php echo tfuse_page_options('post_subtitle');?></h3></div>
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php  echo get_the_title(); ?></a></h1>
        <div class="entry-meta-second">
            <span class="comments-link"><a href="<?php comments_link(); ?>" title=""><i class="icon-comment-f"></i><span><?php comments_number("0 ".__('Comments','tfuse'), "1 ".__('Comment','tfuse'), "% ".__('Comments','tfuse')); ?></span></a></span>
            <span class="add-comment-link"><a href="<?php comments_link(); ?>" title=""><i class="icon-comment-add"></i><span><?php _e('Add yours','tfuse'); ?></span></a></span>
        </div>
    </div>
    <div class="entry-content col-sm-7">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if ( tfuse_options('post_content') == 'content') the_content(__('Keep Reeding','tfuse')); else the_excerpt(); ?>
        </div>
    </div>
</article>