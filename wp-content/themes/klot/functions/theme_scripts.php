<?php

// scripts
function wp_theme_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('mainscript', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
        wp_enqueue_script('mainscript');
    }
}
add_action('init', 'wp_theme_header_scripts');

?>
