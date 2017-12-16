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
                                :completeFields="modalcontent.fields"
                                :defaulttab="modalcontent.default_tab"
                            ></fields-data>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer form-control">
                            <input type="button" v-if="modalcontent.settingType=='row'" class="button button-info" value="Delete module" @click="removeModule()">

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