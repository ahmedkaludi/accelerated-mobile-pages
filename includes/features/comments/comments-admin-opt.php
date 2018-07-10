<?php
 function ampforwp_admin_comments_options($opt_name){

    $comment_desc = "";
   
    // #1093 Display only If AMP Comments is Not Installed
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
       if(!is_plugin_active( 'amp-comments/amp-comments.php' )){
    $comment_AD_URL = "http://ampforwp.com/amp-comments/#utm_source=options-panel&utm_medium=comments-tab&utm_campaign=AMP%20Plugin";
    $comment_desc = '<a href="'.$comment_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/comments-banner.png" width="560" height="85" /></a>';
    }
// comments 
 Redux::setSection( $opt_name, array(
    'title'      => __( 'Comments', 'accelerated-mobile-pages' ),
    'desc' => $comment_desc,
    'id'         => 'disqus-comments',
    'subsection' => true,
    'fields'     => array(
    	array(  
	            'id' => 'ampforwp-display-comments',
	            'type' => 'section',
	            'title' => __('Display', 'accelerated-mobile-pages'),
	            'indent' => true,
	            'layout_type' => 'accordion',
	            'accordion-open'=> 1, 
	          ),
	      array(
	                 'id'       => 'ampforwp-display-on-pages',
	                 'type'     => 'switch',
	                 'title'    => __('Display on Pages', 'accelerated-mobile-pages'),
	                 'tooltip-subtitle' => __('Enable/Disable comments on pages using this switch.', 'accelerated-mobile-pages'),
	                 'default'  => 1
	             ),
	       array(
	                 'id'       => 'ampforwp-display-on-posts',
	                 'type'     => 'switch',
	                 'title'    => __('Display on Posts', 'accelerated-mobile-pages'),
	                 'tooltip-subtitle' => __('Enable/Disable comments on posts using this switch.', 'accelerated-mobile-pages'),
	                 'default'  => 1
	             ),
    	
        array(  
            'id' => 'ampforwp-comments',
            'type' => 'section',
            'title' => __('Discussion', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
        array(
                'title'     =>__('WordPress Comments','accelerated-mobile-pages'),
                'id'        => 'wordpress-comments-support',
                'tooltip-subtitle'  => __('Enable/Disable WordPress comments using this switch.', 'accelerated-mobile-pages'),
                'type'      => 'switch',
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-number-of-comments',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('This refers to the normal comments','accelerated-mobile-pages'),
                         'title'    => __('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array('wordpress-comments-support' , '=' , 1
                                        ),
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-display-avatar',
                         'type'     => 'switch',
                         'title'    => __('Display on User Avatar', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable user Avatar.', 'accelerated-mobile-pages'),
                         'default'  => 1,
                          'required' => array('wordpress-comments-support' , '=' , 1
                                        ),
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Disqus', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Disqus comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-disqus-comments-name',
                         'type'     => 'text',
                         'title'    => __('Disqus Name', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Eg: https://xyz.disqus.com', 'accelerated-mobile-pages'),
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                         'default'  => ''
                     ),

                     array(
                        'class' => 'child_opt', 
                         'id'       => 'ampforwp-disqus-host-position',
                         'type'     => 'switch',
                         'title'    => __('Host on AMPforWP API', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Use AMPforWP secure servers to serve Comments file. Recommended if your site is non HTTPS', 'accelerated-mobile-pages'),
                         'default'  => 1,
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                     ),

                     array(
                        'class' => 'child_opt', 
                         'id'       => 'ampforwp-disqus-host-file',
                         'type'     => 'text',
                         'title'    => __('Disqus Host File', 'accelerated-mobile-pages'),
                         'desc' => '<a href="https://ampforwp.com/host-disqus-comments/" target="_blank"> Click here to know, How to Setup Disqus Host file on your servers </a>',
                         'tooltip-subtitle' => __('Enter the URL of host file', 'accelerated-mobile-pages'),
                         'placeholder' => 'https://comments.example.com/disqus.php',
                         'required' => array('ampforwp-disqus-host-position', '=' , '0'),
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-layout',
                         'title'    => __('Disqus Layout', 'accelerated-mobile-pages'),
                         'type'     => 'select',
                         'options'     => array(
                            'fixed'   => 'Fixed',
                            'responsive' => 'Responsive'
                         ),
                         'default' => 'responsive',
                         'required'=>array('ampforwp-disqus-comments-support','=','1'),
                    ),

                     array(
                         'id'       => 'ampforwp-disqus-height',
                         'type'     => 'text',
                         'title'    => __('Disqus Iframe Height', 'accelerated-mobile-pages'),
                         'placeholder' => 'Enter the height',
                         'default' => '420',
                         'required' => array('ampforwp-disqus-layout', '=' , 'fixed'),
                     ),
                     array(
                         'id'       => 'ampforwp-facebook-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Facebook Comments', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Facebook comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-number-of-fb-no-of-comments',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the number of comments','accelerated-mobile-pages'),
                         'title'    => __('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1),
                         ),
                    ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-fb-comments-lang',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the Language code','accelerated-mobile-pages'),
                         'title'    => __('Language', 'accelerated-mobile-pages'),
                         'desc' => '<a href="https://developers.facebook.com/docs/internationalization" target="_blank">Locales and Languages Supported by Facebook </a>',
                         'default'  => get_locale(),
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1)
                         ),
                    ),
                     //Vuukle options
                    array(
                         'id'       => 'ampforwp-vuukle-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Vuukle Comments', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Vuukle comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-vuukle-comments-apiKey',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the API key of Vuukle','accelerated-mobile-pages'),
                         'title'    => __('API Key', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'     => "For Example xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                         'required' => array(
                            array('ampforwp-vuukle-comments-support', '=' , 1),
                         ),
                    ),
                     //SpotIM Options
                    array(
                         'id'       => 'ampforwp-spotim-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Spot.IM Conversation', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Spot.IM Conversation using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-spotim-comments-apiKey',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the SPOT_ID of Spot.IM','accelerated-mobile-pages'),
                         'title'    => __('SPOT ID', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'     => "For Example xxxxxxxx-xxxx-xxxx-xxxx",
                         'required' => array(
                            array('ampforwp-spotim-comments-support', '=' , 1),
                         ),
                    ),

                 )
 ) );
}