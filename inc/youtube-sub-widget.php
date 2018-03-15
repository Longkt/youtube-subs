<?php

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class Youtube_Sub_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'yts_widget', // Base ID
			esc_html__( 'Youtube Subscribs Widget', 'yts_domain' ), // Name
			array( 'description' => esc_html__( 'Display subscribers of your Youtube channel', 'yts_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo '<div class="g-ytsubscribe" data-channel="'.$instance['channel_name'].'" data-layout="'.$instance['layout'].'"  data-count="'.$instance['count'].'"></div>';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = (! empty( $instance['title'] )) ? $instance['title'] : esc_html__( 'Widget Title', 'yts_domain' );
		$channel_name = (! empty( $instance['channel_name'] )) ? $instance['channel_name'] : esc_html__( 'Channel Name', 'yts_domain' );
		$layout = (! empty( $instance['layout'] )) ? $instance['layout'] : esc_html__( 'Layout', 'yts_domain' );
		$count = (! empty( $instance['count'] )) ? $instance['count'] : esc_html__( 'Count', 'yts_domain' );
		?>

		<!-- Title -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Widget Title:', 'yts_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<!-- Channel name -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'channel_name' ) ); ?>"><?php esc_attr_e( 'Youtube channel name:', 'yts_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'channel_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'channel_name' ) ); ?>" type="text" value="<?php echo esc_attr( $channel_name ); ?>">
		</p>
		
		<!-- Layout -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_attr_e( 'Layout:', 'yts_domain' ); ?></label> 
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" id="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
				<option value="default" <?php echo ($instance['layout'] == 'default') ? 'selected' : '' ?>>Default</option>
				<option value="full" <?php echo ($instance['layout'] == 'full') ? 'selected' : '' ?>>Full</option>
			</select>
		</p>

		<!-- Count -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Count:', 'yts_domain' ); ?></label> 
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" id="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>">
				<option value="default" <?php echo ($instance['count'] == 'default') ? 'selected' : '' ?>>Default</option>
				<option value="hidden" <?php echo ($instance['count'] == 'hidden') ? 'selected' : '' ?>>Hidden</option>
			</select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['channel_name'] = ( ! empty( $new_instance['channel_name'] ) ) ? strip_tags( $new_instance['channel_name'] ) : '';
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags($new_instance['layout']) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags($new_instance['count']) : '';

		return $instance;
	}

}