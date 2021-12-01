<?php

// svg uploads
function svg_mime_type($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'svg_mime_type');

?>
