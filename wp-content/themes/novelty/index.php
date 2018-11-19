<?php get_header();  ?>

<div id="content">
    <div class="container">
    	<div class="blog-block mb80">

			<?php if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
			    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-wrapper'); ?>>
			    	<?php if (get_post_format()) {
						get_template_part( 'include/' . get_post_format() );
					} else {
						get_template_part( 'include/standart' );
					}?>
			    </article>
			<?php endwhile; endif; ?>

			<?php bmd_pagination(); ?>

		</div>
    </div><!-- end div.container -->    
</div><!-- end div#content-->

<?php get_footer();  ?>