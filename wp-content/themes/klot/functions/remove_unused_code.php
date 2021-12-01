<?php

// Remove unused CSS from WP
function smartwp_remove_wp_block_library_css(){
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

?>
