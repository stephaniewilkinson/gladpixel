<?php
/*-----------------------------------------------------------------------------------*/
/* Sliders Revolution BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Revslider_Block')) {
	class BMD_Revslider_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name'  => 'Revolution Sliders ',
				'icons' => 'icon-picture',
				'size'  => 'span12',
			);
			
			parent::__construct('bmd_revslider_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'sliders'    => '',
				'margin_top' => ''
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			if (is_plugin_active( 'revslider/revslider.php')) {
				$slider = new RevSlider();
	    		$sliders_id = $slider->getArrSlidersShort();
    		}
			?>
			
			<h3 class="builder-block-title"><?php _e('Edit Revolution Slider', 'bmd'); ?></h3>

			<?php 
			if (!is_plugin_active( 'revslider/revslider.php')) {
				echo '<div class="alert">';
				echo __('Sorry, this block requires the <strong>Slider Revolution</strong> plugin to be installed & activated. Please install/activate the plugin before using this block', 'bmd');
				echo '</div>';
				return false;
			}

			if (empty($sliders_id)) {
				echo '<div class="alert">';
				echo __('You do not currently have any Slider Revolution setup. Please create a Setup Slider Revolution before setting up this block','bmd');
				echo '<br/>';
				echo '<a href="' . admin_url() . '?page=revslider" title="Setup Slider Revolution">'. __('Setup Slider Revolution', 'bmd') . '</a>';
				echo '</div>';
				return false;
			}
			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('sliders') ?>">
					<?php _e('Select Slider', 'bmd'); ?><br/>
					<?php echo aq_field_select('sliders', $block_id, $sliders_id, $sliders) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('margin_top') ?>">
					<?php _e('Margin Top', 'bmd'); ?><br/>
					<?php echo aq_field_input('margin_top', $block_id, $margin_top) ?>
				</label>
			</p>
		<?php }
		
		function block($instance) {
			extract($instance);

			if ($margin_top) echo '<div style="margin-top:' . $margin_top . 'px">';
			putRevSlider($sliders);
			if ($margin_top) echo '</div>';
		}
		
	}
}