jQuery( document ).ready( function($) {

	/* === Sortable Multi-CheckBoxes === */

	/* Make it sortable. */
	$( 'ul.ampforwp-design-multicheck-sortable-list' ).sortable({
		handle: '.ampforwp-design-multicheck-sortable-handle',
		axis: 'y',
		update: function( e, ui ){
			$('input.ampforwp-design-multicheck-sortable-item').trigger( 'change' );
		}
	});

	/* On changing the value. */
	$( "input.ampforwp-design-multicheck-sortable-item" ).on( 'change', function() {

		/* Get the value, and convert to string. */
		this_checkboxes_values = $( this ).parents( 'ul.ampforwp-design-multicheck-sortable-list' ).find( 'input.ampforwp-design-multicheck-sortable-item' ).map( function() {
			var active = '0';
			if( $(this).prop("checked") ){
				var active = '1';
			}
			return this.name + ':' + active;
		}).get().join( ',' );

		/* Add the value to hidden input. */
		$( this ).parents( 'ul.ampforwp-design-multicheck-sortable-list' ).find( 'input.ampforwp-design-multicheck-sortable' ).val( this_checkboxes_values ).trigger( 'change' );

	});

	/* === Multi-CheckBoxes === */

	/* On changing the value. */
	$( "input.ampforwp-design-multicheck-item" ).on( 'change', function() {

		/* Get the value (only the "checked" item), and convert to comma separated string. */
		this_checkboxes_values = $( this ).parents( 'ul.ampforwp-design-multicheck-list' ).find( 'input.ampforwp-design-multicheck-item:checked' ).map( function() {
			return this.name;
		}).get().join( ',' );

		/* Add the value to hidden input. */
		$( this ).parents( 'ul.ampforwp-design-multicheck-list' ).find( 'input.ampforwp-design-multicheck' ).val( this_checkboxes_values ).trigger( 'change' );

	});
});