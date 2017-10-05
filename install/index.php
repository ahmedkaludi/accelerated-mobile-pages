<?php
	$config = array(
					'installer_dir' => 'install',
					'plugin_title'  => ucfirst( 'AMPforWP Installer' ),
					'start_steps' => 1,
					'total_steps' => 6,
					'installerpage' => 'ampforwptourinstaller',
					'dev_mode' => false,
					'steps' => array(
									1=>array(
									'title'=>'Welcome',
									'fields'=>array(),
									),
									2=>array(
									'title'=>'Logo Setup',
									'fields'=>array(),
									),
									3=>array(
									'title'=>'Pages Support',
									'fields'=>array(),
									),
									4=>array(
									'title'=>'Set tracking',
									'fields'=>array(),
									),
									5=>array(
									'title'=>'Select Design',
									'fields'=>array(),
									),
									6=>array(
									'title'=>'Enjoy',
									'fields'=>array(),
									),
								),
					'current_step'=>array(
								'title'=>'',
								'step_id'=>1
								)
				);
	add_action( 'admin_menu', 'ampforwp_add_admin_menu' );
	function ampforwp_add_admin_menu(){
		global $config;
		add_theme_page(
			esc_html( 'ampforwp_intaller' ), esc_html( 'ampforwp_intaller' ), 'manage_options', $config['installerpage'], 'ampforwp_installer_init' 
		);
	}
	add_action( 'admin_init', 'ampforwp_installer_init');
	function ampforwp_installer_init(){
		global $config;
		instller_admin_init();
		//add_action( 'admin_init', 'instller_admin_init');
	}
	function instller_admin_init(){
		if(isset($_GET['ampforwp_install']) && $_GET['ampforwp_install']=='1' && is_admin()){
			steps_call();
			
		}
	}
	
	
	
	function steps_call(){
		global $config;
		if ( empty( $_GET['page'] ) || $config['installerpage'] !== $_GET['page'] ) {
			return;
		}
		 if ( ob_get_length() ) {
			ob_end_clean();
		} 
		$step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) :  $config['start_steps'] ;
		$title = $config['steps'][$step]['title'];
		$config['current_step']['step_id'] = $step;
		
		
		// Use minified libraries if dev mode is turned on.
		$suffix = ( ( true == $config['dev_mode'] ) ) ? '' : '.min';
		// Enqueue styles.
		wp_enqueue_style( 'ampforwp_install', AMPFORWP_PLUGIN_DIR_URI. $config['installer_dir']. '/assets/css/merlin' . $suffix . '.css' , array( 'wp-admin' ), '0.1');
		// Enqueue javascript.
		wp_enqueue_script( 'ampforwp_install', AMPFORWP_PLUGIN_DIR_URI. $config['installer_dir']. '/assets/js/merlin' . $suffix . '.js' , array( 'jquery-core' ), '0.1' );
		
		wp_localize_script( 'ampforwp_install', 'ampforwp_install_params', array(
			'ajaxurl'      		=> admin_url( 'admin-ajax.php' ),
			'wpnonce'      		=> wp_create_nonce( 'ampforwp_install_nonce' ),
		) );
		

		ob_start();
		ampforwp_install_header(); ?>
		<div class="merlin__wrapper">

			<div class="merlin__content merlin__content--<?php echo esc_attr( strtolower( $title ) ); ?>">

				<?php
				// Content Handlers.
				$show_content = true;

				if ( ! empty( $_REQUEST['save_step'] ) && isset( $config['current_step']['steps'] ) ) {
					ampforwp_save_steps_data();
				}

				if ( $show_content ) {
					show_ampforwp_steps_body();
				} ?>

			<?php step_output_bottom_dots(); ?>

			</div>

			<?php echo sprintf( '<a class="return-to-dashboard" href="%s">%s</a>', esc_url( admin_url( '/' ) ), esc_html( 'Return to dashboard' ) ); ?>

		</div>

		<?php ampforwp_install_footer(); 
		exit;
	}
	
	function show_ampforwp_steps_body(){
		global $config;
		if($config['total_steps']==$config['current_step']['step_id']){
			call_user_func('ampforwp_finish_page');
		}else{
			if(function_exists('step'.$config['current_step']['step_id'])){
				call_user_func('step'.$config['current_step']['step_id']);
			}else{
				call_user_func('ampforwp_finish_page');
			}
		}
	}
	
	
	function step1(){
		global $config;
		$pluginName 					= ucfirst( 'AMPforWP Installer' );

		?>

		<div class="merlin__content--transition">

			<?php echo wp_kses( ampforwp_makesvg( array( 'icon' => 'welcome' ) ), ampforwp_svg_allowed_html() ); ?>
			
			<h1><?php echo esc_html( 'Welcome to AMPforWp' ); ?></h1>

			<p><?php echo esc_html( 'This wizard will set up AMP on your website, install plugin, and import content. It is optional & should take only a few minutes.' ); ?></p>
	
		</div>

		<footer class="merlin__content__footer">
			<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(), 'plugin.php' ) ? wp_get_referer() : admin_url( '/' ) ); ?>" class="merlin__button merlin__button--skip"><?php echo esc_html( 'Cancel' ); ?></a>
			
			<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next merlin__button--proceed merlin__button--colorchange"><?php echo esc_html( 'Start' ); ?></a>
			<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
		</footer>
	<?php
	}
	
	function step2(){
		global $config;
		global $redux_builder_amp;
		?>

		<div class="merlin__content--transition">

			<?php echo wp_kses( ampforwp_makesvg( array( 'icon' => 'welcome' ) ), ampforwp_svg_allowed_html() ); ?>
			<svg class="icon icon--checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
				<circle class="icon--checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="icon--checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
			</svg>
			
			<h1><?php echo esc_html( 'Setup Amp' ); ?></h1>

			<p><?php echo esc_html( 'Enable AMP options on you website.' ); ?></p>
			<a id="merlin__drawer-trigger" class="merlin__button merlin__button--knockout"><span><?php echo esc_html( 'Advance' ); ?></span><span class="chevron"></span></a>
			
		</div>
		<form action="" method="post">
			<ul class="merlin__drawer merlin__drawer--import-content">
				<li>
				<?php 
					//print_r(Redux::getSection('redux_builder_amp'));
					echo "Enable or Disable AMP on all Posts <input type='checkbox' value='1' name='amp-on-off-for-all-posts'>" 
				?>
				</li>
			</ul>
			

			<footer class="merlin__content__footer">
				<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(), 'plugin.php' ) ? wp_get_referer() : admin_url( '/' ) ); ?>" class="merlin__button merlin__button--skip"><?php echo esc_html( 'Skip' ); ?></a>
				
				<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next merlin__button--proceed merlin__button--colorchange"><?php echo esc_html( 'Next' ); ?></a>
				
				<?php /* <a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next button-next">
						<span class="merlin__button--loading__text"><?php echo esc_html( 'Proceed' ); ?></span><?php echo ampforwp_loading_spinner(); ?>
					</a> */ ?>
				<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
			</footer>
		</form>
	<?php
	}
	
	function ampforwp_loading_spinner(){
		global $config;
		$spinner =  $config['installer_dir']. '/assets/images/spinner';

		// Retrieve the spinner.
		get_template_part(  $spinner );
	}
	
	
	
	
	
	
	
	
	function ampforwp_save_steps_data(){
		global $redux_builder_amp;
		print_r($_POST);
		
	}
	
	
	
	function ampforwp_finish_page() {
		global $config;
		// Theme Name.
		$plugin_title 					= $config['plugin_title'];
		// Strings passed in from the config file.
		$strings = null;

		
		$allowed_html_array = array(
			'a' => array(
				'href' 		=> array(),
				'title' 	=> array(),
				'target' 	=> array(),
			),
		);

		update_option( 'ampforwp_installer_completed', time() ); ?>

		<div class="merlin__content--transition">

			<?php echo wp_kses( ampforwp_makesvg( array( 'icon' => 'done' ) ), ampforwp_svg_allowed_html() ); ?>
			
			<h1><?php echo esc_html( 'All done. Have fun!' ); ?></h1>

			<p><?php wp_kses(  'Your Website has been all set up for AMP. Enjoy your AMP website.','ampforwp_install' ); ?></p>

		</div>

		<footer class="merlin__content__footer merlin__content__footer--fullwidth">
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="merlin__button merlin__button--blue merlin__button--fullwidth merlin__button--popin"><?php echo esc_html( 'Let\'s Go' ); ?></a>
			
			
			<ul class="merlin__drawer merlin__drawer--extras">

				<li><?php //echo wp_kses( $link_1, $allowed_html_array ); ?></li>
				<li><?php //echo wp_kses( $link_2, $allowed_html_array ); ?></li>
				<li><?php //echo wp_kses( $link_3, $allowed_html_array ); ?></li>

			</ul>

		</footer>

	<?php
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function ampforwp_step_next_link() {
		global $config;
		$step = $config['current_step']['step_id'] + 1;

		return add_query_arg( 'step', $step );
	}
	
	function ampforwp_install_header() {
		global $config;
		
		// Get the current step.
		$current_step = strtolower( $config['steps'][$config['current_step']['step_id']]['title'] ); ?>

		<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width"/>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title><?php echo ucwords($current_step); ?></title>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_print_scripts' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="merlin__body merlin__body--<?php echo esc_attr( $current_step ); ?>">
		<?php
	}
	
	
	function ampforwp_install_footer() {
		?>	<a class="merlin--icon" target="_blank" href="https://ampforwp.com">
				<?php echo wp_kses( ampforwp_makesvg( array( 'icon' => 'merlin' ) ), ampforwp_svg_allowed_html() ); ?>
			</a>
		</body>
		<?php do_action( 'admin_footer' ); ?>
		<?php do_action( 'admin_print_footer_scripts' ); ?>
		</html>
		<?php
	}
	
	function ampforwp_makesvg( $args = array() ){
		// Make sure $args are an array.
		if ( empty( $args ) ) {
			return __( 'Please define default parameters in the form of an array.', 'ampforwp_installer' );
		}

		// Define an icon.
		if ( false === array_key_exists( 'icon', $args ) ) {
			return __( 'Please define an SVG icon filename.', 'ampforwp_installer' );
		}

		// Set defaults.
		$defaults = array(
			'icon'        => '',
			'title'       => '',
			'desc'        => '',
			'aria_hidden' => true, // Hide from screen readers.
			'fallback'    => false,
		);

		// Parse args.
		$args = wp_parse_args( $args, $defaults );

		// Set aria hidden.
		$aria_hidden = '';

		if ( true === $args['aria_hidden'] ) {
			$aria_hidden = ' aria-hidden="true"';
		}

		// Set ARIA.
		$aria_labelledby = '';

		if ( $args['title'] && $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title desc"';
		}

		// Begin SVG markup.
		$svg = '<svg class="icon icon--' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

		// If there is a title, display it.
		if ( $args['title'] ) {
			$svg .= '<title>' . esc_html( $args['title'] ) . '</title>';
		}

		// If there is a description, display it.
		if ( $args['desc'] ) {
			$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
		}

		$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';

		// Add some markup to use as a fallback for browsers that do not support SVGs.
		if ( $args['fallback'] ) {
			$svg .= '<span class="svg-fallback icon--' . esc_attr( $args['icon'] ) . '"></span>';
		}

		$svg .= '</svg>';

		return $svg;
	
	}
	
	/**
	 * Adds data attributes to the body, based on Customizer entries.
	 */
	function ampforwp_svg_allowed_html() {

		$array = array(
			'svg' => array(
				'class' => array(),
				'aria-hidden' => array(),
				'role' => array(),
			),
			'use' => array(
				'xlink:href' => array(),
			),
		);

		return $array;

	}
	
	function step_output_bottom_dots(){
		global $config;
		?>
		<ol class="dots">

			<?php for( $i = 1; $i<=$config['total_steps']; $i++ ) :

				$class_attr = '';
				$show_link = false;

				if ( $i === $config['current_step']['step_id'] ) {
					$class_attr = 'active';
				} elseif ( $config['current_step']['step_id'] >  $i) {
					$class_attr = 'done';
					$show_link = true;
				} ?>

				<li class="<?php echo esc_attr( $class_attr ); ?>">
					<a href="<?php echo esc_url( add_query_arg( 'step', $i ) ); ?>" title="<?php echo esc_attr( $config['current_step']['title'] ); ?>"></a>
				</li>

			<?php endfor; ?>

		</ol>
		<?php
	}
?>