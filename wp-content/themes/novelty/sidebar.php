<?php 
global $post, $smof_data;
$sidebar_position = get_post_meta($post->ID, '_page_sidebar', true);

if ($sidebar_position == 'left') {$s_sidebar = 'alignleft';}
if ($sidebar_position == 'right') {$s_sidebar = 'alignright';}

if ($sidebar_position != 'no_sidebar') { ?>
<aside id="sidebar" class="span3 <?php if (isset($s_sidebar)) echo $s_sidebar ?>">
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Primary Sidebar')) : ?>  
	<?php endif; ?> 
</aside><!-- end #sidebar -->
<?php } ?>