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

// plugin_dir_path( __DIR__ )
// plugins_url()
//$mobile_d_file = plugins_url().'/urc-plugin-repo/mobile-detect/Mobile_Detect.php';
$mobile_d_file = '/var/www/staging.understandingrelationships.com/www/wp-content/plugins/urc-plugin-repo/mobile-detect/Mobile_Detect.php';

if( file_exists( $mobile_d_file ) ) {

	// file found, include it
	require_once( $mobile_d_file );

	//INITIALIZE MOBILE DETECT PLUGIN
	$detects = new Mobile_Detect;
	// Any mobile device (phones or tablets).
	if( $detects->isMobile() ) {
		
		remove_action( 'genesis_after_header', 'genesis_do_nav' );
		remove_action( 'genesis_after_header', 'genesis_do_subnav' );

	}/* else {
		echo 'MYTZ - DESKTOP';
	}*/

}/* else {
	echo 'NOT A FILE';
}*/