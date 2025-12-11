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
function custom_memoriam_permalink($url, $post) {
    if ($post->post_type === 'our_memoriam') {
        return home_url('/' . $post->post_name . '/');
    }
    return $url;
}
add_filter('post_type_link', 'custom_memoriam_permalink', 10, 2);

/** permalink flush re-write hook triggers! */
function custom_memoriam_rewrite() {
    $posts = get_posts(array(
        'post_type'      => 'our_memoriam',
        'posts_per_page' => -1,
    ));

    if ($posts) {
        foreach ($posts as $p) {
            add_rewrite_rule(
                $p->post_name . '/?$',
                'index.php?our_memoriam=' . $p->post_name,
                'top'
            );
        }
    }
}
add_action('init', 'custom_memoriam_rewrite');

?>