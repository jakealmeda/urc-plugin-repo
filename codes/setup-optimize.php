<?php

/* ----------------------------------------------------------------------------
 * OPTIMIZE
 * ------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// remove Gutenberg CSS from public pages
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );
function remove_block_css() {

	wp_dequeue_style( 'wp-block-library' ); // WordPress core
	wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
	//wp_dequeue_style( 'wc-block-style' ); // WooCommerce
	//wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme

}// ALTHOUGH YOU MIGHT WANT TO INLINE THE CONTENT IN THE FOOTER

/*
function mytheme_move_jquery_to_footer() {
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}
add_action( 'wp_enqueue_scripts', 'mytheme_move_jquery_to_footer' );
*/