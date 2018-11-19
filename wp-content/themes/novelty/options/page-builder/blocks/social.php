<?php
/*-----------------------------------------------------------------------------------*/
/* Social BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Social_Block')) {
	class BMD_Social_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Social',
				'size'  => 'span4',
				'icons' => 'icon-share',
			);
			
			parent::__construct('bmd_Social_block', $block_options);
		}
		
		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading'        => 'h3',
				'twitter'        => '',
				'facebook'       => '',
				'dribbble'       => '',
				'pinterest'      => '',
				'google'         => '',
				'google_circles' => '',
				'youtube'        => '',
				'vimeo'          => '',
				'flickr'         => '',
				'instagram'      => '',
				'soundcloud'     => '',
				'linkedin'       => '',
				'github'         => '',
				'tumblr'         => '',
				'lastfm'         => '',
				'picasa'         => '',
				'spotify'        => '',
				'dropbox'        => '',
				'evernote'       => '',
				'flattr'         => '',
				'renren'         => '',
				'paypal'         => '',
				'mixi'           => '',
				'smashing'       => '',
				'behance'        => '',
				'rdio'           => '',
				'stumbleupon'    => '',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Social', 'bmd'); ?></h3>

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
				<label for="<?php echo $this->get_field_id('twitter') ?>">
					<?php _e('Enter your Twitter URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('twitter', $block_id, $twitter) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('facebook') ?>">
					<?php _e('Enter your Facebook URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('facebook', $block_id, $facebook) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('dribbble') ?>">
					<?php _e('Enter your Dribbble URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('dribbble', $block_id, $dribbble) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('pinterest') ?>">
					<?php _e('Enter your Pinterest URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('pinterest', $block_id, $pinterest) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('google') ?>">
					<?php _e('Enter your Google+ URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('google', $block_id, $google) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('google_circles') ?>">
					<?php _e('Enter your Google Circles URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('google_circles', $block_id, $google_circles) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('youtube') ?>">
					<?php _e('Enter your Youtube URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('youtube', $block_id, $youtube) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('vimeo') ?>">
					<?php _e('Enter your Vimeo URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('vimeo', $block_id, $vimeo) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('flickr') ?>">
					<?php _e('Enter your Flickr URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('flickr', $block_id, $flickr) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('instagram') ?>">
					<?php _e('Enter your Instagram URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('instagram', $block_id, $instagram) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('soundcloud') ?>">
					<?php _e('Enter your Soundcloud URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('soundcloud', $block_id, $soundcloud) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('linkedin') ?>">
					<?php _e('Enter your Linkedin URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('linkedin', $block_id, $linkedin) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('github') ?>">
					<?php _e('Enter your Github URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('github', $block_id, $github) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('tumblr') ?>">
					<?php _e('Enter your Tumblr URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('tumblr', $block_id, $tumblr) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('lastfm') ?>">
					<?php _e('Enter your Lastfm URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('lastfm', $block_id, $lastfm) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('picasa') ?>">
					<?php _e('Enter your Picasa URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('picasa', $block_id, $picasa) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('spotify') ?>">
					<?php _e('Enter your Spotify URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('spotify', $block_id, $spotify) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('dropbox') ?>">
					<?php _e('Enter your Dropbox URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('dropbox', $block_id, $dropbox) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('evernote') ?>">
					<?php _e('Enter your Evernote URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('evernote', $block_id, $evernote) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('flattr') ?>">
					<?php _e('Enter your Flattr URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('flattr', $block_id, $flattr) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('renren') ?>">
					<?php _e('Enter your Renren URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('renren', $block_id, $renren) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('paypal') ?>">
					<?php _e('Enter your Paypal URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('paypal', $block_id, $paypal) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('mixi') ?>">
					<?php _e('Enter your Mixi URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('mixi', $block_id, $mixi) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('smashing') ?>">
					<?php _e('Enter your Smashing URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('smashing', $block_id, $smashing) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('behance') ?>">
					<?php _e('Enter your Behance URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('behance', $block_id, $behance) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('rdio') ?>">
					<?php _e('Enter your Rdio URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('rdio', $block_id, $rdio) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('stumbleupon') ?>">
					<?php _e('Enter your Stumbleupon URL', 'bmd'); ?><br/>
					<?php echo aq_field_input('stumbleupon', $block_id, $stumbleupon) ?>
				</label>
			</p>

		<?php }
		

		function block($instance) {
			extract($instance);

			wp_enqueue_script('tipsy');

			if ($title) {
				echo '<div class="page-title clearfix">';
					echo '<' . $heading . '>' . $title . '</' . $heading . '>';
				echo '</div>';
			}

			echo '<ul class="social clearfix">';

				if ($twitter) 
					echo '<li><a href="' . $twitter . '" data-rel="tipsy-s" class="social-twitter" title="Twitter" target="_blank"></a></li>';

				if ($facebook) 
					echo '<li><a href="' . $facebook . '" data-rel="tipsy-s" class="social-facebook" title="Facebook" target="_blank"></a></li>';

				if ($dribbble) 
					echo '<li><a href="' . $dribbble . '" data-rel="tipsy-s" class="social-dribbble" title="Dribbble" target="_blank"></a></li>';

				if ($pinterest) 
					echo '<li><a href="' . $pinterest . '" data-rel="tipsy-s" class="social-pinterest" title="Pinterest" target="_blank"></a></li>';

				if ($google) 
					echo '<li><a href="' . $google . '" data-rel="tipsy-s" class="social-gplus" title="Google +" target="_blank"></a></li>';

				if ($google_circles) 
					echo '<li><a href="' . $google_circles . '" data-rel="tipsy-s" class="social-google-circles" title="Google Circles" target="_blank"></a></li>';

				if ($youtube) 
					echo '<li><a href="' . $youtube . '" data-rel="tipsy-s" class="social-youtube" title="Youtube" target="_blank"></a></li>';

				if ($vimeo) 
					echo '<li><a href="' . $vimeo . '" data-rel="tipsy-s" class="social-vimeo" title="Vimeo" target="_blank"></a></li>';

				if ($flickr) 
					echo '<li><a href="' . $flickr . '" data-rel="tipsy-s" class="social-flickr" title="Flickr" target="_blank"></a></li>';

				if ($instagram) 
					echo '<li><a href="' . $instagram . '" data-rel="tipsy-s" class="social-instagram" title="Instagram" target="_blank"></a></li>';

				if ($soundcloud) 
					echo '<li><a href="' . $soundcloud . '" data-rel="tipsy-s" class="social-soundcloud" title="Soundcloud" target="_blank"></a></li>';

				if ($linkedin) 
					echo '<li><a href="' . $linkedin . '" data-rel="tipsy-s" class="social-linkedin" title="Linkedin" target="_blank"></a></li>';

				if ($github) 
					echo '<li><a href="' . $github . '" data-rel="tipsy-s" class="social-github" title="Github" target="_blank"></a></li>';

				if ($tumblr) 
					echo '<li><a href="' . $tumblr . '" data-rel="tipsy-s" class="social-tumblr" title="Tumblr" target="_blank"></a></li>';

				if ($lastfm) 
					echo '<li><a href="' . $lastfm . '" data-rel="tipsy-s" class="social-lastfm" title="Lastfm" target="_blank"></a></li>';

				if ($picasa) 
					echo '<li><a href="' . $picasa . '" data-rel="tipsy-s" class="social-picasa" title="Picasa" target="_blank"></a></li>';

				if ($spotify) 
					echo '<li><a href="' . $spotify . '" data-rel="tipsy-s" class="social-spotify" title="Spotify" target="_blank"></a></li>';

				if ($dropbox) 
					echo '<li><a href="' . $dropbox . '" data-rel="tipsy-s" class="social-dropbox" title="Dropbox" target="_blank"></a></li>';

				if ($evernote) 
					echo '<li><a href="' . $evernote . '" data-rel="tipsy-s" class="social-evernote" title="Evernote" target="_blank"></a></li>';

				if ($flattr) 
					echo '<li><a href="' . $flattr . '" data-rel="tipsy-s" class="social-flattr" title="Flattr" target="_blank"></a></li>';

				if ($renren) 
					echo '<li><a href="' . $renren . '" data-rel="tipsy-s" class="social-renren" title="Renren" target="_blank"></a></li>';

				if ($paypal) 
					echo '<li><a href="' . $paypal . '" data-rel="tipsy-s" class="social-paypal" title="Paypal" target="_blank"></a></li>';

				if ($mixi) 
					echo '<li><a href="' . $mixi . '" data-rel="tipsy-s" class="social-mixi" title="Mixi" target="_blank"></a></li>';

				if ($smashing) 
					echo '<li><a href="' . $smashing . '" data-rel="tipsy-s" class="social-smashing" title="Smashing" target="_blank"></a></li>';

				if ($behance) 
					echo '<li><a href="' . $behance . '" data-rel="tipsy-s" class="social-behance" title="Behance" target="_blank"></a></li>';

				if ($rdio) 
					echo '<li><a href="' . $rdio . '" data-rel="tipsy-s" class="social-rdio" title="Rdio" target="_blank"></a></li>';

				if ($stumbleupon) 
					echo '<li><a href="' . $stumbleupon . '" data-rel="tipsy-s" class="social-stumbleupon" title="Stumbleupon" target="_blank"></a></li>';
           
            echo '</ul>';

		}

		function update($new_instance, $old_instance) {
			return $new_instance;
		}
		
	}
}