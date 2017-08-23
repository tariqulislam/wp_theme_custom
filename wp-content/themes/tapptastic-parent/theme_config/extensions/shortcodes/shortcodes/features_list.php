<?php
function tfuse_features_list($atts, $content = null) {
    global $feature_list;
    extract(shortcode_atts(array('btitle' => '' , 'bsubtitle' => ''), $atts));
    $feature_list = ''; 
    $get_features_list = do_shortcode($content);

    $i = 0;
    $output = '';

        $output .= '<div class="inner">
                    <div class="section-meta">
                        <div class="section-title">
                            <h2>'.$btitle.'</h2>
                            <h4>'.$bsubtitle.'</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="features-list">';

        while (isset($feature_list['icon'][$i])) {
            $output .= '<div class="feature-item col-sm-6 col-md-3">
                            <div class="inner">
                                <div class="feature-img"><i class="'.$feature_list['icon'][$i].'"></i></div>
                                <div class="feature-title"><h4>'.$feature_list['title'][$i].'</h4></div>
                                <div class="feature-desc">
                                    <p>'.$feature_list['content'][$i].'</p>
                                </div>
                            </div>
                        </div>';
            $i++;
        }
        $output .= '</div></div></div>';
    
    return $output;
}

$atts = array(
    'name' => __('Features List', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Block Title', 'tfuse'),
            'desc' => __('Give a title', 'tfuse'),
            'id' => 'tf_shc_features_list_btitle',
            'value' => '',
            'type' => 'text'
        ),
        
         array(
            'name' => __('Block Subtitle', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_features_list_bsubtitle',
            'value' => '',
            'type' => 'text',
             'divider' => true
        ),
        
        array(
            'name' => __('Icon', 'tfuse'),
            'desc' => __('Class Icon ex: icon-clock, icon-page, icon-place, icon-share, icon-apple,
                        icon-android, icon-page, icon-share, icon-arrow-right, icon-arrow-left, icon-comment,
                         icon-facebook-f, icon-twitter-f, icon-vimeo-f, icon-features, icon-gallery, icon-blog, 
                         icon-about, icon-contact', 'tfuse'),
            'id' => 'tf_shc_features_list_icon',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        
         array(
            'name' => __('Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_features_list_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text',
        ),
        
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_features_list_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'type' => 'textarea',
            'divider' => true
        ),

    )
);

tf_add_shortcode('features_list', 'tfuse_features_list', $atts);


function tfuse_feature_list($atts, $content = null)
{
    global $feature_list;
    extract(shortcode_atts(array('title' => '', 'btitle' => '','bsubtitle' => '','icon' => ''), $atts));
    $feature_list['btitle'][] = $btitle;
    $feature_list['bsubtitle'][] = $bsubtitle;
    $feature_list['icon'][] = $icon;
    $feature_list['title'][] = $title;
    $feature_list['content'][] = do_shortcode($content);
}

$atts = array(
    'name' => __('Feature List', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 3,
    'options' => array(
        array(
            'name' => __('Block Title', 'tfuse'),
            'desc' => __('Give a title', 'tfuse'),
            'id' => 'tf_shc_feature_list_btitle',
            'value' => '',
            'type' => 'textarea'
        ),
        
         array(
            'name' => __('Block Subtitle', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_feature_list_bsubtitle',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Icon', 'tfuse'),
            'desc' => __('Class Icon ex: icon-clock, icon-page, icon-place, icon-share, icon-apple,
                        icon-android, icon-page, icon-share, icon-arrow-right, icon-arrow-left, icon-comment,
                         icon-facebook-f, icon-twitter-f, icon-vimeo-f, icon-features, icon-gallery, icon-blog, 
                         icon-about, icon-contact', 'tfuse'),
            'id' => 'tf_shc_feature_list_icon',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_feature_list_title',
            'value' => '',
            'type' => 'text',
        ),
        
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_feature_list_content',
            'value' => '',
            'type' => 'textarea',
        ),
    )
);

add_shortcode('feature_list', 'tfuse_feature_list', $atts);