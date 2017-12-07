 <script type="text/x-template" id="fields-data-template">
    <div id="text" v-if="field.type=='text' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
            <input type="text" class="full text" :id="field.id" :name="field.name"  v-model="field.default">
            </label>
        </p>
    </div>
    <?php /*Normal Textarea*/?>
    <div id="textarea" v-else-if="field.type=='textarea' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
               <textarea class="full textarea" :id="field.id" :name="field.name" v-model="field.default"></textarea>
            </label>
        </p>
    </div>

    <div id="text-editor" v-else-if="field.type=='text-editor' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}</label>
            <textarea class="full textarea" :id="field.id" :name="field.name" v-model="field.default"></textarea>
           <!--  <textarea-wysiwyg default-text="field.default"></textarea-wysiwyg> -->
            <?php //wp_editor( '', 'My_TextAreaID_22',     array( 'tinymce'=>true, 'textarea_name'=>'name77', 'wpautop' =>false,   'media_buttons' => true ,   'teeny' => false, 'quicktags'=>true, 'textarea_rows'=>5)   ); ?>
        </p>
    </div>

    <div id="select" v-else-if="field.type=='select' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}:
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
    <div id="checkbox" v-else-if="field.type=='checkbox' && field.tab==defaulttab">
        <span>{{field.label}}:</span>
        <label class="form-label" v-for="(val,index) in field.options"  :for="val.value+'-'+index+'-checkbox'">
            <input type="checkbox" :id="val.value+'-'+index+'-checkbox'" :value="val.value" v-model="field.default">
            {{val.label}}
        </label>
    </div>

    <div id="radio" v-else-if="field.type=='radio' && field.tab==defaulttab">
        <span>{{field.label}}:</span>
        <label class="form-label" v-for="(val,index) in field.options" :for="val.value+'-radio'">
            <input type="radio" :id="val.value+'-'+index+'-radio'" :value="val.value" v-model="field.default">
            {{val.label}}
        </label>
      
      
    </div>

    
    
    <div id="upload" v-else-if="field.type=='upload' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}
              <input type="button" class="button" value="Select image" id="" data-imageselactor="single" @click="selectimages(field,$event)">
              <input type="hidden" name="ampforwp_image_id" class="regular-text" v-model="field.default"/>
            </label>
             <img v-if="field.default!=''" :src="field.default" style="width:50px;height:50px;margin-left: 200px;"/>
           
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

    <div id="color-picker" v-else-if="field.type=='color-picker' && field.tab==defaulttab">
        <div style="line-height: 35px">
            <label  class="form-label">{{field.label}}
              <color-picker default-color="field.default"></color-picker>
            </label>
        </div>
    </div>
    

    <div id="icon-selector" v-else-if="field.type=='icon-selector' && field.tab==defaulttab">
        <p class="">
            <label class="form-label">{{field.label}}</label>
             <i v-if="field.default!=''" class="'icon-'+field.default}}"></i>
             <span class="button" @click="openIconOptions=!openIconOptions;">Select Icon</span>
            <input type="hidden" v-model="field.default">
            <div class="select-icons" :class="{'hide': (!openIconOptions)}">
                <input type="text" v-model="iconSearch" placeholder="Search Icon.."/>
                <div class="icon-wrapper">
                    <div class="icon-card" :class="{'active' : field.default==icon.name}" v-for="icon in filteredIcons" @click="field.default = icon.name" :title="icon.name">
                        <i class="icon" :class="'icon-'+icon.name"></i>
                    </div>
                </div>
            </div>
        </p>
    </div>
</script>

