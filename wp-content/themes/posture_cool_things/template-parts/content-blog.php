<?php
/**
 * Template part for displaying blog posts
 */
?>

<article <?php post_class('blog-post'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="blog-post__image">
            <?php the_post_thumbnail('large', array('class' => 'img--cover')); ?>
        </div>
    <?php endif; ?>

    <div class="blog-post__content">
        <header class="blog-post__header">
            <h2 class="blog-post__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="blog-post__meta">
                <time><?php echo get_the_date(); ?></time>
                <span class="blog-post__author">
                    by <?php the_author(); ?>
                </span>
            </div>
        </header>

        <div class="blog-post__excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="button button--primary">
            Read More
        </a>
    </div>
</article> 