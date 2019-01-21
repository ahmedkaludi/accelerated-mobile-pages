(function() {
    tinymce.PluginManager.add('ampforwp_tc_button', function( editor, url ) {
        editor.addButton( 'ampforwp_tc_button', {
            text: 'Copy The Content',
            icon: 'dashicons dashicons-clipboard',
            classes: 'ampforwp-copy-content-button ', 
            tooltip: 'Visual Editor to AMP Editor', 
            onclick: function() {
                if(typeof tinymce.editors.content!= undefined){
                    if(typeof tinymce.editors.content.getContent()!= undefined){
                        editor.insertContent(tinymce.editors.content.getContent());
                    }else{
                        editor.insertContent(document.getElementById('content').value());
                    }
                }else{//Gutenberg
                 var editedContent = wp.data.select( "core/editor" ).getEditedPostContent();
                    editor.insertContent(editedContent);   
                }
            }
        });
    });
})();