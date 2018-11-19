<?php 
global $smof_data;
get_header(); 
if ($smof_data['bread_404'] == 1) { dimox_breadcrumbs(); } 
?>

<div id="content">
    <div class="container">
        <div class="page-404">

            <?php 
            if ($smof_data['heading_404']) echo '<h1>'. $smof_data['heading_404'] .'</h1>';
            if ($smof_data['text_404']) echo '<h3>'. $smof_data['text_404'] .'</h3>';
            if ($smof_data['search_404']) get_search_form(); 
            ?>

        </div><!-- end div.page-404 -->  
    </div><!-- end div.container -->    
</div><!-- end div#content -->

<?php get_footer(); ?>   