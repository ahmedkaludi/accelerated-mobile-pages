<?php
if ( ! defined( 'ABSPATH' ) ) { 
	echo "Silence is golden"; 
}

// Identifies the current plugin version.
define( 'AMP_PAGE_BUILDER', plugin_dir_path(__FILE__) );
define( 'AMP_PAGE_BUILDER_URL', plugin_dir_url(__FILE__) );

add_action('add_meta_boxes','ampforwp_pagebuilder_content_meta_register');
function ampforwp_pagebuilder_content_meta_register(){
	$pb_post_type = array('post','page');
	add_meta_box( 'pagebilder_content', __( 'AMP Page Builder', 'amp-page-builder' ), 'amp_content_pagebuilder_title_callback', $pb_post_type, 'normal', 'default' );
}

function amp_content_pagebuilder_title_callback( $post ){
	global $post;
	$amp_current_post_id = $post->ID;
	wp_nonce_field( basename( __FILE__) , 'amp_content_editor_nonce' );

	$content 		= get_post_meta ( $amp_current_post_id, 'ampforwp_custom_content_editor', true );
	$editor_id 	= 'ampforwp_custom_content_editor';
	//wp_editor( $content, $editor_id );
	if(empty($content)){
		echo "<div class='amppb_welcome'>
                    <a class='amppb_helper_btn beta_btn' href='https://ampforwp.com/tutorials/article/page-builder-is-in-beta/' target='_blank'><span>Beta Feature</span></a>
                    <a class='amppb_helper_btn video_btn' href='https://ampforwp.com/tutorials/article/amp-page-builder-installation/' target='_blank'><span>Video Tutorial</span></a>

                    <a class='amppb_helper_btn leave_review' href='https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages?rate=5#new-post' target='_blank'><span>Rate</span></a>
</div>";
	}
	//echo "<textarea style='display:none' id='amp-content-preview'>$content</textarea>";
	/*echo "<div class='rander_amp_html'>";
		echo html_entity_decode($content);	
	echo "</div>";*/
	wp_enqueue_script( 'jquery-ui-dialog' ); // jquery and jquery-ui should be dependencies, didn't check though...
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	call_page_builder();
}



/* Add page builder form after editor */
function call_page_builder(){
	global $post;
	global $moduleTemplate;
	add_thickbox();
	$previousData = get_post_meta($post->ID,'amp-page-builder');
	$previousData = isset($previousData[0])? $previousData[0]: null;
	//$previousData = wp_slash($previousData);
	$previousData = (str_replace("'", "", $previousData));
	
	$totalRows = 1;
	$totalmodules = 1;
	if(!empty($previousData)){
		//echo ' sdcds '.json_encode($previousData);die;
		$jsonData = json_decode($previousData,true);
		if(count($jsonData['rows'])>0){
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
	?>
	<div id="amp-page-builder">
 		<?php wp_nonce_field( "amppb_nonce_action", "amppb_nonce" ) ?>
        <input type="hidden" name="amp-page-builder" id="amp-page-builder-data" class="amp-data" value='<?php echo $previousData; ?>'>
        <?php /* This is where we gonna add & manage rows */ ?>
		
        <div id="sorted_rows" class="amppb-rows droppable">
            <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>
			
        </div><!-- .amppb-rows -->
 		

        <?php /* This is where our action buttons to add rows 
			Modules
        */ ?>
        <div class="amppb-actions" id="amppb-actions-container" data-containerid="<?php echo $totalRows; ?>">
			    <span id="action-col-1" class="amppb-add-row button-primary button-large draggable module-col-1" data-template="col-1">1 Column</span>
			    <span id="action-col-2" class="amppb-add-row button-primary button-large draggable module-col-2" data-template="col-2">2 Columns</span>
			    
        </div><!-- .amppb-actions -->
       
 
        

        <div class="amppb-module-actions" id="amppb-module-actions-container" data-recentid="<?php echo $totalmodules; ?>">
		    <?php
		    foreach ($moduleTemplate as $key => $module) {
		    	echo '<span class="amppb-add-row button-primary button-large draggable module-'.strtolower($module['name']).'" data-template="'.strtolower($module['name']).'">'.$module['label'].'</span>';
		    }
		    ?>
		</div><!-- .amppb-module-actions -->
        
        
    </div>
    <?php add_thickbox(); ?>
    <div id="my-amppb-dialog" class="hidden" style="max-width:800px">

    	<div class="amp-pb-module-content">
	    	
	 	</div>
 		<div class="amppb-tc-footer">
 			<div class="amppb-status remove-module buttons-groups">
 				<a class="dashicons dashicons-trash button" href="javascript:void(0)">Delete</a>
 			</div>
 			<div class="buttons-groups">
 				<input type="button" class="button amppb-rowData-content" data-current-container="" data-current-module="" id="amppb-rowData-content-text" data-type="text" value="Submit">

 				<span id="ampb-parents-dialog" data-container=""></span>
 				
 			</div>
 		</div>
	</div>
	<div id="amppb-row-setting-dialog" class="hidden" style="max-width:800px">

    	<div class="amp-pb-rowsetting-content">
			
	 	</div>
 		<div class="amppb-tc-footer">
 			<div class="buttons-groups">
 				<input type="button" class="button amppb-rowsetting" data-current-container="" data-current-module="" id="amppb-rowsetting" data-type="text" value="Submit">
 				
 			</div>
 		</div>
	</div>
	<!-- <div id="my-image-dialog" class="hidden" style="max-width:800px">
    	<input type="button" class="button" value="Select image" id="selectImage">
		<img id="ampforwp-preview-image" src="http://via.placeholder.com/350x150" />
		<input type="hidden" name="ampforwp_image_id" id="ampforwp_image_id" value="" class="regular-text" />
		<div class="amppb-tc-footer">
 			<div class="amppb-status"></div>
 			<div class="buttons-groups">
 				<input type="button" class="button" data-current-container="" data-current-module="" id="amppb-rowData-content-image" data-type="image" value="Submit">
 			</div>
 		</div>
	</div> -->
    <?php
}

// Ajax action to refresh the user image
add_action( 'wp_ajax_ampforwp_get_image', 'ampforwp_get_image'   );
function ampforwp_get_image() {
    if(isset($_GET['id']) ){
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'ampforwp-preview-image' ) );
        $data = array(
            'image'    => $image,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}

require_once AMP_PAGE_BUILDER.'functions.php';

