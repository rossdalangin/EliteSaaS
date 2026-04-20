<?php
/**
 * Template Name: About Page
 */

get_header(); ?>

<main id="about-page" class="site-main">
    <section class="landing-content" style="padding-top: 100px; padding-bottom: 60px;">
        <?php $vision = get_option('saas_about_vision') ?: 'Empowering 100,000+ creators to own their digital identity.'; ?>
        <div style="text-align: center; margin-bottom: 80px;">
            <h1 class="landing-title">Our Vision</h1>
            <p class="landing-hero-text"><?php echo esc_html($vision); ?></p>
        </div>

        <div class="stats-grid" style="margin-bottom: 100px;">
            <div class="feature-card-light" style="text-align: left;">
                <h2 style="margin-bottom: 20px;">Why we built this.</h2>
                <p>Social media is great for traffic, but terrible for ownership. We built this platform to give every professional a centralized, high-converting home on the internet that they truly control.</p>
            </div>
            <div class="feature-card-dark" style="text-align: left;">
                <div style="font-size: 3rem; margin-bottom: 10px;">✨</div>
                <h3 style="color: #fff; margin-bottom: 10px;">Conversion First</h3>
                <p style="color: rgba(255,255,255,0.7);">We don't just build link lists. We build lead machines designed by marketing experts.</p>
            </div>
        </div>

        <div class="feature-card-light" style="max-width: 800px; margin: 0 auto; text-align: left; padding: 60px;">
            <h3>The Problem</h3>
            <p>Most "link in bio" tools are just static lists. They don't capture leads, they don't provide deep analytics, and they look like everyone else's. Elite creators need more.</p>
            <hr style="border: none; border-top: 1px solid var(--border-color); margin: 32px 0;">
            <h3>Our Solution</h3>
            <p>A full-featured lead engine that turns your social traffic into a measurable business asset. From NFC business cards to A/B tested CTAs, we provide the tools you need to win.</p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
