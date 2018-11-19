<?php
/*-----------------------------------------------------------------------------------*/
/* TEAM BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Team_Block')) {
	class BMD_Team_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Team',
				'size'  => 'span3',
				'icons' => 'icon-star',
			);
			
			parent::__construct('bmd_team_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'description'   => '',
				'img'           => '',
				'user_name'     => '',
				'team_function' => '',
				'social'        => '',
				'height'        => '250px'

			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Team', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('user_name') ?>">
					<?php _e('Name', 'bmd'); ?><br/>
					<?php echo aq_field_input('user_name', $block_id, $user_name) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('img') ?>">
					<?php _e('Upload an image', 'bmd'); ?><br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<div class="clear"></div>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('team_function') ?>">
					<?php _e('Teams Function', 'bmd'); ?><br/>
					<?php echo aq_field_input('team_function', $block_id, $team_function) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('description') ?>">
					<?php _e('Description', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('description', $block_id, $description) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('social') ?>">
					<?php _e('Social HTML code', 'bmd'); ?><br/>
					<?php echo aq_field_textarea('social', $block_id, $social) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					<?php _e('Image Hiegt', 'bmd'); ?><br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>

		<?php }
		
		function block($instance) {
			$defaults = array(
				'description'   => '',
				'img'           => '',
				'user_name'     => '',
				'team_function' => '',
				'social'        => '',
				'height'        => '250px'

			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$width = aq_get_column_width($size);
			$image = aq_resize($img, $width, $height, true);

			echo '<div class="team">';
				echo '<img width="' . $width . '" height="' . $height . '" src="' . $image . '" />';
				echo '<h3>' . $user_name . '</h3>';
				echo '<p class="team-function">' . $team_function . '</p>';
				echo wpautop(do_shortcode(htmlspecialchars_decode($description)));
				echo '<div class="team-social">';
				echo wpautop(do_shortcode(htmlspecialchars_decode($social)));
				echo '</div>';
			echo '</div>';

		}
		
	}
}