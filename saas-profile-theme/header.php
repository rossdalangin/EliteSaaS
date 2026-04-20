<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $global_favicon = get_option('saas_global_favicon');
    $slug = get_query_var( 'saas_profile' );
    if ($slug) :
        $profile = saas_get_profile_by_slug($slug);
        if ($profile) :
            $p_id = $profile->ID;
            $p_meta = saas_get_profile_meta($p_id);
            $custom_title = get_post_meta($p_id, '_saas_seo_title', true);
            $custom_desc = get_post_meta($p_id, '_saas_seo_desc', true);
            $custom_favicon = get_post_meta($p_id, '_saas_favicon', true) ?: $global_favicon;
            ?>
            <title><?php echo esc_html($custom_title ?: $profile->post_title . ' | Digital Business Card'); ?></title>
            <meta name="description" content="<?php echo esc_attr($custom_desc ?: wp_trim_words($p_meta['bio'], 25)); ?>">
            <?php if($custom_favicon) : ?><link rel="icon" href="<?php echo esc_url($custom_favicon); ?>"><?php endif; ?>
            <meta property="og:title" content="<?php echo esc_html($profile->post_title); ?>">
            <meta property="og:description" content="<?php echo esc_attr($p_meta['headline']); ?>">
            <meta property="og:type" content="profile">
            <meta property="og:url" content="<?php echo home_url('/' . $slug); ?>">
            <link rel="canonical" href="<?php echo home_url('/' . $slug); ?>">
            <?php
            $og_image = get_the_post_thumbnail_url($profile->ID, 'full');
            if (!$og_image) {
                $cover_id = get_post_meta($profile->ID, '_saas_cover_id', true);
                if ($cover_id) $og_image = wp_get_attachment_url($cover_id);
            }
            if ($og_image) : ?>
                <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
                <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
            <?php endif; ?>
        <?php endif;
    endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Montserrat:wght@400;700;900&family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <?php if(!empty($global_favicon) && !get_query_var('saas_profile')) : ?>
        <link rel="icon" href="<?php echo esc_url($global_favicon); ?>">
    <?php endif; ?>
    <?php
    $global_css = get_option('saas_global_css');
    if ($global_css) : ?>
        <style id="saas-global-dynamic-css"><?php echo $global_css; ?></style>
    <?php endif; ?>
    <?php
    if ($slug) {
        $profile = saas_get_profile_by_slug($slug);
        if ($profile) {
            $payments = new Saas_Payments();
            if ($payments->is_pro_user($profile->post_author)) {
                echo get_post_meta($profile->ID, '_saas_header_scripts', true);
            }
        }
    }
    ?>
</head>
<body <?php body_class( $theme_class ?? '' ); ?> data-saas-theme="light">

<?php
// Only show the global header and site navigation if we're NOT on a user profile page.
if ( ! get_query_var( 'saas_profile' ) ) : ?>
    <?php
    $global_logo = get_option('saas_global_logo');
    if ($global_logo) : ?>
        <div class="saas-global-header" style="text-align:center; padding:20px 0;">
            <img src="<?php echo esc_url($global_logo); ?>" alt="SaaS Logo" style="max-height:40px;">
        </div>
    <?php endif; ?>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url( home_url( '/' ) ) . '" style="font-size: 1.5rem; font-weight: 800; text-decoration: none; color: var(--text-color);">' . get_bloginfo( 'name' ) . '</a>';
                }
                ?>
            </div>

            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

            <nav id="site-navigation" class="main-navigation">
                <ul id="primary-menu" class="primary-menu-list">
                    <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
                    <li><a href="<?php echo home_url('/directory'); ?>">Discovery</a></li>
                    <li><a href="<?php echo home_url('/pricing'); ?>">Pricing</a></li>
                    <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
                    <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
                    <li class="mobile-only-cta">
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo home_url('/dashboard'); ?>">Dashboard</a>
                        <?php else : ?>
                            <a href="<?php echo home_url('/login'); ?>">Login</a>
                            <a href="<?php echo home_url('/register'); ?>" class="saas-link-btn style-featured" style="margin-top: 10px;">Get Started</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>

            <div class="header-cta">
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo home_url('/dashboard'); ?>" class="saas-link-btn style-featured" style="padding: 10px 24px; font-size: 0.9rem;">Dashboard</a>
                <?php else : ?>
                    <a href="<?php echo home_url('/login'); ?>" style="text-decoration: none; color: var(--text-light); font-weight: 600; margin-right: 24px;">Login</a>
                    <a href="<?php echo home_url('/register'); ?>" class="saas-link-btn style-featured" style="padding: 10px 24px; font-size: 0.9rem;">Get Started</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
<?php endif; ?>

<?php wp_body_open(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const siteNavigation = document.getElementById('site-navigation');

    if (menuToggle && siteNavigation) {
        menuToggle.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            siteNavigation.classList.toggle('is-active');
            document.body.classList.toggle('menu-open');
        });

        // Close menu when clicking a link
        const navLinks = siteNavigation.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.setAttribute('aria-expanded', 'false');
                siteNavigation.classList.remove('is-active');
                document.body.classList.remove('menu-open');
            });
        });
    }
});
</script>
