<?php
/**
 * Template Name: Landing Page
 * 
 * A clean template without sidebar for landing pages
 */

get_header(); ?>

<main class="site-main">
    <?php 
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', 'landing');
        endwhile;
    endif; 
    ?>
</main>

<?php get_footer(); ?> 