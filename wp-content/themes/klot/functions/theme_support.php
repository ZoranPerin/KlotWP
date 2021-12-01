<?php

if (function_exists('add_theme_support'))
{
    // menu support
    add_theme_support('menus');

    // thumbnail support
    add_theme_support('post-thumbnails');
    add_image_size('large', 1200, '', true);
    add_image_size('medium', 600, 600, true);
    add_image_size('share', 1200, 630, true);
}

?>
