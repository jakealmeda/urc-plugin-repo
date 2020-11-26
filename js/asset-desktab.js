(function($) {

	var CTAexpanded = setup_plug_ctas.cta_expanded;

	// ON DOCUMENT LOAD
	$( document ).ready( function() {

		// SIDEBAR
		setup_check_screensize();

	});


	// ON ACTUAL RESIZING
	$( window ).resize( function() {

		// SIDEBAR
		setup_check_screensize();

	});


	// SIDEBAR
	function setup_check_screensize() {

	    if( $(window).width() <= 767 ) {

        	$( '.sidebar-primary' ).hide();

        	$( '#cta_compressed_target' ).hide();

        	$( '#cta_expander_target' ).html( CTAexpanded );

	    } else {

        	$( '.sidebar-primary' ).show();

    		$( '#cta_compressed_target' ).show();

        	$( '#cta_expander_target' ).html( '' );

	    }

	}


})( jQuery );