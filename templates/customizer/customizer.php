<?php
// Customizer options:

add_action('amp_customizer_init','ampforwp_add_new_controls');

function ampforwp_add_new_controls(){

	add_action('amp_customizer_register_settings','ampforwp_customizer_settings');

	add_action('amp_customizer_register_ui','ampforwp_register_customizer_ui');
}

function ampforwp_customizer_settings( $wp_customize) {

	/* Add Settings */
	$wp_customize->add_setting(
		'fx_share[services]', /* option name */
		array(
			'default'           => fx_share_services_default(), // facebook:1,twitter:1,google_plus:1
			//	'sanitize_callback' => 'fx_share_sanitize_services',
		'transport'         => 'refresh',
			'type'              => 'option',
			'capability'        => 'manage_options',
		)
	);
	
	$wp_customize->add_setting( 'amp_customizer[header_color_2]', array(
		'type'              => 'option',
		'default'           => '#e4e4e4',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	) );
 

}

function ampforwp_register_customizer_ui( $wp_customize ) {
	
	
	/* Load custom controls */
	require_once( AMPFORWP_PLUGIN_DIR . 'templates/customizer/customizer-controls.php' );
	
		 /* Add Control for the settings. */
		 $choices = array();
		 $services = fx_share_services();
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
		 
		 // Header text color control.
			 $wp_customize->add_control(
				 new WP_Customize_Color_Control( $wp_customize, 'amp_header_color_2', array(
					 'settings'   => 'amp_customizer[header_color_2]',
					 'label'    => __( 'New thing', 'amp' ),
					 'section'  => 'amp_design',
					 'priority' => 10
				 ) )
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




	/**
	 * Functions
	**/

	/**
	 * Services
	 * list of available sharing services
	 */
	function fx_share_services(){
	
		$services = array();
	
		/* facebook */
		$services['facebook'] = array(
			'id'       => 'facebook',
			'label'    => __( 'Meta info', 'fx-share' ),
			'callback' => 'fx_share_facebook',
		);
	
		/* twitter */
		$services['twitter'] = array(
			'id'       => 'twitter',
			'label'    => __( 'Title', 'fx-share' ),
			'callback' => 'fx_share_twitter',
		);
		
			/* google+ */
			$services['google_plus'] = array(
				'id'       => 'google_plus',
				'label'    => __( 'Featured Image', 'fx-share' ),
				'callback' => 'fx_share_google_plus',
			);
				/* google+ */
			$services['whatsapp'] = array(
				'id'       => 'whatsapp',
				'label'    => __( 'The Content', 'fx-share' ),
				'callback' => 'fx_share_whatsapp',
			);
	
		return apply_filters( 'fx_share_services', $services );
	}
	
	
	/**
	 * Utility: Default Services to use in customizer default value
	 * @return string
	 */
	function fx_share_services_default(){
		$default = array();
		$services = fx_share_services();
		foreach( $services as $service ){
			$default[] = $service['id'] . ':1'; /* activate all as default. */
		}
		return apply_filters( 'fx_share_services_default', implode( ',', $default ) );
	}
	
	
	/**
	 * Share Template Tags
	 * the final function with the conditional.
	 */
	function fx_share(){
	
		/* Get the options */
		$option = get_option( 'fx_share' );
	
		/* Check Services */
		$services = fx_share_services_default();
		if( isset( $option['services'] ) ){
			$services = $option['services'];
		}
		if( ! $services ) return;
	
		/* Check Post Status */
		$current_post_status = get_post_status( get_the_ID() );
		if ( 'private' === $current_post_status ) return;
	
		/* Check Post Types */
		$current_post_type = get_post_type();
		$post_types = 'post';
		if( isset( $option['post_types'] ) ){
			$post_types = $option['post_types'];
		}
		$post_types = explode( ',', $post_types );
		if( ! $post_types || ! in_array( $current_post_type, $post_types ) ) return;
	
		/* render button */
		return apply_filters( 'fx_share', fx_share_get_buttons( $services ) );
	}
	
	
	/**
	 * Echo Share buttons HTML based on Options
	 * @param $options string formatted active services
	 */
	function fx_share_buttons( $options ){
		echo fx_share_get_buttons( $options );
	}
	
	
	/**
	 * Return Share buttons HTML based on Options
	 * @param $options string formatted active services
	 */
	function fx_share_get_buttons( $options ){
	
		/* bail if empty. */
		if( ! $options ) return;
	
		/* available services */
		$services = fx_share_services();
	
		/* var. */
		$buttons = array();
	
		/* make array */
		$options = explode( ',', $options );
	
		/* loop load */
		foreach( $options as $option ){
			$option = explode( ':', $option );
			if( isset( $option[0] ) && isset( $option[1] ) && array_key_exists( $option[0], $services ) && '1' == $option[1] ){
				$buttons[] = $option[0];
			}
		}
	
		/* bail if not found. */
		if( ! $buttons ) return;
		ob_start();
	?>
		<div class="fx-share">
			<ul>
				<?php foreach( $buttons as $button ){
					$fn_callback = $services[$button]['callback'];
				?>
					<?php if ( function_exists( $fn_callback ) ){ ?>
					<li class="fx-share-<?php echo sanitize_html_class( $button );?>">
						<?php call_user_func( $fn_callback ); ?>
					</li>
					<?php } // check callback ?>
				<?php } // end foreach ?>
			</ul>
		</div><!-- .fx-share -->
	<?php
		return ob_get_clean();
	}
	
	
	/**
	 * Facebook Share HTML
	 */
	function fx_share_facebook(){
		$base_url = 'https://www.facebook.com/sharer.php';
		$args = array(
			'u' => esc_url( get_permalink() ),
			't' => urlencode( the_title_attribute( 'echo=0' ) ),
		);
		$url = add_query_arg( $args, $base_url );
	?>
	<a class="fx-share-button fx-share-button-facebook" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow external"><span class="fx-share-text"><?php _e( 'Facebook', 'fx-share' ); ?></span></a>
	<?php
	}
	
	
	/**
	 * Twitter Share HTML
	 */
	function fx_share_twitter(){
		$base_url = 'https://twitter.com/intent/tweet';
		$args = array(
			'url'  => esc_url( get_permalink() ),
			'text' => urlencode( the_title_attribute( 'echo=0' ) ),
		);
	
		$options = get_option( 'fx_share' );
		if( isset( $options['twitter_username'] ) ){
			$username = fx_share_sanitize_twitter_username( $options['twitter_username'] );
			if( !empty( $username ) ){
				$args['via'] = urlencode( $options['twitter_username'] );
			}
		}
	
		$url = add_query_arg( $args, $base_url );
	?>
	<a class="fx-share-button fx-share-button-twitter" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow external"><span class="fx-share-text"><?php _e( 'Twitter', 'fx-share' ); ?></span></a>
	<?php
	}
	
	
	/**
	 * Google+ Share HTML
	 */
	function fx_share_google_plus(){
		$base_url = 'https://plus.google.com/share';
		$args = array(
			'url' => esc_url( get_permalink() ),
		);
		$url = add_query_arg( $args, $base_url ); ?>
			<a class="fx-share-button fx-share-button-google_plus" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow external"><span class="fx-share-text"><?php _e( 'Google+', 'fx-share' ); ?></span></a>
		<?php
	}


	
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
	
	
	add_action('ampforwp_new_script_insert','ampforwp_customizer_preview_script');

	function ampforwp_customizer_preview_script(){
		wp_enqueue_script(
				'ampforwp-customizer-preview',
				AMPFORWP_SHARE_URL . 'assets/customizer-preview.js',
				array( 'amp-customizer' ),
				false,
				true
			);
	}







	function amp_get_color_scheme_names() {
			return array(
				'light'   => __( 'Light', 'amp'),
				'dark'    => __( 'Dark', 'amp' ),
				'three'    => __( 'Three', 'amp' ),
			);
		}



?>
