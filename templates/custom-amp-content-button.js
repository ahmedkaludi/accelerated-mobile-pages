(function() {
    tinymce.PluginManager.add('ampforwp_tc_button', function( editor, url ) {
        editor.addButton( 'ampforwp_tc_button', {
            text: 'Copy The Content',
            icon: 'dashicons dashicons-clipboard',
            classes: 'ampforwp-copy-content-button ', 
            tooltip: 'Visual Editor to AMP Editor', 
            onclick: function() {
                editor.insertContent(tinymce.editors.content.getContent());
            }
        });
    });
})();