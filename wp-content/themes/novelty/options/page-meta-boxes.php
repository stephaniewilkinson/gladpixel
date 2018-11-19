<?php
/*-----------------------------------------------------------------------------------*/
/* PAGE METABOX */
/*-----------------------------------------------------------------------------------*/

	add_filter ('cmb_meta_boxes', 'cmb_page_metaboxes');
	function cmb_page_metaboxes(array $meta_boxes) {
	    
		$prefix = '_page_';

		$meta_boxes[] = array(
			'id'         => 'page_metabox',
			'title'      => __('General Page Seting', 'bmd'),
			'pages'      => array( 'page' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true,
			'fields'     => array(


				array(
					'name' => __('Custom Page title (optional)' ,'bmd'),
					'desc' => '',
					'type' => 'text',
					'id'   => $prefix . 'page_title'
		        ),

				array(
					'name' => __('Full Width Revoultion Slider Shortcode' ,'bmd'),
					'desc' => '',
					'type' => 'text',
					'id'   => $prefix . 'rev_slider'
		        ),
	               
			    array(
					'name'    => __('Sidebar Template', 'bmd'),
					'desc'    => '',
					'id'      => $prefix . 'sidebar',
					'type'    => 'select',
					'options' => array(
						array('name' => 'Without Sidebar', 'value' => 'without'),
						array('name' => 'Left Sidebar', 'value' => 'left'),
						array('name' => 'Right Sidebar', 'value' => 'right'),
					),
				), 

				array(
					'name'    => __('Enable Breadcrumbs', 'bmd'),
					'id'      => $prefix . 'bread',
					'type'    => 'select',
					'options' => array(
						array('name' => 'No',  'value' => 'No'),
						array('name' => 'Yes', 'value' => 'Yes'),
					),
				), 

			),
		);

		return $meta_boxes;
	}


	
/*-----------------------------------------------------------------------------------*/
/*  POST METABOX */
/*-----------------------------------------------------------------------------------*/
	add_filter ('cmb_meta_boxes', 'cmb_post_metaboxes');
	function cmb_post_metaboxes(array $meta_boxes) {
	    
		$prefix = '_p_';

		$meta_boxes[] = array(
			'id'         => 'post_metabox',
			'title'      => __('Post Format Seting', 'bmd'),
			'pages'      => array( 'post' ),
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true,
			'fields'     => array(
	        
		        array(
					'name' => __('Video Post Format' ,'bmd'),
					'desc' => '',
					'type' => 'title',
					'id'   => $prefix . 'title_menu_seting'
		        ),

		        array(
					'name' => __('Vimeo Video ID' ,'bmd'),
					'desc' => '',
					'type' => 'text',
					'id'   => $prefix . 'vimeo_id'
		        ),

		        array(
					'name' => __('YouTube Video ID' ,'bmd'),
					'desc' => '',
					'type' => 'text',
					'id'   => $prefix . 'youtube_id'
		        ),

		        array(
					'name'    => __('Show Featured Images?', 'bmd'),
					'id'      => $prefix . 'featured',
					'type'    => 'select',
					'options' => array(
						array('name' => 'Yes', 'value' => 'Yes'),
						array('name' => 'No',  'value' => 'No'),
					),
				), 

			),
		);

		return $meta_boxes;
	}