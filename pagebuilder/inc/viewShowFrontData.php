<?php
/***
Show Front Data
****/

add_action('pre_amp_render_post','amp_pagebuilder_content');
function amp_pagebuilder_content(){ 
	if (empty_content(get_post()->post_content)) { 
		$arr['ID'] = get_post()->ID;
		$arr['post_content'] = '&nbsp;';
		wp_update_post($arr);
	}
	add_filter( 'amp_pagebuilder_content', 'ampforwp_insert_pb_content' );
}

function bodyClassForAMPPagebuilder($classes, $class){
	$classes[] = 'amppb-pages';
	return $classes;
}

function  ampforwp_insert_pb_content( $content ){
	$new_content = "";
	$new_content = amppb_post_content($content);
	$content = $new_content;
	return $content;
}


add_action('amp_post_template_css','amp_pagebuilder_content_styles',100);
function amp_pagebuilder_content_styles(){
	?>.amp_pb{display: inline-block;width: 100%;}
    .row{display: inline-flex;width: 100%;}
	.col-2{width:50%;float:left;}
	.cb{clear:both;}
    .amp_blurb{text-align:center}
    .amp_blurb amp-img{margin: 0 auto;}
    .amp_btn{text-align:center}
    .amp_btn a{background: #f92c8b;color: #fff;padding: 9px 20px;border-radius: 3px;display: inline-block;box-shadow: 1px 1px 4px #ccc;}
	.amppb-fixed{width:1100px;margin: 0 auto;}
	.amppb-fluid{width:100%;margin: 0 auto;padding: 0 5%;}
	.amppb-pages .cntr{max-width:100%;}
	.amp_pb_module{display:inline-flex; width:100%;}
	.col.col-1{margin:0 auto;width: 100%;display: flex;}
	<?php
	//To load css of modules which are in use
	global $redux_builder_amp, $moduleTemplate, $post, $containerCommonSettings;
	$postId = $post->ID;
	if(is_home() && $redux_builder_amp['ampforwp-homepage-on-off-support']==1 && ampforwp_get_blog_details() == false){
		$postId = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
	$previousData = get_post_meta($postId,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	if($previousData!="" && $ampforwp_pagebuilder_enable=='yes'){
		add_filter('ampforwp_body_class', 'bodyClassForAMPPagebuilder',10,2);
		$previousData = (str_replace("'", "", $previousData));
		$previousData = json_decode($previousData,true);
		if(count($previousData['rows'])>0){

			foreach ($previousData['rows'] as $key => $rowsData) {
				$container = $rowsData['cell_data'];
				$rowContainer = $rowsData['data'];
				if(isset($containerCommonSettings['front_css'])){
					$rowCss = $containerCommonSettings['front_css'];
					$rowCss = str_replace('{{row-class}}', '.row-setting-'.$rowsData['id'], $rowCss);
					foreach($containerCommonSettings['fields'] as $rowfield){
						if($rowfield['content_type']=='css'){
							$replaceRow = '';
							if(isset($rowContainer[$rowfield['name']])){
								$replaceRow = $rowContainer[$rowfield['name']];
							}
							switch ($rowfield['type']) {
								case 'spacing':
								$replaceSpacing ='';
									if(
										isset($replaceRow['top'])&&
										isset($replaceRow['right'])&&
										isset($replaceRow['bottom'])&&
										isset($replaceRow['left'])
									){
										$replaceSpacing = $replaceRow['top']."px ".$replaceRow['right']."px ".$replaceRow['bottom']."px ".$replaceRow['left']."px ";
									}
									$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceSpacing, $rowCss);

								break;
								default:
									if(is_array($replaceRow)){
										/*foreach ($rowContainer[$rowfield['name']] as $key => $cssValue) {
											# code...
										}()*/
									}else{
										$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceRow, $rowCss);
									}
								break;
							}
						}
					}
					echo $rowCss;
				}

				if(count($container)>0){
					//Module specific styles
					foreach($container as $contentArray){
						
						if(isset($moduleTemplate[$contentArray['type']]['front_css'])){
							$completeCss = $moduleTemplate[$contentArray['type']]['front_css'];
							$completeCss = str_replace("{{module-class}}", '.amppb-module-'.$contentArray['cell_id'], $completeCss );
						}


						foreach($moduleTemplate[$contentArray['type']]['fields'] as $modulefield){
							//LOAD Icon Css 
							if($modulefield['type']=='icon-selector'){
								add_amp_icon(array($contentArray[$modulefield['name']]));
							}
							if($modulefield['content_type']=='css'){
								$replaceModule = "";
								if(isset($contentArray[$modulefield['name']])){
									$replaceModule = $contentArray[$modulefield['name']];
								}
								switch ($modulefield['type']) {
									case 'spacing':
										$replaceRow ="";
										if(isset($replaceRow['top']) 
											&& isset($replaceRow['right'])
											&& isset($replaceRow['bottom'])
											&& isset($replaceRow['left'])
										){
										$replaceRow = $replaceRow['top']."px ".$replaceRow['right']."px ".$replaceRow['bottom']."px ".$replaceRow['left']."px ";
								}
										$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceRow, $rowCss);
										
									break;
									default:
										if(is_array($replaceModule)){
											/*foreach ($contentArray[$modulefield['name']] as $key => $cssValue) {
												# code...
											}()*/
										}else{
											$completeCss = str_replace('{{'.$modulefield['name'].'}}', $replaceModule, $completeCss);
										}
									break;
								}
							}

						}
						echo $completeCss;
						
					}//foreach content closed 
				}//ic container check closed
				//Create row css
			
				

				

			}//foreach closed complete data
		}//if closed  count($previousData['rows'])>0
	}//If Closed  $previousData!="" && $ampforwp_pagebuilder_enable=='yes'
} 


function amppb_post_content($content){
	global $post,  $redux_builder_amp;
	global $moduleTemplate, $layoutTemplate, $containerCommonSettings;
	$postId = $post->ID;
	if( is_home() && 
		$redux_builder_amp['ampforwp-homepage-on-off-support']==1 &&
		ampforwp_get_blog_details() == false
	){
		$postId = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}

	$previousData = get_post_meta($postId,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	if($previousData!="" && $ampforwp_pagebuilder_enable=='yes'){


		$html ="";
		$previousData = (str_replace("'", "", $previousData));
		$previousData = json_decode($previousData,true);
		//Call Sorting for rows 
		if(count($previousData['rows'])>0){
			$mainContentClass = '';
			if(isset($previousData['settingdata']) && isset($previousData['settingdata']['front_class'])){
				$mainContentClass = $previousData['settingdata']['front_class'];
			}
			$html = '<div class="amp_pb '.$mainContentClass.'">';
			$previousData = sortByIndex($previousData['rows']);

			//rander its html
			foreach ($previousData as $key => $rowsData) {

				$customClass = '';
				$rowStartTemplate = $containerCommonSettings['front_template_start'];
				$rowEndTemplate = $containerCommonSettings['front_template_end'];
				foreach ($containerCommonSettings['fields'] as $key => $field) {
					if($field['content_type']=='html'){
						$replace ='';
						if($field['name'] == 'row_class'){
							$replace .= ' row-setting-'.$rowsData['id'];
						}
						if(isset($rowsData['data'][$field['name']]) && !is_array($rowsData['data'][$field['name']])){
							$replace .= $rowsData['data'][$field['name']];
						}else{
							$replace .= '';
						}
						if(! is_array($field['name']) && $field['content_type']=='html'){
							$rowStartTemplate = str_replace('{{'.$field['name'].'}}', $replace, $rowStartTemplate);
						}
					}
				}
				$html .= $rowStartTemplate;
				//$html .= '<div class="row '.$customClass.'">';
				if(count($rowsData['cell_data'])>0){
					switch ($rowsData['cells']) {
						case '1':
							$html .= rowData($rowsData['cell_data'],$rowsData['cells'],$moduleTemplate);
						break;
						case '2':
							$colData = array();
							foreach($rowsData['cell_data'] as $colDevider){
								$colData[$colDevider['cell_container']][] = $colDevider;
							}

							foreach($colData as $data)
								$html .= rowData($data,$rowsData['cells'],$moduleTemplate);
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

function rowData($container,$col,$moduleTemplate){
	
	$ampforwp_show_excerpt = true;
	$html = '';
	if(count($container)>0){
		$html .= "<div class='col col-".$col."'>";
		//sort modules by index
		$container = sortByIndex($container);
		if(count($container)>0){
			foreach($container as $contentArray){
				
				$moduleFrontHtml = $moduleTemplate[$contentArray['type']]['front_template'];
				$moduleName = $moduleTemplate[$contentArray['type']]['name'];
				switch($moduleName){
					case 'gallery_image':
						$moduleDetails = $moduleTemplate[$contentArray['type']];
						$moduleFrontHtml = pagebuilderGetGalleryFrontendView($moduleDetails,$contentArray);
					break;
					case 'contents':
						$fieldValues = array();
						foreach($moduleTemplate[$contentArray['type']]['fields'] as $key => $field){
							$fieldValues[$field['name']]= $contentArray[$field['name']];
						}
						
						$args = array(
								'cat' => $fieldValues['category_selection'],
								'posts_per_page' => $fieldValues['show_total_posts'],
								'has_password' => false,
								'post_status'=> 'publish'
							);
						//The Query
						$the_query = new WP_Query( $args );
						 $totalLoopHtml = contentHtml($the_query,$fieldValues);
						$moduleFrontHtml = str_replace('{{content_title}}', urldecode($fieldValues['content_title']), $moduleFrontHtml);
						$moduleFrontHtml = str_replace('{{category_selection}}', $totalLoopHtml, $moduleFrontHtml);
						/* Restore original Post Data */
						wp_reset_postdata();
						
					break;
					default:
                        if(isset($moduleTemplate[$contentArray['type']]['fields']) && count($moduleTemplate[$contentArray['type']]['fields']) > 0) {
							foreach ($moduleTemplate[$contentArray['type']]['fields'] as $key => $field) {
								if($field['content_type']=='html'){
									if(isset($contentArray[$field['name']]) && !empty($contentArray) ){

										if(!is_array($contentArray[$field['name']])){
											$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', urldecode($contentArray[$field['name']]), $moduleFrontHtml);
										}else{
											if(count($contentArray[$field['name']])>0){
												foreach ($contentArray[$field['name']] as $key => $userValue) {
													if(count($contentArray[$field['name']])==1){
														$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', $userValue, $moduleFrontHtml);
													}else{
														$moduleFrontHtml = str_replace('{{'.$field['name'].$key.'}}', $userValue, $moduleFrontHtml);
													}
												}
													
											}else{
												$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', "", $moduleFrontHtml);
											}
										}


									}else{
										$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', "", $moduleFrontHtml);
									}
								}//If Closed content type html
								
								
							}//Foreach closed
	                    }//If closed
					break;
				}
				$html .= "<div class='amppb-module-setting-".$contentArray['cell_id'].' '.$contentArray['type']."'>".$moduleFrontHtml;
				$html .= '</div>';
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
function ampforwp_pagebuilder_module_style(){
	echo $redux_builder_amp['css_editor'];
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
function empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}