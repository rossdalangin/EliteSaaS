<?php
/**
 * Template Name: Clean Layout (Distraction-Free)
 */

get_header(); ?>

<main id="clean-layout" class="site-main clean-layout-container">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('clean-layout-article'); ?>>
            <header class="clean-header clean-layout-header">
                <?php the_title( '<h1 class="clean-title clean-layout-title">', '</h1>' ); ?>
            </header>

            <div class="clean-content clean-layout-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<style>
    body { background-color: #f9f9f9; }
    .clean-content img { max-width: 100%; height: auto; border-radius: 8px; margin-bottom: 24px; }
</style>

<?php get_footer(); ?>
