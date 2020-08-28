<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// PAYPAL BUTTONS

/* --------------------------------------------------------------------------------------------
 * Sidebar Coaching Phone 191115
 * Link: https://cor.smarterwebpackage.com/wp-admin/post.php?post=37707&action=edit
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_paypal_sbcp_191115', 'setup_paypal_sbcp_191115_func' );
function setup_paypal_sbcp_191115_func() {
	return '<input onclick="PC_PhoneCoaching()" type="submit" alt="PayPal - The safer, easier way to pay online!" name="submit" value="Buy Now on Paypal" class="button fontsize-tiny space-bottom-half" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png">';
}

add_shortcode( 'setup_paypal_sbcp_191115_2', 'setup_paypal_sbcp_191115_2_func' );
function setup_paypal_sbcp_191115_2_func() {
	return '<input onclick="PC_PhoneCoaching()" alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-paypal" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}

add_shortcode( 'setup_paypal_sbcp_191115_3', 'setup_paypal_sbcp_191115_3_func' );
function setup_paypal_sbcp_191115_3_func() {
	return '<input onclick="PC_PhoneCoaching()" alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-buy-paypalbutton aligncenter" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}


/* --------------------------------------------------------------------------------------------
 * Donate
 * Link: https://cor.smarterwebpackage.com/wp-admin/post.php?post=26341&action=edit
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_sb_donate', 'setup_sb_donate_func' );
function setup_sb_donate_func() {
	return '<input type="image" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" class="space-bottom-half cta-donate-paypalbutton aligncenter" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">';
}


/* --------------------------------------------------------------------------------------------
 * Product PhoneCoaching CTA
 * Link: https://cor.smarterwebpackage.com/wp-admin/post.php?post=22708&action=edit
 * ----------------------------------------------------------------------------------------- */
add_shortcode( 'setup_product_phonecoaching_cta', 'setup_product_phonecoaching_cta_func' );
function setup_product_phonecoaching_cta_func() {
	return '<input type="submit" alt="PayPal - The safer, easier way to pay online!" name="submit" value="Buy Now on Paypal" class="button fontsize-tiny space-bottom-half" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png">';
}

add_shortcode( 'setup_product_phonecoaching_cta_2', 'setup_product_phonecoaching_cta_2_func' );
function setup_product_phonecoaching_cta_2_func() {
	return '<input alt="PayPal - The safer, easier way to pay online!" name="submit" class="space-bottom-half cta-paypal" src="'.get_stylesheet_directory_uri().'/assets/images/pixel.png" type="image">';
}

