( function( $ ) {
	'use strict';

  // Nav bar text color.
	wp.customize( 'amp_customizer[header_color]', function( value ) {
		value.bind( function( to ) {
			console.log(to);
		} );
	} );
  
  // Nav bar text color.
  wp.customize( 'amp_customizer[header_color_2]', function( value ) {
    value.bind( function( to ) {
      console.log(to);
    } );
  } );
  
 
 
} )( jQuery );
