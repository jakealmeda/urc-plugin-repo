(function($) {
	
	/* --------------------------------------------------------------------------------------------
	 * | ACCORDION
	 * ----------------------------------------------------------------------------------------- */
	$("div#accordion").each( function( index, value ) {
	    $( this ).accordion({
	        collapsible: true,
	        heightStyle: "content"
	    });
	});

})( jQuery );