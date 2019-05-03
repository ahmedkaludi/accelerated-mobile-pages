<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit; 
$arraySetting = array(
                   'tabs'=> array(
                                'layout'=>'Layout Directory',
                                'save_layout'=>'Save layout',
                                'export'=>'Import / Export',
                                'advance'=>'Advance',
                            ),
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
                                <li @click="settingShowTabs('<?php echo esc_attr($key); ?>')"
                               class="link"
                               :class="{'active': (modalCrrentTab=='<?php echo esc_attr($key) ?>')}"> 
                                  <?php echo esc_html($sidebarlink); ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <div class="modal-header">
                        <h3>Layout Directory</h3>
                    </div>
                        <div class="modal-body">
                           <div v-if="modalCrrentTab=='advance'" class="modal-settings">
                                <div class="amp-form-control" id="ampb_script_handler" data-type='textarea' >
                                    <div class="form-label">Enter HTML in Head</div>
                                    <div class="form-field"><textarea class="full textarea" id="ampb_script_textarea" name="ampb_script_handler" v-model="ampb_script_textarea"></textarea></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="amp-form-control" id="ampb_style_handler" data-type='textarea' >
                                    <div class="form-label">Enter Style in Head</div>
                                    <div class="form-field"><textarea class="full textarea" id="ampb_style_textarea" name="ampb_style_handler" v-model="ampb_style_textarea"></textarea></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- Advance closed -->

                            <div v-else-if="modalCrrentTab=='save_layout'">
                                <div class="amppb-layout-library-wrapper" style="margin: 40px 15px 10px 20px;">
                                    <h4>Save Your Current Layout</h4>
                                    <div id="input">
                                        <label class="form-label">Name of layout</label>
                                        <input type="text" class="full text" v-model="save_layout.name" name="save_layout_name">
                                        <!-- save_layout -->
                                    </div>
                                    <button type="button"  class="button" style="margin: 10px 5px 0px 0px;"  @click="savePagebuildercustomLayout($event)">
                                        Save
                                    </button>
                                    
                                </div>
                                <span class="layout-rem-msg" v-if="this.layoutMsg">{{this.layoutMsg}}</span>
                                <div class="amppb-layout-library-wrapper" v-if="showsavedLayouts.length">
                                <h4>List Of Saved Layouts</h4>

                                    <div class="amppb-layout-layout" v-for="(layout, key, index) in showsavedLayouts">
                                            <div class="amppb-layout-wrapper">
                                                <div class="amppb-layout-screenshot" style="visibility:hidden;"></div>
                                                <div class="amppb-layout-bottom">
                                                    <h4 class="amppb-layout-title ste-tlt">{{layout.post_title}}</h4>
                                                    <div class="amppb-layout-button saved-layout">
                                                        <button type="button" class="button" :data-layout='layout.post_content' @click="importLayout($event)">Import</button>
                                                        <button type="button" class="button button-info del-btn" :data-layout='layout.post_content' @click="removeSavedLayout(layout.post_id)">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div><!-- save custom layout Closed-->

                            <div class="amppb-layout-library-wrapper" v-else-if="modalCrrentTab=='layout'">
                                <div class="amp-layout-breadcrumbs" v-if="innerLayouts==''">
                                    <span class="link" @click="loadLayOutFolder()"> Layout Home </span>
                                </div>
                                <div class="amp-layout-breadcrumbs"  v-if="innerLayouts!=''">
                                    <span class="dashicons dashicons-arrow-left-alt link" @click="loadLayOutFolder()"></span> 
                                    <span class="link" @click="loadLayOutFolder()"> Layout Home </span> <span class="amp-layout-breadcrumbs_arrow">></span>  <span class="amp-layout-breadcrumbs_last">{{innerLayoutsHeading}}</span> 
                                </div>
                                <div v-if="innerLayouts==''">
                                    <?php
                                    if(count($layoutTemplate)>0){
                                        $layoutTemplate = apply_filters("ampforwp_pb_layouts",$layoutTemplate);
                                     foreach($layoutTemplate as $layoutName => $lay){ 
                                        reset($lay);
                                        $firstLayout = key($lay);
                                        ?>
                                        <div class="amppb-layout-layout">
                                            <div class="amppb-layout-wrapper">
                                                <h4 class="amppb-layout-title"><?php
                                                        if(strpos($layoutName, '-upcomming')!==False){
                                                            echo "<a class='layouts_pro_lbl' href='https://ampforwp.com/amp-layouts' target='_blank'>PRO</a>".esc_html($lay[$firstLayout]['name']);
                                                        }else{
                                                            echo esc_html(ucfirst($layoutName), 'accelerated-mobile-pages'); 
                                                        } ?></h4>
                                                <div class="amppb-layout-screenshot">
                                                    <?php
                                                     if(strpos($layoutName, '-upcomming')!==False){
                                                            ?>
                                                    <a href="<?php echo esc_url($lay[$firstLayout]["preview_demo"]); ?>" target="_blank"><img src="<?php echo esc_url($lay[$firstLayout]['preview_img']); ?>"></a>
                                                    <?php
                                                        }else{
                                                    ?>
                                                    <img src="<?php echo esc_url($lay[$firstLayout]['preview_img']); ?>" @click="viewSpacialLayouts($event);"
                                                    data-info='<?php echo json_encode($lay); ?>'
                                                    data-heading="<?php echo esc_attr( ucfirst($layoutName) ); ?>">
                                                    <?php } ?>
                                                </div>
                                                <div class="amppb-layout-bottom">
                                                    <div class="amppb-layout-button">
                                                        <?php
                                                        if(strpos($layoutName, '-upcomming')!==False){
                                                            ?>
                                                        <a target="_blank" class="button button-lg" href="<?php echo esc_url($lay[$firstLayout]["preview_demo"]); ?>">View Layout</a>
                                                            <?php
                                                        }else{
                                                        ?>
                                                        <button type="button" class="button button-lg"@click="viewSpacialLayouts($event);" data-info='<?php echo json_encode($lay); ?>'
                                                        data-heading="<?php echo esc_attr(ucfirst($layoutName)); ?>">View Layout</button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    } ?>
                                </div>
                                <div v-if="innerLayouts!=''">
                                    <div class="amppb-layout-layout" v-for="(layout, key, index) in innerLayouts">
                                        <div class="amppb-layout-wrapper">
                                                <h4 class="amppb-layout-title">{{layout.name}}</h4>
                                            <div class="amppb-layout-screenshot">
                                                <img src="" :src="layout.preview_img" v-on:click="window.open(layout.preview_demo)">
                                            </div>
                                            <div class="amppb-layout-bottom">
                                                <div class="amppb-layout-button">
                                                    <a target="_blank" :href="layout.preview_demo" class="amp_l_preview_button button" >Preview</a>
                                                    <button type="button" class="amp_l_preview_button button" :data-layout='layout.layout_json'@click="importLayout($event)">Import</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Layout Closed-->
                            <div v-else-if="modalCrrentTab=='export'" class="amppb-modal-row">
                                <div class="amppb-modal-col-2">
                                    <div class="fileupload">
                                        <label class="">
                                            <span class="import-export-label">Select Layout File</span>
                                            <input type="file" accept=".json" @change="layoutFileSelected($event)">
                                        </label>
                                    </div>
                                    <button type="button" class="button" v-if="importLayoutfromFile.length>0" @click="replacelayoutFromSelectedFile()">
                                        import
                                    </button>
                                </div>
                                <div class="amppb-modal-col-2">
                                    <div class="exportcompleteData">
                                        <iframe id="amppb-panels-export-iframe" style="display: none;" name="amppb-panels-export-iframe"></iframe>
                                        <form action="<?php echo esc_url_raw( admin_url('admin-ajax.php?action=amppb_export_layout_data&verify_nonce='.wp_create_nonce('verify_pb')) ); ?>" target="amppb-panels-export-iframe"  method="post">
                                            <label class="import-export-label">Export Current Layout</label>
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
                            <span class="button button-primary button-large  del-btn-modal" @click="loadLayOutFolder()" v-if="innerLayouts!=''">
                                Back
                            </span>
                            <button type="button"  class="button modal-default-button" v-if="modalCrrentTab=='advance'" @click="savePagebuilderSettings(currentLayoutData)">
                                Save
                            </button>
                             <button type="button"  class="button modal-default-button preview button"  @click="hidePageBuilderPopUp()">
                                Close
                            </button>
                        </slot>
                    </div>

                </div>
            </div>
        </div>
    </transition>
</script>