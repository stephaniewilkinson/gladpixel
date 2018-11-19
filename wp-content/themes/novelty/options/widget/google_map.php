<?php
add_action('widgets_init', 'google_map_widget');
function google_map_widget(){
	register_widget('google_map');
}

class google_map extends WP_Widget {

	/* Widget setup */
	function google_map() {

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'google-map-widget-wrapper', 
			'description' => __('Google Map', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'google-map-widget' 
		);

		/* Create the widget */
		$this->WP_Widget('google-map-widget', __('Google Map Widget (bingumd)', 'bmd'), $widget_ops, $control_ops);
	}


	/* Display the widget on the screen */
	function widget($args, $instance) {
 		extract($args);

 		wp_enqueue_script('googlemaps');
        wp_enqueue_script('googlemap');

		$title       = apply_filters('widget_title', $instance['title']);
		$address     = $instance['address'];
		$coordinates = $instance['coordinates'];
		$zoom        = $instance['zoom'];
		$height      = $instance['height'];

		echo $before_widget;

		if ($title) echo $before_title . $title . $after_title; 
		

		if (!$address) {
            _e('Address was not specified', 'bmd');
            return false;
        }
        
        if (!$coordinates) {
            $coordinates = aq_get_map_coordinates($address);
            if (is_array($coordinates)) {
                $coordinates = $coordinates['lat'] . ',' . $coordinates['lng'];
            } else {
                echo $coordinates;
                return false;
            }
        }
        
        echo '<div id="map_canvas_' . rand(1, 100) . '" class="flexible-map" style="height:' . $height . '">';
            echo '<input class="location" type="hidden" value="' . $address . '" />';
            echo '<input class="coordinates" type="hidden" value="' . $coordinates . '" />';
            echo '<input class="zoom" type="hidden" value="' . $zoom . '" />';
            echo '<div class="map_canvas"></div>';
        echo '</div>';


        echo $after_widget;
	}


	/* Update the widget settings */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		
		$instance['title']       = strip_tags( $new_instance['title']);
		$instance['address']     = strip_tags( $new_instance['address']);;
		$instance['coordinates'] = strip_tags( $new_instance['coordinates']);;
		$instance['zoom']        = strip_tags( $new_instance['zoom']);;
		$instance['height']      = strip_tags( $new_instance['height']);;

		return $instance;
	}


	/* Displays the widget settings controls on the widget panel */
	function form($instance) {

		$defaults = array( 
			'title'    => __('Google Map', 'bmd'), 
			'address'     => '',
            'coordinates' => '',
            'zoom'        => '15',
            'height'      => '250px',
		);
		
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

	 	<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
	 	</p>
     
     	<p>
     		<label for="<?php echo $this->get_field_id('coordinates'); ?>"><?php _e('Coordinates (optional):', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('coordinates'); ?>" name="<?php echo $this->get_field_name('coordinates'); ?>" value="<?php echo $instance['coordinates']; ?>" />
     	</p>

     	<p>
     		<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom Level:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" value="<?php echo $instance['zoom']; ?>" />
     	</p>

     	<p>
     		<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Map Height (in pixels):', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" />
     	</p>
		<?php
	}

}