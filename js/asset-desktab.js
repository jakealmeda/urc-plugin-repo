(function($) {

	//var CTAexpanded 		= setup_plug_ctas.cta_expanded;
	var	CTApage 			= setup_plug_ctas.cta_freeebook,
		CTApageArr  		= setup_plug_ctas.cta_hidepage,
		CTAfreeEbookIcons	= setup_plug_ctas.cta_fbicons,
		CTALoopCounter, hideCTA, ScreenSizer;

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

		ScreenSizer = $(window).width();

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
		
	    if( ScreenSizer < 768 ) {

        	if( CTApage != 'free-ebook' ) {
        		// Not Free eBook

	        	$( '#cta_compressed_target' ).hide();
	        	
	        	//if( CTApage != 'free-ebook' ) {
	        	/*if( hideCTA != 2 ) {
	        		//$( '#cta_expander_target' ).html( CTAfreeEbookIcons );
	        		$( '#cta_expander_target' ).html( CTAexpanded );
	        	} else {
	        		$( '#cta_expander_target' ).html();
	        	}*/

	        }/* else {
	        //if( CTApage == 'free-ebook' ) {
	        	// Free-eBook page
        		$( '#cta_expander_target' ).html( CTAexpanded );

	        }*/

	        desktab_show_hide( 'hide' );

	    } else {

        	//$( '.sidebar-primary' ).show();

    		//$( '#cta_compressed_target' ).show();

    		if( CTApage == 'free-ebook' ) {
    			$( '#cta_expander_target' ).html( CTAfreeEbookIcons );
    		} else {
        		$( '#cta_expander_target' ).html( '' );
        	}

        	desktab_show_hide( 'show' );

	    }

	}

	function desktab_show_hide( ShowHide ) {

		if( ShowHide == 'hide' ) {

			// check first if element is visible
			if( $( '.sidebar-primary' ).is(":visible") ) {
				// hide
				$( '.sidebar-primary' ).hide();
			}

		} else {

			if( $( '.sidebar-primary' ).is(":hidden") ) {
				// hide
				$( '.sidebar-primary' ).show();
			}

		}

	}

})( jQuery );
