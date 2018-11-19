<?php
function queryString($params, $name=null) {

	$ret = "";

	foreach ($params as $key=>$val) {

		if (is_array($val)) {
		
			if ($name==null) {
				$ret .= queryString($val, $key);
			} else {
				$ret .= queryString($val, $name."[$key]");
			}
			
		} else {
			if($name!=null) {
				if( !($key == 'code' || $key == 'action' || $key == 'content' || $key == 'type' || $key == 'form')){
					if ($val != '') {
						$ret.= " " . stripslashes($name[$key]) . "='" . stripslashes($val) . "'";
					}
				}
			} else {
				if (!($key == 'code' || $key == 'action' || $key == 'content' || $key == 'type' || $key == 'form')) {
					if ($val != '') {
						$ret.= " " . stripslashes($key) . "='" . stripslashes($val) . "'";
					}
				}
			}
		}
		
	}
	
	return $ret;   
}


if (isset($_POST['code'])) {

	$error     = false;
	$shortcode = '';
	$codeName  = stripslashes($_POST['code']);
	$params    = '';
	
	// Get text content
	if (isset($_POST['content'])) {
	
		if (isset($_POST['formatter'])) {
			//	$content = $_POST['formatter'] == 1 ? "\n\n" : '' ;
			$content = stripslashes($_POST['content']);
		
		} else {
			$content = stripslashes($_POST['content']);
		}
	}

	// Get shortcode parameters
	$params   = queryString($_POST);
	$tagOpen  = "[" . $codeName . $params ."]";
	$tagClose = "[/" . $codeName . "]";
	
	// Check if type = single
	if (isset($_POST['type'])) {
		if ($_POST['type'] == 'single') {
			$shortcode = $tagOpen."\n";
		}
	} else if ($codeName == 'br' || $codeName == 'divider' || $codeName == 'clear_divider' || $codeName == 'clear' || $codeName == 'check' || $codeName == 'cross'){
		$shortcode = $tagOpen."\n";
	} else {
		// Build shortcode
		$shortcode = $tagOpen . $content . $tagClose."\n";
	}
	echo stripslashes($shortcode);
}