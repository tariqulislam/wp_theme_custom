<?php
function tfuse_search($atts,$content = null){
    
    extract(shortcode_atts(array('title' => ''), $atts));
    $output = '';
        
        if($title == 'big')
            $class = 'big-text';
        else
            $class = '';
        
        $output .= '<h2 class="header-title '.$class.' invisible">'.do_shortcode($content).'</h2> ';
        $output .= '<div class="header-search invisible">
                    <form id="searchForm" action="'.home_url( '/' ).'" method="get">
                        <label for="stext">'.__('Search','tfuse').'</label>
                        <input type="text" name="s" id="stext" value="" class="stext">
                        <button type="submit" id="searchSubmit" class="button-search"><i class="icon-search"></i></button>
                    </form>
                </div>';

    
    return $output;
}

$atts = array(
    'name' => __('Search', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Text Size', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_search_title',
            'value' => 'small',
            'options' => array('small' => __('Small Text','tfuse'),'big' => __('Big Text','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_search_content',
            'value' => '',
            'type' => 'textarea',
        ),
        
       

    )
);

tf_add_shortcode('search', 'tfuse_search', $atts);