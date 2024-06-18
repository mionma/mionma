<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wpgbapi
 */


get_header();
?>

    <main id="site-content">

        <?php
        while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; ?>


    </main><!-- #site-content -->

<?php
get_footer();
