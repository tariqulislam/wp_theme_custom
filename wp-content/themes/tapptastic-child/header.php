<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js" <?php language_attributes(); ?> style="margin-top:0 !important"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php
    if(tfuse_options('disable_tfuse_seo_tab')) {
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
    } else
        wp_title('');?>
    </title>
    <?php tfuse_meta(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php
        global $is_tf_blog_page;
        if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );

        tfuse_head();
        wp_head();
    ?>
    <?php tfuse_main_header(); ?>
</head>
<body <?php body_class();?>>

    <div id="page" class="hfeed site">
        <?php  tfuse_menu('default');  ?>
        <div class="menu-button">
            <a href="#menu" class="clearfix">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-text"><?php _e('Menu','tfuse');?></span>
            </a>
        </div>

        <div class="custom-menu-clone"></div>
        <div class="custom-menu">
            <div class="container pad-top-11">
                <div class="header-logo pull-left">
                <?php
                    $logo_upload = tfuse_options('logo');
                    if(!empty($logo_upload)) {  ?>
                          <a href="<?= home_url(); ?>"><img src="<?= $logo_upload; ?>"  border="0" /></a>
                <?php } ?>
                </div>
                <div class="header-menu pull-right">
                    <?php  tfuse_menu('custom');  ?>
                </div>                
            </div>
        </div>

<?php if($is_tf_blog_page) tfuse_category_on_blog_page();?>