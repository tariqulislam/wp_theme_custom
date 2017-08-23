<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage GOS
 * @since GOS 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper wrapper_boxed" id="wrappermain-pix">
		<!-- Header Start -->
		<header id="header">
            <!-- Top Head Start -->
            <div class="top-head">
            	<div class="container">
                    <!-- Logo -->
                    <?php GOS_Customize::logo(); ?>
                	<!-- Logo Close -->
                    <div class="rightheader">
                    	<div class="widget widget_text">
                    		<div class="textwidget">
                    			<div class="ads-banner">
                    				<div class="top_banner">
                    					<a target="_blank" href="http://themeforest.net/item/soccer-club-sports-and-events-news-theme/7219278?ref=PixFill"><img alt="Header Banner" src="http://pixfill.com/wp-themes/kingsclub/wp-content/themes/kingclub-theme/images/px-image1.png"></a>
                    				</div>
                    			</div>
                    		</div>
						</div>
					</div>
                </div>
            </div>
            <!-- Top Head End -->
            <div id="mainheader">
                <div class="container">
                    <!-- Right Header -->
                	<?php
						$defaults = array(
							'container'       => 'nav',
							'container_class' => 'navigation',
						);
						wp_nav_menu( $defaults );
						get_search_form();
					?>
                </div>
            </div>
        </header>
        <div class="clearfix"></div>
        <div id="main">
            <div id="innermain">
                <div id="carouselarea">
                    <div class="container">
                    	<?php get_template_part( 'templates/carousel', 'match' ); ?>
                    </div>
                </div>
                <div class="container">