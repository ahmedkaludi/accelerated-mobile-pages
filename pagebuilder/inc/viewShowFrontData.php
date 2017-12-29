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

	echo '.amp_pb{display: inline-block;width: 100%;}
.row{display: inline-flex;width: 100%;}
.col-2{width:50%;float:left;}
.cb{clear:both;}
.amp_blurb{text-align:center}
.amp_blurb amp-img{margin: 0 auto;}
.amp_btn{text-align:center}
.amp_btn a{background: #f92c8b;color: #fff;padding: 9px 20px;border-radius: 3px;display: inline-block;box-shadow: 1px 1px 4px #ccc;}
.amppb-fixed{width:1125px;}
.amppb-fluid{width:100%;}
.amppb-pages .cntr{max-width:100%;}
.amppb-pages header .cntr{max-width: 1100px;}
';

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
							if(isset($rowfield['required']) && count($rowfield['required'])>0){
								foreach($rowfield['required'] as $requiredKey=>$requiredValue){
									if(isset($rowContainer[$requiredKey]) && $rowContainer[$requiredKey] != $requiredValue){
										$replaceRow ='';
									} 
								}

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
										$replaceSpacing = $replaceRow['top']." ".$replaceRow['right']."
                                        ".$replaceRow['bottom']."
                                        ".$replaceRow['left']." ";
									}
									$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceSpacing, $rowCss);

								break;
								default:
									if(is_array($replaceRow)){
										if(count($replaceRow)>0){
											if(count($replaceRow)==1){
												$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceRow[0], $rowCss);
											}
										}else{
											$rowCss = str_replace('{{'.$rowfield['name'].'}}', '', $rowCss);
										}
										
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
					echo amppb_validateCss($rowCss);
				}//Row Settings Css foreach closed

				if(count($container)>0){
					//Module specific styles
					$moduleCommonCss = array();
					foreach($container as $contentArray){
						
						if(isset($moduleTemplate[$contentArray['type']]['front_css'])){
							$completeCss = $moduleTemplate[$contentArray['type']]['front_css'];
							$completeCss = str_replace("{{module-class}}", '.amppb-module-'.$contentArray['cell_id'], $completeCss );
						}
						if(isset($moduleTemplate[$contentArray['type']]['front_common_css'])){
							$moduleCommonCss[$moduleTemplate[$contentArray['type']]['name']] = $moduleTemplate[$contentArray['type']]['front_common_css'];
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
								if(isset($modulefield['required']) && count($modulefield['required'])>0){
									foreach($modulefield['required'] as $requiredKey=>$requiredValue){
										$userSelectedvalue = $contentArray[$requiredKey];
										if($userSelectedvalue != $requiredValue){
											$replaceModule ='';
										} 
									}

								}
								switch ($modulefield['type']) {
									case 'spacing':
									 	$replacespacing ="";
										if(isset($replaceModule['top']) 
											&& isset($replaceModule['right'])
											&& isset($replaceModule['bottom'])
											&& isset($replaceModule['left'])
										){
										$replacespacing = $replaceModule['top']."px ".$replaceModule['right']."px ".$replaceModule['bottom']."px ".$replaceModule['left']."px ";
										}
										$completeCss = str_replace('{{'.$modulefield['name'].'}}', $replacespacing, $completeCss);
										
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
						echo amppb_validateCss($completeCss);
						
						//For Repeater Fields
						$repeaterFieldsCss = '';
			            if(isset($moduleTemplate[$contentArray['type']]['repeater'])){
			              
			              if(isset($contentArray['repeater']) && is_array($contentArray['repeater'])){
			                $repeaterUserContents = $contentArray['repeater'];
			                foreach ($repeaterUserContents as $repeaterUserKey => $repeaterUserValues) {
			 
			                  $repeaterFrontCss = $moduleTemplate[$contentArray['type']]['repeater']['front_css'];
			                  //reset($repeaterUserValues);
			                  $repeaterVarIndex = key($repeaterUserValues);
			                  $repeaterVarIndex = explode('_', $repeaterVarIndex);
			                  $repeaterVarIndex = end($repeaterVarIndex);
			                  
			                  foreach ($moduleTemplate[$contentArray['type']]['repeater']['fields'] as $moduleKey => $moduleField) {
			                   
			                    //LOAD Icon Css 
			                    if($moduleField['type']=='icon-selector'){
			                      add_amp_icon(array( $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex]));
			                    }
			                    if($moduleField['content_type']=='css'){
			                    	$replace = $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex];
				                    if(is_array($replace)){
				                      if(count($replace)>0){
				                        $replace = $replace[0];
				                      }else{
				                        $replace ='';
				                      }
				                    }
			                      $repeaterFrontCss = $moduleTemplate[$contentArray['type']]['repeater'];
			                      if($modulefield['type']=='spacing'){
			                        $replacespacing ="";
			                        if(isset($replaceModule['top']) 
			                          && isset($replaceModule['right'])
			                          && isset($replaceModule['bottom'])
			                          && isset($replaceModule['left'])
			                        ){
			                        $replacespacing = $replaceModule['top']." ".$replaceModule['right']." ".$replaceModule['bottom']." ".$replaceModule['left']." ";
			                        }
			                        $repeaterFrontCss = str_replace('{{'.$modulefield['name'].'}}', $replacespacing, $repeaterFrontCss);
			                      }else{
			                        $repeaterFrontCss = str_replace(
			                              '{{'.$moduleField['name'].'}}', 
			                               $replace, 
			                              $repeaterFrontCss
			                            );
			                      }
			 
			                      
			                    }
			                  }
			                  $repeaterFieldsCss .= $repeaterFrontCss;
			                }
			              }//If Check for Fall back
			              
			            }//If for Module is repeater or not
			            echo $repeaterFieldsCss;



					}//foreach content closed 

					//For Comon CSS
					if(count($moduleCommonCss)>0){
						echo implode(" ", $moduleCommonCss);
					}
					
				}//ic container check closed
				//Create row css
			
				

			}//foreach closed complete data
		}//if closed  count($previousData['rows'])>0
	}//If Closed  $previousData!="" && $ampforwp_pagebuilder_enable=='yes'
} 
function amppb_validateCss($css){
	$css = preg_replace('/(?:[^\r\n,{}]+)(?:,(?=[^}]*{,)|\s*{[\s]*})/', "", $css);
	$css = preg_replace('/(([a-z -]*:(\s)*;))/', "", $css);
	$css = preg_replace('/((;[\s\n;]*;))/', ";", $css);
	return $css;
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
							$replace .= ' '.$rowsData['data'][$field['name']];
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
	return do_shortcode($content);
}

function rowData($container,$col,$moduleTemplate){
	$ampforwp_show_excerpt = true;
	$html = '';
	if(count($container)>0){
		$html .= "<div class='col col-".$col."'>";
		//sort modules by index
		$container = sortByIndex($container);
		if(count($container)>0){
			foreach($container as $contentKey=>$contentArray){
				if(!isset($moduleTemplate[$contentArray['type']])){
					continue;
				}
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
											 $replace = $contentArray[$field['name']];
											if($field['type']=="upload"){
											 
												$imageDetails = get_attachment_id( $replace);
												$imageUrl = $imageDetails[0];
												$imageWidth = $imageDetails[1];
												$imageHeight = $imageDetails[2];
												$moduleFrontHtml = str_replace(
															'{{'.$field['name'].'}}', 
															 $imageUrl, 
															$moduleFrontHtml
														);
												$moduleFrontHtml = str_replace(
															'{{image_width}}', 
															 $imageWidth, 
															$moduleFrontHtml
														);
												$moduleFrontHtml = str_replace(
															'{{image_height}}', 
															 $imageHeight, 
															$moduleFrontHtml
														);
											}else{
												$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', urldecode( $replace), $moduleFrontHtml);
											}
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

				$repeaterFields = '';
				if(isset($moduleTemplate[$contentArray['type']]['repeater'])){
					
					if(isset($contentArray['repeater']) && is_array($contentArray['repeater'])){
						$repeaterUserContents = $contentArray['repeater'];
						foreach ($repeaterUserContents as $repeaterUserKey => $repeaterUserValues) {

							$repeaterFrontTemplate = $moduleTemplate[$contentArray['type']]['repeater']['front_template'];
							//reset($repeaterUserValues);
							$repeaterVarIndex = key($repeaterUserValues);
							$repeaterVarIndex = explode('_', $repeaterVarIndex);
							$repeaterVarIndex = end($repeaterVarIndex);
							
							foreach ($moduleTemplate[$contentArray['type']]['repeater']['fields'] as $moduleKey => $moduleField) {
								if($moduleField['content_type']=='html'){
									$replace = $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex];
									if(is_array($replace)){
										if(count($replace)>0){
											$replace = $replace[0];
										}else{
											$replace ='';
										}
									}
									if($moduleField['type']=="upload"){
										$imageDetails = get_attachment_id( $replace);
										$imageUrl = $imageDetails[0];
										$imageWidth = $imageDetails[1];
										$imageHeight = $imageDetails[2];
										$repeaterFrontTemplate = str_replace(
													'{{'.$moduleField['name'].'}}', 
													 $imageUrl, 
													$repeaterFrontTemplate
												);
										$repeaterFrontTemplate = str_replace(
													'{{image_width}}', 
													 $imageWidth, 
													$repeaterFrontTemplate
												);
										$repeaterFrontTemplate = str_replace(
													'{{image_height}}', 
													 $imageHeight, 
													$repeaterFrontTemplate
												);
									}else{
										$repeaterFrontTemplate = str_replace(
													'{{'.$moduleField['name'].'}}', 
													 $replace, 
													$repeaterFrontTemplate
												);
									}

									
								}
							}
							$repeaterFields .= $repeaterFrontTemplate;
						}
					}//If Check for Fall back
					
				}//If for Module is repeater or not
				$moduleFrontHtml = str_replace('{{repeater}}', $repeaterFields, $moduleFrontHtml);

				$html .= "<div class='amppb-module-".$contentArray['cell_id'].' '.$contentArray['type']."'>".$moduleFrontHtml;
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
			if(!isset($completeSortedArray[$singleContent['index']])){
				$completeSortedArray[$singleContent['index']] = $singleContent;
			}else{
				$completeSortedArray[] = $singleContent;
			}
			
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

function get_attachment_id( $url ) {
	if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
		$attachment_id = $url;
	}else{
		$attachment_id = 0;
		$dir = wp_upload_dir();
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
			$file = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				)
			);
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post_id ) {
					$meta = wp_get_attachment_metadata( $post_id );
					$original_file       = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}
				}
			}
		}

	}
	return wp_get_attachment_image_src($attachment_id,'full',false);
}