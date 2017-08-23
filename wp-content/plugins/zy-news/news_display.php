<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Plugin Name: News
 * Description: Custom made news display.
 * Version: 1.0
 * Author: Me
 */
function news_display( ){
    $posts = get_posts( array( 'post_type' => 'news' ) );
    ob_start();
    if(count($posts) > 0) {
        foreach ($posts as $index => $post) {
            $custom_fields = get_post_custom($post->ID);
            $img = null;
            $sm = 12;
            if (isset($custom_fields['news_image']) && !empty($custom_fields['news_image'][0])) {
                $img = get_post($custom_fields['news_image'][0]);
                $sm = 8;
            }?>
            <?php if (!empty($img) && $index%2==0) { ?>
                <div class="fw-col-xs-12 fw-col-sm-4">
                    <p>
                        <img width="240" height="155" alt="<?= $post->post_title; ?>" src="<?= $img->guid ?>">
                    </p>
                </div>
            <?php }?>
            <div class="fw-col-xs-12 fw-col-sm-<?=$sm?> all-p-left">
                <div class="fw-heading fw-heading-h4 ">
                    <h4 class="fw-special-title"><?= $post->post_title; ?></h4>
                </div>
                <?= $post->post_content; ?>
                <hr/>
                <p>By <?= get_the_author_meta( 'display_name', $post->post_author ); ?></p>
            </div>
            <?php if (!empty($img) && !$index%2==0) { ?>
                <div class="fw-col-xs-12 fw-col-sm-4">
                    <p>
                        <img width="240" height="155" alt="<?= $post->post_title; ?>" src="<?= $img->guid ?>">
                    </p>
                </div>
            <?php }?>
            <div class="clearfix"></div>
        <?php } ?>
        <style type="text/css">
            .all-p-left p{
                text-align: left;
            }
        </style>
        <?php
    } 
    return ob_get_clean();
}
add_shortcode( 'news', 'news_display' );
