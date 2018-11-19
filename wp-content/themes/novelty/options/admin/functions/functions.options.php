<?php
add_action('init','of_options');
if (!function_exists('of_options')){
	function of_options(){
	  
		global $of_options;
		$of_options = array();

		$image = BMD_PATH . '/options/assets/images/';

		require_once( BMD_ADMIN_OPTIONS . 'general.php' );
		require_once( BMD_ADMIN_OPTIONS . 'header.php' );
		require_once( BMD_ADMIN_OPTIONS . 'portfolio.php' );
		require_once( BMD_ADMIN_OPTIONS . 'blog.php' );
		require_once( BMD_ADMIN_OPTIONS . 'page.php' );  
		require_once( BMD_ADMIN_OPTIONS . 'social.php' );
		require_once( BMD_ADMIN_OPTIONS . '404.php' );
		require_once( BMD_ADMIN_OPTIONS . 'footer.php' );     
		require_once( BMD_ADMIN_OPTIONS . 'backup.php' );       
						
	}
}