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
 * @subpackage  Field_Slider
 * @author      Kevin Provance (kprovance)
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ReduxCore\\ReduxFramework\\ReduxFramework_amp_slider' ) ) {
    class ReduxFramework_amp_slider {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 3.1.8
         */
        private $display_none = 0;
        private $display_label = 1;
        private $display_text = 2;
        private $display_select = 3;
        private $parent;
        private $field = array();
        private $value = array();
        private $extension_dir;
        private $extension_url;
        private $time;

        function __construct( $field = array(), $value = '', $parent = ' ' ) {

            //parent::__construct( $parent->sections, $parent->args );
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
            $this->time = time();
            if ( defined('AMPFORWP_VERSION') ) {
                $this->time = AMPFORWP_VERSION;
            }
			
			if( empty( $this->extension_dir ) ) {
            $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
            $this->extension_url = plugin_dir_url(__FILE__);
            }    
            // Set defaults
            $defaults = array(
                'handles'       => 1,
                'resolution'    => 1,
                'display_value' => 'text',
                'float_mark'    => '.',
                'forced'        => true
            );

            $this->field = wp_parse_args( $this->field, $defaults );

            // Sanitize float mark
            switch ( $this->field['float_mark'] ) {
                case ',':
                case '.':
                    break;
                default:
                    $this->field['float_mark'] = '.';
                    break;
            }

            // Sanitize resolution value
            $this->field['resolution'] = $this->cleanVal( $this->field['resolution'] );

            // Sanitize handle value
            switch ( $this->field['handles'] ) {
                case 0:
                case 1:
                    $this->field['handles'] = 1;
                    break;
                default:
                    $this->field['handles'] = 2;
                    break;
            }

            // Sanitize display value
            switch ( $this->field['display_value'] ) {
                case 'label':
                    $this->field['display_value'] = $this->display_label;
                    break;
                case 'text':
                default:
                    $this->field['display_value'] = $this->display_text;
                    break;
                case 'select':
                    $this->field['display_value'] = $this->display_select;
                    break;
                case 'none':
                    $this->field['display_value'] = $this->display_none;
                    break;
            }
        }

        private function cleanVal( $var ) {
            if ( is_float( $var ) ) {
                $cleanVar = floatval( $var );
            } else {
                $cleanVar = intval( $var );
            }

            return $cleanVar;
        }

        private function cleanDefault( $val ) {
            if ( empty( $val ) && ! empty( $this->field['default'] ) && $this->cleanVal( $this->field['min'] ) >= 1 ) {
                $val = $this->cleanVal( $this->field['default'] );
            }

            if ( empty( $val ) && $this->cleanVal( $this->field['min'] ) >= 1 ) {
                $val = $this->cleanVal( $this->field['min'] );
            }

            if ( empty( $val ) ) {
                $val = 0;
            }

            // Extra Validation
            if ( $val < $this->field['min'] ) {
                $val = $this->cleanVal( $this->field['min'] );
            } else if ( $val > $this->field['max'] ) {
                $val = $this->cleanVal( $this->field['max'] );
            }

            return $val;
        }

        private function cleanDefaultArray( $val ) {
            $one = $this->value[1];
            $two = $this->value[2];

            if ( empty( $one ) && ! empty( $this->field['default'][1] ) && $this->cleanVal( $this->field['min'] ) >= 1 ) {
                $one = $this->cleanVal( $this->field['default'][1] );
            }

            if ( empty( $one ) && $this->cleanVal( $this->field['min'] ) >= 1 ) {
                $one = $this->cleanVal( $this->field['min'] );
            }

            if ( empty( $one ) ) {
                $one = 0;
            }

            if ( empty( $two ) && ! empty( $this->field['default'][2] ) && $this->cleanVal( $this->field['min'] ) >= 1 ) {
                $two = $this->cleanVal( $this->field['default'][1] + 1 );
            }

            if ( empty( $two ) && $this->cleanVal( $this->field['min'] ) >= 1 ) {
                $two = $this->cleanVal( $this->field['default'][1] + 1 );
            }

            if ( empty( $two ) ) {
                $two = $this->field['default'][1] + 1;
            }

            $val[0] = $one;
            $val[1] = $two;

            return $val;
        }


        /**
         * Clean the field data to the fields defaults given the parameters.
         *
         * @since Redux_Framework 3.1.8
         */
        function clean() {

            // Set min to 0 if no value is set.
            $this->field['min'] = empty( $this->field['min'] ) ? 0 : $this->cleanVal( $this->field['min'] );

            // Set max to min + 1 if empty.
            $this->field['max'] = empty( $this->field['max'] ) ? $this->field['min'] + 1 : $this->cleanVal( $this->field['max'] );

            // Set step to 1 if step is empty ot step > max.
            $this->field['step'] = empty( $this->field['step'] ) || $this->field['step'] > $this->field['max'] ? 1 : $this->cleanVal( $this->field['step'] );

            if ( 2 == $this->field['handles'] ) {
                if ( ! is_array( $this->value ) ) {
                    $this->value[1] = 0;
                    $this->value[2] = 1;
                }
                $this->value = $this->cleanDefaultArray( $this->value );
            } else {
                if ( is_array( $this->value ) ) {
                    $this->value = 0;
                }
                $this->value = $this->cleanDefault( $this->value );
            }

            // More dummy checks
            //if ( ! is_array( $this->field['default'] ) && 2 == $this->field['handles'] ) {
            if ( ! is_array( $this->value ) && 2 == $this->field['handles'] ) {
                $this->value[0] = $this->field['min'];
                $this->value[1] = $this->field['min'] + 1;
            }

            //if ( is_array( $this->field['default'] ) && 1 == $this->field['handles'] ) {
            if ( is_array( $this->value ) && 1 == $this->field['handles'] ) {
                $this->value = $this->field['min'];
            }

        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 3.1.8
         */
        function enqueue() {

            $min = '';//Redux_Functions::isMin();
            wp_enqueue_style( 'select2-css' );

            wp_enqueue_style(
                'redux-nouislider-css',
                esc_url($this->extension_url . 'vendor/nouislider/redux.jquery.nouislider.css'),
                array(),
                $this->time,
                'all'
            );

            wp_register_script(
                'redux-nouislider-js',
                esc_url($this->extension_url . '/vendor/nouislider/redux.jquery.nouislider' . $min . '.js'),
                array( 'jquery' ),
                $this->time,
                true
            );

            wp_enqueue_script(
                'redux-field-slider-js',
                esc_url($this->extension_url . '/field_amp_slider' . $min . '.js'),
                array( 'jquery', 'redux-nouislider-js', 'redux-js', 'select2-js' ),
                $this->time,
                true
            );

            //if ($this->parent->args['dev_mode']) {
                wp_enqueue_style(
                    'redux-field-slider-css',
                    esc_url($this->extension_url . '/field_amp_slider.css'),
                    array(),
                    $this->time,
                    'all'
                );
            //}
        }

        //function

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 0.0.4
         */
        function render() {

            $this->clean();

            $fieldID   = $this->field['id'];
            $fieldName = $this->field['name'] . $this->field['name_suffix'];
            //$fieldName = $this->parent->args['opt_name'] . '[' . $this->field['id'] . ']';

            // Set handle number variable.
            $twoHandles = false;
            if ( 2 == $this->field['handles'] ) {
                $twoHandles = true;
            }

            // Set default values(s)
            if ( true == $twoHandles ) {
                $valOne = $this->value[0];
                $valTwo = $this->value[1];

                $html = 'data-default-one="' . $valOne . '" ';
                $html .= 'data-default-two="' . $valTwo . '" ';

                $nameOne = $fieldName . '[1]';
                $nameTwo = $fieldName . '[2]';

                $idOne = $fieldID . '[1]';
                $idTwo = $fieldID . '[2]';
            } else {
                $valOne = $this->value;
                $valTwo = '';

                $html = 'data-default-one="' . $valOne . '"';

                $nameOne = $fieldName;
                $nameTwo = '';

                $idOne = $fieldID;
                $idTwo = '';
            }

            $showInput  = false;
            $showLabel  = false;
            $showSelect = false;

            // TEXT output
            if ( $this->display_text == $this->field['display_value'] ) {
                $showInput = true;
                echo '<input type="text"
                         name="' . esc_attr($nameOne) . '"
                         id="' . esc_attr($idOne) . '"
                         value="' . esc_attr($valOne) . '"
                         class="redux-amp_slider-input redux-amp_slider-input-one-' . esc_attr($fieldID) . ' ' . esc_attr($this->field['class']) . '"/>';

            // LABEL output
            } elseif ( $this->display_label == $this->field['display_value'] ) {
                $showLabel = true;

                $labelNum = $twoHandles ? '-one' : '';

                echo '<div class="redux-amp_slider-label' . esc_attr($labelNum) . '"
                       id="redux-slider-label-one-' . esc_attr($fieldID) . '"
                       name="' . esc_attr($nameOne) . '">
                  </div>';

            // SELECT output
            } elseif ( $this->display_select == $this->field['display_value'] ) {
                $showSelect = true;

                if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
                    $select2_params = wp_json_encode( $this->field['select2'] );
                    $select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );

                    echo '<input type="hidden" class="select2_params" value="' . esc_attr($select2_params) . '">';
                }


                echo '<select class="redux-amp_slider-select-one redux-amp_slider-select-one-' . esc_attr($fieldID) . ' ' . esc_attr($this->field['class']) . '"
                          name="' . esc_attr($nameOne) . '"
                          id="' . esc_attr($idOne) . '">
                 </select>';
            }

            // DIV output
            //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo 
            '<div
                class="redux-amp_slider-container ' . esc_attr($this->field['class']) . '"
                id="' . esc_attr($fieldID) . '"
                data-id="' . esc_attr($fieldID) . '"
                data-min="' . esc_attr($this->field['min']) . '"
                data-max="' . esc_attr($this->field['max']) . '"
                data-step="' . esc_attr($this->field['step']) . '"
                data-handles="' . esc_attr($this->field['handles']) . '"
                data-display="' . esc_attr($this->field['display_value']) . '"
                data-rtl="' . esc_attr(is_rtl()) . '"
                data-forced="' . esc_attr($this->field['forced']) . '"
                data-float-mark="' . esc_attr($this->field['float_mark']) . '"
                data-resolution="' . esc_attr($this->field['resolution']) . '" ' . /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ $html . '>
            </div>';

            // Double slider output
            if ( true == $twoHandles ) {

                // TEXT
                if ( true == $showInput ) {
                    echo '<input type="text"
                             name="' . esc_attr($nameTwo) . '"
                             id="' . esc_attr($idTwo) . '"
                             value="' . esc_attr($valTwo) . '"
                             class="redux-amp_slider-input redux-amp_slider-input-two-' . esc_attr($fieldID) . ' ' . esc_attr($this->field['class']) . '"/>';
                }

                // LABEL
                if ( true == $showLabel ) {
                    echo '<div class="redux-amp_slider-label-two"
                           id="redux-amp_slider-label-two-' . esc_attr($fieldID) . '"
                           name="' . esc_attr($nameTwo) . '">
                      </div>';
                }

                // SELECT
                if ( true == $showSelect ) {
                    echo '<select class="redux-amp_slider-select-two redux-amp_slider-select-two-' . esc_attr($fieldID) . ' ' . esc_attr($this->field['class']) . '"
                              name="' . esc_attr($nameTwo) . '"
                              id="' . esc_attr($idTwo) . '">
                     </select>';

                }
            }

            // NO output (input hidden)
            if ( $this->display_none == $this->field['display_value'] || $this->display_label == $this->field['display_value'] ) {
                echo '<input type="hidden"
                         class="redux-slider-value-one-' . esc_attr($fieldID) . ' ' . esc_attr($this->field['class']) . '"
                         name="' . esc_attr($nameOne) . '"
                         id="' . esc_attr($idOne) . '"
                         value="' . esc_attr($valOne) . '"/>';

                // double slider hidden output
                if ( true == $twoHandles ) {
                    echo '<input type="hidden"
                             class="redux-slider-value-two-' . esc_attr($fieldID) . ' ' . esc_attr($this->field['class']) . '"
                             name="' . esc_attr($nameTwo) . '"
                             id="' . esc_attr($idTwo) . '"
                             value="' . esc_attr($valTwo) . '"/>';
                }
            }
        }
    }
}