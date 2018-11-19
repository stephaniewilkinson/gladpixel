<?php
/*-----------------------------------------------------------------------------------*/
/* BLOG HOME BLOCK
/*-----------------------------------------------------------------------------------*/
if(!class_exists('BMD_Blog_Block')) {
	class BMD_Blog_Block extends AQ_Block {
		

		function __construct() {
			$block_options = array(
				'name'  => 'Blog',
				'size'  => 'span12',
				'icons' => 'icon-book',
	 		);

			parent::__construct('bmd_blog_block', $block_options);
		}


		function form($instance) {
			global $heading_size;

			$defaults = array(
				'heading'    => 'h3',
				'num'        => 10,
				'excerpt'    => 300,
				'read'       => 'Read More',
				'read_icon'  => 'icon-caret-right',
				'cat'        => ''
			);

			$show = array(
				'yes' => 'Yes',
				'no'  => 'No',
			);

			$style = array(
				'style1' => 'Style 1',
				'style2' => 'Style 2',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$blog_typess = get_terms('category');
			$blog_types = array("all" => "All");
			foreach ($blog_typess as $type) {
				$blog_types[$type->name] = $type->name;
			}
			?>

			<h3 class="builder-block-title"><?php _e('Edit Blog',  'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title', 'bmd'); ?>
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					<?php _e('Title Size', 'bmd'); ?><br/>
					<?php echo aq_field_select('heading', $block_id, $heading_size, $heading) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('cat') ?>">
					<?php _e('Categories', 'bmd'); ?><br/>
				<?php echo aq_field_select('cat', $block_id, $blog_types, $cat); ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('num') ?>">
					<?php _e('Amount of on one page (block)', 'bmd'); ?>
					<?php echo aq_field_input('num', $block_id, $num, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('excerpt') ?>">
					<?php _e('Lenght of Excerpt (leave field blank if you want to show the full post)', 'bmd'); ?>
					<?php echo aq_field_input('excerpt', $block_id, $excerpt, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('show_cat') ?>">
					<?php _e('Show Categoryes', 'bmd'); ?><br/>
					<?php echo aq_field_select('show_cat', $block_id, $show, $show_cat) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('show_date') ?>">
					<?php _e('Show Date', 'bmd'); ?><br/>
					<?php echo aq_field_select('show_date', $block_id, $show, $show_date) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('show_comm') ?>">
					<?php _e('Show Comment', 'bmd'); ?><br/>
					<?php echo aq_field_select('show_comm', $block_id, $show, $show_comm) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('read') ?>">
					<?php _e('Read More Text (leave field blank if you want to hide the read more link)', 'bmd'); ?>
					<?php echo aq_field_input('read', $block_id, $read, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('read_icon') ?>">
					<?php _e('Read More Icon', 'bmd'); ?>
					<?php echo aq_field_input('read_icon', $block_id, $read_icon, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('blog_style') ?>">
					<?php _e('Blog Style', 'bmd'); ?><br/>
					<?php echo aq_field_select('blog_style', $block_id, $style, $blog_style) ?>
				</label>
			</p>
		<?php }



		function block($instance) {
			extract($instance);
			global $post, $paged, $wp_query, $excerpt2, $read2, $read_icon2, $col_width, $show_cat2, $show_date2, $show_comm2, $blog_style2;
			if (empty($paged)) { $paged = (get_query_var('page')) ? get_query_var('page') : 1; }

			$col_width  = aq_get_column_width($size);
			$excerpt2   = $excerpt;
			$read2      = $read;
			$read_icon2 = $read_icon;

			$show_cat2 = $show_cat;
			$show_date2 = $show_date;
			$show_comm2 = $show_comm;
			$blog_style2 = $blog_style;

			$cat = ($cat == 'all') ? '' : $cat;
            $args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $num, 'paged' => $paged, 'category_name' => $cat);      

            $temp = $wp_query;
			$wp_query= null;        
            $wp_query = new WP_Query($args);

      
			echo '<div class="blog-block">';

				if ($title) {
					echo '<div class="page-title clearfix">';
						echo '<' . $heading . '>' . $title . '</' . $heading . '>';
					echo '</div>';
				}

	            if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-wrapper'); ?>>
		            	<?php if (get_post_format()) {
							get_template_part( 'include/' . get_post_format() );
						} else {
							get_template_part( 'include/standart' );
						}?>
		            </article>
	            <?php endwhile; endif; 

			echo '</div>';

			bmd_pagination();

			$wp_query = null; $wp_query = $temp; 
		}
	}
}