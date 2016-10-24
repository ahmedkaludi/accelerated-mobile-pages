<?php
class AMPFORWP_Customizer_Design_Contols extends AMP_Customizer_Design_Settings {
	const NEW_COLOR_SCHEME = 'light';
	
	public static function init() {
		add_action( 'amp_customizer_init', array( __CLASS__, 'init_customizer' ) );
		add_filter( 'amp_customizer_get_settings', array( __CLASS__, 'append_settings' ) );
	}

	public static function init_customizer() {
		add_action( 'amp_customizer_register_settings', array( __CLASS__, 'register_customizer_settings' ) );
		add_action( 'amp_customizer_register_ui', array( __CLASS__, 'register_customizer_ui' ) );
		add_action( 'amp_customizer_enqueue_preview_scripts', array( __CLASS__, 'enqueue_customizer_preview_scripts' ) );
	}

	public static function register_customizer_settings( $wp_customize ) {
		// Background color scheme
		$wp_customize->add_setting( 'amp_customizer[color_scheme_new]', array(
			'type'              => 'option',
			'default'           => self::NEW_COLOR_SCHEME,
			'sanitize_callback' => array( __CLASS__ , 'sanitize_color_scheme' ),
			'transport'         => 'postMessage'
		) );
		
		/* Add Settings */
		$wp_customize->add_setting(
			'fx_share[services]', /* option name */
			array(
				'default'          => self::fx_share_services_default(), // facebook:1,twitter:1,google_plus:1
				//	'sanitize_callback' => 'fx_share_sanitize_services',
				'transport'        => 'postMessage',
				'type'             => 'option',
				'capability'       => 'manage_options',
			)
		);		
		
	}

	public function register_customizer_ui( $wp_customize ) {
	  // Background color scheme
		$wp_customize->add_control( 'amp_color_scheme_new', array(
			'settings'   => 'amp_customizer[color_scheme_new]',
			'label'      => __( 'New Control', 'amp' ),
			'section'    => 'amp_design',
			'type'       => 'radio',
			'priority'   => 30,
			'choices'    => self::get_color_scheme_names(),
		));
		
		/* Load custom controls */
		require_once( AMPFORWP_PLUGIN_DIR . 'templates/customizer/customizer-controls.php' );
		
			 /* Add Control for the settings. */
			 $choices = array();
			 $services = self::fx_share_services();
			 foreach( $services as $key => $val ){
				 $choices[$key] = $val['label'];
			 }
			 $wp_customize->add_control(
				 new fx_Share_Customize_Control_Sortable_Checkboxes(
					 $wp_customize,
					 'fx_share_services', /* control id */
					 array(
						 'section'     => 'amp_design',
						 'settings'    => 'fx_share[services]',
						 'label'       => __( 'Sharing Services', 'fx-share' ),
						 'description' => __( 'Enable and reorder sharing buttons.', 'fx-share' ),
						 'choices'     => $choices,
					 )
				 )
			 );	
	}

	public static function enqueue_customizer_preview_scripts() {
		wp_enqueue_script(
			'ampforwp-customizer-design-preview',
			plugin_dir_url( __FILE__ ) . 'assets/customizer-preview.js' ,
			array( 'amp-customizer' ),
			false,
			true
		);
	}

	public static function append_settings( $settings ) {
		$settings = wp_parse_args( $settings, array(
			'color_scheme_new' => self::NEW_COLOR_SCHEME,
		) );

		$theme_colors = self::get_colors_for_color_scheme( $settings['color_scheme'] );

		return array_merge( $settings, $theme_colors, array(
			'link_color' => $settings['header_background_color'],
		) );
	}
	
	
	
		/**
		 * Functions
		**/
	
		/**
		 * Services
		 * list of available sharing services
		 */
		public function fx_share_services(){
		
			$services = array();
		
			/* facebook */
			$services['meta_info'] = array(
				'id'       => 'meta_info',
				'label'    => __( 'Meta info', 'fx-share' ),
				'callback' => 'fx_share_meta_info',
			);
		
			/* title */
			$services['title'] = array(
				'id'       => 'title',
				'label'    => __( 'Title', 'fx-share' ),
				'callback' => 'fx_share_title',
			);
			
				/* google+ */
				$services['featured_image'] = array(
					'id'       => 'featured_image',
					'label'    => __( 'Featured Image', 'fx-share' ),
					'callback' => 'fx_share_featured_image',
				);
					/* google+ */
				$services['content'] = array(
					'id'       => 'content',
					'label'    => __( 'The Content', 'fx-share' ),
					'callback' => 'fx_share_content',
				);
		
			return apply_filters( 'fx_share_services', $services );
		}
		
		
		/**
		 * Utility: Default Services to use in customizer default value
		 * @return string
		 */
		public function fx_share_services_default(){
			$default = array();
			$services = self::fx_share_services();
			foreach( $services as $service ){
				$default[] = $service['id'] . ':1'; /* activate all as default. */
			}
			return apply_filters( 'fx_share_services_default', implode( ',', $default ) );
		}
}

// Add New Contols and Settings in Customizer
 add_action( 'amp_init', array( 'AMPFORWP_Customizer_Design_Contols', 'init' ) );


 /* Register Customizer Scripts */
 add_action( 'customize_controls_enqueue_scripts', 'fx_share_customize_register_scripts', 0 );
 define( 'AMPFORWP_SHARE_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
 
 /**
	* Register Scripts
	* so we can easily load this scripts multiple times when needed (?)
	*/
 function fx_share_customize_register_scripts(){
 
	 /* CSS */
	 wp_register_style( 'ampforwp-share-customize', AMPFORWP_SHARE_URL . 'assets/customizer-control.css' );
 
	 /* JS */
	 wp_register_script( 'ampforwp-share-customize', AMPFORWP_SHARE_URL . 'assets/customizer-control.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );
 }
