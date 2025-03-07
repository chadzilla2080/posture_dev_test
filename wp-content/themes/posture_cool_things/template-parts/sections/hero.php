<?php
/**
 * Hero section template part
 */
?>

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
    <!-- Rest of hero section -->
</section> 