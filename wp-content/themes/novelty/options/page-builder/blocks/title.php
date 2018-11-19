<?php
/*-----------------------------------------------------------------------------------*/
/* TITLE BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Title_Block')) {
	class BMD_Title_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Title',
				'size'  => 'span12',
				'icons' => 'icon-text-width',
			);

			parent::__construct('bmd_title_block', $block_options);
		}

		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading' => 'h3',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance); 
			?>
			
			<h3 class="builder-block-title"><?php _e('Edit Title', 'bmd'); ?></h3>

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
		<?php }
		
		function block($instance) {
			extract($instance);

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}
		}
		
	}
}