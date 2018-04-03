<?php 
$output = '
	{{if_condition_video_option==custom}}
	<amp-video width="{{width}}" height="{{height}}" layout="responsive"
	  src="{{video_upload_link}}"
	  poster="{{poster}}"
	  artwork="{{artwork}}"
	  title="{{video_title}}" artist="{{artist}}"
	  album="{{album}}">
	</amp-video>
	{{ifend_condition_video_option_custom}}

	{{if_condition_video_option==youtube}}
	<amp-youtube
    data-videoid="{{youtube_video_id}}"
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
 							'label' 	=>"Video type",
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
	 						'type'		=>'text',		
	 						'name'		=>"artist",		
	 						'label'		=>'Video artists',
	           				'tab'       =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom'),
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"album",		
	 						'label'		=>'Video album',
	           				'tab'       =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom'),
 						),
 						array(		
	 						'type'		=>'upload',		
	 						'name'		=>"poster",		
	 						'label'		=>'Poster',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom'),
 						),
 						array(		
	 						'type'		=>'upload',		
	 						'name'		=>"artwork",		
	 						'label'		=>'Artwork',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('video_option'=>'custom'),
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
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);

?>