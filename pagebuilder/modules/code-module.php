<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
add_filter("ampforwp_extension_pagebuilder_module_template", 'ampforwp_code_module_replacement',10,3);
function ampforwp_code_module_replacement($moduleFrontHtml,$moduleTemplate, $contentArray){
	if($moduleTemplate['name']==='code'){
		if(isset($moduleTemplate['fields']) && count($moduleTemplate['fields']) > 0) {
			foreach ($moduleTemplate['fields'] as $key => $field) {
				if(!empty($contentArray) && !isset($contentArray[$field['name']])){
					$replace = getdefaultValue($field['name'], $moduleTemplate['fields']);
				}else{
					 $replace = $contentArray[$field['name']];
				}
				
				$moduleFrontHtml = str_replace('{{'.$field['name'].'}}',  $replace, $moduleFrontHtml);
				$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], $replace, $moduleFrontHtml);
			}
			$moduleFrontHtml = htmlspecialchars_decode($moduleFrontHtml);
		}
		
	}
	return $moduleFrontHtml;
}

$output = '{{code_content}}';
$css = '
';
return array(
		'label' =>'Code',
		'name' =>'code',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'			=> 'textarea',		
		 						'name'			=> "code_content",		
		 						'label'			=> 'Enter your code here',
		           				'tab'     		=> 'customizer',
		 						'default'		=> '',	
		 						'helpmessage'	=> 'please Insert only HTML Codes',
		           				'content_type'	=> 'html',
	 						),
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);


?>