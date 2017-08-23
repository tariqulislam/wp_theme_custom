<?php
function tfuse_text($atts,$content = null){
    
    extract(shortcode_atts(array('title' => '','text' => '','link' => ''), $atts));
    $output = '';
        
    $output .= '<div class="inner"><div class="widget-text about-us">
                    <div class="inner">
                        <h3 class="widget-title">'.$title.'</h3>
                        <p>'.do_shortcode($content).'</p>';
                        if(!empty($text))
                            $output .= '<a class="btn btn-dark btn-transparent btn-small" href="'.$link.'">'.$text.'</a>';
        $output .= '</div>
                </div></div>';

    
    return $output;
}

$atts = array(
    'name' => __('Text', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_text_title',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_text_content',
            'value' => '',
            'type' => 'textarea',
        ),
        
        array(
            'name' => __('Button Text', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_text_text',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Button Link', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_text_link',
            'value' => '',
            'type' => 'text',
        ),

    )
);

tf_add_shortcode('text', 'tfuse_text', $atts);