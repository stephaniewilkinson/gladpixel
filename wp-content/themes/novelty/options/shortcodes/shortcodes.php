<?php

/*-----------------------------------------------------------------------------------*/
/* ROW Shortcodes
/*-----------------------------------------------------------------------------------*/
    function bmd_row($atts, $content=null) {
       return '<div class="row">' . do_shortcode($content) . '</div>';
    }
    add_shortcode('row', 'bmd_row');


/*-----------------------------------------------------------------------------------*/
/* Column Shortcodes
/*-----------------------------------------------------------------------------------*/
    // Column 1
    function bmd_col_1($atts, $content=null) {
       return '<div class="span1">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_1', 'bmd_col_1');

    // Column 2
    function bmd_col_2($atts, $content=null) {
       return '<div class="span2">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_2', 'bmd_col_2');

    // Column 3
    function bmd_col_3($atts, $content=null) {
       return '<div class="span3">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_3', 'bmd_col_3');

    // Column 4
    function bmd_col_4($atts, $content=null) {
       return '<div class="span4">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_4', 'bmd_col_4');

    // Column 5
    function bmd_col_5($atts, $content=null) {
       return '<div class="span5">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_5', 'bmd_col_5');

    // Column 6
    function bmd_col_6($atts, $content=null) {
       return '<div class="span6">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_6', 'bmd_col_6');

    // Column 7
    function bmd_col_7($atts, $content=null) {
       return '<div class="span7">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_7', 'bmd_col_7');

    // Column 8
    function bmd_col_8($atts, $content=null) {
       return '<div class="span8">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_8', 'bmd_col_8');

    // Column 9
    function bmd_col_9($atts, $content=null) {
       return '<div class="span9">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_9', 'bmd_col_9');

    // Column 10
    function bmd_col_10($atts, $content=null) {
       return '<div class="span10">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_10', 'bmd_col_10');

    // Column 11
    function bmd_col_11($atts, $content=null) {
       return '<div class="span11">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_11', 'bmd_col_11');

    // Column 12
    function bmd_col_12($atts, $content=null) {
       return '<div class="span12">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
    }
    add_shortcode('col_12', 'bmd_col_12');


/*-----------------------------------------------------------------------------------*/
/* BLOCK TITLE
/*-----------------------------------------------------------------------------------*/
    function bmd_block_title( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'size' => '',
            'text' => '',
        ), $atts));

        $out = '';

        $out .= '<div class="page-title clearfix">';
            $out .= '<' . $size . '>' . $text . '</' . $size . '>';
        $out .= '</div>';

        return $out;
    }
    add_shortcode('block_title', 'bmd_block_title');


/*-----------------------------------------------------------------------------------*/
/* Alert Box
/*-----------------------------------------------------------------------------------*/
    function bmd_alert( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'style'   => '',
            'heading' => '',
            'icon'    => ''
        ), $atts));

        if ($icon) $icon = '<i class="' . $icon . '"></i>';
        if ($heading) $heading= '<strong>' . $heading . '</strong>';
        $out = '';

        $out = '<div class="alert ' . $style . '">';
            $out .=  $icon; 
            $out .= '<div class="alert-content">';
                $out .= $heading . $content; 
            $out .=  '</div>';
        $out .=  '</div>';

        return $out;
    }
    add_shortcode('alert', 'bmd_alert');


/*-----------------------------------------------------------------------------------*/
/* Button
/*-----------------------------------------------------------------------------------*/
    function bmd_button($atts, $content = null) {
        extract(shortcode_atts(array(
            'size'   => '',
            'url'    => '',
            'text'   => '',
            'target' => '',
            'icon'   => '',
        ), $atts));

        $out = '';
        if ($icon) $icon = '<i class="' . $icon . '"></i>';

        return '<a href="' . $url . '" class="button ' . $size . ' " target="' . $target . '">' . $icon . $text . ' </a>';

    }
    add_shortcode('button', 'bmd_button');


/*-----------------------------------------------------------------------------------*/
/* DIVIDER & CLEAR & SPACE
/*-----------------------------------------------------------------------------------*/
    function bmd_divider($atts, $content=null) {
        extract(shortcode_atts(array(
            'style' => '',
            'mb'    => '',
            'mt'    => ''
        ), $atts));

        if ($mt == '') $mt = 0;
        if ($mb == '') $mb = 0;

        $out = '';

        switch($style) {
            case 'none':
                $out .= '<div class="clear"></div>';
                $out .= '<div style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"></div>';
                break;

            case 'single':
                $out .= '<div class="clear"></div>';
                $out .= '<div class="divider-single" style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"/></div>';
                break;

            case 'double':
                $out .= '<div class="clear"></div>';
                $out .= '<div class="divider-double" style="margin-top: '.$mt.'px; margin-bottom: '.$mb.'px"></div>';
                break;
        }

        return $out;

    }
    add_shortcode( 'divider', 'bmd_divider' );


/*-----------------------------------------------------------------------------------*/
/* Images
/*-----------------------------------------------------------------------------------*/
    function bmd_image( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'img'      => '',
            'alt'      => '',
            'align'    => '',
            'width'    => '',
            'height'   => '',
            'lightbox' => '',
        ), $atts));

        $image = aq_resize($img, $width, $height, true);

        if ($lightbox == 'yes'){
            wp_enqueue_script('prettyPhoto');
            return '<a href="' . $img . '" rel="prettyPhoto" class="overlay align' . $align . '"><img width="' . $width . '" height="' . $height . '" src="' . $image . '" alt="' . $alt . '"/><i class="icon-plus-sign"></i></a>';
        } else {
            return '<img src="' . $image . '" class="align' . $align . '"/>';
        }

    }
    add_shortcode('image', 'bmd_image');


/*-----------------------------------------------------------------------------------*/
/* List 
/*-----------------------------------------------------------------------------------*/
    function bmd_ul( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'style'  => ''
        ), $atts));

        return '<ul class="' . $style . '">' . do_shortcode($content) . '</ul>';
    }
    add_shortcode('ul', 'bmd_ul');

    function bmd_li( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'text'  => '',
            'icon'  => '',
            'white' => ''
        ), $atts));

        if ($icon) $icon = '<i class="' . $icon . '"></i>';
        return '<li>' . $icon . $text . '</li>';
    }
    add_shortcode('li', 'bmd_li');


/*-----------------------------------------------------------------------------------*/
/* ICON
/*-----------------------------------------------------------------------------------*/
    function bmd_icon( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'size' => '',
            'class' => '',
        ), $atts));

        return '<i class="' . $class . ' icom-m" style="font-size:' . $size . '"></i>';
    }
    add_shortcode('icon', 'bmd_icon');


/*-----------------------------------------------------------------------------------*/
/* TWITTER
/*-----------------------------------------------------------------------------------*/
    function bmd_twitter( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'user' => '',
            'num' => '',
        ), $atts));

        wp_enqueue_script('tweet');
        $rand = rand(1,10000);
        $out = '';

        $out .= '<div id="twit-' . $rand . '" class="twitter-widget"></div>';

        $out .= '<script type="text/javascript">' . "\n";  
           $out .= 'jQuery(document).ready(function($){' . "\n";                       
                $out .= '$("#twit-' . $rand . '").tweet({' . "\n";
                    $out .= 'username: "' . $user . '",' . "\n";
                    $out .= 'count   :  ' . $num . ',' . "\n";
                    $out .= 'template: "{text}{time}",' . "\n";
                $out .= '});' . "\n";
            $out .= '});' . "\n";                  
        $out .= '</script>' . "\n";

        return $out;
    }
    add_shortcode('twitter', 'bmd_twitter');


/*-----------------------------------------------------------------------------------*/
/* FLICKR
/*-----------------------------------------------------------------------------------*/
    function bmd_flickr( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'user' => '',
            'num'  => '',
        ), $atts));

        wp_enqueue_script('jflickrfeed');
        $rand = rand(1,10000);
        $out = '';

        $out .= '<ul id="flickr-' . $rand . '" class="flickr-widget"></ul>';
        
        $out .= '<script type="text/javascript">'. "\n";
            $out .= 'jQuery(document).ready(function($){'. "\n";
                $out .= '$("#flickr-' . $rand . '").jflickrfeed({'. "\n";
                    $out .= 'limit :' . $num . ','. "\n";
                        $out .= 'qstrings: { id: \'' . $user . '\' },'. "\n";
                        $out .= 'itemTemplate: \'<li>\'+'. "\n";
                                        $out .= '\'<a rel="prettyPhoto[flickr]" href="{{image}}" title="{{title}}">\' + '. "\n";
                                            $out .= '\'<img src="{{image_m}}" alt="{{title}}" />\' + \'<i class="icon-plus-sign"></i>\' + '. "\n";
                                        $out .= '\'</a>\' + '. "\n";
                                      $out .= '\'</li>\''. "\n";
                    $out .=  '}, function(data) {'. "\n";
                        $out .=  '$("a[rel^=\'prettyPhoto\']").prettyPhoto();'. "\n";
                    $out .= '});'. "\n";
                $out .= '});'. "\n";
        $out .= '</script>'. "\n";

        return $out;
    }
    add_shortcode('flickr', 'bmd_flickr');


/*-----------------------------------------------------------------------------------*/
/* GOOGLE MAP
/*-----------------------------------------------------------------------------------*/
    function bmd_google_map( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'address'     => '',
            'coordinates' => '',
            'zoom'        => '',
            'height'      => '',
        ), $atts));

        wp_enqueue_script('googlemaps');
        wp_enqueue_script('googlemap');
        $out = '';

        if (!$address) {
            _e('Address was not specified', 'bmd');
            return false;
        }
        
        if (!$coordinates) {
            $coordinates = aq_get_map_coordinates($address);
            if (is_array($coordinates)) {
                $coordinates = $coordinates['lat'] . ',' . $coordinates['lng'];
            } else {
                echo $coordinates;
                return false;
            }
        }
        
        $out .= '<div id="map_canvas_' . rand(1, 100) . '" class="flexible-map ' . $shadow . '" style="height:' . $height . '">';
            $out .= '<input class="location" type="hidden" value="' . $address . '" />';
            $out .= '<input class="coordinates" type="hidden" value="' . $coordinates . '" />';
            $out .= '<input class="zoom" type="hidden" value="' . $zoom . '" />';
            $out .= '<div class="map_canvas"></div>';
        $out .= '</div>';

        return $out;
    }
    add_shortcode('google_map', 'bmd_google_map');


/*-----------------------------------------------------------------------------------*/
/* FEATURES
/*-----------------------------------------------------------------------------------*/
    function bmd_features( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title'      => '',
            'title_size' => '',
            'icon'       => '',
            'url'        => '',
        ), $atts));

        $out = '';

        if ($icon) $icon = '<i class="' . $icon . '"></i>';

            if ($url) $out .= '<a href="' . $url . '">';
                $out .= '<div class="features">';
                    $out .= $icon;
                    $out .= '<' . $title_size . '>' . $title . '</' . $title_size . '>';
                    $out .= wpautop(do_shortcode(htmlspecialchars_decode($content)));
                $out .= '</div>';
            if ($url) $out .= '</a>';
        
        return $out;
    }
    add_shortcode('features', 'bmd_features');


/*-----------------------------------------------------------------------------------*/
/* SOCIAL
/*-----------------------------------------------------------------------------------*/
    function bmd_social( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'twitter'    => '',
            'facebook'   => '',
            'dribbble'   => '',
            'pinterset'  => '',
            'vimeo'      => '',
            'linkedin'   => '',
            'google'     => '',
            'flickr'     => '',
            'lastfm'     => '',
            'forrst'     => '',
            'skype'      => '',
            'picassa'    => '',
            'youtube'    => '',
            'behance'    => '',
            'tumblr'     => '',
            'blogger'    => '',
            'delicious'  => '',
            'digg'       => '',
            'friendfeed' => '',
            'github'     => '',
            'wordpress'  => '',
            'rss'        => '',
        ), $atts));

        $out = '';

        $out .= '<ul class="social">';

            if ($facebook) 
            $out .= '<li><a href="' . $facebook . '" class="facebook" title="Facebook" target="_blank">&#88;</a></li>';

            if ($twitter) 
            $out .= '<li><a href="' . $twitter . '" class="twitter" title="Twitter" target="_blank">&#95;</a></li>';

            if ($dribbble)
                $out .= '<li><a href="' . $dribbble . '" class="dribbble" title="Dribbble" target="_blank">&#83;</a></li>';

            if ($pinterset)
                $out .= '<li><a href="' . $pinterset . '" class="pinterset" title="Pinterset" target="_blank"></a></li>';

            if ($vimeo)
                $out .= '<li><a href="' . $vimeo . '" class="vimeo" title="Vimeo" target="_blank">&#33;</a></li>';

            if ($linkedin)
                $out .= '<li><a href="' . $linkedin . '" class="linkedin" title="linkedin" target="_blank">&#118;</a></li>';

            if ($google)
                $out .= '<li><a href="' . $google . '" class="google" title="Google" target="_blank">&#107;</a></li>';

            if ($flickr)
                $out .= '<li><a href="' . $flickr . '" class="flickr" title="Flickr" target="_blank">&#98;</a></li>';

            if ($lastfm)
                $out .= '<li><a href="' . $lastfm . '" class="lastfm" title="Lastfm" target="_blank">&#117;</a></li>';

            if ($forrst)
                $out .= '<li><a href="' . $forrst . '" class="forrst" title="Forrst" target="_blank">&#100;</a></li>';
       
            if ($skype)
                $out .= '<li><a href="skype:'.$skype.'?call" class="skype" title="Skype" target="_blank">&#58;</a></li>';
       
            if ($picassa)
                $out .= '<li><a href="' . $picassa . '" class="picassa" title="Picassa" target="_blank">&#56;</a></li>';

            if ($youtube)
                $out .= '<li><a href="' . $youtube . '" class="youtube" title="Youtube" target="_blank">&#39;</a></li>';

            if ($behance)
                $out .= '<li><a href="' . $behance . '" class="behance" title="Behance" target="_blank">&#71;</a></li>';

            if ($tumblr)
                $out .= '<li><a href="' . $tumblr . '" class="tumblr" title="Tumblr" target="_blank">&#92;</a></li>';
       
            if ($blogger)
                $out .= '<li><a href="' . $blogger . '" class="blogger" title="Blogger" target="_blank">&#74;</a></li>';
       
            if ($delicious)
                $out .= '<li><a href="' . $delicious . '" class="delicious" title="Delicious" target="_blank">&#76;</a></li>';
       
            if ($digg)
                $out .= '<li><a href="' . $digg . '" class="digg" title="Digg" target="_blank">&#81;</a></li>';
       
            if ($friendfeed)
                $out .= '<li><a href="' . $friendfeed . '" class="friendfeed" title="Friendfeed" target="_blank">&#102;</a></li>';
       
            if ($github)
                $out .= '<li><a href="' . $github . '" class="github" title="Github" target="_blank">&#106;</a></li>';
       
            if ($wordpress)
                $out .= '<li><a href="' . $wordpress . '" class="wordpress" title="Wordpress" target="_blank">$</a></li>';
       
            if ($rss)
                $out .= '<li><a href="' . $rss . '" class="rss" title="Rss" target="_blank">&#42;</a></li>';
       
        $out .= '</ul>';    

        return $out;;
    }
    add_shortcode('social', 'bmd_social');


/*-----------------------------------------------------------------------------------*/
/* FLEXSLIDER
/*-----------------------------------------------------------------------------------*/
    function bmd_slider_group( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'animation'       => '',
            'slide_speed'     => '7000',
            'animation_speed' => '600',
        ), $atts));

        wp_enqueue_script('flexslider');
        $rand = rand(1,100);
        $out = '';
                
        $out .= '<div id="slider-' . $rand . '" class="flexslider loader ' . $shadow . '">';
            $out .= '<ul class="slides">';
            $out .= do_shortcode($content);
            $out .= '</ul>';
        $out .= '</div>';

        $out .= '<script type="text/javascript">';
            $out .= 'jQuery(window).load(function() {';
                $out .= 'jQuery("#slider-' . $rand. '").flexslider({';
                    $out .= 'animation: "' . $animation . '",';
                    $out .= 'slideshowSpeed:' . $slide_speed . ',';
                    $out .= 'animationSpeed:' . $animation_speed . ','; 
                    $out .= 'controlNav: false,';
                    $out .= 'prevText: "",'; 
                    $out .= 'nextText: "",'; 
                    $out .= 'start: function(slider){';
                        $out .= 'jQuery(".flexslider").removeClass("loader");';
                    $out .= '}';
                $out .= '});';
            $out .= '});';
        $out .= '</script>';

        return $out;
    }
    add_shortcode('slider_group', 'bmd_slider_group');


    function bmd_slider( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'text'   => '',
            'img'    => '',
            'height' => '400',
            'width'  => '960',
        ), $atts));

        $image = aq_resize($img, $width, $height, true);
        $out = '';

        $out .= '<li>';
            $out .= '<img src="' . $image . '" />';
            if (!empty($text)) { $out .= '<h5>' . $text . '</h5>'; }
        $out .= '</li>';

        return $out;
    }
    add_shortcode('slider', 'bmd_slider');


/*-----------------------------------------------------------------------------------*/
/* ICON
/*-----------------------------------------------------------------------------------*/
    function bmd_video( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'cat' => '',
            'id'  => '',
        ), $atts));

        $out = '';

        if ($cat == 'vimeo') {
            $out .= '<div class="flexible-video">';
               $out .= '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
            $out .= '</div>';
        } 

        if ($cat == 'youtube') {
            $out .= '<div class="flexible-video">';
                $out .= '<iframe width="948" height="600" src="http://www.youtube.com/embed/' . $id . '?rel=0" frameborder="0" allowfullscreen></iframe>';
            $out .= '</div>';
        }

        return $out;
    }
    add_shortcode('video', 'bmd_video');


/*-----------------------------------------------------------------------------------*/
/* TESTIMONIALS
/*-----------------------------------------------------------------------------------*/
    function bmd_testimonials_group( $atts, $content = null ) {

        wp_enqueue_script('flexslider');
        $rand = rand(1,100);
        $out = '';
                
        $out .= '<div id="testimonials_' . $rand . '" class="testimonials flexslider loader">';
            $out .= '<ul class="slides">';
            $out .= do_shortcode($content);
            $out .= '</ul>';
        $out .= '</div>';

        $out .= '<script type="text/javascript">';
            $out .= 'jQuery(window).load(function() {';
                $out .= 'jQuery("#testimonials_' . $rand. '").flexslider({';
                    $out .= 'animation: "fade",';
                    $out .= 'controlNav: false,';
                    $out .= 'prevText: "",'; 
                    $out .= 'nextText: "",'; 
                    $out .= 'directionNav: false,';
                    $out .= 'smoothHeight: true,';
                    $out .= 'pauseOnHover: true,';
                    $out .= 'start: function(slider){';
                        $out .= 'jQuery(".flexslider").removeClass("loader");';
                    $out .= '}';
                $out .= '});';
            $out .= '});';
        $out .= '</script>';

        return $out;
    }
    add_shortcode('testimonials_group', 'bmd_testimonials_group');


    function bmd_testimonials( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'author'   => '',
            'link'    => '',
            'company' => '',
            'text'    => '',
        ), $atts));

        if (!empty($link)) {
            $author = '<a href="' . $link . '"><strong>' . htmlspecialchars(stripslashes($author)) . '</strong></a>';
        } else {
            $author = '<strong>' . htmlspecialchars(stripslashes($author)) . '</strong>';
        }
                    
        $out .= '<li>';        
            $out .= '<div class="testimonial-texts">';
                $out .= wpautop(do_shortcode(htmlspecialchars_decode($text)));
            $out .= '</div>';
                            
            $out .= '<div class="testimonial-author">';
                $out .= '&mdash;&nbsp;' . $author;
                $out .= '<span class="company">' . htmlspecialchars(stripslashes($company)) . '</span>';
            $out .= '</div>';
        $out .= '</li>'; 
                        
        return $out;
    }
    add_shortcode('testimonials', 'bmd_testimonials');



/*-----------------------------------------------------------------------------------*/
/* CLIENT
/*-----------------------------------------------------------------------------------*/
    function bmd_client_group( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'col'  => '',
        ), $atts));

        $out = '';
                
        $out .= '<div class="client col' . $coll . ' clearfix">';
            $out .= do_shortcode($content);
        $out .= '</div>';

        return $out;
    }
    add_shortcode('client_group', 'bmd_client_group');


    function bmd_client( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'img' => '',
        ), $atts));

        $out = '';
        
        $out .= '<div>';
            $out .= '<img src="' . $img . '"/>';
        $out .= '</div>';

        return $out;
    }
    add_shortcode('client', 'bmd_client');



/*-----------------------------------------------------------------------------------*/
/* TOOGLE
/*-----------------------------------------------------------------------------------*/
    function bmd_toogle_group( $atts, $content = null ) {
        
        wp_enqueue_script('toogle');
        $out = '';
                
        $out .= '<div class="toggles-wrapper">';
            $out .= do_shortcode($content);          
        $out .= '</div>';

        return $out;
    }
    add_shortcode('toogle_group', 'bmd_toogle_group');


    function bmd_toogle( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title' => '',
            'text'  => '',
        ), $atts));

        $out = '';

        $out .= '<div class="toggle-block">';
            $out .= '<p class="tab-head">' . $title . '</p>';
            $out .= '<div class="arrow"><i class="icon-plus"></i></div>';
            $out .= '<div class="tab-body close">';
                $out .= wpautop(do_shortcode(htmlspecialchars_decode($text)));
            $out .= '</div>';
        $out .= '</div>';

        return $out;
    }
    add_shortcode('toogle', 'bmd_toogle');
    


/*-----------------------------------------------------------------------------------*/
/* ACCORDION
/*-----------------------------------------------------------------------------------*/
    function bmd_accordion_group( $atts, $content = null ) {
        
        wp_enqueue_script('accordion');
        $out = '';
                
        $out .= '<div class="accordion-wrapper">';
            $out .= do_shortcode($content);          
        $out .= '</div>';

        return $out;
    }
    add_shortcode('accordion_group', 'bmd_accordion_group');


    function bmd_accordion( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title' => '',
            'text'  => '',
            'open'  => ''
        ), $atts));

        $opens = $open == 'yes' ? 'open' : 'close';
        $active = $open == 'yes' ? 'active' : '';

        $out = '';

        $out .= '<div class="accordion-block">';
            $out .= '<p class="tab-head ' . $active . '">' . $title . '</p>';
            $out .= '<div class="arrow"><i class="icon-plus"></i></div>';
            $out .= '<div class="tab-body ' . $opens . '">';
                $out .= wpautop(do_shortcode(htmlspecialchars_decode($text)));
            $out .= '</div>';
        $out .= '</div>';

        return $out;
    }
    add_shortcode('accordion', 'bmd_accordion');


/*-----------------------------------------------------------------------------------*/
/* TAB
/*-----------------------------------------------------------------------------------*/  
    function bmd_tab_group($atts, $content = null) {
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('tabs');
        $GLOBALS['tab_count'] = 0;
        do_shortcode($content);

        if (is_array($GLOBALS['tab'])) {
            $i = 1;
            foreach ($GLOBALS['tab'] as $tab) {
                $toggle_selected = $i == 1 ? 'ui-tabs-active' : '';
                $tabs[] = '<li class="' . $toggle_selected . '"><a href="#tab-' . sanitize_title($tab['title']) . $i .'">' . $tab['title'] . '</a></li>';
                $panes[] = '<div id="tab-' . sanitize_title($tab['title']) . $i . '" class="tab-content">' . wpautop(do_shortcode(htmlspecialchars_decode($tab['text']))) . '</div>';
                $i++;
            }
            $return = '<div class="tab-block"><ul class="tab-nav clearfix">' . implode("\n", $tabs) . '</ul>' . implode("\n", $panes) . '</div>';
        }
        
        return $return;
    }
    add_shortcode('tab_group', 'bmd_tab_group');

    function bmd_tab($atts, $content = null) {
        extract( shortcode_atts( array(
        'title' => '',
        'text'  => ''
        ), $atts ) );

        $i = $GLOBALS['tab_count'];
        $GLOBALS['tab'][$i] = array('title' => sprintf($title, $GLOBALS['tab_count']), 'text' => $text );
        $GLOBALS['tab_count']++;
    }
    add_shortcode('tab', 'bmd_tab');