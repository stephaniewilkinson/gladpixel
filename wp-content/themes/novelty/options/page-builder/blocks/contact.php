<?php
/*-----------------------------------------------------------------------------------*/
/* CONTACT FORM BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Contact_Block')) {
	class BMD_Contact_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array (
				'name'  => 'Contact Form',
				'size'  => 'span6',
				'icons' => 'icon-envelope-alt',
			);
			
			parent::__construct('bmd_contact_block', $block_options);
		}
		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'form_id' => 0,
				'heading' => 'h3',
				'content' => ''
			);

			if (!is_plugin_active( 'contact-form-7/wp-contact-form-7.php')) {
				echo __('Sorry, this block requires the <a href="http://wordpress.org/extend/plugins/contact-form-7/">Contact Form 7</a> plugin to be installed & activated. Please install/activate the plugin before using this block', 'bmd');
				return false;
			}
			
			$args = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			);
			$contact_forms = get_posts($args);

			if (empty($contact_forms)) {
				echo __('You do not currently have any contact form setup. Please create a contact form before setting up this block','bmd');
				echo '<br/>';
				echo '<a href="' . admin_url() . '?page=wpcf7" title="Setup contact form">'. __('Setup contact form', 'bmd') . '</a>';
				return false;
			}

			$form_ids = array();
			foreach ($contact_forms as $form) {
				$form_ids[$form->ID] = strip_tags($form->post_title);
			}

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Contact Form', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)', 'bmd'); ?>
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
				<label for="<?php echo $this->get_field_id('form_id') ?>">
					<?php _e('Choose contact form', 'bmd'); ?><br/>
					<?php echo aq_field_select('form_id', $block_id, $form_ids, $form_id); ?>
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
			echo do_shortcode('[contact-form-7 id="' . $form_id . '" title="' . $title . '"]');
		}
		
	}
}


