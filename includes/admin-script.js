jQuery(function($) {
    var reduxOptionSearch = function(){
            jQuery('.redux_field_search').typeWatch({
                callback:function( searchString ){
                    searchString = searchString.toLowerCase();
                    var searchArray = searchString.split(' ');
                    var parent = $(this).parents('.redux-container:first');
                    var expanded_options = parent.find('.expand_options');
                    if (searchString != "") {
                        $('.redux-tab-container').hide();
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
                            $('.redux-tab-container').show();
                            $('.redux-tab-container').each(function(){
                                $(this).find('.redux-tab-selector:first').click();
                            });
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

/*---------Google Fonts ------------*/
// Google Font details 


 
    var gURL, gAPIkey;


    gAPIkey = redux_data.google_font_api_key;  
 
    // Append data into selects

        ampforwp_font_generator();
        function ampforwp_font_generator() {

            if ( ! gAPIkey){
                gAPIkey = $('#google_font_api_key').val();
            }


            gURL = "https://www.googleapis.com/webfonts/v1/webfonts?key=" + gAPIkey;

            var gfontData = $.get( gURL );

            gfontData.done(function( data ) {
                var values = Object.values(data.items);
                var allFonts = [];

                for (var i = 0; i < values.length; i++) {     
                    allFonts.push({fontFamily: values[i].family }); 
                }


               // var output =  data.items.find('Basic');
               // console.log ( output );


                // let selectedFontDetails = data.items.find((o, i) => {

                //     if (o.family === 'Keania One') {
                //         //arr[i] = { name: 'new string', value: 'this', other: 'that' };
                //         return data.items[i]; // stop searching
                //     }
                // });

                // We have all the Font details from Google API in object selectedFontDetails
                //console.log(selectedFontDetails);


                // We have all the font names in the an array allFonts
                //console.log( allFonts );


                // Creating a select 
                var s = $('<select/>');

                for (var i in allFonts) {

                    var fontDetail = allFonts[i].fontFamily;                   

                   $('#amp_font_selector-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'"> '+ fontDetail  +' </option>'));
                }

                //console.log( values.length);
                //console.log( values[0].family );
                //console.table(  values);
           
                $('#amp_font_selector-select').on('change', function() {
                    var select = $('option:selected', this).attr('data-font-number');
                    var fontVariants = data.items[select].variants ;
                    var fontFile = data.items[select].files ;

                    if ( fontVariants) {
                        $('.select2-search-choice').remove();
                        $('#amp_font_type-select').html('<option></option>');
                    }

                   // console.log( data.items[select] );

                    //if ( data.items[select] ) {
                        $('#google_current_font_data').val( JSON.stringify(data.items[select]) );
                    //}
                   
                    for (var i in fontVariants) {
                         // var fontArray = {};
                         // fontArray[fontVariants[i]] =  fontFile[fontVariants[i]] ;
                        $('#amp_font_type-select').append($("<option value='"+ fontVariants[i] +"' > "+fontVariants[i]+"</option>"));
                    }
                }); 
            });

            gfontData.fail(function(data) {
                $('#redux_builder_amp-google_font_api_key').append('<p style="color:red">  Cound not connect to API, please double check your API key. </p> ');
                $('.ampforwp-google-font-class').css({'display':'none'});
            });

        }


        $(window).load(function() {
            // Adding Default Font Family
            $('#s2id_amp_font_selector-select a').removeClass('select2-default');
            $('#select2-chosen-3').html(redux_data.amp_font_selector);
            $('#amp_font_selector-select option[value="'+redux_data.amp_font_selector+'"]').attr("selected", "selected");

            // Build select data
            let fontData  = redux_data.google_current_font_data;
            fontData = JSON.parse(fontData);
            if ( fontData.variants ) {
                $("#amp_font_type-select").select2("val", "");
                //$('.select2-search-choice').remove();
                $('#amp_font_type-select').html('<option></option>');

                for (var i in fontData.variants) {
                    $('#amp_font_type-select').append($("<option value='"+ fontData.variants[i] +"' > "+fontData.variants[i]+"</option>"));
                }
            }
            
            // Add Default selected
            if ( redux_data.amp_font_type ) {
                $('#s2id_autogen4').remove();
                for (var i in redux_data.amp_font_type) {
                    $('#s2id_amp_font_type-select ul').append('<li class="select2-search-choice">    <div> '+redux_data.amp_font_type[i]+'</div>    <a href="#" class="select2-search-choice-close" tabindex="-1"></a></li>');
                }
            }
            
        });

/*---------Google Fonts Ends -------*/


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
var dataTabRequired = function(){
    $('[data-tab-required]').each(function(){
        var tabRequired = $(this).attr('data-tab-required');
        var  currentThis = $(this);
        tabRequired = JSON.parse(tabRequired);
        var showLi = true;
        $.each(tabRequired,function(k, value){
            var currentValue = jQuery('[name="redux_builder_amp['+value[0]+']"]').val();;
            if(currentValue!=value[2]){
                showLi = false;
                return false; 
            }
        });
        if(showLi==false){
            currentThis.hide();
        }else{
            currentThis.show();
        }

    });
}    
var reduxOptionTab = function(){
    $('.redux-tab-selector').click(function(){
        var tabId = $(this).attr('data-tab');
        var tabRequired = $(this).attr('data-tab-required');
        $(this).parents().find('.custom-tab-container').hide();   
        $('#parent-section-'+ tabId ).show();
    });
    $('.redux-tabs-ul').each(function(){
        $(this).find('.redux-tab-selector:first').click();
    });
    dataTabRequired();
    $('select').change(function(){
         dataTabRequired();
    });
} 
//reduxOptionTab();   
});