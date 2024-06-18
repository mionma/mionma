<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpgbapi
 */

?>

	<footer id="site-footer" class="site-footer">

        <div class="footer-pages">
            <div class="inner s1x-padding s1x-constraint">

                <picture class="footer-brandmark">
                    <?php if( $image = get_field('logo_footer_brandmark', 'options' ) ) : ?>
                        <?php echo \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $image['url'] ); ?>
                        <img width="<?php echo $image['width']; ?>"
                             height="<?php echo $image['height']; ?>"
                             src="<?php echo $image['url']; ?>"
                             alt="<?php echo $image['alt']; ?>">
                    <?php endif; ?>
                </picture>

                <div class="col-nav">

                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer_bar_menu1',
                            'menu_id'        => 'footer-bar-menu1',
                        )
                    );
                    ?>

                </div>
                <div class="col-nav">

                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer_bar_menu2',
                            'menu_id'        => 'footer-bar-menu2',
                        )
                    );
                    ?>

                </div>

                <div class="col-nav">

                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer_bar_menu3',
                            'menu_id'        => 'footer-bar-menu3',
                        )
                    );
                    ?>

                </div>

            </div>
        </nav>

        <nav id="footer-legal">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer_bar_legal',
                    'menu_id'        => 'footer-bar-legal-menu',
                )
            );
            ?>
        </nav>

        <div class="footer-copyright">
            Patrick Michels Online-Marketing &copy; 2024
        </div>

	</footer>



</div><!-- #page -->



<?php wp_footer(); ?>

</body>
</html>
