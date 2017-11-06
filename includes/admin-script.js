jQuery(function($) {
    var reduxOptionSearch = function(){
            jQuery('.redux_field_search').typeWatch({
                callback:function( searchString ){
                    searchString = searchString.toLowerCase();
                    var searchArray = searchString.split(' ');
                    var parent = $(this).parents('.redux-container:first');
                    var expanded_options = parent.find('.expand_options');
                    if (searchString != "") {
                        if (!expanded_options.hasClass('expanded')) {
                            expanded_options.click();
                            parent.find('.redux-main').addClass('redux-search');
                        }
                    } else {
                        if (expanded_options.hasClass('expanded')) {
                            expanded_options.click();
                            parent.find('.redux-main').removeClass('redux-search');
                        }
                        parent.find('.redux-section-field, .redux-info-field, .redux-notice-field, .redux-container-group, .redux-section-desc, .redux-group-tab h3').show();
                        
                        if($('.redux-group-tab-link-li.active').length>0){
                            var rel = $('.redux-group-tab-link-li.active a').attr('data-rel');
                            var selector = 'div#'+rel+'_section_group';
                            jQuery(selector).show();
                            jQuery(selector).css('display','block');
                           
                        }else{
                            $('.redux-group-tab-link-li.activeChild').click();
                            $('div#'+rel+'_section_group').show();
                            $('#'+rel+'_section_group').css('display','block');
                        }

                    }            
                    parent.find('.redux-field-container').each(function() {
                        if (searchString != "") {
                            parent.find('div.redux-group-tab').css('display','none');
                            $(this).parents('tr:first').hide();
                        } else {
                            $(this).parents('tr:first').show();
                        }
                    });
                    parent.find('.form-table tr').filter(function () {
                        if(searchString==''){
                            return false;
                        }
                        var item = $(this);
                        var isMatch = true,
                            text = $(this).find('.redux_field_th').text().toLowerCase();
                        if ( !text || text == "" ) {
                            return false;
                        }
                        $.each(searchArray, function (i, searchStr) {
                            if (text.indexOf(searchStr) == -1) {
                                isMatch = false;
                            }
                        });
                        if (isMatch) {
                            $(this).show();
                             $(this).parents('div.redux-group-tab').css('display','block');
                        }
                        return isMatch;
                    }).show( function() {

                           
                    }); 
                },
                wait:400,
                highlight:false,
                captureLength:0
            });
        }
    $(document).ready(function() {
        $('.redux-container').each(function() {
            if (!$(this).hasClass('redux-no-sections')) {
                $(this).find('.redux-main').prepend('<input style="float:right" class="redux_field_search" name="" type="text" placeholder="Search the controls"/>');
                reduxOptionSearch();
            }
        });

        $(".redux_field_search").keypress(function (evt) {
            //Deterime where our character code is coming from within the event
            var charCode = evt.charCode || evt.keyCode;
            if (charCode  == 13) { //Enter key's keycode
                return false;
            }
        });

        if($(".amp-preview-button").length>0){
            $(".amp-preview-button").click(function(){
                var srcLink = $("#amp-preview-iframe").attr('data-src');
               $("#amp-preview-iframe").html("<iframe  src='"+srcLink+"'></iframe>");
            });
        }
        
    });
});