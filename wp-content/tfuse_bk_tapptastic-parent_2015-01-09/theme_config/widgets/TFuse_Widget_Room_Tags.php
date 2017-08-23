<?php

// =============================== Search widget ======================================

class TFuse_Widget_Room_Tags extends WP_Widget {

	function TFuse_Widget_Room_Tags() {
            $widget_ops = array('classname' => 'widget_room_tags', 'description' => __( "Will be shown just in room post","tfuse") );
            $this->WP_Widget('room_tags', __('TFuse Room_Tags','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
            extract($args); global $post;
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( '','tfuse' ) : $instance['title'], $instance, $this->id_base);
	    $tags = wp_get_post_terms($post->ID,'tags');
            
            if(!empty($tags))
            { ?>
                <div class="amenities-list">
                    <h3><?php echo $title;?></h3>
                    <ul>
                        <?php foreach($tags as $tag):?>
                            <li>
                                <img src="<?php echo TF_GET_IMAGE::get_src_link(tfuse_options('tag_icon','',$tag->term_id),39,39);;?>" alt="" /> 
                                <strong><?php echo $tag->name;?></strong> 
                                <span><?php echo $tag->description;?></span>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
          <?php  }
        }

	function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
            $instance['title'] = $new_instance['title'];
            return $instance;
	}

	function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
            $title = $instance['title'];
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
	}
}


register_widget('TFuse_Widget_Room_Tags');
