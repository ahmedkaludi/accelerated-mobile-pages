<?php
namespace ReduxCore\ReduxFramework;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ReduxFramework_switch' ) ) {
    class ReduxFramework_switch {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 0.0.4
         */
        function __construct( $field = array(), $value = '', $parent = ' ' ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
            $this->timestamp = '';
            if ( defined('AMPFORWP_VERSION') ) {
                $this->timestamp = AMPFORWP_VERSION;
            }
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 0.0.4
         */
        function render() {

            $cb_enabled = $cb_disabled = $class_on = $class_off = $switch_text = ''; //no errors, please
            //
            //Get selected
            if ( (int) $this->value == 1 ) {
                $cb_enabled = ' selected';
            } else {
                $cb_disabled = ' selected';
            }
            //Label ON
            $this->field['on'] = isset( $this->field['on'] ) ? $this->field['on'] : __( 'On', 'accelerated-mobile-pages' );

            //Label OFF
            $this->field['off'] = isset( $this->field['off'] ) ? $this->field['off'] : __( 'Off', 'accelerated-mobile-pages' );
            // Switch Text
            if ( isset($this->field['switch-text']) ) {
                $class_on = 'switch-text switch-text-on hide';
                $class_off = 'switch-text switch-text-off hide';
                $switch_text = '<span class="'.$class_on.'">'.$this->field['on'].'</span><span class="'.$class_off.'">'.$this->field['off'].'</span>';
            }           
            
             echo '<div class="switch-options">
                        <label class="ios7-switch">
                            <input class="switch-on-off" type="checkbox" '.($cb_enabled==' selected' ? 'checked' : '').' data-id="' . $this->field['id'] . '">
                            <span></span>
                        </label>
                    ';
            echo '<input type="hidden" class="checkbox checkbox-input ' . $this->field['class'] . '" id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" value="' . $this->value . '" />';
            echo $switch_text;
            echo '</div>';

            
            
            /* echo '<div class="switch-options">';
            echo '<label class="cb-enable' . $cb_enabled . '" data-id="' . $this->field['id'] . '"><span>' . $this->field['on'] . '</span></label>';
            echo '<label class="cb-disable' . $cb_disabled . '" data-id="' . $this->field['id'] . '"><span>' . $this->field['off'] . '</span></label>';
            echo '<input type="hidden" class="checkbox checkbox-input ' . $this->field['class'] . '" id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" value="' . $this->value . '" />';
            echo '</div>'; */
        } //function

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 0.0.4
         */
        function enqueue() {
            wp_enqueue_script(
                'redux-field-switch-js',
                ReduxFramework::$_url . 'inc/fields/switch/field_switch' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ),
                $this->timestamp, //time(),
                true
            );

            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style(
                    'redux-field-switch-css',
                    ReduxFramework::$_url . 'inc/fields/switch/field_switch.css',
                    array(),
                    $this->timestamp, //time(),
                    'all'
                );
            }
        }
    }
}