<?php get_header(); ?>

<main class="site-main blog-post-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article class="blog-post-single">
                <header class="blog-post-single__header">
                    <h1 class="blog-post-single__title"><?php the_title(); ?></h1>
                    <div class="blog-post-single__meta">
                        <time><?php echo get_the_date(); ?></time>
                        <span class="separator">•</span>
                        <span class="author"><?php the_author(); ?></span>
                    </div>
                </header>

                <?php if (has_post_thumbnail()): ?>
                    <div class="blog-post-single__image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="blog-post-single__content">
                    <?php the_content(); ?>
                </div>
            </article>

            <?php get_template_part('template-parts/author-box'); ?>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
