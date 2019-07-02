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
                    var editedContent = wp.data.select( "core/editor" ).getEditedPostContent();
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
           check_custom_content_status($(this));
    });
    check_custom_content_status($("#meta-checkbox")); 
    function check_custom_content_status(checker){ 
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
    tinymce.get('ampforwp_custom_content_editor').on("keyup",function(){
        $('.amp-editor-content').hide();
    }); 
    
});