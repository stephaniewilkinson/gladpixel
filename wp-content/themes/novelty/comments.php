<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if (post_password_required()){ ?>
	<p class="nopassword">This post is password protected. Enter the password to view comments.</p> 
	<?php
	return;
} ?>

<?php if ( have_comments() ) : ?>
	<div class="comm-wrapper">

		<div class="page-title clearfix">
			<h3 class="post-title"><?php comments_number('No Comment', 'One Comment', '% Comments' );?></h3>
		</div>

		<ol class="commentlist">
			<?php wp_list_comments(array('callback' => 'bmd_comment_list')); ?>
		</ol>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
		<nav id="comment-nav" class="comment-nav" role="navigation">
			<div class="comm-prev"><?php previous_comments_link( __( '<i class="icon-chevron-left"></i> Older Comments', 'bmd' ) ); ?></div>
			<div class="comm-next"><?php next_comments_link( __( 'Newer Comments <i class="icon-chevron-right"></i>', 'bmd' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php
		if (!comments_open() && get_comments_number()) : ?>
		<p class="nocomments"><?php _e('Comments are closed.' , 'bmd'); ?></p>
		<?php endif; ?>

	</div><!-- end div.comm-wrapper -->
<?php endif; ?>


<?php 
$comment_form = array( 
	'fields' => apply_filters('comment_form_default_fields', array(

		'author' => '<fieldset class="comment-form-author">' .
					'<input id="author" name="author" type="text" placeholder="'.__('Name *', 'bmd') .'" value="' .
					esc_attr($commenter['comment_author']) . '" size="30" tabindex="1" />' .
					'</fieldset>',

		'email'  => '<fieldset class="comment-form-email">' .
					'<input id="email" name="email" type="text" placeholder="'.__('Email *', 'bmd') .'" value="' . 
					esc_attr($commenter['comment_author_email']) . '" size="30" tabindex="2" />' .
					'</fieldset>',

		'url'    => '<fieldset class="comment-form-url">' .
					'<input id="url" name="url" type="text" placeholder="'.__('Website', 'bmd') .'" value="' . 
					esc_attr($commenter['comment_author_url']) . '" size="30" tabindex="3" />' .
					'</fieldset>' )),

		'comment_field' => '<fieldset class="comment_form_message">'.'<textarea id="comment" name="comment"></textarea>'.'</fieldset>',

		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'logged_in_as' => '',
		'title_reply' => '<div class="page-title clearfix"><h3 class="post-title">' . __('Leave a Reply', 'bmd') . '</h3></div>',
		'cancel_reply_link' => __('Cancel Reply', 'bmd'),
		'label_submit'=> __('Post Comment', 'bmd'),
		'id_submit' => 'button',

);

comment_form($comment_form, $post->ID);