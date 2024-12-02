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
                nonce:ampforwp_nonce.security
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
function ampforwpShowPostDD(){
    if(document.getElementById("ampforwp-dd-content")){
        document.getElementById("ampforwp-dd-content").style.display='block';
        ampforwp_select_selected_post_item();
    }
}
function ampforwpClosePostDD(){
    if(document.getElementById("ampforwp-dd-content")){
        document.getElementById("ampforwp-dd-content").style.display='none';
        
    }
}
function ampforwpFilterPost() {
    const input = document.getElementById("ampforwp-post-sb");
    const filter = input.value.toUpperCase();
    const div = document.getElementById("ampforwp-dd-content");
    const a = div.getElementsByTagName("li");
    for (let i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
    if(filter.length>=4){
        ampforwp_search_infinite_scroll_post(filter);
    }
    ampforwp_select_selected_post_item();
  }
  var ajax_request = null;
  function ampforwp_search_infinite_scroll_post(text){
    let this_id = document.getElementById("ampforwp_filtered_this_post_id").value;
    let nonce = document.getElementById("ampforwp_filtered_post_nounce").value;
    var data_search = {
        'action': 'ampforwp_search_infinite_scroll_post',
        'security': nonce,
        'search': text,
        'this_id':this_id
    };
    
    ajax_request = jQuery.ajax({
        type: "POST", //TODO: Must be changed to POST
        url: ajaxurl,
        data: data_search,
        success: function (response) {
            response = JSON.parse(response);
            let iHtml = '';
            for (let index = 0; index < response.length; index++) {
                const element = response[index];
                const ptitle = "'"+element.post_title+"'";
                iHtml +='<li id="afwp-infinite-post-li-'+element.ID+'" onclick="ampforwp_select_post_item(this.value,'+element.ID+','+ptitle+')">'+element.post_title+'</li>';
            }
            document.getElementById('ampforwp-dd-content').innerHTML = iHtml;
            ampforwp_select_selected_post_item();
        },
        beforeSend: function () {
            if (ajax_request !== null) {
                ajax_request.abort();
            }
        }
    });
  }
  function ampforwp_select_selected_post_item(){
    let ampforwp_filtered_post_ids = document.getElementById("ampforwp_filtered_post_ids").value;
    let pdata = JSON.parse(ampforwp_filtered_post_ids);
    for (let index = 0; index < pdata.length; index++) {
        const element = pdata[index];
        let pid = parseInt(element.id);
        if(document.getElementById('afwp-infinite-post-li-'+pid)){
            document.getElementById('afwp-infinite-post-li-'+pid).classList.add('active');
        }
    }
  }
  function ampforwp_select_post_item(value,postid,posttitle){
    ampforwpClosePostDD();
    let ampforwp_filtered_post_ids = document.getElementById("ampforwp_filtered_post_ids").value;
    let pdata = JSON.parse(ampforwp_filtered_post_ids);
    for (let index = 0; index < pdata.length; index++) {
        const element = pdata[index];
        let pid = parseInt(element.id);
        if(pid===parseInt(postid)){
            return false;
        }
    }
    if(pdata.length<2){
        let new_data = {id:postid,title:posttitle};
        pdata.push(new_data);
        document.getElementById("ampforwp_filtered_post_ids").value = JSON.stringify(pdata);
        ampforwp_build_infinite_scroll_tag();
    }else{
        document.getElementById('afwp-post-tag-error').innerHTML = 'Only 2 post allowed in infinite scroll';
    }
  }
  function ampforwp_build_infinite_scroll_tag(){
    let ampforwp_filtered_post_ids = document.getElementById("ampforwp_filtered_post_ids").value;
    let pdata = JSON.parse(ampforwp_filtered_post_ids);
    let iHtml = '';
    for (let index = 0; index < pdata.length; index++) {
        const element = pdata[index];
        iHtml += '<p class="ampforwp-tag-sp">'+element.title+' <span style="cursor:pointer;float:right" onclick="ampforwp_remove_item('+index+')">x</span></p>';
    }
    document.getElementById('ampforwp-post-tag-ihtml').innerHTML = iHtml;
  }
  function ampforwp_remove_item(idx){
    let ampforwp_filtered_post_ids = document.getElementById("ampforwp_filtered_post_ids").value;
    let pdata = JSON.parse(ampforwp_filtered_post_ids);
    pdata.splice(idx,1);
    document.getElementById("ampforwp_filtered_post_ids").value = JSON.stringify(pdata);
    ampforwp_build_infinite_scroll_tag();
    ampforwp_select_selected_post_item();
  }
  window.addEventListener("mouseup", ampforwp_close_post_list_on_outside_click);
  function ampforwp_close_post_list_on_outside_click(e){
    if(e.target.id==='afwp-pt-box'){
        ampforwpClosePostDD();
    }
  }