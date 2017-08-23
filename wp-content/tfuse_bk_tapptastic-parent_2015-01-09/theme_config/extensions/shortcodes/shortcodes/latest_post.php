<?php
function tfuse_latest_post($atts,$content = null){
    
    extract(shortcode_atts(array('title' => ''), $atts));
    $output = '';
    
    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'post',
        'orderby' => 'date'
    );
    
    $query = new WP_Query($args);
    $post = $query->get_posts();
    
    if(!empty($post[0]))
    {
        $cat = get_the_category($post[0]->ID);
        $output .= '<div class="inner"><div class="widget-text about-us">
                        <div class="inner">
                            <h3 class="widget-title">'.$title.'</h3>
                            <p>'.strip_tags(tfuse_shorten_string(strip_shortcodes($post[0]->post_content),20)). '</p>';
                            $output .= '<a class="btn btn-dark btn-transparent btn-small" href="'.get_category_link($cat[0]->term_id).'">'.__('Read on Blog','tfuse').'</a>';
            $output .= '</div>
                    </div></div>';
    }
    
    return $output;
}

$atts = array(
    'name' => __('Latest Post', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_latest_post_title',
            'value' => '',
            'type' => 'text',
        )
    )
);

tf_add_shortcode('latest_post', 'tfuse_latest_post', $atts);