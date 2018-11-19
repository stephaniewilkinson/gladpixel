<?php
/*-----------------------------------------------------------------------------------*/
/* VIDEO BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Video_Block')) {
	class BMD_Video_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Video',
				'size'  => 'span6',
				'icons' => 'icon-film',
			);
			
			parent::__construct('bmd_video_block', $block_options);
		}
		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading' => 'h3',
				'content' => '',
				'code'    => ''
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Video', 'bmd'); ?></h3>

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
				<label for="<?php echo $this->get_field_id('content') ?>">
					<?php _e('Content (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('code') ?>">
					<?php _e('Embed code', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('code', $block_id, $code, $size = 'full') ?>
				</label>
			</p>
		<?php }
		
		function block($instance) {
			extract($instance);

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}

			echo wpautop(do_shortcode(htmlspecialchars_decode($content)));
			
			echo '<div class="flexible-video">';
				echo htmlspecialchars_decode($code);
			echo '</div>';
		}

	}
}