<?php 
$output = '
<div class="blu-mod">
	<span class="ico-pic icon-{{icon-picker}}"></span>
	<h3 class="blurb-txt">{{content_title}}</h3>
	<p>{{content}}</p>
</div>

';
$css = '
.blurb-sec .col.col-1{
	display:inline-flex;
	width:100%;
}
.blurb-sec{
	display:inline-flex;
	width:100%;
	margin:0;
}
.blurb-mod{
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
.blu-mod .blurb-txt{
   font-size:30px;
   line-height:1.5;
   font-weight:500;
   margin-bottom:30px;
   color:{{font_color_picker}};
   margin:{{margin_css}};
   padding:{{padding_css}};
}
.blu-mod .ico-pic{
	font-size:{{ico-size}};
	color:{{ic_color_picker}};
	margin-bottom:30px;
	display:inline-block;
}
.blu-mod .ico-pic:before, .blu-mod .ico-pic:after{
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
								'type'		=>'color-picker',
								'name'		=>"ic_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'customizer',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Icon Background color',
								'tab'		=>'customizer',
								'default'	=>'#333',
								'content_type'=>'css',
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'customizer',
								'default'	=>'#333',
								'content_type'=>'css'
							),
	 					array(		
		 						'type'		=>'textarea',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
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