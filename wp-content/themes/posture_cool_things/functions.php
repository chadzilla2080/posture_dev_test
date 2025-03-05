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
    wp_enqueue_style('posture-cool-things-style', get_stylesheet_uri(), array(), _S_VERSION);
}
add_action('wp_enqueue_scripts', 'posture_cool_things_scripts');


function cool_things_register_cpt() {
    register_post_type('product', array(
        'label' => __('Products', 'cool-things'),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),

    ));
}
add_action('init', 'cool_things_register_cpt');

