<?php
add_action('widgets_init', 'flickr_widget');
function flickr_widget(){
	register_widget('flickr');
}

class flickr extends WP_Widget {

	/* Widget setup */
	function flickr() {

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'flickr-widget-wrapper', 
			'description' => __('A widget that displays your Flickr photos.', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'flickr-widget' 
		);

		/* Create the widget */
		$this->WP_Widget('flickr-widget', __('Flickr Widget (bingumd)', 'bmd'), $widget_ops, $control_ops);
	}


	/* Display the widget on the screen */
	function widget($args, $instance) {
 		extract($args);

 		wp_enqueue_script('jflickrfeed');
 		wp_enqueue_script('prettyPhoto');

		$title    = apply_filters('widget_title', $instance['title']);
		$flickrid = $instance['flickrid'];
		$number   = $instance['number'];

		echo $before_widget;

		if ($title) echo $before_title . $title . $after_title; 
		?>

		<ul id="<?php echo $args['widget_id'] ?>-bmd" class="flickr-widget"></ul>            
        <script type="text/javascript">
            jQuery(document).ready(function($){
			    $('#<?php echo $args['widget_id'] ?>-bmd').jflickrfeed({
					limit       : <?php echo $number; ?>,
					qstrings    : { id: '<?php echo $flickrid; ?>' },
					itemTemplate: '<li>'+
								  	'<a rel="prettyPhoto[flickr]" href="{{image}}" title="{{title}}">' +
										'<img src="{{image_m}}" alt="{{title}}" />' + '<i class="icon-plus-sign"></i>' +
									'</a>' +
								  '</li>'
				}, function(data){
					$("a[rel^='prettyPhoto']").prettyPhoto();
				});
			});
		</script>

		<?php
        echo $after_widget;
	}


	/* Update the widget settings */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		
		$instance['title']    = strip_tags( $new_instance['title']);
		$instance['flickrid'] = strip_tags( $new_instance['flickrid']);
		$instance['number']   = strip_tags( $new_instance['number']);

		return $instance;
	}


	/* Displays the widget settings controls on the widget panel */
	function form($instance) {

		$defaults = array( 
			'title'    => __('Flickr', 'bmd'), 
			'number'   => '6',
			'flickrid' => ''
		);
		
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

	 	<p>
			<label for="<?php echo $this->get_field_id('flickrid'); ?>"><?php _e('Your Flickr User ID:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickrid'); ?>" name="<?php echo $this->get_field_name('flickrid'); ?>" value="<?php echo $instance['flickrid']; ?>" />
	 	</p>
     
     	<p>
     		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
	 		<small>Don't know your ID? Head on over to <a href="http://idgettr.com">idgettr</a> to find it.</small>
     	</p>
		<?php
	}

}