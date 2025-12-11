<?php

/** enqueue css, js, icons scripts */
function custom_theme_assets() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css');
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/lib/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_style('tempusdominus', get_template_directory_uri() . '/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('easing', get_template_directory_uri() . '/assets/lib/easing/easing.min.js', array('jquery'), null, true);
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/lib/waypoints/waypoints.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/lib/owlcarousel/owl.carousel.min.js', array('jquery'), null, true);
    wp_enqueue_script('moment', get_template_directory_uri() . '/assets/lib/tempusdominus/js/moment.min.js', array('jquery'), null, true);
    wp_enqueue_script('moment-timezone', get_template_directory_uri() . '/assets/lib/tempusdominus/js/moment-timezone.min.js', array('jquery'), null, true);
    wp_enqueue_script('tempusdominus', get_template_directory_uri() . '/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js', array('jquery'), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), time(), true);
}
add_action('wp_enqueue_scripts', 'custom_theme_assets');

/** this file only works during admin logged in */
add_action('admin_enqueue_scripts', function() {
    wp_enqueue_script(
        'custom_admin_acf_script',
        get_template_directory_uri() . '/assets/js/acf_validations.js',
        array('jquery'),
        time(),
        true
    );
});


/** theme support */
add_theme_support('post-thumbnails');


/** SVG support */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Disable WordPress JPEG compression (set to 100%)
add_filter('jpeg_quality', function($arg){ return 100; });
add_filter('wp_editor_set_quality', function($arg){ return 100; });

// enable menus for themes.
register_nav_menus(
    array(
    'first-menu'=>'Header Menu',
    'second-menu'=>'Footer Menu',
    'third-menu'=>'Copyright Menu',
    )
);

// add classes to <a> tags inside <li> tags
function add_menu_link_class($atts, $item, $args)
{
    $atts['class'] = 'nav-item nav-link';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);


/** show template file name in admin menu bar */
function display_template_file_in_admin_bar( $wp_admin_bar ) {
    if ( is_admin() || !is_user_logged_in() ) {
        return;
    }

    global $template;
    $template_file = basename( $template );
    $wp_admin_bar->add_node( array(
        'id'    => 'current-template-file',
        'title' => 'Template: ' . $template_file,
        'href'  => false,
    ) );
}
add_action( 'admin_bar_menu', 'display_template_file_in_admin_bar', 999 );

/** woo helper functions */
// function mytheme_add_woocommerce_support()
// {
//     add_theme_support('woocommerce');
//      add_theme_support( 'wc-product-gallery-zoom' );
//      add_theme_support( 'wc-product-gallery-lightbox' );
//      add_theme_support( 'wc-product-gallery-slider' );
// }
// add_action('after_setup_theme', 'mytheme_add_woocommerce_support');
