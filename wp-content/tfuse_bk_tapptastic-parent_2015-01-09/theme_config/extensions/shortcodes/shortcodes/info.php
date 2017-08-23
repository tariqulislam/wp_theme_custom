<?php
function tfuse_info($atts, $content = null) {
    global $inf;
    extract(shortcode_atts(array(), $atts));
    $inf = ''; 
    $get_info = do_shortcode($content);

    $i = 0;
    $output = '';

        $output .= '<div class="row inner">
                        <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                            <div id="content" class="site-content" role="main">';

        while (isset($inf['title'][$i])) {
            $output .= '<article class="about-us clearfix">
                                <div class="entry-header">
                                    <div class="about-meta"><h3>'.$inf['title'][$i].'</h3></div>
                                    <h1 class="about-title">'.$inf['subtitle'][$i].'</h1>
                                </div>
                                <div class="entry-content">
                                    '.$inf['content'][$i].'
                                </div>
                            </article>';
            $i++;
        }
        $output .= '</div></div></div>';
    
    return $output;
}

$atts = array(
    'name' => __('Info', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array(      
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => __('Give a title', 'tfuse'),
            'id' => 'tf_shc_info_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        
         array(
            'name' => __('Subtitle', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_info_subtitle',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text',
        ),
        
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_info_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'type' => 'textarea',
        ),

    )
);

tf_add_shortcode('info', 'tfuse_info', $atts);


function tfuse_inf($atts, $content = null)
{
    global $inf;
    extract(shortcode_atts(array('title' => '', 'subtitle' => ''), $atts));
    $inf['title'][] = $title;
    $inf['subtitle'][] = $subtitle;
    $inf['content'][] = do_shortcode($content);
}

$atts = array(
    'name' => __('Inf', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 3,
    'options' => array(
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => __('Give a title', 'tfuse'),
            'id' => 'tf_shc_inf_title',
            'value' => '',
            'type' => 'textarea'
        ),
        
         array(
            'name' => __('Subtitle', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_inf_subtitle',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_inf_content',
            'value' => '',
            'type' => 'textarea',
        ),
    )
);

add_shortcode('inf', 'tfuse_inf', $atts);