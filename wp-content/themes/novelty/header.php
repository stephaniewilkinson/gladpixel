<?php 
global $smof_data, $post; 
$page_title = get_post_meta($post->ID, '_page_page_title', true );
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> > <!--<![endif]-->

<head>

    <!-- BEGIN: basic page needs -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title>
        <?php 
            if ($page_title) {
                echo $page_title . ' | '; bloginfo('name');
            } else {
                wp_title('|', true, 'right'); bloginfo('name');
            }
        ?>
    </title>

    <?php if ($smof_data['adaptive'] == 1) : ?>
    <!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <?php endif; ?>
    <!-- END: basic page needs -->

    <!-- SCRIPT IE FIXES -->  
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]--> 
    <!-- END SCRIPT IE FIXES-->
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <!-- Default Favicon -->
    <?php if ($smof_data['favicon']) : ?>
    <link rel="shortcut icon" href="<?php echo $smof_data['favicon']; ?>" />
    <?php endif; ?>

    <!-- Favicon For iPhone -->
    <?php if($smof_data['iphone_icon']): ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo $smof_data['iphone_icon']; ?>">
    <?php endif; ?>

    <!-- Favicon For iPhone 4 Retina display -->
    <?php if($smof_data['iphone_icon_retina']): ?>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $smof_data['iphone_icon_retina']; ?>">
    <?php endif; ?>

    <!-- Favicon For iPad -->
    <?php if($smof_data['ipad_icon']): ?>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $smof_data['ipad_icon']; ?>">
    <?php endif; ?>

    <!-- Favicon For iPad Retina display -->
    <?php if($smof_data['ipad_icon_retina']): ?>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $smof_data['ipad_icon_retina']; ?>">
    <?php endif; ?>

    <?php wp_head(); ?>

    <!--[if IE]>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
    <![endif]-->

    <?php if ($smof_data['custom_style']) : ?>
    <style>
        <?php echo $smof_data['custom_style']; ?>
    </style>
    <?php endif; ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN: WRAPPER -->
<div id="wrapper" class="<?php if ($smof_data['layout'] == 0) echo 'boxed'?>">

    <?php 
        if ($smof_data['header_style'] == 'style1') {
            include(locate_template('include/header/header1.php'));
        } elseif ($smof_data['header_style'] == 'style2') {
            include(locate_template('include/header/header2.php'));
        } elseif ($smof_data['header_style'] == 'style3') {
            include(locate_template('include/header/header3.php'));
        } elseif ($smof_data['header_style'] == 'style4') {
            include(locate_template('include/header/header4.php'));
        } elseif ($smof_data['header_style'] == 'style5') {
            include(locate_template('include/header/header5.php'));
        } elseif ($smof_data['header_style'] == 'style6') {
            include(locate_template('include/header/header6.php'));
        } elseif ($smof_data['header_style'] == 'style7') {
            include(locate_template('include/header/header7.php'));
        } elseif ($smof_data['header_style'] == 'style8') {
            include(locate_template('include/header/header8.php'));
        } elseif ($smof_data['header_style'] == 'style9') {
            include(locate_template('include/header/header9.php'));
        } elseif ($smof_data['header_style'] == 'style10') {
            include(locate_template('include/header/header10.php'));
        } else {
            include(locate_template('include/header/header1.php'));
        }
    ?>