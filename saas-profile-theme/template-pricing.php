<?php
/**
 * Template Name: Pricing Page
 */

get_header(); ?>

<?php $p_title = get_option('saas_pricing_title') ?: 'Simple, Transparent Pricing'; ?>
<main id="pricing-page" class="site-main">
    <section class="landing-content" style="padding-top: 100px;">
        <header class="section-header" style="margin-bottom: 80px;">
            <h1 class="landing-title"><?php echo esc_html($p_title); ?></h1>
            <p class="landing-hero-text">Choose the plan that's right for your business growth.</p>
        </header>

        <div class="stats-grid" style="align-items: stretch;">
            <?php
            $pricing_json = get_option('saas_home_pricing_json');
            $plans = json_decode($pricing_json, true) ?: [
                [
                    'name' => 'Free', 'price' => '$0', 'period' => 'forever', 'cta' => 'Get Started', 'link' => '/register', 'style' => 'light',
                    'features' => ['1 Profile', 'Standard Blocks', 'Basic Analytics']
                ],
                [
                    'name' => 'Pro', 'price' => '$19', 'period' => '/mo', 'cta' => 'Go Pro Now', 'link' => '/register?plan=pro', 'style' => 'featured', 'badge' => 'Most Popular',
                    'features' => ['Unlimited Profiles', 'Advanced Analytics', 'Custom Domain Support', 'No Branding']
                ]
            ];

            foreach ($plans as $p) :
                $is_featured = ($p['style'] === 'featured');
            ?>
                <div class="pricing-plan-card <?php echo $is_featured ? 'is-featured' : 'is-light'; ?>">
                    <?php if (isset($p['badge'])) : ?>
                        <div style="background:var(--accent-vibrant); color:#000; display:inline-block; padding:6px 16px; border-radius:20px; font-size:0.75rem; font-weight: 800; margin-bottom:24px; align-self: center; text-transform: uppercase;"><?php echo esc_html($p['badge']); ?></div>
                    <?php endif; ?>
                    <h2 style="font-size: 1.5rem; color: inherit;"><?php echo esc_html($p['name']); ?></h2>
                    <div class="price" style="font-size:4rem; font-weight:900; margin:24px 0; line-height: 1;">
                        <?php echo esc_html($p['price']); ?><small style="font-size:1.125rem; opacity:0.6; font-weight: 500;"><?php echo esc_html($p['period']); ?></small>
                    </div>
                    <ul style="list-style:none; padding:0; margin:32px 0; text-align:left; flex: 1;">
                        <?php foreach ($p['features'] as $f) : ?>
                            <li style="margin-bottom:12px; display: flex; gap: 12px; align-items: center;">
                                <span style="color: <?php echo $is_featured ? '#fff' : 'var(--accent-vibrant)'; ?>; font-weight: 900;">✓</span>
                                <span style="opacity: 0.9;"><?php echo esc_html($f); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo home_url($p['link']); ?>" class="saas-link-btn <?php echo $is_featured ? '' : 'style-featured'; ?>" style="<?php echo $is_featured ? 'background: #fff; color: var(--primary-color); border: none;' : ''; ?>"><?php echo esc_html($p['cta']); ?></a>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top: 80px; color: var(--text-lighter); font-weight: 600;">
            <p>All plans include 14-day money back guarantee. No questions asked.</p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
