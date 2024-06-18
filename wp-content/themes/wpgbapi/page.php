<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
