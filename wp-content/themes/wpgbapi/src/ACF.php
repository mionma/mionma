<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class ACF
{
    /**
     * - Creates the Theme Settings ACF Page.
     */
    public function __construct() {
        add_action('init', array($this, 'register_acf_blocks' ) );

        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page(
                array(
                    'page_title' => 'Theme Settings',
                    'menu_title' => 'Theme Settings',
                    'menu_slug'  => 'theme-settings',
                    'capability' => 'edit_posts',
                    'redirect'   => false,
                )
            );
        }

        add_filter( 'allowed_block_types_all', array( $this, 'gutenberg_blocks'), 25, 2);
    }


    public function register_acf_blocks() {
        register_block_type( _THEME_PATH . '/blocks/faq-output-full' );
        register_block_type( _THEME_PATH . '/blocks/header' );
        register_block_type( _THEME_PATH . '/blocks/image-showcase-grid' );
        register_block_type( _THEME_PATH . '/blocks/impressum-used-cc-media' );
        register_block_type( _THEME_PATH . '/blocks/post-output-full' );
        register_block_type( _THEME_PATH . '/blocks/post-output-teaser' );
        register_block_type( _THEME_PATH . '/blocks/reference-output-full' );
        register_block_type( _THEME_PATH . '/blocks/reference-output-teaser' );
        register_block_type( _THEME_PATH . '/blocks/service-output-full' );
    }

    /*
     * Whitelist specific Gutenberg blocks (paragraph, heading, image and lists)
     */
    function gutenberg_blocks( $allowed_blocks, $editor_context ) {

        if ( 'page' === $editor_context->post->post_type ) {
            return array(
                /* 'core/paragraph',
                'core/list',
                'core/list-item', */


                'acf/faq-output-full',
                'acf/header',
                'acf/image-showcase-grid',
                'acf/impressum-used-cc-media',
                'acf/post-output-full',
                'acf/post-output-teaser',
                'acf/reference-output-full',
                'acf/reference-output-teaser',
                'acf/service-output-full',

                'erecht24/erecht24',

                'core/shortcode',
                'core/group',
                'core/paragraph',
                'core/heading',
                'core/list',
                'core/list-item',
            );
        }


        if ( 'post' === $editor_context->post->post_type OR
            'cpt-references' === $editor_context->post->post_type OR
            'cpt-services' === $editor_context->post->post_type) {

            return array(
                'acf/header',
                'acf/image-showcase-grid',
                'core/group',
                'core/image',
                'core/paragraph',
                'core/heading',
                'core/list',
                'core/list-item',
                'rank-math/toc-block',
                'enlighter/codeblock',
            );
        }

        if ( 'cpt-faq' === $editor_context->post->post_type ) {

            return array(
                'core/heading',
                'core/paragraph',
                'core/image',
                'core/list',
                'core/list-item',
            );
        }

    }

    public static function globalblock_get_padding_option_cssvars() {

        if( $options = get_field('blockgobal_padding_options') ) {
            $vars  = '--bgp-mobile-top: ' . $options['padding_mobile_top'] . 'px;';
            $vars .= '--bgp-mobile-bottom: ' . $options['padding_mobile_bottom'] . 'px;';
            $vars .= '--bgp-tablet-top: ' . $options['padding_tablet_top'] . 'px;';
            $vars .= '--bgp-tablet-bottom: ' . $options['padding_tablet_bottom'] . 'px;';
        } else {
            $vars  = '--bgp-mobile-top: 40px;';
            $vars .= '--bgp-mobile-bottom: 40px;';
            $vars .= '--bgp-tablet-top: 40px;';
            $vars .= '--bgp-tablet-bottom: 40px;';
        }

        return $vars;

    }

}