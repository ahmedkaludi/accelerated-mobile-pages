<?php 
add_filter( 'amp_post_template_data', 'ampforwp_framework_pagebuilder_accordions_scripts' );
function ampforwp_framework_pagebuilder_accordions_scripts( $data ) {

			if ( empty( $data['amp_component_scripts']['amp-accordion'] ) ) {
				$data['amp_component_scripts']['amp-accordion'] = 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js';
			}
		
	
		return $data;
}
$output = '
<div class="accr-mod">
<amp-accordion>
	  <section>
	    <h5 class="acc-lbl">{{acc_title}}</h5>
	    <p class="acc-desc">{{ass_desc}}</p>
	  </section>
</amp-accordion>
</div>

';
$css = '

amp-accordion section[expanded] .show-more {
  display: none;
}
amp-accordion section:not([expanded]) .show-less {
  display: none;
}
.accr-mod .acc-lbl{
    padding: 10px;
    font-size: {{acc-size}};
    color: {{acc_color_picker}};
    margin-bottom: 10px;
    font-weight:500;
}
.accr-mod amp-accordion .acc-desc{
	margin-bottom:0;
	padding:0px 10px 5px 20px;
	font-size:{{text-size}};
	color:#666;
}
';
return array(
		'label' =>'Accordions',
		'name' =>'accordion-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(
						
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"acc_title",		
		 						'label'		=>'Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"acc-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'22px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"acc_color_picker",
								'label'		=>'Color',
								'tab'		=>'customizer',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'textarea',		
		 						'name'		=>"ass_desc",		
		 						'label'		=>'Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Desc',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'16px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'customizer',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>10,
													'bottom'=>10
													),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'customizer',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
	);



?>