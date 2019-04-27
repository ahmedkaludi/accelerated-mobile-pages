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
           if(key>3 && jQuery(this).hasClass("otherSectionFields")){
                jQuery(this).attr("style","display:none;");
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
            var values = Object.values(data.items);
            var allFonts = [];

            for (var i = 0; i < values.length; i++) {     
                allFonts.push({fontFamily: values[i].family }); 
            }

            // Creating a select 
            var s = $('<select/>');

            for (var i in allFonts) {

                var fontDetail = allFonts[i].fontFamily;                   

               $('#amp_font_selector-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'"> '+ fontDetail  +' </option>'));
               $('#amp_font_selector_content_single-select').append($('<option value="'+ fontDetail +'" data-font-number="'+ i +'"> '+ fontDetail  +' </option>'));
            }
            
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
        function amp_font_selector_select_change(){
                if($('#amp_font_selector-select').length>0){
                    // Adding Default Font Family
                    $('#s2id_amp_font_selector-select a').removeClass('select2-default');
                    
                    if(redux_data.amp_font_selector==''){
                        redux_data.amp_font_selector = 'Poppins'
                    }
                    $('#s2id_amp_font_selector-select .select2-chosen').html(redux_data.amp_font_selector);

                    $('#amp_font_selector-select option[value="'+redux_data.amp_font_selector+'"]').attr("selected", "selected");
                    $('#amp_font_selector-select').val(redux_data.amp_font_selector).trigger("change");

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
    var secure_nonce = currentThis.parents("li").attr('data-ext-secure');
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
               plugin_active_path:plugin_active_path,
               verify_nonce: secure_nonce
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
    if($(".amp-preview-button").length>0){
        $(".amp-preview-button").click(function(){
            var srcLink = $("#amp-preview-iframe").attr('data-src');
           $("#amp-preview-iframe").html("<iframe  src='"+srcLink+"'></iframe>");
        });
    }

});

function getQueryStringValue (key) {  
  return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
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
            var pb2 = jQuery('input[name="ampforwp_page_builder_enable"]:checked').val();
            if ( takeover == 1 && 'yes' == pb2 ) {
                data = pbdata;
            }
        }
        return data;
    };
    new AmpForWpYoastAnalysis();
}); 