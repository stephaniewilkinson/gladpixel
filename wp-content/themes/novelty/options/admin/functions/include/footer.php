<?php
/*-----------------------------------------------------------------------------------*/
/* FOOTER OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('Footer Option' , 'bmd'),
					"type" => "heading",
					"icon" => "icon-download"
				);



$of_options[] = array( 
				"name"    => __('Footer Column' , 'bmd'),
				"id"      => "footer_col",
				"std"     => "footer1",
				"type"    => "images",
				"options" => array(
								'footer1' => $image . 'footer-1.png',
								'footer2' => $image . 'footer-2.png',
								'footer3' => $image . 'footer-3.png',
								'footer4' => $image . 'footer-4.png',
								'footer5' => $image . 'footer-5.png',
								'footer6' => $image . 'footer-6.png',
								'footer7' => $image . 'footer-7.png',
								'footer8' => $image . 'footer-8.png',
							)
			);  

$of_options[] = array(   
					"name" => "Enable Copyright Area",
					"desc" =>  __('Show / Hide copiright area', 'bmd'),
					"id"   => "copyright_enable",
					"std"  => 0,
					"type" => "switch"
        		); 
               
$of_options[] = array( 
					"name" => __('Copyright Text' , 'bmd'),
					"desc" => __('Paste your text or HTML', 'bmd'),
					"id"   => "copyright",
					"std"  => "<p>Copyright 2012. All rights reserved.</p>",
					"type" => "textarea"
				);  