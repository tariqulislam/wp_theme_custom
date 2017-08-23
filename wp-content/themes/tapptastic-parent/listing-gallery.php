<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
 global $more,$post;
    $more = apply_filters('tfuse_more_tag',0);
?>
<li class="gallery-item">
    <div class="gallery-img">
        <?php echo get_the_post_thumbnail($post->ID, 'medium-thumb'); ?>
        <div class="see-more"><a href="<?php the_permalink(); ?>" class="link" title="<?php echo get_the_title();?>"></a></div>
    </div>
</li>