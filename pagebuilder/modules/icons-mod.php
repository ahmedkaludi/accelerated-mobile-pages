<?php 
$output = '
<div class="ico-mod">
	<span class="ico-pic icon-{{icon-picker}}"></span>
</div>

';
$css = '
.row-setting-27 .col.col-1{
	display:inline-flex;
	width:100%;
}
.icons-mod{
    display: flex;
    flex-direction: column;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 25%;
    justify-content: space-between;
    text-align:center;
    background:#eee;
	padding:30px 50px;
	margin:20px;
}
.icons-mod .ico-mod .ico-pic{
	font-size:{{ico-size}};
	margin-bottom:30px;
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
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(
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
		 						'name'		=>"border-size",		
		 						'label'		=>'Border Radius',
		           				 'tab'     =>'customizer',
		 						'default'	=>'60px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"ico_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'customizer',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Icon Background color',
								'tab'		=>'customizer',
								'default'	=>'#2cbf55',
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