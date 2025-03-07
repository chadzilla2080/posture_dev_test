<?php
/**
 * Author box template part
 */
?>

<div class="author-box">
    <div class="author-box__avatar">
        <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
    </div>
    <div class="author-box__content">
        <h4 class="author-box__name"><?php the_author(); ?></h4>
        <?php if (get_the_author_meta('description')): ?>
            <p class="author-box__bio"><?php the_author_meta('description'); ?></p>
        <?php endif; ?>
        <div class="author-box__meta">
            <span class="posts-count">
                <?php printf(
                    _n('%s Article', '%s Articles', get_the_author_posts(), 'posture-cool-things'),
                    get_the_author_posts()
                ); ?>
            </span>
        </div>
    </div>
</div> 