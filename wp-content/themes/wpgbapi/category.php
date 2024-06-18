<?php
/**
 * The template for displaying cagtegories
 *
 * @package wpgbapi
 */


get_header();
?>

<main id="site-content" class="site-main">

    <section class="post-header s1x-constraint s1x-padding">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </section>

    <?php get_template_part('template-parts/post', 'category-posts'); ?>

</main>


<?php
get_footer();