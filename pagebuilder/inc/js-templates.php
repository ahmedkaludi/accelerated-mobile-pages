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
                            <label  @click="showModulePopUp($event)" class="boxContainer link" title="'.$module['label'].'" data-popupContent=\''.json_encode($module).'\'>
                                <span class="dashicons dashicons-admin-generic"></span>
                            </label>
                        </span>
                    </div>
    					';
    		}
    ?>
        
 </script>
 <script type="text/x-template" id="fields-data-template">
    <div id="textarea" v-if="field.type=='textarea' && field.tab==defaulttab">
    	<p class="">
    		<label class="form-label">{{field.label}}
    		  <textarea class="full textarea" :id="field.id" :name="field.name">{{field.default_value}}</textarea>
            </label>
    	</p>
	</div>
	<div id="text-editor" v-else-if="field.type=='text-editor' && field.tab==defaulttab">
    	<p class="">
    		<label class="form-label">{{field.label}}
			<textarea class="full text-editor tinymce-enabled" :id="field.id" :name="field.id">{{field.default_value}}</textarea>
    		</label>
    	</p>
	</div>
	<div id="text" v-else-if="field.type=='text' && field.tab==defaulttab">
    	<p class="">
    		<label class="form-label">{{field.label}}
    		<input type="text" class="full text" :id="field.id" :name="field.name" :value="field.default_value">
            </label>
    	</p>
	</div>
	<div id="upload" v-else-if="field.type=='upload' && field.tab==defaulttab">
    	<p class="">
    		<label class="form-label">{{field.label}}
    		  <input type="button" class="button selectImage" value="Select image" id="" data-imageselactor="single">
            </label>
			<img id="ampforwp-preview-image" src="#" />
			<input type="hidden" name="ampforwp_image_id" :id="field.id" class="regular-text" :value="field.default_value"/>

    	</p>
	</div>
	<div id="multi_upload" v-else-if="field.type=='multi_upload' && field.tab==defaulttab">
    	<div class="">
    		<label  class="form-label">{{field.label}}
    		  <input type="button" class="button selectImage" value="Select image" data-imageselactor="multiple" id="">
            </label>
			<input type="hidden" name="ampforwp_image_id" :id="field.id" class="regular-text" :value="field.default_value"/>
			<div class="sample-gallery-template">{{field.default_images}}</div>
    	</div>
	</div>
	<div id="select" v-else-if="field.type=='select' && field.tab==defaulttab">
    	<p class="">
    		<label class="form-label">{{field.label}}
    		<select type="text" class="full text" :id="field.id" :name="field.name">
    			<option 
                    v-for="(option, key, index) in field.options_details"
                    value="key"
                    :selected="{'selected': (field.default==key)}"
                >
                {{option}}
                </option>
    		</select>
            </label>
    	</p>
	</div>
</script>

<!-- template for the modal component -->
<script type="text/x-template" id="amp-pagebuilder-modal-template">
  <transition name="amp-pagebuilder-modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

                    <div class="modal-header">
                        <h3>Page builder Settings</h3>
                    </div>
                    <div class="modal-content">
                        <div class="modal-sidebar">
                            <ul>
                                <li> 
                                  <a href="#customize">  Customize</a>
                                </li>
                                <li> <a href="#import">Import/Layout</a></li>
                                <li> <a href="#export">Export</a></li>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <div id="customize">
                                <label class="form-label">
                                    Title
                                    <input class="form-control">
                                </label>
                                <label class="form-label">
                                    Body
                                    <textarea rows="5" class="form-control"></textarea>
                                </label>
                            </div>
                            <div id="import">
                                Import
                            </div>
                            <div id="export">
                                Import
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            
                            <button type="button" class="modal-default-button" @click="">
                                import
                            </button>
                            <button type="button" class="modal-default-button" @click="hidePageBuilderPopUp()">
                                Close
                            </button>
                        </slot>
                    </div>

                </div>
            </div>
        </div>
    </transition>
</script>



<!-- template for the modal component -->
<script type="x/template" id="amp-pagebuilder-module-modal-template">
     <transition name="amp-pagebuilder-module-modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
                
                    <div class="modal-header">
                        <h3>{{modalcontent.label}}</h3>
                    </div>
                    <div class="modal-content">
                        <div class="modal-sidebar">
                            <ul>
                               <li v-for="(tab, key, index) in modalcontent.tabs"
                               @click="showtabs(key)"
                               class="link"
                               :class="{'active': modalcontent.default_tab==key}"
                               >{{tab}}
                                </li>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <fields-data v-for="(field, key, index) in modalcontent.fields"
                                :field="field" 
                                :key="key"
                                :defaulttab="modalcontent.default_tab"
                            ></fields-data>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer form-control">
                          default footer
                            <button type="button" class="button modal-default-button">
                                Save
                            </button>
                            <button type="button" class="button modal-default-button" @click="hideModulePopUp()">
                                Close
                            </button>
                        </slot>
                    </div>

                </div>
            </div>
        </div>
    </transition>
</script>