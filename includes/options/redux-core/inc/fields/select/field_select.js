/*global redux_change, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.select = redux.field_objects.select || {};

    redux.field_objects.select.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( '.redux-container-select:visible' );
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
                
                el.find( 'select.redux-select-item' ).each(
                    function() {

                        var default_params = {
                            width: 'resolve',
                            triggerChange: true,
                            allowClear: true
                        };
                        if ( $(this).attr('multiple') == "multiple" ) {
                            default_params.width = "100%";
                        }

                        if ( $( this ).siblings( '.select2_params' ).size() > 0 ) {
                            var select2_params = $( this ).siblings( '.select2_params' ).val();
                            select2_params = JSON.parse( select2_params );
                            default_params = $.extend( {}, default_params, select2_params );
                        }

                        if ( $( this ).hasClass( 'font-icons' ) ) {
                            default_params = $.extend(
                                {}, {
                                    formatResult: redux.field_objects.select.addIcon,
                                    formatSelection: redux.field_objects.select.addIcon,
                                    escapeMarkup: function( m ) {
                                        return m;
                                    }
                                }, default_params
                            );
                        }

                        $( this ).select2( default_params );

                        if ( $( this ).hasClass( 'select2-sortable' ) ) {
                            default_params = {};
                            default_params.bindOrder = 'sortableStop';
                            default_params.sortableOptions = {placeholder: 'ui-state-highlight'};
                            $( this ).select2Sortable( default_params );
                        }

                       /* $( this ).on(
                            "change", function() {
                                redux_change( $( $( this ) ) );
                                $( this ).select2SortableOrder();
                            }
                        );*/
                    }
                );

                el.find( 'select.redux-select-item-ajax' ).each(function(){
                    // multiple select with AJAX search
                    var action = $( this ).attr('data-action');
                    if ( $( this ).siblings( '.select2_params' ).size() > 0 ) {
                            var select2_params = $( this ).siblings( '.select2_params' ).val();
                            select2_params = JSON.parse( select2_params );
                            default_params = $.extend( {}, default_params, select2_params );
                        }
                    $( this ).select2({
                        allowClear: true,
                        triggerChange: true,
                        ajax: {
                            url: ajaxurl, // AJAX URL is predefined in WordPress admin
                            dataType: 'json',
                            delay: 250, // delay in ms while typing when to perform a AJAX search
                            data: function (params) {
                                return {
                                    q: params.term, // search query
                                    action: action, // AJAX action for admin-ajax.php
                                    security: ampforwp_nonce
                                };
                            },
                            processResults: function( data ) {
                            var options = [];
                            if ( data ) {
             
                                // data is the array of arrays, and each of them contains ID and the Label of the option
                                $.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
                                    options.push( { id: text[0], text: text[1]  } );
                                });
             
                            }
                            return {
                                results: options
                            };
                            },
                            cache: true
                        },
                        formatResult: function(data) {
                            return data.title;
                          },
                          formatSelection: function(data) {
                            return data.title;
                          },
                        matcher: function(term, text) { return text.toUpperCase().indexOf(term.toUpperCase())>=0; },
                        sorter: function(data) {
                            /* Sort data using lowercase comparison */
                            return data.sort(function (a, b) {
                                a = a.text.toLowerCase();
                                b = b.text.toLowerCase();
                                if (a > b) {
                                    return 1;
                                } else if (a < b) {
                                    return -1;
                                }
                                return 0;
                            });
                        },
                        minimumInputLength: 2 // the minimum of symbols to input before perform a search
                    });

                    $(this).parent('fieldset').find('.select2-container--default').css('width','100%');
                    $(this).parent('fieldset').find('.select2-search__field').css('width','100%');
                 });
            }
        );
    };

    redux.field_objects.select.addIcon = function( icon ) {
        if ( icon.hasOwnProperty( 'id' ) ) {
            return "<span class='elusive'><i class='" + icon.id + "'></i>" + "&nbsp;&nbsp;" + icon.text + "</span>";
        }
    };
})( jQuery );