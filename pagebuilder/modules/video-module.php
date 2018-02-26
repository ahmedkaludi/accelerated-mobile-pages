<?php 
$output = '
	<amp-video width="{{width}}" height="{{width}}" layout="responsive"
	  src="{{video_upload_link}}"
	  poster="{{poster}}"
	  artwork="{{artwork}}"
	  title="{{video_title}}" artist="{{artist}}"
	  album="{{album}}">
	</amp-video>
';
$css = '
{{module-class}}{text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};width:{{width}}}
';

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
		 						'type'		=>'text',		
		 						'name'		=>"video_title",		
		 						'label'		=>'Video title',
		           				'tab'       =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"video_upload_link",		
		 						'label'		=>'Video link',
		           				'tab'       =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
                        array(		
	 						'type'		=>'text',		
	 						'name'		=>"width",		
	 						'label'		=>'Image width',
	           				 'tab'      =>'customizer',
	 						'default'	=>'720',	
	           				'content_type'=>'html',
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"height",		
	 						'label'		=>'Video height',
	           				'tab'       =>'customizer',
	 						'default'	=>'305',	
	           				'content_type'=>'html',
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"artist",		
	 						'label'		=>'Video artists',
	           				'tab'       =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"album",		
	 						'label'		=>'Video album',
	           				'tab'       =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
 						),
 						array(		
	 						'type'		=>'upload',		
	 						'name'		=>"poster",		
	 						'label'		=>'Poster',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
 						),
 						array(		
	 						'type'		=>'upload',		
	 						'name'		=>"artwork",		
	 						'label'		=>'Artwork',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
 						),
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);

add_filter( 'amp_post_template_data', 'ampforwp_video_scripts' );
function ampforwp_video_scripts( $data ) {
	if ( empty( $data['amp_component_scripts']['amp-video'] ) ) {
		$data['amp_component_scripts']['amp-video'] = 'https://cdn.ampproject.org/v0/amp-video-0.1.js';
	}
	return $data;
}

?>