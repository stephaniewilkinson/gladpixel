<?php
add_action('widgets_init', 'contact_widget');
function contact_widget() {
	register_widget('contact');
}

class contact extends WP_Widget {

	/* Widget setup */
	function contact() {

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'contact-widget-wrapper', 
			'description' => __('A widget that displays your latest tweets.', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'contact-widget' 
		);

		/* Create the widget */
		$this->WP_Widget('contact-widget', __('Contact Widget (bingumd)', 'bmd'), $widget_ops, $control_ops);
	}


	/* Display the widget on the screen */
	function widget($args, $instance) {
 		extract($args);

		$title   = apply_filters('widget_title', $instance['title']);
		$contact = $instance['contact'] ;

        echo $before_widget;

		if ($title) echo $before_title . $title . $after_title;

		echo do_shortcode('[contact-form-7 id="' . $contact . '" title="' . $title . '"]');

        echo $after_widget;
  	}


	/* Update the widget settings */
	function update($new_instance, $old_instance) {

		$new_instance = (array) $new_instance;

		$instance['title']   = strip_tags( $new_instance['title']);
		$instance['contact'] = (int)($new_instance['contact']);

		return $instance;
	}


    /* Displays the widget settings controls on the widget panel */
	function form($instance) {

		$defaults = array( 
			'title'   => __('Contact Form', 'bmd'), 
			'contact' => '', 
		);
		$instance = wp_parse_args((array) $instance, $defaults); 

		if (!is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
			echo __('Sorry, this block requires the <a href="http://wordpress.org/extend/plugins/contact-form-7/">Contact Form 7</a> plugin to be installed & activated. Please install/activate the plugin before using this block', 'bmd');
			return false;
		}
			
		$post_type = 'wpcf7_contact_form';
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		);
		$contact_forms = get_posts($args);
		if (empty($contact_forms)) {
			echo __('You do not currently have any contact form setup. Please create a contact form before setting up this block','framework');
			echo '<br/>';
			echo '<a href="' . admin_url() . '?page=wpcf7" title="Setup contact form">' . __('Setup contact form', 'framework') . '</a>';
			return false;
		}

		$form_ids = array();
		foreach ($contact_forms as $form) {
			$form_ids[$form->ID] = strip_tags($form->post_title);
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bmd'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Chose contact Form:', 'bmd'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('contact'); ?>" name="<?php echo $this->get_field_name('contact'); ?>">
				<?php
				foreach ($form_ids as $form_id => $form_name) {
					echo '<option value="' . $form_id . '"' . selected($instance['contact'], $form_id, false) . '>' . $form_name . "</option>\n";
				} 
				?>
			</select>
		</p>
	<?php
	}

}