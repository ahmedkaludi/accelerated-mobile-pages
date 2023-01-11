<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
use AMPforWP\AMPVendor\AMP_Customizer_Design_Settings;
class AMPFORWP_Customizer_Design_Contols extends AMP_Customizer_Design_Settings {
	const NEW_COLOR_SCHEME = 'light';

	public static function init() {
		add_action( 'amp_customizer_init', array( __CLASS__, 'init_customizer' ) );
		add_filter( 'amp_customizer_get_settings', array( __CLASS__, 'append_settings' ) );
	}

	public static function init_customizer() {
		add_action( 'amp_customizer_register_settings', array( __CLASS__, 'register_customizer_settings' ) );
		add_action( 'amp_customizer_register_ui', array( __CLASS__, 'register_customizer_ui' )  );
		add_action( 'amp_customizer_enqueue_preview_scripts', array( __CLASS__, 'enqueue_customizer_preview_scripts' ) );
	}

	public static function register_customizer_settings( $wp_customize ) {

		/* Add Settings */
		$wp_customize->add_setting(
			'ampforwp_design[elements]', /* option name */
			array(
				'default'          => self::ampforwp_controls_default(),
				// 'sanitize_callback' => 'ampforwp_sanitize_controller',
				'transport'        	=> 'postMessage',
				'type'             	=> 'option',
				'capability'       	=> 'manage_options',
				'priority'			=> 10,
			)
		);

	}

	public static function register_customizer_ui( $wp_customize ) {
		/* Load custom controls */
		require_once( AMPFORWP_PLUGIN_DIR . 'templates/customizer/customizer-controls.php' );

		/* Add Control for the settings. */
		$choices = array();
		$services = self::ampforwp_controls();
	 	foreach( $services as $key => $val ){
			$choices[$key] = $val['label'];
		}
		$wp_customize->add_control(
			new AMPFORWP_Customize_Control_Sortable_Checkboxes(
				$wp_customize, 'ampforwp_controls',
				array(
					'section'     	=> 'amp_design',
					'settings'    	=> 'ampforwp_design[elements]',
					'label'       	=> esc_html__( 'Design Manager', 'accelerated-mobile-pages' ),
					'description' 	=> esc_html__( 'Enable and reorder Design Elements.', 'accelerated-mobile-pages' ),
					'choices'     	=> $choices,
					'priority'		=> 9,
				)
			)
		);
	}

	public static function enqueue_customizer_preview_scripts() {

		wp_register_script( 'ampforwp-customizer-design-preview', plugin_dir_url( __FILE__ ) . 'assets/customizer-preview.js', array( 'amp-customizer' ), false, true );
  		global $redux_builder_amp;
		$ampforwp_customizer_settings = array( 'design_type' => $redux_builder_amp['amp-design-selector'] );

		wp_localize_script( 'ampforwp-customizer-design-preview', 'ampforwp_customizer_settings', $ampforwp_customizer_settings );

		wp_enqueue_script( 'ampforwp-customizer-design-preview' );
	}

	public static function append_settings( $settings ) {
		$settings = wp_parse_args( $settings, array(
			'color_scheme_new' => self::NEW_COLOR_SCHEME,
		) );

		$theme_colors = self::get_colors_for_color_scheme( $settings['color_scheme'] );

		return array_merge( $settings, $theme_colors, array(
			'link_color' 		=> $settings['header_background_color'],
			// 'amp_design_type' 	=> $settings['ampforwp_design[amp_design_type]'],
		) );
	}

	/**
	 * Sanitize Sharing Services
	 * @since 0.1.0
	 */
	private function ampforwp_sanitize_controller( $input ){

		/* Var */
		$output = array();

		/* Get valid services */
		$valid_services = self::ampforwp_controls();
		// var_dump($valid_services);

		/* Make array */
		$services = explode( ',', $input );

		/* Bail. */
		if( ! $services ){
			return null;
		}

		/* Loop and verify */
		foreach( $services as $service ){

			/* Separate service and status */
			$service = explode( ':', $service );

			if( isset( $service[0] ) && isset( $service[1] ) ){
				if( array_key_exists( $service[0], $valid_services ) ){
					$status = $service[1] ? '1' : '0';
					$output[] = trim( $service[0] . ':' . $status );
				}
			}

		}

		return trim( esc_attr( implode( ',', $output ) ) );
	}

	/**
	 * Services
	 * list of available sharing services
	 */
	static public function ampforwp_controls(){

		$services = array();

		/* Meta info */
		$services['meta_info'] = array(
			'id'       => 'meta_info',
			'label'    => esc_html__( 'Meta info', 'accelerated-mobile-pages' ),
		);

		/* title */
		$services['title'] = array(
			'id'       => 'title',
			'label'    => esc_html__( 'Title', 'accelerated-mobile-pages' ),
		);
		/* Breadcrumbs */
		$services['bread_crumbs'] = array(
			'id'       => 'bread_crumbs',
			'label'    => esc_html__( 'Breadcrumb', 'accelerated-mobile-pages' ),
		);
		/* Featured Image */
		$services['featured_image'] = array(
			'id'       => 'featured_image',
			'label'    => esc_html__( 'Featured Image', 'accelerated-mobile-pages' ),
		);

		/* The Content */
		$services['content'] = array(
			'id'       => 'content',
			'label'    => esc_html__( 'The Content', 'accelerated-mobile-pages' ),
		);

		/* Meta Taxonomy */
		$services['meta_taxonomy'] = array(
			'id'       => 'meta_taxonomy',
			'label'    => esc_html__( 'Categories and Tags', 'accelerated-mobile-pages'),
		);

		/* Social Icons */
		$services['social_icons'] = array(
			'id'       => 'social_icons',
			'label'    => esc_html__( 'Social Icons', 'accelerated-mobile-pages' ),
		);

		/* Comments */
		$services['comments'] = array(
			'id'       => 'comments',
			'label'    => esc_html__( 'Comments', 'accelerated-mobile-pages' ),
		);

		/* Related Posts */
		$services['related_posts'] = array(
			'id'       => 'related_posts',
			'label'    => esc_html__( 'Related Posts', 'accelerated-mobile-pages' ),
		);

		return apply_filters( 'ampforwp_controls', $services );
	}


	/**
	 * Utility: Default Services to use in customizer default value
	 * @return string
	 */
	static public function ampforwp_controls_default(){
		$default = array();
		$services = self::ampforwp_controls();
		foreach( $services as $service ){
			$default[] = $service['id'] . ':1'; /* activate all as default. */
		}
		return apply_filters( 'ampforwp_controls_default', implode( ',', $default ) );
	}
}

// Add New Contols and Settings in Customizer
 // add_action( 'amp_init', array( 'AMPFORWP_Customizer_Design_Contols', 'init' ) );
 add_action( 'amp_init', function(){
	 AMPFORWP_Customizer_Design_Contols::init();
 } );

 /* Register Customizer Scripts */
 add_action( 'customize_controls_enqueue_scripts', 'ampforwp_customize_register_scripts', 0 );
 define( 'AMPFORWP_SHARE_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

 /**
	* Register Scripts
	* so we can easily load this scripts multiple times when needed (?)
	*/
 function ampforwp_customize_register_scripts(){

	 /* CSS */
	 wp_register_style( 'ampforwp-share-customize', AMPFORWP_SHARE_URL . 'assets/customizer-control.css' );

	/* JS */
	wp_register_script( 'ampforwp-share-customize', AMPFORWP_SHARE_URL . 'assets/customizer-control.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );

  	global $redux_builder_amp;
	$ampforwp_customizer_settings = array( 'design_type' => $redux_builder_amp['amp-design-selector'] );

	wp_localize_script( 'ampforwp-share-customize', 'ampforwp_customizer_settings', $ampforwp_customizer_settings );
 }
