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
.blu-mod{
    flex-direction: column;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 25%;
    justify-content: space-between;
    text-align:center;
	padding:30px 50px;
}
.blu-mod .blurb-txt{
   font-size:30px;
   line-height:1.5;
   font-weight:500;
   color:{{font_color_picker}};
}
.blu-mod .ico-pic{
	font-size:{{ico-size}};
	color:{{ic_color_picker}};
	margin-bottom:30px;
	display:inline-block;
}
.blu-mod .ico-pic{
	background:{{bg_color_picker}};
	border-radius:50%;
	padding:10px;
}
';
return array(
		'label' =>'Blurb',
		'name' =>'blurb-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						
						array(
								'type'		=>'color-picker',
								'name'		=>"ic_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Icon Background color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
							),

						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
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
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
	 					),
                
              ),
          'front_template'=>
        '<div class="blu-mod">
			<span class="ico-pic icon-{{icon-picker}}"></span>
			<h3 class="blurb-txt">{{content_title}}</h3>
			{{content}}
		</div> '
          ),
	);

?>