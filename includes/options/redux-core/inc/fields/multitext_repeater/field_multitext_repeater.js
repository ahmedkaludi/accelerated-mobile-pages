/*global redux_change, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.multitext_repeater = redux.field_objects.multitext_repeater || {};

    $( document ).ready(
        function() {
            //redux.field_objects.repeater.init();
        }
    );

    redux.field_objects.multitext_repeater.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-multitext_repeater:visible' );
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
                el.find( '.redux-multitext_repeater-remove' ).on(
                    'click', function() {
                        redux_change( $( this ) );
                        $( this ).prev( 'input[type="text"]' ).val( '' );
                        $( this ).parent().parent().slideUp(
                            'medium', function() {
                                $( this ).remove();
                                var len = $('.redux-multitext_repeater-remove').length;
                                if(len==1){
                                    $('.redux-multitext_repeater-remove').css({'display':'none'});
                                }
                            }
                        );
                    }
                );

           
                var countkeylen = 1;
                el.find( '.redux-multitext_show_hide' ).click(
                    function() {
                      $('#select_goals').removeClass( "hide" );
                      }
                    );


          $(document).on('click', '.form_select_opt', function (e) {
               var sd = e.target.parentNode;
            
              $(e.target.parentNode.parentNode).find('.form_select_opt' ).val(e.target.value);
              var sdsid = 'amp-conversion-goals-amp-goal-form-type';
                  if(e.target.value == 'select'){
                              
                  $(e.target.parentNode.parentNode).find(".form_sel_div").addClass( "hide" );
                                }
                  if(e.target.value == 'all_form_submission'){
                      $(e.target.parentNode.parentNode).find(".form_sel_div").removeClass( "hide" );
                     $(e.target.parentNode.parentNode).find(".main_id_class").addClass( "hide" );

                  }
                  if(e.target.value == 'specific_form_submission'){
                     $(e.target.parentNode.parentNode).find(".form_sel_div").removeClass( "hide" );
                  }
           });



                el.find( '.redux-multitext_repeater-add' ).click(
                    function() {
                        var number = parseInt( $( this ).attr( 'data-add_number' ) );
                        var id = $( this ).attr( 'data-id' );
                        var name = $( this ).attr( 'data-name' );
                        var selectval = $('#form_opt').val();
                        
                        $('#select_goals').addClass( "hide" );

                        for ( var i = 0; i < number; i++ ) {
                            var new_input = $( '#' + id + ' li:last-child' ).clone();
                            var select,selectid,goal_title,form_Select,hide;
                              hide = form_Select = goal_title = selectid = select = '';
                              var docs_link = '#';
                                if(selectval == 'form_submission'){
                             select = 'selected';
                              selectid = 'Form ID';
                              goal_title = 'Form Submission';
                              form_Select = '<div class="main_form_select"><span>Form Submission Tracking Type</span><select id="amp-conversion-goals-amp-goal-form-type" name="redux_builder_amp[amp-conversion-goals][amp-goal-form-type][select][]" class="indi_option form_select_opt" value=""><option value="select" selected>Select</option><option value="all_form_submission">All Forms</option><option value="specific_form_submission">Specific Forms</option></select></div>';
                              hide = "hide";
                              docs_link = 'https://ampforwp.com/tutorials/article/how-to-add-ga-form-submission-tracking-in-amp/';
                             }else{
                            form_Select = '<div class="main_form_select hide"><span>Form Submission Tracking Type</span><select id="amp-conversion-goals-amp-goal-form-type" name="redux_builder_amp[amp-conversion-goals][amp-goal-form-type][select][]" class="indi_option form_select_opt" value=""><option value="select" selected>Select</option><option value="all_form_submission">All Forms</option><option value="specific_form_submission">Specific Forms</option></select></div>';
                             select = 'selected';
                             selectid = 'Link ID';
                             goal_title = 'Link Tracking';
                             docs_link = 'https://ampforwp.com/tutorials/article/how-to-add-ga-link-tracking-in-amp/';
                             }
                             new_input = '<li><span class="tool_tip afw-tooltip"><i class="el el-question-sign "></i><span class="afw-help-subtitle"><a href="'+docs_link+'" target="_blank">Click Here</a> for more details on '+goal_title+'</span></span><div class="element-fields multitext_repeater-fields  "><span class="goals-count">Goals #1 '+goal_title+'</span><select style="display:none;" id="amp-conversion-goals-amp-goal-type" name="redux_builder_amp[amp-conversion-goals][amp-goal-type][select][]" class="indi_option" value=""><option value="link_tracking" '+select+'>Link Tracking</option><option value="form_submission" '+select+'>Form Submission</option></select>'+form_Select+'<div class="form_sel_div main_id_class '+hide+'"><span class="multi-title id_class">'+selectid+'</span><input type="text" id="amp-conversion-goals-amp-conv-goal-id" name="redux_builder_amp[amp-conversion-goals][amp-conv-goal-id][text][]" value="" class="regular-text multi-text" placeholder="Enter Id"></div><div class="form_sel_div '+hide+'"><span class="multi-title ">Event Name</span><input type="text" id="amp-conversion-goals-amp-conv-goal-eventname" name="redux_builder_amp[amp-conversion-goals][amp-conv-goal-eventname][text][]" value="" class="regular-text multi-text" placeholder="Enter Event Name"></div><div class="form_sel_div '+hide+'"><span class="multi-title ">Event Category</span><input type="text" id="amp-conversion-goals-amp-conv-goal-eventcat" name="redux_builder_amp[amp-conversion-goals][amp-conv-goal-eventcat][text][]" value="" class="regular-text multi-text" placeholder="Enter Event Category"></div><div class="form_sel_div '+hide+'"><span class="multi-title ">Event Action</span><input type="text" id="amp-conversion-goals-amp-conv-goal-event_action" name="redux_builder_amp[amp-conversion-goals][amp-conv-goal-event_action][text][]" value="" class="regular-text multi-text" placeholder="Enter Event Action"></div><span class="el el-remove deletion redux-multitext_repeater-remove" style="display:none"></span><div></div></div></li>';
                            el.find( '#' + id ).append( new_input );
                            el.find( '#' + id + ' li:last-child' ).removeAttr( 'style' );
                             var keylen = $('.redux-multitext_repeater-remove').length;
                            el.find( '#' + id + ' li:last-child select' ).val(selectval);
                            if(selectval == 'form_submission'){
                            el.find( '#' + id + ' li:last-child .id_class' ).text('Form ID');
                             }else{
                            el.find( '#' + id + ' li:last-child .id_class' ).text('Link ID');
                             }
                             el.find( '#' + id + ' li:last-child .goals-count' ).text('Goals #'+keylen+' '+goal_title+'');
                             $('#' + id + ' li:first-child .resetfields').remove();
                             $('#' + id + ' li .multitext_repeater-fields').removeClass( "hide" );
                             el.find( '#' + id + ' li:last-child .form_select_opt' ).val('select');
                             
                            $('.redux-multitext_repeater-remove').removeAttr('style');
                        }
                    }
                );
            }
        );
    };
})( jQuery );