 <script type="text/x-template" id="fields-data-template">
    <div id="text" v-if="field.type=='text' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
            <input type="text" class="full text" :id="field.id" :name="field.name"  v-model="field.default">
            </label>
        </p>
    </div>

    <div id="textarea" v-else-if="field.type=='textarea' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
               <textarea class="full textarea" :id="field.id" :name="field.name" v-model="field.default"></textarea>
            </label>
        </p>
    </div>

    <div id="select" v-else-if="field.type=='select' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}: {{field.default}}
            <select type="text" class="full text" :id="field.id" :name="field.name" v-model="field.default">
                <option 
                    v-for="(option, key, index) in field.options_details"
                    :value="key"
                    :selected="{'selected': (field.default==key)}"
                >
                {{option}}
                </option>
            </select>
            </label>
        </p>
    </div>

    <div id="text-editor" v-else-if="field.type=='text-editor' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}</label>
            <?php wp_editor( '', 'My_TextAreaID_22',     array( 'tinymce'=>true, 'textarea_name'=>'name77', 'wpautop' =>false,   'media_buttons' => true ,   'teeny' => false, 'quicktags'=>true, 'textarea_rows'=>5)   ); ?>
        </p>
    </div>
    
    <div id="upload" v-else-if="field.type=='upload' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
              <input type="button" class="button selectImage" value="Select image" id="" data-imageselactor="single">
            </label>
            <img id="ampforwp-preview-image" src="field.default" />
            <input type="hidden" name="ampforwp_image_id" class="regular-text" v-model="field.default"/>
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
    
</script>