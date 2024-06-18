<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class CPT_FAQ
{
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_cpt_faq' ) );
        add_action( 'init', array( $this, 'register_cpt_faq_category' ) );
    }

    /**
     * Definition and registering of the post type.
     *
     * @return void
     */
    public function register_cpt_faq() {
        $labels = array(
            'name'               => _x( 'FAQ', 'post type general name', 'wpgbapi' ),
            'singular_name'      => _x( 'FAQ', 'post type singular name', 'wpgbapi' ),
            'add_new'            => __( 'Neuen FAQ anlegen', 'wpgbapi' ),
            'add_new_item'       => __( 'Neuen FAQ anlegen', 'wpgbapi' ),
            'edit_item'          => __( 'FAQ bearbeiten', 'wpgbapi' ),
            'new_item'           => __( 'Neue FAQ', 'wpgbapi' ),
            'all_items'          => __( 'Alle FAQ', 'wpgbapi' ),
            'view_item'          => __( 'FAQ ansehen', 'wpgbapi' ),
            'search_items'       => __( 'FAQ durchsuchen', 'wpgbapi' ),
            'not_found'          => __( 'Kein FAQ gefunden', 'wpgbapi' ),
            'not_found_in_trash' => __( 'Kein FAQ im Papierkorb gefunden', 'wpgbapi' ),
            'parent_item_colon'  => '',
            'menu_name'          => 'FAQ',
        );
        $args   = array(
            'labels'              => $labels,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'publicly_queryable'  => false,
            'exclude_from_search' => false,
            'supports'            => array( 'title', 'editor'),
            'has_archive'         => false,
            'menu_icon'           => 'dashicons-media-document',
            'can_export'          => false,
            'rewrite'             => array( 'slug' => 'faq', 'with_front' => false ),
        );
        register_post_type( 'cpt-faq', $args );
    }


    /**
     * Adds the References Category taxonomy.
     *
     * @return void
     */
    public function register_cpt_faq_category()
    {
        $labels = array(
            'name' => _x('Kategorien', 'Taxonomy General Name', 'wpgbapi'),
            'singular_name' => _x('Kategorie', 'Taxonomy Singular Name', 'wpgbapi'),
            'menu_name' => __('Kategorien', 'wpgbapi'),
            'all_items' => __('Alle Kategorien', 'wpgbapi'),
            'parent_item' => __('Übergeordnete Kategorie', 'wpgbapi'),
            'parent_item_colon' => __('Übergeordnete Kategorie:', 'wpgbapi'),
            'new_item_name' => __('Kategorie Name', 'wpgbapi'),
            'add_new_item' => __('Neue Kategorie hinzufügen', 'wpgbapi'),
            'edit_item' => __('Kategorie bearbeiten', 'wpgbapi'),
            'update_item' => __('Kategorie updaten', 'wpgbapi'),
            'view_item' => __('Kategorie anzeigen', 'wpgbapi'),
            'separate_items_with_commas' => __('Separate SS Tags with commas', 'wpgbapi'),
            'add_or_remove_items' => __('Add or remove SS Tags', 'wpgbapi'),
            'choose_from_most_used' => __('Choose from the most used', 'wpgbapi'),
            'popular_items' => __('Popular SS Tags', 'wpgbapi'),
            'search_items' => __('Search SS Tags', 'wpgbapi'),
            'not_found' => __('Not Found', 'wpgbapi'),
            'no_terms' => __('No Tags', 'wpgbapi'),
            'items_list' => __('Tags list', 'wpgbapi'),
            'items_list_navigation' => __('Tags list navigation', 'wpgbapi'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => false,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => false,
        );
        register_taxonomy('cpt-faq-category', array('cpt-faq'), $args);
    }

}