<?php
global $smof_data, $attachment;

$att_arg = array( 
				'post_type'      => 'attachment',
				'numberposts'    => -1,
				'post_status'    => null,
				'post_parent'    => $post->ID,
				'post_mime_type' => 'image',
				'orderby'        => 'menu_order ID'
			);
$attachments = get_posts($att_arg);

if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); 

	$project_type = get_post_meta($post->ID, '_bmd_project_type', true);

	if ($smof_data['portflio_single_link'] == 1) {
		echo '<div class="portfolio-single-link">';
		previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bmd' ) . ' Previous</span>' );
		echo '<span class="spacer"></span>';
		next_post_link( '%link', 'Next <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bmd' ) . '</span>' ); 
		echo '</div>';
	}
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-single portfolio-right'); ?>>
			
		<div class="row">

			<div class="portfolio-single-items span9 <?php echo $shadow; ?>">

				<?php switch ($project_type) {

					case 'image':
					foreach ($attachments as $attachment) : 
						$permalink = isset($GLOBALS['post-carousel']) ? get_permalink() : $attachment->guid;
						$attachment_img = wp_get_attachment_image_src( $attachment->ID, isset($attachment_size), false ); 
						$img_url = $attachment_img[0];

						$image = aq_resize($img_url, 960, '', true);
						?>
				    	<img src="<?php echo $image; ?>" alt="<?php echo $attachment->post_name; ?>" title="<?php echo $attachment->post_title; ?>">
				    <?php endforeach;
					break;

				case 'slider':
					wp_enqueue_script('flexslider'); ?>

					<div class="flexslider loader">
						<ul class="slides">
							<?php foreach( $attachments as $attachment ): 
								$permalink = isset( $GLOBALS['post-carousel'] ) ? get_permalink() : $attachment->guid;
								$attachment_img = wp_get_attachment_image_src( $attachment->ID, isset($attachment_size), false ); 
								$img_url = $attachment_img[0];

								$image = aq_resize($img_url, 960, '', true);
								?>
						    	<li><img src="<?php echo $image; ?>" alt="<?php echo $attachment->post_name; ?>" title="<?php echo $attachment->post_title; ?>"></li>
						    <?php endforeach; ?>
						</ul><!-- end ul .slides -->						
					</div><!-- end div .flexslider -->
					
					<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery('.flexslider').flexslider({
						    	animation: "fade",
						    	controlNav: false,
						    	prevText: "", 
								nextText: "",
								smoothHeight: true,
						    	start: function(slider){
						    		jQuery('.flexslider').removeClass('loader');
						    	}
						  	});
						});
					</script>
					<?php
					break;

					case 'vimeo': 
						$vimeo = get_post_meta($post->ID, '_bmd_video_link', true ); ?>
						<div class="flexible-video ">
					    	<iframe src="http://player.vimeo.com/video/<?php echo $vimeo ?>?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
						</div> 
						<?php
						break;

					case 'youtube': 
						$youtube = get_post_meta( $post->ID, '_bmd_video_link', true ); ?>
						<div class="flexible-video">
						    <iframe width="948" height="600" src="http://www.youtube.com/embed/<?php echo $youtube ?>?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
						<?php
						break;
								
				} ?>

			</div><!-- end: portfolio-single-items -->


			<div class="span3">
		    	<h1><?php echo get_the_title(); ?></h1>
		    	<?php the_content(); 

		    	if ($skill || $url || $client || $year) : ?>

		    		<ul class="p-info">
		    			<?php if ($client) { ?>
		    				<li><i class="<?php echo $smof_data['portfolio_client_class'] ?>"></i><?php echo $client; ?></li>
		    			<?php }

		    			if ($url) { ?>
		    				<li><i class="<?php echo $smof_data['portfolio_url_class'] ?>"></i><a href="<?php echo $url; ?>"><?php echo $url; ?></a></li>
						<?php }
		    			
						if ($skill) { ?>
		    				<li><i class="<?php echo $smof_data['portfolio_skills_class'] ?>"></i><?php echo $skill; ?></li>
		    			<?php }

		    			if ($year) { ?>
		    				<li><i class="<?php echo $smof_data['portfolio_year_class'] ?>"></i><?php echo $year; ?></li>
		    			<?php } ?>
		    		</ul>
	    		<?php endif; ?>
    		</div>
    		
		</div>

	</article><!-- end article -->

<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>