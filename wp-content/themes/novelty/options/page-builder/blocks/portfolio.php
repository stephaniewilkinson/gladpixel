<?php
/*-----------------------------------------------------------------------------------*/
/* PORTFOLIO BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Portfolio_Block')) {
	class BMD_Portfolio_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Portfolio',
				'size'  => 'span12',
				'icons' => 'icon-briefcase',
	 		);

			parent::__construct('bmd_portfolio_block', $block_options);
		}

		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading'     => 'h3',
				'col'         => 'col4',
				'filtrable'   => 'no',
				'nav'         => 'no',
				'img_size'    => '300',
				'num'         => 8,
				'cat'         => '',
				'poss'        => '',
				'thumb_title' => '',
				'thumb_icon'  => '',
				'thumb_zoom'  => '',
				'thumb_open'  => ''
			);
			
			$portfolio_types = get_terms('portfolio-category');
			$types_options = array("all" => "All");
			foreach ($portfolio_types as $type) {
				$types_options[$type->name] = $type->name;
			}

			$portfolio_coll = array(
				'col1' => '1',
				'col2' => '2',
				'col3' => '3',
				'col4' => '4'
			);
		
			$show = array(
				'yes' => 'Yes',
				'no'  => 'No'
			);

			$pos = array(
				'right'  => 'Right',
				'center' => 'Center'
			); 

			$show2 = array(
				'show' => 'Show',
				'hide' => 'Hide'
			); 

			$open = array(
				'single'   => 'Single Post',
				'lightbox' => 'Lightbox'
			);




			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Portfolio', 'bmd'); ?></h3>

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
					<?php _e('Portfolio Categories', 'bmd'); ?><br/>
				<?php echo aq_field_select('cat', $block_id, $types_options, $cat); ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('num') ?>">
					<?php _e('Amount of on one page', 'bmd'); ?>
					<?php echo aq_field_input('num', $block_id, $num, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('col') ?>">
					<?php _e('Portfolio Column', 'bmd'); ?><br/>
					<?php echo aq_field_select('col', $block_id, $portfolio_coll, $col) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('nav') ?>">
					<?php _e('Show Pagination', 'bmd'); ?><br/>
					<?php echo aq_field_select('nav', $block_id, $show, $nav) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('filtrable') ?>">
					<?php _e('Enable Filtrable', 'bmd'); ?><br/>
					<?php echo aq_field_select('filtrable', $block_id, $show, $filtrable) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('poss') ?>">
					<?php _e('Filtrable Position', 'bmd'); ?><br/>
					<?php echo aq_field_select('poss', $block_id, $pos, $poss) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('thumb_title') ?>">
					<?php _e('Show Title?', 'bmd'); ?><br/>
					<?php echo aq_field_select('thumb_title', $block_id, $show2, $thumb_title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('thumb_icon') ?>">
					<?php _e('Show Icon?', 'bmd'); ?><br/>
					<?php echo aq_field_select('thumb_icon', $block_id, $show2, $thumb_icon) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('thumb_zoom') ?>">
					<?php _e('Enable zoom on hover?', 'bmd'); ?><br/>
					<?php echo aq_field_select('thumb_zoom', $block_id, $show, $thumb_zoom) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('thumb_open') ?>">
					<?php _e(' Link To?', 'bmd'); ?><br/>
					<?php echo aq_field_select('thumb_open', $block_id, $open, $thumb_open) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('img_size') ?>">
					<?php _e('Image Height', 'bmd'); ?>
					<?php echo aq_field_input('img_size', $block_id, $img_size, $size = 'full') ?>
				</label>
			</p>
		<?php }


		function block($instance) {

			$defaults = array(
				'heading'     => 'h3',
				'col'         => 'col4',
				'filtrable'   => 'no',
				'nav'         => 'no',
				'img_size'    => '300',
				'num'         => 8,
				'cat'         => '',
				'poss'        => '',
				'thumb_title' => '',
				'thumb_icon'  => '',
				'thumb_zoom'  => '',
				'thumb_open'  => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			global $pag, $post, $paged, $data, $wp_query;
			if (empty($paged)) $paged = (get_query_var('page')) ? get_query_var( 'page' ) : 1; 
			$col_width = aq_get_column_width($size); 

			if ($title || $filtrable == 'yes') {
			    echo '<div class="page-title clearfix position-' . $poss . '">';

			        if ($title) echo '<'.$heading.'>'.$title.'</'.$heading.'>';

			        if ($filtrable == 'yes') {
			        	wp_enqueue_script('isotope');
			        	wp_enqueue_script('portfolio');

				        echo '<ul id="filtrable" class="clearfix position-' . $poss . '">';

				            $cat_lists = get_category_list('portfolio-category', $cat);
			            
				            foreach ($cat_lists as $cat_list) {
								$category_slug = str_replace(' ', '-', $cat_list);
								$category_slug = mb_strtolower($category_slug, 'UTF-8');
								if ($category_slug == 'all') $category_slug = '*';
								$cat_list = ucfirst($cat_list); 
								echo '<li><a href="#" data-categories="' . $category_slug . '">' . $cat_list . '</a></li>';
							} 

				        echo '</ul>';
			    	}

				echo '</div>';
			}


			echo '<div id="portfolio" class="portfolio-items clearfix ' . $col . '">';

				$cat = ($cat == 'all') ? '' : $cat;
		        $args = array(
					'post_type'          => 'portfolio',
					'post_status'        => 'publish',
					'posts_per_page'     => $num,
					'paged'              => $paged,
					'portfolio-category' => $cat
		    	);
		    	$temp = $wp_query;
				$wp_query= null;
		    	$wp_query = new WP_Query($args);
			                  
				if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();  

					if (has_post_thumbnail($post->ID, 'full')) { 
						$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full'); 
					}

					if ($col == 'col1') $image = aq_resize($img_url[0],  $col_width,   $img_size, true);
				    if ($col == 'col2') $image = aq_resize($img_url[0],  $col_width/2, $img_size, true);
				    if ($col == 'col3') $image = aq_resize($img_url[0],  $col_width/3, $img_size, true);
				    if ($col == 'col4') $image = aq_resize($img_url[0],  $col_width/4, $img_size, true);

					$project_type = (get_post_meta($post->ID, '_bmd_project_type', true));
		        	$cat_p = bmd_get_category_list($post->ID, 'portfolio-category', '', ',', '', 0 );
		        	$cat_p = str_replace(' ', '-', $cat_p);
		        	$cat_p = str_replace(',', ' ', $cat_p);
		        	$cat_p = mb_strtolower($cat_p, 'UTF-8'); 

		        	if ($project_type == 'slider') $p_class = "icon-picture";
                    if ($project_type == 'image' ) $p_class = "icon-camera";
                    if ($project_type == 'vimeo' || $project_type == 'youtube') $p_class = "icon-film";
		        	?>

				    <article data-categories="<?php echo $cat_p ?>" <?php if ($thumb_zoom == 'yes') echo 'class="thumb-zoom"' ?>>
				    	<div class="portfolio-item-wrapper">
	                        <img src="<?php echo $image; ?>" alt="<?php echo get_the_title(); ?>"/>
							<div class="portfolio-context">

								<?php if ($thumb_title == 'show') : ?>
									<?php echo '<h2>' . get_the_title() . '</h2>'; ?>
									<?php echo "<p>" . bmd_get_category_list( $post->ID, 'portfolio-category', '', ' - ', '', 0 ) . "</p>"; ?>
								<?php endif; ?>

								<?php if ($thumb_icon == 'show') : ?>
									<span class="p-link"><i class="<?php echo $p_class; ?>"></i></span>
								<?php endif; ?>

							</div>
						</div>

						<?php if($thumb_open == 'single') { ?>
							<a href="<?php echo get_permalink(); ?>" class="p-full-link"></a>
						<?php } else {

							wp_enqueue_script('prettyPhoto');

							$img_post = array();
							for ($i = 1; $i < 11; $i++) {
								$img = get_post_meta($post->ID, '_bmd_image_'.$i, true); 
								$img_post[$i] = $img;
							}
							$img_post = array_filter($img_post);

							switch ($project_type) {

								case 'image':
									echo '<a href="' . $img_post[1] . '" rel="prettyPhoto" class="p-full-link"></a>';
									break;

								case 'vimeo':
									$vimeo = get_post_meta($post->ID, '_bmd_video_link', true);
									echo '<a href="http://vimeo.com/' . $vimeo . '"rel="prettyPhoto" title="' . get_the_title() . '" class="p-full-link"></a>';
									break;

								case 'youtube':
									$youtube = get_post_meta($post->ID, '_bmd_video_link', true);
									echo '<a href="http://www.youtube.com/watch?v=' . $youtube . '"rel="prettyPhoto" title="' . get_the_title() . '" class="p-full-link"></a>';
									break;

								case 'slider':
									echo '<div style="display: none">';
									$i = 1;
										foreach ($img_post as $name) {
											if ($i != 1){
												echo '<a href="' . $name . '" rel="prettyPhoto[pp_gal_' . $post->ID . ']" class="p-full-link"></a>';
											}
											$i++;
								    	}
									echo '</div>';
									echo '<a href="' . $img_post[1] . '" rel="prettyPhoto[pp_gal_' . $post->ID . ']" class="p-full-link"></a>';
									break;

							}
						 } ?>

		            </article><!-- end article .span3 -->

			    <?php endwhile; endif; 

		    echo '</div>';
		
			if ($nav == 'yes') bmd_pagination();
			$wp_query = null; 
			$wp_query = $temp; 

		}
	}
}