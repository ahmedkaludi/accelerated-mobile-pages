<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

$output = '<amp-ad {{if_id}}id="{{id}}"{{ifend_id}} class="amp-ad-1 {{user_class}}"
			type="adsense"
			{{if_condition_ad_size_option==300x250}}width="300"{{ifend_condition_ad_size_option_300x250}}
			{{if_condition_ad_size_option==336x280}}width="336"{{ifend_condition_ad_size_option_336x280}}
			{{if_condition_ad_size_option==728x90}}width="728"{{ifend_condition_ad_size_option_728x90}}
			{{if_condition_ad_size_option==300x600}}width="300"{{ifend_condition_ad_size_option_300x600}}
			{{if_condition_ad_size_option==320x100}}width="320"{{ifend_condition_ad_size_option_320x100}}
			{{if_condition_ad_size_option==200x50}}width="200"{{ifend_condition_ad_size_option_200x50}}
			{{if_condition_ad_size_option==320x50}}width="320"{{ifend_condition_ad_size_option_320x50}}
			{{if_condition_ad_size_option==responsive}}width="100vw"{{ifend_condition_ad_size_option_responsive}}

			{{if_condition_ad_size_option==300x250}}height="250"{{ifend_condition_ad_size_option_300x250}}
			{{if_condition_ad_size_option==336x280}}height="280"{{ifend_condition_ad_size_option_336x280}}
			{{if_condition_ad_size_option==728x90}}height="90"{{ifend_condition_ad_size_option_728x90}}
			{{if_condition_ad_size_option==300x600}}height="600"{{ifend_condition_ad_size_option_300x600}}
			{{if_condition_ad_size_option==320x100}}height="100"{{ifend_condition_ad_size_option_320x100}}
			{{if_condition_ad_size_option==200x50}}height="50"{{ifend_condition_ad_size_option_200x50}}
			{{if_condition_ad_size_option==320x50}}height="50"{{ifend_condition_ad_size_option_320x50}}
			{{if_condition_ad_size_option==responsive}}height="320"{{ifend_condition_ad_size_option_responsive}}

			data-ad-client="{{data_ad_client}}"
			data-ad-slot="{{data_ad_slot}}"
			{{if_condition_ad_size_option==responsive}}data-auto-format="rspv"
			data-full-width>
			<div overflow></div{{ifend_condition_ad_size_option_responsive}}></amp-ad>';
$css ='';
return array(
		'label' =>'Advertisement',
		'name' =>'adsense-ad',
		'tabs' => array(
              'customizer'=>'Content',
              'advanced' => 'Advanced'
        ),
		'default_tab'=> 'customizer',
		'fields' => array(
						array(		
 							'type'	   	=>'select',		
 							'name'  	=>'ad_size_option',		
 							'label' 	=>"Ad Size",
							'tab'     	=>'customizer',
 							'default' 	=>'336x280',
 							'options_details'=>array(
                                    '300x250'    =>'300x250',
                                    '336x280'    =>'336x280',
                                    '728x90'  	 =>'728x90',
                                    '300x600'	 =>'300x600',
                                    '320x100'	 =>'320x100',
                                    '200x50'	 =>'200x50',
                                    '320x50'	 =>'320x50',
                                    'responsive' =>'Responsive'
 											),
 							'content_type'=>'html',
 						),
						array(		
		 						'type'			=> 'text',		
		 						'name'			=> "data_ad_client",		
		 						'label'			=> 'Data AD Client',
		           				'tab'     		=> 'customizer',
		 						'default'		=> '',	
		 						'helpmessage'	=> 'e.g. ca-pub-0497xxxxxxxxxx12',
		           				'content_type'	=> 'html',
	 						),
						array(		
		 						'type'			=> 'text',		
		 						'name'			=> "data_ad_slot",		
		 						'label'			=> 'Data AD Slot',
		           				'tab'     		=> 'customizer',
		 						'default'		=> '',	
		 						'helpmessage'	=> 'e.g. 896xxxxx12',
		           				'content_type'	=> 'html',
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