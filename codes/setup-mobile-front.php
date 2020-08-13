<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// this will show only if the device is mobile
// the required code is found on this plugin's main file
$detect = new Mobile_Detect;
// Any mobile device (phones or tablets).
if( $detect->isMobile() ) {

    // show a div to push more contents away from critical view
    //add_action( 'genesis_before_content_sidebar_wrap', 'setup_show_in_mobile' ); 

    // transfer style from header to footer
    add_action( 'wp_print_styles', 'setup_remove_default_css_function'); // dequeue styles
    add_action( 'wp_print_scripts', 'setup_remove_js_function' ); // dequeue javascript
    add_action( 'wp_head', 'setup_inline_critical_styles_function' ); // inline critical in wp_head
    add_action( 'wp_footer', 'setup_inline_non_critical_styles_function', 100 ); // inline non-critical in wp_footer

}


// DISPLAY A DIV
function setup_show_in_mobile() {

    echo do_shortcode( '[display-posts post_type="post" posts_per_page="1" layout="ss_use_img_as_bkgrnd"]' );

}


// DEREGISTER SCRIPTS/STYLES FROM THE FOOTER
function setup_remove_default_css_function() {

    // DEQUEUE MAIN THEME FILE
    wp_dequeue_style( 'ea-style' );
    wp_deregister_style( 'ea-style' );


    // MEGA MENU | CSS
    // second argument is by default set to 'enqueued'
    $mega_menu = 'megamenu';
    if( wp_style_is( $mega_menu, 'enqueued' ) ) {

        wp_dequeue_style( $mega_menu );
        wp_deregister_style( $mega_menu );

        add_action( 'wp_head', 'setup_move_megamax_styles_function', 101 ); // inline non-critical in wp_footer
        
    }

}


function setup_remove_js_function() {

    // MEGA MENU | JS
    $max_mega_menu = 'maxmegamenu';

    if( wp_script_is( $max_mega_menu, 'enqueued' ) ) {

        wp_dequeue_script( $max_mega_menu );
        wp_deregister_script( $max_mega_menu );

    }

}


// INLINE CRITICAL STYLES IN WP_HEAD
function setup_inline_critical_styles_function() {
    
    //$looook = file_get_contents( plugin_dir_url( __DIR__ ).'css/style_critical_min.css' );
    //$look_for = '/images/siteheader2x.jpg';
    //$replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;

    ?><style><?php
        echo setup_replace_with_stylesheet_dir_uri( file_get_contents( plugin_dir_url( __DIR__ ).'css/style_critical_min.css' ) );
    ?></style><?php

}


// INLINE NON-CRITICAL STYLES IN WP_FOOTER
function setup_inline_non_critical_styles_function() {

    ?><style><?php
        //echo file_get_contents( plugin_dir_url( __DIR__ ).'css/main_min.css' );
        echo setup_replace_with_stylesheet_dir_uri( file_get_contents( plugin_dir_url( __DIR__ ).'css/main_min.css' ) );
    ?></style><?php

}


// REPLACE IMAGES DIRECTORY WITH A COMPLETE VERSION
function setup_replace_with_stylesheet_dir_uri( $look_from ) {

    $look_for = '/images/siteheader2x.jpg';
    $replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;

    return str_replace( '..'.$look_for, $replace_with, $look_from );

}


// INLINE MAGEMAX STYLES IN WP_HEAD (THIS HANDLES THE MENU)
function setup_move_megamax_styles_function() {
    
    ?><style><?php
        echo file_get_contents( 'https://staging-corsite.kinsta.cloud/wp-content/uploads/maxmegamenu/style.css' );
    ?></style><?php

}

