<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_theme_file_uri('assets/images/Logo.svg'); ?>" alt="Cool Things">
                </a>
            </div>

            <button class="menu-toggle" aria-label="Toggle menu" aria-expanded="false">
                <span></span>
            </button>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'menu',
                    'fallback_cb' => false
                ));
                ?>
            </nav>
        </div>
    </header>
</div>

<?php wp_footer(); ?>
</body>
</html>