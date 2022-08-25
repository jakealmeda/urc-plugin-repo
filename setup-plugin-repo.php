<?php
/**
 * Plugin Name: URC Plugin Repository
 * Description: Full control over URC plugins
 * Version: 2.0.2
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
//require_once( 'urc-subscribe-mobileless.php' );
require_once( 'codes/setup-homepage-category-permalinks.php' );
require_once( 'codes/setup_su_post_get.php' );
require_once( 'codes/setup-paypal-buttons.php' );
require_once( 'codes/spk_get_permalink.php' );


/* --------------------------------------------------------------------------------------------
 * Signature Shortcode
 * --------------
 * THIS SHORTCODE SIMPLY RETURNS THE CURRENT SITE ADDRESS
 * BEST USED FOR IMAGES STORED IN THE SERVER WHICH CAN'T BE ACCESSED WITHIN WORDPRESS
 * ----------------------------------------------------------------------------------------- */
if( !shortcode_exists( 'spk_site_url' ) ) {

	add_shortcode( 'spk_site_url', 'setup_return_site_url' );
	
	if( !function_exists( 'setup_return_site_url' ) ) {

		function setup_return_site_url() {
			return site_url();
		}
		
	}

}


/* --------------------------------------------------------------------------------------------
 * | ENQUEUE SCRIPTS
 * ----------------------------------------------------------------------------------------- */
add_action( 'wp_footer', 'setup_plugin_repository_function', 4 );
function setup_plugin_repository_function() {

	$scripts = array( 'jquery-ui-accordion' );
	foreach ( $scripts as $value ) {
		if( !wp_script_is( $value, 'enqueued' ) ) {
        	wp_enqueue_script( $value );
    	}
	}

    // ACCORDION
    wp_register_script( 'setup_plugin_repo_accordion', plugins_url( 'js/asset.js', __FILE__ ), NULL, '1.0', TRUE );
    wp_enqueue_script( 'setup_plugin_repo_accordion' );
    //wp_enqueue_script( 'setup_plugin_repo_accordion', plugins_url( 'js/asset.js', __FILE__ ) );

}


/* --------------------------------------------------------------------------------------------
 * | Execute shortcodes in widget
 * ----------------------------------------------------------------------------------------- */
add_filter( 'widget_text', 'do_shortcode' );


/* --------------------------------------------------------------------------------------------
 * | Get main WP plugins directory
 * ----------------------------------------------------------------------------------------- */
function setup_return_plugins_maindir() {
	//return plugin_dir_path( __DIR__ );
	return WP_PLUGIN_DIR;
}