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

    <main id="site-content" class="site-main">

        <?php
        while ( have_posts() ) : the_post(); ?>

            <?php $theID = get_the_ID(); ?>

            <?php the_content(); ?>

        <?php endwhile; ?>

    </main><!-- #site-content -->

    <nav id="more-articles">
        <div class="wp-block-group be-leftsided">
            <h2>Weitere Referenzen</h2>
        </div>
        <?php include('blocks/reference-output-teaser/block.php'); ?>
        <div class="wp-block-group be-leftsided"></div>
    </nav>

<?php
get_footer();
