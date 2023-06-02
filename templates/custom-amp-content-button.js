(function() {
    tinymce.PluginManager.add('ampforwp_tc_button', function( editor, url ) {
        editor.addButton( 'ampforwp_tc_button', {
            text: 'Copy The Content',
            icon: 'dashicons dashicons-clipboard',
            classes: 'ampforwp-copy-content-button ', 
            tooltip: 'Visual Editor to AMP Editor', 
            onclick: function() {
              if(wp.data === undefined){
                if(typeof tinymce.editors.content.getContent()!= undefined){
                    editor.insertContent(tinymce.editors.content.getContent());
                }else{
                    editor.insertContent(document.getElementById('content').value());
                }
              }else if(wp.data){
                if ( wp.data.select( "core/editor" ) != undefined && typeof wp.data.select( "core/editor" ).getEditedPostContent() != undefined ) {
                    var wp_blocks = wp.data.select( "core/block-editor" ).getBlocks();
                    var editedContent = '';
                    for(var i=0;i<wp_blocks.length;i++){
                        var client_id = wp_blocks[i].clientId;
                        var name = wp_blocks[i].name;
                        if((wp_blocks[i].originalContent=='' || wp_blocks[i].originalContent==undefined)){
                             var con = jQuery("#block-"+client_id).find("div[data-block]:last").html();
                            if(con==undefined){
                                con = jQuery("div[data-block="+client_id+"]").html();
                            }
                            editedContent += con;
                        }else{
                            editedContent += wp_blocks[i].originalContent;
                        }
                    }
                    editor.insertContent(editedContent);
                }
                else if( tinymce.editors.content && typeof tinymce.editors.content.getContent()!= undefined){
                    editor.insertContent(tinymce.editors.content.getContent());
                }else{
                    editor.insertContent(document.getElementById('content').value());
                } 
              }
            }
        });
    });
})();

jQuery(document).ready(function($) {
    $("#meta-checkbox").click(function(){ 
           ampforwp_check_custom_content_status($(this));
    });
    ampforwp_check_custom_content_status($("#meta-checkbox")); 
    function ampforwp_check_custom_content_status(checker){ 
          if (checker.prop('checked')==true){
                // var onload_content = tinymce.get('ampforwp_custom_content_editor').getContent();
                $('.amp-editor-content').show();
                var content = document.getElementById('ampforwp_custom_content_editor').value;
                if(content !== ''){
                    $('.amp-editor-content').hide();
                }               
           }
           else{  
              $('.amp-editor-content').hide();
           }
    }
    if(document.getElementById('ampforwp_custom_content_editor') && document.getElementById('meta-checkbox').checked){
        tinymce.get('ampforwp_custom_content_editor').on("keyup change paste",function(){
        var thisval = tinymce.get('ampforwp_custom_content_editor').getContent();
        if(thisval!=""){
            $('.amp-editor-content').hide();
        }else{
            $('.amp-editor-content').show();
        }
        if($("#meta-checkbox").prop('checked')==false){
            $('.amp-editor-content').show();
            $("#ampforwp-amp-content-error-msg").html('Please select the "<b>Use This Content as AMP Content</b>" checkbox above before update.');
            if(thisval==""){
                $('.amp-editor-content').hide();
                $("#ampforwp-amp-content-error-msg").html("AMP contents is blank, Please enter content");
            }
        }else{
            $("#ampforwp-amp-content-error-msg").html("AMP contents is blank, Please enter content");
        }
    });
    }
});