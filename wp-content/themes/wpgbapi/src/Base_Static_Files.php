<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class Base_Static_Files
{
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'load_stylesheets' ), 50 );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
        add_action( 'enqueue_block_editor_assets', array( $this, 'load_block_editor_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );
    }


    public function registerScripts($type) {
        $suffix = '';
        if($type === 'admin') {
            $suffix = '-admin';
        }

        /* difference between admin and frontend */
        wp_register_script( 'block-faq-output-accordion' . $suffix, _THEME_URI . '/blocks/faq-output-accordion/script' . $suffix . '.js', array( 'jquery', 'acf' ), _THEME_VERSION, true );
        wp_register_script( 'block-faq-output-full' . $suffix, _THEME_URI . '/blocks/faq-output-full/script' . $suffix . '.js', array( 'jquery', 'acf' ), _THEME_VERSION, true );
        wp_register_script( 'block-image-showcase-grid' . $suffix, _THEME_URI . '/blocks/image-showcase-grid/script' . $suffix . '.js', array( 'jquery', 'acf', 'swiper' ), _THEME_VERSION, true );
    }



    public function load_stylesheets() {
        /* general frontend style includes */
        wp_register_style( 'swiper', _THEME_URI . '/assets/inc/swiper_v11-1-4/swiper-bundle.min.css', array(), _THEME_VERSION );

        /* general frontend styles */
        wp_enqueue_style( 'wpgbapi-style', get_stylesheet_uri(), array(), _THEME_VERSION );
        wp_enqueue_style( 'wpgbapi-out-frontend', _THEME_URI . '/css/out-frontend.min.css', array(), _THEME_VERSION );
    }

    public function load_scripts() {
        /* general frontend includes */
        // wp_register_script( 'fasjs', _THEME_URI . '/assets/inc/fasjs/fasjs-bundle.js', array( 'jquery' ), _THEME_VERSION, true );
        wp_register_script( 'swiper', _THEME_URI . '/assets/inc/swiper_v11-1-4/swiper-bundle.min.js', array( 'jquery', 'acf' ), _THEME_VERSION, true );

        /* general frontend scripts */
        wp_enqueue_script( 'wpgbapi-navigation', _THEME_URI . '/js/navigation.js', array( 'jquery' ), _THEME_VERSION, true );

        /* block scripts */
        $this->registerScripts('frontend');
    }

    public function load_admin_scripts() {
        /* general Scripts */
        // wp_register_script( 'fasjs', _THEME_URI . '/assets/inc/fasjs/fasjs-bundle.js', array( 'jquery' ), _THEME_VERSION, true );
        wp_enqueue_script( 'swiper', _THEME_URI . '/assets/inc/swiper_v11-1-4/swiper-bundle.min.js', array( 'jquery', 'acf' ), _THEME_VERSION, true );

        /* editorStyles - copy from load_stylesheets */
        wp_enqueue_style( 'swiper', _THEME_URI . '/assets/inc/swiper_v11-1-4/swiper-bundle.min.css', array(), _THEME_VERSION );
        wp_enqueue_style( 'wpgbapi-out-backend', _THEME_URI . '/css/out-backend.css', array(), _THEME_VERSION );

        $this->registerScripts('admin');
    }

    public function load_block_editor_assets() {
        // wp_register_style( 'swiper', _THEME_URI . '/assets/inc/swiper_v11-0-3/swiper-bundle.min.css', array(), _THEME_VERSION );
        // wp_register_script( 'swiper', _THEME_URI . '/assets/inc/swiper_v11-0-3/swiper-bundle.min.js', array( 'jquery', 'acf' ), _THEME_VERSION, true );
    }


}