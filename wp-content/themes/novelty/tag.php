<?php 
global  $smof_datasmof_data;
get_header(); 

$class = $smof_data['tag_sidebar'];

if ($class == 'left') { $clas = 'span9 alignright'; }
if ($class == 'right') { $clas = 'span9 alignleft'; }
if ($class == 'without') { $clas = 'without'; }

if ($smof_data['tag_bread'] == 1) { dimox_breadcrumbs(); } ?>

<div id="content">
    <div class="container">
        <?php if ($class != 'without') echo '<div class="row">'; ?>

            <div id="content-area" class="<?php echo $clas ?>">
                <?php if ($wp_query->have_posts()) : ?>

                <div class="page-title up clearfix">
                    <h3><?php printf( __( 'Tag Archives: %s', 'bmd'), '<span class="color">' . single_tag_title( '', false ) . '</span>' );?></h3>
                </div>
                
                <?php while($wp_query->have_posts()) : $wp_query->the_post();  ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-wrapper'); ?>>
                        <?php if(get_post_format()){
                            get_template_part('include/' . get_post_format());
                        } else {
                            get_template_part('include/standart');
                        }?>
                    </article>
                <?php endwhile; endif; ?>

                <div class="mb60">
                    <?php bmd_pagination($pages = '', $range = 2); ?>
                </div>

            </div>

            <?php if ($class != 'without') get_sidebar(); ?>

        <?php if ($class != 'without') echo '</div>'; ?> 

    </div>    
</div>
<?php get_footer(); ?>   