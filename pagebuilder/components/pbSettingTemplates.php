<?php
$arraySetting = array(
                   'tabs'=> array(
                                'layout'=>'Layout Directory',
                                'save_layout'=>'Save layout',
                                'export'=>'Export'
                            ),
                   'defaulttab'=>'save_layout'
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
                    <button  type="button" class="media-modal-close" @click="hidePageBuilderPopUp()">
                        <span class="media-modal-icon"></span>
                    </button>
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
                    <div class="modal-header">
                        <h3>Page Builder Settings</h3>
                    </div>
                            <div v-if="modalCrrentTab=='customize'">
                              
                            </div><!-- customize closed -->

                            <div v-else-if="modalCrrentTab=='save_layout'">
                                <div>
                                    <h4>Save Your Current Layout</h4>
                                        <div id="input">
                                            <label class="form-label">Name of layout
                                            <input type="text" class="full text" v-model="save_layout.name" name="save_layout_name">
                                            </label>
                                        </div>
                                        
                                        <!-- save_layout -->
                                        <button type="button"  class="button modal-default-button"  @click="savePagebuildercustomLayout($event)">
                                            Save
                                        </button>
                                </div>
                                <h4>List Of Saved Layouts</h4>
                                <div class="amppb-layout-library-wrapper" v-if="showsavedLayouts.length">

                                    <div class="amppb-layout-layout" v-for="(layout, key, index) in showsavedLayouts">
                                            <div class="amppb-layout-wrapper">
                                                <div class="amppb-layout-screenshot" style="visibility:hidden;"></div>
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
                                <h4>List Of Layouts</h4>
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
                                            Select Layout File
                                            <input type="file" accept=".json" @change="layoutFileSelected($event)">
                                        </label>
                                    </div>
                                    <br/>
                                    <button type="button" class="button" v-if="importLayoutfromFile.length>0" @click="replacelayoutFromSelectedFile()">
                                        import
                                    </button>
                                </div>
                                <div class="amppb-modal-col-2">
                                    <div class="exportcompleteData">
                                        <iframe id="amppb-panels-export-iframe" style="display: none;" name="amppb-panels-export-iframe"></iframe>
                                        <form action="<?php echo admin_url('admin-ajax.php?action=amppb_export_layout_data') ?>" target="amppb-panels-export-iframe"  method="post">
                                            <label>Export Current Layout</label>
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
                            
                            
                            <button type="button"  class="button modal-default-button" v-if="modalCrrentTab=='customize'" @click="savePagebuilderSettings(currentLayoutData)">
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