<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    'tabs' => array(
        array(
            'name' => __('General','tfuse'),
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                
                array(
                    'name' => __('General Settings','tfuse'),
                    'options' => array(/* 1 */
                        array(
                            'name' => __('Logo Type','tfuse'),
                            'desc' => __('Select logo type','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_type',
                            'value' => 'text',
                            'options' => array('text' => __('Text logo','tfuse'), 'img' => __('Image logo','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Logo Option
                        array(
                            'name' => __('Custom Logo','tfuse'),
                            'desc' => __('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload'
                        ),
                        array(
                            'name' => __('Logo Title','tfuse'),
                            'desc' => __('Enter your logo title','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text',
                            'value' => 'TAPPTASTIC',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Categories Logo Subtitle','tfuse'),
                            'desc' => __('Enter your categories logo subtitle','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text_sub_cat',
                            'value' => 'The Blog',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Gallery Logo SubTitle','tfuse'),
                            'desc' => __('Enter your gallery logo subtitle','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text_sub_gal',
                            'value' => 'Gallery',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Custom Favicon Option
                        array(
                            'name' => __('Custom Favicon','tfuse').' <br /> (16px x 16px)',
                            'desc' =>  __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Header Background','tfuse'),
                            'desc' => __('Upload default header background','tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_bg',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                      
                         // Change default avatar
                        array(
                            'name' => __('Default Avatar','tfuse'),
                            'desc' => __('For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their e-mail address.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_avatar',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Tracking Code Option
                        array(
                            'name' => __('Tracking Code','tfuse'),
                            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => __('Custom CSS','tfuse'),
                            'desc' => __('Quickly add some CSS to your theme by adding it to this block.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                
                array(
                    'name' => __('Archive Page Settings','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_archive_content_top',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_archive_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
                
                
                array(
                    'name' => __('Search Page Settings','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_s_content_top',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_s_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
                
                array(
                    'name' => __('Twitter','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Consumer Key','tfuse'),
                            'desc' => __('Set your' ,'tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter' ,'tfuse').'</a> '.__('application' ,'tfuse').' <a href="http://screencast.com/t/yb44HiF2NZ">'.__('consumer key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Consumer Secret','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a> '.__('application','tfuse').' <a href="http://screencast.com/t/eaKJHG1omN">'.__('consumer secret key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Token','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a> '.__('application','tfuse').' <a href="http://screencast.com/t/QEEG2O4H">'.__('access token key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Secret','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a>  '.__('application','tfuse').' <a href="http://screencast.com/t/Yv7nwRGsz">'.__('access token secret key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('RSS','tfuse'),
                    'options' => array(
                        // RSS URL Option
                        array('name' => __('RSS URL','tfuse'),
                            'desc' => __('Enter your preferred RSS URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => __('E-Mail URL','tfuse'),
                            'desc' => __('Enter your preferred E-mail subscription URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text',
                        ),
                    )
                ),
                array(
                    'name' => __('Enable Theme settings','tfuse'),
                    'options' => array(
                        // Disable preloadCssImages plugin
                        array('name' => __('preloadCssImages','tfuse'),
                            'desc' => __('Enable jQuery-Plugin "preloadCssImages"? This plugin loads automatic all images from css.If you prefer performance(less requests) deactivate this plugin.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_preload_css',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Disable SEO
                        array('name' => __('SEO Tab','tfuse'),
                            'desc' => __('Enable SEO option?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_tfuse_seo_tab',
                            'value' => true,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Enable Dynamic Image Resizer Option
                        array('name' => __('Dynamic Image Resizer','tfuse'),
                            'desc' => __('This will Enable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => __('Image from content','tfuse'),
                            'desc' => __('If no thumbnail is specified then the first uploaded image in the post is used.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_content_img',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => __('Remove Wordpress Versions','tfuse'),
                            'desc' => __('Remove Wordpress versions from the source code, for security reasons.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => TRUE,
                            'type' => 'checkbox'
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Homepage','tfuse'),
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => __('Homepage Population','tfuse'),
                    'options' => array(
                        array('name' => __('Homepage Population','tfuse'),
                            'desc' => __(' Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from ','tfuse').'<a target="_blank" href="' . network_admin_url('options-reading.php') . '">'.__('here','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse'),'page' =>__('From Specific Page','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on homepage','tfuse'),
                            'desc' => __('Pick one or more 
                            categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        // page on homepage
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' =>tfuse_list_page_options(),
                            'type' => 'select',
                        )
                    )
                ),
                array(
                    'name' => __('Homepage','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Blog','tfuse'),
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => __('Blog Page Population','tfuse'),
                    'options' => array(
                        // Select the Blog Page
                        array('name' => __('Select Blog Page','tfuse'),
                            'desc' => __('Select the blog page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Blog Page Population','tfuse'),
                            'desc' => __(' Select which categories to display on blogpage. More over you can choose to load a specific page or change the number of posts on the blogpage from ','tfuse').'<a target="_blank" href="' . network_admin_url('options-reading.php') . '">'.__('here','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on blogpage','tfuse'),
                            'desc' => __('Pick one or more
                            categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Shortcodes','tfuse'),
                    'options' => array(
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Posts','tfuse'),
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => __('Default Post Options','tfuse'),
                    'options' => array(
                        // Post Content
                        array('name' => __('Post Content', 'tfuse'),
                            'desc' => __('Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).','tfuse'),
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => __('The Excerpt','tfuse'), 'content' => __('Full Content','tfuse')),
                            'type' => 'select'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Footer','tfuse'),
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                
                array(
                    'name' => __('Footer Content','tfuse'),
                    'options' => array(

                        array('name' => __('Enable Socials','tfuse'),
                            'desc' => __('Enable Footer Socials','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_socials',
                            'value' => true,
                            'type' => 'checkbox'
                        ),
                        array('name' => __('Facebook','tfuse'),
                            'desc' => __('Facebook Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_facebook',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Twitter','tfuse'),
                            'desc' => __('Twitter Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_twitter',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Vimeo','tfuse'),
                            'desc' => __('Vimeo Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_vimeo',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array('name' => __('Copyright','tfuse'),
                            'desc' => __('Change  bottom Copyright','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_copyright',
                            'value' => '',
                            'type' => 'text'
                        ),
                    )
                )
            )
        )
    )
);

?>