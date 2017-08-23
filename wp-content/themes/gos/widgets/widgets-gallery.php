<?php

/**
 * Custom Widget for displaying specific post_type's
 *
 *
 * @package WordPress
 * @subpackage GOS
 * @since GOS 1.0
 */

class GOS_Widget_Gallery extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since GOS 1.0
	 *
	 * @return GOS_Widget_Posts
	 */
	public function __construct() {
		$this->types = get_post_types();
		parent::__construct( 'widget_gos_gallery', __( 'GOS Gallery Display', 'gos' ), array(
			'classname'   => 'widget_gos_gallery',
			'description' => __( 'Use this widget to list the media.', 'gos' ),
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since GOS 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );

		$media = get_posts(array(
								    'post_type'   => 'attachment',
								    'numberposts' => 20,
								    'post_status' => null,
								    'post_parent' => null, // any parent
								    'order'		  => 'DESC',
									'orderby'     => 'post_date',
							    ));

		if ($media) {
			echo $args['before_widget'].$args['before_title'].$title.$args['after_title'].'<div class="gallery lightbox"><ul>';
		    foreach ($media as $post) {
		        setup_postdata($post);
		        $img_nail = wp_get_attachment_image_src($post->ID, 'thumbnail');
				?>
				<li>
                	<figure>
                    	<img alt="" data-alt="<?php the_title(); ?>" src="<?=$img_nail[0]?>">
                    	<figcaption>
		                    <a target="_self" href="<?=wp_get_attachment_url($post->ID);?>" rel="prettyPhoto[gallery]">
		                        <i class="fa fa-plus"></i>
		                    </a> 
                      </figcaption>
                    </figure>
                </li>
	<?php 	}
			echo '</ul></div>'.$args['after_widget'];?>			
		<?php
		}
		// Reset the post globals as this query will have stomped on it.
		wp_reset_postdata();
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since GOS 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );
		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since GOS 1.0
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'gos' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
		<?php
	}
}
