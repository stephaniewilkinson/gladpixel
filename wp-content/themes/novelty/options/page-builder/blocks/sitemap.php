<?php
/*-----------------------------------------------------------------------------------*/
/* SITEMAP BLOCK
/*-----------------------------------------------------------------------------------*/
if (!class_exists('BMD_Sitemap_Block')) {
	class BMD_Sitemap_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name'  => 'Sitemap',
				'size'  => 'span12',
				'icons' => 'icon-sitemap',
			);
			
			parent::__construct('bmd_sitemap_block', $block_options);
		}
		
		function form($instance) {

			$defaults = array(
				'blog_title'      => 'Blog',
				'cat_title'       => 'Categories',
				'archive_title'   => 'Archives',
				'feeds_title'     => 'Feeds',
				'portfolio_title' => 'Portfolio',
				'page_title'      => 'Page',
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<h3 class="builder-block-title"><?php _e('Edit Sitemap', 'bmd'); ?></h3>

			<p class="description">
				<label for="<?php echo $this->get_field_id('blog_title') ?>">
					<?php _e('Blog Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('blog_title', $block_id, $blog_title) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('cat_title') ?>">
					<?php _e('Categories Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('cat_title', $block_id, $cat_title) ?>
				</label>
			</p>
		
			<p class="description">
				<label for="<?php echo $this->get_field_id('archive_title') ?>">
					<?php _e('Archives Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('archive_title', $block_id, $archive_title) ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('feeds_title') ?>">
					<?php _e('Feeds Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('feeds_title', $block_id, $feeds_title) ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('portfolio_title') ?>">
					<?php _e('Portfolio Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('portfolio_title', $block_id, $portfolio_title) ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('page_title') ?>">
					<?php _e('Page Title', 'bmd'); ?><br/>
					<?php echo aq_field_input('page_title', $block_id, $page_title) ?>
				</label>
			</p>
		<?php }
		
		function block($instance) {
			extract($instance);
			?>

			<div class="row">

				<div class="span4">

					<div class="page-title clearfix">
						<?php echo '<h3>' . $blog_title. '</h3>'; ?>
					</div>
	                <ul class="sitemap-list">
	                    <?php $archive_query = new WP_Query('showposts=1000&#038;cat=-8'); while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
	                        <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></li>
	                    <?php endwhile; ?>
	                </ul>

					<div class="page-title clearfix">
						<?php echo '<h3>' . $cat_title . '</h3>'; ?>
					</div>
	                <ul class="sitemap-list">
	                    <?php 
	                    $args = array(  
						  'orderby'      => 'name', 
						  'show_count'   => 1, 
						  'hierarchical' => 0,
						  'title_li'     => ''
						);  
	                    ?>
	                    <?php wp_list_categories( $args ); ?>
	                </ul>

					<div class="page-title clearfix">
						<?php echo '<h3>' . $archive_title . '</h3>'; ?>
					</div>
	                <ul class="sitemap-list">
	                    <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
	                </ul>

					<div class="page-title clearfix">
						<?php echo '<h3>' . $feeds_title . '</h3>'; ?>
					</div>
	                <ul class="sitemap-list">
	                    <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>
	                    <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>
	                </ul>

	            </div>

	            <div class="span4">
					<div class="page-title clearfix">
						<?php echo '<h3>' . $portfolio_title . '</h3>'; ?>
					</div>
	                <ul class="sitemap-list"><?php
	                $args=array(
	                    'post_type'      => 'portfolio',
	                    'post_status'    => 'publish',
	                    'posts_per_page' => -1,
	                );
	                $wp_query = '';
	                $temp = $wp_query;
	                $wp_query= null;
	                $wp_query = new WP_Query($args);         
	                if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();  
	                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
	                endwhile; endif; 
	                ?></ul>
	            </div>

	            <div class="span4">
					<div class="page-title clearfix">
						<?php echo '<h3>' . $page_title . '</h3>'; ?>
					</div>
	                <ul class="sitemap-list">
	                    <?php wp_list_pages("title_li="); ?>
	                </ul>
	            </div> 

            </div>
        <?php }
		
	}
}