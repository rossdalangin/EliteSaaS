<?php
/**
 * Template Name: Auth Page (Login/Register)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main id="auth-page" class="landing-main auth-main">
    <!-- Animated Background -->
    <div class="animated-mesh-bg">
        <div class="mesh-circle-1"></div>
    </div>

    <div class="landing-content auth-card bg-white radius-xl shadow-xl">
        <div class="mb-32">
            <h1 class="text-4xl font-black mb-0"><?php the_title(); ?></h1>
        </div>

        <div class="auth-form-container text-left">
            <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
