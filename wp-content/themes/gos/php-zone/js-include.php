<?php
/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	//wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js' );
	wp_enqueue_script( 'cycle2.js', get_template_directory_uri() . '/js/cycle2.js' );
	wp_enqueue_script( 'functions.js', get_template_directory_uri() . '/js/functions.js' );
	wp_enqueue_script( 'jquery.countdown.js', get_template_directory_uri() . '/js/jquery.countdown.js' );
	wp_enqueue_script( 'jquery.prettyphoto.js', get_template_directory_uri() . '/js/jquery.prettyphoto.js' );
	wp_enqueue_script( 'modernizr.js', get_template_directory_uri() . '/js/modernizr.js' );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );