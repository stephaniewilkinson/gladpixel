<?php
add_action('widgets_init', 'video_widget');
function video_widget() {
	register_widget('video');
}

class video extends WP_Widget {

	/* Widget setup */
	function video() {

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'video-widget-wrapper', 
			'description' => __('Video Widget', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'video-widget' 
		);

		/* Create the widget */
		$this->WP_Widget('video-widget', __('Video Widget (bingumd)', 'bmd'), $widget_ops, $control_ops);
	}


	/* Display the widget on the screen */
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('Video Widget', $instance['title'] );
		$video = $instance['video'];

		echo $before_widget;

		if ($title) echo $before_title . $title . $after_title; ?>

			<div class="video-widget flexible-video">
				<?php echo $video; ?>
			</div>

		<?php 
		echo $after_widget;
	}


	/* Update the widget settings */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		if (current_user_can('unfiltered_html')) {
			$instance['video'] =  $new_instance['video'];
		} else {
			$instance['video'] = stripslashes(wp_filter_post_kses( addslashes($new_instance['video'])));
		}

		return $instance;

	}
	

	/* Displays the widget settings controls on the widget panel */
	function form($instance) {

		$defaults = array( 
			'title' => __('Video', 'bmd'),
			'video' => ''
		);

		$instance = wp_parse_args((array) $instance, $defaults); 
		$video    = esc_textarea($instance['video']);
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo _e('Title:', 'bmd'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<label for="<?php echo $this->get_field_id('video'); ?>"><?php echo _e('Video Embed Code:', 'bmd'); ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('video'); ?>" name="<?php echo $this->get_field_name('video'); ?>"><?php echo $video; ?></textarea>
	<?php
	}

}