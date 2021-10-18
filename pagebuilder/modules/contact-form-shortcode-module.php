<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
{{if_condition_form_type==contact-form-7}}
[contact-form-7 id="{{cf7_form_id}}"]
{{ifend_condition_form_type_contact-form-7}}

{{if_condition_form_type==gravityform}}
[gravityform id="{{gf_form_id}}" title="true" description="true"]
{{ifend_condition_form_type_gravityform}}

{{if_condition_form_type==wpforms}}
[wpforms id="{{wp_forms_id}}"]
{{ifend_condition_form_type_wpforms}}

{{if_condition_form_type==ninja_form}}
[ninja_form id="{{nj_forms_id}}"]
{{ifend_condition_form_type_ninja_form}}
';

$css = $args = '';
$formSupported = array();
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('amp-cf7/amp-cf7.php')){
	$formSupported = array_merge($formSupported, array('contact-form-7'=>'Contact Form 7'));

	  $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
	$cf7Forms = get_posts( $args );
	$form_titles = wp_list_pluck( $cf7Forms , 'post_title' );
	$form_id = wp_list_pluck( $cf7Forms , 'ID' );
	$cf7formArray = array();
	if(count($form_titles)>0){
		foreach ($form_titles as $key => $formName) {
			$formName = esc_html($formName);
			$cf7formArray[$form_id[$key]] = $formName;
		}
	}
	$cf7FormsList = array(array(    
					'type'	=>'select',		
					'name'  =>'cf7_form_id',		
					'label' =>"Select Form",
					'tab'     =>'customizer',
					'default' =>'',
					'options_details'=>$cf7formArray,
					'content_type'=>'html',
					'required'  => array('form_type' => 'contact-form-7'),
				));

}
if(is_plugin_active('amp-gravity-forms/amp-gravity-forms.php') && class_exists('RGFormsModel')){
	$formSupported = array_merge($formSupported, array('gravityform'=>'Gravity Form'));

	$apbGFforms = RGFormsModel::get_forms();
	$grvtyformArray = array();
	if(count($apbGFforms)){
		foreach( $apbGFforms as $form ):
			$grvtyformArray[$form->id] = $form->title;
		endforeach;
	}
	$gravityFormsList = array(array(    
					'type'	=>'select',		
					'name'  =>'gf_form_id',		
					'label' =>"Select Form",
					'tab'     =>'customizer',
					'default' =>'',
					'options_details'=>$grvtyformArray,
					'content_type'=>'html',
					'required'  => array('form_type' => 'gravityform'),
				));
}
if(function_exists('ampforwp_wpforms_initiate_plugin')){
	$formSupported = array_merge($formSupported, array('wpforms'=>'WP Forms'));

	//$args  = apply_filters( 'wpforms_modal_select', array() );
	// No ID provided, get multiple forms
	$defaults = array(
		'post_type'     => 'wpforms',
		'orderby'       => 'id',
		'order'         => 'ASC',
		'no_found_rows' => true,
		'nopaging'      => true,
	);
	$args = wp_parse_args( $args, $defaults );
	$args['post_type'] = 'wpforms';
	$forms = get_posts( $args );
	$wpformsArray = array();
	if(count($forms)){
		foreach( $forms as $form ):
			$wpformsArray[$form->ID] = $form->post_title;
		endforeach;
	}
	$wpformsList = array(array(    
					'type'	=>'select',		
					'name'  =>'wp_forms_id',		
					'label' =>"Select Form",
					'tab'     =>'customizer',
					'default' =>'',
					'options_details'=>$wpformsArray,
					'content_type'=>'html',
					'required'  => array('form_type' => 'wpforms'),
				));
}
if(is_plugin_active('amp-ninja-forms/amp-ninja-forms.php') && function_exists('Ninja_Forms')){
	$formSupported = array_merge($formSupported, array('ninja_form'=>'Ninja Forms'));

	$ninjaforms_modified = array();

	if ( get_option( 'ninja_forms_load_deprecated', false ) ) {
		$forms = Ninja_Forms()->forms()->get_all();

		foreach ( $forms as $form_id ) {
			$ninjaforms_modified[ $form_id ] = Ninja_Forms()->form( $form_id )->get_setting( 'form_title' );;
		}
	} else {
		$forms = Ninja_Forms()->form()->get_forms();
		foreach ( $forms as $index => $form ) {
			$ninjaforms_modified[ $form->get_id() ] = $form->get_setting( 'title' );
		}
	}
	$ninjaFormList = array(array(    
					'type'	=>'select',		
					'name'  =>'nj_forms_id',		
					'label' =>"Select Form",
					'tab'     =>'customizer',
					'default' =>'',
					'options_details'=>$ninjaforms_modified,
					'content_type'=>'html',
					'required'  => array('form_type' => 'ninja_form'),
				));
}

$formFields = array(
				array(    
					'type'	=>'select',		
					'name'  =>'form_type',		
					'label' =>"Select Form",
					'tab'     =>'customizer',
					'default' =>'',
					'options_details'=>$formSupported,
					'content_type'=>'html',
					'helpmessage' => 'This module requires <a href="https://ampforwp.com/contact-form-7" target="_blank">AMP Contact Form 7</a> , <a href="https://ampforwp.com/gravity-forms/" target="_blank">AMP Gravity Forms</a> or <a href="https://ampforwp.com/ninja-forms/" target="_blank">Ninja Forms for AMP</a> Extension. <a target="_blank" href="https://ampforwp.com/extensions/">View all the Extensions</a>'
				),
			);
if(isset($cf7FormsList)){
	$formFields = array_merge($formFields, $cf7FormsList);
}
if(isset($gravityFormsList)){
	$formFields = array_merge($formFields, $gravityFormsList);
}
if(isset($wpformsList)){
	$formFields = array_merge($formFields, $wpformsList);
}
if(isset($ninjaFormList)){
	$formFields = array_merge($formFields, $ninjaFormList);
}
return array(
		'label' =>'Contact Forms',
		'name' =>'contact-form-shortcode',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced',
			  'layout' => 'Layout'
            ),
		'fields' => $formFields,
		'front_template'=> $output,
		'front_common_css'=>'',
	);

?>