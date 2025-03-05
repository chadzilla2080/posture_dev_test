<?php
/* Template Name: Front Page */
get_header();
?>

<main id="site-content">
    <!-- HERO SECTION -->
    <section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/hero-bg.jpg');">
        <div class="hero-content">
            <h1>We Have a Solution for the Exact Thing You Need</h1>
            <a href="#" class="btn btn-primary">Products</a>
        </div>
    </section>

    <!-- "WE'RE THE BEST AT THINGS" SECTION -->
    <section class="info-section">
        <div class="info-text">
            <h2>We're the Best at Things</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque iaculis...</p>
            <a href="#" class="btn btn-secondary">Services</a>
        </div>
        <div class="info-graphic">
            <!-- Example phone illustration (exported from Figma as .svg or .png) -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/phone-graphic.png" alt="Phone Graphic">
        </div>
    </section>

    <!-- "THIS IS WHY THE THING MATTERS" SECTION -->
    <section class="info-section alt-bg">
        <h2>This Is Why the Thing Matters</h2>
        <div class="info-graphic">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/illustration.png" alt="Illustration">
        </div>
        <a href="#" class="btn btn-secondary">Services</a>
    </section>

    <!-- NEWS & UPDATES SECTION -->
    <section class="news-section">
        <h2>News & Updates</h2>
        <div class="news-grid">
            <?php
            // WP Query for latest 3 posts
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 3,
            ));
            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                    <article class="news-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="news-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-primary">Go to News Feed</a>
    </section>
</main>

<?php get_footer(); ?>
