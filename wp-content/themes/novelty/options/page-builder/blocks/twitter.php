<?php
/*-----------------------------------------------------------------------------------*/
/* TWITTER BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Twitter_Block')) {
	class BMD_Twitter_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name'  => 'Twitter',
				'size'  => 'span4',
				'icons' => 'icon-twitter',
			);
			
			parent::__construct('bmd_twitter_block', $block_options);
		}

		function form($instance){
			global $heading_size;

			$defaults = array(
				'heading' => 'h3',
				'num'     => 3,
				'user'    => ''
			);
		
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Twitter', 'bmd'); ?></h3>

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
					<?php _e('User name', 'bmd'); ?><br/>
					<?php echo aq_field_input('user', $block_id, $user, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('num') ?>">
					<?php _e('Number of tweets', 'bmd'); ?><br/>
					<?php echo aq_field_input('num', $block_id, $num, $size = 'full') ?>
				</label>
			</p>
		<?php }

		function block($instance) {
			extract($instance);

			wp_enqueue_script('tweet');
			$rand = rand(1,100);

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}

			echo '<div id="twit-' . $rand . '" class="twitter-widget"></div>';
			?>

	        <script type="text/javascript">   
	        	jQuery(document).ready(function($){                        
			        $("#twit-<?php echo $rand ?>").tweet({
			        	username: "<?php echo $user; ?>",
			        	count   : <?php echo $num; ?>,
			        	template: "{text}{time}",
			        });
		        });                    
			</script>
		<?php }
		
	}
}