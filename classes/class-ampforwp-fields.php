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
		if ( 'upload' == $type ) {
			$this->ampforwp_field_upload($fields);
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
				$output .= '<option value="'.$option_key.'">'.$option_value.'</option>';
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
                    	<input id="'.$this->id.'" class="'.$this->class.'" type="checkbox" data-id="'.$this->id.'">
                        <span></span>
                    </label>
                    <input type="hidden" class="checkbox checkbox-input " id="'.$this->field.'" value="">';
		echo $output;
	}

	public function ampforwp_field_upload(){

	}

	public function ampforwp_field_color(){

	}
	public function ampforwp_field_text(){
		if ( !empty($this->title) ) {
			$output .= '<h2>'.$this->title.'</h2>';
		}
		$output .= '<input type="text" id="'.$this->id.'" class="'.$this->class.'"><br>';
		echo $output;
	}

}?>