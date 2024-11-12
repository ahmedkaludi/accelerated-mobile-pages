<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    if ( ! class_exists( 'Redux_Validation_no_html' ) ) {
        class Redux_Validation_no_html {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $parent, $field, $value, $current ) {
                $this->parent       = $parent;
                $this->field        = $field;
                $this->field['msg'] = ( isset( $this->field['msg'] ) ) ? $this->field['msg'] : __( 'You must not enter any HTML in this field, all HTML tags have been removed.', 'accelerated-mobile-pages' );
                $this->value        = $value;
                $this->current      = $current;

                $this->validate();
            } //function

            /**
             * Field Render Function.
             * Takes the vars and validates them
             *
             * @since ReduxFramework 1.0.0
             */
            function validate() {

                $newvalue = wp_strip_all_tags( $this->value );

                if ( $this->value != $newvalue ) {
                    $this->warning = $this->field;
                }

                $this->value = $newvalue;
            } //function
        } //class
    }