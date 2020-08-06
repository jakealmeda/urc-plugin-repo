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
 * DONATE BUTTON
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_paypal_donate_button', 'setup_paypal_donate_button_func' );
function setup_paypal_donate_button_func() {
	return '<input type="image" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" class="space-bottom-half cta-donate-paypalbutton aligncenter" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">';
}


/* --------------------------------------------------------------------------------------------
 * BUY BUTTON (Phone Coaching - 1st button)
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_paypal_sbcp', 'setup_paypal_sbcp_func' );
function setup_paypal_sbcp_func() {	
	return '<input onclick="PC_PhoneCoaching()" alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-paypal" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}


/* --------------------------------------------------------------------------------------------
 * BUY BUTTON (Phone Coaching - 2nd button)
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_paypal_sbcp_2', 'setup_paypal_sbcp_2_func' );
function setup_paypal_sbcp_2_func() {
	return '<input onclick="PC_PhoneCoaching()" alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-buy-paypalbutton aligncenter" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}

