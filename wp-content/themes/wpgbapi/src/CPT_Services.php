<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class CPT_Services
{
    public function __construct() {
        add_action( 'init', array( $this, 'register_cpt_services' ) );
    }

    /**
     * Definition and registering of the post type.
     *
     * @return void
     */
    public function register_cpt_services() {
        $labels = array(
            'name'               => _x( 'Services', 'post type general name', 'wpgbapi' ),
            'singular_name'      => _x( 'Service', 'post type singular name', 'wpgbapi' ),
            'add_new'            => __( 'Neuen Eintrag anlegen', 'wpgbapi' ),
            'add_new_item'       => __( 'Neuen Eintrag anlegen', 'wpgbapi' ),
            'edit_item'          => __( 'Eintrag bearbeiten', 'wpgbapi' ),
            'new_item'           => __( 'Neuer Eintrag', 'wpgbapi' ),
            'all_items'          => __( 'Alle Einträge', 'wpgbapi' ),
            'view_item'          => __( 'Eintrag ansehen', 'wpgbapi' ),
            'search_items'       => __( 'Einträge durchsuchen', 'wpgbapi' ),
            'not_found'          => __( 'Kein Eintrag gefunden', 'wpgbapi' ),
            'not_found_in_trash' => __( 'Kein Eintrag im Papierkorb gefunden', 'wpgbapi' ),
            'parent_item_colon'  => '',
            'menu_name'          => 'Services',
        );
        $args   = array(
            'labels'              => $labels,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'capability_type'     => 'page',
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'show_in_rest'        => true,
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive'         => false,
            'menu_icon'           => 'dashicons-media-document',
            'can_export'          => false,
            'rewrite'             => array( 'slug' => 'services', 'with_front' => true ),
        );
        register_post_type( 'cpt-services', $args );
    }


}