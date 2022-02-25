<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
	{{if_condition_video_option==custom}}
	<amp-video {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}" width="{{width}}" height="{{height}}" src="{{video_upload_link}}"
	 layout="responsive"   
	  {{if_condition_custom_video_more_info==1}}poster="{{poster}}"
	  artist="{{artist}}"
	  album="{{album}}"
	  artwork="{{artwork}}"
	  title="{{video_title}}"{{ifend_condition_custom_video_more_info_1}}
	  {{if_condition_autoplay==1}} autoplay {{ifend_condition_autoplay_1}}
	  controls >
	  <source src="{{video_upload_link}}"
    type="video/mp4" />
    <source type="video/webm"
    src="{{video_upload_link}}">
	</amp-video>
	{{ifend_condition_video_option_custom}}

	{{if_condition_video_option==youtube}}
	<amp-youtube {{if_id}}id="{{id}}"{{ifend_id}}
    data-videoid="{{youtube_video_id}}"
    {{if_condition_hide_rel_video==1}} data-param-rel="0" {{ifend_condition_hide_rel_video_1}}
    {{if_condition_autoplay_video==1}} autoplay {{ifend_condition_autoplay_video_1}}
    layout="responsive"
    width="{{width}}" height="{{height}}"></amp-youtube>
    {{ifend_condition_video_option_youtube}}

    {{if_condition_video_option==embed}}
    {{embed_video}}
    {{ifend_condition_video_option_embed}}
';
$css = '';

return array(
		'label' =>'Video',
		'name' =>'video',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
 							'type'	   	=>'select',		
 							'name'  	=>'video_option',		
 							'label' 	=>"Type",
							'tab'     	=>'customizer',
 							'default' 	=>'youtube',
 							'options_details'=>array(
                                    'youtube'    =>'Youtube',
                                    'custom'    =>'Self hosted',
                                    'embed'  	=>'Embed iframe',
 											),
 							'content_type'=>'html',
 						),	
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"youtube_video_id",		
	 						'label'		=>'Youtube Video ID',
	           				'tab'       =>'customizer',
	 						'default'	=>'mGENRKrdoGY',	
	 						'content_type'=>'html',
	 						'required'  => array('video_option'=>'youtube'),
 						),
 						array(		
	 						'type'		=>'textarea',		
	 						'name'		=>"embed_video",		
	 						'label'		=>'Embed Video Iframe',
	           				'tab'       =>'customizer',
	 						'default'	=>'',
	 						'placeholder'=>'Enter your Iframe code',
	 						'content_type'=>'html',
	 						'required'  => array('video_option'=>'embed'),
 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"video_title",		
		 						'label'		=>'Video title',
		           				'tab'       =>'customizer',
		 						'default'	=>'',	
		 						'content_type'=>'html',
		 						'required'  => array('video_option'=>'custom'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"video_upload_link",		
		 						'label'		=>'Video link',
		 						'helpmessage'	=> esc_html__('Please make sure to enter https url link.', 'accelerated-mobile-pages'),
		           				'tab'       =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
		           				'required'  => array('video_option'=>'custom'),
	 						),
                        array(		
	 						'type'		=>'text',		
	 						'name'		=>"width",		
	 						'label'		=>'Image width',
	           				'tab'      =>'customizer',
	 						'default'	=>'720',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom',
	           									'video_option'=>'youtube',
	           								),
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"height",		
	 						'label'		=>'Video height',
	           				'tab'       =>'customizer',
	 						'default'	=>'305',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom',
											'video_option'=>'youtube',
	           								),
 						),
 						array(		
	 						'type'		=>'checkbox_bool',		
	 						'name'		=>"autoplay_video",		
	 						'label'		=>'Autoplay',
	           				'tab'       =>'customizer',
	 						'default'	=>1,
	 						'options'	=>array(
												array(
													'value'=>1,
												),
											),
	 						'content_type'=>'html',
	           				'required'  => array('video_option'=>'youtube'),
 						),
 						array(		
	 						'type'		=>'checkbox_bool',		
	 						'name'		=>"hide_rel_video",		
	 						'label'		=>'Hide other channels related video',
	           				'tab'       =>'customizer',
	 						'default'	=>1,
	 						'options'	=>array(
												array(
													'label'=>'Setting this option will show given youtube video id channels related videos only.',
													'value'=>1,
												),
											),
	 						'content_type'=>'html',
	           				'required'  => array('video_option'=>'youtube'),
 						),
 						array(		
	 						'type'		=>'checkbox_bool',		
	 						'name'		=>"autoplay",		
	 						'label'		=>'Autoplay',
	           				'tab'       =>'customizer',
	 						'default'	=>0,
	 						'options'	=>array(
												array(
													'label'=>'Setting autoplay will automatically play/pause the video as it is scrolled into/out of view on supported browsers.',
													'value'=>1,
												),
											),
	 						'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom'),
 						),
 						array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>"custom_video_more_info",		
		 						'label'		=>'Customize Media Notifications',
		           				'tab'     	=>'customizer',
		 						'default'	=>0,
		           				'options'	=>array(
												array(
													'label'=>'you can now show rich notifications that describe the playing media',
													'value'=>1,
												),
											),
		           				'content_type'=>'html',
		           				'required'  => array('video_option'=>'custom')
	 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"artist",		
	 						'label'		=>'Video artists',
	           				'tab'       =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom','custom_video_more_info'=>1),
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"album",		
	 						'label'		=>'Video album',
	           				'tab'       =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom','custom_video_more_info'=>1),
 						),
 						array(		
	 						'type'		=>'upload',		
	 						'name'		=>"poster",		
	 						'label'		=>'Poster',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom','custom_video_more_info'=>1),
 						),
 						array(		
	 						'type'		=>'upload',		
	 						'name'		=>"artwork",		
	 						'label'		=>'Artwork',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom','custom_video_more_info'=>1),
 						),
 						array(		
	 						'type'		=>'require_script',		
	 						'name'		=>"custom_script",		
	 						'label'		=>'amp-video',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-video-0.1.js',	
	           				'content_type'=>'js',
	           				'required'  => array('video_option'=>'custom'),
 						),
 						array(		
	 						'type'		=>'require_script',		
	 						'name'		=>"youtube_script",		
	 						'label'		=>'amp-youtube',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-youtube-0.1.js',
	 						'content_type'=>'js',
	           				'required'  => array('video_option'=>'youtube'),
 						),
 						array(		
	 						'type'		=>'require_script',		
	 						'name'		=>"embeded_script",		
	 						'label'		=>'amp-iframe',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-iframe-0.1.js',
	 						'content_type'=>'js',
	           				'required'  => array('video_option'=>'embed'),
 						),
 						array(
							'type'		=>'text',
							'name'		=>"id",
							'label'		=>'ID',
							'tab'		=>'advanced',
							'default'	=>'',
							'content_type'=>'html'
						),
						array(
							'type'		=>'text',
							'name'		=>"user_class",
							'label'		=>'Class',
							'tab'		=>'advanced',
							'default'	=>'',
							'content_type'=>'html'
						),
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);

?>