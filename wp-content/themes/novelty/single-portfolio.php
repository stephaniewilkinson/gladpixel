<?php 
global $post, $smof_data;
get_header(); 

$skill  =  bmd_get_category_list( $post->ID, 'portfolio-skill', '', ', ', '', 0 ); 
$year   =  bmd_get_category_list( $post->ID, 'portfolio-year', '', ',', '', 0 ); 
$client =  get_post_meta( $post->ID, '_bmd_client_name', true );
$url    =  get_post_meta( $post->ID, '_bmd_url', true ); 

if ($smof_data['portflio_single_bread'] == 1) { dimox_breadcrumbs(); }
$shadow = $smof_data['portflio_single_shadow'] == 0 ? $shadow = 'off-shadow' : $shadow = 'on-shadow'
?>

<!-- BEGIN: CONTAINER -->
<div id="content">
<div class="container">

	<?php 
    if ($smof_data['portfolio_single_style'] == 'center') {
        include(locate_template('include/portfolio/center.php'));
    } elseif ($smof_data['portfolio_single_style'] == 'right') {
        include(locate_template('include/portfolio/right.php'));
    } elseif ($smof_data['portfolio_single_style'] == 'left') {
        include(locate_template('include/portfolio/left.php'));
    } else {
        include(locate_template('include/portfolio/center.php'));
    }
    ?>

</div><!-- end di.container -->
</div>

<?php get_footer(); ?>   
