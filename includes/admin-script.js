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
                        if(item.hasClass('hide')){
                            return false;
                        }
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
                                var item = $(this);
                                if(item.hasClass('hide')){
                                    return false;
                                }
                                var divSectionId = $(this).attr('id');
                                var splitResult = divSectionId.split("-");
                                splitResult.splice(1, 0, "table");
                                var divTableId = splitResult.join("-");
                                var totalTr = $("#"+divTableId).find('tr:visible').length;
                                if(totalTr>0){
                                    $(this).show();
                                }
                            });
                            $(this).find('.form-table-section tbody').each(function(){
                                $(this).find('tr').each(function (i, el) {
                                    var item = $(this);
                                    if(item.hasClass('hide')){
                                        item.hide();
                                    }
                                    if(item.hasClass('redux-section-indent-start')){
                                        item.hide();
                                    }
                                });
                            });
                        }
                    }); // parent.find('.redux-group-tab') Closed
                },
                wait:400,
                highlight:false,
                captureLength:0
            });
        }
    $('.redux-container').each(function() {
        if (!$(this).hasClass('redux-no-sections')) {
            $(this).find('.display_header').append('<span class="search-wrapper"><input  class="redux_field_search" name="" type="text" placeholder="Search the controls" style="display:none"/><span class="redux-amp-search-icon"><i class="dashicons-before dashicons-search"></i></span></span>');
            $('.redux-amp-search-icon').on("click", function(){
                $('.redux_field_search').toggle('slide');
                var val = $('.redux_field_search').val();
                var display = $('.redux_field_search').css('display');
                if(val!='' && display=='block'){
                    $('.redux_field_search').val('');
                     var parent = jQuery('.redux_field_search').parents('.redux-container:first');
                     var expanded_options = parent.find('.expand_options');
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
                    parent.find('.redux-field-container').each(function() {
                        $(this).parents('tr:first').show();
                    });
                     parent.find('.redux-group-tab').each(function() {
                         $(this).find("div.redux-section-field").each(function(){
                            var item = $(this);
                            if(item.hasClass('hide')){
                                return false;
                            }
                            var divSectionId = $(this).attr('id');
                            var splitResult = divSectionId.split("-");
                            splitResult.splice(1, 0, "table");
                            var divTableId = splitResult.join("-");
                            var totalTr = $("#"+divTableId).find('tr:visible').length;
                            if(totalTr>0){
                                $(this).show();
                            }
                        });
                        $(this).find('.form-table-section tbody').each(function(){
                            $(this).find('tr').each(function (i, el) {
                                var item = $(this);
                                if(item.hasClass('hide')){
                                    item.hide();
                                }
                                if(item.hasClass('redux-section-indent-start')){
                                    item.hide();
                                }
                            });
                        });
                    });
                }
            });
            reduxOptionSearch();
        }
    });

    function ampforwp_get_cookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

    var ref_lap = ampforwp_get_cookie('ref_lap');
    if(ref_lap==''){
        var ref_nonce = ampforwp_get_cookie('ref_nonce');
        var current_post = ampforwp_get_cookie('current_post');
        if(current_post!='' && ref_nonce!=''){
            ampforwp_refresh_related_post(ref_nonce, current_post);
        }
    }

    function ampforwp_refresh_related_post(ref_nonce='', current_post=''){
        var elem = document.getElementById("ref_rel_post_bar"); 
        var first_int = setInterval(first_frame, 1000);
        var width = current_post;
        width++; 
        elem.style.width = width + '%'; 
        elem.innerHTML = width * 1  + '%';
        function first_frame() {
            width++; 
            elem.style.width = width + '%'; 
            elem.innerHTML = width * 1  + '%';
        }  
       $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                    action:     'ampforwp_referesh_related_post',
                    verify_nonce: ref_nonce,
                    current_post: current_post,
                 },
            success: function(response){
                clearInterval(first_int);
                response = response.replace("}0", "}");
                var resp = JSON.parse(response);
                resp = parseInt(resp.response);
                var id = setInterval(frame, 10);
                var width = current_post;
                function frame() {
                    if (width >= resp) {
                        clearInterval(id);
                    } else {
                        width++; 
                        elem.style.width = width + '%'; 
                        elem.innerHTML = width * 1  + '%';
                        if(width == '100'){
                            $('#ampforwp-refersh-related-post').remove();
                            $('#redux_builder_amp-ampforwp-refersh-related-post .description').html('All the posts have been refreshed successfully.');
                        }
                    }
                }
            }
        });
    setTimeout(function(){
            var ref_nonce = ampforwp_get_cookie('ref_nonce');
            var current_post = ampforwp_get_cookie('current_post');
            if(current_post!='' && ref_nonce!='' && current_post<100){
                ampforwp_refresh_related_post(ref_nonce, current_post);
            }
        },30000);
    }

     $("#ampforwp-refersh-related-post").on('click', function(){
        var ref_nonce = $(this).attr('data-nonce');
        var current_post =  parseInt($(this).attr('data-id'));
        ampforwp_refresh_related_post(ref_nonce, current_post);
    }); 
    $(".redux_field_search").on( "keypress", function (evt) {
        //Deterime where our character code is coming from within the event
        var charCode = evt.charCode || evt.keyCode;
        if (charCode  == 13) { //Enter key's keycode
            return false;
        }
    });
    //option panel Section Division
    var optionSectionDevision = function(){
        $('.afw-accordion-header').on("click", function(){
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
           if(key>3 && jQuery(this).hasClass("otherSectionFields")){
                jQuery(this).attr("style","display:none;");
            }
        });

        jQuery( '.redux-group-tab-link-a' ).on("click", function(){
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
        switchText.siblings('label').on("click", function(){
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

            // Creating a select 
            var s = $('<select/>');
            var amp_font_selector = redux_data['amp_font_selector'];
            for (var i in allFonts) {

                var fontDetail = allFonts[i].fontFamily;                   
                var selected = '';
                if(amp_font_selector===fontDetail){
                    selected = 'selected';
                }
               $('#amp_font_selector-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'" '+ selected +'> '+ fontDetail  +' </option>'));
               $('#amp_font_selector-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'"> '+ fontDetail  +' </option>'));
               $('#amp_font_selector_content_single-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'"> '+ fontDetail  +' </option>'));
            }
            $('#amp_font_selector-select').append($('<option value="sans-serif" data-font-number="'+ i +'"> sans-serif </option>'));
            $('#amp_font_selector_content_single-select').append($('<option value="sans-serif" data-font-number="'+ i +'"> sans-serif </option>'));
            $('#amp_font_selector-select').append($('<option value="Segoe UI" data-font-number="'+ i +'"> Segoe UI </option>'));
            $('#amp_font_selector_content_single-select').append($('<option value="Segoe UI" data-font-number="'+ i +'"> Segoe UI </option>'));   
            $('#amp_font_selector-select, #amp_font_selector_content_single-select').on('change', function() {
                var select = $('option:selected', this).attr('data-font-number');
                var fontVariants = data.items[select].variants ;
                var fontFile = data.items[select].files ;

                if($(this).attr("id")=='amp_font_selector-select'){
                    if ( fontVariants) {
                        //$('.select2-search-choice').remove();
                        $('#amp_font_type-select').html('<option></option>').trigger('change');
                    }


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
                   // console.log(fontData);
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
    $('.redux-tab-selector').on("click", function(){
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
        $(".amp-ls-solve").each(function(k,v){
            var license = $(this).val();
            if(license){
                var patt = new RegExp("^([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)?$");
                if( patt.test(window.atob(license)) ){
                   license = window.atob(license);
                   $(this).val(license);
                }
            }
        });//$(".amp-ls-solve") each closed
   }
});
$(".redux-ampforwp-ext-activate").on("click", function(){
    var currentThis = $(this);
    var plugin_id = currentThis.attr("id");
    var secure_nonce = currentThis.parents("li").attr('data-ext-secure');
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
               plugin_active_path:plugin_active_path,
               verify_nonce: secure_nonce
                },
        dataType: 'json',
        success: function(response){
            currentThis.parents("li").find('.afw-license-response-message').remove();
            if(response.status=='200'){
                $('#redux_builder_amp_amp-license_'+plugin_id+'_license').remove();
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
function AMPforwpreadCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==" ") c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function deactivatelicence(){
    $(".ampforwp-ext-refresh").on("click", function(){
    var currentThis = $(this);
    var plugin_id = currentThis.attr("id");

    var today = new Date();
    var lastcheck = AMPforwpreadCookie('plugin_refresh_check');
    lastcheck = new Date(lastcheck);
    console.log(lastcheck+ " true");
    var diffDays = -1;
    if( typeof lastcheck != undefined){
        var diffTime = Math.abs(today.getTime() - lastcheck.getTime());
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
    }
     var expireDate = new Date(jQuery('[name="redux_builder_amp[amp-license]['+plugin_id+'][all_data][expires]"]').val());
    var diffTime = Math.abs( expireDate.getTime()-today.getTime() );
    var expireDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
    if(diffDays==-1 || diffDays>1 || expireDays<1){
        currentThis.text("Please wait...")
        document.cookie = "plugin_refresh_check="+today;
        var secure_nonce = currentThis.parents("li").attr('data-ext-secure');
        $.ajax({
                url: ajaxurl,
                method: 'post',
                data: {action: 'ampforwp_get_licence_activate_update',
                        update_check: 'yes',
                       ampforwp_license_activate:plugin_id,
                       verify_nonce: secure_nonce
                        },
                dataType: 'json',
                success: function(response){
                    currentThis.parents("li").find(".license-tenure").text('')
                    currentThis.parents("li").find('.afw-license-response-message').remove();
                    if(response.status=='200'){
                        var expireData = new Date(response.other.all_data.expires);
                        var today = new Date();
                        var diffTime = Math.abs( expireData.getTime()-today.getTime() );
                        var expireDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                        currentThis.parents("li").find(".license-tenure").text(expireDays+" Days Remaining")
                    }else{
                        currentThis.parents("li").find('.license-tenure').text(response.message);
                    }
                }
            })
        currentThis.html('<i class="dashicons-before dashicons-update"></i>Refresh');

     }else{  
        $(".dashicons").addClass( 'spin' );
        setTimeout( function() {
            $(".dashicons").removeClass( 'spin' );}, 3000 );   
        lastcheck = Math.abs(lastcheck.getDate()+1)+'/'+Math.abs(lastcheck.getMonth()+1) +'/'+lastcheck.getFullYear()+' '+lastcheck.getHours()+':'+lastcheck.getMinutes()+':'+lastcheck.getSeconds();
        alert('Please try after '+ lastcheck);
    }
});

        // Start Refresh and check if user has done renewal in between 0-7 Days & when Expired
        var ap = document.getElementById("active-plugins-dr"); 
        if (ap) {
        var remainingdays = ap.getAttribute("data-days");
        }
        if (  remainingdays <= 7 ){
            setTimeout(function () {
                jQuery("#refresh_expired_addon").trigger("click");
            }, 0);
        }

        $(".days_remain").click(function(){
            var currentThis = $(this);
            var plugin_id = currentThis.attr("id");
            jQuery("#refresh_expired_addon").addClass( 'spin' );

            var secure_nonce = currentThis.attr('data-nonce');
            $.ajax({
                url: ajaxurl,
                method: 'post',
                data: {action: 'ampforwp_get_licence_activate_update',
                        update_check: 'yes',
                       ampforwp_license_activate:plugin_id,
                       verify_nonce: secure_nonce
                        },
                dataType: 'json',
                success: function(response){
                    jQuery("#refresh_expired_addon").removeClass( 'spin' );
                    if(response.status=='200'){
                        var expireData = new Date(response.other.all_data.expires);
                        var today = new Date();
                        var diffTime = Math.abs( expireData.getTime()-today.getTime() );
                        var expireDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                        if (expireDays > 30) {
                            $("span.before_msg_active").text('Your License is')
                            $("span.lthan_0").text('Your License is')
                            $(".lessthan_30,.pro_warning,.dashicons-no,.renewal-license,.ampforwp-addon-alert,.ooy").css("display","none")
                            $("span.one_of_expired").text('Active')
                            $(".one_of_expired,.expiredinner_span,.lthan_0").css("color","green")
                            $("span.expiredinner_span").text('Active')
                        }
                    }else{
                        jQuery("#refresh_expired_addon").removeClass( 'spin' );
                    }
                }
            })

            $.ajax({
                url: ajaxurl,
                method: 'post',
                data: {action: 'ampforwp_set_license_transient',
                        update_check: 'yes',
                       verify_nonce: secure_nonce
                        },
                dataType: 'json',
                        success: function (s) {
                            JSON.parse(s);
                        },
                    });
        });
    // End Refresh to check if user has done renewal in between 0-7 Days & when Expired

    // Start User Refresh when expired 
       $(".user_refr").click(function(){
        var currentThis = $(this);
        var plugin_id = currentThis.attr("id");
        jQuery("#user_refr_addon").addClass( 'spin' );         
        var secure_nonce = currentThis.attr('data-nonce');

        $.ajax({
                url: ajaxurl,
                method: 'post',
                data: {action: 'ampforwp_get_licence_activate_update',
                        update_check: 'yes',
                       ampforwp_license_activate:plugin_id,
                       verify_nonce: secure_nonce
                        },
                dataType: 'json',
                success: function(response){
                    jQuery("#user_refr_addon").removeClass( 'spin' );
                    if(response.status=='200'){
                        var expireData = new Date(response.other.all_data.expires);
                        var today = new Date();
                        var diffTime = Math.abs( expireData.getTime()-today.getTime() );
                        var expireDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                        if (expireDays > 30) {
                            $("span.before_msg_active").text('Your License is')
                            $(".lessthan_30,.pro_warning,.dashicons-no,.renewal-license").css("display","none")
                            $("span.one_of_expired").text('Active')
                            $("span.one_of_expired").css("color","green")
                        }
                    }else{
                        jQuery("#user_refr_addon").removeClass( 'spin' );
                    }
                }
            })
    });
    // End User Refresh when Expired
    var extmnger = document.querySelector('a[extmnger_data="1"]');
if (extmnger) {
    var tamp_options = document.getElementById("toplevel_page_amp_options");
    let collection = tamp_options.querySelectorAll(".wp-submenu a");
    collection.forEach((ele, ind) => {
        let p = ele.parentNode;
      let p_ind = Array.from(document.querySelectorAll('.wp-submenu')).indexOf(p);
      ind++;
      p_ind++;
      ele.addEventListener('click', function(){
            if (ele.innerText == 'Extensions') {
        window.location.href = "admin.php?page=amp-extension-manager"
    }
}
)
  })
}

$(".redux-ampforwp-ext-deactivate").on("click", function(){
    var currentThis = $(this);
    var plugin_id = currentThis.attr("id");
    var secure_nonce = currentThis.parents("li").attr('data-ext-secure');
    currentThis.html("Please Wait...");
    $deactivateConfirm = confirm("Are you sure you want to Deactivate ?");
    if($deactivateConfirm){
        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {action: 'ampforwp_deactivate_license', ampforwp_license_deactivate:plugin_id,
                verify_nonce: secure_nonce
                },
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
    $( '.redux-group-tab-link-a' ).on("click", function(){
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

    $("#meta-checkbox").on("click", function(){ 
           ampforwp_check_custom_content_status($(this));
    });
    ampforwp_check_custom_content_status($("#meta-checkbox")); 
    function ampforwp_check_custom_content_status(checker){ 
      if (checker.prop('checked')==true){
            $('.amp-editor-content').show();
            var content = $('#ampforwp_custom_content_editor').val();
            if(content !== ''){
                $('.amp-editor-content').hide();
            }               
       }
       else{  
          $('.amp-editor-content').hide();
       }
    }

    $("#ampforwp_custom_content_editor").on("keyup change paste",function(){
        if($(this).val()!=""){
            $('.amp-editor-content').hide();
        }else{
            $('.amp-editor-content').show();
        }
        if($("#meta-checkbox").prop('checked')==false){
            $('.amp-editor-content').show();
            $("#ampforwp-amp-content-error-msg").html('Please select the "<b>Use This Content as AMP Content</b>" checkbox above before update.');
            if($(this).val()==""){
                $('.amp-editor-content').hide();
                $("#ampforwp-amp-content-error-msg").html("AMP contents is blank, Please enter content");
            }
        }else{
            $("#ampforwp-amp-content-error-msg").html("AMP contents is blank, Please enter content");
        }
    });

    if($(".amp-preview-button").length>0){
        $(".amp-preview-button").on("click", function(){
            var srcLink = $("#amp-preview-iframe").attr('data-src');
           $("#amp-preview-iframe").html("<iframe  src='"+srcLink+"'></iframe>");
        });
    }

});

function getQueryStringValue (key) {  
  return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
}  

jQuery(document).ready(function($){
    // Dismiss button functionlaity
    $('#ampforwp-wizard-notice').on('click', 'button', function(){
        var notice = {
            'action': 'ampforwp_notice_delete',
        };
        jQuery.post(ajaxurl, notice, function(response) {     
        });
    });

    if(redux_data.ampforwp_css_tree_shaking == '0'){
        jQuery('#ampforwp-clear-clearcss-data').addClass('hide');
        jQuery('#ampforwp-clear-clcss-msg').html('Please Save Before Clearing Cache');
    }
        $('#ampforwp-clear-clearcss-data').click(function(e){
            $('#ampforwp-clear-clcss-msg').removeClass('hide');
        $('#ampforwp-clear-clcss-msg').text(' Please wait').css({'line-height':'25px'});
        var datastr = {
            'action': 'ampforwp_clear_css_tree_shaking',
            'nonce': $(this).attr('data-nonce')
        };
        jQuery.ajax({
            url: ajaxurl,
            data: datastr,
            dataType: 'json',
            success: function(response) {
                if(response.status==200){
                    $('#ampforwp-clear-clcss-msg').text(' '+response.message).css({'line-height':'25px'});
                }
            }
        });
    });
    // AMP FrontPage notice in Reading Settings #2348
    if ( 'false' == redux_data.frontpage){
        $('#page_on_front').parent('label').append('<p class="afp" style="margin-left:10px;display:none"><span>We have detected that you have not setup the FrontPage for AMP, </span><a href="'+redux_data.admin_url+'">Click here to setup</a></span>');
    }
    $('#front-static-pages input[type=radio][name=show_on_front]').on('change', function(e) {
       if ( this.value == 'page') {
        $('.afp').show();
       } else {
        $('.afp').hide();
       }
    });
    var sfp  = $('#front-static-pages input[type=radio][checked=checked]');
    if ( sfp[0] ) {
        if(sfp[0].value == 'page'){
            $('.afp').show();
        }
    }

});//(document).ready Closed

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
            var pb2 = jQuery('input[name="ampforwp_page_builder_enable"]:checked').val();
            if ( takeover == 1 && 'yes' == pb2 ) {
                data = pbdata;
            }
        }
        return data;
    };
    new AmpForWpYoastAnalysis();
}); 
jQuery(document).ready(function($){
    $("#redux_builder_amp-swift-sidebar").on( 'change', function(){
        var value = $('#redux_builder_amp-swift-sidebar #swift-sidebar').val();
        if(value == 1){
        $("#single-design-type_2").attr('checked', true);
        }else {
            $("#single-design-type_1").attr('checked', true);
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
});

// AMPforWP New UX #3520
jQuery(document).ready(function($) {
    setTimeout(function(){
        var cls = $('.ampforwp-new-ux' ).hasClass('active');
        if(cls){
            $('#redux-footer-sticky').hide();
        }
    },10);
    $(".redux-group-tab-link-li").on("click", function(){
        var this_c_val = $(this).children('a').children('span.group_title').html();
        if($(this).hasClass('ampforwp-new-ux') || $(this).hasClass('opt-go-premium')){
            $('#redux-footer-sticky').hide();
            $('#redux-footer-sticky #redux-footer').addClass("hide");
        }else{
            $('#redux-footer-sticky').show();
            $('#redux-footer-sticky #redux-footer').removeClass("hide");
            
        }
         // There is no save button in AMP "Basic setup" #4343
        var selected = $(".amp-opt-change:checked").parent().find('label').attr('id');
        if(selected=='basic'){
            if(!$(this).hasClass('ampforwp-new-ux') && !$(this).hasClass('opt-go-premium')){
                $('#redux-footer-sticky').show();
                $('#redux-footer-sticky #redux-footer').removeClass("hide");
                
               
            }else{
                $('#redux-footer-sticky').hide();
                $('#redux-footer-sticky #redux-footer').addClass("hide");
            }
        }
    });
     var new_data = JSON.parse(amp_fields);
    var ampforwp_saveChangesInRedux = function($current){
       
        // Save
        window.onbeforeunload = null;
        if ( redux.args.ajax_save === true ) {
            setTimeout(function(){
                $.redux.ajax_save( $current, true );
            },1);
        }
        
    }
    var ampCheckRequired = function($current){
        var self = $current;
        var current_id = self.attr('id');
        var current_value = self.val();
        var new_data = JSON.parse(amp_fields);
        if( self.attr('type') == 'checkbox' ) {
            if(self.prop("checked") == true){
                current_value = 1;
            }
            else if(self.prop("checked") == false){
                current_value = 0;
            }
        }

     $.each(new_data, function(key,value) {
            if (value.field_data.required ){
                var required = value.field_data.required;
                var child_element = $('#'+value.field_data.id);
                var check = true;
                switch(required[1]){
                    case '=':
                        if( required[0] == current_id){
                            if(  required[2] == current_value){
                                if( value.field_type == 'checkbox' ) {
                                    $(child_element).parent().parent('div').removeClass('hide');
                                }
                                else{

                                    $(child_element).parent('div').removeClass('hide');
                                }
                            }
                            else{
                                if( value.field_type == 'checkbox' ) {
                                    $(child_element).parent().parent('div').addClass('hide');
                                }
                                else{
                                    $(child_element).parent('div').addClass('hide');
                                }
                            }
                        }
                    break;

                    case '!=':
                        if( required[0] == current_id ) {
                            if(required[2] != current_value){
                                $(child_element).parent('div').removeClass('hide');
                            }
                            else{
                                $(child_element).parent('div').addClass('hide');
                            }
                        }
                    break;

                    case 'in_array':
                        if( required[0] == current_id ){
                            if(jQuery.inArray(current_value,required[2]) ){
                                $(child_element).parent('div').removeClass('hide');
                            }
                            else{
                                $(child_element).parent('div').addClass('hide');
                            }
                        }
                    break;

                    default:
                    break;
                }
            }
    });
 };
 // Color Picker
    $('div.amp-ux-color-container').find('input').wpColorPicker({});
    function hexToRgbA(hex){
        var c;
        if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
            c= hex.substring(1).split('');
            if(c.length== 3){
                c= [c[0], c[0], c[1], c[1], c[2], c[2]];
            }
            c= '0x'+c.join('');
            return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
        }
        throw new Error('Bad Hex');
    }
    $('#section-table-ampforwp-ux-website-type-section').addClass('drawer');
     $('div.ampforwp-new-ux').find('div.ampforwp-ux-section-right').each(function(){
        var selector = 'data-id="'+$(this).attr('id').replace('section-','')+'"';
        
        $(this).parent().find($('table['+selector+']')).addClass('drawer');
        
    });
    $('.redux-group-menu').find('.redux-group-tab-link-li').each(function(){
        $(this).on('click', function(){
            if($(this).hasClass('ampforwp-new-ux')){
                $('div.sticky-footer-fixed').addClass('hide');
            }
            else{
                $('div.sticky-footer-fixed').removeClass('hide');
            }
        });
    });
    function ampforwp_set_ux_selected_val(){
        var active_drower = localStorage.getItem('ampforwp_current_drawer_click');
        var thishtml = "";
        var button = '';
        if(active_drower=='ampforwp-ux-website-type-section'){
              thishtml = $("#ampforwp-ux-select option:selected").text();
              if(thishtml=="Select Option"){
                    thishtml="";
              }
              if(thishtml=="Other"){
                    thishtml = $("#ampforwp-website-type-other").val();
              }
              button = "SELECT";
        }else if(active_drower=='ampforwp-ux-need-type-section'){
              var need_type_arr = [];
              $(".amp-ux-field").each(function(){
                    var thisid = $(this).attr('id');
                    if(thisid=="amp-ux-homepage" || thisid=="amp-ux-frontpage" || thisid=="amp-ux-posts" || thisid=="amp-ux-pages" || thisid=="amp-ux-archives"){
                        if($(this).prop('checked')){
                           if(thisid=="amp-ux-homepage"){
                                need_type_arr.push('Home');
                           }else if(thisid=="amp-ux-posts"){
                                need_type_arr.push('Posts');
                           }else if(thisid=="amp-ux-pages"){
                                need_type_arr.push('Pages');
                           }else if(thisid=="amp-ux-archives"){
                                need_type_arr.push('Archives');
                           }
                        }
                    }
                    thishtml = need_type_arr.toString().replace(/,/g, ", ");
              });
              button = "CHOOSE";
        }else if(active_drower=='ampforwp-ux-design-section'){
            thishtml = "Configured";
            button = "SET UP";
        }else if(active_drower=='ampforwp-ux-analytics-section'){
            var ga_field       = $('#ga-feild').val();
            var ga_field_gtm    = $('#amp-gtm-id').val();
            var amp_fb_pixel_id = $('#amp-fb-pixel-id').val();
            var sa_feild = $('#sa-feild').val();
            var pa_feild = $('#pa-feild').val();
            var quantcast_c = $('#amp-quantcast-analytics-code').val();
            var comscore_c1 = $('#amp-comscore-analytics-code-c1').val();
            var comscore_c1 = $('#amp-comscore-analytics-code-c2').val();
            var eam_c = $('#eam-feild').val();
            var sc_c = $('#sc-feild').val();
            var histats_c = $('#histats-field').val();
            var yemdex_c = $('#amp-Yandex-Metrika-analytics-code').val();
            var chartbeat_c = $('#amp-Chartbeat-analytics-code').val();
            var alexa_c = $('#ampforwp-alexa-account').val();
            var alexa_d = $('#ampforwp-alexa-domain').val();
            var afs_c = $('#ampforwp-afs-siteid').val();
            var clicky_side_id = $('#clicky-site-id').val();
            var cr_config_url = $('#ampforwp-callrail-config-url').val();
            var cr_number = $('#ampforwp-callrail-number').val();
            var cr_analytics_url = $('#ampforwp-callrail-analytics-url').val();
            var analytics_txt = "";
            var analytic_arr = [];
             $(".ampforwp-ux-ana-sub").each(function(){
                var data_href = $(this).attr('data-href');
                var hasCls  = $(this).hasClass('hide');
                if(ga_field!="UA-XXXXX-Y" && ga_field!="" && !hasCls && data_href=='ampforwp-ga-switch'){analytic_arr.push("Google Analytics");}
                if(ga_field_gtm!="" && !hasCls && data_href=='amp-use-gtm-option'){analytic_arr.push("Google Tag Manager");}
                if(amp_fb_pixel_id!="" && !hasCls && data_href=='amp-fb-pixel'){analytic_arr.push("Facebook Pixel");}
                if(sa_feild!="SEGMENT-WRITE-KEY" && sa_feild!="" && !hasCls && data_href=='ampforwp-Segment-switch'){analytic_arr.push("Segment Analytics");}
                if(pa_feild!="#" && pa_feild!="" && !hasCls && data_href=='ampforwp-Piwik-switch'){ analytic_arr.push("Matomo Analytics");}
                if(quantcast_c!="" && !hasCls && data_href=='ampforwp-Quantcast-switch'){ analytic_arr.push("Quantcast Measurement");}
                if(comscore_c1!="" && comscore_c1!="" && !hasCls && data_href=='ampforwp-comScore-switch'){analytic_arr.push("comScore");}
                if(eam_c!="#" && eam_c!="" && !hasCls && data_href=='ampforwp-Effective-switch'){analytic_arr.push("Effective Measure");}
                if(sc_c!="#" && sc_c!="" && !hasCls && data_href=='ampforwp-StatCounter-switch'){analytic_arr.push("StatCounter");}
                if(histats_c!="" && !hasCls && data_href=='ampforwp-Histats-switch'){analytic_arr.push("Histats Analytics");}
                if(yemdex_c!="" && !hasCls && data_href=='ampforwp-Yandex-switch'){analytic_arr.push("Yandex Metrika");}
                if(chartbeat_c!="" && !hasCls && data_href=='ampforwp-Chartbeat-switch'){analytic_arr.push("Chartbeat Analytics");}
                if(alexa_c!="" && alexa_d!="" && !hasCls && data_href=='ampforwp-Alexa-switch'){analytic_arr.push("Alexa Metrics");}
                if(afs_c!="" && !hasCls && data_href=='ampforwp-afs-analytics-switch'){analytic_arr.push("AFS Analytics");}
                if(clicky_side_id!="" && !hasCls && data_href=='amp-clicky-switch'){analytic_arr.push("Clicky Analytics");}
                if(cr_config_url!="" && cr_number!="" && cr_analytics_url!="" && !hasCls && data_href=='ampforwp-callrail-switch'){analytic_arr.push("Call Rail Analytics");}
            });
            thishtml = analytic_arr.toString().replace(/,/g, ", ");
            button = "CONFIG";
        }else if(active_drower=='ampforwp-ux-privacy-section'){
             var cookie_switch = $("#amp-ux-notice-switch").val();
            var gdpr_switch = $("#amp-ux-gdpr-switch").val();
            var policy_arr = [];
            if(cookie_switch==1){
                policy_arr.push("Cookie Consent");
            }
            if(gdpr_switch==1){
                policy_arr.push("GDPR");
            }
            thishtml = policy_arr.toString().replace(/,/g, ", ");
            button = "CHOOSE";
      

        }
        var option = '';
        if(thishtml!=""){
             option = '<div class="filled-lbl-blk">'+
                            '<p class="msg">'+thishtml+'</p>'+
                            '<span class="lbl">Change</span>'+
                        '</div>';
        }else{
             option = '<div class="button btn-red">'+button+'</div>';
        }
        if("ampforwp-ux-thirdparty-section" !=active_drower){
            $("[data-href="+active_drower+"]").find("div.amp-ux-elem-but-block").html(option);
        }
         var has_warning = false;
         $(".amp-ux-valid-require").each(function(){
             if($(this).children().hasClass('btn-red')){
                has_warning = true;
             }
        });
        if(has_warning){
            $(".ux-setup-icon").removeClass("amp-ux-warning-okay");
            $(".ux-setup-icon").addClass("amp-ux-warning");
        }else{
            $(".ux-setup-icon").removeClass("amp-ux-warning");
            $(".ux-setup-icon").addClass("amp-ux-warning-okay");
        }
    }
    $("#ampforwp-prem-upg-to").on("click", function(){
        $(".redux-group-tab-link-a").each(function(){
            var id = $(this).attr('data-key');
            var thischildelem = $(this).children('.group_title').html();
            if(thischildelem.toLowerCase()=='upgrade to pro'){
                $("#"+id+"_section_group_li").click();
                $("#"+id+"_section_group_li_a").click();
                return false;
            }
        });
    }); 
    $("#ampforwp-goto-analytics").on("click", function(){
        $(".redux-group-tab-link-a").each(function(){
            var id = $(this).attr('data-key');
            var thischildelem = $(this).children('.group_title').html();
            var par = 2;
            if(thischildelem.toLowerCase()=="settings"){
                par = id;
            }
            if(thischildelem.toLowerCase()=='analytics'){
                $("#"+par+"_section_group_li").click();
                $("#"+id+"_section_group_li_a").click();
                return false;
            }
        });
    }); 
     $("[data-href=ampforwp-ux-advertisement-section]").on("click", function(){
       $(".redux-group-tab-link-a").each(function(){
            var id = $(this).attr('data-key');
            var thischildelem = $(this).children('.group_title').html();
            var par = 2;
            if(thischildelem=="Settings"){
                par = id;
            }
            if(thischildelem=='Advertisement'){
                $("#"+par+"_section_group_li").click();
                $("#"+id+"_section_group_li_a").click();
                return false;
            }
        });
    });
    // Website type
    $('#ampforwp-ux-select').on('change', function(e){
        var thisvalue = $(this).val();
        // Update Values in Structured data
        $("#ampforwp-setup-ux-website-type").val(thisvalue);
        if(thisvalue!="Local Business" && thisvalue!="Other"){
            $("#ampforwp-website-type-other").hide();
            $(".ux-other-site-type").hide();
            $("#ampforwp-website-type-other").val("");
            //Posts
            if($("select[id=ampforwp-sd-type-posts-select]").val()!=undefined){
                $("select[id=ampforwp-sd-type-posts-select]").val(thisvalue);
                $("span[id=select2-ampforwp-sd-type-posts-select-container]").text($(this).val());
            }else{
                $("select[id=ampforwp-sd-type-category-select]").val(thisvalue);
                $("span[id=select2-ampforwp-sd-type-category-select-container]").text($(this).val());
            }
        }else{
            if(thisvalue=="Other"){
                $(".ux-other-site-type").show();
                $("#ampforwp-website-type-other").show();
            }else{
                $("#ampforwp-website-type-other").hide();
                $(".ux-other-site-type").hide();
            }
        }
    });

    $("#ampforwp-ux-seo-select").on('change', function(e){
        var thisvalue = $(this).val();
        $("select[id=ampforwp-seo-selection-select]").val(thisvalue);
        $("span[id=select2-ampforwp-seo-selection-select-container]").text($(this).val());
    });

    $("#ampforwp-website-type-other").on('change',function(){
            var thisval = $(this).val();
            if(thisval==""){
                thisval = "Other-WebPage";
            }else{
                thisval = "Other-"+thisval;
            }
            $("#ampforwp-setup-ux-website-type").val(thisval);
    });

    // Homepage
    $('input[id="amp-ux-homepage"]').on("click", function(){
        if($(this).prop("checked") == true){
            $('.amp-ux-frontpage').show();
            $(this).attr('value', 1);
            if($('input[id="ampforwp-homepage-on-off-support"]').val() != 1 ) {
                $("input[data-id=ampforwp-homepage-on-off-support]").prop('checked', true).trigger( 'change' );
                $("input[id=ampforwp-homepage-on-off-support]").val(1);
            }
        }
        else if($(this).prop("checked") == false){
            $('.amp-ux-frontpage').hide();
            $("input[data-id=ampforwp-homepage-on-off-support]").prop('checked', false).trigger( 'change' );
            $("input[id=ampforwp-homepage-on-off-support]").val(0);
        }
        
    });
    // Frontpage
     $('input[id="amp-ux-frontpage"]').on("click", function(){
        if($(this).prop("checked") == true){
            // FrontPage
            $("input[data-id=amp-frontpage-select-option]").prop('checked', true).trigger( 'change' );
            $("input[id=amp-frontpage-select-option]").val(1);
            $('.amp-ux-frontpage-select').removeClass('hide');
        }
        else if($(this).prop("checked") == false ){
             $('.amp-ux-frontpage-select').addClass('hide');
             $("input[data-id=amp-frontpage-select-option]").prop('checked', false).trigger( 'change' );
            $("input[id=amp-frontpage-select-option]").val(0);
        }
    });
    $('.amp-ux-frontpage-select').on('change', function(e){
        var thisvalue = $(this).val();
        var thistxt = $('option[value='+'"'+thisvalue+'"]').html();
        if(thistxt!='undefined'){
          
            $("select[id=amp-frontpage-select-option-pages-select]").val($(this).val());
           
         
            $("span[id=select2-amp-frontpage-select-option-pages-select-container]").show().text(thistxt);
        }
    });
    // Posts
    $('#amp-ux-posts').on("click", function(){
        if($(this).prop("checked") == true){
            if($('input[id="amp-on-off-for-all-posts"]').val() != 1 ) {
                $("input[data-id=amp-on-off-for-all-posts]").prop('checked', true).trigger( 'change' );
                $("input[id=amp-on-off-for-all-posts]").val(1);
            }
        }
        else if( $(this).prop("checked") == false && $('input[id="amp-on-off-for-all-posts"]').val() == 1 ){
            $("input[data-id=amp-on-off-for-all-posts]").prop('checked', false).trigger( 'change' );
            $("input[id=amp-on-off-for-all-posts]").val(0);
        }
    });
    // Pages
    $('input[id="amp-ux-pages"]').on("click", function(){
        if($(this).prop("checked") == true){
            if($('input[id="amp-on-off-for-all-pages"]').val() != 1 ) {
                $("input[data-id=amp-on-off-for-all-pages]").prop('checked', true).trigger( 'change' );
                $("input[id=amp-on-off-for-all-pages]").val(1);
            }
        }
        else if( $(this).prop("checked") == false && $('input[id="amp-on-off-for-all-pages"]').val() == 1 ){
            $("input[data-id=amp-on-off-for-all-pages]").prop('checked', false).trigger( 'change' );
            $("input[id=amp-on-off-for-all-pages]").val(0);
        }
    });
    // Archives
    $('input[id="amp-ux-archives"]').on("click", function(){
        if($(this).prop("checked") == true){
            if($('input[id="ampforwp-archive-support"]').val() != 1 ) {
                $("input[data-id=ampforwp-archive-support]").prop('checked', true).trigger( 'change' );
                $("input[id=ampforwp-archive-support]").val(1);
            }
        }
        else if( $(this).prop("checked") == false && $('input[id="ampforwp-archive-support"]').val() == 1 ){
            $("input[data-id=ampforwp-archive-support]").prop('checked', false).trigger( 'change' );
            $("input[id=ampforwp-archive-support]").val(0);
        }
    });
    $(".toplevel_page_amp_options").on('mouseover', function(){
            if(amp_option_panel_view==31){
                $("#toplevel_page_amp_options .wp-submenu.wp-submenu-wrap li").each(function(){
                    var t_e_c_v = $(this).children('a').html();
                    if(t_e_c_v=="Settings" || t_e_c_v=="Design" || t_e_c_v=="Extensions" || t_e_c_v=="Upgrade to Pro" || t_e_c_v=="Import / Export"){
                        $(this).hide();
                    }
                });
            }
    });
    // Design and Presentation Section
    $('.media-amp-ux-opt-media' ).off().on(
        'click', function( event ) {
            redux.field_objects.media.addFile( event, $( this ).parents( 'div.amp-ux-opt-media-container:first' ) );
             $('.media-button-select').on('click', function(){
                if ( $('#amp-ux-opt-media-url').val() != '' ){
                    $('input[id="redux_builder_amp[opt-media][url]"]').val($('#amp-ux-opt-media-url').val());
                    $('input[id="redux_builder_amp[opt-media][height]"]').val($('#amp-ux-logo-height').val());
                    $('input[id="redux_builder_amp[opt-media][width]').val($('#amp-ux-logo-width').val());
                    $('input[id="redux_builder_amp[opt-media][thumbnail]').val($('#amp-ux-logo-thumb').val());
                    $('#redux_builder_amp-opt-media .screenshot').show();
                    $('.redux-option-image').attr('src', $('#amp-ux-logo-thumb').val());
                    ampforwp_saveChangesInRedux($(this));
                    ampforwp_set_ux_selected_val();
                    $("#opt-media-media").html("Change Logo");
                    $(".amp-ux-upload").addClass('amp-ux-chng-lg');
                }
            });
        }
    );
    // Global Color Scheme
    $('.amp-ux-color-container .iris-picker').on('focusout',function(){
        var color = $('.amp-ux-color-scheme').val();
        var bgcolor = $('.amp-ux-color-container .wp-color-result').css('background-color');
        var rgba = hexToRgbA(color);
        $('fieldset[data-id="swift-color-scheme"] .sp-preview-inner').css('background-color', bgcolor);
        $('input[data-id="swift-color-scheme-rgba"]').val(rgba);
        $('input[id="swift-color-scheme-color"]').attr('data-color',rgba);
        $('input[id="swift-color-scheme-color"]').attr('data-current-color',color);
        $('input[id="swift-color-scheme-color"]').attr('value',color);
        ampforwp_saveChangesInRedux($(this));
    });
    // Analytics
    $('.ampforwp-ux-analytics-select').on('change', function(){
        var id = $(this).val();
        var previousID = $('#amp-ux-analytics-hidden');
        if($('input[id="'+id+'"]').val() != 1 ) {
            $('input[data-id="'+id+'"]').prop('checked', true).trigger( 'change' );
            $('input[id="'+id+'"]').val(1);
        }
        if( id != previousID.val() && $('input[id="'+previousID.val()+'"]').val() == 1 ) {
            $('input[data-id="'+previousID.val()+'"]').prop('checked', false).trigger( 'change' );
            $('input[id="'+previousID.val()+'"]').val(0);
        }
         previousID.val($(this).val());
        $('#amp-analytics-select-option-select').val($(this).children('option:selected').attr('data-num'));
    });
     $('.analytics-text').on('change', function(){
        var id = $(this).attr('data-text');
        $('input[id="'+id+'"]').val($(this).val());
        var data_href = $(this).closest('.ampforwp-ux-ana-sub').attr('data-href');
        ampforwp_check_analytics(data_href);
    });
     function ampforwp_check_analytics(data_href){
        var ga_field       = $('#ga-feild').val();
        var ga_field_gtm       = $('#amp-gtm-id').val();
        var amp_fb_pixel_id = $('#amp-fb-pixel-id').val();
        var sa_feild = $('#sa-feild').val();
        var pa_feild = $('#pa-feild').val();
        var quantcast_c = $('#amp-quantcast-analytics-code').val();
        var comscore_c1 = $('#amp-comscore-analytics-code-c1').val();
        var comscore_c1 = $('#amp-comscore-analytics-code-c2').val();
        var eam_c = $('#eam-feild').val();
        var sc_c = $('#sc-feild').val();
        var histats_c = $('#histats-field').val();
        var yemdex_c = $('#amp-Yandex-Metrika-analytics-code').val();
        var chartbeat_c = $('#amp-Chartbeat-analytics-code').val();
        var alexa_c = $('#ampforwp-alexa-account').val();
        var alexa_d = $('#ampforwp-alexa-domain').val();
        var afs_c = $('#ampforwp-afs-siteid').val();
        var clicky_side_id = $('#clicky-site-id').val();
        var cr_config_url = $('#ampforwp-callrail-config-url').val();
        var cr_number = $('#ampforwp-callrail-number').val();
        var cr_analytics_url = $('#ampforwp-callrail-analytics-url').val();
        var analytics_txt = "";
        var checked = $('#redux_builder_amp-'+data_href).children('.switch-options').children('.ios7-switch').children('.switch-on-off').prop('checked');

        if(data_href=='ampforwp-ga-switch'){
            if(ga_field!="UA-XXXXX-Y" && ga_field!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(ga_field=="UA-XXXXX-Y" || ga_field==""){
                if(checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
            }else if(data_href=='amp-use-gtm-option'){
            if(ga_field_gtm!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(ga_field_gtm==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='amp-fb-pixel'){
            if(amp_fb_pixel_id!=""){
                 if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(amp_fb_pixel_id==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Segment-switch'){
            if(sa_feild!="SEGMENT-WRITE-KEY" && sa_feild!=""){
               if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(sa_feild=="SEGMENT-WRITE-KEY" || sa_feild==""){
               if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Piwik-switch'){
            if(pa_feild!="#" && pa_feild!=""){
                if(!checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(pa_feild=="#" || pa_feild==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Quantcast-switch'){
            if(quantcast_c!=""){ 
                if(!checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(quantcast_c==""){ 
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-comScore-switch'){
            if(comscore_c1!="" && comscore_c1!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(comscore_c1=="" || comscore_c1==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Effective-switch'){
            if(eam_c!="#" && eam_c!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(eam_c=="#" || eam_c==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-StatCounter-switch'){
            if(sc_c!="#" && sc_c!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(sc_c=="#" || sc_c==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Histats-switch'){
            if(histats_c!=""){
               if(!checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(1);
               }
            }else if(histats_c==""){
               if(checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(0);
               }
            }
        }else if(data_href=='ampforwp-Yandex-switch'){
            if(yemdex_c!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(yemdex_c==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Chartbeat-switch'){
            if(chartbeat_c!=""){
                if(!checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(chartbeat_c==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-Alexa-switch'){
            if(alexa_c!="" && alexa_d!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(alexa_c=="" && alexa_d==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-afs-analytics-switch'){
            if(afs_c!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(afs_c==""){
                if(checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='amp-clicky-switch'){
            if(clicky_side_id!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(clicky_side_id==""){
                if(checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }else if(data_href=='ampforwp-callrail-switch'){
            if(cr_config_url!="" && cr_number!="" && cr_analytics_url!=""){
                if(!checked){
                    $('input[data-id="'+data_href+'"]').click();
                    $('[name="redux_builder_amp['+data_href+']"]').val(1);
                }
            }else if(cr_config_url=="" && cr_number=="" && cr_analytics_url==""){
                if(checked){
                   $('input[data-id="'+data_href+'"]').click();
                   $('[name="redux_builder_amp['+data_href+']"]').val(0);
                }
            }
        }
    }
    // Privacy Settings Section
    $('input[id="amp-ux-notice-switch"]').on("click", function(){
        if($(this).prop("checked") == true){
            $(this).val(1);
            if($('input[id="amp-enable-notifications"]').val() != 1 ) {
                $("input[data-id=amp-enable-notifications]").prop('checked', true).trigger( 'change' );
                $("input[id=amp-enable-notifications]").val(1);
              
            }
            if($('input[id="amp-ux-gdpr-switch"]').val() == 1 ) {
                $("input[data-id=amp-ux-gdpr-switch]").prop('checked', false).trigger( 'change' );
                $("input[id=amp-amp-ux-gdpr-switch]").val(0);
            }
            if($('input[id="amp-gdpr-compliance-switch"]').val() == 1 ) {
                $("input[data-id=amp-gdpr-compliance-switch]").prop('checked', false).trigger( 'change' );
                $("input[id=amp-gdpr-compliance-switch]").val(0);
            }
        }
        else if( $(this).prop("checked") == false && $('input[id="amp-enable-notifications"]').val() == 1 ){
            $("input[data-id=amp-enable-notifications]").prop('checked', false).trigger( 'change' );
            $("input[id=amp-enable-notifications]").val(0);
            $(this).val(0);
        }
        
    });
    
    $('input[id="amp-ux-gdpr-switch"]').on("click", function(){
        if($(this).prop("checked") == true){
            $(this).val(1);
            if($('input[id="amp-gdpr-compliance-switch"]').val() != 1 ) {
                $("input[data-id=amp-gdpr-compliance-switch]").prop('checked', true).trigger( 'change' );
                $("input[id=amp-gdpr-compliance-switch]").val(1);
            }
             if($('input[id="amp-ux-notice-switch"]').val() == 1 ) {
                $("input[data-id=amp-ux-notice-switch]").prop('checked', false).trigger( 'change' );
                $("input[id=amp-ux-notice-switch]").val(0);
            }
            if($('input[id="amp-enable-notifications"]').val() == 1 ) {
                $("input[data-id=amp-enable-notifications]").prop('checked', false).trigger( 'change' );
                $("input[id=amp-enable-notifications]").val(0);
            }
        }
        else if( $(this).prop("checked") == false && $('input[id="amp-gdpr-compliance-switch"]').val() == 1 ){
            $("input[data-id=amp-gdpr-compliance-switch]").prop('checked', false).trigger( 'change' );
            $("input[id=amp-gdpr-compliance-switch]").val(0);
            $(this).val(0);
        }
    });
  $(".amp-ux-section-field").on("click", function(){
        var track = $(this).attr('data-href');
        localStorage.setItem('ampforwp_current_drawer_click',track);
    });

    function ampforwp_ux_save_loader(){
        $(".amp-ux-loader").show();
        setTimeout(function(){
            $('.amp-ux-loader .amp-ux-loading').addClass("hide");
            $('#amp-ux-loading-saved').removeClass("hide");
            setTimeout(function(){
                $('.amp-ux-loader .amp-ux-loading').removeClass("hide");
                $('#amp-ux-loading-saved').addClass("hide");
                $(".amp-ux-loader").hide();
            }, 1500);
        },500);
    }
var check_img_upload = $('input[id="redux_builder_amp[opt-media][url]"]').val();
if(check_img_upload!=""){
    $('input[id="redux_builder_amp[opt-media][url]"]').hide();
}
function ampforwp_check_required(value,required){
    if(value==0){
        $("[required="+required+"]").addClass("hide");
    }else{
        $("[required="+required+"]").removeClass("hide");
    }
}
$("#ampforwp-add-more-analytics").on("click", function(){
    var analytics = $("#ampforwp-ux-analytics-more").val();
    
    if( analytics && $("[data-href="+analytics+"]").hasClass('hide')){
        $("[data-href="+analytics+"]").removeClass('hide');
        var has_data = true;
        $("[data-href="+analytics+"]").children('.amp-ux-text-container').children('input').each(function(){
            var thisval = $(this).val();
            if(thisval=="" || thisval=="#" || thisval=="UA-XXXXX-Y" || thisval=="SEGMENT-WRITE-KEY"){
               has_data = false;
               return false;
            }
        });
        if(has_data){
            $('#redux_builder_amp-'+analytics).children('.switch-options').children('.ios7-switch').children('.switch-on-off').click();
            $('[name="redux_builder_amp['+analytics+']"]').val(1);
            ampforwp_saveChangesInRedux($(this));
        }
    }
});

$('.ampforwp-ux-closable').on("click", function(){
    $(this).parent('.ampforwp-ux-sub-section').addClass('hide');
     var data_href = $(this).parent('.ampforwp-ux-sub-section').attr('data-href');
    var checked = $('#redux_builder_amp-'+data_href).children('.switch-options').children('.ios7-switch').children('.switch-on-off').prop('checked');
    if(checked){
        $('#redux_builder_amp-'+data_href).children('.switch-options').children('.ios7-switch').children('.switch-on-off').click();
        $('[name="redux_builder_amp['+data_href+']"]').val(0);
    }
    ampforwp_saveChangesInRedux($(this));
});
// Required condition for each field
$.each(new_data, function(key,value) {
        ampCheckRequired($('#'+value.field_data.id));
    });
// Required && saved Condition JS
    $(document).on('click change',".amp-ux-field",function() {
            // Handle click...
           if($(this).hasClass("amp-ux-extension-switch")){
                if($(this).prop('checked')==true){
                    $(this).val(1);
                }else{
                     $(this).val(0);
                }
                ampforwp_check_required($(this).val(),$(this).attr('id'));
            }else{
                    ampCheckRequired($(this));
                    ampforwp_saveChangesInRedux($(this));
                    ampforwp_ux_save_loader();
                    ampforwp_set_ux_selected_val();
            }
        });
 // Drawer JS
    var drawer,
    drawerElem,
    iconElem;
window.addEventListener("load", function (e) {
    
    var list = document.getElementsByClassName("amp-ux-section-field");
    for (var i = 0; i < list.length; i++) {
        // list[i] is a node with the desired class name
     if(list[i].getAttribute('data-href')){
            var attr = list[i].getAttribute('data-href');
            if(attr!='ampforwp-ux-advertisement-section'){
                iconElem = document.getElementsByClassName("amp-ux-section-field")[i];
                var table = $('table[data-id="'+attr+'"]');
                if( ! table.hasClass(attr) ){
                    table.addClass(attr);
                }
                var div = $('div[id="'+attr+'"]');
                if( ! div.hasClass(attr) ){
                    div.addClass(attr);
                }
                drawerElem = document.getElementsByClassName(attr)[0];
                drawer = new Drawer(drawerElem);
                drawer.setDrawerIcon(new DrawerIcon(iconElem));
            }
        }
    }
});


/* Drawer Library */
function Drawer(drawerElem) {
    "use strict";

    function checkMobile(a) {
        return /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4));
    }
    var drawerIcon = {
            set: function (a) {},
            setState: function (a, b) {},
            setOnClick: function(a) {}
        },
        drawerBg,
        drawerStarted = false,
        width = drawerElem.offsetWidth,
        correct = 0,
        percent = 0,
        trx = 0,
        opened = false,
        startMoveTime = 0,
        startX = 0,
        speedSwipe = 0,
        isMobile = checkMobile(navigator.userAgent || navigator.vendor || window.opera),
        isIE = window.navigator.msPointerEnabled,
        isIE11 = window.navigator.pointerEnabled,
        typeStart = isIE ? "MSPointerDown" : (isMobile ? "touchstart" : "mousedown"),
        typeMove = isIE ? "MSPointerMove" : (isMobile ? "touchmove" : "mousemove"),
        typeEnd = isIE ? "MSPointerUp" : (isMobile ? "touchend" : "mouseup"),
        trZ = "translateZ(0)",
        stateMoved = false,
        transformProp = "transform",
        transitionProp = "transition",
        propPrefixCss = "",
        antiSelect,
        onOpened = function () {},
        onClosed = function () {},
        onMove = function (x, percent, animation, duration) {};

    function setProperty(elem, property, value) {
        elem.style[property] = value;
    }

    function transfrom(x) {
        setProperty(drawerElem, transformProp, x + " " + trZ);
    }

    function setTransition(s) {
        setProperty(drawerElem, transitionProp, propPrefixCss + "transform " + s + "s cubic-bezier(0.0, 0.0, 0.2, 1)");
        setProperty(drawerBg, transitionProp, "opacity " + s + "s cubic-bezier(0.0, 0.0, 0.2, 1)");
    }

    function clearTransition() {
        setProperty(drawerElem, transitionProp, "none");
        setProperty(drawerBg, transitionProp, "none");
    }

    function openDrawer(s) {
        s = s || 0.225;
        opened = true;
        setTransition(s);
        drawerElem.style.opacity = 1;
        drawerBg.style.opacity = 1;
        drawerBg.style.visibility = "visible";
        transfrom("translateX(0)");
        drawerIcon.setState(1, s);
        onMove(width, 1, true, s);
        setTimeout(function () {
            clearTransition();
            if (drawerStarted) {
                return;
            }
            onOpened();
        }, s * 1000);
    }

    function closeDrawer(s) {
        s = s || 0.225;
        opened = false;
        setTransition(s);
        drawerBg.style.opacity = 0.001;
        transfrom("translateX(" + 320 + "px)");
        drawerIcon.setState(0, s);
        onMove(0, 0, true, s);
        setTimeout(function () {
            clearTransition();
            if (drawerStarted) {
                return;
            }
            drawerElem.style.opacity = 0.001;
            drawerBg.style.visibility = "hidden";
            onClosed();
        }, s * 1000);
    }

    function toggleDrawer() {
        if (opened) {
            closeDrawer(0.225);
        } else {
            openDrawer(0.225);
        }
    }

    this.setDrawerIcon = function (icon) {
        drawerIcon = icon;
        drawerIcon.setOnClick(function (e) {
            toggleDrawer();
        });
    };
  
    (function () {
        drawerBg = document.createElement("DIV");
        drawerBg.className = "drawer_bg";
        //drawerBg.id = "drawer_bg";
        drawerElem.parentElement.insertBefore(drawerBg, drawerElem);
        drawerBg.onclick = function () {
            if (opened) {
                closeDrawer(0.225);
            }
        };
        antiSelect = document.createElement("DIV");
        antiSelect.className = "antiSelect";
        drawerElem.appendChild(antiSelect);
        var label = document.createElement("DIV");
        label.className = "label";
        drawerElem.appendChild(label);
        //Find prop name
        var vendors;
        if (antiSelect.style.transform === undefined) {
            vendors = ['Webkit', 'Moz', 'ms', 'O'];
            for (var vendor in vendors) {
                if (antiSelect.style[vendors[vendor] + 'Transform'] !== undefined) {
                    transformProp = vendors[vendor] + 'Transform';
                    propPrefixCss = "-" + vendors[vendor].toLowerCase() + "-";
                }
                if (antiSelect.style[vendors[vendor] + 'Transition'] !== undefined) {
                    transitionProp = vendors[vendor] + 'Transition';
                }
            }
        }
        if (/.*opera.*presto/i.test(navigator.userAgent)) {
            trZ = "";
        }
    })();
}
    $(document ).on('click','.ampforwp_install_ux_plugin',function(e){
        e.preventDefault();
        var result = confirm("This required a free plugin to install in your WordPress");
        if (result) {
            $(".amp-ux-loader").show();
            var self = $(this);
            var oldself = $(this).parent('.ios7-switch').html();
            self.parent('.ios7-switch').html('<div class="amp-ux-loader"><div class="amp-ux-loading"></div><span class="hide amp-ux-check"></span></div>');
            var nonce = self.attr('data-secure');
            var currentId = self.attr('id');
            var activate = '';
            if (currentId == 'amp-ux-ext-pwafwp') {
                activate = '&activate=pwa';
            } else if (currentId == 'amp-ux-ext-ssd') {
                activate = '&activate=structure_data';
            } else if (currentId == 'amp-ux-ext-afwp') {
                activate = '&activate=quads-settings';
            }
            console.log(wp.updates.l10n.installing);

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: 'action=ampforwp_enable_modules_upgread' + activate + '&verify_nonce=' + nonce,
                dataType: 'json',
                success: function (response) {
                    if (response.status == 200) {
                        if (self.hasClass('not-exist')) {

                            //To installation
                            wp.updates.installPlugin(
                                {
                                    slug: response.slug,
                                    success: function (pluginresponse) {
                                        console.log(pluginresponse.activateUrl);
                                        ampforwpActivateModulesUpgrade(pluginresponse.activateUrl, self, response, nonce)
                                    }
                                }
                            );

                        } else {
                            var activateUrl = self.attr('data-url');
                            ampforwpActivateModulesUpgrade(activateUrl, self, response, nonce)
                        }
                    } else {
                        alert(response.message)
                    }

                }
            });
        }else{
            var currentId = $(this).attr('id');
            $("[required='"+currentId+"']").addClass("hide");
        }
    });
    function ampforwp_generate_plugin_ulr(url){
         url = '<a target="_blank" href="'+url+'" class="afw-plugin-url"><i class="el el-cog"></i></a>';
         return url;
    }
    var ampforwpActivateModulesUpgrade = function(url, self, response, nonce){
        if (typeof url === 'undefined' || !url) {
            return;
        }
         console.log( 'Activating...' );
         jQuery.ajax(
            {
                async: true,
                type: 'GET',
                //data: dataString,
                url: url,
                success: function () {
                    var msgplug = '';
                    if(self.attr('id')=='amp-ux-ext-pwafwp'){
                        msgplug = 'PWA';
                        console.log("PWA Activated");
                        var res_url = ampforwp_generate_plugin_ulr(response.redirect_url);
                        $('.amp-ux-ext-pwafwp').html(res_url);
                        $("[required=amp-ux-ext-pwafwp]").addClass("hide");
                         ampforwp_ux_save_loader();
                    }else if(self.attr('id')=='amp-ux-ext-ssd'){
                        msgplug = 'Structure Data';
                        //Import Data
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'post',
                            data: 'action=ampforwp_import_modules_scema&verify_nonce='+nonce,
                            success: function () {
                                console.log("Structure Data Activated");
                                var res_url = ampforwp_generate_plugin_ulr(response.redirect_url);
                                $('.amp-ux-ext-ssd').html(res_url);
                                $("[required=amp-ux-ext-ssd]").addClass("hide");
                                $("#section-ampforwp-sd_1").hide();
                                $("#section-table-ampforwp-sd_1").hide();
                                $("#section-ampforwp-sd_2").hide();
                                $("#section-table-ampforwp-sd_2").hide();
                                var std_str = 'Thank you for upgrading the Structured data'+
                                                '<div class="row">'+
                                                    '<div class="col-1">'+
                                                        '<a href="'+response.redirect_url+'"><div class="ampforwp-recommendation-btn updated-message"><p>Go to Structure Data settings</p></div></a>'+
                                                         '&nbsp;<a href="https://ampforwp.com/tutorials/article/what-is-the-structured-data-update-all-about/" class="amp_recommend_learnmore" target="_blank">Learn more</a>'+
                                                    '</div>'+
                                                '</div>';
                                $(".ampforwp-st-data-update").html(std_str);
                                ampforwp_ux_save_loader();
                            }
                        });
                        }else if(self.attr('id')=='amp-ux-ext-afwp'){
                        msgplug = 'Ads by WPQuads';
                        self.text( 'Importing data...' );
                        //Import Data
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'post',
                            data: 'action=ampforwp_import_modules_ads&verify_nonce='+nonce,
                            success: function () {
                                console.log("Ads by WPQuads");
                                var res_url = ampforwp_generate_plugin_ulr(response.redirect_url);
                              $('.amp-ux-ext-afwp').html(res_url);
                              $("[required=amp-ux-ext-afwp]").addClass("hide");
                              var afwp_str = '<div id="section-ampforwp-ads-section" class="redux-section-field redux-field adsactive redux-section-indent-start  afw-accordion-header afw-accordion-tab-open">'+
                                                '<h3 style="margin-top: 20px;">Introducing Ads by WPQuads</h3>'+
                                            '</div>'+
                                            '<table id="section-table-ampforwp-ads-section" data-id="ampforwp-ads-section" class="form-table form-table-section no-border form-table-section-indented" style="display: inline-table;">'+
                                                '<tbody>'+
                                                    '<tr>'+
                                                        '<th></th>'+
                                                        '<td id="5d95bd8ed5093"></td>'+
                                                    '</tr>'+
                                                    '<tr class="adsactive">'+
                                                        '<td colspan="2">'+
                                                            '<fieldset id="redux_builder_amp-ampforwp-ads-module" class="redux-field-container redux-field redux-field-init redux-container-raw redux_remove_th" data-id="ampforwp-ads-module" data-type="raw">'+
                                                                '<div class="ampforwp-ads-data-update">'+
                                                                    '<input type="hidden" value="admin.php?page=quads-settings&amp;tab=general&amp;reference=ampforwp" class="ampforwp-activation-url" id="active">'+
                                                                    'Thank you for upgrading the Ads by WPQuads'+
                                                                    '<div class="row"><div>'+
                                                                     '<a href="http://localhost/wasweb/wp-admin/edit.php?post_type=quads-settings">'+
                                                                        '<div class="ampforwp-recommendation-btn updated-message">'+
                                                                            '<p>Go to Ads by WPQuads settings</p>'+
                                                                        '</div>'+
                                                                    '</a>&nbsp;<br>'+
                                                                     '<a href="https://wpquads.com/documentation/" class="amp_recommend_learnmore" target="_blank">Learn more</a>'+
                                                                '</div>'+
                                                            '</fieldset>'+
                                                        '</td>'+
                                                    '</tr>'+
                                                '</tbody>'+
                                            '</table>';
                                        $(".redux-group-tab.ampforwp_new_features.amp-ads").html(afwp_str);

                                ampforwp_ux_save_loader();
                            }
                        });
                    }
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status === 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status === 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },
            }
        );
    }
    function amp_option_panel_view_func(){
    if(amp_option_panel_view!="1" && amp_option_panel_view!="2" && amp_option_panel_view!="31" && amp_option_panel_view!="32"){
            $('html, body').animate({scrollTop:0},500);
            var amp_opt_view_pop = '<div class="ampforwp-option-panel-view-pop" role="dialog">'+
                      '<div class="m-dialog">'+
                        '<div class="m-content">'+     
                          '<div class="m-header">'+        
                            '<h1 class="m-title">Choose Option Panel View</h1>'+
                          '</div>'+
                          '<div class="m-body">'+
                                '<p class="mb-msg">What view would you prefer?</p>'+
                                '<div class="e-f-btns">'+
                                    '<div class="option-button b1 amp-opt-view" id="amp-opt-easy-view">'+
                                        '<h2>Basic</h2>'+
                                        '<div class="e-img"></div>'+
                                        '<p>For Beginers</p>'+
                                    '</div>'+
                                    '<div class="option-button b2 amp-opt-view"  id="amp-opt-full-view">'+
                                        '<h2>Advance</h2>'+
                                        '<div class="f-img"></div>'+
                                        '<p>For Experts</p>'+     
                                    '</div>'+  
                                '</div>'+
                          '</div>'+ 
                        '</div>'+   
                      '</div>'+     
                    '</div>';
                    $("body").prepend(amp_opt_view_pop);
                    setTimeout(function(){
                        $("body").css({'overflow':'hidden'});
                    },510);
        } 
         if(amp_option_panel_view==1){
           setTimeout(function(){
             $("#1_section_group_li_a").click();
           },100);
        }
    }
    amp_option_panel_view_func();

    $(".amp-opt-view").on("click", function(){
         var thisid = $(this).attr('id');
         amp_options_hide_show(thisid);
         $(".ampforwp-option-panel-view-pop").remove();
         if(thisid=='amp-opt-easy-view'){
            $("#radio-c").prop("checked", true);
         }else if(thisid=='amp-opt-full-view'){
            $("#radio-d").prop("checked", true);
         }
    });

    function amp_left_sub_menu_opt_hs(visibility){
        $("#toplevel_page_amp_options .wp-submenu.wp-submenu-wrap li").each(function(){
            var t_e_c_v = $(this).children('a').html();
            if(t_e_c_v=="Settings" || t_e_c_v=="Design" || t_e_c_v=="Extensions" || t_e_c_v=="Upgrade to Pro" || t_e_c_v=="Import / Export"){
                if(visibility==1){
                    $(this).slideUp();
                }else{
                    $(this).slideDown();
                }
            }
        });
    }
   
    amp_left_sub_menu_opt_hs(amp_option_panel_view);
  
    function amp_options_hide_show(id){
         var opt_type = 0;
         if(id=='amp-opt-easy-view' || id=='radio-c'){
            opt_type = 1;
            $(".amp-full-view-options").slideUp(0);
         }else if(id=='amp-opt-full-view' || id=='radio-d'){
            opt_type = 2;
            $(".amp-full-view-options").slideDown(0);
         }
         amp_left_sub_menu_opt_hs(opt_type)
         $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                    action:     'ampforwp_set_option_panel_view',
                    option_type: opt_type,
                    verify_nonce: ampforwp_nonce.security
                 },
            dataType: 'json',
            success: function(response){

            }
        });
         $("body").css({'overflow':'auto'});
         $("#1_section_group_li_a").click();
    }
    $("[data-href='ampforwp-ux-design-section']").on("click", function(){
        if($("[name='redux_builder_amp[amp-design-selector]']").val() == '4'){
            $('#ampforwp-easy-setup-global-color').show();
        }else{
            $('#ampforwp-easy-setup-global-color').hide();
        }
    });
    $(".amp-opt-change").on("click", function(){
        var thisid = $(this).attr('id');
        $(".amp-opt-change").each(function(){
            $(this).parent().removeClass('active');
        });
        if(thisid=='radio-c'){
             $(this).parent().addClass('active');
        }else if(thisid=='radio-d'){
            $(this).parent().addClass('active')
        }else{
            $(this).parent().removeClass('active');
        }
        amp_options_hide_show(thisid);
    });
     $('.ux-setup-icon').on('mouseover', function (event) {
        var amp_setup_pending_string = '';
        $(".amp-ux-valid-require").each(function(){
             if($(this).children().hasClass('btn-red')){
               amp_setup_pending_string += $(this).parent('.amp-ux-elem-field').children('.amp-ux-elem-title').html()+", ";
             }
        });
        amp_setup_pending_string = amp_setup_pending_string.replace(/,\s*$/, "");
        if($(this).hasClass('amp-ux-warning-okay')){
            $(".setup-tt").html("Your setup is now completed.");
        }else{
            $(".setup-tt").html('Your setup is not completed.<br/>Please setup <i>"'+amp_setup_pending_string+'"</i> section for better AMP Experience.');
        }
        $('.ampforwp-setup-not-tt').css({'visibility':'visible'});
    }).on('mouseout', function (event) {
       $('.ampforwp-setup-not-tt').css({'visibility':'hidden'});
    });
     $('.ux-setup-icon').on('click', function(){
        $(".amp-ux-valid-require").each(function(){
             if($(this).children().hasClass('btn-red')){
               $(this).parent('.amp-ux-elem-field').parent('.amp-ux-section-field').css({'box-shadow': '0px 0px 5px black','padding-left': '15px','padding-right': '15px'});

             }
        });
        setTimeout(function(){ $(".amp-ux-valid-require").parent('.amp-ux-elem-field').parent('.amp-ux-section-field').removeAttr('style'); }, 500);
    });
/* Hamburger Library */
function DrawerIcon(icon) {
    "use strict";
    var ic,
        line1,
        line2,
        line3,
        const1 = 1 / 300,
        const2 = 1 / 500,
        const3 = 2 / 3,
        direction = true,
        locked = false,
        rotateLine,
        scaleX,
        transY,
        transX,
        scaleX2,
        transX2,
        rotateIc,
        transformProp = "transform",
        transitionProp = "transition",
        trZ = "translateZ(0)",
        propPrefixCss = "";

    function setProperty(elem, property, value) {
        elem.style[property] = value;
    }

    function enableAnimation(duration) {
        var transition = propPrefixCss + "transform " + duration + "s ease";
        setProperty(line1, transitionProp, transition);
        setProperty(line2, transitionProp, transition);
        setProperty(line3, transitionProp, transition);
        setProperty(ic, transitionProp, transition);
    }

    function disableAnimation() {
        setProperty(line1, transitionProp, "none");
        setProperty(line2, transitionProp, "none");
        setProperty(line3, transitionProp, "none");
        setProperty(ic, transitionProp, "none");
    }

    this.state = function () {
        return direction;
    };

    this.setOnClick = function (listener) {
        icon.onclick = listener;
    };

    this.set = function (percent) {
        if (locked) {
            return;
        }
        if (percent > 100) {
            percent = 100;
        }
        if (percent < 0) {
            percent = 0;
        }
        if (percent >= 100) {
            direction = false;
        }
        if (percent <= 0) {
            direction = true;
        }

        rotateLine = 0.45 * percent;
        scaleX = 1 - const1 * percent;
        transY = 0.054 * percent;
        transX = 0.033 * percent;
        scaleX2 = 1 - const2 * percent;
        transX2 = -0.01 * percent;
        if (direction) {
            rotateIc = 1.80 * percent;
        } else {
            rotateIc = 360 - (1.80 * percent);
        }
        setProperty(line1, transformProp, "rotate(" + rotateLine + "deg) scaleX(" + scaleX + ") translateY(" + transY + "px) translateX(" + transX + "px) " + trZ);
        setProperty(line2, transformProp, "scaleX(" + scaleX2 + ") translateX(" + transX2 + "px) " + trZ);
        setProperty(line3, transformProp, "rotate(" + (-rotateLine) + "deg) scaleX(" + scaleX + ") translateY(" + (-transY) + "px) translateX(" + transX + "px) " + trZ);
        setProperty(ic, transformProp, "rotate(" + rotateIc + "deg) " + trZ);
    };

    this.setState = function (state, duration) {
        duration = duration || 0.225;
        enableAnimation(duration);
        var temp = this;
        switch (state) {
            case 0:
                this.set(1);
                break;
            case 1:
                this.set(100);
                break;
        }
        setTimeout(function () {
            disableAnimation();
            if (state === 0) {
                temp.set(0);
            }
        }, Number(duration) * 1000);
    };

    this.lock = function () {
        locked = true;
    };
    this.unLock = function () {
        locked = false;
    };

    (function () {
        icon.innerHTML += '<span class="ic"><i class="line one"></i><i class="line two"></i><i class="line thr"></i></span>';
        ic = icon.querySelector(".ic");
        line1 = ic.querySelector(".one");
        line2 = ic.querySelector(".two");
        line3 = ic.querySelector(".thr");
        //Find prop name
        var testEl = document.createElement('div'),
            vendors;
        if (testEl.style.transform === undefined) {
            vendors = ['Webkit', 'Moz', 'ms', 'O'];
            for (var vendor in vendors) {
                if (testEl.style[vendors[vendor] + 'Transform'] !== undefined) {
                    transformProp = vendors[vendor] + 'Transform';
                    propPrefixCss = "-" + vendors[vendor].toLowerCase() + "-";
                }
                if (testEl.style[vendors[vendor] + 'Transition'] !== undefined) {
                    transitionProp = vendors[vendor] + 'Transition';
                }
            }
        }
        if (/.*opera.*presto/i.test(navigator.userAgent)) {
            trZ = "";
        }
    })();
}
$("#subscribe-newsletter-form").on('submit',function(e){
        e.preventDefault();
        var $form = $("#subscribe-newsletter-form");
        var name = $form.find('input[name="name"]').val();
        var email = $form.find('input[name="email"]').val();
        var website = $form.find('input[name="company"]').val();
        $.post(ajaxurl, {action:'ampforwp_subscribe_newsletter',name:name, email:email,website:website},
          function(data) {}
        );
    });
// HIDE/SHOW TAG AND CATEGORY #4326
    $("#show_amp_taxonomy").on('change', function(){
        var thisval = $(this).val();
        if(thisval=='hide'){
            $("#amp-show-hide-tax").css({'display':'block'});
        }else if(thisval=='show'){
            $("#amp-show-hide-tax").css({'display':'none'});
        }
    });
    $(".hide-show-amp-tax").on('click', function(){
        var checkBoxes = $(this).children('input:radio')
         checkBoxes.prop("checked", "true");
    });
    $("#ampforwp-close-notice").on("click", function(){
        var data = {
            action: 'ampforwp_feedback_remove_notice',
        };
        $.post(ajaxurl, data, function(response) {
            $(".ampforwp_remove_notice").remove();
        });
    });
    $("#ampforwp-close-ad-notice").on("click", function(){
        var data = {
            action: 'ampforwp_adpushup_remove_notice',
        };
        $.post(ajaxurl, data, function(response) {
            $(".ampforwp_remove_notice").remove();
        });
    });
});