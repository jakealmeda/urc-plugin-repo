<?php
/**
 * Plugin Name: Setup Plugin Repository
 * Description: Full control over URC plugins
 * Version: 1.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/* ----------------------------------------------------------------------------
 * INCLUDE OTHER PLUGIN FILES
 * ------------------------------------------------------------------------- */
//require_once( 'mobile-detect/Mobile_Detect.php' );
require_once( 'codes/setup-homepage-category-permalinks.php' );
require_once( 'codes/setup-optimize.php' );
require_once( 'codes/setup_su_post_get.php' );
//require_once( 'codes/setup-mobile-front.php' );
require_once( 'codes/setup-paypal-buttons.php' );
require_once( 'codes/spk_get_permalink.php' );


/* ----------------------------------------------------------------------------
 * OPTIMIZE FILE - ELIMINATE RENDER-BLOCKING RESOURCES
 * ------------------------------------------------------------------------- */
require_once( 'codes/setup-purge.php' );


/* --------------------------------------------------------------------------------------------
 * Signature Shortcode
 * --------------
 * THIS SHORTCODE SIMPLY RETURNS THE CURRENT SITE ADDRESS
 * BEST USED FOR IMAGES STORED IN THE SERVER WHICH CAN'T BE ACCESSED WITHIN WORDPRESS
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'spk_site_url', 'setup_return_site_url' );
function setup_return_site_url() {
	return site_url();
}


/* --------------------------------------------------------------------------------------------
 * | ENQUEUE SCRIPTS
 * ----------------------------------------------------------------------------------------- */
add_action( 'wp_footer', 'setup_plugin_repository_function', 2 );
function setup_plugin_repository_function() {

	$scripts = array( 'jquery-ui-accordion' );
	foreach ( $scripts as $value ) {
		if( !wp_script_is( $value, 'enqueued' ) ) {
        	wp_enqueue_script( $value );
    	}
	}

    // ACCORDION
    wp_enqueue_script( 'setup_plugin_repo_accordion', plugins_url( 'js/asset_accordion.js', __FILE__ ) );

}