(function() {
    tinymce.PluginManager.add('ampforwp_tc_button', function( editor, url ) {
        editor.addButton( 'ampforwp_tc_button', {
            text: 'Copy The Content',
            icon: false,
            classes: 'ampforwp-the-content', 
            onclick: function() {
                editor.insertContent(tinymce.editors.content.getContent());
            }
        });
    });
})();