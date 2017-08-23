<?php
function tfuse_gallery($atts){
    
    extract(shortcode_atts(array('category' => ''), $atts));
    $output = '';
    
    $uniq = rand(1,1000);
        
    if($category != 0)
    {
        $term = get_term_by('id', $category , 'galleries');
        
        $term_children = get_term_children( $category, 'galleries' );
        
        $args = array(
        'posts_per_page' => -1,
	'post_type' => 'gallery',
	'tax_query' => array(
		array(
			'taxonomy' => 'galleries',
			'field' => 'id',
			'terms' => $category
                    )
                )
        );
        $query = new WP_Query( $args );
        
        $posts = $query->get_posts();
        
        if(!empty($term))
        {
        $output .= '<section class="adv-filter">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul id="categories'.$uniq.'">
                            <li class="categories-item active" data-category=""><i class="filter-icon"></i><span>'.$term->name.'</span></li>';
                            if(!empty($term_children))
                            {
                                foreach ($term_children as $id) {
                                    $term_child = get_term_by('id', $id , 'galleries');
                                    $output .= '<li class="categories-item" data-category="'.$term_child->slug.'"><i class="filter-icon"></i><span>'.$term_child->name.'</span></li>';
                                }
                            }
            $output .='</ul>
                    </div>
                </div>
            </div>
        </section>';
        
        $output .= '<section class="main-row row-bg">
                        <div class="container">
                            <div class="row inner">
                                <div class="col-sm-12">
                                    <div id="content" class="site-content" role="main">
                                        <ul id="gallery-list'.$uniq.'" class="gallery-list">';
                                            if(!empty($posts))
                                            {
                                                foreach ($posts as $post) { 
                                                    $data_category = array();
                                                    
                                                    $post_terms = wp_get_post_terms( $post->ID, 'galleries');
                                                    
                                                    if(!empty($post_terms))
                                                        foreach ($post_terms as $p_terms)
                                                            $data_category[] = $p_terms->slug;
                                                    
                                                    $output .= '<li class="gallery-item" data-category="'.implode(' ',$data_category).'">
                                                                    <div class="gallery-img">
                                                                        '.get_the_post_thumbnail($post->ID, 'medium-thumb').'
                                                                        <div class="see-more"><a href="'.get_permalink($post->ID).'" class="link"  title="'.$post->post_title.'"></a></div>
                                                                    </div>
                                                                </li>';
                                                }
                                            }
                            $output .= '</ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>';
        
        $output .= "<script>
                        jQuery(document).ready(function($) {
                            jQuery('#gallery-list".$uniq."').isotope({
                                transitionDuration: '0.4s'
                            });
                            jQuery('#categories".$uniq."').on('click', '.categories-item', function() {
                                jQuery('.categories-item').removeClass('active');
                                jQuery(this).addClass('active');

                                var option = $(this).data('category'),
                                    search = option ? function() {
                                        var item = jQuery(this),
                                                name = item.data('category') ? item.data('category') : '';
                                        return name.match(new RegExp(option));
                                    } : '*';

                                jQuery('#gallery-list".$uniq."').isotope({filter : search});
                            });
                        });
                    </script>";
		}
    }
    
    return $output;
}

$atts = array(
    'name' => __('Gallery', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Category', 'tfuse'),
            'desc' => __('Select Parent Gallery Category','tfuse'),
            'id' => 'tf_shc_gallery_category',
            'value' => '',
            'options' => tfuse_list_galleries(),
            'type' => 'select',
        )

    )
);

tf_add_shortcode('gallery', 'tfuse_gallery', $atts);