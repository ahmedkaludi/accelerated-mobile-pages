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
				$moduleJson = array('type'=> 'module','moduleDraggable'=>false ,'modulename'=>strtolower($module['name']),'moduleJson'=>$module);
    			echo '
    				<div 
    					'.$conditioner.'="cell.type==\''.strtolower($module['name']).'\'
    					 &&
    					  cellcontainer==cell.cell_container"
    					 class="amppb-module amppb-module-'.strtolower($module['name']).'"
    					  data-tooltip="'.$module['name'].' Module"
                          :data-module_id="cell.cell_id"
					>

		        		<span class="module_label">'.$module['label'].'</span>
		        		<span class="amppb-setting-right">
			        		<label  @click="showModulePopUp($event)" class="link" title="'.$module['label'].'" data-popupContent=\''.json_encode($module).'\'
                                :data-module_id="cell.cell_id"
                                :data-container_id="cell.container_id"
                            >
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
              <textarea class="full textarea" :id="field.id" :name="field.name" v-model="field.default"></textarea>
            </label>
        </p>
    </div>
    <div id="text-editor" v-else-if="field.type=='text-editor' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
                <vue-tinymce v-model="field.default" height="300" :id="field.id" :name="field.id" col="10" rows="5">{{field.default}}</vue-tinymce>
            </label>
        </p>
    </div>
    <div id="text" v-else-if="field.type=='text' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
            <input type="text" class="full text" :id="field.id" :name="field.name"  v-model="field.default">
            </label>
        </p>
    </div>
    <div id="upload" v-else-if="field.type=='upload' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
              <input type="button" class="button selectImage" value="Select image" id="" data-imageselactor="single">
            </label>
            <img id="ampforwp-preview-image" src="field.default" />
            <input type="hidden" name="ampforwp_image_id" :id="field.id" class="regular-text" v-model="field.default"/>

        </p>
    </div>
    <div id="multi_upload" v-else-if="field.type=='multi_upload' && field.tab==defaulttab">
        <div class="">
            <label  class="form-label">{{field.label}}
              <input type="button" class="button selectImage" value="Select image" data-imageselactor="multiple" id="">
            </label>
            <input type="hidden" name="ampforwp_image_id" :id="field.id" class="regular-text" v-model="field.default"/>
            <div class="sample-gallery-template">{{field.default_images}}</div>
        </div>
    </div>
    <div id="select" v-else-if="field.type=='select' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
            <select type="text" class="full text" :id="field.id" :name="field.name" v-model="field.default">
                <option 
                    v-for="(option, key, index) in field.options_details"
                    value="key"
                    :selected="{'true': (field.default==key)}"
                >
                {{option}}
                </option>
            </select>
            </label>
        </p>
    </div>
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
                               :class="{'active': modalcontent.default_tab==key}">
                               {{tab}}
                                </li>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <fields-data v-for="(field, key, index) in modalcontent.fields"
                                :field="field" 
                                :key="key"
                                :fieldkey="key"
                                :defaulttab="modalcontent.default_tab"
                            ></fields-data>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer form-control">
                          default footer
                            <button type="button" @click="saveModulePopupdata(modalcontent.fields)" class="button modal-default-button">
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
<?php
$arraySetting = array(
                   'tabs'=> array('customize'=>'Customize',
                                'save_layout'=>'Save layout',
                                'layout'=>'Layout Directory',
                                'export'=>'Export'
                            ),
                   'defaulttab'=>'customize'
               );
global $layoutTemplate;
global $savedlayoutTemplate;
?>

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
                                <?php
                                foreach($arraySetting['tabs'] as $key=>$sidebarlink){
                                ?>
                                <li @click="settingShowTabs('<?php echo $key; ?>')"
                               class="link"
                               :class="{'active': (modalCrrentTab=='<?php echo $key ?>')}"> 
                                  <?php echo $sidebarlink; ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="modal-body">
                            <div v-if="modalCrrentTab=='customize'">
                                <div id="text">
                                        <label class="form-label">Class
                                            <input type="text" class="full text" v-model="currentLayoutData.settingdata.front_class">
                                        </label>
                                </div>
                                <div id="textarea">
                                        <label class="form-label">Front css
                                            <textarea class="full text" v-model="currentLayoutData.settingdata.front_css"></textarea>
                                        </label>
                                </div>
                            </div><!-- customize closed -->

                            <div v-else-if="modalCrrentTab=='save_layout'">
                                <div>
                                    <h4>Save your layout</h4>
                                        <div id="input">
                                            <label class="form-label">Name of layout
                                            <input type="text" class="full text" v-model="save_layout.name" name="save_layout_name">
                                            </label>
                                        </div>
                                        <div id="input">
                                            <label class="form-label">Url of preview
                                            <input type="text" class="full text" v-model="save_layout.url" name="save_layout_url">
                                            </label>
                                        </div>
                                        <!-- save_layout -->
                                        <button type="button"  class="button modal-default-button"  @click="savePagebuildercustomLayout($event)">
                                            Save
                                        </button>
                                </div>
                                <h4>List of saved layouts</h4>
                                <div class="amppb-layout-library-wrapper" v-if="showsavedLayouts.length">

                                    <div class="amppb-layout-layout" v-for="(layout, key, index) in showsavedLayouts">
                                            <div class="amppb-layout-wrapper">
                                                <div class="amppb-layout-screenshot">
                                                    <img :src="layout.post_excerpt">
                                                </div>
                                                <div class="amppb-layout-bottom">
                                                    <h4 class="amppb-layout-title">{{layout.post_title}}</h4>
                                                    <div class="amppb-layout-button">
                                                        
                                                        <button type="button" class="button" :data-layout='layout.post_content' @click="importLayout($event)">Import</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div><!-- save custom layout Closed-->

                            <div v-else-if="modalCrrentTab=='layout'">
                                <h4>List of layouts</h4>
                                <div class="amppb-layout-library-wrapper">
                                    <?php
                                    if(count($layoutTemplate)>0){
                                     foreach($layoutTemplate as $lay){ ?>
                                        <div class="amppb-layout-layout">
                                            <div class="amppb-layout-wrapper">
                                                <div class="amppb-layout-screenshot">
                                                    <img src="<?php echo $lay['preview_url']; ?>">
                                                </div>
                                                <div class="amppb-layout-bottom">
                                                    <h4 class="amppb-layout-title">Consult</h4>
                                                    <div class="amppb-layout-button">
                                                        
                                                        <button type="button" class="button" data-layout='<?php echo $lay['layout_json'] ?>'@click="importLayout($event)">Import</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } 
                                    } ?>
                                </div>
                            </div><!-- Layout Closed-->
                            <div v-else-if="modalCrrentTab=='export'" class="amppb-modal-row">
                                <div class="amppb-modal-col-2">
                                    <div class="fileupload">
                                        <label class="">
                                            Select layout file
                                            <input type="file" accept=".json" @change="layoutFileSelected($event)">
                                        </label>
                                    </div>
                                    <button type="button" class="button" @click="">
                                        import
                                    </button>
                                </div>
                                <div class="amppb-modal-col-2">
                                    <div class="exportcompleteData">
                                        <iframe id="amppb-panels-export-iframe" style="display: none;" name="amppb-panels-export-iframe"></iframe>
                                        <form action="<?php echo admin_url('admin-ajax.php?action=amppb_export_layout_data') ?>" target="amppb-panels-export-iframe"  method="post">
                                            <button type="submit" class="button button-primary button-large">
                                                Export
                                            </button>

                                            <input type="hidden" name="export_layout_data" v-model="JSON.stringify(currentLayoutData)" />
                                        </form>
                                        
                                    </div>

                                </div>
                            </div><!-- export Closed-->
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            
                            
                            <button type="button"  class="button modal-default-button"  @click="savePagebuilderSettings()" v-if="modalCrrentTab=='customize'">
                                Save
                            </button>
                             <button type="button"  class="button modal-default-button"  @click="hidePageBuilderPopUp()">
                                Close
                            </button>
                        </slot>
                    </div>

                </div>
            </div>
        </div>
    </transition>
</script>
