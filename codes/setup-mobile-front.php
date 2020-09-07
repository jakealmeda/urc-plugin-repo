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
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

}