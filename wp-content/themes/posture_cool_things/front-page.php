<?php get_header(); ?>

<main class="site-main">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero__background">
            <?php 
            $hero_image = get_field('hero_background_image');
            if ($hero_image): ?>
                <img src="<?php echo esc_url($hero_image); ?>" alt="">
            <?php else: ?>
                <img src="<?php echo get_theme_file_uri('assets/images/Rectangle1.svg'); ?>" alt="">
            <?php endif; ?>
        </div>
        <div class="hero__overlay"></div>
        <div class="hero__content container text-center">
            <h1 class="text-white mb-4">
                <?php 
                $hero_title = get_field('hero_title');
                if ($hero_title): 
                    echo esc_html($hero_title);
                else:
                    echo 'WE HAVE A SOLUTION FOR THE EXACT THING YOU NEED.';
                endif; 
                ?>
            </h1>

            <?php 
            $button_text = get_field('hero_button_text');
            $button_url = get_field('hero_button_url');
            ?>
            <a href="<?php echo esc_url($button_url ?: '#'); ?>" class="button button--outline">
                <?php echo esc_html($button_text ?: 'PRODUCTS'); ?>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="features__card">
            <div class="features__content">
                <div class="features__illustration">
                    <img src="<?php echo get_theme_file_uri('assets/images/Man and phone 1.svg'); ?>" alt="Man with phone illustration">
                </div>
                <div class="features__text">
                    <h2>WE'RE THE BEST AT THINGS</h2>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                    <a href="#" class="button button--primary">SERVICES</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta__card">
            <div class="cta__content">
                <div class="cta__text">
                    <h2>THIS IS WHY THE THING MATTERS</h2>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                    <a href="#" class="button button--outline">SERVICES</a>
                </div>
                <div class="cta__illustration">
                    <img src="<?php echo get_theme_file_uri('assets/images/Woman on phone 1.svg'); ?>" alt="Woman with phone illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news">
        <div class="container">
            <h2 class="news__title">NEWS & UPDATES</h2>
            
            <div class="news__carousel">
                <?php
                // WP Query for latest posts
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                
                $news_query = new WP_Query($args);
                
                if ($news_query->have_posts()) : ?>
                    <div class="news__grid">
                        <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                            <article class="news__card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="news__image">
                                        <?php the_post_thumbnail('news-thumbnail', array('class' => 'img--cover')); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="news__content">
                                    <h3 class="news__card-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <div class="news__navigation">
                        <button class="news__nav-button news__nav-button--prev" aria-label="Previous slides">
                            <span class="arrow-left"></span>
                        </button>
                        <button class="news__nav-button news__nav-button--next" aria-label="Next slides">
                            <span class="arrow-right"></span>
                        </button>
                    </div>
                <?php endif; 
                wp_reset_postdata(); ?>
            </div>

            <div class="news__footer">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="fancy-button">
                    <span class="fancy-button__accent-vertical"></span>
                    <span class="fancy-button__text">GO TO NEWS FEED</span>
                    <span class="fancy-button__accent-horizontal"></span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
