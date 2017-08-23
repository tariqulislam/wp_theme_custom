<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {

        wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.css', false, '') );
        wp_enqueue_style( 'bootstrap' );

        wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Raleway:400,900,800,700,600,500,300,200,100');
        wp_enqueue_style( 'fonts' );
        
        wp_register_style( 'style', get_stylesheet_uri());
        wp_enqueue_style( 'style' );

        wp_register_style( 'animate',  tfuse_get_file_uri('/css/animate.css', false, '') );
        wp_enqueue_style( 'animate' );

        wp_register_style( 'custom_admin',  tfuse_get_file_uri('/css/custom_admin.css', false, '') );
        wp_enqueue_style( 'custom_admin' );

        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'jquery.mmenu',  tfuse_get_file_uri('/css/jquery.mmenu.css', false, '') );
        wp_enqueue_style( 'jquery.mmenu' );
        
        wp_register_style( 'video-js',  tfuse_get_file_uri('/css/video-js.css', true, '') );
        wp_enqueue_style( 'video-js' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );	
        
        wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/libs/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap' ); 
        
        wp_register_script( 'video',  tfuse_get_file_uri('/js/video.js'), array('jquery'), '', true );
        wp_enqueue_script( 'video' );

        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
        
        wp_register_script( 'touchSwipe', tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'touchSwipe' );
        
        wp_register_script( 'isotope',  tfuse_get_file_uri('/js/isotope.pkgd.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'isotope' );
        
        wp_register_script( 'jquery.carouFredSel-6.2.1-packed',  tfuse_get_file_uri('/js/jquery.carouFredSel-6.2.1-packed.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.carouFredSel-6.2.1-packed' );
        
        wp_register_script( 'jquery.easing.1.3.min',  tfuse_get_file_uri('/js/jquery.easing.1.3.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.easing.1.3.min' );
		
        wp_register_script( 'jquery.localscroll-1.2.7-min',  tfuse_get_file_uri('/js/jquery.localscroll-1.2.7-min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.localscroll-1.2.7-min' );
        
        wp_register_script( 'jquery.mmenu.min',  tfuse_get_file_uri('/js/jquery.mmenu.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.mmenu.min' );
		
        wp_register_script( 'jquery.parallax-1.1.3',  tfuse_get_file_uri('/js/jquery.parallax-1.1.3.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.parallax-1.1.3' );
        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
    }
endif;
