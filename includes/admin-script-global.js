jQuery(function($) {

    // Dismiss button functionlaity
    if($("#aampforwp-automattic-notice")){
    $('#ampforwp-automattic-notice').on('click', 'button', function(){
        var nonce = $('#ampforwp-automattic-notice').attr('data-nonce');
        var data_notice = {
            'action': 'ampforwp_automattic_notice_delete',
            'security': nonce,
        };
        jQuery.post(ajaxurl, data_notice, function(response) {   
    
        });
    });
    }
    if($("#ampforwp-close-ad-notice")){
        $("#ampforwp-close-ad-notice").on("click", function(){
            var data = {
                action: 'ampforwp_tpd_remove_notice',
            };
            $.post(ajaxurl, data, function(response) {
                $(".ampforwp_remove_notice").remove();
            });
        });
    }
    if($("#ampforwp-close-notice")){
    $("#ampforwp-close-notice").on("click", function(){
        var data = {
            action: 'ampforwp_feedback_remove_notice',
        };
        $.post(ajaxurl, data, function(response) {
            $(".ampforwp_remove_notice").remove();
        });
    });
    }

    });
   
jQuery(document).ready(function($){
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