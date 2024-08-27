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
 * @subpackage  Field_Color_Gradient
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxCore\\ReduxFramework\\ReduxFramework_color_gradient' ) ) {

    /**
     * Main ReduxFramework_color_gradient class
     *
     * @since       1.0.0
     */
    class ReduxFramework_color_gradient {

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

            // No errors please
            $defaults = array(
                'from' => '',
                'to'   => ''
            );

            $this->value = wp_parse_args( $this->value, $defaults );

            echo '<div class="colorGradient"><strong>' . esc_html__( 'From ', 'accelerated-mobile-pages' ) . '</strong>&nbsp;';
            echo '<input data-id="' . esc_attr( $this->field['id'] ). '" id="' . esc_attr( $this->field['id']) . '-from" name="' . esc_attr( $this->field['name'] ). esc_attr( $this->field['name_suffix']) . '[from]' . '" value="' . esc_attr( $this->value['from'] ). '" class="redux-color redux-color-init ' . esc_attr( $this->field['class'] ). '"  type="text" data-default-color="' . esc_attr( $this->field['default']['from'] ). '" />';
            echo '<input type="hidden" class="redux-saved-color" id="' . esc_attr( $this->field['id']) . '-saved-color' . '" value="">';

            if ( ! isset( $this->field['transparent'] ) || $this->field['transparent'] !== false ) {
                $tChecked = "";

                if ( $this->value['from'] == "transparent" ) {
                    $tChecked = ' checked="checked"';
                }

                echo '<label for="' . esc_attr( $this->field['id'] ). '-from-transparency" class="color-transparency-check"><input type="checkbox" class="checkbox color-transparency ' . esc_attr( $this->field['class']) . '" id="' . esc_attr( $this->field['id']) . '-from-transparency" data-id="' . esc_attr( $this->field['id']) . '-from" value="1"' . esc_attr( $tChecked ). '> ' . esc_html__( 'Transparent', 'accelerated-mobile-pages' ) . '</label>';
            }
            echo "</div>";
            echo '<div class="colorGradient toLabel"><strong>' . esc_html__( 'To ', 'accelerated-mobile-pages' ) . '</strong>&nbsp;<input data-id="' . esc_attr( $this->field['id']) . '" id="' . esc_attr( $this->field['id'] ). '-to" name="' . esc_attr( $this->field['name']) . esc_attr( $this->field['name_suffix']) . '[to]' . '" value="' . esc_attr( $this->value['to']) . '" class="redux-color redux-color-init ' . esc_attr( $this->field['class']) . '"  type="text" data-default-color="' . esc_attr( $this->field['default']['to']) . '" />';

            if ( ! isset( $this->field['transparent'] ) || $this->field['transparent'] !== false ) {
                $tChecked = "";

                if ( $this->value['to'] == "transparent" ) {
                    $tChecked = ' checked="checked"';
                }

                echo '<label for="' . esc_attr( $this->field['id'] ). '-to-transparency" class="color-transparency-check"><input type="checkbox" class="checkbox color-transparency" id="' . esc_attr( $this->field['id'] ). '-to-transparency" data-id="' . esc_attr( $this->field['id'] ) . '-to" value="1"' . esc_attr( $tChecked ). '> ' . esc_html__( 'Transparent', 'accelerated-mobile-pages' ) . '</label>';
            }
            echo "</div>";
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
            wp_enqueue_style( 'wp-color-picker' );
            
            wp_enqueue_script(
                'redux-field-color-gradient-js',
                ReduxFramework::$_url . 'inc/fields/color_gradient/field_color_gradient' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'wp-color-picker', 'redux-js' ),
                time(),
                'all'
            );

            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style( 'redux-color-picker-css' );
                
                wp_enqueue_style(
                    'redux-field-color_gradient-css',
                    ReduxFramework::$_url . 'inc/fields/color_gradient/field_color_gradient.css',
                    array(),
                    time(),
                    'all'
                );
            }
        }
    }
}