<?php
function tfuse_button($atts,$content = null){
    
    extract(shortcode_atts(array('icon' => '','text' => '','link' => '','type' => '', 'class' => ''), $atts));
    $output = '';
    
    $btn_size = ($type == 'default') ? '' : 'btn-large';
        
    if(!empty($text))
        $output .= '<a href="'.$link.'" class="btn '.$btn_size.' '.$class.'"><i class="'.$icon.'"></i><span>'.$text.'</span><i class="icon-arrow-right-s"></i></a>';

    
    return $output;
}

$atts = array(
    'name' => __('Button', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Button Type', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_button_type',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'big' => __('Big','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Button Class', 'tfuse'),
            'desc' => 'ex: btn-green, btn-blue, btn-dark, btn-disabled , btn-transparent, btn-black',
            'id' => 'tf_shc_button_class',
            'value' => '',
            'type' => 'text',
        ),
        array(
            'name' => __('Button Icon', 'tfuse'),
            'desc' => 'ex : icon-apple,icon-android,icon-rss,icon-twitter',
            'id' => 'tf_shc_button_icon',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Button Text', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_button_text',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Button Link', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_button_link',
            'value' => '',
            'type' => 'text',
        ),

    )
);

tf_add_shortcode('button', 'tfuse_button', $atts);