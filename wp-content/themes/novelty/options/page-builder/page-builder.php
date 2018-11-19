<?php
if (class_exists('AQ_Page_Builder')) {

	/* INCLUDE THE BLOCK FILES */
	require_once( BMD_BUILDER_PATH . 'column.php');
	require_once( BMD_BUILDER_PATH . 'portfolio.php');
	require_once( BMD_BUILDER_PATH . 'blog.php');
	require_once( BMD_BUILDER_PATH . 'latestblog.php');
	require_once( BMD_BUILDER_PATH . 'slogan.php');
	require_once( BMD_BUILDER_PATH . 'clear.php');
	require_once( BMD_BUILDER_PATH . 'text.php');
	require_once( BMD_BUILDER_PATH . 'slider.php');
	require_once( BMD_BUILDER_PATH . 'googlemap.php');
	require_once( BMD_BUILDER_PATH . 'contact.php');
	require_once( BMD_BUILDER_PATH . 'features.php');
	require_once( BMD_BUILDER_PATH . 'toggle.php');
	require_once( BMD_BUILDER_PATH . 'video.php');
	require_once( BMD_BUILDER_PATH . 'image.php');
	require_once( BMD_BUILDER_PATH . 'twitter.php');
	require_once( BMD_BUILDER_PATH . 'flickr.php');
	require_once( BMD_BUILDER_PATH . 'alert.php');
	require_once( BMD_BUILDER_PATH . 'clients.php');
	require_once( BMD_BUILDER_PATH . 'social.php');
	require_once( BMD_BUILDER_PATH . 'sitemap.php');
	require_once( BMD_BUILDER_PATH . 'testimonials.php');
	require_once( BMD_BUILDER_PATH . 'revslider.php');
	require_once( BMD_BUILDER_PATH . 'title.php');
	require_once( BMD_BUILDER_PATH . 'team.php');
	require_once( BMD_BUILDER_PATH . 'pricetable.php');


	/* REGISTER THE BLOCK */
	aq_register_block('BMD_Column_Block');
	aq_register_block('BMD_Text_Block');
	aq_register_block('BMD_Revslider_Block');
	aq_register_block('BMD_Features_Block');
	aq_register_block('BMD_Clear_Block');
	aq_register_block('BMD_Portfolio_Block');
	aq_register_block('BMD_Blog_Block');
	aq_register_block('BMD_Latestblog_Block');
	aq_register_block('BMD_Slogan_Block');
	aq_register_block('BMD_Title_Block');
	aq_register_block('BMD_Slider_Block');
	aq_register_block('BMD_Toggle_Block');
	aq_register_block('BMD_Video_Block');
	aq_register_block('BMD_Image_Block');
	aq_register_block('BMD_Twitter_Block');
	aq_register_block('BMD_Flickr_Block');
	aq_register_block('BMD_Alert_Block');
	aq_register_block('BMD_Client_Block');
	aq_register_block('BMD_Social_Block');
	aq_register_block('BMD_Sitemap_Block');
	aq_register_block('BMD_Testimonials_Block');
	aq_register_block('BMD_Contact_Block');
	aq_register_block('BMD_Googlemap_Block');
	aq_register_block('BMD_Team_Block');
	aq_register_block('BMD_Pricetable_Block');


	$heading_size = array(
		'h1' => 'H1',
		'h2' => 'H2',
		'h3' => 'H3',
		'h4' => 'H4',
		'h5' => 'H5',
		'h6' => 'H6',
	);


	if (is_admin()) add_action('aq-page-builder-admin-enqueue', 'aqpb_custom_admin_js');
	function aqpb_custom_admin_js() {
		wp_register_style('aqpb-custom-admin-css',  BMD_PATH . '/options/page-builder/css/aqpb-custom-admin.css', array(), time(), 'all');
		wp_enqueue_style('aqpb-custom-admin-css');
	}

}