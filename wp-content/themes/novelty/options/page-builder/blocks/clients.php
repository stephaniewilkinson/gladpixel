<?php
/*-----------------------------------------------------------------------------------*/
/* CLIENT BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Client_Block')) {
	class BMD_Client_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name'  => 'Client',
				'size'  => 'span12',
				'icons' => 'icon-group',
			);
			
			parent::__construct('bmd_client_block', $block_options);
			add_action('wp_ajax_aq_block_client_add_new', array($this, 'add_client'));
		}


		function form($instance) {
			global $heading_size;

			$defaults = array(
				'clients' => array(
					1 => array(
						'title'  => 'New client',
						'upload' => '',
						'url'    => ''
					)
				),
				'client'  => '',
				'col'     => 'span2',
				'heading' => 'h3',
			);

			$client_coll = array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6'
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Client', 'bmd'); ?></h3>

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
				<label for="<?php echo $this->get_field_id('col') ?>">
					<?php _e('Column', 'bmd'); ?><br/>
					<?php echo aq_field_select('col', $block_id, $client_coll, $col) ?>
				</label>
			</p>

			<div class="description cf">
				<ul id="sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$clients = is_array($clients) ? $clients : $defaults['clients'];
					$count = 1;
					foreach ($clients as $client) {	
						$this->client($client, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="client" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
		<?php }
		


		function client($client = array(), $count = 0) {

			$defaults = array (
				'title'   => '',
				'upload'  => '',
				'url' => '',
			);

			$client = wp_parse_args($client, $defaults); 
			?>

			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $client['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#"><?php _e('Open / Close', 'bmd'); ?></a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php echo $this->get_field_id('clients') ?>-<?php echo $count ?>-title">
							client Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('clients') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('clients') ?>[<?php echo $count ?>][title]" value="<?php echo $client['title'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('clients') ?>-<?php echo $count ?>-upload">
							Upload Image<br/>

							<input type="text" id="<?php echo $this->get_field_id('clients') ?>_<?php echo $count ?>_upload" class="input-full input-upload" value="<?php echo $client['upload'] ?>" name="<?php echo $this->get_field_name('clients') ?>[<?php echo $count ?>][upload]">
							<a href="#" class="aq_upload_button button" rel="image"><?php _e('Upload', 'bmd'); ?></a>

							<p></p>
						</label>

						<div class="clear"></div>
						<div class="screenshot">
							<img src="<?php echo $client['upload'] ?>" />
						</div>
					</p>

					<p class="description">
						<label for="<?php echo $this->get_field_id('clients') ?>-<?php echo $count ?>-url">
							Client URL<br/>
							<input type="text" id="<?php echo $this->get_field_id('clients') ?>-<?php echo $count ?>-url" class="input-full" name="<?php echo $this->get_field_name('clients') ?>[<?php echo $count ?>][url]" value="<?php echo $client['url'] ?>" />
						</label>
					</p>

					<p class="description"><a href="#" class="sortable-delete"><?php _e('Delete', 'bmd'); ?></a></p>
				</div>
				
			</li>
			<?php
		}
		

		function add_client() {

			$nonce = $_POST['security'];	
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce')) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			$client = array(
				'title'   => 'New client',
				'upload'  => '',
				'url'     => ''
			);
			
			if ($count) {
				$this->client($client, $count);
			} else {
				die(-1);
			}
			
			die();
		}

		

		function block($instance) {
			$client['url'] = '';
			extract($instance);
		
			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . strip_tags($title) . '</' . $heading . '>';
				echo '</div>';
			}

			echo '<div class="client col' . $col . ' clearfix">';

				if ($clients) {
					foreach ($clients as $i=>$client) {
						echo ' <div>';
							if ($client['url']) echo '<a href="' . $client['url'] . '">';
							echo '<img src="' . $client['upload'] . '" alt="' . strip_tags($client['title']) . '"/>';
							if ($client['url']) echo '</a>';
						echo '</div>';
					}
				}
				
			echo '</div>';
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}

	}
}