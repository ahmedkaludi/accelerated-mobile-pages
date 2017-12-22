<?php 
$output = '
<div class="cta-tlt">
	<h2>{{content_title}}</h2>
</div>
<div class="cta-btn">
	<a  class="btn-txt" href="{{btn_link}}" target="_blank">{{button-text}}</a>
	<span class="txt">{{text_title}}</span>
</div>
';
$css = '
.cta-mod{
    display: inline-flex;
    width: 100%;
    padding: 4% 5% 1%;
    align-items: center;
}
.cta-mod .cta-btn{
	width: 55%;
    text-align: right;
}
.cta-mod .cta-tlt h2{
   font-size:{{text-size}};
   line-height:1.5;
   font-weight:normal;
   color:{{font_color_picker}};
   margin:{{margin_css}};
   padding:{{padding_css}};
}
.cta-mod .cta-btn .btn-txt{
	display: inline-block;
    color: #000;
    padding: 10px 20px;
    font-size: 26px;
    border: 3px solid #333;
    font-weight: 500;
}
.cta-mod .cta-btn .txt{
	display: block;
    color: #888e94;
    font-size: 16px;
    margin-top: 31px;
}

';
return array(
		'label' =>'CTA',
		'name' =>'cta-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(

						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Join over 50,000 happy customers around the world',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'45px',	
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
		 						'type'		=>'text',		
		 						'name'		=>"button-text",		
		 						'label'		=>'Button',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Get started free',	
		           				'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_link",		
		 						'label'		=>'Link (Make sure its will link Or #)',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),

	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text_title",		
		 						'label'		=>'Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Free, easy to set up, no credit card required',	
		           				'content_type'=>'html',
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
	);

?>