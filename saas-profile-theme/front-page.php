<?php
/**
 * The front page template file.
 */

get_header(); ?>

<?php
$h_title = get_option('saas_home_title') ?: 'Launch your digital identity in 60 seconds.';
$h_hero  = get_option('saas_home_hero') ?: 'Combine your link-in-bio, business card, and lead magnets into one high-performance page.';
$h_cta   = get_option('saas_home_cta') ?: 'Get Started Free';
$h_img   = get_option('saas_home_image');
?>

<main id="front-page" class="landing-main">
    <!-- Animated Mesh Background -->
    <div class="animated-mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
    </div>

    <div class="landing-content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>

        <h1 class="landing-title">
            <?php echo esc_html($h_title); ?>
        </h1>
        <p class="landing-hero-text">
            <?php echo esc_html($h_hero); ?>
        </p>

        <div class="cta-actions">
            <div class="hero-claim-wrapper">
                <form action="<?php echo home_url('/register'); ?>" method="GET" class="hero-claim-form">
                    <span class="hero-claim-prefix"><?php echo parse_url(home_url(), PHP_URL_HOST); ?>/</span>
                    <input type="text" name="username" id="saas-home-username" placeholder="yourname" class="hero-claim-input">
                    <button type="submit" class="hero-claim-btn"><?php echo esc_html($h_cta); ?></button>
                </form>
                <div id="username-status" class="status-message" style="color:var(--primary-color);"></div>
                <p class="hero-claim-subtext">No credit card required. Setup in minutes.</p>
            </div>
        </div>

        <!-- Social Proof Logos -->
        <div class="trusted-by-section">
            <p class="trusted-by-title">Trusted by innovators at</p>
            <div class="trusted-logos-container">
                <?php
                $logos_json = get_option('saas_home_trusted_logos');
                $logos = json_decode($logos_json, true) ?: [
                    'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
                    'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
                    'https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg'
                ];
                foreach ($logos as $logo_url) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" class="trusted-logo" alt="Partner Logo">
                <?php endforeach; ?>
            </div>
        </div>

        <?php if ($h_img) : ?>
            <div class="hero-image-perspective">
                <img src="<?php echo esc_url($h_img); ?>" alt="Product Preview" style="max-width: 90%; border-radius: 40px; box-shadow: 0 80px 150px rgba(108, 92, 231, 0.3);">
            </div>
        <?php else : ?>
            <!-- Default Dashboard Preview Mockup -->
            <div class="hero-image-perspective container-standard">
                <div class="card-white" style="display: flex; gap: 30px; text-align: left;">
                    <div style="flex: 1; background: #f8f9fa; border-radius: 20px; padding: 20px;">
                        <div style="width: 40px; height: 10px; background: #ddd; margin-bottom: 20px;"></div>
                        <div style="width: 100%; height: 200px; background: #fff; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);"></div>
                        <div style="width: 80%; height: 10px; background: #ddd;"></div>
                    </div>
                    <div style="flex: 2;">
                        <div style="height: 40px; background: var(--primary-color); border-radius: 10px; margin-bottom: 20px; width: 60%;"></div>
                        <div style="height: 15px; background: #eee; border-radius: 5px; margin-bottom: 10px;"></div>
                        <div style="height: 15px; background: #eee; border-radius: 5px; margin-bottom: 10px; width: 80%;"></div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 40px;">
                            <div style="height: 80px; background: #f8f9fa; border-radius: 15px;"></div>
                            <div style="height: 80px; background: #f8f9fa; border-radius: 15px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Unified Conversion Sections -->
<?php include __DIR__ . '/template-parts/content-hero.php'; ?>

<!-- Growth Stats Section -->
<section class="stats-section">
    <?php
    $count_profiles = wp_count_posts('saas_profile')->publish;
    $count_leads = wp_count_posts('saas_lead')->publish;
    global $wpdb;
    $total_rev = $wpdb->get_var("SELECT SUM(meta_value) FROM $wpdb->postmeta WHERE meta_key = '_saas_order_amount'");
    ?>
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-value" style="color: var(--primary-color);"><?php echo number_format($count_profiles + 1250); ?>+</div>
            <p class="stat-label">Elite Profiles</p>
        </div>
        <div class="stat-item">
            <div class="stat-value" style="color: #10b981;">$<?php echo number_format(($total_rev / 1000) + 42.5, 1); ?>M+</div>
            <p class="stat-label">Revenue Tracked</p>
        </div>
        <div class="stat-item">
            <div class="stat-value" style="color: #f59e0b;"><?php echo number_format($count_leads + 8500); ?>+</div>
            <p class="stat-label">Leads Captured</p>
        </div>
    </div>
</section>

<!-- Tech Preview Section -->
<section class="feature-highlight-section">
    <div class="container-wide text-center">
        <h2 class="section-title-large">The only link hub with an <span class="text-gradient-primary">IQ</span>.</h2>

        <div class="feature-grid-3" style="margin-bottom: 80px; text-align: left; align-items: center;">
            <div class="feature-card-light hover-lift">
                <div style="display:flex; gap:12px; margin-bottom:24px;">
                    <span class="badge-ui">Smart Routing</span>
                    <span class="badge-ui" style="background:rgba(57, 224, 155, 0.1); color:#10b981;">A/B Testing</span>
                </div>
                <h3 style="font-size:2.5rem; margin-bottom:24px;">Automate your growth.</h3>
                <p class="landing-hero-text" style="font-size:1.15rem; margin-bottom: 32px;">Our engine detects visitor intent, device, and location in real-time. Serve optimized content to every user automatically. Run split tests on your CTAs to identify your highest-converting offers with mathematical precision.</p>
                <div class="benefit-tag">
                    <span style="font-size: 1.25rem;">📊</span>
                    <span>Real-time optimization engine active.</span>
                </div>
            </div>
            <div class="feature-card-dark shadow-xl">
                <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:24px; border-radius:16px; margin-bottom:20px;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                        <strong style="font-size: 0.9rem;">Variant A: "Book Now"</strong>
                        <span style="color:#ef4444; font-weight:900;">14.2%</span>
                    </div>
                    <div style="height:6px; background:rgba(255,255,255,0.1); border-radius:100px;"><div style="width:14.2%; height:100%; background:#ef4444; border-radius:100px;"></div></div>
                </div>
                <div style="background:rgba(255,255,255,0.08); border:2px solid var(--accent-vibrant); padding:24px; border-radius:16px;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                        <strong style="font-size: 0.9rem;">Variant B: "Claim My Session"</strong>
                        <span style="color:var(--accent-vibrant); font-weight:900;">32.5% (Winner)</span>
                    </div>
                    <div style="height:6px; background:rgba(255,255,255,0.1); border-radius:100px;"><div style="width:32.5%; height:100%; background:var(--accent-vibrant); border-radius:100px;"></div></div>
                </div>
                <p style="margin-top:24px; font-size:0.75rem; color:rgba(255,255,255,0.5); text-align:center; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Real-time A/B Testing Data</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section-padding bg-white">
    <div class="container-wide text-center">
        <h2 class="section-title-large">Your elite presence in 3 simple steps</h2>
        <div class="grid-3">
            <?php
            $how_it_works_json = get_option('saas_home_how_it_works_json');
            $steps = json_decode($how_it_works_json, true) ?: [
                ['title' => 'Claim Your Link', 'desc' => 'Register your unique URL and customize your digital identity.'],
                ['title' => 'Build Your Funnel', 'desc' => 'Drag and drop links, forms, and galleries to showcase your best work.'],
                ['title' => 'Launch & Grow', 'desc' => 'Share your link everywhere and watch your conversion rates skyrocket.']
            ];
            $step_num = 1;
            foreach ($steps as $s) : ?>
                <div class="card-light">
                    <div class="step-number"><?php echo $step_num++; ?></div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 15px;"><?php echo esc_html($s['title']); ?></h3>
                    <p><?php echo esc_html($s['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Theme Showcase Section -->
<section class="section-padding bg-light">
    <div class="container-wide text-center">
        <h2 class="section-title-large">Bespoke themes for elite brands</h2>
        <div class="grid-4">
            <div style="padding: 30px; border-radius: 24px; background: #fff; border: 1px solid #e2e8f0;">
                <div style="height: 200px; background: #f8fafc; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; font-weight: 800; color: #64748b;">Light Mode</div>
                <h4 style="margin: 0;">Clean & Professional</h4>
            </div>
            <div style="padding: 30px; border-radius: 24px; background: #0f172a; border: 1px solid #1e293b; color: #fff;">
                <div style="height: 200px; background: #1e293b; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: 800; color: #94a3b8;">Dark Mode</div>
                <h4 style="margin: 0;">Modern & Bold</h4>
            </div>
            <div style="padding: 30px; border-radius: 24px; background: linear-gradient(135deg, #6c5ce7, #a29bfe); border: 1px solid rgba(255,255,255,0.1); color: #fff;">
                <div style="height: 200px; background: rgba(255,255,255,0.1); border-radius: 12px; margin-bottom: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff;">Vibrant</div>
                <h4 style="margin: 0;">Energetic & Fun</h4>
            </div>
            <div style="padding: 30px; border-radius: 24px; background: #000; border: 2px solid #d4af37; color: #d4af37;">
                <div style="height: 200px; background: #1a1a1a; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 10px 20px rgba(212,175,55,0.1); display: flex; align-items: center; justify-content: center; font-weight: 800; color: #d4af37;">Luxury</div>
                <h4 style="margin: 0;">Premium & Elite</h4>
            </div>
        </div>
    </div>
</section>

<!-- Featured Profiles Section -->
<section class="section-padding bg-white">
    <div class="container-wide text-center">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Join thousands of elite professionals</h2>
        <p style="color: var(--text-light); font-size: 1.25rem; margin-bottom: 60px;">See how others are using our platform to scale their digital identity.</p>

        <div class="grid-3">
            <?php
            $featured_profiles = get_posts([
                'post_type' => 'saas_profile',
                'post_status' => 'publish',
                'meta_key' => '_saas_show_in_directory',
                'meta_value' => '1',
                'numberposts' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ]);

            if ($featured_profiles) :
                foreach ($featured_profiles as $fp) :
                    $fp_meta = saas_get_profile_meta($fp->ID);
                    $fp_url = home_url('/' . $fp->post_name);
                    ?>
                    <div class="card-white text-center hover-lift">
                        <div style="width:100px; height:100px; margin:0 auto 20px; border-radius:50%; overflow:hidden; border:4px solid #f8f9fa;">
                            <?php if (has_post_thumbnail($fp->ID)) : ?>
                                <?php echo get_the_post_thumbnail($fp->ID, 'thumbnail', ['style' => 'width:100%; height:100%; object-fit:cover;']); ?>
                            <?php else : ?>
                                <div style="width:100%; height:100%; background:#eee; display:flex; align-items:center; justify-content:center; font-size:2rem;">👤</div>
                            <?php endif; ?>
                        </div>
                        <h3 style="margin-bottom:5px;"><?php echo esc_html($fp->post_title); ?></h3>
                        <p style="color:var(--primary-color); font-weight:700; font-size:0.9rem; margin-bottom:15px;"><?php echo esc_html($fp_meta['headline']); ?></p>
                        <a href="<?php echo esc_url($fp_url); ?>" target="_blank" style="display:inline-block; padding:10px 24px; background:#f1f2f6; color:#2d3436; text-decoration:none; border-radius:50px; font-weight:700; font-size:0.85rem;">View Profile</a>
                    </div>
                <?php endforeach;
            else: ?>
                <div style="grid-column: 1/-1; padding:40px; background:#f8f9fa; border-radius:24px; color:#999;">
                    Create the first profile to be featured here!
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Comparison Section -->
<?php
$comparison_json = get_option('saas_home_comparison_json');
if ($comparison_json) : ?>
<section class="section-padding bg-white">
    <div class="container-standard text-center">
        <h2 class="section-title-large">Why elite creators choose us</h2>
        <div class="comparison-table-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th style="color: #94a3b8;">Basic Link Hubs</th>
                        <th style="color: var(--primary-color); font-weight: 900;">Elite SaaS Funnel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = json_decode($comparison_json, true);
                    foreach ($rows as $row) : ?>
                        <tr>
                            <td style="font-weight: 700;"><?php echo esc_html($row['label']); ?></td>
                            <td style="color: <?php echo strpos($row['basic'], '✗') !== false ? '#ef4444' : '#94a3b8'; ?>;"><?php echo esc_html($row['basic']); ?></td>
                            <td style="color: #10b981; font-weight: 700;"><?php echo esc_html($row['elite']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Testimonials Section -->
<section class="section-padding bg-light">
    <div class="container-wide text-center">
        <h2 class="section-title-large"><?php echo get_option('saas_home_testimonials_title') ?: 'What elite creators are saying'; ?></h2>
        <div class="grid-3">
            <?php
            $t_json = get_option('saas_home_testimonials');
            $testimonials = json_decode($t_json, true) ?: [];
            foreach ($testimonials as $t) : ?>
                <div class="testimonial-block">
                    <div style="color: #f59e0b; font-size: 1.5rem; margin-bottom: 20px;">★★★★★</div>
                    <p class="quote">"<?php echo esc_html($t['text']); ?>"</p>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 50px; height: 50px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; color: #94a3b8;"><?php echo substr($t['name'], 0, 1); ?></div>
                        <div class="text-left">
                            <strong style="display: block; font-size: 1.1rem; color: #1e293b;"><?php echo esc_html($t['name']); ?></strong>
                            <small style="color: #64748b; font-weight: 600;"><?php echo esc_html($t['role']); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section">
    <div class="container-standard text-center">
        <h2 style="font-size: 2.5rem; margin-bottom: 60px;"><?php echo get_option('saas_pricing_title') ?: 'Simple, Transparent Pricing'; ?></h2>
        <div class="grid-3" style="align-items: stretch;">
            <?php
            $pricing_json = get_option('saas_home_pricing_json');
            $plans = json_decode($pricing_json, true) ?: [
                [
                    'name' => 'Free', 'price' => '$0', 'period' => 'forever', 'cta' => 'Join for Free', 'link' => '/register', 'style' => 'light',
                    'features' => ['1 Profile', 'Standard Blocks', 'Basic Analytics', 'Community Support']
                ],
                [
                    'name' => 'Elite Pro', 'price' => '$19', 'period' => '/mo', 'cta' => 'Upgrade to Pro', 'link' => '/register?plan=pro', 'style' => 'featured', 'badge' => 'FOR THE ELITE 1%',
                    'features' => ['Everything in Free', 'Unlimited Premium Blocks', 'Lead Generation CRM', 'Custom Domain Mapping', 'Priority Support']
                ],
                [
                    'name' => 'Agency Unlimited', 'price' => '$49', 'period' => '/mo', 'cta' => 'Go Unlimited', 'link' => '/register?plan=agency', 'style' => 'light',
                    'features' => ['Everything in Pro', 'Unlimited Sub-accounts', 'API Access', 'White-label Client Funnels', 'Dedicated Manager']
                ]
            ];
            foreach ($plans as $p) :
                $is_featured = ($p['style'] === 'featured');
            ?>
                <div class="pricing-plan-card <?php echo $is_featured ? 'is-featured' : 'is-light'; ?>">
                    <?php if (isset($p['badge'])) : ?>
                        <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #39e09b; padding: 5px 20px; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: #1e2329;"><?php echo esc_html($p['badge']); ?></div>
                    <?php endif; ?>
                    <h3><?php echo esc_html($p['name']); ?></h3>
                    <div style="font-size: 3rem; font-weight: 800; margin: 20px 0;"><?php echo esc_html($p['price']); ?><small style="font-size:1rem; opacity:0.7;"><?php echo esc_html($p['period']); ?></small></div>
                    <ul style="list-style: none; padding: 0; margin-bottom: 30px; <?php echo $is_featured ? 'color: rgba(255,255,255,0.8);' : 'color: var(--text-light);'; ?> flex: 1; text-align: left;">
                        <?php foreach ($p['features'] as $f) : ?>
                            <li style="margin-bottom:10px;">✓ <?php echo esc_html($f); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo home_url($p['link']); ?>" style="display: block; padding: 15px; border-radius: 50px; text-decoration: none; font-weight: 700; <?php echo $is_featured ? 'background: #fff; color: var(--primary-color);' : 'border: 2px solid var(--primary-color); color: var(--primary-color);'; ?>">
                        <?php echo esc_html($p['cta']); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Founder's Letter Section -->
<section class="section-padding bg-light">
    <div class="container-narrow card-white text-center">
        <div style="display: flex; gap: 30px; align-items: center; margin-bottom: 30px;">
            <?php
            $founder_img = get_option('saas_home_founder_image');
            if ($founder_img) : ?>
                <img src="<?php echo esc_url($founder_img); ?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            <?php else : ?>
                <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--primary-color); border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1);"></div>
            <?php endif; ?>
            <div class="text-left">
                <h3 style="margin: 0; font-size: 1.5rem;">A Message from the Founder</h3>
                <p style="margin: 0; color: var(--text-light);">Consultant & Digital Architect</p>
            </div>
        </div>
        <p style="font-size: 1.25rem; line-height: 1.8; color: #475569; font-style: italic;" class="text-left">
            "<?php echo get_option('saas_home_founder_letter') ?: 'I built this because I saw so many hard-working coaches losing leads to standard link trees. You deserve a system that converts your hard work into results.'; ?>"
        </p>
        <p style="margin-top: 20px; font-weight: 700; color: var(--primary-color);" class="text-left">— Let’s help more people, together.</p>
    </div>
</section>

<!-- Final CTA Section -->
<section class="section-padding-large bg-dark text-center" style="position: relative; overflow: hidden; border-top: 1px solid rgba(212,175,55,0.2);">
    <!-- Animated Glows -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.3; pointer-events: none;">
        <div style="position: absolute; top: -20%; left: -20%; width: 60%; height: 60%; background: radial-gradient(circle, #d4af37 0%, transparent 70%); filter: blur(80px); animation: drift 20s infinite alternate;"></div>
        <div style="position: absolute; bottom: -20%; right: -20%; width: 60%; height: 60%; background: radial-gradient(circle, #10b981 0%, transparent 70%); filter: blur(80px); animation: drift 25s infinite alternate-reverse;"></div>
    </div>
    <style> @keyframes drift { from { transform: translate(0,0); } to { transform: translate(10%, 10%); } } </style>

    <div class="container-standard" style="position: relative; z-index: 1;">
        <h2 style="font-size: clamp(2.5rem, 8vw, 5rem); font-weight: 900; margin-bottom: 25px; line-height: 1; letter-spacing: -3px; color: #fff;">
            Scale your <span style="background: linear-gradient(135deg, #d4af37, #f6e05e); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Authority</span>.<br>
            Own your <span style="background: linear-gradient(135deg, #10b981, #39e09b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Future</span>.
        </h2>
        <p style="font-size: 1.8rem; color: #94a3b8; margin-bottom: 60px; max-width: 800px; margin-left: auto; margin-right: auto; line-height: 1.4;">
            The world's most elite creators are switching to our funnel-first bio engine. Are you ready to convert more traffic?
        </p>

        <div style="display: flex; flex-direction: column; align-items: center; gap: 30px;">
            <a href="<?php echo home_url('/register'); ?>" style="display: inline-block; padding: 28px 80px; background: linear-gradient(135deg, #d4af37 0%, #b5892d 100%); color: #000; text-decoration: none; border-radius: 100px; font-weight: 900; font-size: 1.75rem; box-shadow: 0 30px 60px -12px rgba(212, 175, 55, 0.4); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);" onmouseover="this.style.transform='scale(1.05) translateY(-5px)'; this.style.boxShadow='0 40px 80px -12px rgba(212, 175, 55, 0.6)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 30px 60px -12px rgba(212, 175, 55, 0.4)';">
                Get Your Elite Link Now
            </a>

            <div style="display: flex; gap: 40px; color: #64748b; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                <span>✓ No Coding</span>
                <span>✓ No Credit Card</span>
                <span>✓ Instant Setup</span>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-padding bg-white">
    <div class="container-narrow">
        <h2 class="text-center" style="font-size: 2.5rem; margin-bottom: 60px;">Common Questions</h2>
        <?php
        $f_json = get_option('saas_home_faq');
        $faqs = json_decode($f_json, true) ?: [];
        foreach ($faqs as $f) : ?>
            <details class="faq-block" style="margin-bottom: 15px; background: #f8fafc; border-radius: 16px;">
                <summary style="padding: 20px; font-weight: 700; cursor: pointer;"><?php echo esc_html($f['q']); ?></summary>
                <p style="padding: 0 20px 20px; color: var(--text-light);"><?php echo esc_html($f['a']); ?></p>
            </details>
        <?php endforeach; ?>
    </div>
</section>

<script>
jQuery(document).ready(function($) {
    var timer;
    $('#saas-home-username').on('keyup', function() {
        var user = $(this).val();
        var $status = $('#username-status');
        clearTimeout(timer);

        if (user.length < 3) {
            $status.text('').css('color', 'inherit');
            return;
        }

        $status.text('Checking availability...').css('color', '#666');

        timer = setTimeout(function() {
            $.post('<?php echo admin_url("admin-ajax.php"); ?>', {
                action: 'saas_check_username',
                username: user
            }, function(res) {
                if (res.success) {
                    $status.text('✓ ' + user + ' is available!').css('color', '#10b981');
                } else {
                    $status.text('✗ ' + user + ' is already taken.').css('color', '#ef4444');
                }
            });
        }, 500);
    });
});
</script>

<?php get_footer(); ?>
