<?php

namespace WPGBAPI;

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

class CPT_References
{
    public function __construct() {
        add_action( 'init', array( $this, 'register_cpt_references' ) );
        add_action( 'init', array( $this, 'register_cpt_references_category' ) );

        add_action( 'wp_ajax_nopriv_get_block_references_entry_output' , array( $this, 'get_block_references_entry_output' ) );
        add_action( 'wp_ajax_get_block_references_entry_output' , array( $this, 'get_block_references_entry_output' ) );
    }

    /**
     * Definition and registering of the post type.
     *
     * @return void
     */
    public function register_cpt_references() {
        $labels = array(
            'name'               => _x( 'Referenzen', 'post type general name', 'wpgbapi' ),
            'singular_name'      => _x( 'Referenz', 'post type singular name', 'wpgbapi' ),
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
            'menu_name'          => 'Referenzen',
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
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'show_in_rest'        => true,
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive'         => false,
            'menu_icon'           => 'dashicons-media-document',
            'can_export'          => false,
            'rewrite'             => array( 'slug' => 'referenzen', 'with_front' => true ),
        );
        register_post_type( 'cpt-references', $args );
    }


    /**
     * Adds the References Category taxonomy.
     *
     * @return void
     */
    public function register_cpt_references_category()
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
        register_taxonomy('cpt-references-category', array('cpt-references'), $args);
    }




    public function get_block_references_entry_output() {
        // helper function for ajax call
        $filter_termid = intval( $_POST['termID'] );
        echo $this->build_block_references_entry_output($filter_termid);
        wp_die();
    }

    public static function build_block_references_entry_output($filter_termid) {

        // check if filter by termid or output all
        if( $filter_termid == '0' OR $filter_termid == '') {
            // no tax query
            $_tax_query = '';
        } else {
            // filter by category id
            $_tax_query =  array(
                array(
                    'taxonomy' => 'cpt-references-category',
                    'field' => 'id',
                    'terms' => $filter_termid,
                )
            );
        }

        $args = array(
            'post_type'   => 'cpt-references',
            'numberposts' =>  -1,
            'orderby'     => 'post_date',
            'order'       => 'DESC',
            'post_status' => 'publish',
            'tax_query'   => $_tax_query,
        );

        $posts = get_posts($args);

        $html_section_open = '
        <section class="block-references-entry-output">
            <div class="block-inner s1x-constraint s1x-padding">
                <div class="post-grid">';
        $html_section_close = '
                </div>
            </div>
        </section>';

        $html = $html_section_open;

        if( is_array($posts) && count($posts) > 0 ) {
            foreach($posts as $key => $post) {

                if($key == 4 || $key == 10 || $key == 16 || $key == 22) {
                    $html .= $html_section_close;
                    $contact_headline = get_field('block_contact_banner_baseconfig_headline', 'option');
                    $contact_image = get_field('block_contact_banner_baseconfig_image_small', 'option');
                    $html .= '
                     <section class="block-contact-banner small-height">

                        <div class="block-inner s1x-constraint s1x-padding">
                
                            <picture class="container-image">
                                ' . \WPGBAPI\Base_Theme_Support::get_imagify_webp_picture_source( $contact_image['url'] ) . '
                                <img src="' . $contact_image['url'] . '" alt="'. $contact_image['alt'] .'">
                            </picture>
                
                            <div class="container-text">
                                <div class="headline">' . $contact_headline . '</div>
                                <a href="'. get_field('block_contact_banner_baseconfig_sitelink', 'option') . '" class="s1x-button btn-white-col2-hov-col1">
                                    Kontakt
                
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                        <g data-name="Gruppe 25" transform="translate(-373 -2086)">
                                            <g data-name="Gruppe 24" transform="translate(380 2096)">
                                                <g data-name="Gruppe 26" transform="translate(0 0)">
                                                    <path data-name="Pfad 18" d="M13.466,4.3,8.747.081a.315.315,0,1,0-.421.47l4.1,3.673H2.315a.315.315,0,0,0,0,.63H12.43l-4.1,3.672A.315.315,0,0,0,8.747,9l4.719-4.222a.315.315,0,0,0,0-.47" transform="translate(0 0)" fill="#93073e" stroke="#94063e" stroke-width="0.5"/>
                                                </g>
                                            </g>
                                            <g data-name="Ellipse 17" transform="translate(373 2086)" fill="none" stroke="#94063e" stroke-width="1">
                                                <circle cx="15" cy="15" r="15" stroke="none"/>
                                                <circle cx="15" cy="15" r="14.5" fill="none"/>
                                            </g>
                                        </g>
                                    </svg>
                
                                </a>
                            </div>
                
                        </div>
                
                    </section>
                    ';
                    $html .= $html_section_open;
                }

                // get post term
                $term = get_the_terms($post->ID, 'cpt-references-category');
                if(is_array($term)) {
                    $term = $term[0]->name;
                }

                // get the industry
                $industry_id = get_field('industry', $post->ID);
                $industry = get_the_title($industry_id);

                // get post details
                $image = get_the_post_thumbnail_url( $post->ID );
                $title = get_the_title($post->ID);
                $customer_logo = get_field( 'customer_logo', $post->ID );
                $shortdescription = get_field( 'shortdescription', $post->ID );
                $permalink = get_the_permalink( $post->ID );

                $html .= '
                <div class="post-item">

                    <div class="cntnr-image">
                        <picture class="article-image">
                            <img src="' . $image . '" alt="">
                        </picture>
                        <picture class="logo">
                            <img src="' . $customer_logo['url'] . '" alt="' . $customer_logo['alt'] . '">
                        </picture>
                    </div>
                    
                    <div class="cntnr-text">
                        <div class="category">' . $term . '</div>
                        
                        <p class="industry">' . $industry . '</p>
                                            
                        <a class="title" href="' . $permalink . '">
                            <h3>' . $title . '</h3>
                        </a>

                        <p class="shortdescription">' . $shortdescription . '</p>

                        <a class="s1x-button btn-col3-hov-col1" href="' . $permalink . '">
                        Weiterlesen
                        
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                <g data-name="Gruppe 25" transform="translate(-373 -2086)">
                                    <g data-name="Gruppe 24" transform="translate(380 2096)">
                                        <g data-name="Gruppe 26" transform="translate(0 0)">
                                            <path data-name="Pfad 18" d="M13.466,4.3,8.747.081a.315.315,0,1,0-.421.47l4.1,3.673H2.315a.315.315,0,0,0,0,.63H12.43l-4.1,3.672A.315.315,0,0,0,8.747,9l4.719-4.222a.315.315,0,0,0,0-.47" transform="translate(0 0)" fill="#93073e" stroke="#94063e" stroke-width="0.5"/>
                                        </g>
                                    </g>
                                    <g data-name="Ellipse 17" transform="translate(373 2086)" fill="none" stroke="#94063e" stroke-width="1">
                                        <circle cx="15" cy="15" r="15" stroke="none"/>
                                        <circle cx="15" cy="15" r="14.5" fill="none"/>
                                    </g>
                                </g>
                            </svg>
                        
                        </a>
                    </div>



                </div>';
            }
        }

        $html .= $html_section_close;

        return $html;
    }


}