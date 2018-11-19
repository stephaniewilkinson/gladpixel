<?php
add_action('widgets_init', 'tab_widget');
function tab_widget(){
	register_widget('tab_widget');
}

class tab_widget extends WP_Widget{

	/* Widget setup */
	function tab_widget(){

		/* Widget settings */
		$widget_ops = array( 
			'classname'   => 'tab-widget-wrapper', 
			'description' => __('A tabbed widget that display popular posts, recent posts and comments.', 'bmd') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width'   => 250, 
			'height'  => 350, 
			'id_base' => 'tab-widget' 
		);

		/* Create the widget */
		$this->WP_Widget( 'tab-widget', __('Tabbed Widget (bingumd)', 'bmd'), $widget_ops, $control_ops );
	}
	


	/* How to display the widget on the screen */
	function widget( $args, $instance ) {
		global $wpdb, $post;
		extract($args);

		wp_enqueue_script('tabs');

		$tab1  = $instance['tab1'];
		$tab2  = $instance['tab2'];
		$tab3  = $instance['tab3'];
	
		echo $before_widget;

		$tab = array();
		?>
			
		<div class="tab-widget">

			<ul class="tab-header clearfix">
				<li class="active"><?php echo $tab1 ?></li>
				<li><?php echo $tab2 ?></li>
				<li class="last"><?php echo $tab3 ?></li>
			</ul>

		
			<div  class="tab-context visible">
				<?php
				$temp = $wp_query;
	            $wp_query = new WP_Query();
	            $wp_query->query('showposts=5&orderby=comment_count');  
	            if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
				
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
						</div><!-- end widget .widget-thumbnail -->

						<div class="widget-context">
							<a href="<?php echo get_permalink( $custom_post->ID ); ?>" class="read"><?php echo the_title(); ?></a>
							<span class="widget-comment"><?php the_time('F j, Y'); ?></span>
						</div><!-- end div .widget-context -->
					</div><!-- end div .post-widget -->

				<?php 
				endwhile; endif; $wp_query = $temp;	
			echo '</div>';


			echo '<div  class="tab-context">';
				$temp = $wp_query;
	            $wp_query = new WP_Query();
	            $wp_query->query('showposts=5');  
	            if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
	            
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
						</div><!-- end div .widget-thumbnail -->

						<div class="widget-context">
							<a href="<?php echo get_permalink( $custom_post->ID ); ?>" class="read"> <?php echo the_title(); ?></a>
							<span class="widget-comment"><?php the_time('F j, Y'); ?></span>
						</div><!-- end div .widget-context -->

					</div><!-- end div .post-widget -->

				<?php 
				endwhile; endif; $wp_query = $temp;		
			echo '</div>';


			echo '<div class="tab-context">';
				$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5";
				$comments = $wpdb->get_results($sql);
				foreach ($comments as $comment) { ?>

					<div class="post-widget clearfix">
						<div class="widget-thumbnail">
							<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'bmd'); ?><?php echo $comment->post_title; ?>"><?php echo get_avatar( $comment, '45' ); ?></a>
						</div>

						<div class="widget-context comm_link">
							<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> <?php _e('on ', 'bmd'); ?><?php echo $comment->post_title; ?>"><?php echo strip_tags($comment->comment_author); ?>: <?php echo strip_tags($comment->com_excerpt); ?>...</a>
						</div>
					</div>
				<?php 
				}				
			echo '</div>';


		echo '</div>';
		echo $after_widget;
	}
	

	/* Update the widget settings. */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['tab1']  = $new_instance['tab1'];
		$instance['tab2']  = $new_instance['tab2'];
		$instance['tab3']  = $new_instance['tab3'];
		
		return $instance;
	}

	
	/* Displays the widget settings controls on the widget panel. */
	function form( $instance ) {
	
		$defaults = array(
			'tab1'  => 'Popular',
			'tab2'  => 'Recent',
			'tab3'  => 'Comments',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Popular Post Title:', 'bmd') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Recent Post Title:', 'bmd') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php _e('Comments Title:', 'bmd') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>" />
		</p>		
	
	<?php
	}
}