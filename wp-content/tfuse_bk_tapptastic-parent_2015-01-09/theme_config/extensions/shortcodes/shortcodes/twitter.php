<?php

/**
 * Twitter
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * items: 5
 * username:
 * title:
 * post_date:
 */

function tfuse_twitter($atts, $content = null)
{
    extract(shortcode_atts(array(
            'username' => '',
            'title' => ''
    ), $atts));
    
    $return_html = '';
    
   if ( !empty($username) )
    {
        $tweets = tfuse_get_tweets($username,1);
        if(!sizeof($tweets)) return;
        
        foreach ( $tweets as $tweet )
        {
            $return_html .= '<div class="inner"><div class="widget-text about-us twitter">
                                <div class="inner">
                                    <h3 class="widget-title">'.$title.'</h3>
                                    <p><span class="blue-text">@'.$username.': </span>'.$tweet->text. '</p>';
                                    $return_html .= '<a class="btn btn-dark btn-transparent btn-small" href="https://twitter.com/'.$username.'">'.__('Follow us','tfuse').'</a>';
            $return_html .= '</div>
                    </div></div>';
        }        
    }

    return $return_html;
}

$atts = array(
    'name' => __('Twitter','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_twitter_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Username','tfuse'),
            'desc' => __('Twitter username','tfuse'),
            'id' => 'tf_shc_twitter_username',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('twitter', 'tfuse_twitter', $atts);
