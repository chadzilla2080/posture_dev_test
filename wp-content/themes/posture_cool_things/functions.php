<?php
/**
 * Theme functions and definitions
 */

/**
 * Define constants
 * 
 * This function defines the constants for the theme
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @return void
 * 
 * @see https://developer.wordpress.org/reference/functions/define/
 *  
 */ 

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/**
 * Table of Contents
 * 
 * 1. Define constants
 * 2. Setup theme
 * 3. Enqueue styles and scripts
 * 4. Remove inline styles from the header
 * 5. Register a custom post type for products
 * 6. Add custom image size for news thumbnails
 * 7. Add Google Fonts to the front end
 * 8. Disable Gutenberg editor for the front page
 * 9. Remove default editor from specific pages and templates
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @see https://developer.wordpress.org/reference/functions/define/
 * 
 */

/**
 * Setup theme
 * 
 * This function adds theme support for title-tag, post-thumbnails, html5, and search-form.
 * It also registers a primary menu location.
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @return void
 * 
 * @see https://developer.wordpress.org/reference/functions/add_theme_support/
 * 
 */
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

/**
 * Enqueue styles and scripts
 * 
 * This function enqueues the main stylesheet and removes default WordPress styles
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @return void
 * 
 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 *
 */
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


/**
 * Remove inline styles from the header
 * 
 * This function removes the inline styles from the header
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @return void
 * 
 * @see https://developer.wordpress.org/reference/functions/remove_action/
 * 
 */
remove_action('wp_head', 'wp_custom_css_cb', 101);


/**
 * Register a custom post type for products
 * 
 * This function registers a custom post type called 'product' with the following properties:
 * - Label: 'Products'
 * - Public: true
 * - Supports: 'title', 'editor', 'thumbnail'
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07 
 * 
 * @since 1.0.0
 * @return void
 * 
 * @see https://developer.wordpress.org/reference/functions/register_post_type/
 * 
*/
function cool_things_register_cpt() {
    register_post_type('product', array(
        'label' => __('Products', 'cool-things'),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),

    ));
}
add_action('init', 'cool_things_register_cpt');

/**
 * Add custom image size for news thumbnails
 * 
 * This function adds a custom image size called 'news-thumbnail' with a width of 384 pixels and a height of 212 pixels.
 * The 'true' parameter indicates that the image should be cropped to fit the specified dimensions.
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @return void
 * 
 * @see https://developer.wordpress.org/reference/functions/add_image_size/
 * 
 */
add_image_size('news-thumbnail', 384, 212, true);


/**
 * Add Google Fonts to the front end
 * 
 * This function enqueues the Google Fonts CSS file from Google Fonts CDN
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @param string $handle The handle of the style being enqueued
 * @param string $src The source URL of the style being enqueued
 * @param array $deps An array of dependencies for the style being enqueued
 * @param string|bool $ver The version of the style being enqueued
 * @param string $media The media type for the style being enqueued
 * @return void
 * @see https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap
 * 
 */
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
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @param bool $use_block_editor Whether to use the block editor for the post type
 * @param string $post_type The post type being checked
 * @return bool Modified $use_block_editor value
 * 
 * @see https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
 * 
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

/**
 * Remove Gutenberg editor for the front page
 * 
 * This function removes the Gutenberg editor for the front page
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @param bool $use_block_editor Whether to use the block editor for the post type
 * @param string $post_type The post type being checked
 * 
 * @see https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
 * 
 */
add_filter('use_block_editor_for_post', 'remove_gutenberg_for_front_page', 10, 2);

/**
 * Remove default editor from specific pages and templates
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * This function removes the default editor from specific pages and templates
 * by checking the post ID and the page template.
 *
 * @since 1.0.0
 * @param bool $use_block_editor Whether to use the block editor for the post type
 * @param string $post_type The post type being checked
 *    
*/
function remove_editor_from_pages() {
    if (!isset($_GET['post'])) return;
    
    $post_id = absint($_GET['post']);
    
    // Organize pages by type
    $pages = array(
        'landing_pages' => array(
            get_option('page_on_front'),
            get_page_by_path('services')->ID,
        ),
        'full_width_pages' => array(
            get_page_by_path('about-us')->ID,
            get_page_by_path('contact')->ID,
        ),
        'custom_template_pages' => array(
            // Pages using specific templates
            'templates/landing-page.php',
            'templates/full-width.php'
        )
    );
    
    // Check landing and full width pages
    if (
        in_array($post_id, $pages['landing_pages']) || 
        in_array($post_id, $pages['full_width_pages'])
    ) {
        remove_post_type_support('page', 'editor');
        return;
    }
    
    // Check template-based pages
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if (in_array($template_file, $pages['custom_template_pages'])) {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'remove_editor_from_pages');

