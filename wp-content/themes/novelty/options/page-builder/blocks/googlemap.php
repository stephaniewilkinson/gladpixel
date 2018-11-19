<?php
/*-----------------------------------------------------------------------------------*/
/* GOOGLE MAP BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Googlemap_Block')) {
	class BMD_Googlemap_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Google Map',
				'size'  => 'span12',
				'icons' => 'icon-map-marker',
			);
			
			parent::__construct('bmd_googlemap_block', $block_options);
		}

		function form($instance) {
			global $heading_size;
			
			$defaults = array(
				'height'      => 500,
				'zoom'        => 15,
				'heading'     => 'h3',
				'address'     => '',
				'coordinates' => '',
				'shadow'      => '',
				'margin_top'  => ''
			);

			$show = array(
				'shadow' => 'Yes',
				''       => 'No',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance); 
			?>

			<h3 class="builder-block-title"><?php _e('Edit Google Map', 'bmd'); ?></h3>

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
				<label for="<?php echo $this->get_field_id('address') ?>">
					<?php _e('Address', 'bmd'); ?><br/>
					<?php echo aq_field_input('address', $block_id, $address) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('coordinates') ?>">
					<?php _e('Coordinates (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_input('coordinates', $block_id, $coordinates) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('zoom') ?>">
					<?php _e('Zoom Level', 'bmd'); ?><br/>
					<?php echo aq_field_input('zoom', $block_id, $zoom) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					<?php _e('Map Height (in pixels)', 'bmd'); ?><br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('shadow') ?>">
					<?php _e('Show Shadow', 'bmd'); ?><br/>
					<?php echo aq_field_select('shadow', $block_id, $show, $shadow) ?>
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
			$defaults = array(
				'height' => 500,
				'zoom'   => 15,
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			wp_enqueue_script('googlemaps');
			wp_enqueue_script('googlemap');

			if (!$address) {
				_e('Address was not specified', 'bmd');
				return false;
			}

			if (isset($margin_top)) {
				$margintop = $margin_top;
			} else {
				$margintop = 0;
			}
			
			if (!$coordinates) {
				$coordinates = aq_get_map_coordinates($address);
				if (is_array($coordinates)) {
					$coordinates = $coordinates['lat'] . ',' . $coordinates['lng'];
				} else {
					echo $coordinates;
					return false;
				}
			}

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}
			
			echo '<div id="map_canvas_' . rand(1, 100) . '" class="flexible-map ' . $shadow . '" style="height:' . $height . 'px; margin-top:' . $margintop . 'px;">';
				echo (!empty($title)) ? '<input class="title" type="hidden" value="' . $title . '" />' : '';
				echo '<input class="location" type="hidden" value="' . $address . '" />';
				echo '<input class="coordinates" type="hidden" value="' . $coordinates . '" />';
				echo '<input class="zoom" type="hidden" value="' . $zoom . '" />';
				echo '<div class="map_canvas"></div>';
			echo '</div>';
		}

	}
}