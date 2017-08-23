<?php

/**
 * Testimonials
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * order: RAND, ASC, DESC
 */
function tfuse_testimonials($atts, $content = null) {
    global $testimonials_uniq;
    extract(shortcode_atts(array( 'order ' => 'RAND','title'=> '','items'=> ''), $atts));
    
    $slide = $nav = $single = '';
    $testimonials_uniq = rand(1, 300);

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = '&order=' . $order;
    else
        $order = '&orderby=rand';

    $posts = get_posts('post_type=testimonials&posts_per_page=-1' . $order);
    $k = $c = 0;   
    if(!empty($posts))
    {
            $slide .= '
                <div class="inner">
                <div class="section-meta">
                    <div class="section-icon"><i class="icon-comment"></i></div>
                    <div class="section-title">
                        <h2>'.$title.'</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-8 col-md-offset-2">
                        <div id="testimonial-carousel" class="carousel slide" data-ride="carousel" data-interval="12000">
                            <div class="carousel-inner">';
                             $count = 0;   foreach($posts as $post){  
                                    if($count == $items) break;
                                    $class = ($c == 0) ? 'active' : '';
                                    
                                    $slide .='<div class="item '.$class.'">
                                        <div class="testimonial-text"><p>'.strip_tags($post->post_content). '</p></div>
                                        <span class="testimonial-author blue-text">' . $post->post_title . '</span>
                                    </div>';
                                    $c++;$count++;
                                }
                            $slide .= '</div>
                            <ol class="carousel-indicators">';
                                $count1 = 0; foreach($posts as $post){ 
                                    if($count1 == $items) break;
                                    $klass = ($k == 0) ? 'class="active"' : '';
                                    
                                    $slide .= '<li data-target="#testimonial-carousel" data-slide-to="'.$k.'" '.$klass.'></li>';
                                    $k++;$count1++;
                                }
                            $slide .= '</ol>
                        </div>
                    </div>
                </div></div>';
                            
    }
    return $slide;
}

$atts = array(
    'name' => __('Testimonials','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_testimonials_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_testimonials_items',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Order','tfuse'),
            'desc' => __('Select display order','tfuse'),
            'id' => 'tf_shc_testimonials_order',
            'value' => 'DESC',
            'options' => array(
                'RAND' => __('Random','tfuse'),
                'ASC' => __('Ascending','tfuse'),
                'DESC' => __('Descending','tfuse')
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('testimonials', 'tfuse_testimonials', $atts);
