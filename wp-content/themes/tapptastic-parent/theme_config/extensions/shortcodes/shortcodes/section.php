<?php
function tfuse_section($atts, $content = null) {
    
    extract(shortcode_atts(array('bg' => '','img' => '' ,'effect' => ''), $atts));
    
    $uniq = rand(1,1000);
    
    $output = '';
    
    switch($bg)
    {
        case 'dark' : $back = 'row-bg-dark'; break;
        case 'light' : $back = 'row-bg-light'; break;
        case 'gray' : $back = 'row-bg-gray'; break;
        case 'img' : 
            $default_image = tfuse_options('default_bg');
            
            if(!empty($img)) $back = 'style="background-image: url('.$img.');"';
            elseif(!empty($default_image))
                $back = 'style="background-image: url('.$default_image.');"';
            else
                $img = $back = 'style="background: #131619 url('.get_template_directory_uri().'/images/pattern.png'.');"';
            
            break;
        default : $back = ''; break;
    }
    
    if($bg == 'img')
    {
        if($effect == 'parallax')
        {
            $parallax = 'widget-area offer-section parallax-area';
            $id_parallax = 'id="parallax'.$uniq.'"';
            $start_parallax = '
                jQuery(window).resize(function() {
                    jQuery(\'#parallax'.$uniq.'\').parallax(\'100%\', 0.1);
                });
                jQuery(\'#parallax'.$uniq.'\').parallax(\'100%\', 0.1);
            ';
        }
        else 
            $parallax = $id_parallax = $start_parallax = '';
        
        
        $output .=  '
            <div class="spinner">
                <div class="wBall" id="wBall_1">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_2">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_3">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_4">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_5">
                    <div class="wInnerBall">
                    </div>
                </div>
            </div>
            <section class="main-header '.$parallax.'" '.$back.'  '.$id_parallax.'>
                <div class="main-header-inner">';
            $output .= do_shortcode($content);
        $output .= '
                </div>
            </section>';
        
        $output .= "
            <script>
                jQuery(function($) {
                
                ".$start_parallax."
                
                var first = jQuery('#main section:first');
                
                if(first.hasClass('main-header'))
                    first.addClass('first_section')

                jQuery('.main-header').prepend('<img src=\"".$img."\"  class=\"testimage".$uniq." hidden\">');
                jQuery('.spinner').css('top', jQuery('.main-header').height()/2-16);
                
                jQuery('.testimage".$uniq."').on('load',function(){
                    jQuery('.spinner, .testimage".$uniq."').remove();
                    jQuery('.main-header, .menu-button').removeClass('invisible').addClass('animated fadeIn');
                    setTimeout(function(){
                        jQuery('.header-title,.header-search').removeClass('invisible').addClass('animated fadeInLeft');
                        jQuery('.main-header .btn, .main-header .header-search').removeClass('invisible').addClass('animated fadeInRight');
                        jQuery('.header-logo').removeClass('invisible').addClass('animated fadeInDown');
                    }, 200);
                    setTimeout(function(){
                        jQuery('.header-title, .main-header .btn, .header-logo,.main-header').removeClass('animated fadeInLeft fadeIn fadeInRight fadeInDown');
                    }, 1200);
                });
            });
            </script>";
    }
    else 
    {
        $output .=  '<section class="main-row '.$back.'">
                <div class="container">';
            $output .= do_shortcode($content);
        $output .= '</div><div class="clear"></div></section>';
    }
        
    
    

    
    return $output;
}

$atts = array(
    'name' => __('Section', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_bg',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'gray' => __('Gray Background','tfuse'),'light' => __('Light Background','tfuse'),'dark' => __('Dark Background','tfuse'),
                                'img' => __('Image Background','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Effect', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_effect',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'parallax' => __('Parallax','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Image', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_img',
            'value' => '',
            'type' => 'text',
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_content',
            'value' => '',
            'type' => 'textarea',
        ),

    )
);

tf_add_shortcode('section', 'tfuse_section', $atts);