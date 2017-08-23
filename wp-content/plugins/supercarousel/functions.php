<?php
/*
  Plugin Name: SuperCarousel
  Plugin URI: http://www.taraprasad.com/supercarousel
  Description: A responsive Image and Content carousel wordpress plugin
  Version: 2.9
  Author: Taraprasad Swain
  Author URI: http://www.taraprasad.com

  Copyright 2014 by Taraprasad.com (email : swain.tara@gmail.com)
 */

if (!defined('SUPER_ROOT')) {
    include("config.php");
}

include("supervars.php");

add_action('after_setup_theme', 'init_supercarousel');

function init_supercarousel() {

    if (!defined('SUPER_ROOT')) {
        include("config.php");
    }

    include("supervars.php");

    include("includes/tweet.widget.php");

    include("includes/supercarousel.widget.php");

    add_action('wp_enqueue_scripts', 'super_scripts_method');

    add_filter('enter_title_here', 'change_default_super_title');

    add_action('init', 'create_super_post_types');

    add_shortcode('supercarousel', 'supercarousel_func');

    add_action('save_post', 'save_super_post_meta');

    add_action('admin_init', 'register_super_meta_box');

    add_action('admin_print_scripts', 'admin_inline_js');

    add_filter('manage_edit-supercarousel_columns', 'set_custom_edit_supercarousel_columns');

    add_action('manage_supercarousel_posts_custom_column', 'custom_supercarousel_column', 10, 2);
}

function register_super_meta_box() {
    add_meta_box('superimage_meta', __('Super Image Slides'), 'supercarousel_image_meta', 'superimage', 'normal', 'high');
    add_meta_box('super_meta', __('Super Carousel Settings'), 'supercarousel_meta', 'supercarousel', 'normal', 'high');
}

function admin_inline_js() {
    wp_enqueue_script('adminsuperjs', plugins_url('/js/admin.js', __FILE__));
    wp_enqueue_style('adminsuperstyles', plugins_url('/css/admin.css', __FILE__));

    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    }
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox-js', site_url() . '/' . WPINC . '/js/thickbox/thickbox.js');
    wp_enqueue_style('thickbox-css', site_url() . '/' . WPINC . '/js/thickbox/thickbox.css');
    ?>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var thickboxL10n = {
            next: "Next >",
            prev: "< Prev",
            image: "Image",
            of: "of",
            close: "Close"
        };
        try {
            convertEntities(thickboxL10n);
        } catch (e) {
        }
        ;
        /* ]]> */
        var tb_closeImage = "<?php bloginfo('wpurl'); ?>/wp-includes/js/thickbox/tb-close.png";
        var tb_pathToImage = "<?php bloginfo('wpurl'); ?>/wp-includes/js/thickbox/loadingAnimation.gif";
    </script>
    <?php
}

function supercarousel_image_meta() {
    include('admin-views/supercarousel-image-meta.php');
}

function supercarousel_meta() {
    include('admin-views/supercarousel-meta.php');
}

function supercarousel_func($atts) {
    $parentpost = get_post();

    $parentpostid = $parentpost->ID;

    $postid = (int) $atts['id'];

    ob_start();
    if ($postid > 0) {
        $post = get_post($postid);
        if ($post->post_type == 'supercarousel') {
            include('views/supercarousel.php');
        }
    }
    $string = ob_get_contents();
    ob_end_clean();
    return $string;
}

function create_super_post_types() {
    register_post_type('supercarousel', array(
        'labels' => array(
            'name' => __('Super Carousel'),
            'add_new_item' => __('Add New Carousel'),
            'singular_name' => __('Super Carousel')
        ),
        'public' => false,
        'exclude_from_search' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_ui' => true,
        'supports' => array('title', 'page-attributes'),
        'rewrite' => false
            )
    );

    register_taxonomy(
            'super_category', 'supercontent', array(
        'labels' => array(
            'name' => _x('Categories', 'taxonomy general name'),
            'search_items' => __('Search Content Categories'),
            'all_items' => __('All Content Categories'),
            'parent_item' => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item' => __('Edit Category'),
            'update_item' => __('Update Category'),
            'add_new_item' => __('Add New Content Category'),
            'new_item_name' => __('New Category Name'),
            'menu_name' => __('Categories'),
        ),
        'public' => false,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_tagcloud' => false,
        'show_admin_column' => false,
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => false
            )
    );

    register_post_type('supercontent', array(
        'labels' => array(
            'name' => __('Super Content'),
            'add_new_item' => __('Add Content Slide'),
            'singular_name' => __('Super Content')
        ),
        'taxonomies' => array('super_category'),
        'public' => false,
        'has_archive' => false,
        'exclude_from_search' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_ui' => true,
        'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'excerpt'),
        'rewrite' => false,
        'query_var' => false
            )
    );

    register_post_type('superimage', array(
        'labels' => array(
            'name' => __('Super Image'),
            'add_new_item' => __('Add Images'),
            'singular_name' => __('Super Image')
        ),
        'public' => false,
        'exclude_from_search' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_ui' => true,
        'supports' => array('title', 'page-attributes'),
        'rewrite' => false
            )
    );
}

function save_super_post_meta($postId) {

    if (function_exists('get_current_screen')) {
        $screen = get_current_screen();

        if (isset($screen->post_type) and $screen->post_type == 'superimage' and isset($_POST)) {
            //update_post_meta($postId, 'title_text', $_POST['title_text']);
            if (isset($_POST['images']) and is_array($_POST['images'])) {
                foreach ($_POST['images']['caption'] as $i => $row) {
                    $_POST['images']['caption'][$i] = urlencode($_POST['images']['caption'][$i]);
                }
                //, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE
                $data = json_encode($_POST['images']);
            } else {
                $data = array();
            }
            update_post_meta($postId, 'images', $data);
        } else if (isset($screen->post_type) and $screen->post_type == 'supercarousel' and isset($_POST)) {
            //update_post_meta($postId, 'title_text', $_POST['title_text']);
            if (isset($_POST['super']) and is_array($_POST['super'])) {
                $data = json_encode($_POST['super']);
            } else {
                $data = array();
            }
            update_post_meta($postId, 'supersettings', $data);
        }
    }
}

function change_default_super_title($title) {
    $screen = get_current_screen();

    if ($screen->post_type == 'superimage') {
        $title = 'Enter Image Carousel Name';
    } else if ($screen->post_type == 'supercontent') {
        $title = 'Enter Content Slide Name';
    } else if ($screen->post_type == 'supercarousel') {
        $title = 'Enter Carousel Name';
    }

    return $title;
}

function super_scripts_method() {
    if (defined('SUPER_USESINGLERESOURCES') and SUPER_USESINGLERESOURCES === true) {
        wp_enqueue_script('sucarouselmergedjs', plugins_url('js/supercarouselmerged.js', __FILE__), array('jquery'), '2.4', true);
        wp_enqueue_style('sucarouselmergedcss', plugins_url('css/supercarouselmerged.css', __FILE__));
    } else {
        wp_enqueue_script('sucarousel', plugins_url('js/jquery.supercarousel.min.js', __FILE__), array('jquery'), '2.4', true);
        wp_enqueue_script('imageloaded', plugins_url('js/jquery.imagesloaded.min.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('ismouseover', plugins_url('js/jquery.ismouseover.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('easing', plugins_url('js/jquery.easing.min.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('easingCompatible', plugins_url('js/jquery.easing.compatibility.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('mousewheel', plugins_url('js/jquery.mousewheel.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('touchSwipe', plugins_url('js/jquery.touchSwipe.min.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('feedify', plugins_url('js/jquery.feedify.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('framerate', plugins_url('js/jquery.framerate.js', __FILE__), array('jquery'), false, true);

        wp_enqueue_script('lightGalleryjs', plugins_url('js/lightGallery.min.js', __FILE__), array('jquery'), false, true);

        wp_enqueue_script('watch-js', plugins_url('js/jquery.watch.js', __FILE__), array('jquery'), false, true);

        wp_enqueue_style('styles', plugins_url('css/supercarousel.css', __FILE__));

        wp_enqueue_style('lightGalleryStyles', plugins_url('css/lightGallery.css', __FILE__));
    }
}

function set_custom_edit_supercarousel_columns($columns) {
    $tempdate = $columns['date'];
    unset($columns['date']);
    return $columns + array('short_code' => __('Short Code'), 'date' => $tempdate);
}

function custom_supercarousel_column($column, $post_id) {
    switch ($column) {
        case 'short_code':
            echo '<input type="text" onclick="this.select();" value="[supercarousel id=' . $post_id . ']" />';
            break;
    }
}

function supershow($val) {
    if (is_array($val) or is_object($val)) {
        echo "<pre>";
        print_r($val);
        echo "</pre>";
    } else {
        echo $val;
    }
}

function get_super_thumb($img) {
    $imgx = array_reverse(explode('.', $img));
    $imgx[1] = $imgx[1] . '-150x150';
    $imgx = array_reverse($imgx);
    return join('.', $imgx);
}

function get_supercontentdata_template($row, $settingsarr) {
    extract($settingsarr);
    $temp = '';

    if (has_post_thumbnail($row->ID)) {
        if ($imageSize == '') {
            $imageSize = 'full';
        }
        $fimgarr = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), $imageSize, true);
    } else {
        $fimgarr = array();
    }

    if ($contenttemplate == 'tfp') {
        $temp .= '<div class="supercontentdata"><div class="relative-blk">';
        $temp .= '<div class="slider-info w50">';

        if ($row->post_title != '' and $contenttitle == '1') {
            if ($contentlink == '1') {
                $temp .= '<h2><a href="' . get_permalink($row->ID) . '">' . $row->post_title . '</a></h2>';
            } else {
                $temp .= '<h2>' . $row->post_title . '</h2>';
            }
        }

        if ($row->post_excerpt != '') {
            $temp .= '<p>' . $row->post_excerpt . '</p>';
        } else if ($row->post_content != '') {
            $temp .= '<p>' . $row->post_content . '</p>';
        }

        $temp .= '</div>';

        if (isset($fimgarr[0]) and $fimgarr[0] != '') {
            if ($contentlink == '1') {
                $temp .= '<a href="' . get_permalink($row->ID) . '"><img class="alignnone" src="' . $fimgarr[0] . '"></a>';
            } else {
                $temp .= '<img class="alignnone" src="' . $fimgarr[0] . '">';
            }
        }
        $temp .= '</div></div>';
    } else if ($contenttemplate == 'tt') {
        $temp .= '<div class="supercontentdata">';
        $temp .= '<div class="w100">';

        if (isset($fimgarr[0]) and $fimgarr[0] != '') {
            if ($contentlink == '1') {
                $temp .= '<a href="' . get_permalink($row->ID) . '"><img class="alignnone" src="' . $fimgarr[0] . '"></a>';
            } else {
                $temp .= '<img class="alignnone" src="' . $fimgarr[0] . '">';
            }
        }

        $temp .= '<div class="bg-grey-light">';

        if ($row->post_title != '' and $contenttitle == '1') {
            if ($contentlink == '1') {
                $temp .= '<p><a href="' . get_permalink($row->ID) . '"><strong>' . $row->post_title . '</strong></a></p>';
            } else {
                $temp .= '<p><strong>' . $row->post_title . '</strong></p>';
            }
        }

        if ($row->post_excerpt != '') {
            $temp .= '<p>' . $row->post_excerpt . '</p>';
        } else if ($row->post_content != '') {
            $temp .= '<p>' . $row->post_content . '</p>';
        }

        $temp .= '</div>';
        $temp .= '</div></div>';
    } else if ($contenttemplate == 'tbs1') {
        $temp .= '<div class="supercontentdata"><div class="smpl-post">';

        if (isset($fimgarr[0]) and $fimgarr[0] != '') {
            $temp .= '<p>';
            if ($contentlink == '1') {
                $temp .= '<a href="' . get_permalink($row->ID) . '"><img class="alignnone" src="' . $fimgarr[0] . '"></a>';
            } else {
                $temp .= '<img class="alignnone" src="' . $fimgarr[0] . '">';
            }

            $temp .= '</p>';
        }

        $author = get_the_author_meta('user_nicename', $row->post_author);
        $temp .= '<p>By <span class="txt-orange">' . $author . '</span></p>';

        if ($row->post_title != '' and $contenttitle == '1') {
            if ($contentlink == '1') {
                $temp .= '<h4><a href="' . get_permalink($row->ID) . '">' . $row->post_title . '</a></h4>';
            } else {
                $temp .= '<h4>' . $row->post_title . '</h4>';
            }
        }
        $temp .= '</div></div>';
    } else if ($contenttemplate == 'tbs2') {
        $temp .= '<div class="supercontentdata"><div class="quote">';

        if ($row->post_title != '' and $contenttitle == '1') {
            if ($contentlink == '1') {
                $temp .= '<p class="qquestion"><a href="' . get_permalink($row->ID) . '">' . $row->post_title . '</a></p>';
            } else {
                $temp .= '<p class="qquestion">' . $row->post_title . '</p>';
            }
        }

        if (isset($fimgarr[0]) and $fimgarr[0] != '') {
            $temp .= '<p>';
            if ($contentlink == '1') {
                $temp .= '<a href="' . get_permalink($row->ID) . '"><img class="alignnone" src="' . $fimgarr[0] . '"></a>';
            } else {
                $temp .= '<img class="alignnone" src="' . $fimgarr[0] . '">';
            }
            $temp .= '</p>';
        }

        if ($row->post_excerpt != '') {
            $temp .= '<p class="qans">' . $row->post_excerpt . '</p>';
        }

        $temp .= '</div></div>';
    }

    if ($contentexcerptrm == '1') {
        $temp .= '<a href="' . get_permalink($row->ID) . '" class="super_readmore">Read More</a>';
    }
    return $temp;
}

function get_supercontentdata($row, $settingsarr) {
    if (isset($settingsarr['customtemplate']) and $settingsarr['customtemplate'] != '') {
        ob_start();
        include($settingsarr['customtemplate']);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    extract($settingsarr);
    if ($contenttemplate != '' and $contentoption == '') {
        return get_supercontentdata_template($row, $settingsarr);
    }
    $temp = '';
    if ($contentoption == 'fi') {
        if ($contenttitle == '1') {
            if ($contentlink == '1') {
                $temp .= '<div class="supercaption"><a href="' . get_permalink($row->ID) . '">' . $row->post_title . '</a></div>';
            } else {
                $temp .= '<div class="supercaption">' . $row->post_title . '</div>';
            }
        }

        if ($imageSize == '') {
            $imageSize = 'full';
        }

        $fimgarr = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), $imageSize, true);

        if ($contentlink == '1') {
            $temp .= '<a href="' . get_permalink($row->ID) . '"><img alt="" class="imgslide" src="' . $fimgarr[0] . '" /></a>';
        } else {
            $temp .= '<img alt="" class="imgslide" src="' . $fimgarr[0] . '" />';
        }
    } else {
        if ($contenttitle == '1') {
            if ($contentlink == '1') {
                $temp .= '<div class="supercontenttitle"><a href="' . get_permalink($row->ID) . '">' . $row->post_title . '</a></div>';
            } else {
                $temp .= '<div class="supercontenttitle">' . $row->post_title . '</div>';
            }
        }

        $temp .= '<div class="supercontentdata">' . (($row->post_excerpt != '') ? $row->post_excerpt : $row->post_content) . '</div>';

        if ($contentexcerptrm == '1') {
            $temp .= '<a href="' . get_permalink($row->ID) . '" class="super_readmore">Read More</a>';
        }
    }
    return $temp;
}

function decode_string($encode, $options) {
    $escape = '\\\0..\37';
    $needle = array();
    $replace = array();

    if ($options & JSON_HEX_APOS) {
        $needle[] = "'";
        $replace[] = 'u0027';
    } else {
        $escape .= "'";
    }

    if ($options & JSON_HEX_QUOT) {
        $needle[] = '"';
        $replace[] = 'u0022';
    } else {
        $escape .= '"';
    }

    if ($options & JSON_HEX_AMP) {
        $needle[] = '&';
        $replace[] = 'u0026';
    }

    if ($options & JSON_HEX_TAG) {
        $needle[] = '<';
        $needle[] = '>';
        $replace[] = 'u003C';
        $replace[] = 'u003E';
    }

    //$encode = addcslashes( $encode , $escape );
    $encode = str_replace($replace, $needle, $encode);

    return $encode;
}

function generate_super_checkbox($name, $value, $check) {
    $selected = '';
    if ($check == $value) {
        $selected = ' checked="checked"';
    }
    return '<input type="checkbox" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $selected . ' />';
}

function generate_super_textbox($name, $value = '', $param = '') {
    return '<input type="text" name="' . $name . '" id="' . $name . '" value="' . $value . '" ' . $param . ' />';
}
?>