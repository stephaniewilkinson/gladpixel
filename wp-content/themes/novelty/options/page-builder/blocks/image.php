<?php
/*-----------------------------------------------------------------------------------*/
/* IMAGES BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Image_Block')) {
	class BMD_Image_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Image',
				'size'  => 'span6',
				'icons' => 'icon-camera',
			);

			parent::__construct('bmd_image_block', $block_options);
		}

		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading'  => 'h3',
				'img'      => '',
				'height'   => '',
				'lightbox' => ''
			);

			$lightbox_on = array(
				'yes' => 'Yes',
				'no'  => 'No'
			); 

			$instance = wp_parse_args($instance, $defaults);
			extract($instance); 
			?>
			
			<h3 class="builder-block-title"><?php _e('Edit Image', 'bmd'); ?></h3>

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

			<p class="description">
				<label for="<?php echo $this->get_field_id('img') ?>">
					<?php _e('Upload an image', 'bmd'); ?><br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<div class="clear"></div>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					<?php _e('Height (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('lightbox') ?>">
					<?php _e('Open in lightbox', 'bmd'); ?><br/>
					<?php echo aq_field_select('lightbox', $block_id, $lightbox_on, $lightbox) ?>
				</label>
			</p>
		<?php }

		function block($instance) {
			extract($instance);

			$width = aq_get_column_width($size);
			$image = aq_resize($img, $width, $height, true);

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}

			if ($lightbox == 'yes') {
				wp_enqueue_script('prettyPhoto');
				echo '<a href="' . $img . '" rel="prettyPhoto" class="overlay"><img width="' . $width . '" height="' . $height . '" src="' . $image . '"/><i class="icon-plus-sign"></i></a>';
			} else {
				echo '<img  width="' . $width . '" height="' . $height . '" src="' . $image . '" />';
			}
		}
		
	}
}