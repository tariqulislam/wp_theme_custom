<?php 
//[foobar]
function player_slider( $atts = array() ){
    $atts['posts_per_page'] = 4;
    $atts['post_type'] = 'players';
    $posts = get_posts( $atts );
    if(count($posts) > 0) {
    ?>
        <div class="element_size_100">    	 
        	<div class="pix-blog blog-carousel">
            <!-- Blog Start -->                                
                <header class="pix-heading-title">
                    <h2 class="pix-heading-color pix-section-title">Papular Players</h2>
                </header>                   
                <div class="our-team-sec team-vertical">
            		<div    data-cycle-pager-template="" 
                            data-cycle-pager="#players_list1" 
                            data-cycle-random="false" 
                            data-cycle-slides="article" 
                            data-cycle-auto-height="container" 
                            data-cycle-timeout="3000" 
                            data-cycle-fx="fade" 
                            class="cycle-slideshow">
                        <?php foreach ($posts as $post) {
                            $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'player_slider_img_size');
                            $squad_number = get_post_meta($post->ID,'squad_number',true);
                            $player_position = get_post_meta($post->ID,'player_position',true);
                            ?>
                            <article class="cycle-slide">
                                <figure>
                                    <a href="<?= get_permalink( $post->ID ); ?>">
                                        <img alt="<?= $post->post_title ?>" src="<?= $img[0] ?>">
                                    </a>
                                    <figcaption>
                                       <div class="caption">
                                            <span class="pix-player-no"><?= $squad_number; ?></span><!-- squad_number -->
                                            <h2><a href="<?= get_permalink( $post->ID ); ?>"><?= $post->post_title; ?></a></h2>
                                            <h6><a><?= $player_position; ?></a></h6> 
                                        </div> 
                                    </figcaption>
                                </figure>
                            </article>
                        <?php } ?>
                    </div>
                </div>
                <div class="sliderpagination pxleft-team">
        			<ul class="banner-pager" id="players_list1">
                        <?php foreach ($posts as $post) {
                            $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'thumbnail');
                            $squad_number = get_post_meta($post->ID,'squad_number',true);
                            $player_position = get_post_meta($post->ID,'player_position',true);
                            ?>
                            <li>
                                <article>
                                    <figure>
                                        <img src="<?= $img[0] ?>" alt="<?= $post->post_title ?>">
                                    </figure>
                                    <div class="text">
                                        <h2><?= $post->post_title; ?></h2>
                                        <h6><a><?= $player_position; ?></a></h6>
                                        <span class="pix-player-no"><?= $squad_number; ?></span>                        
                                     </div>
                                </article>
            				</li>
                        <?php } ?>
                    </ul>
                </div>   
        	</div>   
        </div>
    <?php } 
    return;
}
add_shortcode( 'playerslider', 'player_slider' );
add_image_size( 'player_slider_img_size', 390, 390, true ); // (cropped)
