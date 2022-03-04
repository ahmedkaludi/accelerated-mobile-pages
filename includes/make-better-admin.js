var strict;

jQuery(document).ready(function ($) {
    /**
     * DEACTIVATION FEEDBACK FORM
     */
    // show overlay when clicked on "deactivate"
    ampforwp_deactivate_link = $('.wp-admin.plugins-php tr[data-slug="accelerated-mobile-pages"] .row-actions .deactivate a');
    ampforwp_deactivate_link_url = ampforwp_deactivate_link.attr('href');

    ampforwp_deactivate_link.click(function (e) {
        e.preventDefault();
        
        // only show feedback form once per 30 days
        var c_value = ampforwp_admin_get_cookie("ampforwp_hide_deactivate_feedback");

        if (c_value === undefined) {
            $('#ampforwp-reloaded-feedback-overlay').show();
        } else {
            // click on the link
            window.location.href = ampforwp_deactivate_link_url;
        }
    });
    // show text fields
    $('#ampforwp-reloaded-feedback-content input[type="radio"]').click(function () {
        // show text field if there is one
        var input_value = $(this).attr("value");
        var target_box = $("." + input_value);
        $(".mb-box").not(target_box).hide();
        $(target_box).show();
    });
    // send form or close it
    $('#ampforwp-reloaded-feedback-content .button').click(function (e) {
        e.preventDefault();
        // set cookie for 30 days
        var exdate = new Date();
        exdate.setSeconds(exdate.getSeconds() + 2592000);
        document.cookie = "ampforwp_hide_deactivate_feedback=1; expires=" + exdate.toUTCString() + "; path=/";

        $('#ampforwp-reloaded-feedback-overlay').hide();
        if ('ampforwp-reloaded-feedback-submit' === this.id) {
            // Send form data
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    action: 'ampforwp_send_feedback',
                    data: $('#ampforwp-reloaded-feedback-content form').serialize()
                },
                complete: function (MLHttpRequest, textStatus, errorThrown) {
                    // deactivate the plugin and close the popup
                    $('#ampforwp-reloaded-feedback-overlay').remove();
                    window.location.href = ampforwp_deactivate_link_url;

                }
            });
        } else {
            $('#ampforwp-reloaded-feedback-overlay').remove();
            window.location.href = ampforwp_deactivate_link_url;
        }
    });
    // close form without doing anything
    $('.ampforwp-for-wp-feedback-not-deactivate').click(function (e) {
        $('#ampforwp-reloaded-feedback-overlay').hide();
    });
    
    function ampforwp_admin_get_cookie (name) {
	var i, x, y, ampforwp_cookies = document.cookie.split( ";" );
	for (i = 0; i < ampforwp_cookies.length; i++)
	{
		x = ampforwp_cookies[i].substr( 0, ampforwp_cookies[i].indexOf( "=" ) );
		y = ampforwp_cookies[i].substr( ampforwp_cookies[i].indexOf( "=" ) + 1 );
		x = x.replace( /^\s+|\s+$/g, "" );
		if (x === name)
		{
			return unescape( y );
		}
	}
}

}); // document ready