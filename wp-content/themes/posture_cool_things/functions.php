<?php
/**
 * Theme functions and definitions
 */

/**
 * Define constants
 * 
 *  Author: Chad Buie   
 *  Date: 2025-03-07
 * 
 *  Notes:
 *   - Used define() to define the constants.
 *   - Used the name parameter to define the constant at the correct name.
 *   - Used the value parameter to define the constant at the correct value.
 *   
 *   Notes:
 *    - Used _S_VERSION to define the version of the theme.
 *    - Used POSTURE_COOL_THINGS_PATH to define the path of the theme.
 *
 *    
 */ 

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}
if (!defined('POSTURE_COOL_THINGS_PATH')) {
    define('POSTURE_COOL_THINGS_PATH', get_template_directory());
}

/**
 * Table of Contents
 * 
 * 1. Define constants - See Above
 * 2. Setup theme -  See Line 25
 * 3. Enqueue styles and scripts - See Line 62
 * 4. Remove inline styles from the header - See Line 69
 * 5. Register a custom post type for products - See Line 177
 * 6. Add custom image size for news thumbnails - See Line 184
 * 7. Add Google Fonts to the front end - See Line 191
 * 8. Disable Gutenberg editor for the front page - See Line 200
 * 9. Remove default editor from specific pages and templates - See Line 210    
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @see https://developer.wordpress.org/reference/functions/define/
 * 
 * Notes: 
 *
 * This is a just a note to self. Things to do for improvements:
 *
 *  - Add name space to the functions for organization.
 *  - Add some security features. 
 *  - Add configuration management for development, staging, and production environments.
 *  - Add asset management for images, scripts, and styles.
 *  - Structure functionality into seperate files.
 * 
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
 * Notes:
 *   - Used add_action() to add the action to the hook.
 *   - Used the priority parameter to add the action to the hook at the correct priority.
 *   - Should use 5 as the priority to ensure early setup and execution.
 *
 *   - Used the callback parameter to add the action to the hook at the correct callback.
 *   - Used the args parameter to add the action to the hook at the correct args.
 * 
 */
function posture_cool_things_setup(): void {
    add_theme_support(feature: 'title-tag');
    add_theme_support(feature: 'post-thumbnails');
    add_theme_support(feature: 'html5', args: array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    register_nav_menus(locations: array(
        'primary' => esc_html__(text: 'Primary Menu', domain: 'posture-cool-things'),
    ));
}
add_action(hook_name: 'after_setup_theme', callback: 'posture_cool_things_setup', priority: 15);

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
 * Notes:
 *   - Used add_action() to add the action to the hook.
 *   - Used the priority parameter to add the action to the hook at the correct priority.
 *   - Should use 10 as the priority to ensure it runs before the default WordPress styles.
 *   - Used the callback parameter to add the action to the hook at the correct callback.
 *   - Used the args parameter to add the action to the hook at the correct args.
 * 
 */
function posture_cool_things_scripts(): void {

    // Simple version control
    $version = defined('WP_DEBUG') && WP_DEBUG ? time() : _S_VERSION;

    // Main stylesheet
    wp_enqueue_style(
        'posture-cool-things-style',
        get_stylesheet_uri(),
        [],
        _S_VERSION
    );

    // Remove unnecessary WordPress styles:: Dequeue any auto-injected styles
    wp_dequeue_style(handle: 'wp-block-library');
    wp_dequeue_style(handle: 'classic-theme-styles');
    
    // Remove WP emoji stuff    
    remove_action(hook_name: 'wp_head', callback: 'print_emoji_detection_script', priority: 10);
    remove_action(hook_name: 'wp_print_styles', callback: 'print_emoji_styles', priority: 10);
}
add_action(hook_name: 'wp_enqueue_scripts', callback: 'posture_cool_things_scripts', priority: 10);


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
 * @param string $hook_name The hook name to remove the action from
 * @param string $callback The callback function to remove the action from
 * @param int $priority The priority of the action to remove

 * Notes:
 *  - Decided sorta normalize design by removing the inline styles from the header.
 *  - Used remove_action() to remove the action from the hook.
 *  - Used the priority parameter to remove the action from the hook at the correct priority.
 *  - Used the callback parameter to remove the action from the hook at the correct callback.
 *  - Used the hook_name parameter to remove the action from the hook at the correct hook name.
 * 
 * @see https://developer.wordpress.org/reference/functions/remove_action/
 * 
 */
remove_action(hook_name: 'wp_head', callback: 'wp_custom_css_cb', priority: 101);


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
 * Notes:
 *   - Used add_action() to add the action to the hook.
 *   - Used the priority parameter to add the action to the hook at the correct priority.
 *   - Should use 5 as the priority to ensure early setup and execution.
 *   - Used the callback parameter to add the action to the hook at the correct callback.
 *   - Used the args parameter to add the action to the hook at the correct args.
 * 
*/
function cool_things_register_cpt(): void {
    register_post_type(post_type: 'product', args: array(
        'label' => __(text: 'Products', domain: 'cool-things'),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),

    ));
}
add_action(hook_name: 'init', callback: 'cool_things_register_cpt', priority: 5);

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
 * Notes:
 *   - Used add_image_size() to add the image size to the theme.
 *   - Used the name parameter to add the image size to the theme at the correct name.
 *   - Used the width parameter to add the image size to the theme at the correct width.
 *   - Used the height parameter to add the image size to the theme at the correct height.
 *   - Used the crop parameter to add the image size to the theme at the correct crop.
 * 
 */
add_image_size(name: 'news-thumbnail', width: 384, height: 212, crop: true);


/**
 * Add Google Fonts to the front end
 * 
 * This function enqueues the Google Fonts CSS file from Google Fonts CDN
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @return void
 * @param string $handle The handle of the style being enqueued
 * @param string $src The source URL of the style being enqueued
 * @param array $deps An array of dependencies for the style being enqueued
 * @param string|bool $ver The version of the style being enqueued
 * @param string $media The media type for the style being enqueued
 * @return void
 * @see https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap
 * 
 */
function posture_cool_things_enqueue_fonts(): void {
    wp_enqueue_style(handle: 'google-fonts', src: 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap', deps: array(), ver: null);
}
// Add the action to the hook
add_action(hook_name: 'wp_enqueue_scripts', callback: 'posture_cool_things_enqueue_fonts', priority: 9);

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
function remove_gutenberg_for_front_page(bool $use_block_editor, $post_type): bool {
    if (isset($_GET['post'])) {
        return $use_block_editor;
    }
    $post_id = $_GET['post'];
        // Check if this post is set as the static front page
    if ($post_id == get_option(option: 'page_on_front')) {
        return false; // Disables Gutenberg
    }
    return $use_block_editor;
}

/**
 * A Hook to Remove Gutenberg editor for the front page
 * 
 * This function removes the Gutenberg editor for the front page
 * 
 *  Author: Chad Buie
 *  Date: 2025-03-07
 * 
 * @since 1.0.0
 * @param bool $use_block_editor Whether to use the block editor for the post type  
 * @param string $post_type The post type being checked
 * @return bool Modified $use_block_editor value
 *
 * Notes:
 *   - I decided to remove the Gutenberg editor for the front page for a two reasons.
 *   - First, I wanted to use the classic editor for the front page.
 *   - Secondly, custom pages will use custom fields and I wanted a clean interface to manage key content.
 *   
 * 
 * @see https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
 * 
 */
add_filter(hook_name: 'use_block_editor_for_post', callback: 'remove_gutenberg_for_front_page', priority: 10, accepted_args: 2);


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
 *  Notes: 
 *
 *  Used get_option('page_on_front') to get the ID of the front page.
 *   - This function is best for dealing with the front page.
 *   - This function is best for dealing with pages that use the default template.
 *   - This function is best for dealing with pages that are not in the default WordPress hierarchy.
 *   - This function is ultimate good for dealing with WordPress system pages.
 *
 *  Used get_page_by_path() to get the ID of the pages that use the specific templates. 
 *   - This function is best for dealing with pages that have custom slugs and are not in the default WordPress hierarchy.
 *   - This function is best for dealing with pages that use custom templates.
 * 
 *   Warning: 
 *    - This function will return the entire page object, not just the ID.
 *    - Neverthless, I just called the ID from the page object.
 *    - As a result, it will be slower than using get_option('page_on_front') or get_page_by_path().
 * 
 *  Used in_array() to check if the current post ID is in the array of page IDs.  
 *  Used remove_post_type_support() to remove the editor from the post type.
 *
 * @see https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
 *    
*/
function remove_editor_from_pages(): void {
    if (!isset($_GET['post'])) return;
    
    $post_id = absint(maybeint: $_GET['post']);
    
    // Organize pages by type
    // Get the page type
    $pages = array(
        // Landing pages
        'landing_pages' => array(
            get_option(option: 'page_on_front'),
            get_page_by_path(page_path: 'services')->ID,
        ),

        // Full width pages
        'full_width_pages' => array(
            get_page_by_path(page_path: 'about-us')->ID,
            get_page_by_path(page_path: 'contact')->ID,
        ),

        // Custom template pages
        'custom_template_pages' => array(

            // Pages using specific templates
            'templates/landing-page.php',
            'templates/full-width.php'
        )
    );
    
    // Check landing and full width pages
    // Check if the current post ID is in the array of page IDs
    // If it is, remove the editor from the post type
    if (
        in_array(needle: $post_id, haystack: $pages['landing_pages']) || 
        in_array(needle: $post_id, haystack: $pages['full_width_pages'])
    ) {
        // Remove the editor from the post type
        remove_post_type_support(post_type: 'page', feature: 'editor');
        return;
    }
    
    // Check template-based pages
    // Get the template file
    // Check if the template file is in the array of template files
    // If it is, remove the editor from the post type
    $template_file = get_post_meta(post_id: $post_id, key: '_wp_page_template', single: true);
    if (in_array(needle: $template_file, haystack: $pages['custom_template_pages'])) {
        // Remove the editor from the post type
        remove_post_type_support(post_type: 'page', feature: 'editor');
    }
}
add_action(hook_name: 'admin_init', callback: 'remove_editor_from_pages');

