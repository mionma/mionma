<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpgbapi
 */

get_header();
?>

    <main id="site-content" class="site-main">

        <?php
        while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; ?>


    </main><!-- #site-content -->

<?php
get_footer();
