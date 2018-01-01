<?php 
$output = '
<div class="ln-fx">{{repeater}}</div>';
$css = '
.blurb-mod{
	margin:{{margin_css}};
   	padding:{{padding_css}};
}
{{module-class}} .ln-fx{
	width:100%;
	display:inline-flex; 
    display: flex;
    flex-wrap: wrap;
} 
.pri-mod{
	display: flex;
    flex-direction: column;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 25%;
    text-align:center;
    background:#f4f4f4;
	margin:20px;
	position:relative;
	padding:30px 50px;
}
.pri-mod .pri-tlt{
	font-size: 20px;
    font-weight: 400;
    margin-bottom:10px;
}
.pri-mod span{
	display:block;
}
.pri-lbl{
	font-size: 45px;
    font-weight: 500;
}
.pri-desc{
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}
.pri-mod .btn-txt{
	background:{{btn_bg_color}};
    color: {{font_color_picker}};
    padding: 10px 30px;
    display: block;
    margin: 24px auto 0 auto;
}
.pri-recom{
    font-size: 12px;
    position: absolute;
    right: 0;
    top: 2px;
    display: block;
    font-weight: 700;
    height: 32px;
    line-height: 32px;
    color: #fff;
    z-index: 1;
    min-width: 80px;
    -webkit-transform: rotate(45deg) translate(23%,57%);
    transform: rotate(45deg) translate(23%,57%);
 }
 .pri-recom:after{
    content: "";
    position: absolute;
    border-bottom: 32px solid #2cbf55;
    border-left: 32px solid transparent;
    border-right: 32px solid transparent;
    height: 0;
    width: 188%;
    z-index: -1;
    left: -47%;
}
.pri-cnt{
    color: #444;
    margin-top: 25px;
    font-size: 14px;
}
.pricing-mod .pri-cnt p{
	margin-bottom:10px;
}
';
return array(
		'label' =>'Pricing',
		'name' =>'pricing-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						
	 					array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
	 					array(
								'type'		=>'color-picker',
								'name'		=>"btn_bg_color",
								'label'		=>'Button Background',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
                            ),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0px',
													'right'=>'0px',
													'top'=>'0px',
													'bottom'=>'0px'
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
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"price_label",		
		 						'label'		=>'Price',
		           				'tab'       =>'customizer',
		 						'default'	=>'$0.00',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"price_desc",		
		 						'label'		=>'Descrption',
		           				'tab'       =>'customizer',
		 						'default'	=>'Price Desc',	
		           				'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_title",		
		 						'label'		=>'Button',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Button',	
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
		 						'type'		=>'text-editor',		
		 						'name'		=>"text_desc",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'Content',	
		           				'content_type'=>'html',
	 						),
                
              ),
          'front_template'=>
          '<div class="pri-mod">
				<h4 class="pri-tlt">{{content_title}}</h4>
				<span class="pri-recom">TIMESAVER</span>
				<span class="pri-lbl">{{price_label}}</span>
				<span class="pri-desc">{{price_desc}}</span>
				<a href="{{btn_link}}" target="_blank" class="btn-txt">{{btn_title}}</a>
				<div class="pri-cnt">
					{{text_desc}}
				</div>
			</div>'
          ),

	);

?>