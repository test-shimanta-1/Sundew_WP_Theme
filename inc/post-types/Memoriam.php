<?php

function custom_post_type_memoriam() {
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
        'name' => _x('Memoriams', 'plural'),
        'singular_name' => _x('Memoriam', 'singular'),
        'menu_name' => _x('Memoriams', 'admin menu'),
        'name_admin_bar' => _x('Memoriam', 'admin bar'),
        'add_new' => _x('Add New Memoriam', 'add new'),
        'add_new_item' => __('Add New Memoriam'),
        'new_item' => __('New Memoriam'),
        'edit_item' => __('Edit Memoriam'),
        'view_item' => __('View Memoriam'),
        'all_items' => __('All Memoriams'),
        'search_items' => __('Search Memoriams'),
        'not_found' => __('No Memoriams found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'memoriam', 'with_front' => false),
        'has_archive' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
    );
    register_post_type('our_memoriam', $args);
}
add_action('init', 'custom_post_type_memoriam');

/** url rewrite rules ~ removing /memoriam from the slug url */
add_filter('post_type_link', 'remove_memoriam_slug', 10, 2);
function remove_memoriam_slug($post_link, $post) {
    if ($post->post_type === 'our_memoriam' && $post->post_status === 'publish') {
        return home_url('/' . $post->post_name . '/');
    }
    return $post_link;
}

/** permalink flush re-write hook triggers! */
add_action('init', 'add_memoriam_rewrite_rules');
function add_memoriam_rewrite_rules() {
    add_rewrite_rule(
        '^([^/]+)/?$',
        'index.php?our_memoriam=$matches[1]',
        'top'
    );
}
add_filter('query_vars', function ($vars) {
    $vars[] = 'our_memoriam';
    return $vars;
});


?>