<?php
/*-----------------------------------------------------------------------------------*/
/* PAGE OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('Page Options' , 'bmd'),
					"type" => "heading",
					"icon" => "icon-file-alt"
				); 



$of_options[] = array( 
					"name" 	 => __('Categories Page sidebar' , 'bmd'),
					"id"   	 => "cat_sidebar",
					"std"  	 => "right",
					"type"    => "images",
					"options" => array(
									'left'    => $image . 'left-sidebar.png',
									'without' => $image . 'no-sidebar.png',
									'right'   => $image . 'right-sidebar.png'
								)
					);

$of_options[] = array(   
					"name" => "Enable Categories Page Breadcrumbs",
					"id"   => "cat_bread",
					"std"  => 0,
					"type" => "switch"
        		);  

$of_options[] = array( 
					"name" 	 => __('Search Page sidebar' , 'bmd'),
					"id"   	 => "seach_sidebar",
					"std"  	 => "right",
					"type"    => "images",
					"options" => array(
									'left'    => $image . 'left-sidebar.png',
									'without' => $image . 'no-sidebar.png',
									'right'   => $image . 'right-sidebar.png'
								)
					);

$of_options[] = array(   
					"name" => "Enable Search Page Breadcrumbs",
					"id"   => "search_bread",
					"std"  => 0,
					"type" => "switch"
        		); 

$of_options[] = array( 
					"name" 	 => __('Archive Page sidebar' , 'bmd'),
					"id"   	 => "archive_sidebar",
					"std"  	 => "right",
					"type"   => "images",
					"options"=> array(
									'left'    => $image . 'left-sidebar.png',
									'without' => $image . 'no-sidebar.png',
									'right'   => $image . 'right-sidebar.png'
								)
					);

$of_options[] = array(   
					"name" => "Enable Archive Page Breadcrumbs",
					"id"   => "archive_bread",
					"std"  => 0,
					"type" => "switch"
        		); 


$of_options[] = array( 
					"name" 	 => __('Tag Page sidebar' , 'bmd'),
					"id"   	 => "tag_sidebar",
					"std"  	 => "right",
					"type"   => "images",
					"options" => array(
									'left'    => $image . 'left-sidebar.png',
									'without' => $image . 'no-sidebar.png',
									'right'   => $image . 'right-sidebar.png'
								)
					);

$of_options[] = array(   
					"name" => "Enable Tag Page Breadcrumbs",
					"id"   => "tag_bread",
					"std"  => 0,
					"type" => "switch"
        		); 


$of_options[] = array(
						"name" => __('Read More Text' , 'bmd'),
						"id"   => "cat_read",
						"std"  => "Continue Reading",
						"type" => "text"
					);

$of_options[] = array(
						"name" => __('Read More Icon' , 'bmd'),
						"id"   => "cat_icon",
						"std"  => "icon-double-angle-right",
						"type" => "text"
					);

$of_options[] = array(
						"name" => __('Lenght of Excerpt' , 'bmd'),
						"id"   => "cat_excerpt",
						"std"  => "350",
						"type" => "text"
					);