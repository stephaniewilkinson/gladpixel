<?php
/*-----------------------------------------------------------------------------------*/
/* BLOG */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('Single Blog Post' , 'bmd'),
					"type" => "heading",
					"icon" => "icon-book"
				); 



$of_options[] = array( 
					"name"    => __('Blog Post Single Sidebar' , 'bmd'),
					"id"      => "blog_single_sidebar",
					"std"     => "right",
					"type"    => "images",
					"options" => array(
										'left'    => $image . 'left-sidebar.png',
										'without' => $image . 'no-sidebar.png',
										'right'   => $image . 'right-sidebar.png'
									)
				);


$of_options[] = array(   
					"name" => "Enable Breadcrumbs",
					"id"   => "single_blog_bread",
					"std"  => 0,
					"type" => "switch"
        		);  


$of_options[] = array(   
					"name" => "Show Categories",
					"id"   => "single_blog_cat",
					"std"  => 0,
					"type" => "switch"
        		);  

$of_options[] = array(   
					"name" => "Show Date",
					"id"   => "single_blog_date",
					"std"  => 0,
					"type" => "switch"
        		);  

$of_options[] = array(   
					"name" => "Show Comments",
					"id"   => "single_blog_comm",
					"std"  => 0,
					"type" => "switch"
        		);  