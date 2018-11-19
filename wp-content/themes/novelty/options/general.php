<?php
/*-----------------------------------------------------------------------------------*/
/* GENERAL THEME SETUP
/*-----------------------------------------------------------------------------------*/
    if (!function_exists('bmd_theme_setup')) {
        function bmd_theme_setup(){

            /* Post formats */
            add_theme_support('post-formats', array('gallery', 'video', 'image'));

            /* Post thumbnails */
            if (function_exists('add_theme_support')) { 
                add_theme_support('post-thumbnails'); 
                add_image_size('portfolio-thumb', 150, 100, true);
            }

            /* Add default posts and comments RSS feed links to head */
            add_theme_support('automatic-feed-links');

            /* This theme uses wp_nav_menu() in one location */
            if (function_exists('register_nav_menus')) {  
                register_nav_menus(array(
                    'main_menu' => 'Main Menu',
                    'top_menu'  => 'Top Area Menu',
                ));
            }

            /* Localization */
            if (function_exists('load_theme_textdomain')) {
                load_theme_textdomain( 'bmd', BMD_SERVER_PATH .'/options/lang' );
            }

        }
    }
    add_action('after_setup_theme', 'bmd_theme_setup');



/*-----------------------------------------------------------------------------------*/
/* Browser Detection
/*-----------------------------------------------------------------------------------*/
    add_filter('body_class','browser_body_class');
    function browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if($is_lynx) $classes[]       = 'lynx';
        elseif($is_gecko) $classes[]  = 'gecko';
        elseif($is_opera) $classes[]  = 'opera';
        elseif($is_NS4) $classes[]    = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) $classes[]     = 'ie';
        else $classes[]               = 'unknown';
        
        if($is_iphone) $classes[]     = 'iphone';
        return $classes;
    }



/*-----------------------------------------------------------------------------------*/
/* Kriesi Pagination
/* URL: http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
/*-----------------------------------------------------------------------------------*/
    add_filter('pre_get_posts', 'query_author_archive');
    function query_author_archive($query) {
        if ($query->is_archive && $query->is_author) {
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $query->set('paged',$paged);
                return $query;
        }
        return $query;
    }

    function bmd_pagination($pages = '', $range = 2) {  
        $showitems = ($range * 2)+1;  

        global $paged;
        if (empty($paged)) $paged = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) { $pages = 1; }
        }   

        if (1 != $pages) {
            echo "<div  id='page-nav' class='container'>";
            echo "<ul>";
            if ($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
            if ($paged > 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";

            for ($i=1; $i <= $pages; $i++) {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                    echo ($paged == $i)? "<li><a href='" . get_pagenum_link($i) . "' class='inactive current' >" . $i . "</a></li>":"<li><a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a></li>";
                }
            }

            if ($paged < $pages && $showitems < $pages ) echo "<li><a href='" . get_pagenum_link($paged + 1) . "' >&rsaquo;</a></li>";  
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
            echo "</ul> \n";
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            /* echo '<span>Page ' . $paged . ' of ' . $wp_query->max_num_pages.'</span>';*/

            echo "</div>\n";
        }
    }



/*-----------------------------------------------------------------------------------*/
/* Return the array of category
/*-----------------------------------------------------------------------------------*/
    function bmd_get_category_list($id = 0, $taxonomy, $before = '', $sep = '', $after = '', $doLinks = 1) {
        $terms = get_the_terms($id, $taxonomy);
     
        if (is_wp_error($terms)) return $terms;
        if (empty($terms)) return false;
     
        foreach ($terms as $term) {
            $link = get_term_link($term, $taxonomy);
            if (is_wp_error($link)) return $link;

            if ($doLinks == 1) {
                $term_links[] = '<a href="' . $link . '" rel="tag">' . $term->name . '</a>';        
            } else {
                $term_links[] = $term->name;        
            }
        }
     
        $term_links = apply_filters("term_links-$taxonomy", $term_links);
        return $before . join($sep, $term_links) . $after;
    }

    function custom_excerpt_length($length) {
        return 200;
    }
    add_filter('excerpt_length', 'custom_excerpt_length', 999);


    function get_category_list($category_name, $parent='') {
        if (empty($parent)) { 
        
            $get_category = get_categories(array('taxonomy' => $category_name));
            $category_list = array('0' =>'All');
            
            foreach ($get_category as $category) {
                $category_list[] = $category->cat_name;
            }
                
            return $category_list;
            
        } else {
            
            $parent_id = get_term_by('name', $parent, $category_name);
            $get_category = get_categories(array('taxonomy' => $category_name, 'child_of' => isset($parent_id->term_id)));
            $category_list = array('0' => $parent);
            
            foreach ($get_category as $category) {
                $category_list[] = $category->cat_name;
            }
                
            return $category_list;      
        
        }
    }



/*-----------------------------------------------------------------------------------*/
/* Function bmd_max_charlength
/*-----------------------------------------------------------------------------------*/
    function bmd_max_charlength($charlength, $text = null) {

        if ($text) {
            $excerpt = $text;
        } else {
            $excerpt = get_the_excerpt();
        }

        $charlength++;
        if (strlen($excerpt)>$charlength) {
            $subex   = substr($excerpt,0,$charlength-5);
            $exwords = explode(" ",$subex);
            $excut   = -(strlen($exwords[count($exwords)-1]));
            if ($excut<0) {
                echo substr($subex,0,$excut);
            } else {
                echo $subex;
            }
            echo '...';
        } else {
            echo $excerpt;
        }
    }



/*-----------------------------------------------------------------------------------*/
/* Get coordinates and save as transient */
/* http://pippinsplugins.com/simple-google-maps-short-code */
/*-----------------------------------------------------------------------------------*/
function aq_get_map_coordinates($address, $force_refresh = false ) {

    $address_hash = md5( $address );
    $coordinates = get_transient( $address_hash );

    if ($force_refresh || $coordinates === false) {

        $args       = array('address' => urlencode( $address ), 'sensor' => 'false');
        $url        = add_query_arg( $args, 'http://maps.googleapis.com/maps/api/geocode/json' );
        $response   = wp_remote_get( $url );

        if( is_wp_error( $response ) )
            return;

        $data = wp_remote_retrieve_body( $response );

        if( is_wp_error( $data ) )
            return;

        if ( $response['response']['code'] == 200 ) {

            $data = json_decode( $data );

            if ( $data->status === 'OK' ) {

                $coordinates = $data->results[0]->geometry->location;

                $cache_value['lat']     = $coordinates->lat;
                $cache_value['lng']     = $coordinates->lng;
                $cache_value['address'] = (string) $data->results[0]->formatted_address;

                // cache coordinates for 3 months
                set_transient($address_hash, $cache_value, 3600*24*30*3);
                $data = $cache_value;

            } elseif ( $data->status === 'ZERO_RESULTS' ) {
                return __( 'No location found for the entered address.', 'pw-maps' );
            } elseif( $data->status === 'INVALID_REQUEST' ) {
                return __( 'Invalid request. Did you enter an address?', 'pw-maps' );
            } else {
                return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'pw-maps' );
            }

        } else {
            return __( 'Unable to contact Google API service.', 'pw-maps' );
        }

    } else {
       // return cached results
       $data = $coordinates;
    }

    return $data;
}



/*-----------------------------------------------------------------------------------*/
/* Add google font links to head
/*-----------------------------------------------------------------------------------*/
    function bmd_google_fonts_url() {
        global $customizer;
        
        $array_del = array('Arial:400', 'Arial:400:Italic', 'Arial:700', 'Arial:700:Italic', 'Verdana', 'Trebuchet', 'Georgia', 'Times', 'Tahoma', 'Palatino', 'Helvetica', '');
        $br        = "\r\n";
        $str       = array(THEME_NAME, "[", "]");
        $options   = get_option(THEME_NAME);
        $font      = array();

        foreach ($customizer as $name) :
            if ($name['type'] != 'section' && $name['style'] == 'font-family') :
                $val    = str_replace($str, '', $name['id']);
                $color  = $options[$val] ? $options[$val] : $name['default'];
                $color  = str_replace('00:', '00', $color);
                $font[] = $color;
            endif;
        endforeach;
        
        $font = array_unique($font);
        $font = array_diff($font, $array_del);

        $google_fonts = implode( '|', $font );
        $google_fonts = str_replace(' ', '+', $google_fonts); 
        $protocol = is_ssl() ? 'https' : 'http';
        
        $google_fonts =  $protocol . "://fonts.googleapis.com/css?family=" . $google_fonts . "&subset=latin,cyrillic";

        wp_enqueue_style('bmd_google_font', $google_fonts ); 
    }

    add_action('wp_enqueue_scripts', 'bmd_google_fonts_url');


/*-----------------------------------------------------------------------------------*/
/* Clean up theme check nag
/*-----------------------------------------------------------------------------------*/

    /* Content Width */
    if (!isset($content_width)) $content_width = 940;

    /* functions that we don't need in the theme */
    function cleanup_theme_check_nag() {
        next_posts_link();
        wp_link_pages();
        the_post_thumbnail();
        add_theme_support('custom-header');
        add_theme_support('custom-background');
        add_editor_style();
        if (function_exists(this_is_proof_reviewers_never_read_codes())) { echo 'lol'; }
    }