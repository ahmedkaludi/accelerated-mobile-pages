<?php
/**
 * 
 */
class AMPforWP_Fields
{
	private $output = '';
	private $class = '';
	private $id = '';
	private $title = '';
	private $desc = '';
	private $default = '';
	private $selected = '';
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
				if ( $type != 'section_start' && $type != 'section_end' && $type != 'main_section_start' && $type != 'main_section_end') {
					$fields['class'] .= ' amp-ux-field';
				}
				$this->class = $fields['class'];
			}
			else{
				$this->class = '';
			}
			if ( isset($fields['title']) ) {
				$this->title = $fields['title'];
			}
			else{
				$this->title = '';
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
				$this->data_href = ' data-href="'.$fields['data-href'].'"';
			}
			else{
				$this->data_href = '';
			}
			if ( isset($fields['data-text']) ) {
				$this->data_text = ' data-text="'.$fields['data-text'].'"';
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
	}
	// Main Section
	public function main_section_start($fields = array() ) {
		if ( isset($fields['class']) ) {
				$this->class = $fields['class'];
		}
		if ( isset($fields['id']) ) {
			$this->id = $fields['id'];
		}
		echo '<div id="'.$this->id.'" class="'.$this->class.'">';
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
		echo '<div id="'.$this->id.'" class="drawer '.$this->class.' amp-ux-section-container">
				<div class="amp-fields-content">';
	}
	// Section End
	public function section_end(){
		echo '</div></div>';
	}
	public function ampforwp_field_select($fields){
		$required = $hide = $hrf_id = '';
		$data_num = 1;
		if ( !empty($this->required) ) {
			$required = 'required="'.$this->required[0].'"';
			$hide = ' hide';
		}
		$output = '<div class="ux-field-container amp-ux-select-container '.$hide.'">';
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<select id="'.$this->id.'" class="'.$this->class.'" '.$required.' '.$this->data_href.'>';
		if ( !empty($this->options) ) {
			foreach ( $this->options as $option_key => $option_value ) {
				if( $option_key == $this->default ) {
					$this->selected = 'selected';
				}
				else{
					$this->selected = '';
				}
				$output .= '<option value="'.$option_key.'" '.$this->selected.' data-num="'.$data_num.'">'.$option_value.'</option>';
				$data_num ++;
			}
		}
		if( $this->data_href ){
			if ( isset($fields['data-href-id']) ) {
				$hrf_id = $fields['data-href-id'];
			}
			$output .= '<input type="hidden" value="'.$this->default.'" id="'.$hrf_id.'">';
		}
		$output .= '</select></div>';
		echo $output;
	}
	public function ampforwp_field_checkbox($fields){
		$required = $hide = $checked = '';
		if ( !empty($fields['required']) ) {
			$required = 'required="'.$this->required[0].'"';
			$hide = 'hide';
		}
		if ( isset($fields['default']) && '1' == $fields['default'] ){
			$checked = 'checked';
		}
		$output = '<div class="ux-field-container amp-ux-checkbox-container '.$hide.'">
				<label><input type="checkbox" class="'.$this->class.'" id="'.$this->id.'" '.$required.'' . $checked.'>'.$this->title.'</label></div>';
		echo $output;
	}
	public function ampforwp_field_switch($fields){
		$required = '';
		if ( !empty($this->required) ) {
			$required = 'required="'.$this->required[0].'"';
			$this->class .= ' hide';
			$hide = ' hide';
		}
		$output = '<div class="ux-field-container amp-ux-switch-container '.$hide.'">';
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		if ( 1 == $this->default ) {
			$this->selected = 'checked';
		}
		else{
			$this->selected = '';
		}
		$output .= '<div class="switch-options">
					<label class="ios7-switch">
                    	<input id="'.$this->id.'" '.$this->selected.' class="switch-on-off '.$this->class.'" type="checkbox" data-id="'.$this->id.'" value="'.$this->default.'">
                        <span></span>
                    </label>
                    <input type="hidden" class="checkbox checkbox-input " id="'.$this->id.'" value="'.$this->default.'">
                    </div>';
        if( $this->desc ){
        	$output .= '<p class="amp-ux-switch-text">'.$this->desc.'</p>';
        }
        $output .= '</div>';
		echo $output;
	}

	public function ampforwp_field_media(){
		$output = '<div class="ux-field-container amp-ux-media-container">';
		$id = $url = $width = $height = '';
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		if ( is_array($this->default) ) {
			$id = $this->default['id'];
			$url = $this->default['url'];
			$width = $this->default['width'];
			$height = $this->default['height'];
			$hide = 'hide';
		}
		$opt_med_url = ampforwp_get_setting('opt-media','url');
		if($opt_med_url!=""){
			$hide = '';
		}
		$output .= '<div id="'.$this->id.'" class="'.$this->class.'" data-id="opt-media" data-type="media">
				<input placeholder="No media selected" type="text" class="upload large-text hide" id="amp-ux-opt-media-url" value="'.$id.'" readonly="readonly">
				<input type="hidden" class="data" data-mode="image">
				<input type="hidden" class="library-filter" data-lib-filter="">
				<input type="hidden" class="upload-id " name="amp-ux-logo-id" id="amp-ux-logo-id" value="'.$id.'">
				<input type="hidden" class="upload-height" name="amp-ux-logo-height" id="amp-ux-logo-height" value="'.$height.'">
				<input type="hidden" class="upload-width" name="amp-ux-logo-width" id="amp-ux-logo-width" value="'.$width.'">
				<input type="hidden" class="upload-thumbnail" name="amp-ux-logo-thumb" id="amp-ux-logo-thumb" value="'.$url.'">
				<div class="screenshot '.$hide.'">
					<a class="of-uploaded-image" href="" target="_blank">
						<img class="redux-option-image amp-ux-image" id="image_opt-media" src="'.$url.'" alt="" target="_blank" rel="external">
					</a>
				</div>
				<div class="upload_button_div amp-ux-upload">
					<span class="button media_upload_button media-'.$this->id.'" id="opt-media-media">Upload</span>				
				</div>';
			$output .= '</div></div>';
        echo $output;
	}

	public function ampforwp_field_color(){
		
		$output = '<div class="ux-field-container amp-ux-color-container">';
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$this->selected = $this->default ? 'value="'.$this->default.'"' : "";
		$output .= '<input type="text" id="'.$this->id.'" class="'.$this->class.'" '.$this->selected.'>';
		$output .= '</div>';
		echo $output;
	}
	public function ampforwp_field_text($fields){
		$required = '';
		if ( !empty($this->required) ) {
			$required = 'required="'.$this->required[0].'"';
			$hide .= ' hide';
		}
		$output = '<div class="ux-field-container amp-ux-text-container '.$hide.'">';
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<input type="text" id="'.$this->id.'" class="'.$this->class.'" '.$this->data_text.' value="'.$this->default.'"></div>';
		echo $output;
	}

	public function loading(){
		$output = '<span class="hide amp-ux-check"></span><div class="hide amp-ux-loading"></div><br>';
		echo $output;
	}
	public function ampforwp_field_notification($fields){
		$required = $hide = $hrf_id = '';
		$data_num = 1;
		if ( !empty($this->required) ) {
			$required = 'required="'.$this->required[0].'"';
			$hide = ' hide';
		}
		$class = "";
		if($fields['type']=="warning"){
			$class = "warning";
		}else if($fields['type']=="error"){
			$class = "error";
		}else if($fields['type']=="success"){
			$class = "success";
		}
		if($this->default==1){
			$hide = "";
		}
		$output = '<div class="ux-field-container amp-ux-notif-container '.$class.' '.$hide.'" id="'.$this->id.'" '.$required.'>';
		if ( !empty($this->desc) ) {
			$output .= '<p>'.$this->desc.'</p>';
		}
		$output .= '</div>';
		echo $output;
	}

	public function ampforwp_field_footer($fields){
		$output = '<div class="ux-field-container ux-field-footer" id="'.$this->id.'">';
		foreach($fields as $f){
			$a_open = "";
			$a_close = "";
			if(isset($f['url'])){
				$a_open = '<a href="'.$f['url'].'" target="_blank">';
				$a_close = "</a>";
			}

			$output .= '<div class="ux-field-foot-cont">'.$a_open.'
							<i class="ux-foot-icon '.$f['icon'].'"></i>
							<p>'.$f['desc'].'</p>'.$a_close.'
						</div>';
		}
		$output .= '</div>';
		echo $output;
	}

}?>