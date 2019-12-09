<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * 
 */
class AMPforWP_Fields
{
	private $output = '';
	private $class = '';
	private $id = '';
	private $title = '';
	private $element_class = '';
	private $parent_class = '';
	private $desc = '';
	private $default = '';
	private $selected = '';
	private $data_secure = '';
	private $data_url = '';
	private $options = array();
	private $required = array();

	public function createFields($fields_array){
		if ( is_array($fields_array) ) {
			foreach ($fields_array as $field_array ) {
				$this->setField($field_array['field_type'], $field_array['field_data']);
			}
		}
	}
	public function setField( $type = '', $fields=array() ){
		if( '' == $type ) {
			return false;
		}
		if( !empty($fields) ){
			if ( isset($fields['class']) ) {
				if ( $type != 'section_start' && $type != 'section_end' && $type != 'main_section_start' && $type != 'main_section_end' && $type != 'sub_section_start' && $type != 'sub_section_end') {
					$fields['class'] .= ' amp-ux-field';
				}
				$this->class = $fields['class'];
			}
			else{
				$this->class = '';
			}
			if ( isset($fields['parent-class']) ) {
				$this->parent_class = $fields['parent-class'];
			}
			else{
				$this->parent_class = '';
			}
			if ( isset($fields['title']) ) {
				$this->title = $fields['title'];
			}
			else{
				$this->title = '';
			}
			if ( isset($fields['element-class']) ) {
				$this->element_class = $fields['element-class'];
			}
			else{
				$this->element_class = '';
			}
			if ( isset($fields['id']) ) {
				$this->id = $fields['id'];
			}
			else{
				$this->id = '';
			}
			if ( isset($fields['default']) ) {
				$this->default = $fields['default'];
			}
			else{
				$this->default = '';
			}
			if ( isset($fields['required']) ) {
				$this->required = $fields['required'];
			}
			else{
				$this->required = '';
			}
			if ( isset($fields['options']) && is_array($fields['options']) ){
				$this->options = $fields['options'];
			}
			else{
				$this->options = '';
			}
			if ( isset($fields['data-href']) ) {
				$this->data_href = ' data-href='.esc_url($fields['data-href']);
			}
			else{
				$this->data_href = '';
			}
			if ( isset($fields['data-url']) ) {
				$this->data_url = ' data-url='.esc_url($fields['data-url']);
			}
			else{
				$this->data_url = '';
			}
			if ( isset($fields['data-secure']) ) {
				$this->data_secure = ' data-secure='.esc_attr($fields['data-secure']);
			}
			else{
				$this->data_secure = '';
			}
			if ( isset($fields['data-text']) ) {
				$this->data_text = ' data-text='.esc_attr($fields['data-text']);
			}
			else{
				$this->data_text = '';
			}
			if ( isset($fields['desc']) ) {
				$this->desc = $fields['desc'];
			}
			else{
				$this->desc = '';
			}
		}
		// Select
		if ( 'select' == $type ) {
			$this->ampforwp_field_select($fields);
			//$this->loading();
		}
		// Text
		if ( 'text' == $type ) {
			$this->ampforwp_field_text($fields);
		}
		// Checkbox
		if ( 'checkbox' == $type ) {
			$this->ampforwp_field_checkbox($fields);
		}
		// Upload
		if ( 'media' == $type ) {
			$this->ampforwp_field_media($fields);
		}
		// Color
		if ( 'color' == $type ) {
			$this->ampforwp_field_color($fields);
		}
		// Switch
		if ( 'switch' == $type ) {
			$this->ampforwp_field_switch($fields);
		}
		// Notification
		if ( 'notification' == $type ) {
			$this->ampforwp_field_notification($fields);
		}
		// Loader
		if ( 'loader' == $type ) {
			$this->ampforwp_field_loader($fields);
		}
		// Label
		if ( 'footer' == $type ) {
			$this->ampforwp_field_footer($fields);
		}
		// Main section
		if ( 'main_section_start' == $type ) {
			$this->main_section_start($fields);
		}
		if ( 'main_section_end' == $type ) {
			$this->main_section_end($fields);
		}
		// Section Start
		if ( 'section_start' == $type ) {
			$this->section_start($fields);
		}
		// Section end
		if ( 'section_end' == $type ) {
			$this->section_end($fields);
		}
		// Sub Section Start
		if ( 'sub_section_start' == $type ) {
			$this->sub_section_start($fields);
		}
		// Sub Section end
		if ( 'sub_section_end' == $type ) {
			$this->sub_section_end($fields);
		}
		// Sub Section end
		if ( 'heading' == $type ) {
			$this->ampforwp_field_heading($fields);
		}
	}

	public function ampforwp_field_heading($fields = array()){
		echo '<div class="ux-field-container amp-ux-heading"><h2>'.esc_html($this->title).'</h2></div>';
	}
	public function ampforwp_field_loader($fields = array()){
			echo '<div class="amp-ux-loader"><div class="amp-ux-loading"></div><div id="amp-ux-loading-saved" class="hide"></div><span class="hide amp-ux-check"></span></div>';
	}

	// Main Section
	public function main_section_start($fields = array() ) {
		if ( isset($fields['class']) ) {
				$this->class = $fields['class'];
		}
		if ( isset($fields['id']) ) {
			$this->id = $fields['id'];
		}
		echo '<div id="'.esc_attr($this->id).'" class="'.esc_attr($this->class).'">';
	}
	public function main_section_end($fields = array() ) {
		echo '</div>';
	}
	// Section Start
	public function section_start($fields = array()){
		if ( isset($fields['class']) ) {
				$this->class = $fields['class'];
		}
		if ( isset($fields['id']) ) {
			$this->id = $fields['id'];
		}
		$dcls = 'drawer';
		if($this->class=='ampforwp-ux-sub-section'){
			$dcls = '';
		}
		echo '<div id="'.esc_attr($this->id).'" class="'.esc_attr($dcls).' '.esc_attr($this->class).' amp-ux-section-container">
				<div class="amp-fields-content">';
	}
	// Sub Section Start
	public function sub_section_start($fields = array()){
		if ( isset($fields['class']) ) {
				$this->class = $fields['class'];
		}
		if ( isset($fields['id']) ) {
			$this->id = $fields['id'];
		}
		$hide = '';
		if ( isset($fields['default']) && $fields['default']==0) {
				$hide = 'hide';
		}
		$data_href = "";
		if ( isset($fields['data-href'])) {
				$data_href = 'data-href='.esc_attr($fields['data-href']);
		}
		
		echo '<div id="'.esc_attr($this->id).'" class="'.esc_attr($this->class).' '.esc_attr($hide).'" '.esc_attr($data_href).'>';
		if(isset($fields['closable']) && $fields['closable']==1){
			echo '<div class="ampforwp-ux-closable '.esc_attr($this->id).'">X</div>';
		}
	}
	// Section End
	public function sub_section_end(){
		echo '</div>';
	}
	// Section End
	public function section_end(){
		echo '</div></div>';
	}
	public function ampforwp_field_select($fields){
		$required = $hide = $hrf_id = '';
		$data_num = 1;
		if ( !empty($this->required) ) {
			$required = 'required='.esc_attr($this->required[0]);
			$hide = ' hide';
		}
		$output = '<div class="ux-field-container amp-ux-select-container '.$hide.'" '.esc_attr($required).'>';
		if ( !empty($this->title) ) {
			$output .= '<h2 class="'.esc_attr($this->element_class).'">'.esc_html__($this->title).'</h2>';
		}
		$output .= '<select id="'.$this->id.'" class="'.$this->class.'"  '.$this->data_href.'>';
		if ( !empty($this->options) ) {
			foreach ( $this->options as $option_key => $option_value ) {
				if( $option_key == $this->default ) {
					$this->selected = 'selected';
				}
				else{
					$this->selected = '';
				}
				$output .= '<option value="'.esc_attr($option_key).'" '.esc_attr($this->selected).' data-num="'.intval($data_num).'">'.esc_attr($option_value).'</option>';
				$data_num ++;
			}
		}
		$output .= '</select>';
		if(isset($fields['data-value']) && isset($fields['data-value-id'])){
			$hide = '';
			if($this->default!="Other"){
				$hide = 'hide';
			}
			$output .= '<div class="ux-other-site-type '.esc_attr($hide).'"><h2 class="ux-label trac-id site-tpy">Mention the type of your site</h2></div><input type="text" id="'.esc_attr($fields['data-value-id']).'" class="'.esc_attr($this->class).' '.esc_attr($hide).'" value="'.esc_attr($fields['data-value']).'" placeholder="Enter your website type">';
		}
		if( $this->data_href ){
			if ( isset($fields['data-href-id']) ) {
				$hrf_id = $fields['data-href-id'];
			}
			$output .= '<input type="hidden" value="'.esc_attr($this->default).'" id="'.esc_attr($hrf_id).'">';
		}
		if($this->id=="ampforwp-ux-analytics-more"){
			$output .= '<span><button type="button" id="ampforwp-add-more-analytics" class="">Add</button></span>';
		}

		$output .= '</div>';
		echo $output; /* $output XSS escaped */
	}
	public function ampforwp_field_checkbox($fields){
		$required = $hide = $checked = '';
		if ( !empty($fields['required']) ) {
			$required = 'required='.esc_attr($this->required[0]);
			$hide = 'hide';
		}
		if ( isset($fields['default']) && '1' == $fields['default'] ){
			$checked = 'checked';
		}

		$lbl_cls = '';
		if(isset($fields['label-class'])){
			$lbl_cls = 'class="'.esc_attr($fields['label-class']).'"';
		} /* $lbl_cls XSS escaped */

		$output = '<div class="ux-field-container amp-ux-checkbox-container '.esc_attr($hide).' '.esc_attr($this->parent_class).' " '.esc_attr($required).'><label '.$lbl_cls.'><input type="checkbox" class="'.esc_attr($this->class).'" id="'.esc_attr($this->id).'" ' . esc_attr($checked).'>'.esc_html__($this->title).'</label></div>';   /* $lbl_cls XSS escaped */
		echo $output;  /* $output XSS escaped */
	}
	public function ampforwp_field_switch($fields){

		$required = '';
		$output =   '';
		$hide = '';
		if ( !empty($this->required) ) {
			$required = 'required='.$this->required[0];
			$this->class .= ' hide';
			$hide = ' hide';
		}
		if($this->id == 'amp-ux-ext-ssd'){

			$output .= '<div class="ux-field-container amp-ux-heading"><h2 style="margin-top:40px; margin-bottom: 0px;">Recommended Plugins</h2></div>';
		}
		$output .= '<div class="ux-field-container amp-ux-switch-container '.esc_attr($this->parent_class).' '.esc_attr($hide).'">';
		if ( !empty($this->title) ) {
			$output .= '<h2 class="'.esc_attr($this->element_class).'">'.esc_html__($this->title, 'accelerated-mobile-pages').'</h2>';
		}
		if ( 1 == $this->default ) {
			$this->selected = 'checked';
		}
		else{
			$this->selected = '';
		}
		if(isset($fields['data-url']) && $fields['data-url']!="" && 2 == $this->default){
			$output .= '<div class="switch-options">
				<label class="ios7-switch '.esc_attr($this->id).'">
                	<a target="_blank" href="'.esc_url($fields['data-url']).'" class="afw-plugin-url"><i class="el el-cog"></i></a>
                </label>
                <input type="hidden" class="checkbox checkbox-input " id="'.esc_attr($this->id).'" value="'.esc_attr($this->default).'">
                </div>';
            }else{
			$output .= '<div class="switch-options">
						<label class="ios7-switch '.esc_attr($this->id).'">
	                    	<input id="'.esc_attr($this->id).'" '.esc_attr($this->selected).' class="switch-on-off '.esc_attr($this->class).'" type="checkbox" data-id="'.esc_attr($this->id).'" value="'.esc_attr($this->default).'" '.esc_attr($this->data_secure).' '.esc_attr($this->data_url).'>
	                        <span></span>
	                    </label>
	                    <input type="hidden" class="checkbox checkbox-input " id="'.esc_attr($this->id).'" value="'.esc_attr($this->default).'">
	                    </div>';
        }
        if( $this->desc ){
        	$output .= '<p class="amp-ux-switch-text">'.esc_html($this->desc).'</p>';
        }
        $output .= '</div>';
		echo $output; /* $output XSS escaped */
	}

	public function ampforwp_field_media(){
		$output = '<div class="ux-field-container amp-ux-media-container">';
		$id = $url = $width = $height = '';
		if ( !empty($this->title) ) {
			$output .= '<h2 class="'.esc_attr($this->element_class).'">'.esc_html($this->title).'</h2>';
		}
		if ( is_array($this->default) ) {
			$id = $this->default['id'];
			$url = $this->default['url'];
			$width = $this->default['width'];
			$height = $this->default['height'];
			$hide = 'hide';
		}
		$opt_med_url = ampforwp_get_setting('opt-media','url');
		$but_name = "Add Logo";
		$logo_css = "";
		if($opt_med_url!=""){
			$hide = '';
			$but_name = "Change Logo";
			$logo_css = "amp-ux-chng-lg";
		}
		$output .= '<div id="'.esc_attr($this->id).'" class="'.esc_attr($this->class).'" data-id="opt-media" data-type="media">
				<input placeholder="No media selected" type="text" class="upload large-text hide" id="amp-ux-opt-media-url" value="'.intval($id).'" readonly="readonly">
				<input type="hidden" class="data" data-mode="image">
				<input type="hidden" class="library-filter" data-lib-filter="">
				<input type="hidden" class="upload-id " name="amp-ux-logo-id" id="amp-ux-logo-id" value="'.intval($id).'">
				<input type="hidden" class="upload-height" name="amp-ux-logo-height" id="amp-ux-logo-height" value="'.intval($height).'">
				<input type="hidden" class="upload-width" name="amp-ux-logo-width" id="amp-ux-logo-width" value="'.intval($width).'">
				<input type="hidden" class="upload-thumbnail" name="amp-ux-logo-thumb" id="amp-ux-logo-thumb" value="'.esc_url($url).'">
				<div class="screenshot '.esc_attr($hide).'">
					
					<img class="redux-option-image amp-ux-image" id="image_opt-media" src="'.esc_url($url).'" alt="" target="_blank" rel="external">
					
				</div>
				<div class="upload_button_div amp-ux-upload '.esc_attr($logo_css).'">
					<span class="button media_upload_button media-amp-ux-opt-media media-'.intval($this->id).'" id="opt-media-media">'.esc_attr($but_name).'</span>
					<span class="amp-ux-img-re-txt">(Recommended Size: 120 x 90)</span>				
				</div>';
			$output .= '</div></div>';
        echo $output; /* $output XSS escaped */
	}

	public function ampforwp_field_color(){
		
		$output = '<div class="ux-field-container amp-ux-color-container" id="ampforwp-easy-setup-global-color">';
		if ( !empty($this->title) ) {
			$output .= '<h2 class="'.esc_attr($this->element_class).'">'.esc_html($this->title).'</h2>';
		}
		$this->selected = $this->default ? 'value='.esc_attr($this->default) : "";
		$output .= '<input type="text" id="'.esc_attr($this->id).'" class="'.esc_attr($this->class).'" '.esc_attr($this->selected).'>';
		$output .= '</div>';
		echo $output; /* $output XSS escaped */
	}
	public function ampforwp_field_text($fields){
		$required = '';
		$hide = '';
		if ( !empty($this->required) ) {
			$required = 'required="'.esc_attr($this->required[0]).'"';
			$hide .= ' hide';
		}
		$output = '<div class="ux-field-container amp-ux-text-container '.esc_attr($hide).'">';
		if ( !empty($this->title) ) {
			$output .= '<h2 class="'.esc_attr($this->element_class).'">'.esc_html($this->title).'</h2>';
		}
		$output .= '<input type="text" id="'.esc_attr($this->id).'" class="'.esc_attr($this->class).'" '.esc_attr($this->data_text).' value="'.esc_attr($this->default).'"></div>';
		echo $output; /* $output XSS escaped */
	}

	public function loading(){
		$output = '<span class="hide amp-ux-check"></span><div class="hide amp-ux-loading"></div><br>';
		echo $output; /* $output XSS escaped */
	}
	public function ampforwp_field_notification($fields){
		$required = $hide = $hrf_id = '';
		$data_num = 1;
		if ( !empty($this->required) ) {
			$required = 'required='.esc_attr($this->required[0]);
			$hide = ' hide';
		}
	
		$class = "";
		if($fields['type']=="warning"){
			$class = "warning";
		} 
		else if($fields['type']=="notice"){
			$class = "warning-red";
		}
		else if($fields['type']=="success"){
			$class = "success";
		}
		if($this->default==1){
			$hide = "";
		}
		$output = '<div class="ux-field-container amp-ux-notif-container '.esc_attr($class).' '.esc_attr($hide).'" id="'.esc_attr($this->id).'" '.esc_attr($required).'>';
		if ( !empty($this->desc) ) {
			$output .= '<p>'.$this->desc.'</p>'; // xss ok for $this->desc
		}
		$output .= '</div>';
		echo $output; // xss ok for $output
	}

	public function ampforwp_field_footer($fields){
		$output = '<div class="ux-field-container ux-field-footer" id="'.esc_attr($this->id).'">';
		foreach($fields as $f){
			$svg = '';
			if(isset($f['svg'])){
				$svg = $f['svg'];
			}
			$output .= '<div class="ux-field-foot-cont"><a href="'.esc_url($f['url']).'" target="_blank">
							<i class="ux-foot-icon '.esc_attr($f['icon']).'"></i>'.$svg.'
							<p>'.esc_html__($f['desc']).'</p></a>
						</div>';
		}
		$output .= '</div>';
		echo $output; // xss ok for $output
	}

}?>