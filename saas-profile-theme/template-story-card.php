<?php
/**
 * Template Name: Story Card (Vertical)
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<main id="story-card" class="landing-main">
    <div class="landing-content">
        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
        <button class="btn-close-story" onclick="window.close()">Close</button>
    </div>
</main>

<?php get_footer(); ?>
