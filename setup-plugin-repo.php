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
require_once( 'codes/setup-homepage-category-permalinks.php' );
require_once( 'codes/setup-optimize.php' );
require_once( 'codes/setup_su_post_get.php' );

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


/* --------------------------------------------------------------------------------------------
 * THIS SHORTCODE SIMPLY RETURNS CURRENT THEME'S (CHILD) URL
 * MAINLY USED FOR THE PIXEL.PNG FOUND IN PAYPAL BUTTONS
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup-current-theme-url', 'setup_current_theme_url' );
function setup_current_theme_url() {
	return get_stylesheet_directory_uri().'/';
}