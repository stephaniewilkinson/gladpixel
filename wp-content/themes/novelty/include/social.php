<?php
global $smof_data;

if ($smof_data['social_tooltip'] == 1) wp_enqueue_script('tipsy');

if ($smof_data['twitter']) 
	echo '<li><a href="' . $smof_data['twitter'] . '" data-rel="tipsy-n" class="social-twitter" title="Twitter" target="_blank"></a></li>';

if ($smof_data['facebook']) 
	echo '<li><a href="' . $smof_data['facebook'] . '" data-rel="tipsy-n" class="social-facebook" title="Facebook" target="_blank"></a></li>';

if ($smof_data['dribbble']) 
	echo '<li><a href="' . $smof_data['dribbble'] . '" data-rel="tipsy-n" class="social-dribbble" title="Dribbble" target="_blank"></a></li>';

if ($smof_data['pinterest']) 
	echo '<li><a href="' . $smof_data['pinterest'] . '" data-rel="tipsy-n" class="social-pinterest" title="Pinterest" target="_blank"></a></li>';

if ($smof_data['google']) 
	echo '<li><a href="' . $smof_data['google'] . '" data-rel="tipsy-n" class="social-gplus" title="Google +" target="_blank"></a></li>';

if ($smof_data['google-circles']) 
	echo '<li><a href="' . $smof_data['google-circles'] . '" data-rel="tipsy-n" class="social-google-circles" title="Google Circles" target="_blank"></a></li>';

if ($smof_data['youtube']) 
	echo '<li><a href="' . $smof_data['youtube'] . '" data-rel="tipsy-n" class="social-youtube" title="Youtube" target="_blank"></a></li>';

if ($smof_data['vimeo']) 
	echo '<li><a href="' . $smof_data['vimeo'] . '" data-rel="tipsy-n" class="social-vimeo" title="Vimeo" target="_blank"></a></li>';

if ($smof_data['flickr']) 
	echo '<li><a href="' . $smof_data['flickr'] . '" data-rel="tipsy-n" class="social-flickr" title="Flickr" target="_blank"></a></li>';

if ($smof_data['instagram']) 
	echo '<li><a href="' . $smof_data['instagram'] . '" data-rel="tipsy-n" class="social-instagram" title="Instagram" target="_blank"></a></li>';

if ($smof_data['soundcloud']) 
	echo '<li><a href="' . $smof_data['soundcloud'] . '" data-rel="tipsy-n" class="social-soundcloud" title="Soundcloud" target="_blank"></a></li>';

if ($smof_data['linkedin']) 
	echo '<li><a href="' . $smof_data['linkedin'] . '" data-rel="tipsy-n" class="social-linkedin" title="Linkedin" target="_blank"></a></li>';

if ($smof_data['github']) 
	echo '<li><a href="' . $smof_data['github'] . '" data-rel="tipsy-n" class="social-github" title="Github" target="_blank"></a></li>';

if ($smof_data['tumblr']) 
	echo '<li><a href="' . $smof_data['tumblr'] . '" data-rel="tipsy-n" class="social-tumblr" title="Tumblr" target="_blank"></a></li>';

if ($smof_data['lastfm']) 
	echo '<li><a href="' . $smof_data['lastfm'] . '" data-rel="tipsy-n" class="social-lastfm" title="Lastfm" target="_blank"></a></li>';

if ($smof_data['picasa']) 
	echo '<li><a href="' . $smof_data['picasa'] . '" data-rel="tipsy-n" class="social-picasa" title="Picasa" target="_blank"></a></li>';

if ($smof_data['spotify']) 
	echo '<li><a href="' . $smof_data['spotify'] . '" data-rel="tipsy-n" class="social-spotify" title="Spotify" target="_blank"></a></li>';

if ($smof_data['dropbox']) 
	echo '<li><a href="' . $smof_data['dropbox'] . '" data-rel="tipsy-n" class="social-dropbox" title="Dropbox" target="_blank"></a></li>';

if ($smof_data['evernote']) 
	echo '<li><a href="' . $smof_data['evernote'] . '" data-rel="tipsy-n" class="social-evernote" title="Evernote" target="_blank"></a></li>';

if ($smof_data['flattr']) 
	echo '<li><a href="' . $smof_data['flattr'] . '" data-rel="tipsy-n" class="social-flattr" title="Flattr" target="_blank"></a></li>';

if ($smof_data['renren']) 
	echo '<li><a href="' . $smof_data['renren'] . '" data-rel="tipsy-n" class="social-renren" title="Renren" target="_blank"></a></li>';

if ($smof_data['paypal']) 
	echo '<li><a href="' . $smof_data['paypal'] . '" data-rel="tipsy-n" class="social-paypal" title="Paypal" target="_blank"></a></li>';

if ($smof_data['mixi']) 
	echo '<li><a href="' . $smof_data['mixi'] . '" data-rel="tipsy-n" class="social-mixi" title="Mixi" target="_blank"></a></li>';

if ($smof_data['smashing']) 
	echo '<li><a href="' . $smof_data['smashing'] . '" data-rel="tipsy-n" class="social-smashing" title="Smashing" target="_blank"></a></li>';

if ($smof_data['behance']) 
	echo '<li><a href="' . $smof_data['behance'] . '" data-rel="tipsy-n" class="social-behance" title="Behance" target="_blank"></a></li>';

if ($smof_data['rdio']) 
	echo '<li><a href="' . $smof_data['rdio'] . '" data-rel="tipsy-n" class="social-rdio" title="Rdio" target="_blank"></a></li>';

if ($smof_data['stumbleupon']) 
	echo '<li><a href="' . $smof_data['stumbleupon'] . '" data-rel="tipsy-n" class="social-stumbleupon" title="Stumbleupon" target="_blank"></a></li>';

if ($smof_data['500px']) 
	echo '<li><a href="' . $smof_data['500px'] . '" data-rel="tipsy-n" class="social-500px" title="500px" target="_blank"></a></li>';

if ($smof_data['deviantart']) 
	echo '<li><a href="' . $smof_data['deviantart'] . '" data-rel="tipsy-n" class="social-deviantart" title="Deviantart" target="_blank"></a></li>';

if ($smof_data['yelp']) 
	echo '<li><a href="' . $smof_data['yelp'] . '" data-rel="tipsy-n" class="social-yelp" title="Yelp" target="_blank"></a></li>';