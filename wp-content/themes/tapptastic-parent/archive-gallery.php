<?php get_header();?>
<div id="main" class="site-main">
    <?php  tfuse_shortcode_content('before'); ?>
    <?php get_template_part('gallery','filter');?>
    <section class="main-row">
        <div class="container">
            <div class="row inner">
                <div class="col-sm-12 ">
                    <div id="content" class="site-content" role="main">
                        <ul id="gallery-list" class="gallery-list">
                        <?php if (have_posts()) 
                         { $count = 0;
                             while (have_posts()) : the_post(); $count++;
                                 get_template_part('listing', 'gallery');
                             endwhile;
                         } 
                         else 
                         { ?>
                             <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                   <?php } ?>
                        </ul>
                        <?php  tfuse_pagination();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  tfuse_shortcode_content('after'); ?>
</div>
<script>
    jQuery(document).ready(function($) {
        jQuery('#gallery-list').isotope({
            transitionDuration: '0.4s'
        });

        jQuery('#categories').on('touchstart click', '.categories-item', function() {

            var option = jQuery(this).data('category'),
                search = option ? function() {
                    var $item = $(this),
                            name = $item.data('category') ? $item.data('category') : '';
                    return name.match(new RegExp(option));
                } : '*';

            jQuery('#gallery-list').isotope({filter : search});
        });

    });
</script>
<?php get_footer();?>