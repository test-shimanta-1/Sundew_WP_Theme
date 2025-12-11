<?php

function custom_post_type_emergency_service() {
    $supports = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'custom-fields',
        'comments',
        'revisions',
        'post-formats',
    );
    $labels = array(
        'name' => _x('Emergency Services', 'plural'),
        'singular_name' => _x('Memoriam', 'singular'),
        'menu_name' => _x('Emergency Services', 'admin menu'),
        'name_admin_bar' => _x('Emergency Service', 'admin bar'),
        'add_new' => _x('Add New Emergency Service', 'add new'),
        'add_new_item' => __('Add New Emergency Service'),
        'new_item' => __('New Emergency Service'),
        'edit_item' => __('Edit Emergency Service'),
        'view_item' => __('View Emergency Service'),
        'all_items' => __('All Emergency Services'),
        'search_items' => __('Search Emergency Services'),
        'not_found' => __('No Emergency Services found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'emergency-service'),
        'has_archive' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-privacy',
    );
    register_post_type('our_emergency', $args);
}
add_action('init', 'custom_post_type_emergency_service');

?>