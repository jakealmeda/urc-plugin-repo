<?php

/* ----------------------------------------------------------------------------
 * OPTIMIZE
 * ------------------------------------------------------------------------- */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


add_action( 'wp_print_styles', 'setup_dequeue_css_function', 100 ); // dequeue styles
add_action( 'wp_enqueue_scripts', 'setup_dequeue_css_function' );
add_action( 'wp_head', 'setup_inline_styles_in_head', 1 ); // inline non-critical in wp_head


// DEREGISTER STYLES
function setup_dequeue_css_function() {

    setup_check_enqueued_styles( 'ea-style' );

}


// HEAD | INLINE STYLES
function setup_inline_styles_in_head() {

    ?><style><?php

    // MAIN THEME'S STYLES
    $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/main-min.css' );
    if( !empty( $main_css ) ) {
        $look_for = '/images/';
        $replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;
        echo str_replace( '..'.$look_for, $replace_with, $main_css );
    }

    ?></style><?php

}


// VALIDATE ENQUEUED STYLE
function setup_check_enqueued_styles( $identifier ) {

    if( wp_style_is( $identifier, 'enqueued' ) ) {

        setup_dequeue_styles( $identifier );

    }

}


// VALIDATE ENQUEUED JAVASCRIPT
function setup_check_enqueued_javascript( $identifier ) {
    
    if( wp_script_is( $identifier, 'enqueued' ) ) {

        setup_dequeue_scripts( $identifier );

    }

}


// FUNCTION TO DEQUEUE STYLE
function setup_dequeue_styles( $identifier ) {

    wp_dequeue_style( $identifier );
    wp_deregister_style( $identifier );

    return TRUE;

}


// FUNCTION TO DEQUEUE SCRIPT
function setup_dequeue_scripts( $identifier ) {

    wp_dequeue_script( $identifier );
    wp_deregister_script( $identifier );

    return TRUE;

}