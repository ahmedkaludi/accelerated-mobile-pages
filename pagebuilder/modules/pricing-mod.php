<?php 
$output = '
<div class="pri-mod">
	<h4 class="pri-tlt">{{content_title}}</h4>
	<span class="pri-recom">TIMESAVER</span>
	<span class="pri-lbl">{{price_label}}</span>
	<span class="pri-desc">{{price_desc}}</span>
	<a href="{{btn_link}}" target="_blank" class="btn-txt">{{btn_title}}</a>
	<div class="pri-cnt">
		{{text_desc}}
	</div>
</div>

';
$css = '
.price-sec .col.col-1{
	display:inline-flex;
	width:100%;
}
.price-sec{
	width:100%;
	margin:40px 0px 0px 0px;
	display:inline-flex;
}
.pricing-mod{
	display: flex;
    flex-direction: column;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 25%;
    justify-content: space-between;
    text-align:center;
    background:#eee;
	margin:20px;
	position:relative;
}
.pri-mod{
	padding:30px 50px;
}
.pri-mod .pri-tlt{
	font-size: 26px;
    line-height: 1.5;
    font-weight: 400;
    margin-bottom:20px;
}
.pri-mod span{
	display:block;
	margin-bottom: 30px;
}
.pri-lbl{
	font-size: 45px;
    font-weight: 500;
}
.pri-desc{
	font-size:16px;
	color:#333;
}
.pri-mod .btn-txt{
	background:{{btn_bg_color}};
    color: {{font_color_picker}};
    padding: 10px 20px;
    display: inline-block;
    font-size: {{text-size}};
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
	font-size:{{text-size}};
	line-height:1.5;
	color:#333;
	margin-top:20px;
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
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
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
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
	 					array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'customizer',
								'default'	=>'#fff',
								'content_type'=>'css'
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
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'20px',	
		           				'content_type'=>'css',
	 						),
	 					array(
								'type'		=>'color-picker',
								'name'		=>"btn_bg_color",
								'label'		=>'Button Background',
								'tab'		=>'customizer',
								'default'	=>'#333',
								'content_type'=>'css'
							),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Desc Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'20px',	
		           				'content_type'=>'css',
	 						),
						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"text_desc",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'Content',	
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