<?php

// contact form 7 assets
define('WPCF7_LOAD_JS', false);
define('WPCF7_LOAD_CSS', false);

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
add_action('wp_enqueue_scripts', 'load_wpcf7_scripts');

function load_wpcf7_scripts() {
    if ( is_page('contact') ) {
        if (function_exists('wpcf7_enqueue_scripts')) {
            wpcf7_enqueue_scripts();
        }
        if (function_exists('wpcf7_enqueue_styles')) {
            wpcf7_enqueue_styles();
        }
    }
}

?>
