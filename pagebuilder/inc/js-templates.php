<?php /* Rows template (Going to be hidden) */ ?>
    <div class="amppb-templates">
    	 <?php /* == This is the 1 column row template == */ ?>
		    <div class="amppb-row amppb-col-1" id="conatiner-{id}">
		 		<input type="hidden" name="column-data" value="">
		        <div class="amppb-row-title">
		            <span class="amppb-handle dashicons dashicons-move"></span>
		            <span class="amppb-row-title-text">1 Column</span>
                    <span data-confirm="Delete Row?" class="amppb-remove dashicons dashicons-trash"></span>
		            <a href="#TB_inline?width=100%&height=100%&inlineId=amppb-row-setting-dialog" class="thickbox rowBoxContainer" title="Row settings column 1" data-template='<?php echo json_encode($containerCommonSettings); ?>'>
		            	<span class="tools-icon dashicons dashicons-menu"></span>
		            </a>
		        </div><!-- .amppb-row-title -->
		 
		        <div class="amppb-row-fields col" data-cell="1">
					<div class="modules-drop"></div>
		        </div><!-- .amppb-row-fields -->
		 
		    </div><!-- .amppb-row.amppb-col-1 -->
		    <?php /* == This is the 2 columns row template == */ ?>
		    <div class="amppb-row amppb-col-2">
		 		<input type="hidden" name="column-data" value="">
		        <div class="amppb-row-title">
		            <span class="amppb-handle dashicons dashicons-move"></span>
		            <span class="amppb-row-title-text">2 Columns</span> 
		            <span data-confirm="Delete Row?" class="amppb-remove amppb-item-remove dashicons dashicons-trash"></span>
		            <a href="#TB_inline?width=100%&height=100%&inlineId=amppb-row-setting-dialog" class="thickbox rowBoxContainer" title="Row settings column 2" data-template='<?php echo json_encode($containerCommonSettings); ?>'>
		            	<span class="tools-icon dashicons dashicons-menu"></span>
		            </a>
		        </div><!-- .amppb-row-title -->
		 
		        <div class="amppb-row-fields ">
	        	    <div class="amppb-column-2-left col" data-cell="1">
		            	<div class="modules-drop"></div>
		            </div><!-- .amppb-col-2-left -->
		            <div class="amppb-column-2-right col" data-cell="2">
		            	<div class="resize-handle"></div>
						<div class="modules-drop"></div>
		            </div><!-- .amppb-col-2-right -->
		        </div><!-- .amppb-row-fields -->
		    </div><!-- .amppb-row.amppb-col-2 -->
		    
    </div><!-- .amppb-templates -->

<?php
/*
 *
 *
 * Module Template
 *
 *
 *
 *
 */



global $moduleTemplate;
wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
?>
		<div class="amppb-module-templates hidden">
    		<?php 
    		foreach ($moduleTemplate as $key => $module) {
    			echo '
    				<div class="amppb-module module-draggable amppb-module-'.strtolower($module['name']).'" data-tooltip="'.$module['name'].' Module">
		        		<span class="module_label">'.$module['label'].'</span>
		        		<input type="hidden" id="selectedModule" value=\''.json_encode($module).'\'> 
		        		<span class="amppb-setting-right">
		        		<a href="#TB_inline?width=100%&height=100%&inlineId=my-amppb-dialog" class="thickbox boxContainer" title="'.$module['label'].'"><span class="dashicons dashicons-admin-generic"></span>
		        		</a>
		        		</span>
		        	</div>
    					';
    		}
    		?>
        </div>
        <div class="amppb-fields-templates hidden">
        	<div id="textarea">
	        	<p class="form-control">
	        		<label for="{id}">{label}</label>
	        		<textarea class="full textarea" id="{id}" name="{name}">{default_value}</textarea>
	        	</p>
        	</div>
        	<div id="text-editor">
	        	<p class="form-control">
	        		<label for="{id}">{label}</label>
					<textarea class="full text-editor tinymce-enabled" id="{id}" name="{id}">{default_value}</textarea>
	        		
	        	</p>
        	</div>
        	<div id="text">
	        	<p class="form-control">
	        		<label for="{id}">{label}</label>
	        		<input type="text" class="full text" id="{id}" name="{name}" value="{default_value}">
	        	</p>
        	</div>
        	<div id="upload">
	        	<p class="form-control">
	        		<label for="{id}">{label}</label>
	        		<input type="button" class="button selectImage" value="Select image" id="">
					<img id="ampforwp-preview-image" src="{default_value}" />
					<input type="hidden" name="ampforwp_image_id" id="{id}" value="" class="regular-text" />
	        	</p>
        	</div>
        	<div id="select">
	        	<p class="form-control">
	        		<label for="{id}">{label}</label>
	        		<select type="text" class="full text" id="{id}" name="{name}">
	        			{options}
	        		</select>
	        	</p>
        	</div>
        </div>