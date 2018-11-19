<!-- BEGIN: HEADER -->
<header id="header" class="style6 clearfix"> 

    <!-- BEGIN: TOP AREA -->
    <div id="top-area">
        <div class="container">
            <div class="row">
                
                <div class="span6 top-text">
                   <p><?php echo $smof_data['top_tagline']; ?></p>
                </div>

                <div class="span6 text-right">
                    <ul class="social">
                        <?php include(locate_template('include/social.php')); ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- END: TOP AREA -->

    <div class="container text-center">   
            
        <!-- begin: logo -->
        <?php 
        if (isset($_COOKIE["pixel_ratio"])) {
            $pixel_ratio = $_COOKIE["pixel_ratio"];
            $upload_logo = $pixel_ratio >= 2 ? $smof_data['logo2'] : $smof_data['logo'];
        } else { 
            $upload_logo = $smof_data['logo']; 
        }
        ?>
        <h1 class="logo">
            <a href="<?php echo home_url() ?>"><img width="<?php echo $smof_data['logo_width'] ?>" src="<?php echo $upload_logo ?>" alt="<?php bloginfo('name') ?>" /></a>
        </h1>
        <!-- end: logo -->

        <?php get_search_form(); ?> 

        <div class="clear"></div>

        <!-- begin: menu -->
        <?php 
        if (has_nav_menu('main_menu')):
            $args = array(
                'theme_location' => 'main_menu',
                'container'      => 'nav',
                'menu_id'        => 'menu',
                'menu_class'     => 'clearfix'
            );
            wp_nav_menu($args); 
        endif;
        ?>
        <!-- end: menu -->
        
    </div><!-- end: div.container  -->

</header>
<!-- END: HEADER -->