<?php
/*-----------------------------------------------------------------------------------*/
/* The Portfolio custom post type
/*-----------------------------------------------------------------------------------*/
    add_action('init', 'portfolio_register'); 
    function portfolio_register() { 
        global $smof_data;

        $labels = array(
            'name'               => _x('Portfolio', 'Portfolio General Name', 'bmd'),
            'singular_name'      => _x('Portfolio', 'Portfolio Singular Name', 'bmd'),
            'add_new'            => _x('Add New', 'Add New Portfolio Name', 'bmd'),
            'add_new_item'       => __('Add New Portfolio', 'bmd'),
            'edit_item'          => __('Edit Portfolio', 'bmd'),
            'new_item'           => __('New Portfolio', 'bmd'),
            'view_item'          => __('View Portfolio', 'bmd'),
            'search_items'       => __('Search Portfolio', 'bmd'),
            'not_found'          => __('Nothing found', 'bmd'),
            'not_found_in_trash' => __('Nothing found in Trash', 'bmd'),
            'parent_item_colon'  => ''
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'query_var'          => true,
            'rewrite'            => array("slug" => $smof_data['portfolio_slug']),
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'supports'           => array('title','editor','thumbnail',)
        ); 

        register_post_type('portfolio' , $args);
            
        register_taxonomy(
            "portfolio-category", array("portfolio"), array(
                "hierarchical"   => true,
                "label"          => "Categories", 
                "singular_label" => "Categories", 
                "rewrite"        => true));
        register_taxonomy_for_object_type('portfolio-category', 'portfolio');
        
        register_taxonomy(
            "portfolio-skill", array("portfolio"), array(
                "hierarchical"   => true, 
                "label"          => "Skills", 
                "singular_label" => "Skill", 
                "rewrite"        => true));
        register_taxonomy_for_object_type('portfolio-skill', 'portfolio');

        register_taxonomy(
            "portfolio-year", array("portfolio"), array(
                "hierarchical"   => true, 
                "label"          => "Year", 
                "singular_label" => "Year", 
                "rewrite"        => true));
        register_taxonomy_for_object_type('portfolio-year', 'portfolio');
        flush_rewrite_rules();
    }



    add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");         
    function portfolio_edit_columns($columns) {  
        $columns = array(  
            "cb"          => "<input type=\"checkbox\" />",  
            "title"       => __('Project', 'bmd'),  
            "description" => __('Description' , 'bmd'),   
            "type"        => __('Categories', 'bmd'),  
            "year"        => __('Year', 'bmd'), 
            "skill"       => __('Skills', 'bmd'),
            "photo"       => __('Photo', 'bmd'), 
        );    
        return $columns;  
    }    
      


    add_action("manage_posts_custom_column",  "portfolio_custom_columns");   
    function portfolio_custom_columns($column) {  
        global $post;  
        switch ($column) {  

            case "type":  
                echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');  
                break; 
                
            case "description":  
                bmd_max_charlength(150);  
                break;     
                
            case "skill":  
                echo get_the_term_list($post->ID, 'portfolio-skill', '', ', ','');  
                break;  
                
            case "year":  
                echo get_the_term_list($post->ID, 'portfolio-year', '', ', ','');  
                break; 
                
            case "photo":  
                the_post_thumbnail('portfolio-thumb');
                break;  
        }  
    }    


/*-----------------------------------------------------------------------------------*/
/* The Portfolio metaboxes
/*-----------------------------------------------------------------------------------*/
    add_action('add_meta_boxes', 'ps_add_custom_box');

    function ps_add_custom_box() {
        add_meta_box('ps_custom_post_type_uploads', __('Upload Images', 'port_slide'), 'ps_custom_post_type_uploads', 'portfolio', 'normal', 'default');
    }

    function ps_metabox_extras() {
        global $ps_options;
        
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script( 'portfolio-slideshow-admin', BMD_PATH . '/options/assets/js/portfolio-post-type.js', false, $ps_options['version'], true); 
    }

    if (is_admin() && $pagenow=='post-new.php' OR $pagenow=='post.php') {
        add_action('init', 'ps_metabox_extras');
    }
        
    function ps_custom_post_type_uploads() {
        global $post;
     
        echo '<p>
        <a href="media-upload.php?post_id='.$post->ID.'&#038;type=image&#038;TB_iframe=1"  class="thickbox" ><input type="submit" name="Save" value="' . __( 'Upload and manage images', 'portfolio-slideshow-pro' ) . '" class="button-secondary" /></a></p>';

        $attachments = get_posts( array(
            'order'          => 'ASC',
            'orderby'        => 'menu_order ID',
            'post_type'      => 'attachment',
            'post_parent'    => $post->ID,
            'post_mime_type' => 'image',
            'post_status'    => null,
            'numberposts'    => -1,
            'size'           => 'thumbnail') 
        );

        if ($attachments) {
            echo '<ul id="images">';
                $i = 0;
                foreach ( $attachments as $attachment ) {
                    echo '<li id="'. $attachment->ID .'">' . wp_get_attachment_image( $attachment->ID, array(100,100), false, false) . '</li>';
                    $i++;
                }
            echo '</ul><div class="instructions"><small>' . __( 'Drag and drop to re-order', 'portfolio-slideshow-pro' ) . ' <a href="http://www.screenr.com/1VTH" target="_blank">How to create a portfolio</a></small></div>';
        } else { 
            echo '<div class="instructions"><p>' . __( 'Be sure to save your changes in the gallery uploader, then click "Save Draft" to update this page for further instructions. <a href="http://www.screenr.com/1VTH" target="_blank">How to create a portfolio</a>', 'portfolio-slideshow-pro' ) . '</p></div>';
        }
        /* Allow other plugins to insert content here */
    }
                
    function ps_save_item_order() { //to save when we update the sort order
        global $wpdb;

        $order = explode(',', $_POST['order']);
        $counter = 0;
        foreach ($order as $item_id) {
            $wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $item_id) );
            $counter++;
        }
        die(1);
    }
    add_action('wp_ajax_item_sort', 'ps_save_item_order');
    add_action('wp_ajax_nopriv_item_sort', 'ps_save_item_order');

    

    add_filter('cmb_meta_boxes', 'cmb_portfolio_metaboxes');
    function cmb_portfolio_metaboxes(array $meta_boxes) {
        
        $prefix = '_bmd_';

        $meta_boxes[] = array(
            'id'         => 'portfolio_metaboxes',
            'title'      => __('Portfolio Seting' , 'bmd'),
            'pages'      => array('portfolio',),
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => true,
            'fields'     => array(
            
                array(
                    'name' => __('General Seting' , 'bmd'), 
                    'desc' => '',
                    'type' => 'title',
                    'id'   => $prefix . 'title_general_seting'
                ),
                        
                array(
                    'name'    => __('Project Content Type:' , 'bmd'),
                    'desc'    => __('Choose current project content type.' , 'bmd'),
                    'id'      => $prefix . 'project_type',
                    'type'    => 'select',
                    'options' => array(
                        array('name' => 'Image', 'value' => 'image'),
                        array('name' => 'Slider', 'value' => 'slider'),
                        array('name' => 'You Tube', 'value' => 'youtube'),
                        array('name' => 'Vimeo', 'value' => 'vimeo')                
                        )
                ),        
                
                array(
                    'name' => __('Client Name' , 'bmd'),
                    'desc' => '',
                    'id'   => $prefix . 'client_name',
                    'type' => 'text'
                ),
                
                array(
                    'name' => __('URL' , 'bmd'),
                    'desc' => '',
                    'id'   => $prefix . 'url',
                    'type' => 'text'
                ),
                                       
                array(
                    'name' => 'You Tube & Vimeo Project',
                    'desc' => '',
                    'type' => 'title',
                    'id'   => $prefix . 'title_video_project'
                ),
                
                array(
                    'name' => __('Enter your video ID here:' , 'bmd'),
                    'desc' => __('If you select Youtube or Vimeo.' , 'bmd'),
                    'id'   => $prefix . 'video_link',
                    'type' => 'text'
                ),
                
            ),
        );

        return $meta_boxes;
    }


/*-----------------------------------------------------------------------------------*/
/* Displays the custom post type icon in the dashboard
/*-----------------------------------------------------------------------------------*/
    function portfolio_icons(){ ?>
        <style type="text/css" media="screen">
            #menu-posts-portfolio .wp-menu-image{
                background: url(<?php echo BMD_PATH ?>/options/assets/images/portfolio-icon.png) no-repeat 6px 6px !important;
            }
            #menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image{
                background-position:6px -16px !important;
            }
            #icon-edit.icon32-posts-portfolio{background: url(<?php BMD_PATH ?>/options/assets/images/portfolio-32x32.png) no-repeat;}
        </style>
    <?php }
    add_action('admin_head', 'portfolio_icons');