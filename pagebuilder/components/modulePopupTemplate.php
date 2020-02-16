<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<!-- template for the modal component -->
<script type="x/template" id="amp-pagebuilder-module-modal-template">
    <transition name="amp-pagebuilder-module-modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <button type="button" class="media-modal-close" @click="hideModulePopUp()">
                        <span class="media-modal-icon"></span>
                    </button>
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
                        <div class="modal-header">
                            <h3>{{modalcontent.label}}
                                <em v-if="editModuleTempTitle==false"> : {{modalcontent.cell_identity_name}}
                                    <i class="dashicons-head dashicons dashicons-edit" v-on:click="editModuleTempTitle = modalcontent.cell_identity_name"></i>
                                </em>
                                <em v-if="editModuleTempTitle!=false">
                                    <input type="text" v-model="modalcontent.cell_identity_name">
                                    <span v-on:click="saveModuleTitle(modalcontent);"><i class="dashicons-head dashicons dashicons-yes"></i></span>
                                    <span v-on:click="cancleModuleTitle(modalcontent);"><i class="dashicons-head dashicons dashicons-no"></i></span>
                                </em>
                            </h3>
                        </div>
                        <div class="modal-body">
                            <div class="modal-settings">
                                <fields-data v-for="(field, key, index) in modalcontent.fields"
                                             :field="field"
                                             :key="key"
                                             :fieldkey="key"
                                             :completeFields="modalcontent.fields"
                                             :repeater="0"
                                             :defaulttab="modalcontent.default_tab"
                                ></fields-data>
                                <div v-if="modalcontent.repeater && modalcontent.repeater.tab==modalcontent.default_tab" class="amp-repeaters" v-show="repeaterShowHideCheck(modalcontent)">

                                    <div class="heading">
                                    </div>
                                    <!--                                <drop class="drop" :class="{'row-dropping':rowOverDrop}" @drop="handleDrop" @dragover="rowOverDrop = true"-->
                                    <!--                                      @dragleave="rowOverDrop = false">-->
                                    <draggable :element="'div'" class="dragrow"
                                               v-model="modalcontent.repeater.showFields"
                                               :options="{
                                                    animation:200,
                                                    draggable:'.amp-repeat-field',
                                                    handle: '.amppb-repeaterfields-handle',
                                                    ghostClass: 'ghost',
                                                    group:{name:'.amp-repeat-field'}
                                                }"
                                               @start="rowdrag=true"
                                               @end="rowdrag=false;repeater_rows_moved($event)">

                                        <div v-for="(repeaterfields, key, index) in modalcontent.repeater.showFields" class="amp-repeat-field" :class="[{'amp-repeat-active': (key==0)}, 'repeater-'+ key]" >
                                            <div class="amp-accordion-head amppb_accordion__panel"   v-on:click="repeaterAcoordian($event);">
                                                <span class="amppb-repeaterfields-handle dashicons dashicons-move"></span>
                                                <span class="repeater_num">{{key+1}}</span> {{modalcontent.label}} Field
                                                <span class="amp-accordion-label"  v-on:click="showhideAccordian($event);"> {{(key==0)? '(Hide)': '(Show)'}}</span>
                                                <div class="right"
                                                     v-on:click="removeRepeaterSection(key, modalcontent.repeater.showFields)">Remove</div>
                                            </div>
                                            <div class="amp-accordion-content" v-bind:class="{ active: (key==0),'hide': (key!=0) }">
                                                <fields-data v-for="(rfield, key, index) in repeaterfields"
                                                             :field="rfield"
                                                             :key="key"
                                                             :fieldkey="key"
                                                             :completeFields="modalcontent.fields"
                                                             :repeater="1"
                                                             :defaulttab="modalcontent.default_tab"
                                                ></fields-data>
                                            </div>

                                        </div>
                                    </draggable>
                                    <div class="amp_repeater_addmore">
                                        <input type="button" class="button" @click="duplicateRepeaterField(modalcontent.repeater)" :value="'Add '+modalcontent.label+' Field'">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer form-control">
                            <input type="button" v-if="modalcontent.settingType!='row'" class="button button-info del-btn-modal" value="Delete" @click="removeModule()">

                            <button type="button" @click="saveModulePopupdata(modalcontent.fields)" class="button modal-default-button save-btn-modal button-primary">
                                Save Module
                            </button>
                            <button type="button" class="button close-btn-modal modal-default-button" @click="hideModulePopUp()">
                                Close
                            </button>
                        </slot>
                    </div>

                </div>
            </div>
        </div>
    </transition>
</script>