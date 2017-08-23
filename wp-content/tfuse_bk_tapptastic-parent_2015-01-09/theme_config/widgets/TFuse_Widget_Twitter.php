<?php
class TFuse_Widget_Twitter extends WP_Widget {

    function TFuse_Widget_Twitter()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display tweets","tfuse"));
        $this->WP_Widget('twitter', __('TFuse - Twitter','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title',  empty($instance['title']) ? __('','tfuse') : $instance['title'], $instance, $this->id_base);
        $username = apply_filters( 'widget_items', $instance['username'], $instance, $this->id_base);
        $items = apply_filters( 'widget_items', $instance['items'], $instance, $this->id_base);
        $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
        $return_html = '';

        if ( !empty($username) )
            {
                $tweets = tfuse_get_tweets($username,$items);

                    $return_html .= '<div class="widget-container widget_twitter">';

                        $return_html .= '<h3 class="widget-title">' . $title . '</h3>
                            <div class="tweet_list">';

                    foreach ( $tweets as $tweet )
                    {
                        $return_html .= '<div class="tweet_item clearfix">';
                        $return_html .'<div class="tweet_image">
                                            <img src="'.$tweet->user->profile_image_url.'" width="30" height="30" alt="" />
                                    </div>';
                        if( isset($tweet->text) )
                        {
                            $return_html .= '<div class="tweet_text">
                                                <div class="inner">
                                                    '.$tweet->text.'
                                                    <span class="tweet_time">'.$tweet->created_at.'</span>
                                            </div></div>' ;
                        }
                        $return_html .= '</div>';
                    }

                    $return_html .= '</div></div>';
            }
                

            echo $return_html;
    }
    function update($new_instance, $old_instance)
    { $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['username'] = $new_instance['username'];
        $instance['items'] = $new_instance['items'];
        if ( in_array( $new_instance['position'], array( 'sidebar', 'footer') ) ) 
		{
                    $instance['position'] = $new_instance['position'];
                } 
                        else 
                        {
                    $instance['position'] = 'sidebar';
                }
        return $instance;

    } // End function update

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '','username' => '','items' => '','position' => '') );
        $title = $instance['title'];
        $username = $instance['username'];
        $items = $instance['items'];
        @$position = esc_attr( $instance['position'] );

        ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
         <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
         <p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></p>
        <?php
       }

}
register_widget('TFuse_Widget_Twitter'); ?>
