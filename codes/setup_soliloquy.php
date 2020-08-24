<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_shortcode( 'setup_soliloquy_sc', 'setup_soliloquy_sc_function' );
function setup_soliloquy_sc_function() {

	echo setup_minify_javascript( '<script type="text/javascript">
		jQuery( document ).ready( function() {

			var counter = 5; // in seconds
			setInterval( function() {

			    counter--;

			    // Display counter wherever you want to display it.
			    if( counter === 0 ) {
			    	
			    	// load google ad JS
			    	alert( "will this work?" );

			    }

			}, 1000);
			
		});
	</script>' );

}