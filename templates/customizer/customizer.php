<?php
// Customizer options:

add_action('amp_customizer_init','ampforwp_add_new_controls');

function ampforwp_add_new_controls(){

	add_action('amp_customizer_register_settings','ampforwp_customizer_settings');

	add_action('amp_customizer_register_ui','ampforwp_register_customizer_ui');
}

function ampforwp_customizer_settings( $wp_customize) {

	// New Color Option Created
	$wp_customize->add_setting( 'ampforwp[ampforwp_color]', array(
		'type'              => 'option',
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	) );

	// New Color Option Created
	$wp_customize->add_setting( 'ampforwp_customizer[style]', array(
		'type'              => 'option',
		'default'			=> 'three',
		'transport'         => 'postMessage'
	) );

}

function ampforwp_register_customizer_ui( $wp_customize ) {
	// Header text color control.
	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'ampforwp_header_color', array(
			'settings'   => 'ampforwp[ampforwp_color]',
			'label'    => __( 'New Control', 'amp' ),
			'section'  => 'amp_design',
			'priority' => 10
		) )
	);


	// Background color scheme
	$wp_customize->add_control( 'ampforwp_color_scheme', array(
		'settings'   => 'ampforwp_customizer[style]',
		'label'      => __( 'design Contols', 'amp' ),
		'section'    => 'amp_design',
		'type'       => 'radio',
		'priority'   => 40,
		'choices'    => new_radio_controls(),
	));

}

function new_radio_controls(){
	return array(
			'light'   => __( 'one', 'amp'),
			'dark'    => __( 'two', 'amp' ),
			'three'    => __( 'three', 'amp' ),
	);
}


	// function register_customizer_ui( $wp_customize ) {
	// 	// Header background color control.
	// 	$wp_customize->add_control(
	// 		new WP_Customize_Color_Control( $wp_customize, 'amp_header_background_color', array(
	// 			'settings'   => 'amp_customizer[header_background_color]',
	// 			'label'    => __( 'Header Background & Link Color', 'amp' ),
	// 			'section'  => 'amp_design',
	// 			'priority' => 20
	// 		) )
	// 	);

	// 	// Background color scheme
	// 	$wp_customize->add_control( 'amp_color_scheme', array(
	// 		'settings'   => 'amp_customizer[color_scheme]',
	// 		'label'      => __( 'Color Scheme', 'amp' ),
	// 		'section'    => 'amp_design',
	// 		'type'       => 'radio',
	// 		'priority'   => 30,
	// 		'choices'    => self::get_color_scheme_names(),
	// 	));
	// }

?>
