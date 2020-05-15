<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
<div {{if_id}}id="{{id}}"{{ifend_id}} class="cta-tlt {{user_class}}">
	<h2>{{content_title}}</h2>
</div>
<div class="cta-btn">
	<a  class="btn-txt" href="{{btn_link}}" {{if_condition_page_link_open==new_page}}target="_blank"{{ifend_condition_page_link_open_new_page}} {{if_cta_id}}id="{{cta_id}}"{{ifend_cta_id}}>{{button-text}}</a>
	<span class="txt">{{text_title}}</span>
</div>
';
$css = '
{{module-class}}.cta-mod{margin:{{margin_css}};padding:{{padding_css}};display: inline-flex;width: 100%;align-items: center;}
{{module-class}}.cta-mod h2{font-size:{{text-size}};line-height:1.5;font-weight:normal;color:{{font_color_picker}};}
{{module-class}}.cta-mod .btn-txt{display: inline-block;color: {{txt_color_picker}};padding: 10px 20px;font-size: 26px;border: 3px solid {{brd_color_picker}};font-weight: 500;background: {{bg_color_picker}};}
{{module-class}}.cta-mod .txt{display: block;color: {{subh_color_picker}};font-size: 16px;margin-top: 20px;}
@media(max-width:768px){
	{{module-class}}.cta-mod{display:inline-block;width:100%;text-align:center}
	{{module-class}}.cta-mod .cta-btn{width: 100%;text-align: center;margin-top:15px;}
}';
$common_css = '.cta-mod .cta-btn{width: 40%;text-align: right;}';
global $redux_builder_amp;
if(ampforwp_get_setting('amp-rtl-select-option')){
$common_css .=	'
/** RTL CSS **/
.cta-mod .cta-btn { text-align: left;}';
}
return array(
		'label' =>'Call To Action',
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
		           				 'tab'     =>'design',
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
								'type'		=>'color-picker',
								'name'		=>"txt_color_picker",
								'label'		=>'Button Text Color',
								'tab'		=>'design',
								'default'	=>'#000',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"brd_color_picker",
								'label'		=>'Button Border Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Button Background Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"subh_color_picker",
								'label'		=>'Subheading Text Color',
								'tab'		=>'design',
								'default'	=>'#888e94',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"button-text",		
		 						'label'		=>'Button Text',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Get started free',	
		           				'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_link",		
		 						'label'		=>'Button URL',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),

	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text_title",		
		 						'label'		=>'Description',
		           				'tab'       =>'customizer',
		 						'default'	=>'Free, easy to set up, no credit card required',	
		           				'content_type'=>'html',
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'page_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
	 							'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"cta_id",		
		 						'label'		=>'CTA ID',
		           				'tab'     =>'customizer',
		 						'default'	=>' ',	
		           				'content_type'=>'html',
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
		'front_common_css'=>$common_css,
	);

?>