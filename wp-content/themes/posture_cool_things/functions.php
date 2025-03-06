<?php
/**
 * Theme functions and definitions
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

function posture_cool_things_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'posture-cool-things'),
    ));
}
add_action('after_setup_theme', 'posture_cool_things_setup');

function posture_cool_things_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'posture-cool-things-style',
        get_stylesheet_uri(),
        array(),
        _S_VERSION
    );

    // Dequeue any auto-injected styles
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');
    
    // Remove WP emoji stuff
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('wp_enqueue_scripts', 'posture_cool_things_scripts');

// Remove inline styles from the header
remove_action('wp_head', 'wp_custom_css_cb', 101);

function cool_things_register_cpt() {
    register_post_type('product', array(
        'label' => __('Products', 'cool-things'),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),

    ));
}
add_action('init', 'cool_things_register_cpt');

// Remove the Figma setup for now until we get the plugin working

// Add custom image size for news thumbnails
add_image_size('news-thumbnail', 384, 212, true);

function add_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'add_google_fonts');

