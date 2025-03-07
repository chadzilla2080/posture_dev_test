<?php
/**
 * Blog sidebar template
 * Handles graceful fallbacks if ACF fields aren't configured
 */
?>

<div class="blog-sidebar">
    <?php if (get_field('sidebar_title', 'option')): ?>
        <h3 class="blog-sidebar__title"><?php the_field('sidebar_title', 'option'); ?></h3>
    <?php endif; ?>

    <?php 
    // Newsletter Section
    if (function_exists('get_field') && get_field('show_newsletter')): 
        $newsletter_title = get_field('newsletter_title') ?: 'Stay Updated';
        $newsletter_desc = get_field('newsletter_description') ?: 'Get the latest updates delivered to your inbox.';
        ?>
        <div class="blog-sidebar__newsletter">
            <h4><?php echo esc_html($newsletter_title); ?></h4>
            <p><?php echo esc_html($newsletter_desc); ?></p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="button button--primary">Subscribe</button>
            </form>
        </div>
    <?php endif; ?>

    <?php 
    // Featured Posts Section
    if (function_exists('get_field') && get_field('show_featured_posts')): 
        $post_count = absint(get_field('featured_posts_count')) ?: 3;
        $featured_posts = get_posts(array(
            'numberposts' => $post_count,
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if (!empty($featured_posts)): ?>
            <div class="blog-sidebar__featured">
                <h4><?php echo esc_html(get_field('featured_posts_title') ?: 'Featured Posts'); ?></h4>
                <?php foreach($featured_posts as $post): 
                    setup_postdata($post); ?>
                    <a href="<?php the_permalink(); ?>" class="featured-post">
                        <?php if(has_post_thumbnail()): ?>
                            <div class="featured-post__image">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="featured-post__content">
                            <h5><?php the_title(); ?></h5>
                            <time><?php echo get_the_date(); ?></time>
                        </div>
                    </a>
                <?php endforeach; 
                wp_reset_postdata(); ?>
            </div>
        <?php endif;
    endif; ?>

    <?php 
    // Categories Section
    if (!function_exists('get_field') || get_field('show_categories')): // Show by default if ACF not active ?>
        <div class="blog-sidebar__categories">
            <h4><?php echo esc_html(function_exists('get_field') ? get_field('categories_title') : 'Categories'); ?></h4>
            <?php 
            wp_list_categories(array(
                'title_li' => '',
                'show_count' => true,
                'hierarchical' => true
            )); 
            ?>
        </div>
    <?php endif; ?>

    <?php 
    // Social Links Section
    if (function_exists('get_field') && get_field('show_social_links')): 
        $social_links = array(
            'facebook' => get_field('facebook_url'),
            'twitter' => get_field('twitter_url'),
            'instagram' => get_field('instagram_url')
        );

        // Only show section if at least one social link is set
        if (array_filter($social_links)): ?>
            <div class="blog-sidebar__social">
                <h4><?php echo esc_html(get_field('social_title') ?: 'Follow Us'); ?></h4>
                <div class="social-links">
                    <?php foreach($social_links as $platform => $url): 
                        if ($url): ?>
                            <a href="<?php echo esc_url($url); ?>" 
                               class="social-link"
                               target="_blank"
                               rel="noopener noreferrer">
                                <i class="fab fa-<?php echo esc_attr($platform); ?>"></i>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>
        <?php endif;
    endif; ?>
</div> 