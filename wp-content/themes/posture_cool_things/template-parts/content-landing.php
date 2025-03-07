<?php
/**
 * Template part for displaying landing page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (get_field('hero_section')): ?>
        <?php get_template_part('template-parts/sections/hero'); ?>
    <?php endif; ?>

    <?php if (get_field('features_section')): ?>
        <?php get_template_part('template-parts/sections/features'); ?>
    <?php endif; ?>

    <?php if (get_field('cta_section')): ?>
        <?php get_template_part('template-parts/sections/cta'); ?>
    <?php endif; ?>
</article> 