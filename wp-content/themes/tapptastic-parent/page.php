<?php 
global $is_tf_blog_page,$post;
$id_post = $post->ID; 
if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
get_header();
if ($is_tf_blog_page) die(); 
?>
<div id="main" class="site-main" >
        <?php  while ( have_posts() ) : the_post();?>
            <?php the_content(); ?> 
        <?php break; endwhile; // end of the loop. ?>
        <?php if ( comments_open() ) : ?>
            <?php tfuse_comments(); ?>
        <?php endif;?>
</div>
<?php get_footer();?>