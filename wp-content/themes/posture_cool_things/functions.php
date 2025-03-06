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

/**
 * Disable Gutenberg editor for the front page
 * 
 * This function checks if the current page being edited is set as the front page
 * in WordPress Settings > Reading. If it is, it disables the Gutenberg editor
 * and reverts to the classic editor for better compatibility with ACF fields.
 *
 * @param bool $use_block_editor Whether to use the block editor for the post type
 * @param string $post_type The post type being checked
 * @return bool Modified $use_block_editor value
 * 
 * @see https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
 * @since 1.0.0
 */
function remove_gutenberg_for_front_page($use_block_editor, $post_type) {
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
        // Check if this post is set as the static front page
        if ($post_id == get_option('page_on_front')) {
            return false; // Disables Gutenberg
        }
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post', 'remove_gutenberg_for_front_page', 10, 2);

/**
 * Remove default editor from specific pages
 * 
 * Removes the default WordPress content editor from specified pages
 * where we're using ACF fields to manage all content.
 *
 * @since 1.0.0
 */
function remove_editor_from_pages() {
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
        
        // Array of page IDs or slugs where we want to remove the editor
        $template_pages = array(
            get_option('page_on_front'),    // Front page
            'about-us',                     // About page by slug
            '42',                           // Services page by ID
            get_page_by_path('contact')->ID // Contact page by path
        );
        
        // Check if current page is in our array
        if (in_array($post_id, $template_pages)) {
            remove_post_type_support('page', 'editor');
        }
    }
}
add_action('admin_init', 'remove_editor_from_pages');

