<?php
/**
 * Template Name: Blog Template
 * 
 * A two-column blog template with sidebar
 */

get_header(); ?>

<main class="site-main blog-page">
    <div class="container">
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