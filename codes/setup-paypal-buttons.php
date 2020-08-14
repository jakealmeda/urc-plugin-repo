<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// PAYPAL BUTTONS


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