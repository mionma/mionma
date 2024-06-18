<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpgbapi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="site-header" class="site-header">
        <div class="site-header-contact">
            <div class="cntnr-inner s1x-constraint s1x-padding">
                <div class="contact-info">
                    <!-- <div class="phone">
                        <?php // echo get_field('contact_telephone', 'option'); ?>
                    </div>
                    <div class="mail">
                        <?php // $contact_mail = get_field('contact_email', 'option'); ?>
                        <a href="mailto:<?php // echo $contact_mail; ?>">
                            <?php // echo $contact_mail; ?>
                        </a>
                    </div> --->
                    <div class="contact">
                        <?php $contact_page_id = get_field('contact_page', 'option'); ?>
                        <a href="<?php echo get_the_permalink($contact_page_id); ?>">
                            <?php echo get_the_title($contact_page_id); ?>
                        </a>
                    </div>
                </div>
                <div class="social-profiles">
                    <?php
                    $socials = array('contact_social_instagram',
                        'contact_social_facebook',
                        'contact_social_linkedin',
                        'contact_social_github');

                    foreach ($socials as $social) : ?>

                        <?php if( $icon = get_field( $social . '_icon', 'option') AND $url = get_field( $social . '_url', 'option') ) : ?>
                            <a href="<?php echo $url; ?>" target="_blank">
                                <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
                            </a>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <div class="site-header-main">
            <div class="cntnr-inner s1x-constraint s1x-padding">

                <div id="site-logo" class="s1x-noselect">
                        <a aria-label="Kehre zur Startseite zurück" href="<?php echo get_site_url(); ?>">
                            <?php if ( $logo = get_field('logo', 'option') ) : ?>

                            <picture>
                                <?php echo \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $logo['url'] ); ?>
                                <img width="<?php echo $logo['width']; ?>"
                                     height="<?php echo $logo['height']; ?>"
                                     src="<?php echo $logo['url']; ?>"
                                     alt="<?php echo $logo['alt']; ?>">
                            </picture>

                            <?php endif; ?>
                        </a>
                </div>

                <div id="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <nav id="header-nav" class="header-nav s1x-noselect">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header_menu',
                            'menu_id'        => 'header_menu',
                            'container' => false,
                        )
                    );
                    ?>
                </nav><!-- #header-nav -->

            </div>

        </div><!-- .site-header-inner -->

	</header><!-- #site-header -->






