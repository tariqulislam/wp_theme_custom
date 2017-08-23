<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Plugin Name: News
 * Description: Custom made news display.
 * Version: 1.0
 * Author: Me
 */

function news_display( ){
     $args = array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    );

    $posts = get_posts( $atts );
    ob_start();
    if(count($posts) > 0) {
        foreach ($posts as $post) {
            $img = get_metadata( 'news', $post->ID, 'news_image' );
            var_dump($img);
            ?><div class="fw-col-xs-12 fw-col-sm-8">
                <div class="fw-heading fw-heading-h4 ">
                    <h4 class="fw-special-title"><?= $post->post_title; ?></h4>
                </div>
                <p style="text-align: left;">
                    <?= $post->post_content; ?>
                </p>
            </div>
            <div class="fw-col-xs-12 fw-col-sm-4">
                <p>
                    <img width="240" height="155" alt="<?= $post->post_title; ?>" src="http://www.gameonstream.com/goscorp/wp-content/uploads/2015/01/a1-240x155.png">
                </p>
            </div><?php 
        } 
    } 
    return ob_get_clean();
}
add_shortcode( 'news', 'news_display' );
