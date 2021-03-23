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
if ( ! class_exists( 'ReduxFramework_repeater' ) ) {

    /**
     * Main ReduxFramework_multi_text class
     *
     * @since       1.0.0
     */
    class ReduxFramework_repeater {

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
            $this->add_text   = ( isset( $this->field['add_text'] ) ) ? $this->field['add_text'] : __( 'Add More', 'accelerated-mobile-pages' );
            $this->show_empty = ( isset( $this->field['show_empty'] ) ) ? $this->field['show_empty'] : true;

            echo '<ul id="' . esc_attr($this->field['id']) . '-ul" class="redux-repeater">';
            if ( isset( $this->value ) && is_array( $this->value ) ) {
                $select_count = 0;
                if(isset($this->value['amp-dns-urls-type']) && isset($this->value['amp-dns-urls-type']['select'])){
                    $select_count = count($this->value['amp-dns-urls-type']['select']);
                }
                $text_count = 0;
                if(isset($this->value['amp-dns-urls-field']) && isset($this->value['amp-dns-urls-field']['text'])){
                    $text_count = count($this->value['amp-dns-urls-field']['text']);
                }
                if($select_count!=$text_count){
                    for($i=$text_count;$i<$select_count;$i++){
                        $this->value['amp-dns-urls-field']['text'][] = '';
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
                            $temp_arr['value'] = $data_arr[$j]['value'][$i];
                            $t_arr[] = $temp_arr;
                        }
                        $new_arr[] = $t_arr;
                    }
                }

                if(!empty($new_arr)){
                    $row_count = 0;
                    $total_count = 0;
                    foreach ($new_arr as $nk => $nvalue) {
                    $row_count++;
                    $count = 0;
                    echo '<li>';
                    echo '<div class="element-fields">';
                        foreach ($this->field['repeat-fields'] as $rk => $rv) {
                            if(is_array($rv)){
                                if(!empty($rv)){
                                    foreach ($rv as $rk1 => $rv1) {
                                        if(isset($nvalue[$count])){
                                            $total_count++;
                                            if($rv1=='select'){
                                                $elem_arr = $nvalue[$count];
                                                $val = $elem_arr['value'];
                                                $count++;
                                                echo '<select  id="' . esc_attr($this->field['id']).'-'.esc_attr($rv['id']).'" name="' . esc_attr($this->field['name']) . '['.esc_attr($rv['id']).']['.esc_attr($rv1).']' . '[]' . '" value="">';
                                                    foreach ($rv['options'] as $ok => $ov) {
                                                        $select = '';
                                                        if($val == $ok){
                                                            $select = 'selected';
                                                        }
                                                       echo '<option value="'.esc_attr($ok).'" '.esc_attr($select).'>'.esc_attr($ov).'</option>';
                                                    }
                                                echo '</select>';
                                            }else if($rv1=='text'){
                                                $elem_arr = $nvalue[$count];
                                                $val = $elem_arr['value'];
                                                $count++;
                                                echo '<input type="text" id="' . esc_attr($this->field['id']).'-'.esc_attr($rv['id']).'" name="' . esc_attr($this->field['name']) . '['.esc_attr($rv['id']).']['.$rv1.']' . '[]' . '" value="'.esc_attr($val).'" class="regular-text ' . esc_attr($this->field['class']) . '" />';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    $disp = '';
                    if($row_count==1 && $select_count==1){
                        $disp = 'display:none';
                    }
                    echo '<span class="el el-remove deletion redux-repeater-remove" style="'.esc_attr($disp).'"></span><div>';
                    echo '</li>';
                    }
                }
            } elseif ( $this->show_empty == true ) {
                if(is_array($this->field['repeat-fields'])){
                    if(!empty($this->field['repeat-fields'])){
                        echo '<li>';
                         echo '<div class="element-fields">';
                        foreach ($this->field['repeat-fields'] as $rk => $rv) {
                            if(is_array($rv)){
                                if(!empty($rv)){
                                    foreach ($rv as $rk1 => $rv1) {
                                        if($rv1=='select'){
                                            echo '<select  id="' . esc_attr($this->field['id']).'-'.esc_attr($rv['id']).'" name="' . esc_attr($this->field['name']) . '['.esc_attr($rv['id']).']['.esc_attr($rv1).']' . '[]' . '" value="">';
                                                foreach ($rv['options'] as $ok => $ov) {
                                                   echo '<option value="'.esc_attr($ok).'">'.esc_attr($ov).'</option>';
                                                }
                                            echo '</select>';
                                        }
                                        if($rv1=='text'){
                                            echo '<input type="text" id="' . esc_attr($this->field['id']).'-'.esc_attr($rv['id']).'" name="' . esc_attr($this->field['name']) . '['.esc_attr($rv['id']).']['.esc_attr($rv1).']' . '[]' . '" value="" class="regular-text ' . esc_attr($this->field['class']) . '" />';
                                        }
                                    }
                                }
                            }
                        }
                        echo '<span class="el el-remove deletion redux-repeater-remove"></span><div>';
                        echo '</li>';
                    }
                }
            }
            echo '</ul>';
            echo '<span style="clear:both;display:block;height:0;" /></span>';
            $this->field['add_number'] = ( isset( $this->field['add_number'] ) && is_numeric( $this->field['add_number'] ) ) ? $this->field['add_number'] : 1;
            echo '<a href="javascript:void(0);" class="button button-default redux-repeater-add" data-add_number="' . $this->field['add_number'] . '" data-id="' . $this->field['id'] . '-ul" data-name="' . $this->field['name'] . $this->field['name_suffix'] . '[]">' . $this->add_text . '</a><br/>';
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
                'redux-field-repeater-js',
                ReduxFramework::$_url . 'inc/fields/repeater/field_repeater' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-repeater-css',
                ReduxFramework::$_url . 'inc/fields/repeater/field_repeater.css',
                array(),
                time(),
                'all'
            );
        }
    }
}