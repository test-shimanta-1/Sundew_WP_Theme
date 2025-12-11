<?php

// Adding custom post type - FAQs
function custom_post_type_faqs() {
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
        'name' => _x('FAQs', 'plural'),
        'singular_name' => _x('FAQ', 'singular'),
        'menu_name' => _x('FAQs', 'admin menu'),
        'name_admin_bar' => _x('FAQ', 'admin bar'),
        'add_new' => _x('Add New FAQ', 'add new'),
        'add_new_item' => __('Add New FAQ'),
        'new_item' => __('New FAQ'),
        'edit_item' => __('Edit FAQ'),
        'view_item' => __('View FAQ'),
        'all_items' => __('All FAQs'),
        'search_items' => __('Search FAQs'),
        'not_found' => __('No FAQs found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'faq'),
        'has_archive' => true,
        'hierarchical' => false,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-editor-help',
    );
    register_post_type('our_faqs', $args);
}
// add_action('init', 'custom_post_type_faqs');

// Adding taxonomy to post type - FAQs
function add_faq_taxonomies() {
    // Add new "Category" taxonomy to FAQs
    register_taxonomy('faq_category', 'our_faqs', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,

        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x('FAQ Categories', 'taxonomy general name'),
            'singular_name' => _x('FAQ Category', 'taxonomy singular name'),
            'search_items' => __('Search FAQ Categories'),
            'all_items' => __('All FAQ Categories'),
            'parent_item' => __('Parent FAQ Category'),
            'parent_item_colon' => __('Parent FAQ Category:'),
            'edit_item' => __('Edit FAQ Category'),
            'update_item' => __('Update FAQ Category'),
            'add_new_item' => __('Add New FAQ Category'),
            'new_item_name' => __('New FAQ Category Name'),
            'menu_name' => __('FAQ Category'),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'faq-category',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
}
// add_action('init', 'add_faq_taxonomies', 0);

?>