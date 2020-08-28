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

// navigation
function wp_theme_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul class="header-navigation-list">%3$s</ul>',
		'depth'           => 0,
		'walker'          => new My_Walker_Nav_Menu()
		)
	);
}

class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"submenu\">\n";
  }
}

// scripts
function wp_theme_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('mainscript', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
        wp_enqueue_script('mainscript');

    }
}
add_action('init', 'wp_theme_header_scripts');

// styles
function wp_theme_styles()
{
    wp_register_style('wp_theme', get_template_directory_uri() . '/assets/css/style.css', array(), null, 'all');
    wp_enqueue_style('wp_theme');
}
add_action('wp_enqueue_scripts', 'wp_theme_styles');

// menu
function register_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'wp_theme'),
        'extra-menu' => __('Extra Menu', 'wp_theme')
    ));
}
add_action('init', 'register_menu');

// page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}
add_filter('body_class', 'add_slug_to_body_class');

// pagination
function wp_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => false,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => true,
    'prev_text'       => __('<'),
    'next_text'       => __('>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<div class='pagination'>";
      echo $paginate_links;
      echo "<span class='page-numbers'></span>";
    echo "</div>";
  }
}
add_action('init', 'wp_pagination');

// excerpts max charlength
// the_excerpt_max_charlength(300)
function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

// redirect attachment page
function redirect_attachment_page() {
    if ( is_attachment() ) {
        global $post;
        if ( $post && $post->post_parent ) {
            wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
            exit;
        } else {
            wp_redirect( esc_url( home_url( '/' ) ), 301 );
            exit;
        }
    }
}
add_action( 'template_redirect', 'redirect_attachment_page' );

// svg uploads
function svg_mime_type($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'svg_mime_type');

// remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// remove unnecessary code
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// remove jquery migrate
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

function dequeue_jquery_migrate( &$scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}

// remove comments from pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
remove_post_type_support( 'page', 'comments' );
}

// remove Comments from admin
add_action( 'admin_init', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

// Remove unused CSS from WP
function smartwp_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

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
        'name'                       => _x( 'Categories', 'Taxonomy General Name', 'wp_theme' ),
        'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'wp_theme' ),
        'menu_name'                  => __( 'Categories', 'wp_theme' ),
        'all_items'                  => __( 'All Items', 'wp_theme' ),
        'parent_item'                => __( 'Parent Item', 'wp_theme' ),
        'parent_item_colon'          => __( 'Parent Item:', 'wp_theme' ),
        'new_item_name'              => __( 'New Item Name', 'wp_theme' ),
        'add_new_item'               => __( 'Add New Item', 'wp_theme' ),
        'edit_item'                  => __( 'Edit Item', 'wp_theme' ),
        'update_item'                => __( 'Update Item', 'wp_theme' ),
        'view_item'                  => __( 'View Item', 'wp_theme' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'wp_theme' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'wp_theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'wp_theme' ),
        'popular_items'              => __( 'Popular Items', 'wp_theme' ),
        'search_items'               => __( 'Search Items', 'wp_theme' ),
        'not_found'                  => __( 'Not Found', 'wp_theme' ),
        'no_terms'                   => __( 'No items', 'wp_theme' ),
        'items_list'                 => __( 'Items list', 'wp_theme' ),
        'items_list_navigation'      => __( 'Items list navigation', 'wp_theme' )
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

    register_taxonomy( 'product-category', array( 'product' ), $args );
    flush_rewrite_rules();

}

add_action('init', 'create_post_taxonomy', 0);

// contact form 7 assets
define('WPCF7_LOAD_JS', false);
define('WPCF7_LOAD_CSS', false);
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
add_action('wp_enqueue_scripts', 'load_wpcf7_scripts');

function load_wpcf7_scripts() {
    if ( is_page('contact') ) {
        if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
            wpcf7_enqueue_scripts();
        }
        if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
            wpcf7_enqueue_styles();
        }
    }
}

?>
