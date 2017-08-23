<?php
// =============================== Recent Posts Widget ======================================

class TFuse_Recent_Posts extends WP_Widget {

    function TFuse_Recent_Posts() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Recent Posts', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts','tfuse') : $instance['title'], $instance, $this->id_base);
        $number = esc_attr($instance['number']);
        if ($number>0) {} else $number = 8;
    ?>

    <div class="widget-container widget_recent_entries">
        <h3 class="widget-title"><?php echo tfuse_qtranslate($title); ?></h3>
        <ul>
            <?php
            $pop_posts =  tfuse_shortcode_posts(array(
                                'sort' => 'recent',
                                'items' => $number,
                                'image_post' => true,
                                'image_width' => 72,
                                'image_height' => 72,
                                'image_class' => 'thumb'
                            ));

            foreach($pop_posts as $post_val):?>
                <li>
                    <a href="<?php echo $post_val['post_link']; ?>"><?php echo $post_val['post_img']; ?></a>
                    <div class="recent_entry"><a href="<?php echo $post_val['post_link']; ?>" class="link-name"><?php echo $post_val['post_title']; ?></a></div>
                    <div class="recent_entry_short"><?php echo tfuse_shorten_string(strip_shortcodes($post_val['post_content']),11);?></div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>

    <?php
    }

   function update($new_instance, $old_instance) {
       return $new_instance;
   }

   function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(  'title' => '', 'number' => '') );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = esc_attr($instance['number']);
        ?>
       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
       <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>

    <?php
    }
}
    function TFuse_Unregister_WP_Widget_Recent_Posts() {
            unregister_widget('WP_Widget_Recent_Posts');
    }
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Posts');

register_widget('TFuse_Recent_Posts');
