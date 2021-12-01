<?php

// ACF Options page
if( function_exists('acf_add_options_page') ) {
   	acf_add_options_page(array(
       'page_title'    => 'Theme options',
       'menu_title'    => 'Theme options',
       'menu_slug'     => 'theme-general-settings',
       'capability'    => 'edit_posts',
       'redirect'      => true
   	));
}

?>
