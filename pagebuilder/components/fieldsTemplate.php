<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit; ?>
<script type="text/x-template" id="fields-data-template">
    <div class="amp-form-control" :id="field.name" data-type="text" v-if="field.type=='text' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        
        <div class="form-label">{{field.label}}</div>
        <div class="form-field"><input type="text" class="full text" :id="field.id" :name="field.name" :placeholder="field.placeholder"  v-model="field.default">
        <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
         <div class="clearfix"></div>
    </div>
    <div class="amp-form-control" :id="field.name" data-type="hidden" v-else-if="field.type=='hidden' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field"><input type="text" class="full text" :id="field.id" :name="field.name"  v-model="field.default">
        <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
   
    <div class="amp-form-control" :id="field.name" data-type="number" v-else-if="field.type=='number' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field"><input type="number" class="full text" :id="field.id" :name="field.name"  v-model="field.default">
        <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <?php /*Normal Textarea*/?>
    <div class="amp-form-control" :id="field.name" data-type='textarea' v-else-if="field.type=='textarea' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field"><textarea class="full textarea" :id="field.id" :name="field.name" v-model="field.default"></textarea>
        <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="amp-form-control" :id="field.name" data-type="text-editor" v-else-if="field.type=='text-editor' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label" style="margin-top: 10px;">{{field.label}}</div>
        <div class="form-field"><textarea-wysiwyg :default-text="field" :fieldindex="fieldkey"></textarea-wysiwyg>
        <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="amp-form-control" :id="field.name" data-type="select" v-else-if="field.type=='select' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field">
            <select type="text" class="full text" :id="field.id" :name="field.name" v-model="field.default" v-if="field.options_details.length!=0"  :data-ajax="field.ajax" :data-ajax-dep="field.ajax_dep" :data-ajax-action="field.ajax_action" @change="changeOnSelect()">
                <option value="">Select option</option>
                <option 
                    v-for="(option, key, index) in field.options_details"
                    :value="key"
                    :selected="{'selected': (field.default==key)}"
                >
                {{option}}
                </option>
            </select>
            <div class="help-msg" v-html="field.helpmessage"></div>
            <div class="spinner spinner-cat-mod" :id="field.name+1"></div>
        </div>
        <div class="clearfix"></div>
    </div>
   
    <div class="amp-form-control" :id="field.name" data-type="checkbox" v-else-if="field.type=='checkbox' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>     
        <div class="form-field">
            <label class="form-label-checkbox" v-for="(val,index) in field.options"  >
                <input type="checkbox" :value="val.value" v-model="field.default" >
                {{val.label}}
            </label>
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="amp-form-control" :id="field.name" data-type="checkbox_bool" v-else-if="field.type=='checkbox_bool' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>     
        <div class="form-field">
            <label class="form-label-checkbox" v-for="(val,index) in field.options"  >
                <input type="checkbox" :value="val.value" :checked="field.default" v-model="field.default"  v-bind:true-value="val.value" v-bind:false-value="0">
                {{val.label}}
            </label>
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="amp-form-control" :id="field.name" data-type="radio" v-else-if="field.type=='radio' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field">
            <label  class="form-label-radio" v-for="(val,index) in field.options" >
                <input type="radio"  :value="val.value" v-model="field.default" :checked="field.default==val.value">
                {{val.label}}
            </label>
        </div>
        <div class="clearfix"></div>
    </div>
  
    <div class="amp-form-control" :id="field.name" data-type="spacing" v-else-if="field.type=='spacing' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" style="clearfix" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field">
            <label class="amppb-mar-padd">
               <span class="dashicons dashicons-arrow-up-alt ampforwp-up-arrow"></span>
                <input type="text"  data-type="margin" data-pos="top" v-model="field.default.top">
            </label>
            <label class="amppb-mar-padd">
                <span class="dashicons dashicons-arrow-right-alt ampforwp-right-arrow"></span>
                <input type="text"  data-type="margin" data-pos="right"  v-model="field.default.right">
            </label>
             <label class="amppb-mar-padd">
                <span class="dashicons dashicons-arrow-down-alt ampforwp-down-arrow"></span>
                <input type="text" data-type="margin" data-pos="bottom" v-model="field.default.bottom">
            </label>
            <label class="amppb-mar-padd">                 
                <span class="dashicons dashicons-arrow-left-alt ampforwp-left-arrow"></span>
                <input type="text"  data-type="margin" data-pos="left"  v-model="field.default.left">
            </label>
            <div class="clearfix"></div>
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        
        <div class="clearfix"></div>
    </div>
    
    
    
    <div class="amppb-ftype-upload amp-form-control" :id="field.name" data-type="upload" v-else-if="field.type=='upload' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        
        <div class="form-label" style="position: relative;display: inline-block; width: 30%;">{{field.label}}</div>
        <div class="form-field">
            <input type="button" class="button" value="Select image" id="" data-imageselactor="single" @click="selectimages(field,$event)">
            <input type="hidden" name="ampforwp_image_id" class="regular-text" v-model="field.default"/>
        
            <div v-if="field.default!=''" style="position: relative;display: inline-block;">
                 <img v-if="field.default!=''" src="../wp-includes/images/spinner.gif" :data-src="refresh_image(field.default,this,'tag',field)" class="amppbimageuploadField"/>
                <span class="dashicons-before dashicons-no link" @click="removeSelectedImage(field)"></span>
            </div>
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    
    

    <div class="amp-form-control" :id="field.name" data-type="icon-selector" v-else-if="field.type=='icon-selector' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label">{{field.label}}</div>
        <div class="form-field">
            <span class="button" @click="openIconOptions=!openIconOptions;">Select Icon</span>
            <i v-if="field.default!=''" class="amppb-icon " :class="'icon-'+field.default"></i>
            <input type="hidden" v-model="field.default">
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
        <div class="select-icons" :class="{'hide': (!openIconOptions)}">
            <span class="amppb-icon-close" @click="openIconOptions=!openIconOptions;"><i class=" icon-close"></i></span>
            <input type="text" v-model="iconSearch" placeholder="Search Icon.."/>
            <div class="icon-wrapper">
                <div class="icon-card" v-for="icon in filteredIcons" @click="iconSelected(icon,field)" :class="{'active' : (field.default==icon.name)}" :title="icon.name">
                    <i class="icon" :class="'icon-'+icon.name"></i>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="amp-form-control" :id="field.name" data-type="gradient-selector" v-else-if="field.type=='gradient-selector' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
            <div class="form-label">{{field.label}}</div>
            <div class="form-field">
                <div style="width:40px;height:20px;display: inline-block;" :style="field.default"></div>
                <span class="button" @click="openIconOptions=!openIconOptions;">
                   Select Gradient</span>
                <input type="hidden" v-model="field.default">
                <div class="help-msg" v-html="field.helpmessage"></div>
            </div>
            <div class="select-icons select-gradient-box" :class="{'hide': (!openIconOptions)}" :style="field.default">
                 <span class="amppb-icon-close" @click="openIconOptions=!openIconOptions;"><i class=" icon-close"></i></span>

                  <div @click="field.default ='background:linear-gradient(45deg,#30496B,#30B8D2)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(48, 73, 107), rgb(48, 184, 210));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(48, 73, 107);">#30496B</div>
                        <div class="color-2" style="color: rgb(48, 184, 210);">#30B8D2</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#FBCA88,#EF69AD)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(251, 202, 136), rgb(239, 105, 173));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(251, 202, 136);">#FBCA88</div>
                        <div class="color-2" style="color: rgb(239, 105, 173);">#EF69AD</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#B6C1D4,#EC68B1)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(182, 193, 212), rgb(236, 104, 177));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(182, 193, 212);">#B6C1D4</div>
                        <div class="color-2" style="color: rgb(236, 104, 177);">#EC68B1</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#ABE5E6,#7062F0)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(171, 229, 230), rgb(112, 98, 240));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(171, 229, 230);">#ABE5E6</div>
                        <div class="color-2" style="color: rgb(112, 98, 240);">#7062F0</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#476892,#59355D)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(71, 104, 146), rgb(89, 53, 93));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(71, 104, 146);">#476892</div>
                        <div class="color-2" style="color: rgb(89, 53, 93);">#59355D</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#92F1D5,#ABF6BD)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(146, 241, 213), rgb(171, 246, 189));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(146, 241, 213);">#92F1D5</div>
                        <div class="color-2" style="color: rgb(171, 246, 189);">#ABF6BD</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#7D6AE7,#56A2D5)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(125, 106, 231), rgb(86, 162, 213));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(125, 106, 231);">#7D6AE7</div>
                        <div class="color-2" style="color: rgb(86, 162, 213);">#56A2D5</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#82E9E4,#F3D62F)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(130, 233, 228), rgb(243, 214, 47));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(130, 233, 228);">#82E9E4</div>
                        <div class="color-2" style="color: rgb(243, 214, 47);">#F3D62F</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#239FE9,#44D5F3)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(35, 159, 233), rgb(68, 213, 243));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(35, 159, 233);">#239FE9</div>
                        <div class="color-2" style="color: rgb(68, 213, 243);">#44D5F3</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#3D3949,#6772A4)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(61, 57, 73), rgb(103, 114, 164));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(61, 57, 73);">#3D3949</div>
                        <div class="color-2" style="color: rgb(103, 114, 164);">#6772A4</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#FD5A49,#FDDC98)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(253, 90, 73), rgb(253, 220, 152));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(253, 90, 73);">#FD5A49</div>
                        <div class="color-2" style="color: rgb(253, 220, 152);">#FDDC98</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#9AD3DE,#93B8C0)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(154, 211, 222), rgb(147, 184, 192));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(154, 211, 222);">#9AD3DE</div>
                        <div class="color-2" style="color: rgb(147, 184, 192);">#93B8C0</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#F32F8E,#B236D0)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(243, 47, 142), rgb(178, 54, 208));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(243, 47, 142);">#F32F8E</div>
                        <div class="color-2" style="color: rgb(178, 54, 208);">#B236D0</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#247CC4,#336BAE)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(36, 124, 196), rgb(51, 107, 174));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(36, 124, 196);">#247CC4</div>
                        <div class="color-2" style="color: rgb(51, 107, 174);">#336BAE</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#FB7140,#FB9951)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(251, 113, 64), rgb(251, 153, 81));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(251, 113, 64);">#FB7140</div>
                        <div class="color-2" style="color: rgb(251, 153, 81);">#FB9951</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#6FE594,#27A47C)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(111, 229, 148), rgb(39, 164, 124));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(111, 229, 148);">#6FE594</div>
                        <div class="color-2" style="color: rgb(39, 164, 124);">#27A47C</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#95FD48,#19E9A6)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(149, 253, 72), rgb(25, 233, 166));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(149, 253, 72);">#95FD48</div>
                        <div class="color-2" style="color: rgb(25, 233, 166);">#19E9A6</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#469FFF,#A39AF9)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(70, 159, 255), rgb(163, 154, 249));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(70, 159, 255);">#469FFF</div>
                        <div class="color-2" style="color: rgb(163, 154, 249);">#A39AF9</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#5CF0F8,#ECDDFE)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(92, 240, 248), rgb(236, 221, 254));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(92, 240, 248);">#5CF0F8</div>
                        <div class="color-2" style="color: rgb(236, 221, 254);">#ECDDFE</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#F1467A,#FB949E)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(241, 70, 122), rgb(251, 148, 158));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(241, 70, 122);">#F1467A</div>
                        <div class="color-2" style="color: rgb(251, 148, 158);">#FB949E</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#DAE7F0,#FADAE7)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(218, 231, 240), rgb(250, 218, 231));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(218, 231, 240);">#DAE7F0</div>
                        <div class="color-2" style="color: rgb(250, 218, 231);">#FADAE7</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#6155D4,#5B97F2)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(97, 85, 212), rgb(91, 151, 242));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(97, 85, 212);">#6155D4</div>
                        <div class="color-2" style="color: rgb(91, 151, 242);">#5B97F2</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#47AEA3,#08B1C5)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(71, 174, 163), rgb(8, 177, 197));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(71, 174, 163);">#47AEA3</div>
                        <div class="color-2" style="color: rgb(8, 177, 197);">#08B1C5</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#DA1FF2,#4C15D0)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(218, 31, 242), rgb(76, 21, 208));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(218, 31, 242);">#DA1FF2</div>
                        <div class="color-2" style="color: rgb(76, 21, 208);">#4C15D0</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#D0F56B,#5876FB)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(208, 245, 107), rgb(88, 118, 251));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(208, 245, 107);">#D0F56B</div>
                        <div class="color-2" style="color: rgb(88, 118, 251);">#5876FB</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#FFE9D0,#FD7153)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(255, 233, 208), rgb(253, 113, 83));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(255, 233, 208);">#FFE9D0</div>
                        <div class="color-2" style="color: rgb(253, 113, 83);">#FD7153</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#DBFDEC,#FFC2D4)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(219, 253, 236), rgb(255, 194, 212));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(219, 253, 236);">#DBFDEC</div>
                        <div class="color-2" style="color: rgb(255, 194, 212);">#FFC2D4</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#C3A8EE,#F5C1EA)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(195, 168, 238), rgb(245, 193, 234));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(195, 168, 238);">#C3A8EE</div>
                        <div class="color-2" style="color: rgb(245, 193, 234);">#F5C1EA</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#484C91,#929BEF)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(72, 76, 145), rgb(146, 155, 239));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(72, 76, 145);">#484C91</div>
                        <div class="color-2" style="color: rgb(146, 155, 239);">#929BEF</div>
                    </div>
                </div>
                <div @click="field.default ='background:linear-gradient(45deg,#97F7FB,#8D8AFC)'" class="gradient-card">
                    <div class="gradient" style="background: linear-gradient(45deg, rgb(151, 247, 251), rgb(141, 138, 252));"></div>
                    <div class="card-info">
                        <div class="color-1" style="color: rgb(151, 247, 251);">#97F7FB</div>
                        <div class="color-2" style="color: rgb(141, 138, 252);">#8D8AFC</div>
                    </div>
                </div>







            </div>
        <div class="clearfix"></div>
    </div>

    <div class="amp-form-control" :id="field.name" data-type="color-picker" v-else-if="field.type=='color-picker' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label label_txt">{{field.label}}</div>
        <div class="form-field color-wrapper"  style="line-height: 35px" >
            <color-picker :colorfield="field"></color-picker>
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
   
        <div class="clearfix"></div>
    </div>
    <div class="amp-form-control" :id="field.name" data-type="layout-image-picker" v-else-if="field.type=='layout-image-picker' && (field.tab==defaulttab || repeater==1)" :data-require="JSON.stringify(field.required)" v-show="fieldShowHideCheck(field)">
        <div class="form-label label_txt">{{field.label}}</div>
        <div class="form-field color-wrapper"  style="line-height: 35px" >
            <div  class="layout-image-picker" v-for="(option, key, index) in field.options_details"
                    :data-value="option.value"
                    :class="{'active': (field.default==option.value)}" @click="select_layout_type(field, $event)">
                <label  :data-value="option.value">{{option.label}}</label>
                <img  :data-value="option.value" :src="option.demo_image">
            </div>
            <div class="help-msg" v-html="field.helpmessage"></div>
        </div>
   
        <div class="clearfix"></div>
    </div>
</script>
<script type="text/x-template" id="fields-colorPicker-template">
    <input name="amppb-color-picker" v-model="colorfield.default"/>
</script>
<script type="text/x-template" id="fields-textarea-template">
    <div class="complete_text_area">
        <div class="editor_area" style="position: relative;">
            <textarea class="full textarea-editor" :id="defaultText.name+'_editor'+fieldindex" v-model="defaultText.default"></textarea>
        </div>
    </div>
</script>