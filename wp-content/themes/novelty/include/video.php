<?php 
global $smof_data, $excerpt2, $read2, $read_icon2, $col_width, $show_cat2, $show_date2, $show_comm2, $blog_style2;
$vimeo  = get_post_meta( $post->ID, '_p_vimeo_id', true );
$youtube = get_post_meta($post->ID, '_p_youtube_id', true);
?>

<div class="blog-post-content">


	<?php if ($blog_style2 == 'style1') : ?>
		<?php if ($vimeo) : ?>
			<div class="flexible-video mb50">
			    <iframe src="http://player.vimeo.com/video/<?php echo $vimeo ?>?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
			</div>
		<?php else : ?>
			<div class="flexible-video mb50">
			    <iframe width="948" height="600" src="http://www.youtube.com/embed/<?php echo $youtube ?>?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		<?php endif; ?>
	<?php endif; ?>



	<div class="blog-content">
		<?php 
		if (is_singular()) :

			echo '<h1>'.get_the_title().'</h1>';

			echo '<div class="meta clearfix">';

				echo '<span class="meta-cat">';
					echo '<i class="icon-folder-open-alt"></i>';
					the_category(', '); 
				echo '</span>'; 
				
				echo '<span class="mata-date">';
					echo '<i class="icon-calendar"></i>';
					the_time('M d Y');
				echo '</span>';

				echo '<span class="meta-comm">';
					echo '<i class="icon-comment-alt"></i>';
					comments_popup_link( '0 Comment', '1 Comment', '% Comments' ); 
				echo '</span>'; 
				
			echo '</div>';

			if ($blog_style2 == 'style2') :
				if ($vimeo) : ?>
					<div class="flexible-video mb25">
					    <iframe src="http://player.vimeo.com/video/<?php echo $vimeo ?>?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
					</div>
				<?php else : ?>
					<div class="flexible-video mb25">
					    <iframe width="948" height="600" src="http://www.youtube.com/embed/<?php echo $youtube ?>?rel=0" frameborder="0" allowfullscreen></iframe>
					</div>
				<?php endif;
			endif;

			the_content();

			echo '<div class="tagcloud clearfix">';
			the_tags('<i class="icon-tag"></i>', ' ', '<br />');
			echo '</div>';

		else :

			echo '<h2 class="post-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h2>';

			if ($show_cat2 == 'yes' || $show_date2 == 'yes' || $show_comm2 == 'yes'){
				echo '<div class="meta clearfix">';

					if ($show_cat2 == 'yes'){
						echo '<span class="meta-cat">';
							echo '<i class="icon-folder-open-alt"></i>';
							the_category(', '); 
						echo '</span>'; 
					}

					if ($show_date2 == 'yes'){
						echo '<span class="mata-date">';
							echo '<i class="icon-calendar"></i>';
							the_time('M d Y');
						echo '</span>';
					}

					if ($show_comm2 == 'yes'){
						echo '<span class="meta-comm">';
							echo '<i class="icon-comment-alt"></i>';
							comments_popup_link('0 Comment', '1 Comment', '% Comments'); 
						echo '</span>'; 
					}
					
				echo '</div>';
			}


			if ($blog_style2 == 'style2') :
				if ($vimeo) : ?>
					<div class="flexible-video mb25">
					    <iframe src="http://player.vimeo.com/video/<?php echo $vimeo ?>?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
					</div>
				<?php else : ?>
					<div class="flexible-video mb25">
					    <iframe width="948" height="600" src="http://www.youtube.com/embed/<?php echo $youtube ?>?rel=0" frameborder="0" allowfullscreen></iframe>
					</div>
				<?php endif;
			endif;


			echo '<p>';
			if (isset($excerpt2)) {
				if ($excerpt2 != ''){
					echo bmd_max_charlength($excerpt2);
				} else {
					the_content();
				}
			} else {
				if ($smof_data['cat_excerpt'] != 0) {
					bmd_max_charlength($smof_data['cat_excerpt']);
				} else {
					the_content();
				}
			}
			echo '</p>';

			if (isset($read2)) {
				if ($read2 != '' ) { echo '<a href="' . get_permalink() . '" class="readmore">' . $read2 . '<i class="' . $read_icon2 . '"></i></a>'; }
			} else {
				echo '<a href="' . get_permalink() . '" class="readmore">' . $smof_data['cat_read'] . '<i class="' . $smof_data['cat_icon'] . '"></i></a>';
			}

		endif; ?>

	</div><!-- end div .blog-content -->

</div><!-- end div .blog-post-content -->