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
    // Dismiss button functionlaity
    $('#ampforwp-automattic-notice').on('click', 'button', function(){
        var nonce = $('#ampforwp-automattic-notice').attr('data-nonce');
        var data_notice = {
            'action': 'ampforwp_automattic_notice_delete',
            'security': nonce,
        };
        jQuery.post(ajaxurl, data_notice, function(response) {   
    
        });
    });
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
        gAPIkey = redux_data.google_font_api_key;
        fontswitch = redux_data['ampforwp-google-font-switch'];
        if(fontswitch != 1){
            return;
        }
        disableGFonts = redux_data.amp_google_font_restrict;  
        if($("#google_font_api_key").length>0){
            $("#google_font_api_key").after("<input type='submit' value='Verify'>");
        }
        if(gAPIkey=='' || typeof gAPIkey == 'undefined'){
            $('.ampforwp-google-font-restrict').css({'display':'none'});
        }
            
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
            if(data && localStorage.getItem("googlefontapidata") != null ){
            var values = Object.values(data.items);
            }
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
            $('#amp_font_selector-select').append($('<option value="sans-serif" data-font-number="'+ i +'"> sans-serif </option>'));
            $('#amp_font_selector_content_single-select').append($('<option value="sans-serif" data-font-number="'+ i +'"> sans-serif </option>'));
            $('#amp_font_selector-select').append($('<option value="Segoe UI" data-font-number="'+ i +'"> Segoe UI </option>'));
            $('#amp_font_selector_content_single-select').append($('<option value="Segoe UI" data-font-number="'+ i +'"> Segoe UI </option>'));
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
        $('#redux_builder_amp-amp-design-selector select').on('change',function(){
            amp_font_selector_select_change('design_change', $(this).val());
            if( $(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3){
                $('.amp-theme-global-subsection').find('.secondary-font-selector th div').text('Secondary Font Selector');
                $('.amp-theme-global-subsection').find('.secondary-font-family-selector th div').text('Secondary Font Family Selector');
                $('.amp-theme-global-subsection').find('.secondary-font-family-weights th div').text('Secondary Font Family Weight Selector');
            }else{
                $('.amp-theme-global-subsection').find('.secondary-font-selector th div').text('Content Font Selector');
                $('.amp-theme-global-subsection').find('.secondary-font-family-selector th div').text('Content Font Family Selector');
                $('.amp-theme-global-subsection').find('.secondary-font-family-weights th div').text('Content Font Family Weight Selector');
            }
        });
        function amp_font_selector_select_change(callType='', currentdesign=4){
                if($('#amp_font_selector-select').length>0){
                    // Adding Default Font Family
                    $('#s2id_amp_font_selector-select a').removeClass('select2-default');
                    
                    if(redux_data.amp_font_selector==''){
                        switch(redux_data['amp-design-selector']){
                            case '1':
                                redux_data.amp_font_selector = 'Merriweather'
                            break;
                            case '2':
                                redux_data.amp_font_selector = 'sans-serif'
                            break;
                            case '3':
                                redux_data.amp_font_selector = 'Roboto Slab'
                            break;
                            case '4':
                                redux_data.amp_font_selector = 'Poppins'
                            break;
                            default:
                                redux_data.amp_font_selector = 'Poppins'
                            break;
                        }
                        
                    }
                    if(callType=='design_change'){
                    switch(currentdesign){
                            case '1':
                                redux_data.amp_font_selector = 'Merriweather'
                            break;
                            case '2':
                                redux_data.amp_font_selector = 'sans-serif'
                            break;
                            case '3':
                                redux_data.amp_font_selector = 'Roboto Slab'
                            break;
                            case '4':
                                redux_data.amp_font_selector = 'Poppins'
                            break;
                            default:
                                redux_data.amp_font_selector = 'Poppins'
                            break;
                        }
                    }
                    $('#s2id_amp_font_selector-select .select2-chosen').html(redux_data.amp_font_selector);

                    $('#amp_font_selector-select option[value="'+redux_data.amp_font_selector+'"]').attr("selected", "selected");
                    $('#amp_font_selector-select').val(redux_data.amp_font_selector).trigger("change");

                    // Build select data
                    let fontData  = redux_data.google_current_font_data;
                   // fontData = JSON.parse(fontData);
                   //console.log(fontData);
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
                    if(redux_data.amp_font_selector_content_single==''){
                        switch(redux_data['amp-design-selector']){
                            case '1':
                                redux_data.amp_font_selector_content_single = 'Merriweather'
                            break;
                            case '2':
                                redux_data.amp_font_selector_content_single = 'sans-serif'
                            break;
                            case '3':
                                redux_data.amp_font_selector_content_single = 'Roboto Slab'
                            break;
                            case '4':
                                redux_data.amp_font_selector_content_single = 'Poppins'
                            break;
                            default:
                                redux_data.amp_font_selector_content_single = 'Poppins'
                            break;
                        }
                        
                    }
                    if(callType=='design_change'){
                    switch(currentdesign){
                            case '1':
                                redux_data.amp_font_selector_content_single = 'Segoe UI'
                            break;
                            case '2':
                                redux_data.amp_font_selector_content_single = 'sans-serif'
                            break;
                            case '3':
                                redux_data.amp_font_selector_content_single = 'PT Serif'
                            break;
                            case '4':
                                redux_data.amp_font_selector_content_single = 'Poppins'
                            break;
                            default:
                                redux_data.amp_font_selector_content_single = 'Poppins'
                            break;
                        }
                    }
                    $('#s2id_amp_font_selector_content_single-select .select2-chosen').html(redux_data.amp_font_selector_content_single);

                    $('#amp_font_selector_content_single-select option[value="'+redux_data.amp_font_selector_content_single+'"]').attr("selected", "selected");
                    $('#amp_font_selector_content_single-select').val(redux_data.amp_font_selector_content_single).trigger("change");


                    // Build select data
                    let fontData  = redux_data.google_current_font_data_content_single;
                   // fontData = JSON.parse(fontData);
                   //console.log(fontData);
                    if (! fontData.variants) {
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

 $( '.redux-action_bar input' ).on('click', function( e ) {
    if($(".amp-ls-solve").length){
      var license = $(".amp-ls-solve").val();
       license = window.atob(license);
       $(".amp-ls-solve").val(license);
   }
})

$(".redux-ampforwp-ext-activate").click(function(){
    var currentThis = $(this);
    var plugin_id = currentThis.attr("id");
    var newlicense = $('#redux_builder_amp_amp-license_'+plugin_id+'_license').val();
    var license = $('input[name="redux_builder_amp[amp-license]['+plugin_id+'][license]"]').val();
    if(newlicense!='' && newlicense.indexOf("**")<0){
        license = window.btoa(newlicense);
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
               license:window.atob(license),
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

    // Dismiss button functionlaity
    $('#ampforwp-wizard-notice').on('click', 'button', function(){
        var notice = {
            'action': 'ampforwp_notice_delete',
        };
        jQuery.post(ajaxurl, notice, function(response) {     
        });
    });

});//(document).ready Closed

jQuery(document).ready(function($){
    $("#redux_builder_amp-swift-sidebar").on( 'change', function(){
        var value = $('#redux_builder_amp-swift-sidebar #swift-sidebar').val();
        if(value == 1){
            $("#single-design-type_2").attr('checked', true);
        }else {
            //$("#single-design-type_1").attr('checked', true);
        }

    });
    //Toggle Post and Page comments panel based on options
    if($('#ampforwp-display-on-pages').length>0 && $('#ampforwp-display-on-posts').length>0){
        var pageComments = $('#ampforwp-display-on-pages').val();
        var postComments = $('#ampforwp-display-on-posts').val();
        if( pageComments ==0 && postComments == 0 ){
            $('#section-ampforwp-comments').hide();
            $('#section-table-ampforwp-comments tbody').hide();
        }
    }
    $("#redux_builder_amp-ampforwp-display-on-posts").on('change','input[type=checkbox]', function(){
        var pageComments = $('#ampforwp-display-on-pages').val();
            if($(this).is(":checked")) {
                $('#section-ampforwp-comments').show();
                $('#section-table-ampforwp-comments tbody').show();
            }else{
                if(pageComments==0){
                    $('#section-ampforwp-comments').hide();
                    $('#section-table-ampforwp-comments tbody').hide();
                }else{
                    $('#section-ampforwp-comments').show();
                    $('#section-table-ampforwp-comments tbody').show();
                }
            }
    });
    $("#redux_builder_amp-ampforwp-display-on-pages").on('change','input[type=checkbox]', function(){
        var postComments = $('#ampforwp-display-on-posts').val();
            if($(this).is(":checked")) {
                $('#section-ampforwp-comments').show();
                $('#section-table-ampforwp-comments tbody').show();
            }else{
                if(postComments == 0){
                    $('#section-ampforwp-comments').hide();
                    $('#section-table-ampforwp-comments tbody').hide();
                }else{
                    $('#section-ampforwp-comments').show();
                    $('#section-table-ampforwp-comments tbody').show();
                }
              
            }
    });

    $('.redux-image-select label img').click(function(){
        var selectedSingleDesign = $(this).parents('label.redux-image-select').attr('for');
        if(selectedSingleDesign =='single-design-type_2' || selectedSingleDesign =='single-design-type_3'){
            $("input[data-id=gnrl-sidebar]").prop('checked', true).trigger( 'change' );
            $("input[id=gnrl-sidebar]").val(1);
            $("input[data-id=swift-sidebar]").prop('checked', true).trigger( 'change' );
            $("input[id=swift-sidebar]").val(1);
        }else{
            $("input[data-id=gnrl-sidebar]").prop('checked', false).trigger( 'change' );
            $("input[id=gnrl-sidebar]").val(0);
            $("input[data-id=swift-sidebar]").prop('checked', false).trigger( 'change' );
            $("input[id=swift-sidebar]").val(0);
        }
    });

    $('#amp-rollback-switch').on('change', function(){
         var self = $(this)
        if(self.val()==1){
            self.parents('table').find('#redux_builder_amp-amp-rollback-version').parents('tr').remove();
            $.ajax({
                url: ajaxurl,
                method: 'post',
                data: {action: 'ampforwp_get_rollbackdata',
                        },
                dataType: 'json',
                success: function(response){
                    if(response.status==200){
                        var options='';
                        $.each(response.versions, function(data, k){
                            options += '<option value="'+k+'">'+data+'</option>';
                        })
                        self.parents('table').append('<tr class="fold">'+
                                    '<th scope="row">'+
                                        '<div class="redux_field_th">Rollback Version</div>'+
                                    '</th>'+
                                    '<td>'+
                                        '<fieldset id="redux_builder_amp-amp-rollback-version" class="redux-field-container redux-field redux-container-select" data-id="amp-rollback-version">'+
                                            '<select id="amp-rollback-version-select" data-placeholder="Select Version" name="redux_builder_amp[amp-rollback-version]" class="redux-select-item redux-select-item  select2-hidden-accessible" style="width: 40%;" rows="6">'+
                                            options+
                                            '</select>'+
                                            '<a id="ampforwp-rollback-url" href="'+response.url+'" target="_blank" class="button" style="margin-left:10px">'+response.text+'</a>'+
                                        '</fieldset>'+
                                    '</td>'+
                                '</tr>'
                                
                                );
                        $('#amp-rollback-version-select').select2();
                        versionUpdate();
                        $('#info-amp-rollback-switch-waiting').hide();
                    }
                }

            });



        }else{
            self.parents('table').find('#redux_builder_amp-amp-rollback-version').parents('tr').remove();
        }
       

    });
    if($(".amp-preview-button").length>0){
        $(".amp-preview-button").click(function(){
            var srcLink = $("#amp-preview-iframe").attr('data-src');
           $("#amp-preview-iframe").html("<iframe  src='"+srcLink+"'></iframe>");
        });
    }
    var versionUpdate = function(){
        $('#amp-rollback-version-select').on('change', function(){
            $selectedVersion = $(this).val();
            console.log($selectedVersion);
            if($selectedVersion){
                var rollbackUrl = $('#ampforwp-rollback-url').attr('href');
                rollbackUrl = ampforwp_updateQueryStringParameter(rollbackUrl, 'changeversion', $selectedVersion);
                 $('#ampforwp-rollback-url').attr('href', rollbackUrl);
            }
        });
    }
    versionUpdate();

    // AMP FrontPage notice in Reading Settings #2348
    if ( 'false' == redux_data.frontpage){
        $('#page_on_front').parent('label').append('<p class="afp"><b>We have detected that you have not setup the FrontPage for AMP, </b><a href="'+redux_data.admin_url+'">Click here to setup</a></span>');
    }
}); 
function ampforwp_updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}


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
        if(jQuery('#amp-page-builder-ready').length){
            var pbdata  = jQuery('#amp-page-builder-ready').html();
            var takeover = redux_data['ampforwp-amp-takeover'];
            var pb = redux_data['ampforwp-pagebuilder'];
            var pb2 = jQuery('input[name="ampforwp_page_builder_enable"]:checked').val();
            if ( takeover == 1 && pb == 1 && 'yes' == pb2 ) {
                data = pbdata;
            }
        }
        return data;
    };
    new AmpForWpYoastAnalysis();
}); 

