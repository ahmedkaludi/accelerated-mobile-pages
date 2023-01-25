
jQuery(document).ready(function($){

    $('.ampforwp-activation-call-module-upgrade').click(function(e){
        if(pagenow == 'toplevel_page_amp_options' && $(this).hasClass('ampforwp-activation-call-module-upgrade')){// Check for current page
            var self = $(this);
            var nonce = self.attr('data-secure');
            self.addClass('updating-message');
            var currentId = self.attr('id');
            var activate = '';
            var adsforwp_is_active = "";
            var adsforwp_act_url = "";
            if(currentId=='ampforwp-pwa-activation-call'){
                activate = '&activate=pwa';
            }else if(currentId=='ampforwp-structure-data-activation-call'){
                activate = '&activate=structure_data';
            }else if(currentId=='ampforwp-adsforwp-activation-call'){
                activate = '&activate=adsforwp';
                adsforwp_is_active = $(".ampforwp-activation-url").attr('id');
                adsforwp_act_url = $(".ampforwp-activation-url").val();
            }else if(currentId=='ampforwp-wp-quads-activation-call'){
                activate = '&activate=wp_quads';    
            }else if(currentId=='ampforwp-page-booster-activation-call'){
                activate = '&activate=cwvpsb';    
            }
            self.text( wp.updates.l10n.installing );
            self.text( 'Installing...' );
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: 'action=ampforwp_enable_modules_upgread'+activate+'&verify_nonce='+nonce,
                dataType: 'json',
                success: function (response){
                    if(response.status==200){
                        //To installation
                        if(currentId=='ampforwp-adsforwp-activation-call'){
                            if(adsforwp_is_active=='not-exist'){
                                wp.updates.installPlugin(
                                {
                                        slug: response.slug,
                                        success: function(pluginresponse){
                                            //wp.updates.installPluginSuccess(pluginresponse);
                                            wpActivateModulesUpgrage(pluginresponse.activateUrl, self, response, nonce)
                                        }
                                    }
                                );
                            }else{
                                wpActivateModulesUpgrage(adsforwp_act_url, self, response, nonce)
                            }
                        }else{
                            wp.updates.installPlugin(
                            {
                                    slug: response.slug,
                                    success: function(pluginresponse){
                                        //wp.updates.installPluginSuccess(pluginresponse);
                                        wpActivateModulesUpgrage(pluginresponse.activateUrl, self, response, nonce)
                                    }
                                }
                            );
                        }
                    }else{
                        alert(response.message)
                    }
                    
                }
            })//ajaxComplete(wpActivateModulesUpgrage(response.path, self, response));
            
        }
    });
    
    $('.ampforwp-activation-plugin').click(function(e){
        if(pagenow == 'toplevel_page_amp_options' && $(this).hasClass('ampforwp-activation-plugin')){// Check for current page
            var self = $(this);
            self.addClass('updating-message');
            var msgplug = '';
            var response = '';
            var currentId = self.attr('id');
            if(currentId=='ampforwp-page-booster-activate'){
                msgplug = 'Core Web Vitals Page Booster';
                response = '?page=cwvpsb';
            }else if(currentId=='ampforwp-structured-data-activate'){
                msgplug = 'Schema & Structured Data';
                response = '?page=structured_data_options';
            }else if(currentId=='ampforwp-pwa-activate'){
                msgplug = 'PWA';
                response = '?page=pwaforwp';
            }
            var activateUrl = self.attr('data-href');
            self.text( wp.i18n );
            self.text( 'Activating...' );
             jQuery.ajax(
                {
                    async: true,
                    type: 'GET',
                    //data: dataString,
                    url: activateUrl,
                    success: function () {
                        self.removeClass('updating-message')
                            self.html('<a href="'+response+'" style="text-decoration: none;color: #fff;">Activated! - Let\'s Go to '+msgplug+' Settings</a>')
                            self.removeClass('ampforwp-activation-plugin');
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status === 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status === 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        console.log(msg);
                    },
                }
            );
        }
    });    

    var wpActivateModulesUpgrage = function(url, self, response, nonce){
        if (typeof url === 'undefined' || !url) {
            return;
        }
         self.text( 'Activating...' );
         jQuery.ajax(
            {
                async: true,
                type: 'GET',
                //data: dataString,
                url: url,
                success: function () {
                    self.removeClass('updating-message')
                    var msgplug = '';
                    if(self.attr('id')=='ampforwp-pwa-activation-call'){
                        msgplug = 'PWA';


                        self.html('<a href="'+response.redirect_url+'" style="text-decoration: none;color: #555;">Installed! - Let\'s Go to '+msgplug+' Settings</a>')
                        self.removeClass('ampforwp-activation-call-module-upgrade');
                    }else if(self.attr('id')=='ampforwp-structure-data-activation-call'){
                        msgplug = 'Structure Data';
                        self.text( 'Importing data...' );
                        //Import Data
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'post',
                            data: 'action=ampforwp_import_modules_scema&verify_nonce='+nonce,
                            success: function () {
                                 self.html('<a href="'+response.redirect_url+'" style="text-decoration: none;color: #555;">Installed! - Let\'s Go to '+msgplug+' Settings</a>')
                                self.removeClass('ampforwp-activation-call-module-upgrade');
                            }
                        });
                        }else if(self.attr('id')=='ampforwp-adsforwp-activation-call'){
                        msgplug = 'Ads for WP';
                        self.text( 'Importing data...' );
                        //Import Data
                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'post',
                            data: 'action=ampforwp_import_modules_ads&verify_nonce='+nonce,
                            success: function () {
                                 self.html('<a href="'+response.redirect_url+'" style="text-decoration: none;">Go to Ads Settings</a>')
                                 self.removeClass('ampforwp-activation-call-module-upgrade');
                            }
                        });
                        }else if(self.attr('id')=='ampforwp-wp-quads-activation-call'){
                        msgplug = 'WP QUADS';
                        self.html('<a href="'+response.redirect_url+'">Installed! - Let\'s Go to '+msgplug+' Settings</a>')
                        self.removeClass('ampforwp-activation-call-module-upgrade');
                        }else if(self.attr('id')=='ampforwp-page-booster-activation-call'){
                        msgplug = 'Core Web Vitals Page Booster';
                        self.html('<a href="'+response.redirect_url+'" style="text-decoration: none;color: #fff;">Installed! - Let\'s Go to '+msgplug+' Settings</a>')
                        self.removeClass('ampforwp-activation-call-module-upgrade');
                        }

                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status === 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status === 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    console.log(msg);
                },
            }
        );
    }

});//(document).ready Closed