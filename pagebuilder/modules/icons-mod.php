<?php 
$output = '
<div class="ln-fx">{{repeater}}</div>';
$css = '
.ln-fx{
	width:100%;
	display:inline-flex;
	margin:{{margin_css}};
   	padding:{{padding_css}};
}
.ico-mod{
    display: flex;
    flex-direction: column;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    margin: 0 auto;
    text-align: center;
}
.ico-mod .ico-pic{
	font-size:{{ico-size}};
	display:inline-block;
	color:{{ico_color_picker}};
	background: {{bg_color_picker}};
	border-radius:{{border-size}};
	padding: 25px;

}
';
return array(
		'label' =>'Icons',
		'name' =>'icons-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"border-size",		
		 						'label'		=>'Border Radius',
		           				 'tab'     =>'design',
		 						'default'	=>'60px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"ico_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Icon Background color',
								'tab'		=>'design',
								'default'	=>'#2cbf55',
								'content_type'=>'css',
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>15,
													'bottom'=>15
													),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
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
		'repeater'=>array(
          'tab'=>'customizer',
          'fields'=>array(
		                array(		
		 						'type'		=>'icon-selector',		
		 						'name'		=>"icon-picker",		
		 						'label'		=>'Icons',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"ico-size",		
		 						'label'		=>'Icon Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'30px',	
		           				'content_type'=>'css',
	 						),
                
              ),
          'front_template'=>
        '<div class="ico-mod">
          <span class="ico-pic icon-{{icon-picker}}"></span>
        </div> '
          ),

	);

?>