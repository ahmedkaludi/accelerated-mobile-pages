
var Merlin = (function($){

    var t;

    // callbacks from form button clicks.
    var callbacks = {
		save_logo: function(btn){
			var logosave = new saveLogo(btn);
			logosave.init(btn);
		},
        install_child: function(btn) {
            var installer = new ChildTheme();
            installer.init(btn);
        },
        activate_license: function(btn) {
            var license = new ActivateLicense();
            license.init(btn);
        },
        install_plugins: function(btn){
            var plugins = new PluginManager();
            plugins.init(btn);
        },
        install_content: function(btn){
            var content = new ContentManager();
            content.init(btn);
        }
    };

    function window_loaded(){

    	var 
    	body 		= $('.merlin__body'),
    	body_loading 	= $('.merlin__body--loading'),
    	body_exiting 	= $('.merlin__body--exiting'),
    	drawer_trigger 	= $('#merlin__drawer-trigger'),
    	drawer_opening 	= 'merlin__drawer--opening';
    	drawer_opened 	= 'merlin__drawer--open';

    	setTimeout(function(){
	        body.addClass('loaded');
	    },100); 

    	drawer_trigger.on('click', function(){
        	body.toggleClass( drawer_opened );
        });

    	$('.merlin__button--proceed:not(.merlin__button--closer)').click(function (e) {
		    e.preventDefault();
		    var goTo = this.getAttribute("href");

		    body.addClass('exiting');

		    setTimeout(function(){
		        window.location = goTo;
		    },400);       
		});

        $(".merlin__button--closer").on('click', function(e){

        	body.removeClass( drawer_opened );

            e.preventDefault();
		    var goTo = this.getAttribute("href");

		    setTimeout(function(){
		        body.addClass('exiting');
		    },600);   
		    
		    setTimeout(function(){
		        window.location = goTo;
		    },1100);   
        });

        $(".button-next").on( "click", function(e) {
            e.preventDefault();
            var loading_button = merlin_loading_button(this);
            if ( ! loading_button ) {
                return false;
            }
            var data_callback = $(this).data("callback");
            if( data_callback && typeof callbacks[data_callback] !== "undefined"){
                // We have to process a callback before continue with form submission.
                callbacks[data_callback](this);
                return false;
            } else {
                return true;
            }
        });
    }

    function saveLogo() {
    	var body 				= $('.merlin__body');
        var complete, notice 	= $("#child-theme-text");

        function ajax_callback(r) {
            
            if (typeof r.done !== "undefined") {
            	setTimeout(function(){
			        notice.addClass("lead");
			    },0); 
			    setTimeout(function(){
			        notice.addClass("success");
			        notice.html(r.message);
			    },600); 
			    
                
                complete();
            } else {
                notice.addClass("lead error");
                notice.html(r.error);
            }
        }

        function do_ajax() {
			var params = {
                action: "ampforwp_save_installer",
                wpnonce: ampforwp_install_params.wpnonce,
				}
			jQuery('ul.merlin__drawer--import-content').find('input, select').each(function(key, fields){
				
				switch(jQuery(this).attr('type')){
					case 'text':
					case 'hidden':
						params[jQuery(this).attr('name')] = jQuery(this).val();
					break;
					case 'checkbox':
						if(jQuery(this).prop('checked')==true){
							params[jQuery(this).attr('name')] = 1;
						}else{
							params[jQuery(this).attr('name')] = 0;
						}
					break;
					default: 
						params[jQuery(this).attr('name')] = jQuery(this).val();
					break;
				}
			});
            jQuery.post(ampforwp_install_params.ajaxurl, params, ajax_callback).fail(ajax_callback);
        }

        return {
            init: function(btn) {
                complete = function() {

                	setTimeout(function(){
							$(".merlin__body").addClass('js--finished');
						},1500);

                	body.removeClass( drawer_opened );

                	setTimeout(function(){
							$('.merlin__body').addClass('exiting');
						},3500);   

                    	setTimeout(function(){
							window.location.href=btn.href;
						},4000);
		    
                };
                do_ajax();
            }
        }
    }
	
	
	





    

    function merlin_loading_button( btn ){

        var $button = jQuery(btn);

        if ( $button.data( "done-loading" ) == "yes" ) {
        	return false;
        }

        var completed = false;

        var _modifier = $button.is("input") || $button.is("button") ? "val" : "text";
        
        $button.data("done-loading","yes");
        
        $button.addClass("merlin__button--loading");

        return {
            done: function(){
                completed = true;
                $button.attr("disabled",false);
            }
        }

    }

    return {
        init: function(){
            t = this;
            $(window_loaded);
        },
        callback: function(func){
            console.log(func);
            console.log(this);
        }
    }

})(jQuery);

Merlin.init();


jQuery(document).ready(function($) {
    //var $ = jQuery;
    if ($('.set_custom_images').length > 0) {
        if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $(document).on('click', '.set_custom_images', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.parents('li').find('#process_custom_images');

                // Define image_frame as wp.media object
                image_frame = wp.media({
                           title: 'Select Logo',
                           multiple : false,
                           library : {
                                type : 'image',
                            }
                       });
                image_frame.open(button);
                image_frame.on('close',function() {
                  // On close, get selections and save to the hidden input
                  // plus other AJAX stuff to refresh the image preview
                  var attachment =  image_frame.state().get('selection').first().toJSON();
                   var saveValues = {
                        url: attachment.url,
                        id: attachment.id,
                        height: attachment.height,
                        width: attachment.width,
                        thumbnail: attachment.sizes.thumbnail.url,
                    }
                    id.val(JSON.stringify(saveValues));
                    button.parents('li').find('img').remove();
                    button.parents('li').append("<br><br><img src='"+attachment.url+"' width='100' height='100'>");
               });
               return false;
            });
        }
    }
	$('#ampforwp-design-select').change(function(){
		var selectCurrentDesign = $(this).val();
		$(this).parents('li').find('#design-'+selectCurrentDesign).siblings('img').hide();
		$(this).parents('li').find('#design-'+selectCurrentDesign).fadeIn();//.find('img').attr('src',ampforwp_install_params.pluginurl+'/images/design-'+selectCurrentDesign+'.png')
	});
});