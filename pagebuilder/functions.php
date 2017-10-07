<?php

require_once("config/moduleTemplate.php");

$output = '<div class="amp_pb_module {{row_class}}">';
$outputEnd = '</div>';
$containerCommonSettings = array(
			'fields' => array(
							array(
								'type'		=>'text',
								'name'		=>"row_label",
								'label'		=>'Row label',
								'default'	=>'',
								),
					
							array(
								'type'		=>'text',
								'name'		=>"row_class",
								'label'		=>'Row class',
								'default'	=>'',
								)
							),
			'front_template_start'=>$output,
			'front_template_end'=>$outputEnd
			);


/* Admin Script */
add_action( 'admin_enqueue_scripts', 'amppbbase_admin_scripts' );
 
/**
 * Admin pagebuilder Scripts
 * @since 1.0.0Scripts
 */
function amppbbase_admin_scripts( $hook_suffix ){
    global $post_type;
    global $moduleTemplate;
    /* In Page Edit Screen */
    //if( 'page' == $post_type && in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ){
    if($post_type=='post' || $post_type=='page'){
 	    /* Enqueue CSS & JS For Page Builder */
        wp_enqueue_style( 'amppb-admin', AMP_PAGE_BUILDER_URL. 'inc/admin-amp-page-builder.css', array(), '0.0.1' );

        wp_enqueue_media();

        wp_enqueue_script( 'amppb-admin', AMP_PAGE_BUILDER_URL. 'inc/admin-amp-page-builder.js', array(
					'jquery',
					'jquery-ui-resizable',
					'jquery-ui-sortable',
					'jquery-ui-draggable',
					'jquery-ui-droppable',
					'underscore',
					'backbone',
					'plupload',
					'plupload-all',
				), '0.0.1', true );
        add_action( 'admin_footer', 'js_templates');
    }
}


function js_templates() {
	global $containerCommonSettings;
	include plugin_dir_path( __FILE__ ) . '/inc/js-templates.php';
}

/**
 *
 *
 *
 *
 *
 **/
/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'amppb_save_post', 10, 2 );
 
/**
 * Save Page Builder Data When Saving Page
 */
function amppb_save_post( $post_id, $post ){
 
    /* Stripslashes Submitted Data */
    $request = stripslashes_deep( $_POST );
 
    /* Verify/validate */
    if ( ! isset( $request['amppb_nonce'] ) || ! wp_verify_nonce( $request['amppb_nonce'], 'amppb_nonce_action' ) ){
        return $post_id;
    }
    /* Do not save on autosave */
    if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    
    /* == Save, Delete, or Update Page Builder Data == */
 
    /* Get (old) saved page builder data */
    $saved_data = get_post_meta( $post_id, 'amp-page-builder', true );
 
    /* Get new submitted data and sanitize it. */
    $submitted_data = isset( $request['amp-page-builder'] ) ?  $request['amp-page-builder']  : null;
    $submitted_data = (str_replace("'", "", $submitted_data));
    //$submitted_data = json_decode($submitted_data,true);
   // $submitted_data = wp_slash(json_encode($submitted_data));
    $submitted_data = wp_slash($submitted_data);
    
    /* New data submitted, No previous data, create it  */
    if ( $submitted_data && '' == $saved_data ){
        add_post_meta( $post_id, 'amp-page-builder', $submitted_data, true );
    }
    /* New data submitted, but it's different data than previously stored data, update it */
    elseif( $submitted_data ){
        update_post_meta( $post_id, 'amp-page-builder', $submitted_data );
    }
    
    /* New data submitted is empty, but there's old data available, delete it. */
    elseif ( empty( $submitted_data ) && $saved_data ){
        delete_post_meta( $post_id, 'amp-page-builder' );
    }
}



add_action("pre_amp_render_post",'amp_pagebuilder_content');
add_action('amp_post_template_css','amp_pagebuilder_content_styles',100);
function amp_pagebuilder_content_styles(){
	?>
    .row{display: inline-flex;width: 100%;}
	.col-2{width:50%;float:left;}
    .amp_blurb{text-align:center}
    .amp_blurb amp-img{margin: 0 auto;}
    .amp_btn{text-align:center}
    .amp_btn a{background: #f92c8b;color: #fff;padding: 9px 20px;border-radius: 3px;display: inline-block;box-shadow: 1px 1px 4px #ccc;}
	<?php
} 
	function amp_pagebuilder_content(){
			add_filter( 'the_content', 'amppb_post_content', 1 ); // Run 
	}



function amppb_post_content($content){
	global $post;
	global $containerCommonSettings;

	$previousData = get_post_meta($post->ID,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	if($previousData!=""){
		$html ="";
		$previousData = (str_replace("'", "", $previousData));
		$previousData = json_decode($previousData,true);
		//Call Sorting for rows 
		if(count($previousData['rows'])>0){
			$html = '<div class="amp_pb">';
			$previousData = sortByIndex($previousData['rows']);

			//rander its html
			foreach ($previousData as $key => $rowsData) {
				$customClass = '';
				$rowStartTemplate = $containerCommonSettings['front_template_start'];
				$rowEndTemplate = $containerCommonSettings['front_template_end'];
				
				foreach ($containerCommonSettings['fields'] as $key => $field) {
					if(isset($rowsData['data'][$field['name']])){
						$replace = $rowsData['data'][$field['name']];
					}else{
						$replace = '';
					}
					$customClass = str_replace('{{'.$field['name'].'}}', $replace, $rowStartTemplate);
				}
				$html .= $customClass;
				//$html .= '<div class="row '.$customClass.'">';
				if(count($rowsData['cell_data'])>0){
					switch ($rowsData['cells']) {
						case '1':
							$html .= rowData($rowsData['cell_data'],$rowsData['cells']);
						break;
						case '2':
							$colData = array();
							foreach($rowsData['cell_data'] as $colDevider){
								$colData[$colDevider['cell_container']][] = $colDevider;
							}

							foreach($colData as $data)
								$html .= rowData($data,$rowsData['cells']);
						break;
						
						default:
							# code...
							break;
					}
				}
				$html .= $rowEndTemplate;
			}
				$html .= '</div>';
		}
		if(!empty($html)){
			$content = $html;	
		}
	}
	return $content;
}

function rowData($container,$col){
	global $moduleTemplate;
	$html = '';
	if(count($container)>0){
		$html .= "<div class='col col-".$col."'>";
		//sort modules by index
		$container = sortByIndex($container);
		if(count($container)>0){
			
			foreach($container as $contentArray){
				$moduleFrontHtml = $moduleTemplate[$contentArray['type']]['front_template'];
				
				foreach ($moduleTemplate[$contentArray['type']]['fields'] as $key => $field) {
					if(isset($contentArray[$field['name']]) && !empty($contentArray)){
						$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', $contentArray[$field['name']], $moduleFrontHtml);
					}else{
						$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', "", $moduleFrontHtml);
					}
				}
				$html .= $moduleFrontHtml;
				/*if($contentArray['type']=="text"){
					$html .= "<p class='col-wrapper'>".$contentArray['value']."</div>";
				}else{
					$html .= $contentArray['value'];
				}*/
			}
				
		}
		$html .= "</div>";
	}
	return $html;
}

function sortByIndex($contentArray){
	$completeSortedArray = array();
	if(count($contentArray)>0){
		foreach ($contentArray as $key => $singleContent) {
			$completeSortedArray[$singleContent['index']] = $singleContent;
		}
		ksort($completeSortedArray);
		return $completeSortedArray;
	}else{
		return $contentArray;
	}
}




