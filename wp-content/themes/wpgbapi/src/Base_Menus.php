<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class Base_Menus
{
    public function __construct() {
        add_action( 'init', array( $this, 'add_menus' ) );
        add_filter( 'wp_get_nav_menu_items', array( $this, 'prefix_nav_menu_classes' ), 10, 3 );
    }

    /**
     * Add the Menu positions.
     *
     * @return void
     */
    public function add_menus() {
        register_nav_menus(
            array(
                'header_menu' => __( 'Header Menu', 'wpgbapi' ),
                'footer_bar_menu1'  => __( 'Footer Bar Menu1', 'wpgbapi' ),
                'footer_bar_menu2'  => __( 'Footer Bar Menu2', 'wpgbapi' ),
                'footer_bar_menu3'  => __( 'Footer Bar Menu3', 'wpgbapi' ),
                'footer_bar_legal'  => __( 'Footer Bar Legal', 'wpgbapi' ),
            )
        );
    }

    public function prefix_nav_menu_classes($items, $menu, $args) {
        _wp_menu_item_classes_by_context($items);
        return $items;
    }
}