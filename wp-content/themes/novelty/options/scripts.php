<?php
/*-----------------------------------------------------------------------------------*/
/* Register and load common JS
/*-----------------------------------------------------------------------------------*/
    function bmd_register_js() {
        if (!is_admin()) {
           
            wp_enqueue_script('jquery');		

            wp_deregister_script('respond');
            wp_register_script('respond', BMD_PATH . '/js/respond.js', array('jquery'), '', true);
            wp_enqueue_script('respond');

            wp_deregister_script('selectivizr');
            wp_register_script('selectivizr', BMD_PATH . '/js/selectivizr-min.js', array('jquery'), '', true);
            wp_enqueue_script('selectivizr');

            wp_deregister_script('superfish');
            wp_register_script('superfish', BMD_PATH . '/js/superfish.js', array('jquery'), '', true);
            wp_enqueue_script('superfish');

            wp_deregister_script('hoverIntent');
            wp_register_script('hoverIntent', BMD_PATH . '/js/hoverIntent.js', array('jquery'), '', true);
            wp_enqueue_script('hoverIntent');

            wp_deregister_script('cookie');
            wp_register_script('cookie', BMD_PATH . '/js/cookie.js', array('jquery'), '', true);
            wp_enqueue_script('cookie');

            wp_deregister_script('prettyPhoto');
            wp_register_script('prettyPhoto', BMD_PATH . '/js/prettyPhoto.js', array('jquery'), '', true);

            wp_deregister_script('tipsy');
            wp_register_script('tipsy', BMD_PATH . '/js/tipsy.js', array('jquery'), '', true);

            wp_deregister_script('flexslider');
            wp_register_script('flexslider', BMD_PATH . '/js/flexslider-min.js', array('jquery'), '', true);

            wp_deregister_script('tweet');
            wp_register_script('tweet', BMD_PATH . '/js/tweet.js', array('jquery'), '', true);

            wp_deregister_script('isotope');
            wp_register_script('isotope', BMD_PATH . '/js/isotope.min.js', array('jquery'), '', true);

            wp_deregister_script('portfolio');
            wp_register_script('portfolio', BMD_PATH . '/js/portfolio.js', array('jquery'), '', true);

            wp_deregister_script('jflickrfeed');
            wp_register_script('jflickrfeed', BMD_PATH . '/js/jflickrfeed.min.js', array('jquery'), '', true);

            wp_deregister_script('googlemaps');
            wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '', true);

            wp_deregister_script('googlemap');
            wp_register_script('googlemap', BMD_PATH . '/js/googlemap.js', array('jquery'), '', true);

            wp_deregister_script('accordion');
            wp_register_script('accordion', BMD_PATH . '/js/accordion.js', array('jquery'), '', true);

            wp_deregister_script('toogle');
            wp_register_script('toogle', BMD_PATH . '/js/toogle.js', array('jquery'), '', true);

            wp_deregister_script('tabs');
            wp_register_script('tabs', BMD_PATH . '/js/tabs.js', array('jquery'), '', true);

            wp_deregister_script('gototop');
            wp_register_script('gototop', BMD_PATH . '/js/gototop.js', array('jquery'), '',true );
            wp_enqueue_script('gototop');

            wp_deregister_script('main');
            wp_register_script('main', BMD_PATH . '/js/main.js', array('jquery'), '',true );
            wp_enqueue_script('main');

        }
    }    
    add_action('init', 'bmd_register_js');


/*-----------------------------------------------------------------------------------*/
/* Comments Reply Script
/*-----------------------------------------------------------------------------------*/
    add_action('template_redirect', 'comment_reply_print_scripts');
    function comment_reply_print_scripts() {
        if (is_singular()) wp_enqueue_script('comment-reply');
    }



/*-----------------------------------------------------------------------------------*/
/* Register and load common CSS 
/*-----------------------------------------------------------------------------------*/
    function bmd_register_css() {
        global $smof_data;

       if (is_admin()) {
            wp_enqueue_style('bmd_style', BMD_PATH.'/options/assets/css/style.css', false, '1.0', 'all');
            wp_enqueue_style('icon_style', BMD_PATH.'/options/assets/css/icon.css', false, '1.0', 'all');
            
        } else {
            wp_enqueue_style('theme-style', get_bloginfo( 'stylesheet_url' ), array(), '20130312' );
            wp_enqueue_style('custom-style', BMD_PATH.'/custom-style.css', false, '1.0', 'all');
            wp_enqueue_style('column', BMD_PATH.'/css/column.css', false, '1.0', 'all');

            if ($smof_data['adaptive'] == 1)
                wp_enqueue_style('adaptive', BMD_PATH.'/css/adaptive.css', false, '1.0', 'all');

        }
    }
    add_action('init', 'bmd_register_css');