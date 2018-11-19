<?php
$header_style = array(
			"style1"  => "Style 1", 
			"style2"  => "Style 2",
			"style3"  => "Style 3",
			"style4"  => "Style 4",
			"style5"  => "Style 5",
			"style6"  => "Style 6",
			"style7"  => "Style 7",
			"style8"  => "Style 8",
			"style9"  => "Style 9",
			"style10" => "Style 10",
		); 


/*-----------------------------------------------------------------------------------*/
/* HEADER OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('Header Options', 'bmd'),
					"type" => "heading",
					"icon" => "icon-desktop"
				);

$of_options[] = array( 
					"name"    => __('Select Header Style' , 'bmd'),
					"std"     => "style1",
					"id"      => 'header_style',
					"type"    => "select",
					"options" => $header_style
				);

$of_options[] = array( 
					"name" => __('Upload Logo', 'bmd'),
					"desc" => __('Please choose an image file for your logo.', 'bmd'),
					"std"  => BMD_PATH . "/images/logo.png",
					"id"   => "logo",
					"type" => "upload" 
				);

$of_options[] = array( 
					"name" => __('Upload Retina Logo', 'bmd'),
					"desc" => __('Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.', 'bmd'),
					"std"  => BMD_PATH . "/images/logo2.png",
					"id"   => "logo2",
					"type" => "upload" 
				);

$of_options[] = array(
					"name" => __('Standart Logo Width For Retina Logo' , 'bmd'),
					"desc" => __('If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.', 'bmd'),
					"id"   => "logo_width",
					"std"  => "260",
					"type" => "text"
				);  

$of_options[] = array(   
					"name" => "Show Tooltip Social Icons",
					"id"   => "social_tooltip",
					"std"  => 1,
					"type" => "switch"
        		);   


$of_options[] = array(
					"name" => __('Top Area Tagline' , 'bmd'),
					"desc" => "",
					"id"   => "top_tagline",
					"std"  => "This can be your Tagline or something you want",
					"type" => "text"
				);  