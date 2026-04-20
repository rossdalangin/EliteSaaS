<?php
/**
 * Template Name: Contact Page
 */

get_header(); ?>

<?php $c_title = get_option('saas_contact_title') ?: 'Get in Touch'; ?>
<main id="contact-page" class="site-main">
    <section class="landing-content" style="padding-top: 100px;">
        <div class="feature-card-light" style="max-width: 800px; margin: 0 auto; padding: 64px; text-align: center;">
            <h1 class="landing-title" style="font-size: 3.5rem; margin-bottom: 16px;"><?php echo esc_html($c_title); ?></h1>
            <p class="landing-hero-text" style="font-size: 1.25rem; margin-bottom: 48px;">Have questions? We're here to help you scale.</p>

            <form style="text-align:left;">
                <div style="margin-bottom:24px;">
                    <label style="display:block; margin-bottom:8px; font-weight:700; color: var(--text-color);">Name</label>
                    <input type="text" style="width:100%; padding:16px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-family: inherit; font-size: 1rem;">
                </div>
                <div style="margin-bottom:24px;">
                    <label style="display:block; margin-bottom:8px; font-weight:700; color: var(--text-color);">Email</label>
                    <input type="email" style="width:100%; padding:16px; border:1px solid var(--border-color); border-radius:var(--radius-md); font-family: inherit; font-size: 1rem;">
                </div>
                <div style="margin-bottom:32px;">
                    <label style="display:block; margin-bottom:8px; font-weight:700; color: var(--text-color);">Message</label>
                    <textarea style="width:100%; padding:16px; border:1px solid var(--border-color); border-radius:var(--radius-md); min-height:160px; font-family: inherit; font-size: 1rem;"></textarea>
                </div>
                <button type="submit" class="hero-claim-btn" style="width:100%; padding: 20px;">Send Message</button>
            </form>

            <div style="margin-top: 48px; display: flex; justify-content: center; gap: 40px; color: var(--text-lighter); font-weight: 600;">
                <div>📍 Global / Remote</div>
                <div>✉️ support@yourdomain.com</div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
