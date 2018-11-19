<?php global $attachment, $smof_data, $excerpt2, $read2, $read_icon2, $col_width, $show_cat2, $show_date2, $show_comm2, $blog_style2;
$featured = get_post_meta( $post->ID, '_p_featured', true );
?>

<div class="blog-post-content">

	<?php 
	if ($blog_style2 == 'style1' || $featured == 'Yes'){
		if (has_post_thumbnail($post->ID, 'full')){
			$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
			$img_url = $imgurl[0];

			if (is_singular()) { 
				$height = ''; 
			} else {
				$height = '400';
			}
			
			if (isset($layout) == 'without') {
				$image = aq_resize($img_url, 960, $height, true);
			} else {
				$image = aq_resize($img_url, 720, $height, true);
			}

			echo '<img src="' . $image . '" alt="' . get_the_title() . '" class="mb50"/>'; 
		}
	} 
	?>
	<div class="blog-content">
		<?php 
		if (is_singular()) :

			echo '<h1>'.get_the_title().'</h1>';

			if ($smof_data['single_blog_cat'] == '1' || $smof_data['single_blog_date'] == '1' || $smof_data['single_blog_comm'] == '1'){
				echo '<div class="meta clearfix">';

					if ($smof_data['single_blog_cat'] == '1'){
						echo '<span class="meta-cat">';
							echo '<i class="icon-folder-open-alt"></i>';
							the_category(', '); 
						echo '</span>'; 
					}

					if ($smof_data['single_blog_date'] == '1'){
						echo '<span class="mata-date">';
							echo '<i class="icon-calendar"></i>';
							the_time('M d Y');
						echo '</span>';
					}

					if ($smof_data['single_blog_comm'] == '1'){
						echo '<span class="meta-comm">';
							echo '<i class="icon-comment-alt"></i>';
							comments_popup_link('0 Comment', '1 Comment', '% Comments'); 
						echo '</span>'; 
					}
					
				echo '</div>';
			}

			if ($blog_style2 == 'style2'){
				if (has_post_thumbnail($post->ID, 'full')){
					$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					$img_url = $imgurl[0];

					if (is_singular()) { 
						$height = ''; 
					} else {
						$height = '400';
					}
					
					if (isset($layout) == 'without') {
						$image = aq_resize($img_url, 960, $height, true);
					} else {
						$image = aq_resize($img_url, 720, $height, true);
					}

					echo '<img src="' . $image . '" alt="' . get_the_title() . '" class="mb25"/>'; 
				}
			} 

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
 
			if ($blog_style2 == 'style2'){
				if (has_post_thumbnail($post->ID, 'full')){
					$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					$img_url = $imgurl[0];

					if (is_singular()) { 
						$height = ''; 
					} else {
						$height = '400';
					}
					
					if (isset($layout) == 'without') {
						$image = aq_resize($img_url, 960, $height, true);
					} else {
						$image = aq_resize($img_url, 720, $height, true);
					}

					echo '<img src="' . $image . '" alt="' . get_the_title() . '" class="mb25"/>'; 
				}
			} 
			


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
