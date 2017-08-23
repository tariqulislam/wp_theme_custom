<?php
/**
 * Defined number of placeholders
 *
 * @since  Tapptastic 1.0
 */
$cfg['max_placeholders'] = 1;
$cfg['select_options'] = array(
    'post_types' => array(
        'post' => array(
            'name' => __('Posts','tfuse'),
            'has_id' => TRUE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'page' => array(
            'name' => __('Pages','tfuse'),
            'has_id' => TRUE,
            'has_templates' => TRUE,
            'default_number' => 1,
            'templates' => array()
        )
    ),
    'categories' => array(
        'category' => array(
            'name' => __('Categories','tfuse'),
            'has_id' => TRUE,
            'has_templates' => FALSE,
            'default_number' => 1
        )
    ),
    'other' => array(
        'is_archive' => array(
            'name' => __('Archives','tfuse'),
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        
        'is_front_page' => array(
            'name' => __('Front Page','tfuse'),
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'is_blogpage' => array(
            'name' => __('Blog Page','tfuse'),
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
  'is_search' => array(
            'name' => __('Search Page','tfuse'),
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        ),
        'is_404' => array(
            'name' => __('404 Error Page','tfuse'),
            'has_id' => FALSE,
            'has_templates' => FALSE,
            'default_number' => 1
        )
    )
);
#define number of placeholders for custom post types, defined manually
$cfg['post_types'] = array(
    'offer' => 1,
    'amenity' => 1,
    'attachment' => 1,
    'gallery' => 1,
    'room' => 1,
    'testimonials' => 1
);
#define number of placeholders for custom taxonomies, defined manually
$cfg['taxonomies'] = array(
    'types' => 1,
    'rooms' => 1,
    'offers' => 1,
    'galleries' => 1,
    'amenities' => 1
);

$url = tf_config_extimage($this->ext->sidebars->_the_class_name, '');

$cfg['sidebar_positions_options'] =
        array(
            1 => array(
                'id' => 'sidebars_positions_1',
                'options' => array(
                    'full' => array($url . 'placeholder_1/full.png', __('No sidebar on the page','tfuse')),
                    'left' => array($url . 'placeholder_1/left.png', __('Align to the left','tfuse')),
                    'right' => array($url . 'placeholder_1/right.png', __('Align to the right','tfuse'))
                )
            )
);

$cfg['sidebar_disabled_types'] = array();

$cfg['sidebars_colors'] = array(1 => 'blue');
