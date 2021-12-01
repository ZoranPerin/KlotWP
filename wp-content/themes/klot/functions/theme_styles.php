<?php

// styles
function wp_theme_styles()
{
    wp_register_style('wp_theme', get_template_directory_uri() . '/assets/css/style.css', array(), null, 'all');
    wp_enqueue_style('wp_theme');
}
add_action('wp_enqueue_scripts', 'wp_theme_styles');

?>
