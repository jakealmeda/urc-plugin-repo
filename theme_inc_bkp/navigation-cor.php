<?php
/**
 * Navigation
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/
/*
// Don't let Genesis load menus
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

add_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'genesis_do_subnav' );
*/

// PLUGIN TO CHECK
$targ_file = 'urc-plugin-repo/setup-plugin-repo.php';
// CHECK IF ACTIVE
if( in_array( $targ_file, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){ 

	//plugin is activated

	$mobile_d_file = WP_PLUGIN_DIR.'/urc-plugin-repo/mobile-detect/Mobile_Detect.php';

	if( $mobile_d_file ) {

		// file found, include it
		require_once( $mobile_d_file );

		//INITIALIZE MOBILE DETECT PLUGIN
		$detect = new Mobile_Detect;
		// Any mobile device (phones or tablets).
		//if( $detect->isMobile() ) {
		if( $detect->isTablet()	|| !$detect->isMobile() ) {

			// tablet or not mobile (desktop)

		} else {
			
			// mobile

			remove_action( 'genesis_after_header', 'genesis_do_nav' );
			remove_action( 'genesis_after_header', 'genesis_do_subnav' );

		}

	}

}

/*
WP_PLUGIN_URL
WP_PLUGIN_DIR
*/