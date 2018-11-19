<?php
/*-----------------------------------------------------------------------------------*/
/* GENARAL OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('General Option', 'bmd'),
					"type" => "heading", 
					"icon" => "icon-home"
				);

$of_options[] = array(   
					"name" => __('Page Layout', 'bmd'),
					"desc" => __('Select the page layout type. Boxed or wide layout?', 'bmd'),
					"id"   => "layout",
					"std"  => 1,
					"on"   => "Wide",
					"off"  => "Boxed",
					"type" => "switch"
        		);

$of_options[] = array(   
					"name" => __('Enable Responsive', 'bmd'),
					"desc" => __('Enable/Disable the responsive/adaptive behaviour of the theme', 'bmd'),
					"id"   => "adaptive",
					"std"  => 1,
					"type" => "switch"
        		);  


$of_options[] = array(   
					"name" => __('Enable "Back To Top" Link', 'bmd'),
					"desc" => '',
					"id"   => "back_to_top",
					"std"  => 1,
					"type" => "switch"
        		);  


/*-----------------------------------------------------------------------------------*/
/* FAVICON
/*-----------------------------------------------------------------------------------*/
	$of_options[] = array( 
						"name" => __('Custom Favicon', 'bmd'),
						"desc" => __('Upload a 16px x 16px Png/Gif image that will represent your websites favicon.', 'bmd'),
						"id"   => "favicon",
						"std"  => "",
						"type" => "upload"
					);

	$of_options[] = array( 
						"name" => __('Apple iPhone Icon Upload', 'bmd'),
						"desc" => __('Icon for Apple iPhone (57px x 57px)', 'bmd'),
						"id"   => "iphone_icon",
						"std"  => "",
						"type" => "upload"
					);

	$of_options[] = array( 
						"name" => __('Apple iPhone Retina Icon Upload', 'bmd'),
						"desc" => __('Icon for Apple iPhone Retina Version (114px x 114px)', 'bmd'),
						"id"   => "iphone_icon_retina",
						"std"  => "",
						"type" => "upload"
					);

	$of_options[] = array( 
						"name" => __('Apple iPad Icon Upload', 'bmd'),
						"desc" => __('Icon for Apple iPhone (72px x 72px)', 'bmd'),
						"id"   => "ipad_icon",
						"std"  => "",
						"type" => "upload"
					);

	$of_options[] = array( 
						"name" => __('Apple iPad Retina Icon Upload', 'bmd'),
						"desc" => __('Icon for Apple iPad Retina Version (144px x 144px)', 'bmd'),
						"id"   => "ipad_icon_retina",
						"std"  => "",
						"type" => "upload"
					);




$of_options[] = array( 
					"name" => __('Tracking Code', 'bmd'),
					"desc" => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. This should be something like <br><br>&lt;script type=&quot;text/javascript&quot;&gt;<br> ... <br>&lt;/script&gt;', 'bmd'),
					"id"   => "tracking_code",
					"std"  => "",
					"type" => "textarea" 
				);   

$of_options[] = array( 
					"name" => __('Custom Style', 'bmd'),
					"desc" => __('You can write here your custom css, that will replace the default css.', 'bmd'),
					"id"   => "custom_style",
					"std"  => "",
					"type" => "textarea" 
				); 