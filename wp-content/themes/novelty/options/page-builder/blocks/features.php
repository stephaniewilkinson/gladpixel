<?php
/*-----------------------------------------------------------------------------------*/
/* FEATURES BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Features_Block')) {
	class BMD_Features_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Features',
				'size'  => 'span3',
				'icons' => 'icon-trophy',
			);
			
			parent::__construct('bmd_features_block', $block_options);
		}
		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading' => 'h3',
				'content' => '',
				'icon'    => '',
				'img'     => '',
				'url'     => ''
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Features', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title', 'bmd'); ?><br/>
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
				<label for="<?php echo $this->get_field_id('content') ?>">
					<?php _e('Content', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('icon') ?>">
					<?php _e('Icon class (optional) - ', 'bmd'); ?><a href="http://fortawesome.github.com/Font-Awesome/" target="_blank"><?php _e('refer here', 'bmd'); ?></a><br/>
					<?php echo aq_field_input('icon', $block_id, $icon) ?>
				</label>
			</p>


			<p class="description">
				<label for="<?php echo $this->get_field_id('img') ?>">
					<?php _e('Upload an image (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<div class="clear"></div>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('url') ?>">
					<?php _e('URL (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_input('url', $block_id, $url) ?>
				</label>
			</p>
		<?php }
		
		function block($instance) {
			extract($instance);
			
			if ($img){
				$ico = '<img src="' . $img . '"></>';
			} elseif ($icon) {
				$ico = '<i class="' . $icon . '"></i>';
			}

			if ($url) echo '<a href="' . $url . '">';
				echo '<div class="features">';
					echo $ico;
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
					echo wpautop(do_shortcode(htmlspecialchars_decode($content)));
				echo '</div>';
			if ($url) echo '</a>';
		}
		
	}
}