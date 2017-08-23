<?php
class TFuse_Widget_Contact extends WP_Widget
{

    function TFuse_Widget_Contact()
    {
        $widget_ops = array('classname' => 'widget_contact', 'description' => __( 'Add Contact in Sidebar','tfuse') );
        $this->WP_Widget('contact', __('TFuse Contact Widgets','tfuse'), $widget_ops);
    }

    function widget( $args, $instance )
    {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $before_widget = '<div class="widget-container widget_contact">';
        $after_widget = '</div>';
        $before_title = '<h3 class="widget-title">';
        $after_title = '</h3>';
        $tfuse_title = (!empty($title)) ? $before_title .tfuse_qtranslate($title) .$after_title : '';

        echo $before_widget;

        // echo widgets title
        echo $tfuse_title;
        if ( $instance['adress'] != '')
        {
                 echo'   <address>
                            <strong>'.tfuse_qtranslate($instance['name']).'</strong><br>
                            '.tfuse_qtranslate($instance['adress']).'
                        </address>';
        }
        echo '<div class="contact_info">
                        <h3>'.__('Contact Information','tfuse').':</h3>';
        
        if ( $instance['phone'] != '')
        {
            echo '<div class="info_row"><span class="info_icon info_phone"></span>'.tfuse_qtranslate($instance['phone']).
                '</div>';
        }
        if ( $instance['fax'] != '')
        {
            echo '<div class="info_row"><span class="info_icon info_fax"></span>'.tfuse_qtranslate($instance['fax']).
                '</div>';
        }
        
        if ( $instance['email_1'] != '')
        {
           echo '<div class="info_row"><span class="info_icon info_mail"></span>
                    '.'<a href="mailto:'.$instance['email_1'].'">'.tfuse_qtranslate($instance['email_1']).'</a>'.'
                </div>';
        }
        
        if ( $instance['facebook'] != '')
        {
            echo '<div class="info_row"><span class="info_icon info_fb"></span><a href="http://'.tfuse_qtranslate($instance['facebook']).'" target="_blank">'.tfuse_qtranslate($instance['facebook']).'</a>
                </div>';
        }
        if ( $instance['twitter'] != '')
        {
            echo '<div class="info_row"><span class="info_icon info_tw"></span><a href="http://'.tfuse_qtranslate($instance['twitter']).'" target="_blank">'.tfuse_qtranslate($instance['twitter']).'</a>
                </div>';
        }
        
        echo '</div>';

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'email_1' => '','name' => '','adress' => '','phone' => '', 'fax' => '','facebook' => '', 'twitter' => '') );

        $instance['title']      = $new_instance['title'];
        $instance['phone']      = $new_instance['phone'];
       $instance['fax']      = $new_instance['fax'];
        $instance['email_1']      = $new_instance['email_1'];
        $instance['name']      = $new_instance['name'];
        $instance['adress']      = $new_instance['adress'];
        $instance['facebook']      = $new_instance['facebook'];
        $instance['twitter']      = $new_instance['twitter'];

        return $instance;
    }

    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'email_1' => '','name' => '','adress' => '','phone' => '','fax'=>'','facebook' => '','twitter'=>'') );
        $title = $instance['title'];
?>
   
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
     <p>
        <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo  esc_attr($instance['name']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('adress'); ?>"><?php _e('Adress:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('adress'); ?>" name="<?php echo $this->get_field_name('adress'); ?>" type="text" value="<?php echo esc_attr($instance['adress']); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:','tfuse'); ?></label><br/>
       <input class="widefat " id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo  esc_attr($instance['fax']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('email_1'); ?>"><?php _e('Email:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('email_1'); ?>" name="<?php echo $this->get_field_name('email_1'); ?>" type="text" value="<?php echo  esc_attr($instance['email_1']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo  esc_attr($instance['facebook']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo  esc_attr($instance['twitter']); ?>"  />
    </p>
    
    <?php
    }
}
register_widget('TFuse_Widget_Contact');
