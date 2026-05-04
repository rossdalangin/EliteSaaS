<?php
/**
 * Template Name: Legal (Terms, Privacy)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main id="legal-page" class="site-main site-container legal-main-container">
    <div class="legal-inner-card">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <header class="entry-header mb-40 text-center">
                <?php the_title( '<h1 class="entry-title text-5xl font-black">', '</h1>' ); ?>
                <p class="color-lighter">Last Updated: <?php echo get_the_modified_date(); ?></p>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
