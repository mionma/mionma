<?php
/**
 * wpgbapi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpgbapi
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '' );
}

if ( ! defined( '_THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_THEME_VERSION', '1.0.7' );
}

if ( ! defined( '_THEME_PATH' ) ) {
    define( '_THEME_PATH', __DIR__ );
}

if ( ! defined( '_THEME_URI' ) ) {
    define( '_THEME_URI', get_template_directory_uri() );
}



require "vendor/autoload.php";

use WPGBAPI\Base_Theme_Support;
use WPGBAPI\Base_Static_Files;
use WPGBAPI\Base_Menus;
use WPGBAPI\ACF;
use WPGBAPI\CPT_Services;
use WPGBAPI\CPT_FAQ;
use WPGBAPI\CPT_References;

class Theme_Init {
    public function __construct() {
        new Base_Theme_Support();
        new Base_Static_Files();
        new Base_Menus();
        new ACF();
        new CPT_Services();
        new CPT_FAQ();
        new CPT_References();
    }
}

new Theme_Init();



/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';



/*
 * Disable Gutenberg Block Builder iframe lazyload behaviour for e.g. vimeo embeds
*/

function disable_post_content_iframe_lazy_loading( $default, $tag_name, $context ) {
    if ( 'iframe' === $tag_name && 'the_content' === $context ) {
        return false;
    }
    return $default;
}
add_filter( 'wp_lazy_loading_enabled', 'disable_post_content_iframe_lazy_loading', 10, 3);


/*
 * filter for separation of block scripts
 * must have for clean block development
*/

add_filter( 'should_load_separate_core_block_assets', '__return_true' );


/*
* Start of disabling Search Functionality, in case the request blocker is not active
*/

function wpgbapi_filter_query($query)
{
    if (is_search()) {
        $query->is_search = false;
        $query->query_vars['s'] = false;
        $query->query['s'] = false;
    }
}
add_action('parse_query', 'wpgbapi_filter_query', 1, 1);

add_filter('get_search_form', function ($a) {
    return '';
});

function wpgbapi_remove_search_widget()
{
    unregister_widget('WP_Widget_Search');
}
add_action('widgets_init', 'wpgbapi_remove_search_widget');

/*
* End of disabling Search Functionality
*/



/** Disable the scrolling effect on field validation errors
 *
 *  @link   https://wpforms.com/developers/how-to-disable-the-scrolling-effect-on-field-validation/
 */

function wpf_dev_disable_scroll_to_error() {

    // If scrollToError is disabled for at least one form on the page, it will be disabled for all the forms on the page.
    ?>

    <script type="text/javascript">wpforms.scrollToError = function(){};</script>

    <?php
}
add_action( 'wpforms_wp_footer_end', 'wpf_dev_disable_scroll_to_error', 10 );




/**
 * Register the Smart Tag so it will be available to select in the form builder.
 *
 * @link   https://wpforms.com/developers/how-to-create-a-custom-smart-tag/
 */

function wpf_dev_register_smarttag( $tags ) {

    // Key is the tag, item is the tag name.
    $tags[ 'interest_nachfolge' ] = 'Interest Nachfolge';
    $tags[ 'interest_verkauf' ] = 'Interest Verkauf';
    $tags[ 'interest_bewertung' ] = 'Interest Bewertung';

    return $tags;
}
add_filter( 'wpforms_smart_tags', 'wpf_dev_register_smarttag', 10, 1 );





