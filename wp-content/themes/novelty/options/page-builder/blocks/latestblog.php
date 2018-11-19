<?php
/*-----------------------------------------------------------------------------------*/
/* LATEST POST BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Latestblog_Block')) {
	class BMD_Latestblog_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Latest Post',
				'size'  => 'span12',
				'icons' => 'icon-th-list',
	 		);

			parent::__construct('bmd_latestblog_block', $block_options);
		}


		function form($instance) {
			global $heading_size;

			$defaults = array(
				'excerpt'    => 100,
				'read'       => 'Read More',
				'heading'    => 'h3',
				'col'        => 'span3',
				'read_icon'  => 'icon-caret-right',
				'cat'        => '',
				'post_order' => '',
				'thumbnail'  => '',
				'meta'       => '',
				'text_align' => ''
			);

			$blog_typess = get_terms('category');
			$blog_types = array("all" => "All");
			foreach ($blog_typess as $type) {
				$blog_types[$type->name] = $type->name;
			}
			
			$blog_col = array(
				'span12' => '1',
				'span6'  => '2',
				'span4'  => '3',
				'span3'  => '4'
			);

			$show = array(
				'1' => 'Yes',
				'0' => 'No'
			); 

			$align = array(
				''            => 'Left',
				'post-center' => 'Center',
			);

			$order_post = array(
				'latest'  => 'Latest Post',
				'popular' => 'Popular Populat'
			); 

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Latest Post', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title', 'bmd'); ?>
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					<?php _e('Title Size', 'bmd'); ?><br/>
					<?php echo aq_field_select('heading', $block_id, $heading_size, $heading) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('cat') ?>">
					<?php _e('Categories', 'bmd'); ?><br/>
				<?php echo aq_field_select('cat', $block_id, $blog_types, $cat); ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('post_order') ?>">
					<?php _e('Show Latest or Popular Post', 'bmd'); ?><br/>
					<?php echo aq_field_select('post_order', $block_id, $order_post, $post_order) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('col') ?>">
					<?php _e('Column', 'bmd'); ?><br/>
					<?php echo aq_field_select('col', $block_id, $blog_col, $col) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('excerpt') ?>">
					<?php _e('Lenght of Excerpt', 'bmd'); ?>
					<?php echo aq_field_input('excerpt', $block_id, $excerpt, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('thumbnail') ?>">
					<?php _e('Show Thubnail', 'bmd'); ?><br/>
					<?php echo aq_field_select('thumbnail', $block_id, $show, $thumbnail) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('meta') ?>">
					<?php _e('Show Meta', 'bmd'); ?><br/>
					<?php echo aq_field_select('meta', $block_id, $show, $meta) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('text_align') ?>">
					<?php _e('Text Align', 'bmd'); ?><br/>
					<?php echo aq_field_select('text_align', $block_id, $align, $text_align) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('read') ?>">
					<?php _e('Read More Text', 'bmd'); ?>
					<?php echo aq_field_input('read', $block_id, $read, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('read_icon') ?>">
					<?php _e('Read More Icon', 'bmd'); ?>
					<?php echo aq_field_input('read_icon', $block_id, $read_icon, $size = 'full') ?>
				</label>
			</p>
		<?php }



		function block($instance) {
			extract($instance);

			global $post, $paged, $wp_query;
			if (empty($paged)) { $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
			$col_width = aq_get_column_width($size);


			if ($col == 'span12') { $num = 1; }
		    if ($col == 'span6')  { $num = 2; }
		    if ($col == 'span4')  { $num = 3; }
		    if ($col == 'span3')  { $num = 4; } 

		    if (!$thumbnail) $thumb = "no-thumbnail";

		    $post_class = $col . ' ' . $text_align . ' ' . isset($thumb);

			$cat = ($cat == 'all') ? '' : $cat;  
            if ($post_order == 'popular') { 
            	$args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $num, 'paged' => $paged, 'category_name' => $cat, 'orderby' => 'comment_count');   
            } else {
            	$args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $num, 'paged' => $paged, 'category_name' => $cat);      
            }

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . strip_tags($title) . '</' . $heading . '>';
				echo '</div>';
			}
			    
		    echo '<div class="row latest-post">';

				$temp     = $wp_query;
				$wp_query = null;        
				$wp_query = new WP_Query($args);

	            if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
					$post_formt = get_post_format() ? $post_formt = get_post_format() : $post_formt = 'standart'; ?>

		            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

		            	<?php 
						if ($post_formt == 'standart' || $post_formt == 'image') {
							if (has_post_thumbnail($post->ID, 'full') && $thumbnail) {

								$img_url  = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
								$image = $img_url[0];

								if (isset($col2) == 'span12') {
									$image = aq_resize($image,  $col_width,  $col_width/2, true);
								} else {
									$image = aq_resize($image,  '660', '430', true);
								}

								echo '<img src="' . $image . '" alt="' . get_the_title() . '"/>'; 

							}
						}
						?>
						
						<?php 
						if ($post_formt == 'video' && $thumbnail) {
	
							$vimeo   = get_post_meta($post->ID, '_p_vimeo_id', true );
							$youtube = get_post_meta($post->ID, '_p_youtube_id', true); 

							if ($vimeo) { 
								echo '<div class="flexible-video">';
								    echo '<iframe src="http://player.vimeo.com/video/' . $vimeo . '?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen></iframe>';
								echo '</div>';
							} else {
								echo '<div class="flexible-video">';
								    echo '<iframe width="948" height="600" src="http://www.youtube.com/embed/' . $youtube . '?rel=0"></iframe>';
								echo '</div>';
							}
						}
						?>

						<?php 
						if ($post_formt == 'gallery' && $thumbnail ) {

							global $attachment; 
							wp_enqueue_script('flexslider');		
							$att_arg = array( 
											'post_type'      => 'attachment',
											'numberposts'    => -1,
											'post_status'    => null,
											'post_parent'    => $post->ID,
											'post_mime_type' => 'image',
											'orderby'        => 'menu_order'
										);
							$attachments = get_posts($att_arg);
							$rand = rand(1,100);
							?>
															
							<div id="slider-<?php echo $rand ?>" class="flexslider loader">
							<ul class="slides">
								<?php foreach ($attachments as $attachment): 

									$permalink = isset( $GLOBALS['post-carousel'] ) ? get_permalink() : $attachment->guid;
									$attachment_img = wp_get_attachment_image_src($attachment->ID, isset($attachment_size), false); 
									$img_url = $attachment_img[0];

									if (isset($col2) == 'span12') {
										$image = aq_resize($img_url,  $col_width,  $col_width/2, true);
									} else {
										$image = aq_resize($img_url,  '660', '430', true);
									}
									?>

								    <li><img src="<?php echo $image; ?>" title="<?php echo $attachment->post_title; ?>"></li>

							    <?php endforeach; ?>
							</ul><!-- end ul .slides -->

							<script type="text/javascript">
								jQuery(window).load(function() {
									jQuery('#slider-<?php echo $rand ?>').flexslider({
								    	animation: "fade",
								    	controlNav: false,
								    	prevText: "", 
										nextText: "", 
								    	start: function(slider){
								    		jQuery('.flexslider').removeClass('loader');
								    	}
								  	});
								});
							</script>
						</div><!-- end div .flexslider -->
						<?php } ?>

	            	
						<div class="latest-post-content">

							<h2 class="title"><a href="<?php echo get_permalink() ?>" ><?php echo get_the_title() ?></a></h2>

							<?php if ($meta) : ?>
							<div class="meta">
								<?php the_time('M / d / Y');  ?>
								&nbsp; :: &nbsp;
								<?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?>
							</div>
							<?php endif; ?>

							<p><?php bmd_max_charlength($excerpt); ?></p>
							<a href="<?php echo get_permalink() ?>" class="readmore"><?php echo $read ?><i class="<?php echo $read_icon ?>"></i></a>

						</div>

		            </article>

	            <?php 
	            endwhile; endif; 
				$wp_query = null; 
				$wp_query = $temp; 

			echo '</div>';
		}
	}
}