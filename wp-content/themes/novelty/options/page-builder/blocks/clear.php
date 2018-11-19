<?php
/*-----------------------------------------------------------------------------------*/
/* CLEAR & DIVIDER BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Clear_Block')) {
	class BMD_Clear_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name'  => 'Divider &amp; Clear',
				'size'  => 'span12',
				'icons' => 'icon-minus', 
			);

			parent::__construct('bmd_clear_block', $block_options);
		}
		

		function form($instance) {

			$defaults = array(
				'style' => 'none',
				'mt'    => '',
				'mb'    => ''
			);
						
			$line_style = array(
				'none'   => 'None',
				'single' => 'Single',
				'double' => 'Double',
				'image'  => 'Image',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance); 
			?>

			<h3 class="builder-block-title"><?php _e('Edit Divider / Clear', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('style') ?>">
					<?php _e('Style', 'bmd'); ?><br/>
					<?php echo aq_field_select('style', $block_id, $line_style, $style, $block_id); ?>
				</label>
			</p>

			<div class="description">
				<label for="<?php echo $this->get_field_id('mt') ?>">
					<?php _e('Margin Top', 'bmd'); ?><br/>
					<?php echo aq_field_input('mt', $block_id, $mt) ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('mb') ?>">
					<?php _e('Margin Bottom', 'bmd'); ?><br/>
					<?php echo aq_field_input('mb', $block_id, $mb) ?>
				</label>
			</div>
		<?php }
		

		function block($instance) {
			$defaults = array(
				'style' => 'none',
				'mt'    => '',
				'mb'    => ''
			);
									
			$instance = wp_parse_args($instance, $defaults);
			extract($instance); 

			if ($mt == '') $mt = 0;
			if ($mb == '') $mb = 0;

			switch ($style) {

				case 'none':
					echo '<div class="clear"></div>';
					echo '<div style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"></div>';
					break;

				case 'single':
					echo '<div class="clear"></div>';
					echo '<div class="divider-single" style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"/></div>';
					break;

				case 'double':
					echo '<div class="clear"></div>';
					echo '<div class="divider-double" style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"></div>';
					break;

				case 'image':
					echo '<div class="clear"></div>';
					echo '<div class="divider-image" style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"></div>';
					break;

			}
		}
		
	}
}