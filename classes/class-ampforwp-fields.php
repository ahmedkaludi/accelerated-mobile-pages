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

	public function setField( $type = '', $fields=array() ){
		if( '' == $type ) {
			return false;
		}
		if( !empty($fields) ){
			if ( isset($fields['class']) ) {
				$this->class = $fields['class'];
			}
			if ( isset($fields['title']) ) {
				$this->title = $fields['title'];
			}
			if ( isset($fields['id']) ) {
				$this->id = $fields['id'];
			}
			if ( isset($fields['default']) ) {
				$this->default = $fields['default'];
			}
			if ( isset($fields['options']) && is_array($fields['options']) ){
				$this->options = $fields['options'];
			}
		}
		// Select
		if ( 'select' == $type ) {
			$this->ampforwp_field_select($fields);
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
		// 
	}
	// Section Start
	public function section_start($fields = array()){
		if ( isset($fields['class']) ) {
				$this->class = $fields['class'];
		}
		if ( isset($fields['id']) ) {
			$this->id = $fields['id'];
		}
		echo '<div id="'.$this->id.'" class="drawer '.$this->class.'">
				<div class="amp-fields-content">';
	}
	// Section End
	public function section_end(){
		echo '</div></div>';
	}
	public function ampforwp_field_select($fields){
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<select id="'.$this->id.'" class="'.$this->class.'">';
		if ( !empty($this->options) ) {
			foreach ( $this->options as $option_key => $option_value ) {
				if( $option_key == $this->default ) {
					$this->selected = 'selected';
				}
				else{
					$this->selected = '';
				}
				$output .= '<option value="'.$option_key.'" '.$this->selected.'>'.$option_value.'</option>';
			}
		}
		$output .= '</select>';
		echo $output;
	}
	public function ampforwp_field_checkbox($fields){
		$output .= '<br><input type="checkbox" id="'.$this->id.'" name="'.$this->id.'">'.$this->title.'<br>';
		echo $output;
	}
	public function ampforwp_field_switch($fields){
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<label class="ios7-switch">
                    	<input id="'.$this->id.'" class="switch-on-off '.$this->class.'" type="checkbox" data-id="'.$this->id.'">
                        <span></span>
                    </label>
                    <input type="hidden" class="checkbox checkbox-input " id="'.$this->id.'" value="">';
		echo $output;
	}

	public function ampforwp_field_media(){
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<div id="amp-ux-opt-media" class="amp-ux-opt-media-container" data-id="opt-media" data-type="media">
				<input placeholder="No media selected" type="text" class="upload large-text hide" id="amp-ux-opt-media-url" value="" readonly="readonly">
				<input type="hidden" class="data" data-mode="image">
				<input type="hidden" class="library-filter" data-lib-filter="">
				<input type="hidden" class="upload-id " name="amp-ux-logo-id" id="amp-ux-logo-id" value="">
				<input type="hidden" class="upload-height" name="amp-ux-logo-height" id="amp-ux-logo-height" value="">
				<input type="hidden" class="upload-width" name="amp-ux-logo-width" id="amp-ux-logo-width" value="">
				<input type="hidden" class="upload-thumbnail" name="amp-ux-logo-thumb" id="amp-ux-logo-thumb" value="">
				<div class="hide screenshot">
					<a class="of-uploaded-image" href="" target="_blank">
						<img class="redux-option-image" id="image_opt-media" src="" alt="" target="_blank" rel="external">
					</a>
				</div>
				<div class="upload_button_div">
					<span class="button media_upload_button" id="opt-media-media">Upload</span>
					<span class="button remove-image hide" id="reset_opt-media" rel="opt-media">Remove</span>
				</div>
        </div>';
        echo $output;
	}

	public function ampforwp_field_color(){
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<input type="color" id="'.$this->id.'" class="'.$this->class.'"><br>';
		echo $output;
	}
	public function ampforwp_field_text(){
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<input type="text" id="'.$this->id.'" class="'.$this->class.'"><br>';
		echo $output;
	}

}?>