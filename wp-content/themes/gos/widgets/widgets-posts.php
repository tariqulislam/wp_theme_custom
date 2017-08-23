<?php

/**
 * Custom Widget for displaying specific post_type's
 *
 *
 * @package WordPress
 * @subpackage GOS
 * @since GOS 1.0
 */

class GOS_Widget_Posts extends WP_Widget {


	/**
	 * The supported post types.
	 *
	 * @access private
	 * @since GOS 1.0
	 *
	 * @var array
	 */
	private $types = array( );

	/**
	 * Constructor.
	 *
	 * @since GOS 1.0
	 *
	 * @return GOS_Widget_Posts
	 */
	public function __construct() {
		$this->types = get_post_types();
		parent::__construct( 'widget_gos_post', __( 'GOS Display Posts Type`s', 'gos' ), array(
			'classname'   => 'widget_gos_post',
			'description' => __( 'Use this widget to list your specific posts type`s.', 'gos' ),
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
		$number = empty( $instance['number'] ) ? 2 : absint( $instance['number'] );
		$type 	= isset( $instance['type'] ) && in_array( $instance['type'], $this->types ) ? $instance['type'] : 'post';
		

		$posts = new WP_Query( array(
			'order'          => 'DESC',
			'posts_per_page' => $number,
			'no_found_rows'  => true,
			'post_status'    => 'publish',
			'post_type'   	 => $type
		) );

		if ( $posts->have_posts() ) {

			echo $args['before_widget'].$args['before_title'].$title.$args['after_title'];
			while ( $posts->have_posts() ) {
				$posts->the_post();
				$permalink = esc_url( get_permalink() );
				?>
				<article <?php post_class(); ?>>
					<?php if( has_post_thumbnail()  ) { ?>
					 	<figure>
					 		<a href="<?= $permalink ?>" class="pix-colrhvr">
					 			<?php the_post_thumbnail(); ?>
					 		</a>
					 	</figure>                
				 	<div class="text">
				 	<?php } else { ?>
		 			<div>
				 	<?php } ?>
	                    <h6>
	                        <a class="pix-colrhvr" href="<?= $permalink ?>">
	                            <?= the_title(); ?>                       
	                        </a>
	                    </h6>
	                    <ul class="post-options">
			        	    <li>
	                 	    	<time datetime="<?= get_the_date( 'd-m-Y' ); ?>"><?= get_the_date( ); ?></time>
	                		</li>
						</ul>
					</div>
	    		</article>

		<?php 	}
			echo $args['after_widget'];
			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();
		} // End check for ephemeral posts.
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
		$instance['number'] = empty( $new_instance['number'] ) ? 2 : absint( $new_instance['number'] );
		if ( in_array( $new_instance['type'], $this->types ) ) {
			$instance['type'] = $new_instance['type'];
		}

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
		$number = empty( $instance['number'] ) ? 2 : absint( $instance['number'] );
		$type 	= isset( $instance['type'] ) && in_array( $instance['type'], $this->types ) ? $instance['type'] : 'post';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'gos' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'gos' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php _e( 'Post type to show:', 'gos' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>">
				<?php foreach ( $this->types as $slug ) : ?>
				<option value="<?php echo esc_attr( $slug ); ?>"<?php selected( $type, $slug ); ?>><?php echo esc_attr( $slug ); ?></option>
				<?php endforeach; ?>
			</select>
		<?php
	}
}
