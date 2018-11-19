<?php

define('THEME_NAME', 'novelty');
define('BMD_PATH', get_template_directory_uri());
define('BMD_SERVER_PATH', get_template_directory());
define('BMD_BUILDER_PATH', get_template_directory() . '/options/page-builder/blocks/');
define('BMD_ADMIN_OPTIONS', get_template_directory() . '/options/admin/functions/include/');


/*ADMIN INTERFACES*/
require_once(BMD_SERVER_PATH . '/options/admin/index.php');

/*GENERAL OPTION*/
require_once(BMD_SERVER_PATH . '/options/general.php'); 

/*COMENTS*/
require_once(BMD_SERVER_PATH . '/options/comments.php');

/*SIDEBAR*/
require_once(BMD_SERVER_PATH . '/options/sidebar.php');

/*WIDGET*/
require_once(BMD_SERVER_PATH . '/options/widget/flickr.php');
require_once(BMD_SERVER_PATH . '/options/widget/twitter.php');
require_once(BMD_SERVER_PATH . '/options/widget/popular-post.php');
require_once(BMD_SERVER_PATH . '/options/widget/recent-post.php');
require_once(BMD_SERVER_PATH . '/options/widget/tab.php');
require_once(BMD_SERVER_PATH . '/options/widget/video.php');
require_once(BMD_SERVER_PATH . '/options/widget/contact.php');
require_once(BMD_SERVER_PATH . '/options/widget/google_map.php');


/*POST TYPE*/
require_once(BMD_SERVER_PATH . '/options/post-types/portfolio.php');

/* CROP IMAGES SCRIPT */
require_once(BMD_SERVER_PATH . '/options/aq_resizer.php');

/*SHORTCODES*/
require_once(BMD_SERVER_PATH . '/options/shortcodes/shortcodes.php');
require_once(BMD_SERVER_PATH . '/options/shortcodes/shortcodes-editor.php');


/*PAGE BUILDER*/
require_once(BMD_SERVER_PATH . '/options/page-builder/page-builder.php');  

/*METABOX*/
require_once(BMD_SERVER_PATH . '/options/page-meta-boxes.php');
require_once(BMD_SERVER_PATH . '/options/meta-box.php');  


/*THEME CUSOMIZER*/
require_once(BMD_SERVER_PATH . '/options/customizer/customizer.php');

/*ENQUEUE SCRIPTS*/
require_once(BMD_SERVER_PATH . '/options/scripts.php');

/*BREADCRUMBS*/
require_once(BMD_SERVER_PATH . '/options/breadcrumbs.php');



//GENERATE CSS FILE
ob_start(); // Capture all output (output buffering)
require(BMD_SERVER_PATH . '/options/customizer/custom-style.php'); // Generate CSS
$css = ob_get_clean(); // Get generated CSS (output buffering)
file_put_contents(BMD_SERVER_PATH . '/custom-style.css', $css, LOCK_EX); // Save it