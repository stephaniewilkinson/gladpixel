<?php
/*-----------------------------------------------------------------------------------*/
/* TEXT BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Text_Block')) {
	class BMD_Text_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name'  => 'Text',
				'size'  => 'span12',
				'icons' => 'icon-font',
			);

			parent::__construct('bmd_text_block', $block_options);
		}
		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading' => 'h3',
				'content' => ''
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php  _e('Edit Text', 'bmd'); ?></h3>

			<div class="alert">
				<i class="icon-warning-sign"></i><?php _e('<strong>WARNING!</strong>Please save the template to work with this block.', 'bmd'); ?>
			</div>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					<?php _e('Title Size', 'bmd') ?><br/>
					<?php echo aq_field_select('heading', $block_id, $heading_size, $heading) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
				<?php _e('Content', 'bmd') ?><br/>
				<?php
				$args = array (
				//'tinymce' => false,
				'quicktags' => true, 
				);
				wp_editor(htmlspecialchars_decode($content), 'aq_blocks['.$block_id.'][content]', $args );
				?>
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
		}
		
	}
}