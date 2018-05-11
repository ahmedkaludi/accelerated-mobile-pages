<?php

// Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxFramework_theme_design_selector' ) ) {
        class ReduxFramework_theme_design_selector {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $field = array(), $value = '', $parent ) {
                $this->parent = $parent;
                $this->field  = $field;
                $this->value  = $value;
				
				if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
				}

				// Set default args for this field to avoid bad indexes. Change this to anything you use.
				$defaults = array(
					'options'           => array(),
					//'stylesheet'        => '',
					//'output'            => true,
					'enqueue'           => true,
					'enqueue_frontend'  => true
					);
				$this->field = wp_parse_args( $this->field, $defaults );
            }

            /**
             * Field Render Function.
             * Takes the vars and outputs the HTML for the field in the settings
             *
             * @since ReduxFramework 1.0.0
             */
            function render() {

                if ( ! empty( $this->field['data'] ) && empty( $this->field['options'] ) ) {
                    if ( empty( $this->field['args'] ) ) {
                        $this->field['args'] = array();
                    }
                    $this->field['options'] = $this->parent->get_wordpress_data( $this->field['data'], $this->field['args'] );
                }

                $this->field['data_class'] = ( isset( $this->field['multi_layout'] ) ) ? 'data-' . $this->field['multi_layout'] : 'data-full';

                if ( ! empty( $this->field['options'] ) ) {
                    echo '<ul class="theme_design_selector ' . $this->field['data_class'] . '">';

                    foreach ( $this->field['options'] as $k => $v ) {
						$liClass = '';
						if($this->value==$k){
							$liClass = 'active';
						}
						echo '<li class="'.$liClass.'">';
                        echo '<label for="' . $this->field['id'] . '_' . array_search( $k, array_keys( $this->field['options'] ) ) . '">';
						echo '<span class="image-wrap"><img src="'.$this->field['options_image'][$k].'"></span>';
                        echo '<input type="radio" class="radio ' . $this->field['class'] . '" id="' . $this->field['id'] . '_' . array_search( $k, array_keys( $this->field['options'] ) ) . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" value="' . $k . '" ' . checked( $this->value, $k, false ) . '/>';
                        echo ' <span>' . $v . '</span>';
                        echo '</label>';
                        echo '</li>';
                    }
                    //foreach

                    echo '</ul>';
                }
            } //function
			/**
			 * Enqueue Function.
			 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
			 *
			 * @since ReduxFramework 1.0.0
			*/
			function enqueue() {
				 wp_enqueue_style(
					'redux-field-theme-design-selector', 
					$this->extension_url . 'field_theme_design_selector.css',
					time(),
					true
				);
				wp_enqueue_script(
					'field-theme-design-selector-js',
				   $this->extension_url .'field_theme_design_selector.js',
					array('jquery', 'redux-js'),
					time(),
					true
				);
			} //function
        } //class
    }