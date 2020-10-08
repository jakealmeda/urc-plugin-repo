<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// DEREGISTER DEFAULT STYLESHEET
add_action( 'wp_print_styles', 'setup_dequeue_css_function', 100 ); // dequeue styles
add_action( 'wp_enqueue_scripts', 'setup_dequeue_css_function' );
function setup_dequeue_css_function() {

    setup_check_enqueued_styles( 'ea-style' );

}


// INLINE DEFAULT STYLESHEET IN HEAD
add_action( 'wp_head', 'setup_inline_styles_in_head', 1 ); // inline non-critical in wp_head


global $mobile;

//INITIALIZE MOBILE DETECT PLUGIN
$detect = new Mobile_Detect;
// Any mobile device (phones or tablets).
if( $detect->isMobile() ) {

	$mobile = 1;

	remove_action( 'genesis_header', 'genesis_do_header' );

    // FORCE LAYOUT - REMOVE SIDEBAR
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


    // LIST JS HANDLERS AND DEQUEUE THEM
    add_action( 'wp_print_scripts', 'wsds_detect_enqueued_scripts' );
    add_action( 'wp_footer', 'wsds_detect_enqueued_scripts' );
	function wsds_detect_enqueued_scripts() {

		global $wp_scripts;
		
		foreach( $wp_scripts->queue as $handle ) :
			//echo $handle . ' | ';
			setup_check_enqueued_javascript( $handle );
		endforeach;

	}


	// JS HEAD
	add_action( 'wp_head', 'setup_mobile_js_inline_head', 1000 );
	function setup_mobile_js_inline_head() {
		
		$js_array = array(
			includes_url().'/js/jquery/jquery.js',
			includes_url().'/js/jquery/ui/core.min.js',
			includes_url().'/js/jquery/ui/effect.min.js',
			includes_url().'/js/jquery/ui/effect-slide.min.js',
			includes_url().'/js/jquery/ui/effect-fade.min.js',
			includes_url().'/js/jquery/ui/widget.min.js',
			includes_url().'/js/jquery/ui/accordion.min.js',
		);

		if( count( $js_array ) ) {
			setup_echo_javascripts( $js_array );
		}

	}


	// JS FOOTER
	add_action( 'wp_footer', 'setup_mobile_js_inline_footer', 1000 );
	function setup_mobile_js_inline_footer() {
		
		$js_array = array(
			/*
			plugins_url().'/wp-smush-pro/app/assets/js/smush-lazy-load.min.js',*/
			plugins_url().'/megamenu/js/maxmegamenu.js',
		);

		if( count( $js_array ) ) {
			setup_echo_javascripts( $js_array );
		}

	}


	// ECHO JS SCRIPTS
	function setup_echo_javascripts( $js_array ) {

		?><script><?php

			foreach( $js_array as $js ) {

				$o = file_get_contents( $js );
				if( !empty( $o ) ) {
					echo $o;
				}

			}

		?></script><?php

	}


} else {

	// viewer is using desktop
	$mobile = 0;
}


// HEAD | INLINE STYLES
function setup_inline_styles_in_head() {

	global $mobile;

    ?><style><?php

    /*if( $mobile ) {

        // MOBILE STYLESHEET
        $mobile_styling = get_stylesheet_directory_uri().'/assets/css/mobile-min.css';
        if( $mobile_styling ) {
        	$main_css = file_get_contents( $mobile_styling );
        }

    } else {*/

        // MAIN STYLESHEET | NO NEED TO VALIDATE IF FILE EXISTS
        $main_css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/main-min.css' );

    //}

    if( !empty( $main_css ) ) {
        $look_for = '/images/';
        $replace_with = get_stylesheet_directory_uri().'/assets'.$look_for;
        echo str_replace( '..'.$look_for, $replace_with, $main_css );
    }

    // MAILCHIMP
    /*$mailchimp_css = file_get_contents( 'https://cdn-images.mailchimp.com/embedcode/classic-10_7.css' );
    if( !empty( $mailchimp_css ) ) {
        echo setup_minify_css( $mailchimp_css );
    }*/

    // DASHICONS
    $dashicons_css = file_get_contents( includes_url().'/css/dashicons.min.css' );
    if( !empty( $dashicons_css ) ) {
        echo $dashicons_css;
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