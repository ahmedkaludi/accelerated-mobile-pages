<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/***
Show Front Data
****/

add_action('pre_amp_render_post','amp_pagebuilder_content');
function amp_pagebuilder_content(){ 
	global $post,  $redux_builder_amp;
	
  	$postId = (is_object($post) ? $post->ID : '');

	if( ampforwp_is_front_page() ){
		$postId = ampforwp_get_frontpage_id();
	}
	if ( ampforwp_polylang_front_page() ) {
		$front_page_id = get_option('page_on_front');
		if($front_page_id){
			$postId = pll_get_post($front_page_id);
		}
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

add_action('amp_post_template_head','ampforwp_pagebuilder_header_html_output',11);
function ampforwp_pagebuilder_header_html_output(){
	//To load css of modules which are in use
	global $redux_builder_amp, $moduleTemplate, $post, $containerCommonSettings;

	$postId = (is_object($post)? $post->ID: '');
	if( ampforwp_is_front_page() ){
		$postId = ampforwp_get_frontpage_id();
	}
	$previousData = get_post_meta($postId,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	if($previousData!="" && $ampforwp_pagebuilder_enable=='yes'){
		$previousData = json_decode($previousData,true);
		if(isset($previousData['settingdata']['scripts_data']) && $previousData['settingdata']['scripts_data']!=""){
			preg_match_all("/<script(?:(?!src).)*>(.*?)<\/script>/",$previousData['settingdata']['scripts_data'], $outremove, PREG_SET_ORDER);
		    if($outremove && count($outremove)>0){
		        foreach($outremove as $unwanted){
		            $previousData['settingdata']['scripts_data'] = str_replace($unwanted[0], '', $previousData['settingdata']['scripts_data']);
		        }
		    }
			echo $previousData['settingdata']['scripts_data']; // nothing to escaped
		}
	}
}
add_action('amp_post_template_data','amp_pagebuilder_script_loader',100);
function amp_pagebuilder_script_loader($scriptData){
	//To load css of modules which are in use
	global $redux_builder_amp, $moduleTemplate, $post, $containerCommonSettings;

	$postId = (is_object($post)? $post->ID: '');
	if( ampforwp_is_front_page() ){
		$postId = ampforwp_get_frontpage_id();
	}
	$previousData = get_post_meta($postId,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	if($previousData!="" && $ampforwp_pagebuilder_enable=='yes'){
		$previousData = json_decode($previousData,true);
		if(isset($previousData['rows']) && count($previousData['rows'])>0){
			foreach ($previousData['rows'] as $key => $rowsData) {
				$container = $rowsData['cell_data'];
				if(count($container)>0){
					//Module specific styles
					$moduleCommonCss = array();
					foreach($container as $contentArray){
						if(!isset($moduleTemplate[$contentArray['type']])){
							continue;
						}
						foreach($moduleTemplate[$contentArray['type']]['fields'] as $modulefield){
							$replaceModule = "";
							if(isset($contentArray[$modulefield['name']])){
								$replaceModule = $contentArray[$modulefield['name']];
							}
							if($modulefield['content_type']=='js'){

								if(isset($modulefield['required']) && count($modulefield['required'])>0){
									foreach($modulefield['required'] as $requiredKey=>$requiredValue){
										$userSelectedvalue = (isset($contentArray[$requiredKey])? $contentArray[$requiredKey]: "");
										if($userSelectedvalue != $requiredValue){
											$replaceModule ='';
										} 
									}
								}//Require IF Closed

								if ($replaceModule !="" && empty( $scriptData['amp_component_scripts'][$modulefield['label']] ) ) {
									$scriptData['amp_component_scripts'][$modulefield['label']] = $replaceModule;
								}
							}//content_type Check if Closed
						}

					}
				}
			}
		}


	}



	
	return $scriptData;
}

add_action('amp_post_template_css','amp_pagebuilder_content_styles',100);
function amp_pagebuilder_content_styles(){
	//To load css of modules which are in use
	global $redux_builder_amp, $moduleTemplate, $post, $containerCommonSettings;
	$completeCssOfPB = '';	
	$postId = (is_object($post)? $post->ID: '');
	if( ampforwp_is_front_page() ) {
		$postId = ampforwp_get_frontpage_id();
	}
	if ( ampforwp_polylang_front_page() ) {
		$front_page_id = get_option('page_on_front');
		if($front_page_id){
			$postId = pll_get_post($front_page_id);
		}
	}
	$previousData = get_post_meta($postId,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	if($previousData!="" && $ampforwp_pagebuilder_enable=='yes'){

	$completeCssOfPB .= '.amp_pb{display: inline-block;width: 100%;}
.row{display: inline-flex;width: 100%;}
.col-2{ width: calc(50% - 5px);float:left;}
.col-2-wrap .col-2:nth-child(1){
	padding-right:5px;
}
.col-2-wrap .col-2:nth-child(2){
	padding-left:5px;
}
.cb{clear:both;}
.amp_blurb{text-align:center}
.amp_blurb amp-img{margin: 0 auto;}
.amp_btn{text-align:center}
.amp_btn a{background: #f92c8b;color: #fff;padding: 9px 20px;border-radius: 3px;display: inline-block;box-shadow: 1px 1px 4px #ccc;}


@media(max-width:1024px){
.amppb-fixed{width:100%;}
}
@media(max-width:425px){
.col-2{width:100%;float:none;margin-bottom:10%;}
.col-2-wrap .col-2:nth-child(1){padding-right:0px;}
.col-2-wrap .col-2:nth-child(2){padding-left:0px;}
.sbs .col-2{width: calc(50% - 5px);float: left;margin:2px;}
}
';

		add_filter('ampforwp_body_class', 'bodyClassForAMPPagebuilder',10,2);
		$previousData = json_decode($previousData,true);
		if(isset($previousData['rows']) && count($previousData['rows'])>0){

			foreach ($previousData['rows'] as $key => $rowsData) {
				$container = $rowsData['cell_data'];
				$rowContainer = $rowsData['data'];
				
				if(isset($containerCommonSettings['front_css'])){
					$rowCss = $containerCommonSettings['front_css'];
					if( true == $redux_builder_amp['amp-rtl-select-option'] && isset($containerCommonSettings['front_rtl_css'])) {
						$rowCss .= $containerCommonSettings['front_rtl_css'];
					}
					$rowCss = str_replace('{{row-class}}', '.ap_r_'.$rowsData['id'], $rowCss);
					foreach($containerCommonSettings['fields'] as $rowfield){
							$replaceRow = '';
						//if($rowfield['content_type']=='css'){
							if(isset($rowContainer[$rowfield['name']])){
								$replaceRow = $rowContainer[$rowfield['name']];
								
							}elseif(!isset($rowContainer[$rowfield['name']])){
								$replaceRow = $rowfield['default'];
							}
							if(isset($rowfield['required']) && count($rowfield['required'])>0){
								foreach($rowfield['required'] as $requiredKey=>$requiredValue){
									$valueCheckWith = '';
									if(isset($rowContainer[$requiredKey])){
										$valueCheckWith = $rowContainer[$requiredKey];
									}
									if( is_array($valueCheckWith) ) {
										$valueCheckWith = $rowContainer[$requiredKey][0];
									}
									if( $valueCheckWith !== $requiredValue){
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
										$replaceSpacing = $replaceRow['top']." ".$replaceRow['right']." ".$replaceRow['bottom']." ".$replaceRow['left']." ";
									}
									$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceSpacing, $rowCss);

								break;
								case 'upload':
									//$imageDetails = ampforwp_get_attachment_id( $replaceRow);
									$image_alt = $imageUrl = $imageWidth = $imageHeight = '';
									if(isset($rowContainer[$rowfield['name']."_image_data"])){
									 	$replace= $rowContainer[$rowfield['name']."_image_data"];
									 	$imageUrl = $replace[0];
										$imageWidth = $replace[1];
										$imageHeight = $replace[2];
										$image_alt = (isset($replace['alt'])? $replace['alt']: "");;
									}elseif($replaceRow != ""){
										$imageDetails = ampforwp_get_attachment_id( $replaceRow);
										if(is_array($imageDetails)){
											$imageUrl = (isset($imageDetails[0])? $imageDetails[0]: "");
											$imageWidth = (isset($imageDetails[1])? $imageDetails[1]: "");
											$imageHeight = (isset($imageDetails[3])? $imageDetails[2]: "");	
											$image_alt = (isset($imageDetails['alt'])? $imageDetails['alt']: "");
										}
									}
									$rowCss = str_replace(
													'{{'.$rowfield['name'].'}}', 
													 $imageUrl, 
													$rowCss
												);
									$rowCss = str_replace(
												array('{{image_width}}','{{image_width_'.$rowfield['name'].'}}'), 
												array($imageWidth,$imageWidth), 
												$rowCss
											);
									$rowCss = str_replace(
												array('{{image_height}}','{{image_height_'.$rowfield['name'].'}}'), 
												array($imageHeight,$imageHeight), 
												$rowCss
											);
									$rowCss = str_replace(
												array('{{image_alt}}','{{image_alt_'.$rowfield['name'].'}}'), 
												array($image_alt,$image_alt), 
												$rowCss
											);
									$rowCss = str_replace('{{'.$rowfield['name'].'}}', $replaceRow, $rowCss);
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
						//}
						$rowCss = ampforwp_replaceIfContentConditional($rowfield['name'], $replaceRow, $rowCss);
					}
					$completeCssOfPB .= $rowCss;
				}//Row Settings Css foreach closed

				if(count($container)>0){
					//Module specific styles
					$moduleCommonCss = array();
					foreach($container as $contentArray){
						
						if(isset($moduleTemplate[$contentArray['type']]['front_css'])){
							$completeCss = $moduleTemplate[$contentArray['type']]['front_css'];
							if( true == $redux_builder_amp['amp-rtl-select-option'] && isset($moduleTemplate[$contentArray['type']]['front_rtl_css'])) {
								$completeCss .= $moduleTemplate[$contentArray['type']]['front_rtl_css'];
							}
							$completeCss = str_replace("{{module-class}}", '.ap_m_'.$contentArray['cell_id'], $completeCss );
						}
						if(isset($moduleTemplate[$contentArray['type']]['front_common_css'])){
							$moduleCommonCss[$moduleTemplate[$contentArray['type']]['name']] = $moduleTemplate[$contentArray['type']]['front_common_css'];
						}
						if(!isset($moduleTemplate[$contentArray['type']])){
							continue;
						}
						foreach($moduleTemplate[$contentArray['type']]['fields'] as $modulefield){
							$replaceModule = "";
							if(isset($contentArray[$modulefield['name']])){
								$replaceModule = $contentArray[$modulefield['name']];
							}else{
								$replaceModule = getdefaultValue($modulefield['name'],$moduleTemplate[$contentArray['type']]['fields']);
							}
							//LOAD Icon Css 
							if($modulefield['type']=='icon-selector'){
								add_amp_icon(array($replaceModule));
							}
							
							if($modulefield['content_type']=='css'){
								
								if(isset($modulefield['required']) && count($modulefield['required'])>0){
									$requiredCheck[] = true;
									foreach($modulefield['required'] as $requiredKey=>$requiredValue){
										//if value not set than get default value
										if(!isset($contentArray[$requiredKey])){
											$userSelectedvalue = getdefaultValue($requiredKey,$moduleTemplate[$contentArray['type']]['fields']);
										}else{
											$userSelectedvalue = $contentArray[$requiredKey];
											
										}
										if(is_array($requiredValue) && !in_array($userSelectedvalue, $requiredValue) ){
											$requiredCheck[] = false;
										}elseif($userSelectedvalue != $requiredValue){
											$requiredCheck[] = false;
										} 
									}
									$requiredCheck = array_unique($requiredCheck);
									if(count($requiredCheck)>1 && $requiredCheck[0] != true){
										$replaceModule ='';
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
										$replacespacing = $replaceModule['top']." ".$replaceModule['right']." ".$replaceModule['bottom']." ".$replaceModule['left']." ";
										}
										$completeCss = str_replace('{{'.$modulefield['name'].'}}', $replacespacing, $completeCss);
										
									break;
									case 'upload':
										$image_alt = $imageUrl = $imageWidth = $imageHeight = '';
										if(isset($contentArray[$modulefield['name']."_image_data"])){
										 	$replace= $contentArray[$modulefield['name']."_image_data"];
										 	$imageUrl = $replace[0];
											$imageWidth = $replace[1];
											$imageHeight = $replace[2];
											$image_alt = (isset($replace['alt'])? $replace['alt']: "");;
										}elseif($replaceModule != ""){
											$imageDetails = ampforwp_get_attachment_id( $replaceModule);
											if(is_array($imageDetails)){
												$imageUrl = (isset($imageDetails[0])? $imageDetails[0]: "");
												$imageWidth = (isset($imageDetails[1])? $imageDetails[1]: "");
												$imageHeight = (isset($imageDetails[3])? $imageDetails[2]: "");	
												$image_alt = (isset($imageDetails['alt'])? $imageDetails['alt']: "");
											}
										}

										$completeCss = str_replace(
														'{{'.$modulefield['name'].'}}', 
														 $imageUrl, 
														$completeCss
													);
										$completeCss = str_replace(
													array('{{image_width}}','{{image_width_'.$modulefield['name'].'}}'), 
													array($imageWidth,$imageWidth), 
													$completeCss
												);
										$completeCss = str_replace(
													array('{{image_height}}','{{image_height_'.$modulefield['name'].'}}'), 
													array($imageHeight,$imageHeight), 
													$completeCss
												);
										$completeCss = str_replace(
													array('{{image_alt}}','{{image_alt_'.$modulefield['name'].'}}'), 
													array($image_alt,$image_alt), 
													$completeCss
												);

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

							$completeCss = ampforwp_replaceIfContentConditional($modulefield['name'], $replaceModule, $completeCss);
						}
						$completeCssOfPB .= $completeCss;
						
						//For Repeater Fields
						$repeaterFieldsCss = '';
			            if(isset($moduleTemplate[$contentArray['type']]['repeater'])){
			              
			              if(isset($contentArray['repeater']) && is_array($contentArray['repeater'])){
			                $repeaterUserContents = $contentArray['repeater'];
			                foreach ($repeaterUserContents as $repeaterUserKey => $repeaterUserValues) {
			 					
			                  //reset($repeaterUserValues);
			                  $repeaterVarIndex = key($repeaterUserValues);
			                  $repeaterVarIndex = explode('_', $repeaterVarIndex);
			                  $repeaterVarIndex = end($repeaterVarIndex);
			                  $repeaterFrontCss = '';
			                  foreach ($moduleTemplate[$contentArray['type']]['repeater']['fields'] as $moduleKey => $moduleField) {
			                   
			                    //LOAD Icon Css 
			                    if($moduleField['type']=='icon-selector'){
			                    	add_amp_icon(array( $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex]));
			                    }

			                    //Check if there is no front css
			 					if(!isset($moduleTemplate[$contentArray['type']]['repeater']['front_css'])){
			 						continue;
			 					}
			 					$repeaterFrontCss = $moduleTemplate[$contentArray['type']]['repeater']['front_css'];
			 					$repeaterFrontCss = str_replace("{{acc_head_type}}", $moduleTemplate["accordion-mod"]["repeater"]["fields"][1]["default"] , $repeaterFrontCss );
			                    if($moduleField['content_type']=='css'){
			                    	$repeaterFrontCss = str_replace("{{module-class}}", '.ap_m_'.$contentArray['cell_id'], $repeaterFrontCss );
			                    	$repeaterFrontCss = str_replace('{{repeater-module-class}}', $moduleField['name'].'_'.$repeaterVarIndex, $repeaterFrontCss);
			                    	$replace = $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex];
				                    if(is_array($replace)){
				                      if(count($replace)>0){
				                        $replace = $replace[0];
				                      }else{
				                        $replace ='';
				                      }
				                    }

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
			 				}else{
					                $repeaterCss = $moduleTemplate[$contentArray['type']]['repeater']['front_css'];
			                    	if(strpos($repeaterCss, '{{'.$moduleField['name'].'}}')!==false){
			                    		$repeaterFrontCss = $repeaterCss;
			                    		$replace_with = $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex];
				                    	$repeaterFrontCss = str_replace('{{'.$moduleField['name'].'}}',$replace_with, $repeaterFrontCss);
				                    }
			                    }
			                  }
			                  $repeaterFieldsCss .= $repeaterFrontCss;
			                }
			              }//If Check for Fall back
			              
			            }//If for Module is repeater or not
			            $completeCssOfPB .= $repeaterFieldsCss;



					}//foreach content closed 

					//For Comon CSS
					if(count($moduleCommonCss)>0){
						$completeCssOfPB .= implode(" ", $moduleCommonCss);
					}
					
				}//ic container check closed
				//Create row css
			
				

			}//foreach closed complete data
		}//if closed  count($previousData['rows'])>0

		if(isset($previousData['settingdata']['style_data']) && $previousData['settingdata']['style_data']!=""){
			$completeCssOfPB .= $previousData['settingdata']['style_data'];
		}
	}//If Closed  $previousData!="" && $ampforwp_pagebuilder_enable=='yes'
	echo amppb_validateCss($completeCssOfPB);
} 
function amppb_validateCss($css){
	$css = (esc_html($css));
	$css = str_replace('&quot;', '"', $css);
	$css = preg_replace('/@media([^\r\n,{}]+){\s*}/', "", $css);
	$css = str_replace(array('.amppb-fluid','.amppb-fixed','.accordion-mod'), array('.ap-fl','.ap-fi','.apac'), $css);
	$css = preg_replace('/(([a-z -]*:(\s)*;))/', "", $css);
	$css = preg_replace('/((;[\s\n;]*;))/', ";", $css);
	$css = preg_replace('/\s\n+/', "", $css);
	return ampforwp_pb_autoCompileLess($css);
}

function ampforwp_pb_autoCompileLess($css)
{
	$completeCssMinifies = array();
    preg_match_all("/@media\b[^{]*({((?:[^{}]+|(?1))*)})/si",$css,$matches,PREG_SET_ORDER);//$MatchingString now hold all strings matching $pattern.
    foreach ($matches as $key => $value) {
    	preg_match('/@media\s*(.*?)\s*{/', $value[0], $data);
    	if(!isset($completeCssMinifies[$data[1]])){ $completeCssMinifies[$data[1]] = ''; }
    	$completeCssMinifies[$data[1]] .= trim($value[2]);
    }
    // delete media query of cache
    $css = preg_replace('/@media\b[^{]*({((?:[^{}]+|(?1))*)})/si', '', $css);

    // add groups of media query at the end of CSS
    $css = $css." \n";
    $medias = array();
    foreach ($completeCssMinifies as $key => $value) {
    	preg_match_all('!\d+!', $key, $matches);
    	if($matches && !isset($medias[$matches[0][0]])){
			$medias[$matches[0][0]] = $value;
		}
		if($matches && isset($medias[$matches[0][0]])){
			$medias[$matches[0][0]] .= $value;
		}
    }   
    krsort($medias);
    foreach ($medias as $id => $val)
    {	
        $css .= "\n" . '@media(max-width:' . $id . 'px){' . $val . '}' . "\n";
    }
    //Remove multiple Spaces
    //padding:\s*?(\d*px)\s*(\d*px)\s*(\d*px)\s*(\d*px)\s*?;
    //"/(margin|padding):\s*?(\d*px)\s*(\d*px)\s*(\d*px)\s*(\d*px)\s*?\s*;/",
    $css = preg_replace_callback(
    "/(margin|padding):\s*?(auto|\d*(|px))\s*(auto|\d*(|px))\s*(auto|\d*(|px))\s*(auto|\d*(|px))\s*?\s*;/",
    function($m) {
    	if(count($m)!==0){
        	$m[2] = trim($m[2]);
        	$m[3] = trim($m[3]);
        	$m[4] = trim($m[4]);
        	$m[5] = trim($m[5]);
        	if( ($m[2]==$m[6]) && ($m[4] == $m[8]) ){
        		if ( $m[2] == $m[4] ) {
        			return $m[1].":".$m[2].";";
        		}
        		if(trim($m[0])==trim($m[1])){
        			return $m[1].":".$m[2].";";
        		}else{
        			return $m[1].":".$m[2]." ".$m[4].";";
        		}
        	}
        	else{
        		return $m[0];
        	}
        }else{
        	return $m[0];
        }

    },
    $css);
    // save CSS with groups of media query
    return $css;
}

function amppb_post_content($content){
	global $post,  $redux_builder_amp;
	global $moduleTemplate, $layoutTemplate, $containerCommonSettings;

	$postId = (is_object($post)? $post->ID: '');
	if( ampforwp_is_front_page() ){
		$postId = ampforwp_get_frontpage_id();
	}
	if ( ampforwp_polylang_front_page() ) {
		$front_page_id = get_option('page_on_front');
		if($front_page_id){
			$postId = pll_get_post($front_page_id);
		}
	}
	$previousData = get_post_meta($postId,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	if($previousData!="" && $ampforwp_pagebuilder_enable=='yes'){


		$html ="";
		$previousData = json_decode($previousData,true);
		//Call Sorting for rows 
		if(is_array($previousData) && count($previousData['rows'])>0){
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
							$replace .= 'ap_r_'.esc_attr($rowsData['id'])." ";
						}
						if(isset($rowsData['data'][$field['name']]) && !is_array($rowsData['data'][$field['name']])){
							if($field['name']=='grid_type' && $rowsData['data'][$field['name']] == 'amppb-fluid' ){
								$replace .= 'ap-fl';
							}elseif($field['name']=='grid_type' && $rowsData['data'][$field['name']]=='amppb-fixed'){
								$replace .= 'ap-fi';
							}else{
								$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span><div>';
								$replace .= strip_tags($rowsData['data'][$field['name']],$allowed_tags);
							}
						}else{
							$replace .= '';
						}
						if(! is_array($field['name']) && $field['content_type']=='html'){
							$rowStartTemplate = str_replace('{{'.$field['name'].'}}', $replace, $rowStartTemplate);
						}
						$rowStartTemplate = ampforwp_replaceIfContentConditional($field['name'], $replace, $rowStartTemplate);
					}
				}
				$html .= $rowStartTemplate;
				//$html .= '<div class="row '.$customClass.'">';
				if(count($rowsData['cell_data'])>0){
					switch ($rowsData['cells']) {
						case '1':
							$html .= ampforwp_rowData($rowsData['cell_data'],$rowsData['cells'],$moduleTemplate);
						break;
						case '2':
							$colData = array();
							foreach($rowsData['cell_data'] as $colDevider){
								$colData[$colDevider['cell_container']][] = $colDevider;
							}
							$html .= '<div class="col-2-wrap col">';
							foreach($colData as $data)
								$html .= ampforwp_rowData($data,$rowsData['cells'],$moduleTemplate);
							$html .= '</div>';
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
			$content = do_shortcode($html);	
		}
	}
	return $content;
}

function ampforwp_rowData($container,$col,$moduleTemplate){
	$ampforwp_show_excerpt = true;
	$html = '';
	if(count($container)>0){
		$parentclass= "col-".$col;
		if($col == 1){
			$parentclass = 'col '.$parentclass;
		}
		$html .= "<div class='$parentclass'>";
		//sort modules by index
		$container = sortByIndex($container);
		if(count($container)>0){
			foreach($container as $contentKey=>$contentArray){
				if(!isset($moduleTemplate[$contentArray['type']])){
					continue;
				}
				$moduleFrontHtml = $moduleTemplate[$contentArray['type']]['front_template'];
				$moduleName = $moduleTemplate[$contentArray['type']]['name'];
				

				$repeaterFields = '';
				if(isset($moduleTemplate[$contentArray['type']]['repeater'])){

					$repeaterTemplates = $moduleTemplate[$contentArray['type']]['repeater']['front_template'];
					$repeaterTemplatesArray = array();
					if(!is_array($repeaterTemplates)){
						$repeaterTemplatesArray[] = $repeaterTemplates;
					}else{
						$repeaterTemplatesArray = $repeaterTemplates;
					}
					
					foreach ($repeaterTemplatesArray as $repeaterKey => $repeaterTemplate) {
						
						$repeaterFields = '';
						if(isset($contentArray['repeater']) && is_array($contentArray['repeater'])){
							$repeaterUserContents = $contentArray['repeater'];
							$repeaterUniqueId = 0;
							foreach ($repeaterUserContents as $repeaterUserKey => $repeaterUserValues) {
								$repeaterFrontTemplate = $repeaterTemplate;
								//reset($repeaterUserValues);
								$repeaterVarIndex = key($repeaterUserValues);
								$repeaterVarIndex = explode('_', $repeaterVarIndex);
								$repeaterVarIndex = end($repeaterVarIndex);

								
								foreach ($moduleTemplate[$contentArray['type']]['repeater']['fields'] as $moduleKey => $moduleField) {
									if($moduleField['content_type']=='html'){
										$replace = "";
										if(isset($repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex])){
											$replace = $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex];
										}else{
											$replace = $moduleField['default'];
										}
										if(is_array($replace)){
											if(count($replace)>0){
												$replace = $replace[0];
											}else{
												$replace ='';
											}
										}
										if($moduleField['type']=="upload"){
											$image_alt = $imageUrl = $imageWidth = $imageHeight = $image_caption = '';
											if( isset( $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex."_image_data"] ) ) {
												$replace = $repeaterUserValues[$moduleField['name'].'_'.$repeaterVarIndex."_image_data"];
											 	$imageUrl = $replace[0];
												$imageWidth = $replace[1];
												$imageHeight = $replace[2];
												$image_alt = (isset($replace['alt'])? $replace['alt']: "");
												$image_caption = (isset($replace['caption'])? $replace['caption']: "");
											}elseif($replace != ""){
												$imageDetails = ampforwp_get_attachment_id( $replace);
												if(is_array($imageDetails)){
													$imageUrl = $imageDetails[0];
													$imageWidth = $imageDetails[1];
													$imageHeight = $imageDetails[2];
													$image_alt = (isset($imageDetails['alt'])? $imageDetails['alt']: "");
													$image_caption = (isset($imageDetails['caption'])? $imageDetails['caption']: "");
												}
											}
											$imageUrl = esc_url($imageUrl);
											$imageWidth = esc_attr($imageWidth);
											$imageHeight = esc_attr($imageHeight);
											$image_alt = esc_html($image_alt);

											$repeaterFrontTemplate = str_replace(
														'{{'.$moduleField['name'].'}}', 
														 $imageUrl, 
														$repeaterFrontTemplate
													);
											if(strpos($repeaterFrontTemplate, '{{'.$moduleField['name'].'-thumbnail}}')!==false && isset($replace[0])){
												$imageDetails = ampforwp_get_attachment_id( $replace[0], 'thumbnail');
												$imageUrl = isset($imageDetails[0])? $imageDetails[0] : '';
												$repeaterFrontTemplate = str_replace(
														'{{'.$moduleField['name'].'-thumbnail}}', 
														 $imageUrl, 
														$repeaterFrontTemplate
													);
											}
											$repeaterFrontTemplate = str_replace(
														array('{{image_width}}',
															  '{{image_width_'.$moduleField['name'].'}}',
															), 
														 array($imageWidth, $imageWidth), 
														$repeaterFrontTemplate
													);
											$repeaterFrontTemplate = ampforwp_replaceIfContentConditional('image_width', $imageWidth, $repeaterFrontTemplate);
											$repeaterFrontTemplate = str_replace(
														array('{{image_height}}',
															  '{{image_height_'.$moduleField['name'].'}}'
															 ), 
														 array($imageHeight,
														 	   $imageHeight
														 	), 
														$repeaterFrontTemplate
													);
											$repeaterFrontTemplate = ampforwp_replaceIfContentConditional('image_height', $imageHeight, $repeaterFrontTemplate);
											$repeaterFrontTemplate = str_replace(
														array('{{image_alt}}',
															  '{{image_alt_'.$moduleField['name'].'}}'
															 ), 
														 array($image_alt,
														 	   $image_alt
														 	), 
														$repeaterFrontTemplate
													);
											$repeaterFrontTemplate = ampforwp_replaceIfContentConditional('image_alt', $image_alt, $repeaterFrontTemplate);
											$repeaterFrontTemplate = str_replace(
														array('{{image_caption}}',
															  '{{image_caption_'.$moduleField['name'].'}}'
															 ), 
														 array($image_caption,
														 	   $image_caption
														 	), 
														$repeaterFrontTemplate
													);
											$repeaterFrontTemplate = ampforwp_replaceIfContentConditional('image_caption', $image_caption, $repeaterFrontTemplate);
											$repeaterFrontTemplate = ampforwp_replaceIfContentConditional($moduleField['name'], $imageUrl, $repeaterFrontTemplate);
										}else{
											if($moduleField['type']=="text"){
												$replace = esc_html($replace);
											}
											$replace = nl2br($replace);
											$repeaterFrontTemplate = str_replace(
														'{{'.$moduleField['name'].'}}', 
														 $replace, 
														$repeaterFrontTemplate
													);
											$repeaterFrontTemplate = ampforwp_replaceIfContentConditional($moduleField['name'], $replace, $repeaterFrontTemplate);
										}

									$repeaterFrontTemplate = str_replace('{{repeater_unique}}', $repeaterUniqueId, $repeaterFrontTemplate);
									$repeaterFrontTemplate = ampforwp_replaceIfContentConditional('repeater_unique', $repeaterUniqueId, $repeaterFrontTemplate);
										
									}
								}
								$repeaterUniqueId++;
								$repeaterFrontTemplate = str_replace('{{repeater-module-class}}', esc_attr($moduleField['name'].'_'.$repeaterVarIndex), $repeaterFrontTemplate);
								
								$repeaterFields .= $repeaterFrontTemplate;

							}
							$repeaterUniqueId = $repeaterUniqueId-1;//Rememeber: loop is going to POST INCREMENT So for perfect counting need to decrese by 1
						}//If Check for Fall back
						if(!is_numeric($repeaterKey)){
							$moduleFrontHtml = str_replace('{{repeater_'.$repeaterKey.'}}', trim($repeaterFields), $moduleFrontHtml);
							$moduleFrontHtml = ampforwp_replaceIfContentConditional('repeater_'.$repeaterKey, trim($repeaterFields), $moduleFrontHtml);
						}else{
							$moduleFrontHtml = str_replace('{{repeater}}', $repeaterFields, $moduleFrontHtml);
							$moduleFrontHtml = ampforwp_replaceIfContentConditional('repeater', trim($repeaterFields), $moduleFrontHtml);
						}
						
					}	//FOreach closed
					//Conditional replacement for Repeaters
					if(isset($moduleTemplate[$contentArray['type']]['fields']) && count($moduleTemplate[$contentArray['type']]['fields']) > 0) {
						foreach($moduleTemplate[$contentArray['type']]['fields'] as $key => $field){
							$repeaterReplcaement = '';
							if(isset($contentArray[$field['name']])){
								$repeaterReplcaement = $contentArray[$field['name']];
							}
							$repeaterFields = ampforwp_replaceIfContentConditional($field['name'], $repeaterReplcaement, $repeaterFields);
						}
					}
				}//If for Module is repeater or not
				
				switch($moduleName){
					case 'gallery_image':
						$moduleDetails = $moduleTemplate[$contentArray['type']];
						$moduleFrontHtml = pagebuilderGetGalleryFrontendView($moduleDetails,$contentArray);
					break;
					case 'contents':
						$fieldValues = array();
						foreach($moduleTemplate[$contentArray['type']]['fields'] as $key => $field){
							$fieldValues[$field['name']] ='';
							if(isset($contentArray[$field['name']])){
								$fieldValues[$field['name']]= $contentArray[$field['name']];
							}
						}
						$posts_offset = (integer) $fieldValues['posts_offset'];
						$show_no_of_posts = (integer) $fieldValues['show_total_posts'];
						if( !$show_no_of_posts ){
							$show_no_of_posts = 3;
						}
						$args = array(
								//'cat' => $fieldValues['category_selection'],
								'posts_per_page' => $show_no_of_posts,
								'offset' => $posts_offset,
								'has_password' => false,
								'post_status'=> 'publish',
								'post_type' => $fieldValues['post_type_selection']
								);
						if($fieldValues['pagination'] == 0){
							array_push($args, "no_found_rows", true);
						}
						if ( (isset($fieldValues['taxonomy_selection']) && 'recent_option' !== $fieldValues['taxonomy_selection']) &&  (isset($fieldValues['category_selection']) && 'recent_option' !== $fieldValues['category_selection'])) {
							$args['tax_query'] = array(
									array(
										'taxonomy'=>$fieldValues['taxonomy_selection'],
										'field'=>'id',
										'terms'=>$fieldValues['category_selection']
									)
								);
							if ( isset($args['tax_query'][0]['taxonomy']  ) ){
								if ( empty($args['tax_query'][0]['taxonomy'])) {
									unset($args['tax_query']);
								}
							}
						}
						$args = apply_filters('ampforwp_content_module_args', $args, $fieldValues);
						//The Query
						$the_query = new WP_Query( $args );
						$totalLoopHtml = $moduleTemplate[$contentArray['type']]['front_loop_content'];
						$totalLoopHtmlArray = ampforwp_contentHtml($the_query,$fieldValues,$totalLoopHtml);
						$totalLoopHtml = $totalLoopHtmlArray['contents'];
						$paginationLinksHtml = $totalLoopHtmlArray['pagination_links'];
						if(isset($moduleTemplate[$contentArray['type']]['fields']) && count($moduleTemplate[$contentArray['type']]['fields']) > 0) {
							foreach($moduleTemplate[$contentArray['type']]['fields'] as $key => $field){
								$totalLoopHtml = ampforwp_replaceIfContentConditional($field['name'], $fieldValues[$field['name']], $totalLoopHtml);
							}
						}

						$catName = 'Recent posts'; $cat_link = "#";
						if(trim($fieldValues['category_selection']) != 'recent_option'){
						  $catName = get_cat_name($fieldValues['category_selection']);
						  $cat_link = get_category_link($fieldValues['category_selection']);
						  $cat_link = ampforwp_url_controller($cat_link);
						}
						$moduleFrontHtml = str_replace('{{content_category_title}}', urldecode($catName), $moduleFrontHtml);
						$moduleFrontHtml = str_replace('{{content_category_link}}', $cat_link, $moduleFrontHtml);

						$moduleFrontHtml = str_replace('{{content_title}}', urldecode($fieldValues['content_title']), $moduleFrontHtml);
						$moduleFrontHtml = str_replace('{{category_selection}}', $totalLoopHtml, $moduleFrontHtml);
						$moduleFrontHtml = str_replace('{{pagination_links}}', $paginationLinksHtml, $moduleFrontHtml);
						/* Restore original Post Data */
						wp_reset_postdata();
						if(isset($moduleTemplate[$contentArray['type']]['fields']) && count($moduleTemplate[$contentArray['type']]['fields']) > 0) {
							foreach($moduleTemplate[$contentArray['type']]['fields'] as $key => $field){
								$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], $fieldValues[$field['name']], $moduleFrontHtml);
							}
						}
						
					break;
					default:
                        $moduleFrontHtml = apply_filters("ampforwp_extension_pagebuilder_module_template", $moduleFrontHtml, $moduleTemplate[$contentArray['type']],$contentArray);
					break;
				}

				if(isset($moduleTemplate[$contentArray['type']]['fields']) && count($moduleTemplate[$contentArray['type']]['fields']) > 0) {
					foreach ($moduleTemplate[$contentArray['type']]['fields'] as $key => $field) {
						if($field['content_type']=='html'){
							if(!empty($contentArray) && !isset($contentArray[$field['name']])){
								$replace = getdefaultValue($field['name'], $moduleTemplate[$contentArray['type']]['fields']);
							}else{
								 $replace = $contentArray[$field['name']];
							}
							if($replace!=""){
								if(is_array($replace)){
									if(count($replace)>0){
										$replace = $replace[0];
									}else{
										$replace ='';
									}
								}

								if(!is_array($replace)){
									
									if($field['type']=="upload"){
										$image_alt = $imageUrl = $imageWidth = $imageHeight = $image_caption = $image_srcset = '';
										if(isset($contentArray[$field['name']."_image_data"])){
										 	$replace= $contentArray[$field['name']."_image_data"];
										 	$imageUrl = $replace[0];
											$imageWidth = $replace[1];
											$imageHeight = $replace[2];
											$image_alt = (isset($replace['alt'])? $replace['alt']: "");
											$image_caption = (isset($replace['caption'])? $replace['caption']: "");
											$image_srcset = $replace[0];
										}elseif( $replace != "" ){
											$imageDetails = ampforwp_get_attachment_id( $replace);
											if(is_array($imageDetails)){
												$imageUrl = $imageDetails[0];
												$imageWidth = $imageDetails[1];
												$imageHeight = $imageDetails[2];	
												$image_alt = (isset($imageDetails['alt'])? $imageDetails['alt']: "");
												$image_caption = (isset($imageDetails['caption'])? $imageDetails['caption']: "");
											}
										}
										$imageUrl    = esc_url($imageUrl);
										$imageWidth  = esc_attr($imageWidth);
										$imageHeight = esc_attr($imageHeight);
										$image_alt   = esc_html($image_alt);

										$moduleFrontHtml = str_replace(
													'{{'.$field['name'].'}}', 
													 $imageUrl, 
													$moduleFrontHtml
												);
										if(strpos($moduleFrontHtml, '{{'.$field['name'].'-thumbnail}}')!==false){
												$imageDetails = ampforwp_get_attachment_id( $replace, 'thumbnail');
												$imageUrl = isset($imageDetails[0])? $imageDetails[0] : '';
												$moduleFrontHtml = str_replace(
														'{{'.$field['name'].'-thumbnail}}', 
														 $imageUrl, 
														$moduleFrontHtml
													);
											}
										$moduleFrontHtml = str_replace(
													array('{{image_width}}','{{image_width_'.$field['name'].'}}'), 
													 array($imageWidth,$imageWidth), 
													$moduleFrontHtml
												);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional('image_width', $imageWidth, $moduleFrontHtml);
										$moduleFrontHtml = str_replace(
													array('{{image_height}}','{{image_height_'.$field['name'].'}}'), 
													 array($imageHeight,$imageHeight), 
													$moduleFrontHtml
												);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional('image_height', $imageHeight, $moduleFrontHtml);
										$moduleFrontHtml = str_replace(
													array('{{image_alt}}',
														  '{{image_alt_'.$field['name'].'}}'
														 ), 
													 array($image_alt,
													 	   $image_alt
													 	), 
													$moduleFrontHtml
												);
										$moduleFrontHtml = str_replace(
													array('{{image_srcset}}',
														  '{{image_srcset_'.$field['name'].'}}'
														 ), 
													 array($image_srcset,
													 	   $image_srcset
													 	), 
													$moduleFrontHtml
												);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional('image_srcset', $image_srcset, $moduleFrontHtml);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional('image_alt', $image_alt, $moduleFrontHtml);
										$moduleFrontHtml = str_replace(
													array('{{image_caption}}',
														  '{{image_caption_'.$field['name'].'}}'
														 ), 
													 array($image_caption,
													 	   $image_caption
													 	), 
													$moduleFrontHtml
												);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional('image_caption', $image_caption, $moduleFrontHtml);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], $imageUrl, $moduleFrontHtml);
									}else{
										$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', esc_html( $replace), $moduleFrontHtml);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], esc_html( $replace), $moduleFrontHtml);
									}
								}else{
									/*if(count($contentArray[$field['name']])>0){*/
										foreach ($contentArray[$field['name']] as $key => $userValue) {
											if(count($contentArray[$field['name']])==1){
												$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', $userValue, $moduleFrontHtml);
												$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], $userValue, $moduleFrontHtml);
											}else{
												$moduleFrontHtml = str_replace('{{'.$field['name'].$key.'}}', $userValue, $moduleFrontHtml);
												$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'].$key, $userValue, $moduleFrontHtml);
											}
										}
											
									/*}else{
										$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', "", $moduleFrontHtml);
										$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], "", $moduleFrontHtml);
									}*/
								}


							}else{
								$moduleFrontHtml = str_replace('{{'.$field['name'].'}}', "", $moduleFrontHtml);
								$moduleFrontHtml = ampforwp_replaceIfContentConditional($field['name'], "", $moduleFrontHtml);
							}
						}//If Closed content type html
						
						
					}//Foreach closed
                }//If closed

                $moduleFrontHtml = str_replace('{{unique_cell_id}}', $contentArray['cell_id'], $moduleFrontHtml);
                if(isset($repeaterUniqueId)){ 
                $moduleFrontHtml = str_replace('{{repeater_max_count}}', $repeaterUniqueId, $moduleFrontHtml);          
				$moduleFrontHtml = ampforwp_replaceIfContentConditional('repeater_max_count', $repeaterUniqueId, $moduleFrontHtml);
				}
				if($contentArray['type'] == 'accordion-mod'){
					$contentArray['type'] = str_replace('accordion-mod', 'apac', $contentArray['type']);
				}
				$html .= "<div class='amp_mod ap_m_".$contentArray['cell_id'].' '.$contentArray['type']."'>".$moduleFrontHtml;
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
	$html = htmlspecialchars_decode($html);
	return $html;
}
function ampforwp_pagebuilder_module_style(){
	$custom_css = ampforwp_get_setting('css_editor'); 
	$sanitized_css = ampforwp_sanitize_i_amphtml($custom_css);
	echo $sanitized_css; //sanitize above
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

function ampforwp_get_attachment_id( $url , $imagetype='full') {
	if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
		$attachment_id = $url;
	}else{
		$attachment_id = 0;
		$dir = wp_upload_dir();
			// Is URL in uploads directory?
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) {
			$file = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'no_found_rows' => true,
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				)
			);
			$query_args = apply_filters('ampforwp_attachment_id_query_args' , $query_args );
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
	$imageDetails = array();
	if ( $attachment_id ) {
		$imageDetails = wp_get_attachment_image_src($attachment_id, $imagetype, false);
		if($imageDetails){
			$image = get_post($attachment_id);
			$caption = $image->post_excerpt;
			$imageDetails['alt'] = get_post_meta($attachment_id,'_wp_attachment_image_alt', true);
			$imageDetails['caption'] = $caption;
		}
	}
	return $imageDetails;
}

function ampforwp_replaceIfContentConditional($byReplace, $replaceWith, $string){
	preg_match_all("{{if_condition_".$byReplace."==(.*?)}}", $string,$matches);
	if(isset($matches[1]) && count($matches[1])>0){
		$matches[1] = array_unique($matches[1]);
		foreach ($matches[1] as $key => $matchValue) {
			if(trim($matchValue) != trim($replaceWith)){
				$string = str_replace(array("{{if_condition_".$byReplace."==".$matchValue."}}","{{ifend_condition_".$byReplace."_".$matchValue."}}"), array("<amp-condition>","</amp-condition>"), $string);
				
				$string = preg_replace_callback('/(<amp-condition>)(.*?)(<\/amp-condition>)/s', function($match){
					return "";
				}, $string);
			}else{
				$string = str_replace(array("{{if_condition_".$byReplace."==".$matchValue."}}","{{ifend_condition_".$byReplace."_".$matchValue."}}"), array("",""), $string);
			}
		}//FOreach Closed
	}//If Closed

	if(strpos($string,'{{if_'.$byReplace.'}}')!==false){
		$string = str_replace(array('{{if_'.$byReplace.'}}','{{ifend_'.$byReplace.'}}',), array("<amp-condition>","</amp-condition>"), $string);
		if($replaceWith=="" && trim($replaceWith)==""){
			$string = preg_replace("/<amp-condition>(.*)<\/amp-condition>/i", "", $string);
			$string = preg_replace("/<amp-condition>(.*)<\/amp-condition>/s", "", $string);
		}
		$string = str_replace(array('<amp-condition>','</amp-condition>'), array("",""), $string);
	}
	return $string;
}
/*
* Required Key $requiredKey
* Set of  field array $moduleTemplate[$contentArray['type']]['fields']
*/
function getdefaultValue($requiredKey, $fieldArray){
	foreach ($fieldArray as $fieldKey => $fieldvalue) {
		if($fieldvalue['name'] == $requiredKey){
			return $fieldvalue['default'];
		}
	}
}
