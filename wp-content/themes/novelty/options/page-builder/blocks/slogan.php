<?php
/*-----------------------------------------------------------------------------------*/
/* SLOGAN BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Slogan_Block')) {
	class BMD_Slogan_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Slogan',
				'size'  => 'span12',
				'icons' => 'icon-align-center',
			);

			parent::__construct('bmd_slogan_block', $block_options);
		}

		function form($instance) {
			global $heading_size;

			$default = array(
				'text'    => '',
				'heading' => 'h1',
			);

			$instance = wp_parse_args($instance, $default);
			extract($instance); 
			?>

			<h3 class="builder-block-title"><?php _e('Edit Slogan', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Welcomme Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('text') ?>">
					<?php _e('Welcome subtitle', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('text', $block_id, $text) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					<?php _e('Title Size', 'bmd'); ?><br/>
					<?php echo aq_field_select('heading', $block_id, $heading_size, $heading) ?>
				</label>
			</p>
		<?php }
		
		function block($instance) {
			extract($instance);

			echo '<div class="welcome">';
				echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
			echo '</div>';	
		}
		
	}
}