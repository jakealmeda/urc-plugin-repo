(function($) {

	var CTAexpanded = setup_plug_ctas.cta_expanded,
		CTApage 	= setup_plug_ctas.cta_freeebook,
		CTApageArr  = setup_plug_ctas.cta_hidepage,
		CTALoopCounter, hideCTA;

	// ON DOCUMENT LOAD
	$( document ).ready( function() {

		// check if page exists in the array
		// determine if form is to be shown or not
		/*$.each( CTApageArr, function( index, element ){
			//alert( element );
			if( element == CTApage ) {
				var hideCTA = 2;
				return false; // break/exit loop if validated
			}
		});*/

		// SIDEBAR
		setup_check_screensize();

	});


	// ON ACTUAL RESIZING
	$( window ).resize( function() {

		// SIDEBAR
		setup_check_screensize();

	});


	// SIDEBAR
	function setup_check_screensize( hideCTA ) {

		CTALoopCounter = 0;
		if( CTALoopCounter == 0 ) {

			$.each( CTApageArr, function( index, element ){
				//alert( element );
				if( element == CTApage ) {
					hideCTA = 2;
					return false; // break/exit loop if validated
				}
			});

			// add value to avoid going to this condition again
			CTALoopCounter = 1;

		}

	    if( $(window).width() <= 767 ) {

        	//$( '.sidebar-primary' ).hide();

        	$( '#cta_compressed_target' ).hide();
        	
        	//if( CTApage != 'free-ebook' ) {
        	if( hideCTA != 2 ) {
        		$( '#cta_expander_target' ).html( CTAexpanded );
        	}

	    } else {

        	//$( '.sidebar-primary' ).show();

    		$( '#cta_compressed_target' ).show();

        	$( '#cta_expander_target' ).html( '' );

	    }

	}


})( jQuery );