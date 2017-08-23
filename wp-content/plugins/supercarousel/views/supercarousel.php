<?php
global $wpdb, $superdbkeys;

$parentpostid = get_queried_object_id();

include(dirname(plugin_dir_path(__FILE__)) . "/supervars.php");

if (!count($superdbkeys)) {
    $superdbkeys = array('source' => '', 'contentoption' => '', 'contentlink' => '0', 'contenttitle' => '0', 'contentexcerptrm' => '0', 'contenttemplate' => '', 'superids' => '', 'visible' => '', 'itemWidth' => '', 'itemHeight' => '', 'mobileVisible' => '1', 'mobileWidth' => '480', 'tabletVisible' => '2', 'tabletWidth' => '768', 'direction' => 'left', 'effect' => 'slide', 'easing' => 'swing', 'easingTime' => '1000', 'step' => '1', 'auto' => '0', 'pauseTime' => '1000', 'pauseOver' => '1', 'autoHeight' => '0', 'slideGap' => '4', 'nextPrev' => '', 'paging' => '', 'circular' => '0', 'mouseWheel' => '0', 'swipe' => '1', 'keys' => '0', 'superrandom' => '', 'smallbut' => '', 'navpadding' => '', 'navstyle' => '', 'customclass' => '', 'autoscroll' => '', 'scrollspeed' => '', 'superhidden' => '', 'mobileItemWidth' => '', 'mobileItemHeight' => '', 'tabletItemWidth' => '', 'tabletItemHeight' => '');
}

$supersettings = stripslashes(get_post_meta($post->ID, 'supersettings', true));
$supersettings = json_decode($supersettings);

$settingsarr = array();

foreach ($superdbkeys as $keyx => $row) {
    $settingsarr[$keyx] = $$keyx = isset($supersettings->$keyx) ? $supersettings->$keyx : '';
}

$rand = rand(111111, 999999);

$my_sourceid = explode(':', $source);

$templatepath = get_stylesheet_directory() . '/supercarousel-' . $post->ID . '.php';
if (file_exists($templatepath)) {
    $settingsarr['customtemplate'] = $templatepath;
}
$numslides = (int) $numslides;
if ((int) $numslides < 1) {
    $numslides = -1;
}

if ($orderby == '') {
    $orderby = 'none';
}

if ($displayorder == '') {
    $displayorder = 'ASC';
}

$cardata = array();
if ($my_sourceid[0] == 'content') {
    $args = array(
        'post_type' => 'supercontent',
        'posts_per_page' => $numslides,
        'tax_query' => array(
            array(
                'taxonomy' => 'super_category',
                'terms' => array(
                    $my_sourceid[1]
                ),
            )
        )
    );

    if ($superrandom == '1') {
        $args['orderby'] = 'rand';
    } else {
        $args['orderby'] = $orderby;
        $args['order'] = $displayorder;
    }

    wp_reset_query();
    $loop = new WP_Query($args);

    foreach ($loop->posts as $row) {
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'latestpost') {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $numslides,
        'post__not_in' => array($parentpostid),
    );

    $args['order'] = 'DESC';

    wp_reset_query();
    $loop = new WP_Query($args);

    foreach ($loop->posts as $row) {
        //$cardata[] = $row->post_content;
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'popularpost') {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $numslides,
        'post__not_in' => array($parentpostid),
    );

    $args['orderby'] = 'comment_count';

    wp_reset_query();
    $loop = new WP_Query($args);

    foreach ($loop->posts as $row) {
        //$cardata[] = $row->post_content;
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'category') {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $numslides,
        'post__not_in' => array($parentpostid),
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'terms' => array(
                    $my_sourceid[1]
                ),
            )
        )
    );

    if ($superrandom == '1') {
        $args['orderby'] = 'rand';
    } else {
        $args['orderby'] = $orderby;
        $args['order'] = $displayorder;
    }

    wp_reset_query();
    $loop = new WP_Query($args);

    foreach ($loop->posts as $row) {
        //$cardata[] = $row->post_content;
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'custom_post_type') {
    $args = array(
        'posts_per_page' => $numslides,
        'post__not_in' => array($parentpostid),
    );

    if (isset($my_sourceid[1]) and $my_sourceid[1] != '') {
        $args['post_type'] = $my_sourceid[1];
    }

    if ((isset($my_sourceid[2]) and $my_sourceid[2] != '') and isset($my_sourceid[3]) and $my_sourceid[3] != '') {
        $args['tax_query'] = array(array());
        $args['tax_query'][0]['taxonomy'] = $my_sourceid[2];
        $args['tax_query'][0]['terms'] = $my_sourceid[3];
    }

    if ($superrandom == '1') {
        $args['orderby'] = 'rand';
    } else {
        $args['orderby'] = $orderby;
        $args['order'] = $displayorder;
    }

    wp_reset_query();
    $loop = new WP_Query($args);

    foreach ($loop->posts as $row) {
        //$cardata[] = $row->post_content;
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'tag') {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $numslides,
        'post__not_in' => array($parentpostid),
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'terms' => array(
                    $my_sourceid[1]
                ),
            )
        )
    );

    if ($superrandom == '1') {
        $args['orderby'] = 'rand';
    } else {
        $args['orderby'] = $orderby;
        $args['order'] = $displayorder;
    }

    wp_reset_query();
    $loop = new WP_Query($args);

    foreach ($loop->posts as $row) {
        //$cardata[] = $row->post_content;
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'custom') {
    $superids = str_replace(' ', '', $superids);

    $superids = str_replace(array(",$parentpostid", "$parentpostid,", ",$parentpostid", ",$parentpostid,"), '', $superids);

    $superidsarr = explode(',', $superids);

    $args = array(
        'post_type' => array('post', 'page'),
        'posts_per_page' => $numslides,
        'post__in' => $superidsarr,
        'post__not_in' => array($parentpostid)
    );

    if ($superrandom == '1') {
        $args['orderby'] = 'rand';
    } else {
        $args['orderby'] = $orderby;
        $args['order'] = $displayorder;
    }

    wp_reset_query();
    $loop = new WP_Query($args);

    //supershow($loop);
    //exit;
    foreach ($loop->posts as $row) {
        //$cardata[] = $row->post_content;
        $cardata[] = get_supercontentdata($row, $settingsarr);
    }
} else if ($my_sourceid[0] == 'image') {

    $post = get_post($my_sourceid[1]);
    $images = stripslashes(get_post_meta($post->ID, 'images', true));

    $images = json_decode($images);

    if ($imageSize == '') {
        $imageSize = 'full';
    }

    //supershow($images);

    if (isset($images->image)) {
        foreach ($images->image as $i => $row) {
            $temp = '';
            if ($images->caption[$i] != '' and $caption != 'disable') {
                $temp .= '<div class="supercaption"><div class="captiondata">' . stripslashes(urldecode($images->caption[$i])) . '</div></div>';
            }

            if ($images->id[$i] != '') {
                $image_attributes = wp_get_attachment_image_src($images->id[$i], $imageSize);
                $images->image[$i] = $image_attributes[0];
            }

            $temp .= '<img class="imgslide" src="' . $images->image[$i] . '" alt="' . esc_attr(urldecode($images->caption[$i])) . '" />';

            if ($images->lightboxurl[$i] != '') {
                $datatype = '';
                if (strpos(strtolower($images->lightboxurl[$i]), 'youtube') > 0) {
                    $datatype = 'youtube';
                }
                if (strpos(strtolower($images->lightboxurl[$i]), 'vimeo') > 0) {
                    $datatype = 'vimeo';
                }
                $temp = '<a href="' . $images->lightboxurl[$i] . '" data-src="' . $images->lightboxurl[$i] . '" class="blk superlight"' . (($images->caption[$i] != '') ? ' data-sub-html="' . esc_attr(stripslashes(urldecode($images->caption[$i]))) . '" title="' . stripslashes(urldecode($images->caption[$i])) . '"' : '') . '>' . $temp . '</a>';
            } else if ($images->linkurl[$i] != '') {
                $temp = '<a href="' . $images->linkurl[$i] . '" target="' . (($images->target[$i]=='_new') ? '_blank' : $images->target[$i]) . '"' . (($images->target[$i]=='_new' or $images->target[$i]=='_blank') ? ' rel="nofollow"' : '') . '>' . $temp . '</a>';
            }
            $cardata[] = $temp;
        }
    }

    if ($superrandom == '1') {
        shuffle($cardata);
    }
}
?>
<script>
    jQuery(document).ready(function () {
        var opt = {};
<?php
foreach ($superdbkeys as $keyx => $val) {
    if (isset($$keyx)) {
        if (is_numeric($$keyx)) {
            echo "opt['$keyx'] = " . $$keyx . ";";
        } else {
            echo "opt['$keyx'] = '" . $$keyx . "';";
        }
    }
}
if ($nextPrev == '1') {
    echo "opt['next'] = '#next$rand';";
    echo "opt['prev'] = '#prev$rand';";
}

if ($paging == '1') {
    echo "opt['paging'] = '#pag$rand';";
}

if ($my_sourceid[0] == 'image' or $contentoption == 'fi') {
    echo "opt['type'] = 'image';";
} else {
    echo "opt['type'] = 'content';";
}
?>
        if (jQuery("#supercarousel<?php echo $rand; ?>").find(">div").length == 0) {
            jQuery("#supercrsl<?php echo $rand; ?>").hide();
            return;
        }
        //jQuery().framerate();
        jQuery.fx.interval = 1;
        var scarousel<?php echo $rand; ?> = jQuery("#supercarousel<?php echo $rand; ?>").supercarousel(opt);
    });
</script>
<?php
$supercarouselclassarr = array();
if ($effect == 'focus') {
    $supercarouselclassarr[] = "focuscarousel";
}

if ($caption != 'disable' and $caption != '') {
    $supercarouselclassarr[] = "supercaption{$caption}";
}

if ($slideHover != 'disable' and $slideHover != '') {
    $supercarouselclassarr[] = "superslide{$slideHover}";
}

$supercarouselclass = '';

if (count($supercarouselclassarr) > 0) {
    $supercarouselclass = ' ' . join(' ', $supercarouselclassarr);
}
?>
<div id="supercrsl<?php echo $rand; ?>" class="supercrsl<?php echo ($navpadding == '1') ? ' pdgwnav' : ''; ?>">
    <div class="supercarousel<?php echo $supercarouselclass; ?>" id="supercarousel<?php echo $rand; ?>">
        <?php
        foreach ($cardata as $row) {
            ?>
            <div>
                <?php echo do_shortcode($row); ?>
            </div>
            <?php
        }
        ?>
    </div><div class="clear"></div>
    <?php
    if ($nextPrev == '1') {
        ?>
        <a class="prev<?php echo ($smallbut == '1') ? ' small' : ''; ?> superprev<?php echo ($navstyle != '') ? ' ' . $navstyle : ''; ?><?php echo ($customclass != '') ? " $customclass" : ""; ?>" id="prev<?php echo $rand; ?>" href="#"><span>prev</span></a>
        <a class="next<?php echo ($smallbut == '1') ? ' small' : ''; ?> supernext<?php echo ($navstyle != '') ? ' ' . $navstyle : ''; ?><?php echo ($customclass != '') ? " $customclass" : ""; ?>" id="next<?php echo $rand; ?>" href="#"><span>next</span></a>
        <?php
    }
    ?>
    <div class="pagination" id="pag<?php echo $rand; ?>"></div>
</div>