<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Identifies the current plugin version.
define( 'AMP_PAGE_BUILDER', plugin_dir_path(__FILE__) );
define( 'AMP_PAGE_BUILDER_URL', plugin_dir_url(__FILE__) );

require_once(AMP_PAGE_BUILDER."config/moduleTemplate.php");

//Set Metabox
add_action('add_meta_boxes','ampforwp_pagebuilder_content_meta_register', 10 ,1);
function ampforwp_pagebuilder_content_meta_register($post_type){
	global $redux_builder_amp;
	global $post_id;
    
    if ( ampforwp_role_based_access_options() == true && ( current_user_can('edit_posts') || current_user_can('edit_pages') ) ) {
		// Page builder for posts
	  	if( ampforwp_get_setting('amp-on-off-for-all-posts') && $post_type == 'post' ) {
	  		add_meta_box( 'pagebilder_content', esc_html__( 'AMP Page Builder', 'accelerated-mobile-pages' ), 'amp_content_pagebuilder_title_callback',  'post' , 'normal', 'default' );
	  	}
	  	$frontpage_id = ampforwp_get_the_ID();
	  	// Page builder for pages
	  	if ( ( true == ampforwp_get_setting('amp-on-off-for-all-pages') && $post_type == 'page' ) || ( true == ampforwp_get_setting('amp-frontpage-select-option') && $post_id == $frontpage_id )) {
	  		add_meta_box( 'pagebilder_content', esc_html__( 'AMP Page Builder', 'accelerated-mobile-pages' ), 'amp_content_pagebuilder_title_callback',  'page' , 'normal', 'default' );
	  	}
	  	if(  is_array(ampforwp_get_setting('ampforwp-custom-type') ) && in_array($post_type, ampforwp_get_setting('ampforwp-custom-type')) ){
	  		add_meta_box( 'pagebilder_content', esc_html__( 'AMP Page Builder', 'accelerated-mobile-pages' ), 'amp_content_pagebuilder_title_callback',  $post_type , 'normal', 'default' );
	  	}
	  	
	}
}

function amp_content_pagebuilder_title_callback( $post ){
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
         return ;
    }
	global $post;
	$amp_current_post_id = $post->ID;
	$content 	= get_post_meta ( $amp_current_post_id, 'ampforwp_custom_content_editor', true );
	$content 	= html_entity_decode($content);
	
	//previous data stored compatible
	if(get_post_meta($amp_current_post_id ,'use_ampforwp_page_builder',true)==null && 
		get_post_meta( $amp_current_post_id, 'amp-page-builder', true ) != ''){
		update_post_meta($amp_current_post_id, 'use_ampforwp_page_builder','yes');
	}
	//Disable page builder
	if(isset($_GET['ramppb']) && sanitize_text_field( wp_unslash($_GET['ramppb']))=='1'){
		delete_post_meta($amp_current_post_id, 'use_ampforwp_page_builder','yes');
		delete_post_meta($amp_current_post_id, 'ampforwp_page_builder_enable','yes');
	}
	//Enable page builder
	if(isset($_GET['use_amp_pagebuilder']) && sanitize_text_field( wp_unslash($_GET['use_amp_pagebuilder']))=='1'){
		update_post_meta($amp_current_post_id, 'use_ampforwp_page_builder','yes');
	}
	
	if(empty($content)){
		echo " ";
	}
	ampforwp_call_page_builder();
	
}

/* Add page builder form after editor */
function ampforwp_call_page_builder(){
	global $post, $moduleTemplate, $layoutTemplate, $containerCommonSettings;
	if($post!=null){
		$postId = $post->ID;
	}
	if(isset($_GET['post_id'])){
		$id = intval($_GET['post_id']);
		$postId = sanitize_text_field( wp_unslash($id));
	}
	add_thickbox();
	
	$previousData = get_post_meta($postId,'amp-page-builder');
	$ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
	$previousData = isset($previousData[0])? $previousData[0]: null;
	
	$previousData = (str_replace("'", "&apos;", $previousData));
	
	$totalRows = 1;
	$totalmodules = 1;
	if(!empty($previousData)){
		$jsonData = json_decode($previousData,true);
		if(is_array($jsonData) && count($jsonData['rows'])>0){
			$totalRows = $jsonData['totalrows'];
			$totalmodules = $jsonData['totalmodules'];
			$previousData = json_encode($jsonData);
		}else{
			$jsonData['rows'] = array();
			$jsonData['totalrows']=1;
			$jsonData['totalmodules'] = 1;
			$previousData = json_encode($jsonData);
		}
	}
	$pageBuilderData = array(
						'title'=>'Pagebuilder Settings',
						'default_tab'=> 'customizer',
						'tabs' => array(
						  'customizer'=>'Customizer',
						  'container_css'=>'Container css'
						),
						'fields' => array(
								array(		
				 						'type'		=>'text',		
				 						'name'		=>"content_title",		
				 						'label'		=> esc_html__('Category Block Title','accelerated-mobile-pages'),
				           				'tab'     =>'customizer',
				 						'default'	=>'Category',		
				 						),
								array(		
				 						'type'		=>'text',		
				 						'name'		=>"content_title",		
				 						'label'		=> esc_html__('Category Block Title','accelerated-mobile-pages'),
				           				'tab'     =>'container_css',
				 						'default'	=>'Category',		
				 						),
							)
						);
	
	$backendRowSetting = $containerCommonSettings;
	unset($backendRowSetting['front_template_start']);
	unset($backendRowSetting['front_template_end']);
	unset($backendRowSetting['front_css']);
	unset($backendRowSetting['front_common_css']);
	wp_nonce_field( basename( __FILE__) , 'amp_content_editor_nonce' );
	
	$mob_pres_link = false;
	if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	  $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	}
	if(class_exists('WPSEO_Frontend') && true == ampforwp_get_setting('ampforwp-yoast-seo-analysis') && (true == ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true) ) { 
		$pb_content = get_post_field('amp-page-builder',$post->ID);
		?>
		<script type="text/template" class="hide" id="amp-page-builder-ready"><?php echo stripcslashes( $pb_content ); ?></script>
	<?php } ?>
	<div id="ampForWpPageBuilder_container">
		<div id="start_amp_pb_post" class="start_amp_pb" data-postId="<?php echo esc_attr(get_the_ID()) ?>" v-if="startPagebuilder==0" @click="amppb_startFunction($event)"><?php echo esc_html__('Start the AMP Page Builder','accelerated-mobile-pages'); ?></div>
		<div class="enable_ampforwp_page_builder" v-if="startPagebuilder==1">
			<label><input type="checkbox" name="ampforwp_page_builder_enable" value="yes"   v-model="checkedPageBuilder"><?php echo esc_html__('Use Builder','accelerated-mobile-pages'); ?></label>
			<label  @click="showModal = true;"><?php echo esc_html__('Pre-built AMP Layouts','accelerated-mobile-pages'); ?></label>
		</div>
		<div id="amp-page-builder" v-if="startPagebuilder==1">
	 		<?php wp_nonce_field( "amppb_nonce_action", "amppb_nonce" ) ?>
	        <input type="hidden" name="amp-page-builder" id="amp-page-builder-data" class="amp-data" v-model="JSON.stringify(mainContent)" value='<?php echo $previousData; // nothing to escaped ?>'>
	        <?php /* This is where we gonna add & manage rows */ ?>
			<div id="sorted_rows" class="amppb-rows drop" >
				<drop class="drop" :class="{'row-dropping':rowOverDrop}" @drop="handleDrop" @dragover="rowOverDrop = true"
			@dragleave="rowOverDrop = false">
					<p class="amppb-rows-message" v-if="mainContent.rows && mainContent.rows.length==0"><?php echo esc_html__('Start by dragging a Column and then a Module','accelerated-mobile-pages'); ?>.</p>
					<draggable :element="'div'" class="dragrow"
						v-model="mainContent.rows" 
						:options="{
							animation:200,
							draggable:'.amppb-row',
							handle: '.amppb-handle',
							ghostClass: 'ghost',
							group:{name:'.amppb-row'}
						}"
						@start="rowdrag=true"
						@end="rowdrag=false;rows_moved($event)"
						>
						<div v-for="(row, key, index) in mainContent.rows" :key="row.id" class="amppb-row" :id="'conatiner-'+row.id">
							<div v-if="row.cells==1" :id="'conatiner-'+row.id">
						 		<input type="hidden" name="column-data" value="">
						        <div class="amppb-row-title">
						            <span class="amppb-handle dashicons dashicons-move"></span>
						            <span class="amppb-row-title-text">1 <?php echo esc_html__('Column','accelerated-mobile-pages'); ?></span>
						            <span @click="reomve_row(key)" data-confirm="Delete Row?" class="amppb-remove dashicons dashicons-trash"></span>
						            <span @click="showRowSettingPopUp($event)" class="rowBoxContainer" title="Row settings column 1" :data-popupContent='JSON.stringify(<?php echo json_encode($backendRowSetting); ?>)'
						            :data-container_id="row.id"
						            >
						            	<i class="tools-icon dashicons dashicons-menu"></i>
						            </span>
						            <span @click="duplicateRow($event)" class="amppb-duplicate dashicons dashicons-admin-page" :data-rowid="row.id"></span>

						        </div><!-- .amppb-row-title -->
						 
						        <div class="amppb-row-fields col" data-cell="1">
						        	<drop class="drop" @drop="handleModuleDrop" :data-rowid="row.id" :data-cellid="1" :class="{'module-dropping':modulesOverDrop}" @drop="handleDrop" @dragover="modulesOverDrop = true"
									@dragleave="modulesOverDrop = false">
						        		<draggable  
							        		:element="'div'"
							        		class="modules-drop"
							        		:class="{'ui-droppable': row.cell_data.length==0 }"
							        		v-model="row.cell_data" 
							        			:options="{
							        				animation:100,
							        				draggable:'.amppb-module',
					        						handle: '.amppb-module',
					        						group:{name:'.amppb-module'},
					        						ghostClass: 'ghost',
					        					  }"
							        		 @start="moduledrag=true"
							        		 @end="moduledrag=false;modulesort($event)"
											:data-rowid="row.id" :data-cellid="1"
											>
							        			<module-data v-for="(cell, key, index)  in row.cell_data" :key="cell.cell_id" :modulekey="key" :cell="cell" :cellcontainer="1"></module-data>
								        	</draggable>
								    </drop>
						        </div><!-- .amppb-row-fields -->
						    </div><!-- .amppb-row.amppb-col-1 -->

						    <div v-if="row.cells==2" class="amppb-col-2" :id="'conatiner-'+row.id">
						 		<input type="hidden" name="column-data" value="">
						        <div class="amppb-row-title">
						            <span class="amppb-handle dashicons dashicons-move"></span>
						            <span class="amppb-row-title-text">2 <?php echo esc_html__('Columns','accelerated-mobile-pages'); ?></span> 
						            <span @click="reomve_row(key)" data-confirm="Delete Row?" class="amppb-remove amppb-item-remove dashicons dashicons-trash"></span>
						            <span href="#" class="rowBoxContainer" title="Row settings column 2" @click="showRowSettingPopUp($event)" :data-popupContent='JSON.stringify(<?php echo json_encode($backendRowSetting); ?>)'
						            :data-container_id="row.id"
						            >
						            	<span class="tools-icon dashicons dashicons-menu"></span>
						            </span>
						            <span @click="duplicateRow($event)" class="amppb-duplicate dashicons dashicons-admin-page" :data-rowid="row.id"></span>
						        </div><!-- .amppb-row-title -->
						 
						        <div class="amppb-row-fields ">
					        	    <div class="amppb-column-2-left col" data-cell="1">
					        	    	<drop class="drop" @drop="handleModuleDrop" :data-rowid="row.id" :data-cellid="1" :class="{'module-dropping':modulesOverDrop}" @drop="handleDrop" @dragover="modulesOverDrop = true"
									@dragleave="modulesOverDrop = false">
							            	<div class="modules-drop">
							            		
							            		<draggable :element="'div'"class="module-drop-zone"
												:class="{'ui-droppable': row.cell_left.length==0 }" v-model="row.cell_left" 
												:options="{
														animation:200,
														draggable:'.amppb-module',
														handle: '.amppb-module',
														group:{name:'.amppb-module'},
														ghostClass: 'ghost'
												}"
												@start="moduledrag=true"
												@end="moduledrag=false;modulesort($event)"
												:data-rowid="row.id" :data-cellid="1"
												>
							            				<module-data v-for="(cell, key, index)  in row.cell_left" :key="cell.cell_id" :modulekey="key" :cell="cell" :cellcontainer="1"></module-data>
									        	</draggable>
										        
							            	</div>
						            	</drop>
						            </div><!-- .amppb-col-2-left -->
						            <div class="amppb-column-2-right col" data-cell="2">
						            	<div class="resize-handle"></div>
						            	<drop class="drop" @drop="handleModuleDrop" :data-rowid="row.id" :data-cellid="2" :class="{'module-dropping':modulesOverDrop}" @drop="handleDrop" @dragover="modulesOverDrop = true"
									@dragleave="modulesOverDrop = false">
											<div class="modules-drop" >
											
												<draggable :element="'div'"class="module-drop-zone"
												:class="{'ui-droppable': row.cell_right.length==0 }"
												 v-model="row.cell_right" 
													:options="{	
													animation:200,
													draggable:'.amppb-module',
													handle: '.amppb-module',
													group:{name:'.amppb-module'},
													ghostClass: 'ghost',
													}"
												@start="moduledrag=true"
												@end="moduledrag=false;modulesort($event)"
												:data-rowid="row.id" :data-cellid="2"
												>
														<module-data v-for="(cell, key, index)  in row.cell_right" :key="cell.cell_id" :modulekey="key" :cell="cell" :cellcontainer="2"></module-data>
									        	</draggable>
											
											</div>
										</drop>
						            </div><!-- .amppb-col-2-right -->
						        </div><!-- .amppb-row-fields -->
						    </div><!-- .amppb-row.amppb-col-2 -->
			          	</div>
		         	</draggable>
		        </drop>	
				    
				
		</div><!-- .amppb-rows -->

		<div class="modules-options">
         	<div class="amppb-actions" id="amppb-actions-container" data-containerid="<?php echo $totalRows; // nothing to escaped ?>">
	        	<drag class="drag" :transfer-data='{type: "column",value: "col-1",rowSettingJson:<?php echo json_encode($backendRowSetting); ?>}' :draggable="true" :effect-allowed="'copy'">
				    <span id="action-col-1" class="amppb-add-row button-primary button-large module-col-1" data-template="col-1"
				    >1 Column</span>
				</drag>
				<drag class="drag" :transfer-data='{type: "column",value: "col-2", rowSettingJson:<?php echo json_encode($backendRowSetting); ?>}' :draggable="true" :effect-allowed="'copy'">
				    <span id="action-col-2" class="amppb-add-row button-primary button-large draggable module-col-2" data-template="col-2"
				    >2 Columns</span>
				</drag>
	       		<div class="clearfix"></div>
	        </div><!-- .amppb-actions -->
	        <div class="amppb-module-actions" id="amppb-module-actions-container" data-recentid="<?php echo esc_attr($totalmodules); ?>">
			    <?php
			    //fallback support Hide old modules
			    $oldModules = array(
			    				'blurb',
			    				'button',
			    				'image',
			    				'text'
			    				);
			    ksort($moduleTemplate);
			    foreach ($moduleTemplate as $key => $module) {
			    	if(in_array($key, $oldModules)){
			    		continue;
			    	}
			    	unset($module['front_template']);
			    	unset($module['front_css']);
			    	if(isset($module['front_loop_content'])){
	                    unset($module['front_loop_content']);
	                }
	                if(isset($module['front_common_css'])){
	                    unset($module['front_common_css']);
	                }
	                if(isset($module['repeater'])){
	    			    unset($module['repeater']['front_template']);
	                }
			    	$moduleJson = array('type'=> 'module','moduleDraggable'=>true ,'modulename'=>strtolower($module['name']),'moduleJson'=>$module);
			    	echo '
			    	<drag class="drag" :transfer-data=\''.json_encode($moduleJson).'\' :draggable="true" :effect-allowed="\'copy\'">
				    	<span class="amppb-add-row button-primary button-large draggable module-'.esc_attr(strtolower($module['name'])).'"
				    	>
				    		'.$module['label'].'
				    	</span>
			    	</drag>
			    	';
			    }
			    ?>
			    <div class="clearfix"></div>
			</div><!-- .amppb-module-actions -->
		</div>

	        <?php /* This is where our action buttons to add rows 
				Modules
	        */ ?>

			<!-- use the modal component, pass in the prop -->
			<amp-pagebuilder-modal v-if="showModal" @close="showModal = false">
				<!--
				  you can use custom content here to overwrite
				  default content
				-->
				<h3 slot="header"><?php echo esc_html__('custom header','accelerated-mobile-pages'); ?></h3>
			</amp-pagebuilder-modal>
			<amp-pagebuilder-module-modal v-if="showmoduleModal" @close="showmoduleModal = false">
				<!--
				  you can use custom content here to overwrite
				  default content
				-->
				
			</amp-pagebuilder-module-modal>        
	    </div>
	</div>
    <?php
}

function ampforwp_create_posttype_amppb_layout(){
	register_post_type( 'amppb_layout',
	    array(
	      'labels' => array(
		        'name' => esc_html__( 'AMP Layouts','accelerated-mobile-pages' ),
		        'singular_name' => esc_html__( 'AMP Layout','accelerated-mobile-pages' )
		      ),
	    'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
		'publicly_queriable' => false,  // you should be able to query it
		'show_ui' => false,  // you should be able to edit it in wp-admin
		'exclude_from_search' => true,  // you should exclude it from search results
		'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
		'has_archive' => false,  // it shouldn't have archive page
		'rewrite' => false,  // it shouldn't have rewrite rules
	      'rewrite' => array('slug' => 'amppb-layout'),
	    )
	  );
}
add_action( 'init', 'ampforwp_create_posttype_amppb_layout' );
require_once AMP_PAGE_BUILDER.'functions.php';