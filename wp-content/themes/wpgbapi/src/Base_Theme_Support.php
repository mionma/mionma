<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class Base_Theme_Support
{
    public function __construct() {
        add_action( 'init' , array( $this, 'disable_file_editors' ) );
        add_action( 'init' , array( $this, 'disable_post_tags' ) );
        add_action( 'init' , array( $this, 'disable_emojis' ) );
        add_action( 'wp_default_scripts', array( $this, 'disable_jquery_migrate' )  );
        add_action( 'after_setup_theme', array( $this, 'load_theme_support' ) );
        add_action( 'after_setup_theme', array( $this, 'remove_admin_bar' ) );
        add_action( 'customize_register', array( $this, 'disable_custom_css' ) );
        // add_filter( 'wpcf7_autop_or_not', '__return_false');
        add_filter( 'the_content_more_link' , array( $this, 'remove_more_link_scroll') );
        add_action( 'template_redirect', array( $this, 'disable_wp_author_page_and_rd404' ) );
        add_filter( 'rank_math/table_of_contents/heading_tags', array( $this, 'rankmath_add_custom_headings_to_toc' ) );

        remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );

        add_shortcode('shy', array( $this, 'shortcode_shy') );
    }




    /**
     * Disable the build-in theme file editors
     */
    public function disable_file_editors() {
        define('DISALLOW_FILE_EDIT', TRUE);
    }

    /**
     * Disable the build-in customizer css editor
     */
    public function disable_custom_css( $wp_customize ) {
        $wp_customize->remove_section('custom_css');
    }

    /**
     * Disable wordpress emojis
     */
    public function disable_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojis_tinymce' ) );
    }

    public function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }


    /**
     * Disable jQuery Migrate
     */
    public function disable_jquery_migrate( $scripts ) {
        if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
            $script = $scripts->registered['jquery'];

            if ( $script->deps ) {
                // Check whether the script has any dependencies
                $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
            }
        }
    }


    /**
     * Disable wordpress emojis
     */
    public function remove_more_link_scroll( $link ) {
        $link = preg_replace( '|#more-[0-9]+|', '', $link );
        return $link;
    }


    /**
     * Disable wordpress author pages and redirect to 404 page
     */
    function disable_wp_author_page_and_rd404() {
        global $wp_query;

        if ( is_author() ) {
            // Redirect to 404 error page
            $wp_query->set_404();
            status_header(404);
        }
    }




    public function disable_post_tags () {
        register_taxonomy('post_tag', array());
    }

    public function load_theme_support() {
        load_theme_textdomain( 'wpgbapi', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'editor-styles' );
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    }

    public function remove_admin_bar() {
        if ( !current_user_can('administrator' ) && !is_admin() ) {
            show_admin_bar(false);
        }
    }


    public function shortcode_shy($atts) {
        return '&shy;';
    }


    /**
     * Filter to add custom headings to Rank Math TOC Block
     */
    function rankmath_add_custom_headings_to_toc( $headings ) {
        // Add your custom heading selectors here
        $headings[] = '.rankmath-toc-headline';
        return $headings;
    }

    /**
     * Check if .webp Version of Image is present and if, create a <source> tag for <picture>
     */
    public static function get_imagify_webp_picture_source( $imageurl ) {
        $html_out = '';

        if( $imageurl != '' ) {
            // replace url part with server filesystem location
            $file_check = str_replace( get_site_url(), $_SERVER['DOCUMENT_ROOT'], $imageurl ) . '.webp';

            if (file_exists( $file_check )) {
                $html_out = '<source type="image/webp" srcset="' . $imageurl . '.webp">';
            }
        }

        return $html_out;
    }

}