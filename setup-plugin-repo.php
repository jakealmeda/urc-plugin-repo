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
/*$these_files = array( 'setup-homepage-category-permalinks', );
if( is_array( $these_files ) ) {

	foreach( $these_files as $val ) {

		$the_file = plugin_dir_path( __FILE__ ).'codec/'.$val.'.php';
		echo '<h2>'.$the_file.'</h2>';
		if( file_exists( $the_file ) ) {
			require_once( $the_file );
		} else {
			echo '<h1>ZZZZ!</h1>';
		}

	}

}*/
require_once( 'codes/setup-homepage-category-permalinks.php' );

/* ----------------------------------------------------------------------------
 * ELIMINATE RENDER-BLOCKING RESOURCES
 * ------------------------------------------------------------------------- */



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

