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
                        //parent.find('.redux-section-field, .redux-info-field, .redux-notice-field, .redux-container-group, .redux-section-desc, .redux-group-tab h3').show();
                        
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
                    }).show( function() { }); 

                    parent.find('.redux-group-tab').each(function() {
                        if (searchString != "") {
                            $(this).find("div.redux-section-field").each(function(){
                                var divSectionId = $(this).attr('id');
                                var splitResult = divSectionId.split("-");
                                splitResult.splice(1, 0, "table");
                                var divTableId = splitResult.join("-");
                                var totalTr = $("#"+divTableId).find('tr:visible').length;
                                if(totalTr==0){
                                    $(this).hide();
                                }
                            });
                        } else {
                            $(this).find("div.redux-section-field").each(function(){
                                var divSectionId = $(this).attr('id');
                                var splitResult = divSectionId.split("-");
                                splitResult.splice(1, 0, "table");
                                var divTableId = splitResult.join("-");
                                var totalTr = $("#"+divTableId).find('tr:visible').length;
                                if(totalTr>0){
                                    $(this).show();
                                }
                            });
                        }
                    }); // parent.find('.redux-group-tab') Closed
                },
                wait:400,
                highlight:false,
                captureLength:0
            });
        }

    //option panel Section Division
    var optionSectionDevision = function(){
        $('.afw-accordion-header').click(function(){
            //Get Cookie Changes
            if ( $.cookie( "redux_current_section_customize" )){
                 var allReduxTabs = JSON.parse($.cookie( "redux_current_section_customize" ));   
            }else{
               var allReduxTabs = {};
            }
            
            var section = $(this).attr("id");
            section = section.replace("section-","section-table-");
           
            if($("#"+section).is(':visible')){
                $("#"+section).hide();
                $(this).removeClass("afw-accordion-tab-open").addClass("afw-accordion-tab-close");
                allReduxTabs[section] = 'hide';
            }else{
                $("#"+section).show();
                $(this).removeClass("afw-accordion-tab-close").addClass("afw-accordion-tab-open");
                allReduxTabs[section] = 'show';
            }

            //Set Cookie Changes
            $.cookie(
                'redux_current_section_customize', JSON.stringify(allReduxTabs), {
                    expires: 7,
                    path: '/'
                }
            );
        });
        //While loading at first time
        if($('.afw-accordion-header').length>0){
            //console.log($.cookie( "redux_current_section_customize" ));
            if ( $.cookie( "redux_current_section_customize" ) ){
                var tabsValue = JSON.parse($.cookie( "redux_current_section_customize" ));
            }else{
                var tabsValue = "";
            }
            $('.afw-accordion-header').each(function(){

                var reduxAccordianHeader = $(this);
                var section = reduxAccordianHeader.attr("id");
                section = section.replace("section-","section-table-");

                if(tabsValue[section]){
                    var currentSettings = tabsValue[section];
                    if(currentSettings=='hide'){
                        reduxAccordianHeader.removeClass("afw-accordion-tab-open").addClass("afw-accordion-tab-close");
                    }else if(currentSettings=='show'){
                        reduxAccordianHeader.removeClass("afw-accordion-tab-close").addClass("afw-accordion-tab-open");
                    }
                }

                if(reduxAccordianHeader.hasClass('afw-accordion-tab-close')){
                    $("#"+section).hide();
                }else if(reduxAccordianHeader.hasClass('afw-accordion-tab-open')){
                    $("#"+section).show();
                }

            })
        }
    }//Cloesed function  = optionSectionDevision

    var hideReduxLeftTabs = function(){
         jQuery('ul.redux-group-menu > li.redux-group-tab-link-li').siblings('.redux-group-tab-link-li').each(function(key,Data){
            if(key>3){
                jQuery(this).attr("style","display:none;").addClass("otherSectionFields");
            }
        });

        jQuery( '.redux-group-tab-link-a' ).click(function(){
            if(jQuery(this).parent('li').hasClass('otherSectionFields')){
                jQuery(this).parent('li.otherSectionFields').siblings('li.otherSectionFields').hide();
                if(!jQuery(this).parent('li').is(':visible')){
                    jQuery(this).parent('li').show();
                }
            }else{
                jQuery(this).parent('li').siblings('li.otherSectionFields').hide();
                jQuery(this).parent('li').siblings('li.active').show();

            }
        });
    }
    
    var showExtensionTabs = function(){
        var currentTab = getQueryStringValue('tabid');
        if(currentTab!="" && $("li."+currentTab).length>0){
            $("li."+currentTab+" a").click();
        }
    }
    var switchTextfunc = function(){
        var switchText = $('.switch-text');
        switchText.each(function(e,v){
            if ( $(this).siblings('input').attr('value') == 1 ) {
                $(this).parent('div.switch-options').find('.switch-text-on').show();
            }
            else if ( $(this).siblings('input').attr('value') == 0 ) {
                $(this).parent('div.switch-options').find('.switch-text-off').show();
            }
        });        
        switchText.siblings('label').click(function(){
            if ( $(this).siblings('input').attr('value') == 1 ) {
                $(this).parent().find('.switch-text-on').hide();
                $(this).parent().find('.switch-text-off').show();
            }
            else if ( $(this).siblings('input').attr('value') == 0 ) {
                    $(this).parent().find('.switch-text-off').hide();
                    $(this).parent().find('.switch-text-on').show();
            }
        });
    }
    $(document).ready(function() {


    $('#redux_builder_amp-header-type li.redux-image-select').on('click', function(){
        var current_header = $( this ).find('input');
        var current_header_type = $( current_header ).attr('value');
        if ( current_header_type == 1 ) {
            $('#swift-width-control').val('1100px');
            $('#swift-height-control').val('60px');

            // Header Background
            $('#swift-background-scheme-color').val('#ffffff'); 
            $('#swift-background-scheme-color').attr('data-current-color','#ffffff');
            $('#swift-background-scheme-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='swift-background-scheme-color']").val('#ffffff');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#ffffff');

            // Header Elements
            $('#swift-element-color-control-color').val('#000000'); 
            $('#swift-element-color-control-color').attr('data-current-color','#000000');
            $('#swift-element-color-control-color').attr('data-color','rgb(0,0,0,1)');
            $("input[data-id='swift-element-color-control-color']").val('#000000');
            $("input[data-id='swift-element-color-control-rgba']").val('rgb(0,0,0,1)');
            $("#redux_builder_amp-swift-element-color-control .sp-preview-inner").css('background-color','#000000');

        };
        if ( current_header_type == 2 ) {
            $('#swift-width-control').val('1100px');
            $('#swift-height-control').val('60px');

            // Header Background
            $('#swift-background-scheme-color').val('#ffffff'); 
            $('#swift-background-scheme-color').attr('data-current-color','#ffffff');
            $('#swift-background-scheme-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='swift-background-scheme-color']").val('#ffffff');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#ffffff');

            // Header Elements
            $('#swift-element-color-control-color').val('#000000'); 
            $('#swift-element-color-control-color').attr('data-current-color','#000000');
            $('#swift-element-color-control-color').attr('data-color','rgb(0,0,0,1)');
            $("input[data-id='swift-element-color-control-color']").val('#000000');
            $("input[data-id='swift-element-color-control-rgba']").val('rgb(0,0,0,1)');
            $("#redux_builder_amp-swift-element-color-control .sp-preview-inner").css('background-color','#000000');

        };
        if ( current_header_type == 3 ) {
            $('#swift-width-control').val('1100px');
            $('#swift-height-control').val('60px');

            // Header Background
            $('#swift-background-scheme-color').val('#ffffff'); 
            $('#swift-background-scheme-color').attr('data-current-color','#ffffff');
            $('#swift-background-scheme-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='swift-background-scheme-color']").val('#ffffff');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#ffffff');

            // Header Elements
            $('#swift-element-color-control-color').val('#000000'); 
            $('#swift-element-color-control-color').attr('data-current-color','#000000');
            $('#swift-element-color-control-color').attr('data-color','rgb(0,0,0,1)');
            $("input[data-id='swift-element-color-control-color']").val('#000000');
            $("input[data-id='swift-element-color-control-rgba']").val('rgb(0,0,0,1)');
            $("#redux_builder_amp-swift-element-color-control .sp-preview-inner").css('background-color','#000000');

        };
        if ( current_header_type == 4) {
            // $('#ampforwp_themes_swift_h4menu_color-color').val('#fa0732'); 
            $('#swift-width-control').val('1100px');
            $('#swift-height-control').val('60px');

            // Header 4 Desktop Menu Color
            $('#ampforwp_themes_swift_h4menu_color-color').val('#ffffff'); 
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-current-color','#ffffff');
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-color']").val('#ffffff');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4menu_color .sp-preview-inner").css('background-color','#ffffff');

            // Header Background
            $('#swift-background-scheme-color').val('#000000'); 
            $('#swift-background-scheme-color').attr('data-current-color','#000000');
            $('#swift-background-scheme-color').attr('data-color','rgb(0,0,0,1)');
            $("input[data-id='swift-background-scheme-color']").val('#000000');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(0,0,0,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#000000');

            $('#ampforwp_themes_swift_h4menu_position-select').val('3').trigger('change.select2');
            
            
             // $('#redux_builder_amp-swift-background-scheme-color .sp-preview-inner').css('background-color','#fa0732');
            //$('#swift-background-scheme-color').val('#000');
        };
        if ( current_header_type == 5) {
            $('#swift-width-control').val('90%');
            $('#swift-height-control').val('auto');

            $('#ampforwp_themes_swift_h4menu_position-select').val('1').trigger('change.select2');

            // Header 5 Desktop Menu Color
            $('#ampforwp_themes_swift_h4menu_color-color').val('#111111'); 
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-current-color','#111111');
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-color','rgb(17,17,17,1)');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-color']").val('#111111');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-rgba']").val('rgb(17,17,17,1)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4menu_color .sp-preview-inner").css('background-color','#111111');

            // Header Background
            $('#swift-background-scheme-color').val('#ffffff'); 
            $('#swift-background-scheme-color').attr('data-current-color','#ffffff');
            $('#swift-background-scheme-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='swift-background-scheme-color']").val('#ffffff');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#ffffff');

        }
        if ( current_header_type == 6) {
            $('#swift-width-control').val('100%');
            $('#swift-height-control').val('80px');

            $('#ampforwp_themes_swift_h4menu_position-select').val('2').trigger('change.select2');
            // Header 6 Desktop Menu Color
            $('#ampforwp_themes_swift_h4menu_color-color').val('#111111'); 
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-current-color','#111111');
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-color','rgb(17,17,17,1)');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-color']").val('#111111');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-rgba']").val('rgb(17,17,17,1)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4menu_color .sp-preview-inner").css('background-color','#111111');

            // Header Background
            $('#swift-background-scheme-color').val('#ffffff'); 
            $('#swift-background-scheme-color').attr('data-current-color','#ffffff');
            $('#swift-background-scheme-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='swift-background-scheme-color']").val('#ffffff');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#ffffff');
            $('#swift_hm_bdr_wdth').val('2px');

            // Box shadow
            $('#ampforwp_themes_swift_h4bxs').val('1');

            // Hambergur menu border color
            $('#swift_hm_bdr_clr-color').val('#eeeeee'); 
            $('#swift_hm_bdr_clr-color').attr('data-current-color','#eeeeee');
            $('#swift_hm_bdr_clr-color').attr('data-color','rgb(238,238,238,1)');
            $("input[data-id='swift_hm_bdr_clr-color']").val('#eeeeee');
            $("input[data-id='swift_hm_bdr_clr-rgba']").val('rgb(238,238,238,1)');
            $("#redux_builder_amp-swift_hm_bdr_clr .sp-preview-inner").css('background-color','#eeeeee');
        }
        if ( current_header_type == 7) {
            $('#swift-width-control').val('90%');
            $('#swift-height-control').val('auto');

            // Header Background
            $('#swift-background-scheme-color').val('#000000'); 
            $('#swift-background-scheme-color').attr('data-current-color','#000000');
            $('#swift-background-scheme-color').attr('data-color','rgb(0,0,0,1)');
            $("input[data-id='swift-background-scheme-color']").val('#000000');
            $("input[data-id='swift-background-scheme-rgba']").val('rgb(0,0,0,1)');
            $("#redux_builder_amp-swift-background-scheme .sp-preview-inner").css('background-color','#000000');

            // Header 7 Desktop Menu Color
            $('#ampforwp_themes_swift_h4menu_color-color').val('#ffffff'); 
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-current-color','#ffffff');
            $('#ampforwp_themes_swift_h4menu_color-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-color']").val('#ffffff');
            $("input[data-id='ampforwp_themes_swift_h4menu_color-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4menu_color .sp-preview-inner").css('background-color','#ffffff');

            $("#swift_h7_menulabel").val('Explore');
            $('#swift_hm_bdr_wdth').val('1px');
            // Hambergur menu border color
            $('#swift_hm_bdr_clr-color').val('#cccccc'); 
            $('#swift_hm_bdr_clr-color').attr('data-current-color','#cccccc');
            $('#swift_hm_bdr_clr-color').attr('data-color','rgb(204,204,204,1)');
            $("input[data-id='swift_hm_bdr_clr-color']").val('#cccccc');
            $("input[data-id='swift_hm_bdr_clr-rgba']").val('rgb(204,204,204,1)');
            $("#redux_builder_amp-swift_hm_bdr_clr .sp-preview-inner").css('background-color','#cccccc');

            $('#ampforwp_themes_swift_h4cta').val('1');
            $("#ampforwp_themes_swift_h4cta_text").val('Purchase');
            $("#ampforwp_themes_swift_h4cta-brdr").val('1');

            // Border-Color
            $('#ampforwp_themes_swift_h4cta_brdrcolor-color').val('#ffffff80'); 
            $('#ampforwp_themes_swift_h4cta_brdrcolor-color').attr('data-current-color','#ffffff80');
            $('#ampforwp_themes_swift_h4cta_brdrcolor-color').attr('data-color','rgba(255,255,255,0.5)');
            $("input[data-id='ampforwp_themes_swift_h4cta_brdrcolor-color']").val('#ffffff80');
            $("input[data-id='ampforwp_themes_swift_h4cta_brdrcolor-rgba']").val('rgba(255,255,255,0.5)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4cta_brdrcolor .sp-preview-inner").css('background-color','#ffffff80');

            $("#ampforwp_themes_swift_h4ctabrdrwd").val('1');
            $("#ampforwp_themes_swift_h4cta_brdrds").val('20');

            // CTA Text Color
            $('#ampforwp_themes_swift_h4cta_txtcolor-color').val('#ffffff'); 
            $('#ampforwp_themes_swift_h4cta_txtcolor-color').attr('data-current-color','#ffffff');
            $('#ampforwp_themes_swift_h4cta_txtcolor-color').attr('data-color','rgb(255,255,255,1)');
            $("input[data-id='ampforwp_themes_swift_h4cta_txtcolor-color']").val('#ffffff');
            $("input[data-id='ampforwp_themes_swift_h4cta_txtcolor-rgba']").val('rgb(255,255,255,1)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4cta_txtcolor .sp-preview-inner").css('background-color','#ffffff');

            //CTA Background Color
            $('#ampforwp_themes_swift_h4cta_color-color').val('#ffffff00'); 
            $('#ampforwp_themes_swift_h4cta_color-color').attr('data-current-color','#ffffff00');
            $('#ampforwp_themes_swift_h4cta_color-color').attr('data-color','rgb(255,255,255,0)');
            $("input[data-id='ampforwp_themes_swift_h4cta_color-color']").val('#ffffff00');
            $("input[data-id='ampforwp_themes_swift_h4cta_color-rgba']").val('rgb(255,255,255,0)');
            $("#redux_builder_amp-ampforwp_themes_swift_h4cta_color .sp-preview-inner").css('background-color','#ffffff00');
        }
    });



        if(getQueryStringValue('page')=='amp_options'){
            //Tab section implementation
            optionSectionDevision();
            //To Show title on the top; In front of search bar
            if($( '.redux-group-tab-link-a' ).length){
             redux_title_modify();    
            }
          
            //To Hide Leftsidebar option Below Extension
            hideReduxLeftTabs();
            showExtensionTabs();
            switchTextfunc();
        }

 
    var gURL, gAPIkey, disableGFonts;


    gAPIkey = redux_data.google_font_api_key;
    disableGFonts = redux_data.amp_google_font_restrict;  
        if(gAPIkey=='' || typeof gAPIkey == 'undefined'){
            $('.ampforwp-google-font-restrict').css({'display':'none'});
        }
    // Append data into selects
    ampforwp_font_generator();
    function ampforwp_font_generator() {

        if ( ! gAPIkey){
            gAPIkey = $('#google_font_api_key').val();
        }
        if(gAPIkey=='' || typeof gAPIkey == 'undefined'){
             $('#redux_builder_amp-google_font_api_key').append('<p style="color:red"> Could not connect to API, please double check your API key. </p> ');
            $('.ampforwp-google-font-class').css({'display':'none'});
            return ;
        }
        if(disableGFonts==1){
            gAPIkey='';
            return;
        }
        gURL = "https://www.googleapis.com/webfonts/v1/webfonts?key=" + gAPIkey;

        
        if (localStorage.getItem("googlefontapidata") === null) {
            var gfontData = $.get( gURL );
            gfontData.done(function( data ) {
                localStorage.setItem('googlefontapidata', JSON.stringify(data));
                ampforwp_fonts_select_data(data);
            });

            gfontData.fail(function(data) {
                $('#redux_builder_amp-google_font_api_key').append('<p style="color:red">  Could not connect to API, please double check your API key. </p> ');
                $('.ampforwp-google-font-class').css({'display':'none'});
            });
            gfontData.always(function(){
                amp_font_selector_select_change();
            })
        }else{
           data = localStorage.getItem("googlefontapidata");
           ampforwp_fonts_select_data(JSON.parse(data));
           amp_font_selector_select_change();
        }
       
    }
        function ampforwp_fonts_select_data(data){
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
               $('#amp_font_selector_content_single-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'"> '+ fontDetail  +' </option>'));
            }

            //console.log( values.length);
            //console.log( values[0].family );
            //console.table(  values);
            
            $('#amp_font_selector-select, #amp_font_selector_content_single-select').on('change', function() {
                var select = $('option:selected', this).attr('data-font-number');
                var fontVariants = data.items[select].variants ;
                var fontFile = data.items[select].files ;

                if($(this).attr("id")=='amp_font_selector-select'){
                    if ( fontVariants) {
                        //$('.select2-search-choice').remove();
                        $('#amp_font_type-select').html('<option></option>').trigger('change');
                    }

                   // console.log( data.items[select] );

                    //if ( data.items[select] ) {
                        $('#google_current_font_data').val( JSON.stringify(data.items[select]) );
                   
                    for (var i in fontVariants) {
                        $('#amp_font_type-select').append($("<option value='"+ fontVariants[i] +"' > "+fontVariants[i]+"</option>")).trigger('change');
                    }
                }else if($(this).attr("id")=='amp_font_selector_content_single-select') {
                    if ( fontVariants) {
                        //$('.select2-search-choice').remove();
                        $('#amp_font_type_content_single-select').html('<option></option>').trigger('change');
                    }
                    $('#google_current_font_data_content_single').val( JSON.stringify(data.items[select]) );
                   
                    for (var i in fontVariants) {
                        $('#amp_font_type_content_single-select').append($("<option value='"+ fontVariants[i] +"' > "+fontVariants[i]+"</option>")).trigger('change');
                    }
                }

            });
        }
        function amp_font_selector_select_change(){

               if($("#google_font_api_key").length>0){
                    $("#google_font_api_key").after("<input type='submit' value='Verify'>");
                }
                if($('#amp_font_selector-select').length>0){
                    // Adding Default Font Family
                    $('#s2id_amp_font_selector-select a').removeClass('select2-default');
                    
                    if(redux_data.amp_font_selector==''){
                        redux_data.amp_font_selector = 'Poppins'
                    }
                    $('#s2id_amp_font_selector-select .select2-chosen').html(redux_data.amp_font_selector);

                    $('#amp_font_selector-select option[value="'+redux_data.amp_font_selector+'"]').attr("selected", "selected");
                    $('#amp_font_selector-select').select2('val',redux_data.amp_font_selector).trigger("change");

                    // Build select data
                    let fontData  = redux_data.google_current_font_data;
                   // fontData = JSON.parse(fontData);
                   console.log(fontData);
                    if (! fontData.variants) {
                        //$('.select2-search-choice').remove();
                        //$('#amp_font_type-select').html('<option></option>');

                        for (var i in fontData.variants) {
                            $('#amp_font_type-select').append($("<option value='"+ fontData.variants[i] +"' > "+fontData.variants[i]+"</option>")).trigger('change');
                        }
                    }
                    
                    if(redux_data.amp_font_type==''){
                        redux_data.amp_font_type = ['regular','500','700'];
                    }
                    // Add Default selected
                    if ( redux_data.amp_font_type ) {
                        $('#s2id_autogen4').remove();
                        for (var i in redux_data.amp_font_type) {
                            $('#s2id_amp_font_type-select ul').append('<li class="select2-search-choice">    <div> '+redux_data.amp_font_type[i]+'</div>    <a href="#" class="select2-search-choice-close" tabindex="-1"></a></li>');
                            //s2.append($('<option>').text(e));
                            $('#amp_font_type-select option[value='+redux_data.amp_font_type[i]+']').attr('selected','selected').trigger('change');
                        }
                        //$('#amp_font_type-select').select2('val',redux_data.amp_font_type)
                    }
                }//#amp_font_selector-select closed


                /************
                * Content Font Selectors On load work
                * amp_font_selector_content_single
                *
                *********/

                if($('#amp_font_selector_content_single-select').length>0){
                    // Adding Default Font Family
                    $('#s2id_amp_font_selector_content_single-select a').removeClass('select2-default');
                    
                    if(redux_data.amp_font_selector_content_single==''){
                        redux_data.amp_font_selector_content_single = 'Poppins'
                    }
                    $('#s2id_amp_font_selector_content_single-select .select2-chosen').html(redux_data.amp_font_selector_content_single);

                    $('#amp_font_selector_content_single-select option[value="'+redux_data.amp_font_selector_content_single+'"]').attr("selected", "selected");
                    $('#amp_font_selector_content_single-select').select2('val',redux_data.amp_font_selector_content_single).trigger("change");


                    // Build select data
                    let fontData  = redux_data.google_current_font_data_content_single;
                   // fontData = JSON.parse(fontData);
                   console.log(fontData);
                    if (! fontData.variants) {
                        //$('.select2-search-choice').remove();
                        //$('#amp_font_type-select').html('<option></option>');

                        for (var i in fontData.variants) {
                            $('#amp_font_selector_content_single-select').append($("<option value='"+ fontData.variants[i] +"' > "+fontData.variants[i]+"</option>")).trigger('change');
                        }
                    }
                    
                    if(redux_data.amp_font_type_content_single==''){
                        redux_data.amp_font_type_content_single = ['regular','500','700'];
                    }
                    // Add Default selected
                    if ( redux_data.amp_font_type_content_single ) {
                        $('#s2id_autogen4').remove();
                        for (var i in redux_data.amp_font_type_content_single) {
                            $('#s2id_amp_font_type_content_single-select ul').append('<li class="select2-search-choice">    <div> '+redux_data.amp_font_type_content_single[i]+'</div>    <a href="#" class="select2-search-choice-close" tabindex="-1"></a></li>');
                            //s2.append($('<option>').text(e));
                            $('#amp_font_type_content_single-select option[value='+redux_data.amp_font_type_content_single[i]+']').attr('selected','selected').trigger('change');
                        }
                        //$('#amp_font_type_content_single-select').select2('val',redux_data.amp_font_type_content_single)
                    }
                }//#amp_font_selector_content_single-select closed

        }


/*---------Google Fonts Ends -------*/
 
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

$(".redux-ampforwp-ext-activate").click(function(){
    var currentThis = $(this);
    var plugin_id = currentThis.attr("id");
    var newlicense = $('#redux_builder_amp_amp-license_'+plugin_id+'_license').val();
    var license = $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][license]"]').val();
    if(newlicense!='' && newlicense.indexOf("**")<0){
        license = newlicense;
        $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][license]"]').val(license);
    }

    var item_name = $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][item_name]"]').val();
    var store_url = $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][store_url]"]').val();
    var plugin_active_path = $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][plugin_active_path]"]').val();
    currentThis.html("Please Wait...");
    $.ajax({
        url: ajaxurl,
        method: 'post',
        data: {action: 'ampforwp_get_licence_activate_update',
               ampforwp_license_activate:plugin_id,
               license:license,
               item_name:item_name,
               store_url:store_url,
               plugin_active_path:plugin_active_path
                },
        dataType: 'json',
        success: function(response){
            currentThis.parents("li").find('.afw-license-response-message').remove();
            if(response.status=='200'){
                currentThis.parents("li").removeClass("not-active").removeClass("invalid").addClass("active").addClass("valid");
                currentThis.html("Deactivate");
                currentThis.after("<div class='afw-license-response-message'>"+response.message+'</div>');
                currentThis.removeClass('redux-ampforwp-ext-activate').addClass('redux-ampforwp-ext-deactivate');
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][status]"]').val("valid");
                deactivatelicence();
                var all_data = response.other.all_data;
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][success]"]').val( all_data.success );
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][license]"]').val( all_data.license );
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][item_name]"]').val( all_data.item_name );
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][expires]"]').val( all_data.expires );
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][customer_name]"]').val( all_data.customer_name );
                $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][customer_email]"]').val( all_data.customer_email );
                //window.location.href = window.location.href;
            }else{
                currentThis.after("<div class='afw-license-response-message'>"+response.message+'</div>');
                currentThis.html("Activate");
            }
        }
    })
})

//Deactivate License key
function deactivatelicence(){
$(".redux-ampforwp-ext-deactivate").click(function(){
    var currentThis = $(this);
    var plugin_id = currentThis.attr("id");
    currentThis.html("Please Wait...");
    $deactivateConfirm = confirm("Are you sure you want to Deactivate ?");
    if($deactivateConfirm){
        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {action: 'ampforwp_deactivate_license', ampforwp_license_deactivate:plugin_id},
            dataType: 'json',
            success: function(response){
                currentThis.parents("li").find('.afw-license-response-message').remove();
                if(response.status=='200'){
                    currentThis.parents(".extension_desc").find("input[name='redux_builder_amp[amp-license][amp-ads-google-adsense][license]']").val("");

                    currentThis.after("<div class='afw-license-response-message'>"+response.message+'</div>');

                    window.location.href = window.location.href;
                }else{
                    alert(response.message);
                }
            }
        })
    }
});

}
deactivatelicence();

var helpSection = function(){
    var open;

  open = true;

  $('.a-f-wp-help-tear').click(function() {
    if (open) {
      $('.a-f-wp-help-tear').addClass('active');
      $('.a-f-wp-help-message').addClass('active');
      $('.a-f-wp-help-tear').html("<span><i class='dashicons-no-alt'></i></span>");
      return open = !open;
    } else {
      $('.a-f-wp-help-tear').removeClass('active');
      $('.a-f-wp-help-message').removeClass('active');
      $('.a-f-wp-help-message').val('');
      $('.a-f-wp-help-tear').html("<span><i class='dashicons-admin-comments'></i></span>");
      return open = !open;
    }
  });

  $('input').on('input', function(e) {
    var value;
    value = $("input").val();
    if (value.length >= 2) {
      $('.a-f-wp-help-tear').addClass('green');
      $('.a-f-wp-help-tear').removeClass('active');
      return $('.a-f-wp-help-tear').html("<span><i class='dashicons-admin-comments'></i></span>");
    } else {
      $('.a-f-wp-help-tear').removeClass('green');
      $('.a-f-wp-help-tear').addClass('active');
      return $('.a-f-wp-help-tear').html("<span><i class='dashicons-no-alt'></i></span>");
    }
  });
}
helpSection();

var redux_title_modify = function(){
    $( '.redux-group-tab-link-a' ).click(function(){
        var link = $( this );
        if ( link.parent().hasClass( 'empty_section' ) && link.parent().hasClass( 'hasSubSections' ) ) {
            var elements = $( this ).closest( 'ul' ).find( '.redux-group-tab-link-a' );
            var index = elements.index( this );
            link = elements.slice( index + 1, index + 2 );
        }
                
        var el = link.parents( '.redux-container:first' );
        var relid = link.data( 'rel' ); // The group ID of interest
        var oldid = el.find( '.redux-group-tab-link-li.active:first .redux-group-tab-link-a' ).data( 'rel' );
        
        var panelTitle = el.find( '#' + relid + '_section_group' ).find("h2:first").hide().html();
        $('.redux-main').find("#info_bar h2#newTitle").remove();
        if (typeof panelTitle !== 'undefined' || panelTitle){
            $('.redux-main').find("#info_bar a.expand_options").after('<h2 id="newTitle" style="float: left;margin: 0px;padding-left: 10px;">'+panelTitle+'</h2>');
        }

    });

    $('li.active .redux-group-tab-link-a').click();
}

});

function getQueryStringValue (key) {  
  return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
}

jQuery(document).ready(function($){
    $( "#ampforwp-creat-manifest" ).click(function() {
        var data = {
            'action': 'ampforwp_amp_app_banner_manifest_json',
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            alert(response);
        });
    });

    $('#ampforwp-pwa-activation-call, #ampforwp-structure-data-activation-call').click(function(){
        if(pagenow == 'toplevel_page_amp_options'){
            var self = $(this);
            self.parents('div.update-message').addClass('updating-message');
            var activate = '';
            if($(this).attr('id')=='ampforwp-pwa-activation-call'){
                activate = '&activate=pwa';
            }else if($(this).attr('id')=='ampforwp-structure-data-activation-call'){
                activate = '&activate=structure_data';
            }
            self.text('Updating...');
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: 'action=ampforwp_enable_pwa_module'+activate,
                dataType: 'json',
                success: function (response){
                    if(response.status==200){
                        self.parents('div.ampforwp-modules').removeClass('update-message updating-message')
                        self.parents('div.ampforwp-modules').addClass('updated-message')
                         self.parents('div.ampforwp-modules').html('<a href="'+response.redirect_url+'">Go to settings</a>')
                        
                    }else{
                        alert(response.message)
                    }
                    
                }
            });
            
        }
    });


});//(document).ready Closed

jQuery(document).ready(function($){
$("#redux_builder_amp-swift-sidebar").on( 'change', function(){
var value = $('#redux_builder_amp-swift-sidebar #swift-sidebar').val();
if(value == 1){
$("#single-design-type_2").attr('checked', true);
}else {
    $("#single-design-type_1").attr('checked', true);
}

});

}); 

jQuery(window).on("YoastSEO:ready",function(){
AmpForWpYoastAnalysis = function() {
  YoastSEO.app.registerPlugin( 'ampForWpYoastAnalysis', {status: 'ready'} );

  /**
   * @param modification    {string}    The name of the filter
   * @param callable        {function}  The callable
   * @param pluginName      {string}    The plugin that is registering the modification.
   * @param priority        {number}    (optional) Used to specify the order in which the callables
   *                                    associated with a particular filter are called. Lower numbers
   *                                    correspond with earlier execution.
   */
  YoastSEO.app.registerModification( 'content', this.myContentModification, 'ampForWpYoastAnalysis', 5 );
}

    /**
     * Adds some text to the data...
     *
     * @param data The data to modify
     */
    AmpForWpYoastAnalysis.prototype.myContentModification = function(data) {
        var pbdata  = $('#amp-page-builder-ready').val();
        var takeover = redux_data['ampforwp-amp-takeover'];
        var pb = redux_data['ampforwp-pagebuilder'];
        var pb2 = $('input[name="ampforwp_page_builder_enable"]').val();
        if ( takeover == 1 && pb == 1 && 'yes' == pb2 ) {
            data = pbdata;
        }
        return data;
    };
    new AmpForWpYoastAnalysis();
}); 