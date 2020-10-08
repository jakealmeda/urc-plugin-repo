<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


//INITIALIZE MOBILE DETECT PLUGIN
$detect = new Mobile_Detect;
// Any mobile device (phones or tablets).
if( $detect->isMobile() ) {


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


}