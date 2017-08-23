<?php 
if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');
            update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
        }
    }
endif;


add_theme_support( 'post-thumbnails', array('post','gallery'));

add_image_size( 'feature-image', 9999, 9999, true ); 
add_image_size( 'medium-thumb', 330, 330, true );

