<?php
add_action('widgets_init', 'twitter_widget');
function twitter_widget(){
	register_widget('twitter');
}

class twitter extends WP_Widget {

	/* Widget setup */
	function twitter() {

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'twitter-widget-wrapper', 
			'description' => __('A widget that displays your latest tweets.', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'twitter-widget' 
		);

		/* Create the widget */
		$this->WP_Widget('twitter-widget', __('Twitter Widget (bingumd)', 'bmd'), $widget_ops, $control_ops);
	}


	/* Display the widget on the screen */
	function widget($args, $instance) {
 		extract($args);

 		wp_enqueue_script('tweet');

		$title    = apply_filters('widget_title', $instance['title']);
		$username = $instance['username'];
		$number   = $instance['number'];

        echo $before_widget;
        
		if ($title) echo $before_title . $title . $after_title; 
		?>
        
        <div id="<?php echo $args['widget_id'] ?>-bmd" class="twitter-widget"></div>          
        <script type="text/javascript">   
        	jQuery(document).ready(function($){                        
		        $("#<?php echo $args['widget_id'] ?>-bmd").tweet({
					username: "<?php print $username; ?>",
					count   : <?php print $number; ?>,
					template: "{text}{time}",
		        });
	        });                    
		</script>
            
		<?php
        echo $after_widget;
  	}


	/* Update the widget settings */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title']       = strip_tags( $new_instance['title']);
		$instance['username']    = strip_tags( $new_instance['username']);
		$instance['number']      = strip_tags( $new_instance['number']);

		return $instance;
	}


	/* Displays the widget settings controls on the widget panel */
	function form($instance) {

		$defaults = array( 
			'title'    => __('Twitter', 'bmd'), 
			'number'   => '3',
			'username' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
	     
	    <p>
	 		<label for="<?php echo $this->get_field_id('number'); ?>"><?php  _e('Number of tweets:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
	    </p>
		<?php
	}

}