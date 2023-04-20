<?php

/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 * 
 */

function hello_elementor_child_enqueue_scripts()
{

  wp_dequeue_style('hello-elementor');
  wp_deregister_style('hello-elementor');

  wp_enqueue_style('foundry-styles', get_stylesheet_directory_uri() . '/css/main.css', array(), '1.0.0');

  wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/e72a146c5f.js');
  wp_script_add_data('font-awesome', array('crossorigin'), array('anonymous'));

  wp_enqueue_script('main', get_stylesheet_directory_uri() . '/js/main.js', array());
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

/******************************************************************************************************
 * 
 *  REGISTER CUSTOM IMAGE SIZES
 */


function register_custom_image_sizes()
{
  if (!current_theme_supports('post-thumbnails')) {
    add_theme_support('post-thumbnails');
  }
  add_image_size('exhibitor-image', 500, 250, true);
}
add_action('after_setup_theme', 'register_custom_image_sizes');


/******************************************************************************************************
 * 
 *  REGISTER CUSTOM POST TYPES


add_action('init', 'create_post_types');
function create_post_types()
{
  register_post_type(
    'exhibitors',
    array(
      'labels' => array(
        'name' => 'Exhibitors',
        'singular_name' => 'Exhibitor',
        'add_new' => 'Add New Exhibitor',
        'add_new_item' => 'Add New Exhibitor',
        'edit_item' => 'Edit Exhibitor',
        'new_item' => 'New Exhibitor',
        'all_items' => 'All Exhibitors',
        'view_item' => 'View Exhibitor',
        'search_items' => 'Search Exhibitors',
        'not_found' => 'No Exhibitors Found',
        'not_found_in_trash' => 'No Exhibitors found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'Exhibitors'
      ),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => true,
      'menu_position' => null,
      'orderby' => 'menu_order',
      'menu_icon' => 'dashicons-star-filled',
      'rewrite'  => array('slug' => 'exhibitors'),
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    )
  );
}

 */

/******************************************************************************************************
 * 
 *  REGISTER THEME SETTINGS PAGE
 */

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'   => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'icon_url' => 'dashicons-admin-settings',
    'position' => 80,
    'redirect'    => false
  ));
}

/******************************************************************************************************
 * 
 *  HELPER FUNCTIONS
 */

function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

require_once(__DIR__ . '/includes/shortcodes.php');
