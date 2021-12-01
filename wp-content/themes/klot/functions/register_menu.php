<?php

// menu
function register_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header menu', 'wp_theme'),
        'footer-menu' => __('Footer menu', 'wp_theme'),
    ));
}
add_action('init', 'register_menu');

?>
