<?php
class TFuse_Widget_Recent_Comments extends WP_Widget {

	function TFuse_Widget_Recent_Comments() {
		$widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments','tfuse' ) );
		$this->WP_Widget('recent-comments', __('TFuse Recent Comments','tfuse'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function recent_comments_style() { ?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		extract($args, EXTR_SKIP);
		$output = '';
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments','tfuse') : $instance['title']);
                $instance['position'] = empty( $instance['position'] ) ? '' : $instance['position'];
		$before_widget = '<div class="widget-container widget_recent_comments">';
		$after_widget = '</div>';
		$before_title = ' <h3 class="widget-title">';
		$after_title = '</h3>';


		if ( ! $number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve' ) );
		$output .= $before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul>';
                
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
                            $avatar = get_avatar( $comment->comment_author_email, 72);
                             
				$output .=  '<li class="recentcomments">' . 
                                                /* translators: comments widget: 1: comment author, 2: post link */
                                                   sprintf(__('%1$s: %2$s', 'widgets'),
                                                   '<a href="'.esc_url( get_comment_link($comment->comment_ID) ).'"><span class="thumb">'. $avatar .'</span></a>'.
                                                   '<span class="recent_comment">
                                                        <a href="'.$comment->comment_author_url.'" class="url">'.get_comment_author_link(), '</a><br/>'.$comment->comment_content.'
                                                    </span><span class="clear"></span>') . 
                                            '</li>';
                                
			}
		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');
                
	
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(  'title' => '','position' => '') );
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:','tfuse'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Recent_Comments() {
	unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Comments');

register_widget('TFuse_Widget_Recent_Comments');
