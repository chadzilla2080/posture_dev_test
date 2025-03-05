<?php get_header(); ?>

<main class="site-main">
    <!-- Hero Section -->
    <section class="hero section section--primary overlay">
        <div class="hero__content container text-center">
            <h1 class="text-white mb-4">WE HAE A SOLUTION FOR THE<br>EXACT THING YOU NEED.</h1>
            <a href="#" class="button button--outline">PRODUCTS</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features section section--light">
        <div class="features__card container card">
            <div class="grid grid--2col items-center gap-2">
                <div class="features__illustration">
                    <img src="path/to/phone-mockup.svg" alt="" class="img--contain">
                </div>
                <div class="features__content">
                    <h2 class="mb-2">WE'RE THE BEST AT THINGS</h2>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                    <a href="#" class="button button--primary">SERVICES</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta section section--primary">
        <div class="cta__content container grid grid--2col items-center gap-2">
            <div class="cta__text content--narrow">
                <h2 class="text-white mb-2">THIS IS WHY THE THING MATTERS</h2>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet...</p>
                <a href="#" class="button button--outline">SERVICES</a>
            </div>
            <div class="cta__illustration">
                <img src="path/to/phone-mockup-woman.svg" alt="" class="img--contain">
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news section section--light">
        <div class="container">
            <h2 class="text-center mb-4">NEWS & UPDATES</h2>
            <div class="news__carousel grid grid--3col gap-2 mb-4">
                <!-- Carousel items -->
                <article class="card card--hover">
                    <img src="path/to/news-1.jpg" alt="" class="img--cover">
                    <div class="p-4">
                        <h3 class="mb-2">THIS WOULD PERHAPS BE THE MOST AMAZING POST TITLE IN THE HISTORY OF POSTS</h3>
                    </div>
                </article>
                <!-- Repeat for other news items -->
            </div>
            <div class="text-center">
                <a href="#" class="button button--text">GO TO NEWS FEED</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
