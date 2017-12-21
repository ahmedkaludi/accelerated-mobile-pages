<?php 
$output = '
<div class="testi-mod">
	<div class="testi-cont">
		<p>{{content}}</p>
	</div>
	<div class="auth-info">
		<div class="auth-img">
			<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}"></amp-img>
		</div>
		<div class="auth-cntn">
			<h5>{{content_title}}</h5>
			<span>{{auth_desig}}</span>
		</div>
	</div>
</div>

';
$css = '
.testimonials-sec .col.col-1{
	display:inline-flex;
	width:100%;
	background:#eee;
	padding:1% 2%;
}
.testimonials-sec{
	display:inline-flex;
	width:100%;
	margin:0 auto;
}
.testimonial-mod{
    flex-direction: column;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 33%;
    justify-content: space-between;
    padding:10px;
}
.testi-cont{
	width:100%;
	padding:30px;
	font-size:20px;
	line-height:1.5;
	color:#000;
	background:#fff;
	position:relative;
}
.testi-cont:after{
	content:"";
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 20px 20px 0 20px;
	border-color: #ffffff transparent transparent transparent;
	bottom:-20px;
	position:absolute;
}
.auth-info{
	width:100%;
	display:inline-block;
	margin-top: 35px;
	margin-left:15px;
}
.auth-img{
	float:left;
	margin-right:20px;
}
.auth-img amp-img{
	border-radius:50%;
}
.auth-cntn{
	float:left;
	font-size:16px;
	color:#888e94;
	font-weight:500;
}
.auth-cntn h5{
	font-weight:500;
}
.auth-cntn span{
	font-weight:normal;
}
';
return array(
		'label' =>'Testimonial',
		'name' =>'testimonial-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(

						array(		
		 						'type'		=>'textarea',		
		 						'name'		=>"content",		
		 						'label'		=>'Testimonial',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 					),
	 					array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Avatar',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
	 					array(
				               'type'  =>'text',
				              'name'=>"image_height",
				              'label'=>"Image height",
				              'tab'  => "customizer",
				              'default'=>'50',
				              'content_type'=>'html',
				              ),
				        array(
				               'type'  =>'text',
				              'name'=>"image_width",
				              'label'=>"Image width",
				              'tab'  => "customizer",
				              'default'=>'50',
				              'content_type'=>'html',
				              ),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Author Name',
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
		 						'type'		=>'text',		
		 						'name'		=>"auth_desig",		
		 						'label'		=>'Designation',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
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