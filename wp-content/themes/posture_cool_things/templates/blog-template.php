<?php
/**
 * Template Name: Blog Template
 * Template Post Type: page
 * 
 * A two-column blog template with sidebar
 */

// Add body class for blog template
add_filter('body_class', function($classes) {
    $classes[] = 'page-template-blog-template';
    return $classes;
});

get_header(); ?>

<main class="site-main blog-page">
    <div class="container">
        <header class="blog-page__header">
            <h1 class="blog-page__title"><?php the_title(); ?></h1>
            <?php if (get_field('blog_description')): ?>
                <div class="blog-page__description">
                    <?php the_field('blog_description'); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="blog-grid">
            <div class="blog-grid__main">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'paged' => $paged
                );
                
                $blog_query = new WP_Query($args);
                
                if ($blog_query->have_posts()) : ?>
                    <div class="blog-posts">
                        <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                            <?php get_template_part('template-parts/content', 'blog'); ?>
                        <?php endwhile; ?>
                    </div>

                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $blog_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;'
                        ));
                        ?>
                    </div>
                    <?php wp_reset_postdata();
                endif; ?>
            </div>

            <aside class="blog-grid__sidebar">
                <?php get_template_part('template-parts/sidebar', 'blog'); ?>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?> 