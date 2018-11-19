<?php
/*-----------------------------------------------------------------------------------*/
/* TABS & TOGGLE & ACCORDION
/*-----------------------------------------------------------------------------------*/
if(!class_exists('BMD_Toggle_Block')) {
	class BMD_Toggle_Block extends AQ_Block {
	

		function __construct() {
			$block_options = array(
				'name'  => 'Tabs &amp; Toggles',
				'size'  => 'span4',
				'icons' =>'icon-reorder',
			);
			
			parent::__construct('bmd_toggle_block', $block_options);
			add_action('wp_ajax_aq_block_toggle_add_new', array($this, 'add_toggle'));
		}

		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'toggles' => array(
					1 => array(
						'title'   => 'New Tab',
						'icon'    => '',
						'content' => 'Tab contents',
					)
				),
				'type'	  => 'tab',
				'heading' => 'h3',
				'text' => ''
			);

			$toggle_types = array(
				'tab'       => 'Tabs',
				'toggle'    => 'Toggles',
				'accordion' => 'Accordion'
			); 

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);			
			?>

			<h3 class="builder-block-title"><?php _e('Edit Toogle / Tab / Accordion', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)', 'dmd'); ?>
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
				<label for="<?php echo $this->get_field_id('text') ?>">
					<?php _e('Content (optional)', 'dmd'); ?>
					<?php echo aq_field_textarea('text', $block_id, $text) ?>
				</label>
			</p>

			<div class="clear"></div>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$toogles = is_array($toggles) ? $toggles : $defaults['toggles'];
					$count = 1;
					foreach($toggles as $toggle) {	
						$this->toggle($toggle, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="toggle" class="aq-sortable-add-new button"><?php _e('Add New', 'bmd'); ?></a>
				<p></p>
			</div>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					<?php _e('Tabs style', 'bmd'); ?><br/>
					<?php echo aq_field_select('type', $block_id, $toggle_types, $type) ?>
				</label>
			</p>


		<?php }

		
		function toggle($toggle = array(), $count = 0) {?>

			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $toggle['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#"><?php _e('Open / Close', 'bmd'); ?></a>
					</div>
				</div>
				
				<div class="sortable-body">

					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('toggles') ?>-<?php echo $count ?>-title">
							<?php _e('Tab Title', 'bmd'); ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('toggles') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('toggles') ?>[<?php echo $count ?>][title]" value="<?php echo $toggle['title'] ?>" />
						</label>
					</p>

					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('toggles') ?>-<?php echo $count ?>-icon">
							<?php _e('Icon class (optional) - ', 'bmd'); ?><a href="http://fortawesome.github.com/Font-Awesome/" target="_blank"><?php _e('refer here', 'bmd'); ?></a><br/>
							<input type="text" id="<?php echo $this->get_field_id('toggles') ?>-<?php echo $count ?>-icon" class="input-full" name="<?php echo $this->get_field_name('toggles') ?>[<?php echo $count ?>][icon]" value="<?php echo $toggle['icon'] ?>" />
						</label>
					</p>

					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('toggles') ?>-<?php echo $count ?>-content">
							<?php _e('Tab Content', 'bmd'); ?><br/>
							<textarea id="<?php echo $this->get_field_id('toggles') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('toggles') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $toggle['content'] ?></textarea>
						</label>
					</p>

					<p class="tab-desc description"><a href="#" class="sortable-delete"><?php _e('Delete', 'bmd'); ?></a></p>

				</div>
				
			</li>
		<?php }
		

		function block($instance) {
			extract($instance);
	
			wp_enqueue_script('jquery-ui-tabs');

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}

			echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
			
			switch ($type) {

				case 'tab':
					wp_enqueue_script('tabs');
					echo '<div class="tab-block">';

						echo '<ul class="tab-nav clearfix">';
							$i = 1;
							foreach ($toggles as $toggle) {

								$toggle_selected = $i == 1 ? 'ui-tabs-active' : '';
								$icon ='';
								if ($toggle['icon']) $icon = '<i class="' . $toggle['icon'] . '"></i>';

								echo '<li class="' . $toggle_selected . '"><a href="#tab-' . sanitize_title( $toggle['title'] ) . $i .'">' . $icon . ' ' . $toggle['title'] . '</a></li>';
								$i++;
							}
						
						echo '</ul>';

						echo '<div class="clear"></div>';
						
						$i = 1;
						foreach ($toggles as $toggle) {
							echo '<div id="tab-' . sanitize_title( $toggle['title'] ) . $i . '" class="tab-content">' . wpautop(do_shortcode(htmlspecialchars_decode($toggle['content']))) . '</div>';
							$i++;
						}
				
					echo '</div>';
					break;


				case 'toggle':
					wp_enqueue_script('toogle');
					echo '<div class="toggles-wrapper">';
				
						foreach( $toggles as $toggle ){

							$icon = '';
							if ($toggle['icon']) $icon = '<i class="' . $toggle['icon'] . '"></i>';

							echo '<div class="toggle-block">';
								echo '<p class="tab-head">' . $icon . ' ' . $toggle['title'] . '</p>';
								echo '<div class="arrow"><i class="icon-plus"></i></div>';
								echo '<div class="tab-body close">';
									echo wpautop(do_shortcode(htmlspecialchars_decode($toggle['content'])));
								echo '</div>';
							echo '</div>';

						}
					
					echo '</div>';
					break;


				case 'accordion':
					wp_enqueue_script('accordion');
					$count = count($toggles);
					$i = 1;
						
					echo '<div class="accordion-wrapper">';
						
						foreach ($toggles as $toggle) {

							$icon = '';
							if ($toggle['icon']) $icon = '<i class="' . $toggle['icon'] . '"></i>';

							$open = $i == 1 ? 'open' : 'close';
							$active = $i == 1 ? 'active' : '';
							$i++;

							echo '<div class="accordion-block">';
								echo '<p class="tab-head ' . $active . '">' . $icon . ' ' . $toggle['title'] . '</p>';
								echo '<div class="arrow"><i></i></div>';
								echo '<div class="tab-body ' . $open . '">';
									echo wpautop(do_shortcode(htmlspecialchars_decode($toggle['content'])));
								echo '</div>';
							echo '</div>';
						}
						
					echo '</div>';
					break;
				
			}
			
		}

		
		function add_toggle() {
			$nonce = $_POST['security'];	
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce')) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			$toggle = array(
				'title'   => 'New Tab',
				'icon'    => '',
				'content' => ''
			);
			
			if ($count) {
				$this->toggle($toggle, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		

		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}

	}
}
