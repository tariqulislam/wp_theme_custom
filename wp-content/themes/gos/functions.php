<?php
require_once(dirname(__FILE__).'/php-zone/customization.php'); 
require_once(dirname(__FILE__).'/php-zone/js-include.php'); 
require_once(dirname(__FILE__).'/shortcode/main-top-slider.php'); 
require_once(dirname(__FILE__).'/shortcode/player-slider.php'); 
require_once(dirname(__FILE__).'/shortcode/news-display.php'); 

function register_my_menu() {
  register_nav_menu('menus',__( 'Main Menu' ));
}
add_action( 'init', 'register_my_menu' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since GOS 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function GOS_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	}
	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'gos' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'GOS_wp_title', 10, 2 );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails', array( 'post', 'page', 'players', 'teams', 'matches' ) );
// Add it for posts

/**
 * Register three GOS widget areas.
 *
 * @since GOS 1.0
 */
function gos_widgets_init() {
	require get_template_directory() . '/widgets/widgets-posts.php';
	require get_template_directory() . '/widgets/widgets-gallery.php';
	register_widget( 'GOS_Widget_Posts' );
	register_widget( 'GOS_Widget_Gallery' );

	register_sidebar( array(
		'name'          => __( 'Left Widget Area', 'gos' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears on the left section of the site.', 'gos' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<header class="pix-heading-title"><h2 class="pix-section-title heading-color">',
		'after_title'   => '</h2></header>',
	) );
}
add_action( 'widgets_init', 'gos_widgets_init' );