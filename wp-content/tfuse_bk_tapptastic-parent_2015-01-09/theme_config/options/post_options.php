<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */ 
    array('name' => __('Post Info','tfuse'),
        'id' => TF_THEME_PREFIX . '_info',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Post SubTitle','tfuse'),
        'desc' => __('Post subtitle.','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_subtitle',
        'value' => '',
        'type' => 'text',
        'divider' => true
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
);

?>