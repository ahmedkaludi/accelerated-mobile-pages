/*global redux_change, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.repeater = redux.field_objects.repeater || {};

    $( document ).ready(
        function() {
            //redux.field_objects.repeater.init();
        }
    );

    redux.field_objects.repeater.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-repeater:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }
                el.find( '.redux-repeater-remove' ).on(
                    'click', function() {
                        redux_change( $( this ) );
                        $( this ).prev( 'input[type="text"]' ).val( '' );
                        $( this ).parent().parent().slideUp(
                            'medium', function() {
                                $( this ).remove();
                                var len = $('.redux-repeater-remove').length;
                                if(len==1){
                                    $('.redux-repeater-remove').css({'display':'none'});
                                }
                            }
                        );
                    }
                );

                el.find( '.redux-repeater-add' ).click(
                    function() {
                        var number = parseInt( $( this ).attr( 'data-add_number' ) );
                        var id = $( this ).attr( 'data-id' );
                        var name = $( this ).attr( 'data-name' );
                        for ( var i = 0; i < number; i++ ) {
                            var new_input = $( '#' + id + ' li:last-child' ).clone();
                            el.find( '#' + id ).append( new_input );
                            el.find( '#' + id + ' li:last-child' ).removeAttr( 'style' );
                            el.find( '#' + id + ' li:last-child input[type="text"]' ).val('Enter URL Here');
                            $('.redux-repeater-remove').removeAttr('style');
                        }
                    }
                );
            }
        );
    };
})( jQuery );