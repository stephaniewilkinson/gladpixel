<?php
/** Testimonial Block **/
if (!class_exists('BMD_Testimonials_Block')) {
	class BMD_Testimonials_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name'  => 'Testimonials',
				'size'  => 'span6',
				'icons' => 'icon-user',
			);
			
			parent::__construct('bmd_testimonials_block', $block_options);
			add_action('wp_ajax_aq_block_testimonial_add_new', array($this, 'add_testimonial'));
		}
		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'testimonials'		=> array(
					1 => array(
						'author' => 'My New Testimonial Author',
						'link' => '',
						'company' => '',
						'text' => ''
					)
				),
				'heading' => 'h3',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
			
			<h3 class="builder-block-title"><?php _e('Edit Testimonials', 'bmd') ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title', 'bmd') ?>
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					<?php _e('Title Size', 'bmd') ?><br/>
					<?php echo aq_field_select('heading', $block_id, $heading_size, $heading) ?>
				</label>
			</p>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$testimonials = is_array($testimonials) ? $testimonials : $defaults['testimonials'];
					$count = 1;
					foreach ($testimonials as $testimonial) {	
						$this->testimonial($testimonial, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="testimonial" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function testimonial($testimonial = array(), $count = 0) {
			
			$defaults = array (
				'author'  => '',
				'company' => '',
				'text'    => ''
			);
			$testimonial = wp_parse_args($testimonial, $defaults);
			
			?>
			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $testimonial['author'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author">
							Author<br/>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][author]" value="<?php echo $testimonial['author'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company">
							Company<br/>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][company]" value="<?php echo $testimonial['company'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-text">
							Testimonial Text<br/>
							<textarea id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-text" class="textarea-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][text]" rows="5"><?php echo $testimonial['text'] ?></textarea>
						</label>
					</p>
					<p class="description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function add_testimonial() {
			$nonce = $_POST['security'];	
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$testimonial = array(
				'author' => 'My New Testimonial Author',
				'company' => '',
				'text' => ''
			);
			
			if($count) {
				$this->testimonial($testimonial, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function block($instance) {
			wp_enqueue_script('flexslider');
			extract($instance);
			
			$rand = rand(1,100);
			
			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}
			?>
				
			<div id="testimonials_<?php echo $rand ?>" class="testimonials flexslider loader">
				<ul class="slides">
				
				<?php foreach ($testimonials as $testimonial) {	
					
					$defaults = array (
						'author'  => '',
						'company' => '',
						'text'    => ''
					);
					$testimonial = wp_parse_args($testimonial, $defaults);
					
					if (!empty($testimonial['author']) && !empty($testimonial['text'])) {
					?>
					
						<li>
						
							<div class="testimonial-texts">
								<?php echo stripslashes(wpautop($testimonial['text'])) ?>
							</div>
							
							<div class="testimonial-author">
								<i class="icon-user"></i><strong><?php echo htmlspecialchars(stripslashes($testimonial['author'])) ?></strong>, 

								<?php if ($testimonial['company']) : ?>
								<span class="company"><?php echo htmlspecialchars(stripslashes($testimonial['company'])) ?></span>
								<?php endif; ?>
							</div>
							
						</li>
						<?php
					}
				} ?>
				
				</ul>
				
				<script type="text/javascript">
				jQuery(window).load(function() {
					jQuery('#testimonials_<?php echo $rand ?>').flexslider({
				    	animation: "fade",
				    	controlNav: false,
				    	prevText: "", 
						nextText: "", 
						directionNav: false,
						smoothHeight: true,
						pauseOnHover: true, 
						slideshowSpeed: 12000, 
				    	start: function(slider){
				    		jQuery('.flexslider').removeClass('loader');
				    	}
				  	});
				});
			</script>
				
			</div>
			<?php
			
		}
		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}
		
	}
}