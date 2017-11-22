<script type="text/x-template" id="col-template">
	<div v-for="row in mainContent.rows" class="amppb-row " :class="'amppb-col-'+row.id">
						<div v-if="row.cells==1" :id="'conatiner-'+row.id">
					 		<input type="hidden" name="column-data" value="">
					        <div class="amppb-row-title">
					            <span class="amppb-handle dashicons dashicons-move"></span>
					            <span class="amppb-row-title-text">1 Column</span>
					            <span data-confirm="Delete Row?" class="amppb-remove dashicons dashicons-trash"></span>
					            <a href="#" class="thickbox rowBoxContainer" title="Row settings column 1" data-template='<?php // echo json_encode($containerCommonSettings); ?>'>
					            	<span class="tools-icon dashicons dashicons-menu"></span>
					            </a>
					        </div><!-- .amppb-row-title -->
					 
					        <div class="amppb-row-fields col" data-cell="1">
					        	<div class="modules-drop">
					        		<module-data v-for="(cell, key, index)  in row.cell_data" :key="cell.cell_id"></module-data>
					        	</div>
					        </div><!-- .amppb-row-fields -->
					    </div><!-- .amppb-row.amppb-col-1 -->

					    <div v-if="row.cells==2" class="amppb-col-2" :id="'conatiner-'+row.id">
					 		<input type="hidden" name="column-data" value="">
					        <div class="amppb-row-title">
					            <span class="amppb-handle dashicons dashicons-move"></span>
					            <span class="amppb-row-title-text">2 Columns</span> 
					            <span data-confirm="Delete Row?" class="amppb-remove amppb-item-remove dashicons dashicons-trash"></span>
					            <a href="#TB_inline?width=100%&height=100%&inlineId=amppb-row-setting-dialog" class="thickbox rowBoxContainer" title="Row settings column 2" data-template='<?php //echo json_encode($containerCommonSettings); ?>'>
					            	<span class="tools-icon dashicons dashicons-menu"></span>
					            </a>
					        </div><!-- .amppb-row-title -->
					 
					        <div class="amppb-row-fields ">
				        	    <div class="amppb-column-2-left col" data-cell="1">
					            	<div class="modules-drop">
					            		<module-data v-for="(cell, key, index)  in row.cell_data" :key="cell.cell_id"></module-data>
					            	</div>
					            </div><!-- .amppb-col-2-left -->
					            <div class="amppb-column-2-right col" data-cell="2">
					            	<div class="resize-handle"></div>
									<div class="modules-drop">
										<module-data v-for="(cell, key, index)  in row.cell_data" :key="cell.cell_id"></module-data>
									</div>
					            </div><!-- .amppb-col-2-right -->
					        </div><!-- .amppb-row-fields -->
					    </div><!-- .amppb-row.amppb-col-2 -->
		          	</div>
</script>

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
?>
<script type="text/x-template" id="module-data-template">
	
		<?php $i=0;
    		foreach ($moduleTemplate as $key => $module) {
    			unset($module['front_template']);
    			unset($module['front_css']);
    			$conditioner = 'v-else-if';
    			if($i==0){
    				$conditioner = 'v-if';
    			}
    			$i++;
    			echo '
    				<div 
    					'.$conditioner.'="cell.type==\''.strtolower($module['name']).'\'
    					 &&
    					  cellcontainer==cell.cell_container"

    					 class="amppb-module module-draggable amppb-module-'.strtolower($module['name']).'"
    					  data-tooltip="'.$module['name'].' Module"
					>

		        		<span class="module_label">'.$module['label'].'</span>
		        		<input type="hidden" id="selectedModule" value=\''.json_encode($module).'\'> 
		        		<span class="amppb-setting-right">
			        		<label  @click="showModal = true" class="boxContainer link" title="'.$module['label'].'">
			        			<span class="dashicons dashicons-admin-generic"></span>
			        		</label>
		        		</span>
		        	</div>
    					';
    		}
    ?>
 </script>
 <script type="text/x-template" id="amppb-fields-templates">
 	<template>
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
    		<input type="button" class="button selectImage" value="Select image" id="" data-imageselactor="single">
			<img id="ampforwp-preview-image" src="#" />
			<input type="hidden" name="ampforwp_image_id" id="{id}" class="regular-text" value="{default_value}"/>
    	</p>
	</div>
	<div id="multi_upload">
    	<div class="form-control">
    		<label for="{id}">{label}</label>
    		<input type="button" class="button selectImage" value="Select image" data-imageselactor="multiple" id="">
			<input type="hidden" name="ampforwp_image_id" id="{id}" class="regular-text" value="{default_value}"/>
			<div class="sample-gallery-template">{default_images}</div>
    	</div>
	</div>
	<div id="select">
    	<p class="form-control">
    		<label for="{id}">{label}</label>
    		<select type="text" class="full text" id="{id}" name="{name}">
    			{options}
    		</select>
    	</p>
	</div>
</template>
</script>

<!-- template for the modal component -->
<script type="text/x-template" id="amp-pagebuilder-modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              default footer
              <button class="modal-default-button" @click="$emit('close')">
                OK
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</script>