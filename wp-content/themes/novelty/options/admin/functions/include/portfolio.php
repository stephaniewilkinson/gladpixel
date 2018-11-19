<?php

$portfolio_single_style = array(
	"center" => "Content Center",
	"right"  => "Content Right",
	"left"   => "Content Left"
);


/*-----------------------------------------------------------------------------------*/
/* PORTFOLIO OPTIONS */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 
					"name" => __('Portfolio Option', 'bmd'),
					"type" => "heading",
					"icon" => "icon-picture"
				);


                           
$of_options[] = array(
					"name" => __('Portfolio Slug' , 'bmd'),
					"desc" => "Enter the url slug four Portfolio",
					"id"   => "portfolio_slug",
					"std"  => "portfolio",
					"type" => "text"
				);  

$of_options[] = array( 
					"name"    => __('Select Header Style' , 'bmd'),
					"std"     => "style1",
					"id"      => 'portfolio_single_style',
					"type"    => "select",
					"options" => $portfolio_single_style
				);


$of_options[] = array(   
					"name" => "Single Prev/Next Link",
					"id"   => "portflio_single_link",
					"on"   => "Show",
					"off"  => "Hide",
					"std"  => 0,
					"type" => "switch"
        		);  


$of_options[] = array(   
					"name" => "Single Post Breadcrumbs",
					"id"   => "portflio_single_bread",
					"std"  => 0,
					"type" => "switch"
        		);  

$of_options[] = array(   
					"name" => "Single Post Shadow",
					"id"   => "portflio_single_shadow",
					"on"   => "Show",
					"off"  => "Hide",
					"std"  => 1,
					"type" => "switch"
        		);  

$of_options[] = array(
					"name" => __('Client Icon Class' , 'bmd'),
					"desc" => "Icon class - <a href='http://fortawesome.github.com/Font-Awesome/' target='_blan'>refer here</a><br/>",
					"id"   => "portfolio_client_class",
					"std"  => "icon-user",
					"type" => "text"
				);  

$of_options[] = array(
					"name" => __('URL Icon Class' , 'bmd'),
					"desc" => "Icon class - <a href='http://fortawesome.github.com/Font-Awesome/' target='_blan'>refer here</a><br/>",
					"id"   => "portfolio_url_class",
					"std"  => "icon-link",
					"type" => "text"
				);  

$of_options[] = array(
					"name" => __('Skills Icon Class' , 'bmd'),
					"desc" => "Icon class - <a href='http://fortawesome.github.com/Font-Awesome/' target='_blan'>refer here</a><br/>",
					"id"   => "portfolio_skills_class",
					"std"  => "icon-cog",
					"type" => "text"
				);  

$of_options[] = array(
					"name" => __('Year Icon Class' , 'bmd'),
					"desc" => "Icon class - <a href='http://fortawesome.github.com/Font-Awesome/' target='_blan'>refer here</a><br/>",
					"id"   => "portfolio_year_class",
					"std"  => "icon-calendar",
					"type" => "text"
				); 