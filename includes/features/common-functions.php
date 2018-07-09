<?php
  // 27. Clean the Defer issue
  // TODO : Get back to this issue. #407
    function ampforwp_the_content_filter_full( $content_buffer ) {
            if ((!is_plugin_active('amp/amp.php') && function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) 
                || 
                (is_plugin_active('amp/amp.php') && function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() )) {
                $content_buffer = preg_replace("/' defer='defer/", "", $content_buffer);
                $content_buffer = preg_replace("/' defer onload='/", "", $content_buffer);
                $content_buffer = preg_replace("/' defer /", "", $content_buffer);
                $content_buffer = preg_replace("/onclick=[^>]*/", "", $content_buffer);
                $content_buffer = preg_replace("/<\\/?thrive_headline(.|\\s)*?>/",'',$content_buffer);
                // Remove Extra styling added by other Themes/ Plugins
                $content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)<!doctype html>/','<!doctype html>',$content_buffer);
                $content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)(\/\*)/','$4',$content_buffer);
                $content_buffer = preg_replace("/<\\/?g(.|\\s)*?>/",'',$content_buffer);
                $content_buffer = preg_replace('/(<[^>]+) spellcheck="false"/', '$1', $content_buffer);
                $content_buffer = preg_replace('/(<[^>]+) spellcheck="true"/', '$1', $content_buffer);
                $content_buffer = preg_replace("/about:blank/", "#", $content_buffer);
                $content_buffer = preg_replace("/<script data-cfasync[^>]*>.*?<\/script>/", "", $content_buffer);
                $content_buffer = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content_buffer);
                //$content_buffer = preg_replace('/<style type=(.*?)>|\[.*?\]\s\{(.*)\}|<\/style>(?!(<\/noscript>)|(\n<\/head>)|(<noscript>))/','',$content_buffer);

                // xlink attribute causes Validatation Issues #1149
                $content_buffer = preg_replace('/xlink="href"/','',$content_buffer);
                $content_buffer = preg_replace('/!important/', '' , $content_buffer);

                $content_buffer = apply_filters('ampforwp_the_content_last_filter', $content_buffer);

            }
            if(function_exists('ampforwp_amp_nonamp_convert') && ampforwp_amp_nonamp_convert("", "check")){
              $content_buffer = ampforwp_amp_nonamp_convert($content_buffer, "filter");
            }
            return $content_buffer;
    }
    add_action('wp_loaded', function(){ ob_start('ampforwp_the_content_filter_full'); }, 999);