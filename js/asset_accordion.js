
/* --------------------------------------------------------------------------------------------
 * | ACCORDION
 * ----------------------------------------------------------------------------------------- */
jQuery("div#accordion").each( function( index, value ) {
    jQuery( this ).accordion({
        collapsible: true,
        heightStyle: "content"
    });
});