<?php 
//[foobar]
function main_top_slider( $atts = array() ){
    $atts['posts_per_page'] = 5;
    $posts = get_posts( $atts );
    if(count($posts) > 0) {
    ?>
        <div class="element_size_100">    	 
        	<div class="pix-blog blog-carousel blog-vertical">
            <!-- Blog Start -->                                
                <header class="pix-heading-title">
                    <h2 class="pix-heading-color pix-section-title">Club SpotLights</h2>
                </header>                                                
        		<div    data-cycle-pager-template="" 
                        data-cycle-pager="#banner-pager1" 
                        data-cycle-random="false" 
                        data-cycle-slides="article" 
                        data-cycle-auto-height="container" 
                        data-cycle-timeout="3000" 
                        data-cycle-fx="fade" 
                        class="cycle-slideshow">
                    <?php foreach ($posts as $post) {
                        $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'top_slider_img_size');
                        ?>
                        <article class="124 cycle-slide cycle-slide-active">
                            <a href="<?= get_permalink( $post->ID ); ?>">
                                <img alt="<?= $post->post_title ?>" src="<?= $img[0] ?>">
                            </a>
                            <div class="caption">
                                <h2>
                                    <a href="<?= get_permalink( $post->ID ); ?>">
                                        <?= $post->post_title; ?>
                                    </a>
                                </h2>
                            </div> 
                        </article>
                    <?php } ?>
                </div>
                <div class="sliderpagination">
        			<ul class="banner-pager" id="banner-pager1">
                        <?php foreach ($posts as $post) {?>
                            <li class="cycle-pager-active">
            					<div class="pager-desc">						
            						<span class="cs-desc"><?= $post->post_title; ?></span>
            					</div>
            				</li>
                        <?php } ?>
                    </ul>
                </div>     
        	</div>   
        </div>
    <?php } 
    return;
}
add_shortcode( 'topslider', 'main_top_slider' );
add_image_size( 'top_slider_img_size', 470, 353, true ); // (cropped)
