<?php
function tfuse_header_info($atts,$content = null){
    
    extract(shortcode_atts(array('icon' => '','text' => '','link' => '','title' => ''), $atts));
    $output = '';
        
    if(!empty($content))
    {
        if($title == 'big')
            $class = 'big-text';
        else
            $class = '';
        
        $output .= '<h2 class="header-title '.$class.' invisible">'.do_shortcode($content).'</h2> ';
                    if(!empty($text))
                        $output .= '<a href="'.$link.'" class="btn btn-transparent invisible"><i class="'.$icon.'"></i><span>'.$text.'</span><i class="icon-arrow-right-s"></i></a>';
        $output .= '';
    }

    
    return $output;
}

$atts = array(
    'name' => __('Header Info', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Text Size', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_header_info_title',
            'value' => 'small',
            'options' => array('small' => __('Small Text','tfuse'),'big' => __('Big Text','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_header_info_content',
            'value' => '',
            'type' => 'textarea',
        ),
        
        array(
            'name' => __('Button Icon', 'tfuse'),
            'desc' => 'ex : icon-apple,icon-android,icon-rss ',
            'id' => 'tf_shc_header_info_icon',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Button Text', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_header_info_text',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Button Link', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_header_info_link',
            'value' => '',
            'type' => 'text',
        ),

    )
);

tf_add_shortcode('header_info', 'tfuse_header_info', $atts);