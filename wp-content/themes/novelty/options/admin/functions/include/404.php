<?php
/*-----------------------------------------------------------------------------------*/
/* 404 PAGE OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('404 Page Option', 'bmd'),
					"type" => "heading",
					"icon" => "icon-remove-sign"
				);
            
$of_options[] = array(
					"name" => __('Heading text' , 'bmd'),
					"id"   => "heading_404",
					"std"  => "404",
					"type" => "text"
				);  

$of_options[] = array(
					"name" => __('Subheading text' , 'bmd'),
					"id"   => "text_404",
					"std"  => "Oops, This Page Could Not Be Found!",
					"type" => "text"
				);  

$of_options[] = array(   
					"name" => "Show Search Form",
					"id"   => "search_404",
					"std"  => 1,
					"type" => "switch"
        		);  

$of_options[] = array(   
					"name" => "Enable Breadcrumbs",
					"id"   => "bread_404",
					"std"  => 0,
					"type" => "switch"
        		);  