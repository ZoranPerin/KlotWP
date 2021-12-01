<?php

// CUSTOM POST TYPES //
function create_post_type()
{

    $labels = array(
        'name' => __('Products', 'wp_theme'),
        'singular_name' => __('Product', 'wp_theme'),
        'add_new' => __('Add new', 'wp_theme'),
        'add_new_item' => __('Add new product', 'wp_theme'),
        'edit' => __('Edit', 'wp_theme'),
        'edit_item' => __('Edit product', 'wp_theme'),
        'new_item' => __('New product', 'wp_theme'),
        'view' => __('View', 'wp_theme'),
        'view_item' => __('View product', 'wp_theme'),
        'search_items' => __('Search', 'wp_theme'),
        'not_found' => __('Not found', 'wp_theme'),
        'not_found_in_trash' => __('Not found in trash', 'wp_theme')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ),
        'can_export' => true,
        'taxonomies' => array(
            'product-category'
        )
    );

    register_post_type('product', $args);

}

add_action('init', 'create_post_type');

// Register Custom Product Taxonomy
function create_post_taxonomy() {

    $labels = array(
        'name'                       => _x('Categories', 'Taxonomy General Name', 'wp_theme'),
        'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'wp_theme'),
        'menu_name'                  => __('Categories', 'wp_theme'),
        'all_items'                  => __('All Items', 'wp_theme'),
        'parent_item'                => __('Parent Item', 'wp_theme'),
        'parent_item_colon'          => __('Parent Item:', 'wp_theme'),
        'new_item_name'              => __('New Item Name', 'wp_theme'),
        'add_new_item'               => __('Add New Item', 'wp_theme'),
        'edit_item'                  => __('Edit Item', 'wp_theme'),
        'update_item'                => __('Update Item', 'wp_theme'),
        'view_item'                  => __('View Item', 'wp_theme'),
        'separate_items_with_commas' => __('Separate items with commas', 'wp_theme'),
        'add_or_remove_items'        => __('Add or remove items', 'wp_theme'),
        'choose_from_most_used'      => __('Choose from the most used', 'wp_theme'),
        'popular_items'              => __('Popular Items', 'wp_theme'),
        'search_items'               => __('Search Items', 'wp_theme'),
        'not_found'                  => __('Not Found', 'wp_theme'),
        'no_terms'                   => __('No items', 'wp_theme'),
        'items_list'                 => __('Items list', 'wp_theme'),
        'items_list_navigation'      => __('Items list navigation', 'wp_theme')
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true
    );

    register_taxonomy('product-category', array('product'), $args);
    flush_rewrite_rules();

}

add_action('init', 'create_post_taxonomy', 0);

?>
