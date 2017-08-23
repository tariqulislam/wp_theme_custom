<?php 

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class GOS_Customize {
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since MyTheme 1.0
    */
  public static function register ( $wp_customize ) {

    $wp_customize->add_section('logo_scheme', array(
        'title'    => __('Set Logo', 'themename'),
        'priority' => 120,
    ));
    //  =============================
    //  = Logo Image Upload         =
    //  =============================
    $wp_customize->add_setting('logo_options[logo_image]', array(
        'capability' => 'edit_theme_options'
    )); 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_options[logo_image]', array(
        'label'    => __('Upload logo', 'themename'),
        'section'  => 'logo_scheme',
        'settings' => 'logo_options[logo_image]'
    )));
    //  =============================
    //  = Logo URL Input            =
    //  =============================
    $wp_customize->add_setting('logo_options[logo_url]', array(
        'default'    => home_url(),
        'capability' => 'edit_theme_options' 
    )); 
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'logo_options[logo_url]', array(
        'label'          => __( 'Add Logo URL', 'theme_name' ),
        'section'        => 'logo_scheme',
        'settings'       => 'logo_options[logo_url]',
        'type'           => 'text'
    )));
      
    $wp_customize->add_section('site_background_scheme', array(
        'title'    => __('Set Site Background', 'themename'),
        'priority' => 130,
    ));
    //  =============================
    //  = Background Image          =
    //  =============================
    $wp_customize->add_setting('background_options[img_url]', array(
        'capability' => 'edit_theme_options'
    )); 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'background_options[img_url]', array(
        'label'    => __('Set Background Image', 'themename'),
        'section'  => 'site_background_scheme',
        'settings' => 'background_options[img_url]'
    )));
    //  =============================
    //  = Background Repeat         =
    //  =============================
    $wp_customize->add_setting('background_options[repeat]', array(
        'default'    => 'no-repeat',
        'capability' => 'edit_theme_options' 
    )); 
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'background_options[repeat]', array(
        'label'    => __( 'Set Background Repeat', 'theme_name' ),
        'section'  => 'site_background_scheme',
        'settings' => 'background_options[repeat]',
        'type'     => 'select',
        'choices'  => array(
            'repeat'    => __( 'repeat' ),
            'no-repeat' => __( 'no-repeat' ),
            'repeat-x'  => __( 'repeat-x' ),
            'repeat-y'  => __( 'repeat-y' ),
            'initial'   => __( 'initial' ),
            'unset'     => __( 'unset' ),
            'inherit'   => __( 'inherit' )
        )
    )));
    //  =============================
    //  = Background Color            =
    //  =============================
    $wp_customize->add_setting('background_options[color]', array(
        'default'    => '#ffffff',
        'capability' => 'edit_theme_options' 
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'background_options[color]', array(
        'label'    => __( 'Set Background Color', 'theme_name' ),
        'section'  => 'site_background_scheme',
        'settings' => 'background_options[color]'
    )));
  }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since GOS 1.0
    */
  public static function header_background_options() {
    $bg_options = get_theme_mod( 'background_options' );
 
    $return = '';
    if ( ! empty( $bg_options ) ) {    
      $return = 'body { background: ';
      foreach ($bg_options as $key => $value) {
        if(!empty($value)){
          if($key == 'img_url'){
            $return .= sprintf(' url(%s) ',$value );
          } else {
            $return .= sprintf(' %s ',$value );          
          }
        }
      }
      $return .= ' fixed;}'; 
    }
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
      <?= $return; ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
  }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since GOS 1.0
    */
  public static function logo() {
    $logo = get_theme_mod( 'logo_options' );
    ?>
    <div class="logo">          
      <a href="<?= $logo['logo_url'];?>">
        <img alt="<?= get_bloginfo('name');?>" src="<?= $logo['logo_image'];?>">
      </a>
    </div>
    <?php
  }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'GOS_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'GOS_Customize' , 'header_background_options' ) );