<?php
/* Pricing Tables Block */
if(!class_exists('BMD_Pricetable_Block')) {
	class BMD_Pricetable_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Pricing Table',
				'size' => 'span4',
				'icons' => 'icon-credit-card'
			);
			
			parent::__construct('bmd_pricetable_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'title'       => '',
				'price'       => '',
				'timeline'    => '',
				'features'    => '',
				'button_text' => 'Sign Up',
				'button_url'  => '',
				'color'       => 'style1'
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$color_options = array (
				'style1' => 'Style 1',
				'style2' => 'Style 2',
			)
			?>

			<h3 class="builder-block-title"><?php _e('Edit Pricetable', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Package Title (required)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('price') ?>">
					Price (required)<br/>
					<?php echo aq_field_input('price', $block_id, $price) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('timeline') ?>">
					Pricing timeline (e.g. "per month")<br/>
					<?php echo aq_field_input('timeline', $block_id, $timeline) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('features') ?>">
					Features (start each feature on new line)
					<?php echo aq_field_textarea('features', $block_id, $features) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('button_text') ?>">
					Button Text<br/>
					<?php echo aq_field_input('button_text', $block_id, $button_text) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('button_url') ?>">
					Button URL<br/>
					<?php echo aq_field_input('button_url', $block_id, $button_url) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('column') ?>">
					Pricing color style<br/>
					<?php echo aq_field_select('color', $block_id, $color_options, $color); ?>
				</label>
			</p>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			$output = '<div class="pricetable-wrapper '.$color.'">';
				$output .= '<ul>';
					
					$output .= '<li class="pricetable-title">';
						$output .= '<h3>'.htmlspecialchars_decode($title).'</h3>';
					$output .= '</li>';
					
					$output .= '<li class="pricetable-price">';
						$output .= '<h3>'.htmlspecialchars_decode($price).'</h3>';
						$output .= !empty($timeline) ? '<span>'.htmlspecialchars_decode($timeline).'</span>' : '';
					$output .= '</li>';
										
					$features = !empty($features) ? explode("\n", trim($features)) : array();
					
					foreach($features as $feature) {
						$output .= '<li class="pricetable-item"><span>'.do_shortcode(htmlspecialchars_decode($feature)).'</span></li>';
					}

					if (!empty($button_text) && !empty($button_url)){
						$output .= '<li class="pricetable-button">';
							$output .= '<a href="' . $button_url . '" class="button">' . $button_text . '</a>';
						$output .= '</li>';
					}
					
				$output .= '</ul>';
			$output .= '</div>';
			
			echo $output;	
		}
		
	}
}