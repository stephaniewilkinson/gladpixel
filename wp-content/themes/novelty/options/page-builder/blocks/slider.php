<?php
/*-----------------------------------------------------------------------------------*/
/* SLIDER BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Slider_Block')) {
	class BMD_Slider_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name'  => 'Flexslider',
				'size'  => 'span12',
				'icons' => 'icon-picture',
			);
			
			parent::__construct('bmd_slider_block', $block_options);
			add_action('wp_ajax_aq_block_slider_add_new', array($this, 'add_slide'));
		}

		function form($instance) {
			global $heading_size;

			$defaults = array(
				'slides' => array(
					1 => array(
						'title'   => 'New Slide',
						'upload'  => '',
						'caption' => '',
						'url'     => ''
					)
				),
				'slider'          => '',
				'slide_speed'     => 7000,
				'animation_speed' => 600,
				'height'          => '300',
				'heading'         => 'h3',
				'animation'       => '',
				'shadow'          => ''
			);

			$animation_style = array(
				'fade'  => 'Fade',
				'slide' => 'Slide',
			);

			$show = array(
				'shadow' => 'Yes',
				''       => 'No',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Flexslider', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					<?php _e('Title Size', 'bmd'); ?><br/>
					<?php echo aq_field_select('heading', $block_id, $heading_size, $heading) ?>
				</label>
			</p>

			<div class="description cf">
				<ul id="sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$slides = is_array($slides) ? $slides : $defaults['slides'];
					$count = 1;
					foreach ($slides as $slide) {	
						$this->slide($slide, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="slider" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

			<p class="description">
				<label for="<?php echo $this->get_field_id('animation') ?>">
					<?php _e('Animation', 'bmd'); ?><br/>
					<?php echo aq_field_select('animation', $block_id, $animation_style, $animation) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('slide_speed') ?>">
					<?php _e('Slideshow Speed ', 'bmd'); ?><br/>
					<?php echo aq_field_input('slide_speed', $block_id, $slide_speed) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('animation_speed') ?>">
					<?php _e('Animation Speed ', 'bmd'); ?><br/>
					<?php echo aq_field_input('animation_speed', $block_id, $animation_speed) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('shadow') ?>">
					<?php _e('Show Shadow', 'bmd'); ?><br/>
					<?php echo aq_field_select('shadow', $block_id, $show, $shadow) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					<?php _e('Height', 'bmd'); ?><br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>
		<?php }

		function slide($slide = array(), $count = 0) {
			
			$defaults = array (
				'title'   => '',
				'upload'  => '',
				'caption' => '',
			);

			$slide = wp_parse_args($slide, $defaults); 
			?>

			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $slide['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#"><?php _e('Open / Close', 'bmd'); ?></a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title">
							<?php _e('Slide Title', 'bmd'); ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][title]" value="<?php echo $slide['title'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-upload">
							<?php _e('Upload Image', 'bmd'); ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>_<?php echo $count ?>_upload" class="input-full input-upload" value="<?php echo $slide['upload'] ?>" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][upload]">
							<a href="#" class="aq_upload_button button" rel="image"><?php _e('Upload', 'bmd'); ?></a>
							<p></p>
						</label>

						<div class="clear"></div>
						<div class="screenshot">
							<img src="<?php echo $client['upload'] ?>" />
						</div>
					</p>

					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-url">
							<?php _e('URL', 'bmd'); ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-url" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][url]" value="<?php echo $slide['url'] ?>" />
						</label>
					</p>

					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-caption">
							<?php _e('Slide Caption', 'bmd'); ?><br/>
							<textarea id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-caption" class="textarea-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][caption]" rows="5"><?php echo $slide['caption'] ?></textarea>
						</label>
					</p>
					<p class="description"><a href="#" class="sortable-delete"><?php _e('Delete', 'bmd'); ?></a></p>
				</div>
				
			</li>
		<?php }

		function add_slide() {
			$nonce = $_POST['security'];	
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			$slide = array(
				'title'   => 'New Slide',
				'upload'  => '',
				'caption' => '',
				'url'     => '',
			);
			
			if ($count) {
				$this->slide($slide, $count);
			} else {
				die(-1);
			}
			
			die();
		}

		function block($instance) {
			extract($instance);

			wp_enqueue_script('flexslider');
			$col_width = aq_get_column_width($size); 

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}
			
			if ($slides) {
				$rand = rand(1,100);
				
				echo '<div id="slider-' . $rand . '" class="flexslider loader ' . $shadow . '">';
					echo '<ul class="slides">';
						foreach ($slides as $i=>$slide) {
							echo '<li>';

								if ($slide['url']) echo '<a href="' . $slide['url'] . '">';

								$image = aq_resize($slide['upload'],  $col_width,  $height, true);

								echo '<img src="' . $image . '" alt="' . $slide['title'] . '"/>';
								if (!empty($slide['caption'])) {
									echo '<h5>' . $slide['caption'] . '</h5>';
								}
								if ($slide['url']) echo "</a>";
							echo '</li>';
						}	
					echo '</ul>';
				echo '</div>';
			}
			?>

			<script type="text/javascript">
				jQuery(window).load(function() {
					jQuery('#slider-<?php echo $rand; ?>').flexslider({
				    	animation: "<?php echo $animation ?>",
				    	slideshowSpeed: <?php echo $slide_speed ?>,
						animationSpeed: <?php echo $animation_speed ?>, 
				    	controlNav: false,
				    	prevText: "", 
						nextText: "", 
				    	start: function(slider){
				    		jQuery('.flexslider').removeClass('loader');
				    	}
				  	});
				});
			</script>
		<?php }
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
		
	}
}