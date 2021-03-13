<?php
namespace ReduxCore\ReduxFramework;
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Multi_Text
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_multitext_repeater' ) ) {

    /**
     * Main ReduxFramework_multi_text class
     *
     * @since       1.0.0
     */
    class ReduxFramework_multitext_repeater {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value = '', $parent = ' ' ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {
            $this->add_text   = ( isset( $this->field['add_text'] ) ) ? $this->field['add_text'] : __( 'Go', 'accelerated-mobile-pages' );
            $this->show_empty = ( isset( $this->field['show_empty'] ) ) ? $this->field['show_empty'] : true;
            echo '<span style="clear:both;display:block;height:0;" /></span>';
            $this->field['add_number'] = ( isset( $this->field['add_number'] ) && is_numeric( $this->field['add_number'] ) ) ? $this->field['add_number'] : 1;
            
            $options = array("link_tracking" => "Link Tracking",
                             "form_submission" => "Form Submission",
                            );
          echo '<a href="javascript:void(0);" class="button redux-multitext_show_hide">Add</a>'; 
          echo '<div id="select_goals" class="hide">';
          echo '<select  id="form_opt" name="test" value="" class="multitext_repeater_form_opt">';
                foreach ($options as $ok => $ov) {
                    $select = '';
                   echo '<option value="'.esc_attr($ok).'" '.esc_attr($select).'>'.esc_attr($ov).'</option>';
                }
           echo '</select>';
           echo '<a href="javascript:void(0);" class="button button-default redux-multitext_repeater-add" data-add_number="' . $this->field['add_number'] . '" data-id="' . esc_attr($this->field['id']) . '-ul" data-name="' . esc_attr($this->field['name']) . esc_attr($this->field['name_suffix']) . '[]">' . esc_attr($this->add_text) . '</a><br/>';
           echo '</div>';
            echo '<ul id="' . esc_attr($this->field['id']) . '-ul" class="redux-multitext_repeater">';
            if ( isset( $this->value ) && is_array( $this->value ) ) {
                $select_count = 0;
                if(isset($this->value['amp-goal-type']) && isset($this->value['amp-goal-type']['select'])){
                    $select_count = count($this->value['amp-goal-type']['select']);
                }
                $text_count = 0;
                if(isset($this->value['amp-conv-goal-id']) && isset($this->value['amp-conv-goal-id']['text'])){
                    $text_count = count($this->value['amp-conv-goal-id']['text']);
                }
                if($select_count!=$text_count){
                    for($i=$text_count;$i<$select_count;$i++){
                        $this->value['amp-conv-goal-id']['text'][] = '';
                    }
                }
                $data_arr = array();
                if(is_array( $this->value)){
                    foreach ( $this->value as $k => $value ) {
                        if(is_array( $value)){
                            foreach ($value as $tk => $tval) {
                                $temp_arr = array();
                                $temp_arr['name'][] = $k;
                                $temp_arr['type'][] = $tk;
                                foreach ($tval as $ck => $cval) {
                                    $temp_arr['value'][] = $cval;
                                }
                                $data_arr[] = $temp_arr; 
                            }
                        }
                    }
                }
                $new_arr = array();
                if(isset($data_arr[0]) && is_array($data_arr[0])){
                    $val_count = count($data_arr[0]['value']);
                    for($i=0;$i<$val_count;$i++){
                        $t_arr = array();
                        for($j=0;$j<count($data_arr);$j++){
                            $temp_arr = array();
                            $temp_arr['name'] = $data_arr[$j]['name'][0];
                            $temp_arr['type'] = $data_arr[$j]['type'][0];
                            $temp_arr['value'] = isset($data_arr[$j]['value'][$i])?$data_arr[$j]['value'][$i]:'';
                            $t_arr[] = $temp_arr;
                        }
                        $new_arr[] = $t_arr;
                    }
                }
               $reset = $resetclass = $hide = '';
            
              if(!empty($new_arr)){
                    $row_count = 0;
                    $total_count = 0;
                    foreach ($new_arr as $nk => $nvalue) {
                    $row_count++;
                    $count = 0;
                    $goal_title = '';
                    $docs_link = '#';
                    if($nvalue[$count]['value'] == 'form_submission'){
                        $goal_title = 'Form Submission';
                        $docs_link = 'https://ampforwp.com/tutorials/article/how-to-add-ga-form-submission-tracking-in-amp/';
                    }
                    if($nvalue[$count]['value'] == 'link_tracking'){
                        $goal_title = 'Link Tracking';
                        $docs_link = 'https://ampforwp.com/tutorials/article/how-to-add-ga-link-tracking-in-amp/';
                    }
                    echo '<li>';
                    echo '<span class="tool_tip afw-tooltip"><i class="el el-question-sign "></i> 
                        <span class="afw-help-subtitle"><a href="'.esc_url($docs_link).'" target="_blank">Click Here</a> for more info on '.esc_html($goal_title).'</span>
                                </span><div class="element-fields multitext_repeater-fields '.esc_attr($hide).' '.esc_attr($resetclass).'">';
                     echo '<span class="goals-count">Goals #'.esc_attr($row_count).' '.esc_html($goal_title).'</span>';    
                    
                        foreach ($this->field['repeat-fields'] as $rk => $rv) {
                            if(is_array($rv)){
                                if(!empty($rv)){
                                    foreach ($rv as $rk1 => $rv1) {
                                            $total_count++;
                                            if($rv1=='select'){
                                                $elem_arr = $nvalue[$count];
                                                $val = $elem_arr['value'];
                                                if($rv['id'] == 'amp-goal-type'){
                                              }
                                                $count++;
                                               
                                            $div_cls= $form_class=$span = $hide = '';

                                             if($rv['id'] == 'amp-goal-type' || $goal_title == 'Link Tracking'){
                                              $hide = 'style="display:none;"';
                                             }else{

                                              $form_class = "form_select_opt";
                                              $span = '<div class="main_form_select"><span>'.esc_html($rv['title']).'</span>';
                                              $div_cls = '</div>';
                                             }
                                               echo $span;
                                                echo '<select '.$hide.' id="' . esc_attr($this->field['id']).'-'.esc_attr($rv['id']).'" name="' . esc_attr($this->field['name']) . '['.esc_attr($rv['id']).']['.esc_attr($rv1).']' . '[]' . '" class = "indi_option '.esc_attr($form_class).'" value="">';
                                                    foreach ($rv['options'] as $ok => $ov) {
                                                        $select = '';
                                                        if($val == $ok){
                                                            $select = 'selected';
                                                        }
                                                       echo '<option value="'.esc_attr($ok).'" '.esc_attr($select).'>'.esc_attr($ov).'</option>';
                                                    }
                                                echo '</select>';
                                                echo $div_cls;

                                            }else if($rv1=='text'){
                                              if(isset($nvalue[$count])){
                                                $elem_arr = $nvalue[$count];
                                                $val = $elem_arr['value']; 
                                              }else{
                                                 $val = '';
                                              }
                                                $count++;

                                                $class = '';
                                                if($rk == 2){
                                                    $class = 'id_class';

                                                   if($nvalue[0]['value'] == 'form_submission'){
                                                   $rv['title'] = 'Form ID';
                                                   }else{
                                                    $rv['title'] = 'Link ID';
                                                   }
                                                }
                                             $main_id_class = $hide_class_id =  $hide_class =  '';
                                                if($nvalue[0]['value'] == 'form_submission'){
                                                    if($nvalue[1]['value'] == 'select'){
                                                      $hide_class = 'hide';
                                                    }
                                          
                                            if($rk == 2 && $nvalue[1]['value'] == 'all_form_submission'){
                                                       $hide_class_id = 'hide';
                                                    }

                                                    if($rk == 2){
                                                      $main_id_class = 'main_id_class';
                                                    }
                                                  }
                                              echo '<div class="form_sel_div '.esc_attr($hide_class).' '.esc_attr($hide_class_id).'  '.esc_attr($main_id_class).'">';  
                                              echo '<span class="multi-title '.esc_attr($class).'">'.esc_html($rv['title']).'</span>';
                                                echo '<input type="text" id="' . esc_attr($this->field['id']).'-'.esc_attr($rv['id']).'" name="' . esc_attr($this->field['name']) . '['.esc_attr($rv['id']).']['.$rv1.']' . '[]' . '" value="'.esc_attr($val).'" class="regular-text multi-text' . esc_attr($this->field['class']) . '" placeholder ="'.esc_attr($rv['placeholder']).'" />';
                                                 echo '</div>';  
                                            }
                                        }
                                    //}
                                }
                            }
                        }
                    $disp = '';
                    if(($row_count==1 && $select_count==1) || $reset == 'checked' ){
                        $disp = 'display:none';
                    }
                    echo '<span class="el el-remove deletion redux-multitext_repeater-remove" style="'.esc_attr($disp).'"></span><div>';
                    echo '</li>';
                    }
                 }
            }
            echo '</ul>';

        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            wp_enqueue_script(
                'redux-field-multitext_repeater-js',
               // ReduxFramework::$_url . 'inc/fields/multitext_repeater/field_multitext_repeater.js',
                ReduxFramework::$_url . 'inc/fields/multitext_repeater/field_multitext_repeater' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-multitext_repeater-css',
                ReduxFramework::$_url . 'inc/fields/multitext_repeater/field_multitext_repeater.css',
                array(),
                time(),
                'all'
            );
        }
    }
}