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


/* --------------------------------------------------------------------------------------------
 * for this page: https://cor.smarterwebpackage.com/wp-admin/post.php?post=26337&action=edit
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_paypal_coachingphone', 'setup_paypal_coachingphone_func' );
function setup_paypal_coachingphone_func() {
	return '<input alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-paypal" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}
add_shortcode( 'setup_paypal_coachingphone_2', 'setup_paypal_coachingphone_func_2' );
function setup_paypal_coachingphone_func_2() {
	return '<input alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-buy-paypalbutton aligncenter" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}

/* --------------------------------------------------------------------------------------------
 * for this page: https://cor.smarterwebpackage.com/wp-admin/post.php?post=22708&action=edit
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_paypal_product_phonecoaching_cta', 'setup_paypal_product_phonecoaching_cta_func' );
function setup_paypal_product_phonecoaching_cta_func() {
	return '<input type="submit" alt="PayPal - The safer, easier way to pay online!" name="submit" value="Buy Now on Paypal" class="button fontsize-tiny space-bottom-half" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png">';
}

