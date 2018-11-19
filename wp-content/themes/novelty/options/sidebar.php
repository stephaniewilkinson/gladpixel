<?php
/*-----------------------------------------------------------------------------------*/
/* Register the theme's widget areas
/*-----------------------------------------------------------------------------------*/
    global $smof_data;

    if (function_exists('register_sidebar')) {
        
        register_sidebar(array(
            'name'          => __('Primary Sidebar' , 'bmd'),
            'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="page-title clearfix"><h3>',
            'after_title'   => '</h3></div>'
    	));  	




        switch ($smof_data['footer_col']) {

            case "footer1":
            	register_sidebar(array(
                    'name'          => __('Footer Area 1' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
            	));
                
               	register_sidebar(array(
                    'name'          => __('Footer Area 2' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
            	));
                
               	register_sidebar(array(
                    'name'          => __('Footer Area 3' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
            	));
                
               	register_sidebar(array(
                    'name'          => __('Footer Area 4' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
            	));
                break;

            case "footer2":
            case "footer5":
            case "footer6":
                register_sidebar(array(
                    'name'          => __('Footer Area 1' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ));
                
                register_sidebar(array(
                    'name'          => __('Footer Area 2' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ));
                
                register_sidebar(array(
                    'name'          => __('Footer Area 3' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ));
                break;

            case "footer3":
            case "footer7":
            case "footer8":
                register_sidebar(array(
                    'name'          => __('Footer Area 1' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ));
                
                register_sidebar(array(
                    'name'          => __('Footer Area 2' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ));
                break;

            case "footer4":
                register_sidebar(array(
                    'name'          => __('Footer Area 1' , 'bmd'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3>',
                    'after_title'   => '</h3>'
                ));
                break;

       }
    }    
