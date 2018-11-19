<?php 

/*-----------------------------------------------------------------------------------*/
/* Include shortcodes.js script for text editor */
/*-----------------------------------------------------------------------------------*/
function bmd_shortcodes_init() {
	if (is_admin()) {
		wp_enqueue_script('shortcodes', BMD_PATH .'/options/shortcodes/shortcodes.js', array('jquery'));
		add_action('wp_ajax_choice', 'bmd_create_shortcodes');
	}
}
add_action('init', 'bmd_shortcodes_init');


/*-----------------------------------------------------------------------------------*/
/* Add button to editor media nav */
/*-----------------------------------------------------------------------------------*/
add_action('media_buttons', 'add_shortcodes_media_button', 20);
function add_shortcodes_media_button() {
	echo '<a class="thickbox shortcode-link" href="' . get_option('siteurl') . '/wp-admin/admin-ajax.php?action=choice&width=560" title="Sortcode Generator"><img src="' . BMD_PATH . '/options/shortcodes/shortcodes.png" alt="Create Sortcode"></a>';
}

function bmd_create_shortcodes() { ?>

	<script type="text/javascript" src="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes.js"></script>
	<link href="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes.css" rel="stylesheet" type="text/css" />


	<!-- BEGIN: TAB LINK -->
	<div class="nav_wrapper">
		<select class="nav-shortcode-tabs">
			<option value="0"><a href="#"><?php _e('Row', 'bmd') ?></a></option>
			<option value="1"><a href="#"><?php _e('Columns', 'bmd') ?></a></option>
			<option value="2"><a href="#"><?php _e('Block Title', 'bmd') ?></a></option>
			<option value="3"><a href="#"><?php _e('Alert Box', 'bmd') ?></a></option>
			<option value="4"><a href="#"><?php _e('Button', 'bmd') ?></a></option>
			<option value="5"><a href="#"><?php _e('Divider / Space', 'bmd') ?></a></option>
		    <option value="6"><a href="#"><?php _e('Images', 'bmd') ?></a></option>
		    <option value="7"><a href="#"><?php _e('Lists', 'bmd') ?></a></option>
		    <option value="8"><a href="#"><?php _e('Icon', 'bmd') ?></a></option>
		    <option value="9"><a href="#"><?php _e('Twitter', 'bmd') ?></a></option>
		    <option value="10"><a href="#"><?php _e('Flickr', 'bmd') ?></a></option>
		    <option value="11"><a href="#"><?php _e('Google Map', 'bmd') ?></a></option>
		    <option value="12"><a href="#"><?php _e('Features', 'bmd') ?></a></option>
		    <option value="13"><a href="#"><?php _e('Social', 'bmd') ?></a></option>
		    <option value="14"><a href="#"><?php _e('Flexslider', 'bmd') ?></a></option>
		    <option value="15"><a href="#"><?php _e('Video', 'bmd') ?></a></option>
		    <option value="16"><a href="#"><?php _e('Testimonials', 'bmd') ?></a></option>
		    <option value="17"><a href="#"><?php _e('Client', 'bmd') ?></a></option>
		    <option value="18"><a href="#"><?php _e('Toogle', 'bmd') ?></a></option>
		    <option value="19"><a href="#"><?php _e('Accordion', 'bmd') ?></a></option>
		    <option value="20"><a href="#"><?php _e('Tab', 'bmd') ?></a></option>
		</select>
	</div>
	<!-- END: TAB LINK -->


	<!-- BEGIN: ROW SHORTCODE -->
	<div class="shortcode-tab">
	    <form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

	    	<h3><?php _e('Row Shortcodes', 'bmd') ?></h3>

	        <fieldset>
	        	<div class="group-field">
					<label><?php _e('Select row:', 'bmd') ?></label>
					<div class="field">
						<select name="style">
							<option value=''>Full Width Page</option>
							<option value='fluid'>Sidebar Page</option>
						</select>
					</div>
				</div>
	   		
	            <div class="group-button">
	            	<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>" name="submit" />
	            </div>

	            <input type="hidden" name="code" value="row" />
	        </fieldset>

	    </form>
	</div>
	<!-- END: ROW SHORTCODE -->  


	<!-- BEGIN: COLUMN SHORTCODE -->
	<div class="shortcode-tab">
	    <form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

	    	<h3><?php _e('Columns Shortcodes', 'bmd') ?></h3>

	        <fieldset>
	        	<div class="group-field">
		            <label for="columns-code"><?php _e('Column Type:', 'bmd') ?></label>
		            <div class="field">
		                <select id="columns-code" class="select" name="code">
		                    <option value='col_1'><?php _e('Column 1', 'bmd') ?></option>
		                    <option value='col_2'><?php _e('Column 2', 'bmd') ?></option>
		                    <option value='col_3'><?php _e('Column 3', 'bmd') ?></option>
		                    <option value='col_4'><?php _e('Column 4', 'bmd') ?></option>
		                    <option value='col_5'><?php _e('Column 5', 'bmd') ?></option>
		                    <option value='col_6'><?php _e('Column 6', 'bmd') ?></option>
		                    <option value='col_7'><?php _e('Column 7', 'bmd') ?></option>
		                    <option value='col_8'><?php _e('Column 8', 'bmd') ?></option>
		                    <option value='col_9'><?php _e('Column 9', 'bmd') ?></option>
		                    <option value='col_10'><?php _e('Column 10', 'bmd') ?></option>
		                    <option value='col_11'><?php _e('Column 11', 'bmd') ?></option>
		                    <option value='col_12'><?php _e('Column 12', 'bmd') ?></option>
		                 </select>
		                 <span class="desc"><?php _e('Select width of the column', 'bmd') ?></span>
		            </div>
	            </div>

	   			<div class="group-field">
		    		<label for="columns-content"><?php _e('Column Content (optional):', 'bmd') ?></label>
		    		<div class="field">
		    			<textarea id="columns-content" name="content"></textarea>
		    			<span class="desc"><?php _e('Add The column content', 'bmd') ?></span>
		    		</div>
	    		</div>
	    		
	            <div class="group-button">
	            	<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>" name="submit" />
	            </div>
	        </fieldset>

	    </form>
	</div>
	<!-- END: COLUMN SHORTCODE -->  


	<!-- BEGIN: BLOCK TITLE SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Block Title', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Text:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="text" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Size:', 'bmd') ?></label>
					<div class="field">
						<select name="size">
							<option value='h1'><?php _e('H1', 'bmd') ?></option>
							<option value='h2'><?php _e('H2', 'bmd') ?></option>
							<option value='h3'><?php _e('H3', 'bmd') ?></option>
							<option value='h4'><?php _e('H4', 'bmd') ?></option>
							<option value='h5'><?php _e('H5', 'bmd') ?></option>
							<option value='h6'><?php _e('H6', 'bmd') ?></option>
						</select>
						<span class="desc"><?php _e('Choose a size for heading', 'bmd') ?></span>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="block_title" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: BLOCK TITLE SHORTCODE --> 


	<!-- BEGIN: ALERT BOX SHORTCODES -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Alert Box', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Style:', 'bmd') ?></label>
					<div class="field">
						<select name="style">
							<option value='default'><?php _e('Standard', 'bmd') ?></option>
							<option value='info'><?php _e('Info', 'bmd') ?></option>
							<option value='note'><?php _e('Notification', 'bmd') ?></option>
							<option value='warning'><?php _e('Warning', 'bmd') ?></option>
							<option value='tips'><?php _e('Tips', 'bmd') ?></option>
						</select>
						<span class="desc"><?php _e('Choose a style for alert box', 'bmd') ?></span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Title (optional):', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="heading" />
						<span class="desc"><?php _e('Add the title content', 'bmd') ?></span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Content:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content"></textarea>
						<span class="desc"><?php _e('Add the alert box content', 'bmd') ?></span>
					</div>	
				</div>

				<div class="group-field">
					<label><?php _e('Icon class (optional) <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">refer here</a>', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="icon" />
					</div>
				</div>
						
				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="alert" />

			</fieldset>
		</form>
	</div>
	<!-- END: ALERT BOX SHORTCODES --> 


	<!-- BEGIN: BUTTON SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Button', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Button size:', 'bmd') ?></label>
					<div class="field">
						<select name="size">
							<option value=''><?php _e('Default', 'bmd') ?></option>
							<option value='small'><?php _e('Small', 'bmd') ?> </option>
							<option value='large'><?php _e('Large', 'bmd') ?></option>
						</select>
						<span class="desc"><?php _e('Select the button size', 'bmd') ?></span>
					</div>
				</div>


				<div class="group-field">
					<label><?php _e('Button URL:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="url" />
						<span class="desc"><?php _e('Add the button url eg http://example.com', 'bmd') ?></span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Button text:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="text" />
						<span class="desc"><?php _e('Add the button text', 'bmd') ?></span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Button target:', 'bmd') ?></label>
					<div class="field">
						<select name="target">
							<option value='_self'>_slef</option>
							<option value='_blank'>_blank</option>
						</select>
						<span class="desc"><?php _e('_self = open in same window. _blank = open in new window', 'bmd') ?></span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Icon class (optional) <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">refer here</a>', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="icon" />
					</div>
				</div>
				
				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="button" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: BUTTON SHORTCODE -->  


	<!-- BEGIN: DIVIDER / SPACE SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3>Divider / Space</h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Style:', 'bmd') ?></label>
					<div class="field">
						<select name="style">
							<option value='none'>None</option>
							<option value='single'>Single</option>
							<option value='double'>Double</option>
						</select>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Margin Top:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="mt" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Margin Bottom:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="mb" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="Insert Shortcode"  name="submit" />
				</div>

				<input type="hidden" name="code" value="divider" />
			</fieldset>

		</form>
	</div>
	<!-- END: DIVIDER / SPACE SHORTCODE -->


	<!-- BEGIN: IMAGE SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" class="shortcode-form">
			
			<h3>Image</h3>

			<fieldset>
				<div class="group-field">
					<label for="ibm-image-img" class="row-label">Image url:</label>
					<div class="field">
						<input type="text" value="" name="img" id="ibm-image-img" class="text-input required" />
					</div>
				</div>

				<div class="group-field">
					<label for="ibm-image-alt" class="row-label">Alt:</label>
					<div class="field">
						<input type="text" value="" name="alt" id="ibm-image-alt" class="text-input" />
					</div>
				</div>

				<div class="group-field">
					<label for="ibm-image-align" class="row-label">Align:</label>
					<div class="field">
						<select id="ibm-image-align" class="select" name="align">
							<option value=''>None</option>
							<option value='left'>Left</option>
							<option value='right'>Right</option>
							<option value='center'>Center</option>
						</select>
					</div>
				</div>
	            
	            <div class="group-field">
					<label for="ibm-image-width" class="row-label">Width:</label>
					<div class="field">
						<input type="text" value="" name="width" id="ibm-image-width" class="text-input" />
					</div>
				</div>

				<div class="group-field">
					<label for="ibm-image-height" class="row-label">Height:</label>
					<div class="field">
						<input type="text" value="" name="height" id="ibm-image-height" class="text-input" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Open in lightbox:', 'bmd') ?></label>
					<div class="field">
						<select name="lightbox">
							<option value='no'><?php _e('No', 'bmd') ?></option>
							<option value='yes'><?php _e('Yes', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="Insert Shortcode"  name="submit" />
				</div>

				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="code" value="image" />
			</fieldset>

		</form>
	</div>
	<!-- BEGIN: IMAGE SHORTCODE -->


	<!-- BEGIN: LIST SHORTCODES -->
	<div class="shortcode-tab">

		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-lists">

			<h3><?php _e('Lists', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Style:', 'bmd') ?></label>
					<div class="field">
						<select name="style">
							<option value='square'><?php _e('Square', 'bmd') ?></option>
							<option value='circle'><?php _e('Circle', 'bmd') ?></option>
							<option value='disc'><?php _e('Disc', 'bmd') ?></option>
							<option value='numeric'><?php _e('Numeric', 'bmd') ?></option>
							<option value='unstyled'><?php _e('Unstyled', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('lists Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>
				
				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-lists-item" value="<?php _e('Create lists Item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="ul" />
			</fieldset>

		</form>


		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-lists-item" class="helper">
			
			<h3><?php _e('List Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Items:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="text" class="content"/>
						<span class="desc"><?php _e('Add teh lists heading', 'bmd')?></span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Icon class (optional) <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">refer here</a>', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="icon" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add Accordion Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="li" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-lists" />
			</fieldset>

		</form>
	</div>
	<!-- END: LIST SHORTCODES -->

	
	<!-- BEGIN: ICON SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Icon', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Icon class (optional) <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">refer here</a>', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="class" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Icon Size', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="18px" name="size" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="icon" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: ICON SHORTCODE --> 


	<!-- BEGIN: TWITTER SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Twitter', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('User name', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="user" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Number of tweets', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="3" name="num" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="twitter" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: TWITTER SHORTCODE --> 


	<!-- BEGIN: FLICKR SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Flickr', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Your Flickr User ID', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="user" />
						<span class="desc">Don't know your ID? Head on over to <a href="http://idgettr.com">idgettr</a> to find it)</span>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Number of Photos', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="6" name="num" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="flickr" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: FLICKR SHORTCODE --> 


	<!-- BEGIN: GOOGLE MAP SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Google Map', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Address', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="address" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Coordinates', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="coordinates" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Zoom Level', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="15" name="zoom" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Map Height (in pixels)', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="300px" name="height" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="google_map" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: GOOGLE MAP SHORTCODE --> 


	<!-- BEGIN: FEATURES SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Features', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Title', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="title" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Title size:', 'bmd') ?></label>
					<div class="field">
						<select name="title_size">
							<option value='h1'><?php _e('H1', 'bmd') ?></option>
							<option value='h2'><?php _e('H2', 'bmd') ?></option>
							<option value='h3'><?php _e('H3', 'bmd') ?></option>
							<option value='h4'><?php _e('H4', 'bmd') ?></option>
							<option value='h5'><?php _e('H5', 'bmd') ?></option>
							<option value='h6'><?php _e('H6', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Text', 'bmd') ?></label>
					<div class="field">
						<textarea name="content"></textarea>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Icon class (optional) <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">refer here</a>', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="icon" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('URL (optional)', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="url" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="features" />
			</fieldset>

		</form>
	</div>
	<!-- END: FEATURES SHORTCODE --> 
	

	<!-- BEGIN: SOCIAL SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('SOCIAL', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Enter your Facebook URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="facebook" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Twitter URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="twitter" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Dribbble URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="dribbble" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Pinterset URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="pinterset" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Vimeo URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="vimeo" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Linkedin URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="linkedin" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Google URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="google" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Flickr URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="flickr" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Lastfm URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="lastfm" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Forrst URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="forrst" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Skype user name', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="skype" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Picassa URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="picassa" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Youtube URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="youtube" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Behance URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="behance" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Tumblr URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="tumblr" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Blogger URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="blogger" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Delicious URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="delicious" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Digg URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="digg" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Friendfeed URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="friendfeed" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Github URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="github" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Wordpress URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="wordpress" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Enter your Rss URL', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="rss" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="social" />
				<input type="hidden" name="type" value="single" />
			</fieldset>

		</form>
	</div>
	<!-- END: SOCIAL SHORTCODE --> 


	<!-- BEGIN: FLEXSLIDER SHORTCODES -->
	<div class="shortcode-tab">

		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-slider">

			<h3><?php _e('Flexslider', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Slider Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Animation', 'bmd') ?></label>
					<div class="field">
						<select name="animation">
							<option value='fade'><?php _e('Fade', 'bmd') ?></option>
							<option value='slide'><?php _e('Slide', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Slideshow Speed', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="slide_speed " />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Animation Speed', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="animation_speed " />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-slider-item" value="<?php _e('Create slider Item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="slider_group" />
			</fieldset>

		</form>


		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-slider-item" class="helper">
			
			<h3><?php _e('Slider Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Images url:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="img" class="content"/>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Text', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="text" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Image Width', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="width" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Image Height', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="height" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add Slider Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="slider" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-slider" />
			</fieldset>

		</form>
	</div>
	<!-- END: FLEXSLIDER SHORTCODES -->


	<!-- BEGIN: VIDEO SHORTCODE -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php">

			<h3><?php _e('Features', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Video Type:', 'bmd') ?></label>
					<div class="field">
						<select name="cat">
							<option value='vimeo'><?php _e('Vimeo', 'bmd') ?></option>
							<option value='youtube'><?php _e('Youtube', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Video id', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="id" />
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="video" />
			</fieldset>

		</form>
	</div>
	<!-- END: VIDEO SHORTCODE --> 


	<!-- BEGIN: TESTIMONIALS SHORTCODES -->
	<div class="shortcode-tab">
		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-testimonials">

			<h3><?php _e('Flexslider', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Testimonials Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-testimonials-item" value="<?php _e('Create testimonials Item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="testimonials_group" />
			</fieldset>

		</form>

		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-testimonials-item" class="helper">
			
			<h3><?php _e('Slider Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('author:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="author"/>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Link', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="link" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Copmany', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="company" />
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Content', 'bmd') ?></label>
					<div class="field">
						<textarea name="text"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add Slider Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="testimonials" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-testimonials" />
			</fieldset>

		</form>
	</div>
	<!-- END: TESTIMONIALS SHORTCODES -->


	<!-- BEGIN: CLIENT SHORTCODES -->
	<div class="shortcode-tab">

		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-client">

			<h3><?php _e('Client', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Client Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Column', 'bmd') ?></label>
					<div class="field">
						<select name="col">
							<option value='2'><?php _e('2', 'bmd') ?></option>
							<option value='2'><?php _e('3', 'bmd') ?></option>
							<option value='3'><?php _e('4', 'bmd') ?></option>
							<option value='5'><?php _e('5', 'bmd') ?></option>
							<option value='6'><?php _e('6', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-client-item" value="<?php _e('Create client item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="client_group" />
			</fieldset>

		</form>


		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-client-item" class="helper">
			
			<h3><?php _e('Client Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Images url:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="img" class="content"/>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add client Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="client" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-client" />
			</fieldset>

		</form>
	</div>
	<!-- END: CLIENT SHORTCODES -->


	<!-- BEGIN: TOOGLE SHORTCODES -->
	<div class="shortcode-tab">

		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-toogle">

			<h3><?php _e('Toogle', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Toogle Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-toogle-item" value="<?php _e('Create toogle item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="toogle_group" />
			</fieldset>

		</form>


		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-toogle-item" class="helper">
			
			<h3><?php _e('Toogle Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Title:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="title" class="content"/>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Content:', 'bmd') ?></label>
					<div class="field">
						<textarea name="text" class="content"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add toogle Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="toogle" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-toogle" />
			</fieldset>

		</form>
	</div>
	<!-- END: TOOGLE SHORTCODES -->

	<!-- BEGIN: ACCORDION SHORTCODES -->
	<div class="shortcode-tab">

		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-accordion">

			<h3><?php _e('Accordion', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Accordion Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-accordion-item" value="<?php _e('Create accordion item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="accordion_group" />
			</fieldset>

		</form>


		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-accordion-item" class="helper">
			
			<h3><?php _e('Accordion Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Title:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="title" class="content"/>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Content:', 'bmd') ?></label>
					<div class="field">
						<textarea name="text" class="content"></textarea>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Column', 'bmd') ?></label>
					<div class="field">
						<select name="open">
							<option value='no'><?php _e('No', 'bmd') ?></option>
							<option value='yes'><?php _e('Yes', 'bmd') ?></option>
						</select>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add accordion Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="accordion" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-accordion" />
			</fieldset>

		</form>
	</div>
	<!-- END: ACCORDION SHORTCODES -->

	<!-- BEGIN: TAB SHORTCODES -->
	<div class="shortcode-tab">

		<form method="post" action="<?php echo BMD_PATH ?>/options/shortcodes/shortcodes-handler.php" id="form-tab">

			<h3><?php _e('tab', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Tab Item:', 'bmd') ?></label>
					<div class="field">
						<textarea name="content" class="content"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary link-create-item" rel="form-tab-item" value="<?php _e('Create tab item', 'bmd') ?>" />
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="tab_group" />
			</fieldset>

		</form>


		<form method="post" action="<?php echo BMD_PATH; ?>/options/shortcodes/shortcodes-handler.php" id="form-tab-item" class="helper">
			
			<h3><?php _e('Tab Item', 'bmd') ?></h3>

			<fieldset>
				<div class="group-field">
					<label><?php _e('Title:', 'bmd') ?></label>
					<div class="field">
						<input type="text" value="" name="title" class="content"/>
					</div>
				</div>

				<div class="group-field">
					<label><?php _e('Content:', 'bmd') ?></label>
					<div class="field">
						<textarea name="text" class="content"></textarea>
					</div>
				</div>

				<div class="group-button">
					<input type="submit" class="button-primary btn-submit" value="<?php _e('Add tab Item', 'bmd') ?>"  name="submit" />
				</div>

				<input type="hidden" name="code" value="tab" />
				<input type="hidden" name="type" value="single" />
				<input type="hidden" name="form" class="helper-form" value="form-tab" />
			</fieldset>

		</form>
	</div>
	<!-- END: TAB SHORTCODES -->

<?php
exit();
}
