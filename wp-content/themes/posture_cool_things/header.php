<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header class="site-header">
        <div class="logo">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<h1><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
            }
            ?>
        </div>

        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
            ));
            ?>
        </nav>
    </header>

    <main id="primary" class="site-main">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;

            the_posts_navigation();
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </main>

    <footer class="site-footer">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>

/* front-page specific styles */
.hero-section {
  background-size: cover;
  background-position: center;
  padding: var(--spacing-section) var(--spacing-gap);
  text-align: center;
  color: var(--color-white);
  position: relative;
}

.hero-content {
  max-width: 600px;
  margin: 0 auto;
}

.hero-content h1 {
  font-size: var(--fs-h1);
  margin-bottom: var(--spacing-gap);
}

.btn {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  border-radius: 4px;
  text-transform: uppercase;
  font-weight: bold;
  transition: background-color 0.3s;
}

/* Primary Button */
.btn-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
}
.btn-primary:hover {
  background-color: #0088a0; /* Slightly darker teal on hover */
}

/* Secondary Button */
.btn-secondary {
  background-color: var(--color-white);
  color: var(--color-primary);
  border: 2px solid var(--color-primary);
}
.btn-secondary:hover {
  background-color: var(--color-primary);
  color: var(--color-white);
}

/* Info Sections */
.info-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: var(--spacing-section) var(--spacing-gap);
  gap: var(--spacing-gap);
}
.info-text {
  flex: 1;
}
.info-graphic {
  flex: 1;
  text-align: center;
}
.info-graphic img {
  max-width: 100%;
  height: auto;
}
.alt-bg {
  background-color: #f9f9f9;
}

/* News Section */
.news-section {
  padding: var(--spacing-section) var(--spacing-gap);
  text-align: center;
}
.news-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: var(--spacing-gap);
  margin-bottom: var(--spacing-gap);
}
.news-item {
  background-color: #ffffff;
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}
.news-thumb img {
  width: 100%;
  height: auto;
}
