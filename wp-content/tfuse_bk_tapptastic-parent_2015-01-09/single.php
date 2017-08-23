<?php get_header(); ?>
<div id="main" class="site-main">
        <?php  tfuse_shortcode_content('before'); ?>
        <!-- .Main Section -->
        <section class="main-header">
            <div class="container-fluid">
                <div class="row">
                    <div id="content" class="site-content" role="main">
                        <article class="post post-details">
                            <?php  while ( have_posts() ) : the_post();?>
                                <?php get_template_part('content','single');?>
                            <?php endwhile; // end of the loop. ?> 
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- .Main Section -->

        <!-- .Main Section -->
        <section class="main-row">
            <?php if ( comments_open() ) : ?>
               <?php  tfuse_comments(); ?>
            <?php endif; ?>
        </section>
        <!-- .Main Section -->
        <?php  tfuse_shortcode_content('after'); ?>
</div>
<?php get_footer();?>