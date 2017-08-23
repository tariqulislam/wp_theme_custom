<?php get_header();?>
<div id="main" class="site-main">
    <?php  tfuse_shortcode_content('before'); ?>
    <section class="main-row">
        <div class="container">
            <div class="row inner">
                <div class="col-md-10 col-md-offset-1 col-lg-9 col-lg-offset-2">
                    <div id="content" class="site-content" role="main">
                        <?php if (have_posts()) 
                         { $count = 0;
                             while (have_posts()) : the_post(); $count++;
                                 get_template_part('listing', 'blog');
                             endwhile;
                         } 
                         else 
                         { ?>
                             <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                   <?php } ?>
                        <?php  tfuse_pagination();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  tfuse_shortcode_content('after'); ?>
</div>
<?php get_footer();?>
