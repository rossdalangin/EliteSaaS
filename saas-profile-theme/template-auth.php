<?php
/**
 * Template Name: Auth Page (Login/Register)
 */

get_header(); ?>

<main id="auth-page" class="landing-main" style="justify-content: center; padding: 64px 24px;">
    <div class="hero-glow hero-glow-1"></div>
    <div class="auth-card glass-card" style="width: 100%; max-width: 440px; padding: 48px; text-align: center; position: relative; z-index: 1;">
        <div class="auth-logo" style="margin-bottom: 32px;">
            <?php if ( has_custom_logo() ) : the_custom_logo(); else: ?>
                <?php
                $login_title = get_option('saas_login_title') ?: 'Welcome Back';
                $register_title = get_option('saas_register_title') ?: 'Join the Elite';
                $is_register = strpos($_SERVER['REQUEST_URI'], 'register') !== false;
                ?>
                <h2 class="text-gradient-primary" style="margin: 0; font-size: 2rem;">
                    <?php echo esc_html($is_register ? $register_title : $login_title); ?>
                </h2>
            <?php endif; ?>
        </div>

        <div class="auth-content" style="text-align: left;">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<style>
    #auth-page input[type="text"],
    #auth-page input[type="email"],
    #auth-page input[type="password"] {
        width: 100%;
        padding: 14px 18px;
        margin-bottom: 16px;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        box-sizing: border-box;
        font-family: inherit;
        font-size: 1rem;
        background: #fff;
    }
    #auth-page .button,
    #auth-page button,
    #auth-page input[type="submit"] {
        width: 100%;
        padding: 16px;
        background: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: var(--radius-full);
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-bounce);
        font-size: 1rem;
    }
    #auth-page .button:hover,
    #auth-page button:hover,
    #auth-page input[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(108, 92, 231, 0.2);
    }
    .auth-content a {
        color: var(--primary-color);
        font-weight: 600;
    }
</style>

<?php get_footer(); ?>
