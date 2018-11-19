<?php
add_action('widgets_init', 'popular_widget');
function popular_widget(){
	register_widget('popular_post');
}

class popular_post extends WP_Widget {

	/* Widget setup */
	function  popular_post() {

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'post-widget-wrapper', 
			'description' => __('A widget that show popular posts', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'post-popular' 
		);

		/* Create the widget */
		$this->WP_Widget('post-popular', __('Popular Posts (bingumd)', 'bmd'), $widget_ops, $control_ops);
	}


	/* Display the widget on the screen */
	function widget($args, $instance) {
		extract($args);

		$title = apply_filters('Popular Posts', $instance['title'] );
		$num   = $instance['num'];

		echo $before_widget;

		if ($title) echo $before_title . $title . $after_title;

		$custom_posts = get_posts('showposts='.$num.'&orderby=comment_count');

		if (!empty($custom_posts)) { 
			foreach ($custom_posts as $custom_post) { 
			?>
				<div class="post-widget clearfix">

					<div class="widget-thumbnail">
						<a href="<?php echo get_permalink($custom_post->ID); ?>">
							<?php
							$thumbnail_id = get_post_thumbnail_id($custom_post->ID);		
							$img_url = wp_get_attachment_image_src($thumbnail_id, 'large');
							$images = aq_resize($img_url[0], 45, 45, true); 

							if (!empty($images)) { ?>
								<img width="45" height="45" src="<?php echo $images ?>" alt="<?php the_title() ?>"/>
							<?php } ?>
						</a>
					</div><!-- end div.widget-thumbnail -->

					<div class="widget-context">
						<a href="<?php echo get_permalink($custom_post->ID); ?>"><?php echo $custom_post->post_title; ?></a>
						<span class="widget-comment"> <?php the_time('F j, Y'); ?></span>
					</div><!-- end div.widget-context -->

				</div><!-- end div.post-widget -->
			<?php 
			}
		}

		echo $after_widget;
	}


	/* Update the widget settings */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['num']   = strip_tags($new_instance['num']);

		return $instance;
	}


	/* Displays the widget settings controls on the widget panel */
	function form($instance) {

		$defaults = array( 
			'title' => __('Popular Posts', 'bmd'), 
			'num'   => '5'
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'bmd'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Show Count', 'bmd'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" value="<?php echo $instance['num']; ?>" />
		</p>
	<?php
	}
}