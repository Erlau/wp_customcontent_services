<?php
/*
Plugin Name: Services
Plugin URI: http://designrus.dk/
Description: A plugin that creates a custom post type for services.
Version: 1.0
Author: Erik Weber-Lauridsen
Author URI: http://wle.dk/
License: GPLv2
*/
?>

<?php
add_action( 'init', 'create_services' );

function create_services() {
    register_post_type( 'services',
        array(
            'labels' => array(
                'name' => 'Services',
                'singular_name' => 'Service',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Service',
                'edit' => 'Edit',
                'edit_item' => 'Edit Service',
                'new_item' => 'New Service',
                'view' => 'View',
                'view_item' => 'View Service',
                'search_items' => 'Search Servicess',
                'not_found' => 'No Services found',
                'not_found_in_trash' => 'No Services found in Trash',
                'parent' => 'Parent Service'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'page-attributes' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/icon.png', __FILE__ ),
            'has_archive' => true
        )
    );
}

add_action( 'admin_init', 'my_admin' );

function my_admin() {
    add_meta_box( 'service_meta_box',
        'Service Details',
        'display_service_meta_box',
        'services', 'normal', 'high'
    );
}

add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function( $template_path ) {
    if ( get_post_type() == 'services' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first, otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-services.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-services.php';
            }
        }
    }
    return $template_path;
}