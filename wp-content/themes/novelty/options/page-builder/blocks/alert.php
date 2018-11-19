<?php
/*-----------------------------------------------------------------------------------*/
/* ALLERT BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Alert_Block')) {
	class BMD_Alert_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Alert',
				'icons' => 'icon-bell-alt',
				'size'  => 'span6',
			);

			parent::__construct('bmd_alert_block', $block_options);
		}
		
		function form($instance) {
			global $heading_size;

			$default = array(
				'mt'      => '-30',
				'mb'      => '30',
				'content' => '',
				'icon'    => '',
				'style'   => '',
			);

			$alert_options = array(
				'default' => 'Standard',
				'info'    => 'Info',
				'note'    => 'Notification',
				'warning' => 'Warning',
				'tips'    => 'Tips',
			);

			$instance = wp_parse_args($instance, $default);
			extract($instance);
			?>
			
			<h3 class="builder-block-title"><?php _e('Edit Alert', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)', 'bmd'); ?><br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					<?php _e('Alert text', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('icon') ?>">
					<?php _e('Icon class (optional) - ', 'bmd'); ?><a href="http://fortawesome.github.com/Font-Awesome/" target="_blank"><?php _e('refer here', 'bmd'); ?></a><br/>
					<?php echo aq_field_input('icon', $block_id, $icon, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('style') ?>">
					<?php _e('Style', 'bmd'); ?><br/>
					<?php echo aq_field_select('style', $block_id, $alert_options, $style) ?>
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
			$default = array(
				'mt'      => '-30',
				'mb'      => '30',
				'content' => '',
				'icon'    => '',
				'style'   => '',

			);
			$instance = wp_parse_args($instance, $default);
			extract($instance);

			if ($mt == '') $mt = 0;
			if ($mb == '') $mb = 0;

			if ($icon) $icon = '<i class="' . $icon . '"></i>';		
			if ($title) $title = '<strong>' . $title . '</strong>';

			echo '<div style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px" class="alert ' . $style . '">';
				echo $icon;
				echo '<div class="alert-content">';
					echo $title, $content; 
				echo '</div>';
			echo '</div>';
		}

	}
}