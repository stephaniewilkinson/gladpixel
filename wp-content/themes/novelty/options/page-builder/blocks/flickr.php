<?php
/*-----------------------------------------------------------------------------------*/
/* FLICKR BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Flickr_Block')) {
	class BMD_Flickr_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name'  => 'Flickr',
				'size'  => 'span4',
				'icons' => 'icon-th-large',
			);

			parent::__construct('bmd_flickr_block', $block_options);
		}

		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading' => 'h3',
				'num'     => 6,
				'user'    => ''
			);
	
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Flickr', 'bmd'); ?></h3>

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
				<label for="<?php echo $this->get_field_id('user') ?>">
					<?php _e('Your Flickr User ID: (Don\'t know your ID? Head on over to <a href="http://idgettr.com">idgettr</a> to find it)', 'bmd'); ?>
					<?php echo aq_field_input('user', $block_id, $user, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('num') ?>">
					<?php _e('Number of Photos', 'bmd'); ?><br/>
					<?php echo aq_field_input('num', $block_id, $num, $size = 'full') ?>
				</label>
			</p>
		<?php }

		function block($instance) {
			extract($instance);

			wp_enqueue_script('jflickrfeed');
			$rand = rand(1,100);

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}

			echo '<ul id="flickr-' . $rand . '" class="flickr-widget clearfix"></ul>';
			?>
			
	        <script type="text/javascript">
	            jQuery(document).ready(function($){
				    $('#flickr-<?php echo $rand ?>').jflickrfeed({
						limit       : <?php print $num; ?>,
						qstrings    : { id: '<?php echo $user; ?>' },
						itemTemplate: '<li>'+
										'<a rel="prettyPhoto[flickr]" href="{{image}}" title="{{title}}">' +
											'<img src="{{image_m}}" alt="{{title}}" />' + '<i class="icon-plus-sign"></i>' +
										'</a>' +
									  '</li>'
					}, function(data) {
						$("a[rel^='prettyPhoto']").prettyPhoto();
					});
				});
			</script>
		<?php }

	}
}