<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Merlin WP
 * Version 1.2.2
 *
 * Dual licensed under the MIT and GPL licenses:
 * copyright Copyright (c) 2017, Merlin WP of Inventionn LLC
 * http://www.opensource.org/licenses/mit-license.php
 * Licensed GPLv3 for open source use
 *
 * Thanks to Merlin WP Team, Richard Tabor, from ThemeBeans.com for some excellent contributions!
 *
 *
 * Merlin WP
 * Better WordPress Theme Onboarding
 *
 * The following code is a derivative work from the
 * Envato WordPress Theme Setup Wizard by David Baker.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Richard Tabor, from ThemeBeans.com
 * @copyright Copyright (c) 2017, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for open source use
 */
$redux_builder_amp = (array) get_option('redux_builder_amp');
$ampLogo="";
if(isset($redux_builder_amp['opt-media']['url']) && $redux_builder_amp['opt-media']['url']!=""){
    $ampLogo = '<br/><br/><img src="'.esc_url($redux_builder_amp['opt-media']['url']).'" class="amp_install_logo_preview" />';
}
	
	$ampforwp_install_config = array(
					'installer_dir' => 'install',
					'plugin_title'  => ucfirst( 'AMPforWP Installer' ),
					'start_steps' => 1,
					'total_steps' => 6,
					'installerpage' => 'ampforwptourinstaller',
					'dev_mode' => false, 
					'steps' => array(
									1=>array(
									'title'=> esc_html__('Welcome','accelerated-mobile-pages'),
									'fields'=>'',
									'description'=>esc_html__('Welcome','This wizard will set up AMP on your website, install plugin, and import content. It is optional & should take only a few minutes.','accelerated-mobile-pages'),
									),
									2=>array(
									'title'=>esc_html__('Upload Logo','accelerated-mobile-pages'),
									'description'=>esc_html__('Recommend logo size is: 190x36','accelerated-mobile-pages'),
									'fields'=>'<li class="amp_install_center">
											    <input type="hidden" value="" class="regular-text process_custom_images" id="process_custom_images" name="opt-media" value="">

												<button type="button" class="set_custom_images merlin__button merlin__button--blue">Set Logo</button>
												'.$ampLogo.'
												</li>'
									),
									3=>array(
									'title'=>esc_html__('Select Pages','accelerated-mobile-pages'),
									'description'=>esc_html__('Where you would like to enable AMP.','accelerated-mobile-pages'),
									'fields'=>'<li class="merlin__drawer--import-content__list-item status status--pending">
												<input type="checkbox" class="checkbox" name="amp-on-off-for-all-posts" id="amp-on-posts" '.(ampforwp_get_setting('amp-on-off-for-all-posts')? 'checked': '').'>
												<label for="amp-on-posts">
												<i></i><span>Posts</span></label>
												</li>
											   <li class="merlin__drawer--import-content__list-item status">
												<input type="checkbox" name="amp-on-off-for-all-pages" class="checkbox" id="amp-on-pages" value="1" '.(ampforwp_get_setting('amp-on-off-for-all-pages')? 'checked': '').'>
											    <label for="amp-on-pages">
												<i></i><span>Pages</span></label>
												</li>
											   <li class="merlin__drawer--import-content__list-item status">
												<input type="checkbox" name="ampforwp-homepage-on-off-support" class="checkbox" id="amp-on-home" value="1" '.(ampforwp_get_setting('ampforwp-homepage-on-off-support')? 'checked': '').'>
											    <label for="amp-on-home">
												<i></i><span>Homepage</span></label>
												</li>
											   
											  <li class="merlin__drawer--import-content__list-item status">
												<input type="checkbox" name="ampforwp-archive-support" class="checkbox" id="ampforwp-archive-support" value="1" '.(ampforwp_get_setting('ampforwp-archive-support')? 'checked': '').'>
											   <label for="ampforwp-archive-support">
											   <i></i><span>Category & Tags</span></label>
												</li>
												
												',
									),
									4=>array(
									'title'=>esc_html__('Setup Analytics','accelerated-mobile-pages'),
									'description'=>esc_html__('Enter your Google Analytics Tracking code','accelerated-mobile-pages'),
									'fields'=>'<li class="amp_install_center">
                                    <input type="hidden" name="amp-analytics-select-option" value="1">
									<input type="text" name="ga-feild" id="ga-feild" value="'.(ampforwp_get_setting('ga-feild')? $redux_builder_amp['ga-feild'] : '').'">
									<label for="ga-feild"></label>
									</li>',
									),
									5=>array(
									'title'=>esc_html__('Select Design','accelerated-mobile-pages'),
									'description'=>'',
									'fields'=>'<li class="amp_install_center"><select name="amp-design-selector" id="ampforwp-design-select">
											<option value="1" '.(ampforwp_get_setting('amp-design-selector')==1? 'selected' : '').'>Design One</option>
											<option value="2" '.(ampforwp_get_setting('amp-design-selector')==2? 'selected' : '').'>Design Two</option>
											<option value="3" '.(ampforwp_get_setting('amp-design-selector')==3? 'selected' : '').'>Design Three</option>
											<option value="4" '.(ampforwp_get_setting('amp-design-selector')==4? 'selected' : '').'>Swift</option>
									</select>
 
									<div>
									<img src="'.AMPFORWP_PLUGIN_DIR_URI.'/images/design-1.png" width="150" height="200" class="amp_install_theme_preview" id="design-1" style="'.(ampforwp_get_setting('amp-design-selector')==1 ? '': 'display:none' ).'">
									<img src="'.AMPFORWP_PLUGIN_DIR_URI.'/images/design-2.png" width="150" height="200" class="amp_install_theme_preview" id="design-2" style="'.(ampforwp_get_setting('amp-design-selector')==2 ? '': 'display:none' ).'">
									<img src="'.AMPFORWP_PLUGIN_DIR_URI.'/images/design-3.png" width="150" height="200" class="amp_install_theme_preview" id="design-3" style="'.(ampforwp_get_setting('amp-design-selector')==3 ? '': 'display:none' ).'">
									<img src="'.AMPFORWP_PLUGIN_DIR_URI.'/images/swift.png" width="150" height="200" class="amp_install_theme_preview" id="design-4" style="'.(ampforwp_get_setting('amp-design-selector')==4 ? '': 'display:none' ).'">
									</div>
 									</li>',
									),
									6=>array(
									'title'=>esc_html__('Enjoy','accelerated-mobile-pages'),
									'description'=>esc_html__('Navigate to ','accelerated-mobile-pages'),
									'fields'=>'',
									),
								),
					'current_step'=>array(
								'title'=>'',
								'step_id'=>1
								)
				);
	add_action( 'admin_menu', 'ampforwp_add_admin_menu' );
	add_action( 'admin_init', 'ampforwp_installer_init');
	add_action( 'admin_footer', 'ampforwp_svg_sprite');
	add_action( 'wp_ajax_ampforwp_save_installer', 'ampforwp_save_steps_data', 10, 0 );
	function ampforwp_add_admin_menu(){
		global $ampforwp_install_config;
		ampforwp_installer_init();
	}

	function ampforwp_installer_init(){
		// Exit if the user does not have proper permissions
		if(! current_user_can( 'manage_options' ) ) {
			return ;
		}
		
		global $ampforwp_install_config;
		ampforwp_instller_admin_init();
	}

	function ampforwp_instller_admin_init(){
		if(isset($_GET['ampforwp_install'], $_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], '_wpnonce') && $_GET['ampforwp_install']=='1'){
			ampforwp_steps_call();			
		}
	}
	
	function ampforwp_steps_call(){
		global $ampforwp_install_config;
		if ( !wp_verify_nonce($_GET['_wpnonce'], '_wpnonce') || empty( $_GET['page'] ) || $ampforwp_install_config['installerpage'] !== $_GET['page'] ) {
			return;
		}
		 if ( ob_get_length() ) {
			ob_end_clean();
		} 
		$step = isset( $_GET['step'] ) ? sanitize_text_field( wp_unslash(sanitize_key( $_GET['step'] ) ) ) :  $ampforwp_install_config['start_steps'] ;
		$title = $ampforwp_install_config['steps'][$step]['title'];
		$ampforwp_install_config['current_step']['step_id'] = $step;
		
		
		// Use minified libraries if dev mode is turned on.
		$suffix = '';
		// Enqueue styles.
		wp_enqueue_style( 'ampforwp_install', esc_url(AMPFORWP_PLUGIN_DIR_URI. $ampforwp_install_config['installer_dir']. '/assets/css/merlin' . $suffix . '.css') , array( 'wp-admin' ), '0.1');
		// Enqueue javascript.
		wp_enqueue_script( 'ampforwp_install', esc_url(AMPFORWP_PLUGIN_DIR_URI. $ampforwp_install_config['installer_dir']. '/assets/js/merlin' . $suffix . '.js') , array( 'jquery-core' ), '0.1' );
		
		wp_localize_script( 'ampforwp_install', 'ampforwp_install_params', array(
			'ajaxurl'      		=> esc_url(admin_url( 'admin-ajax.php' )),
			'wpnonce'      		=> wp_create_nonce( 'ampforwp_install_nonce' ),
			'pluginurl'			=> esc_url(AMPFORWP_PLUGIN_DIR_URI),
		) );
		

		ob_start();
		ampforwp_install_header(); ?>
		<div class="merlin__wrapper">
            <div class="amp_install_wizard"><?php echo esc_html__('AMP Installation Wizard','accelerated-mobile-pages'); ?></div>
			<div class="merlin__content merlin__content--<?php echo esc_attr( strtolower( $title ) ); ?>">

				<?php
				// Content Handlers.
				$show_content = true;

				if ( $show_content ) {
					ampforwp_show_steps_body();
				} ?>

			<?php step_output_bottom_dots(); ?>

			</div>

			<?php echo sprintf( '<a class="return-to-dashboard" href="%s">%s</a>', esc_url( admin_url( 'admin.php?page=amp_options' ) ), esc_html__( 'Return to dashboard','accelerated-mobile-pages' ) ); ?>

		</div>

		<?php ampforwp_install_footer(); 
		exit;
	}
	
	function ampforwp_show_steps_body(){
		global $ampforwp_install_config;
		if($ampforwp_install_config['total_steps']==$ampforwp_install_config['current_step']['step_id']){
			call_user_func('ampforwp_finish_page');
		}else{
			if(function_exists('step'.$ampforwp_install_config['current_step']['step_id'])){
				call_user_func('step'.$ampforwp_install_config['current_step']['step_id']);
			}else{
				call_user_func('ampforwp_finish_page');
			}
		}
	}
	
	
	function step1(){
		global $ampforwp_install_config;
		$stepDetails = $ampforwp_install_config['steps'][$ampforwp_install_config['current_step']['step_id']];
		?>
		<div class="merlin__content--transition">

			<div class="amp_branding"></div>
			<svg class="icon icon--checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
				<circle class="icon--checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="icon--checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
			</svg>

			<h1><?php echo esc_html__($stepDetails['title'],'accelerated-mobile-pages'); ?></h1>

			<p><?php echo esc_html__( 'This Installation Wizard helps you to setup the necessary options for AMP. It is optional & should take only a few minutes.' ,'accelerated-mobile-pages'); ?></p>
	
		</div>

		<footer class="merlin__content__footer">
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=amp_options' ) ); ?>" class="merlin__button merlin__button--skip"><?php echo esc_html__( 'Cancel','accelerated-mobile-pages' ); ?></a>
			
			<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next merlin__button--proceed merlin__button--colorchange"><?php echo esc_html__( 'Start','accelerated-mobile-pages' ); ?></a>
			<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
		</footer>
	<?php
	}
	
	function step2(){
		global $ampforwp_install_config;
		$stepDetails = $ampforwp_install_config['steps'][$ampforwp_install_config['current_step']['step_id']];
		
		?>

		<div class="merlin__content--transition">

			<div class="amp_branding"></div>
			<svg class="icon icon--checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
				<circle class="icon--checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="icon--checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
			</svg>
			
			<h1><?php echo esc_html__($stepDetails['title'],'accelerated-mobile-pages'); ?></h1>

			<p><?php echo isset($stepDetails['description'])? esc_html__($stepDetails['description'],'accelerated-mobile-pages') : ''; ?></p>
			
		</div>
		<form action="" method="post">
			
			<ul class="merlin__drawer--import-content">
				
				<?php 
				wp_enqueue_media ();
					echo $stepDetails['fields']; // escaped above
				?>
				
			</ul>
			

			<footer class="merlin__content__footer">
				<?php ampforwp_skip_button(); ?>
				
				<a id="skip" href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--skip merlin__button--proceed"><?php echo esc_html__( 'Skip','accelerated-mobile-pages' ); ?></a>
				
				<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next button-next" data-callback="save_logo">
					<span class="merlin__button--loading__text"><?php echo esc_html__( 'Save' ,'accelerated-mobile-pages'); ?></span><?php echo ampforwp_loading_spinner(); ?>
				</a>
				
				<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
			</footer>
		</form>
	<?php
	}
	
	function step3(){
		global $ampforwp_install_config;
		$stepDetails = $ampforwp_install_config['steps'][$ampforwp_install_config['current_step']['step_id']];
		?>

		<div class="merlin__content--transition">

			<div class="amp_branding"></div>
			<svg class="icon icon--checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
				<circle class="icon--checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="icon--checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
			</svg>
			
			<h1><?php echo esc_html__($stepDetails['title'],'accelerated-mobile-pages'); ?></h1>

			<p><?php echo isset($stepDetails['description'])? esc_html__($stepDetails['description'],'accelerated-mobile-pages') : ''; ?></p>
			
			
		</div>
		<form action="" method="post">
			
			<ul class="merlin__drawer--import-content">
				<?php 
					echo $stepDetails['fields']; // escaped above
				?>
				
			</ul>
			

			<footer class="merlin__content__footer">
				<?php ampforwp_skip_button(); ?>
				
				<a id="skip" href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--skip merlin__button--proceed"><?php echo esc_html__( 'Skip','accelerated-mobile-pages' ); ?></a>
				
				<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next button-next" data-callback="save_logo">
					<span class="merlin__button--loading__text"><?php echo esc_html__( 'Save','accelerated-mobile-pages' ); ?></span><?php echo ampforwp_loading_spinner(); ?>
				</a>
				
				
				<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
			</footer>
		</form>
	<?php
	}
	
	function step4(){
		global $ampforwp_install_config;
		$stepDetails = $ampforwp_install_config['steps'][$ampforwp_install_config['current_step']['step_id']];
		?>

		<div class="merlin__content--transition">

			<div class="amp_branding"></div>
			<svg class="icon icon--checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
				<circle class="icon--checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="icon--checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
			</svg>
			
			<h1><?php echo esc_html__($stepDetails['title'],'accelerated-mobile-pages'); ?></h1>

			<p><?php echo isset($stepDetails['description'])? esc_html__($stepDetails['description'],'accelerated-mobile-pages') : ''; ?></p>
		</div>
		<form action="" method="post">
			
			<ul class="merlin__drawer--import-content">
				<li>
				<?php 
					echo $stepDetails['fields']; // escaped above
				?>
				</li>
			</ul>
			

			<footer class="merlin__content__footer">
				<?php ampforwp_skip_button(); ?>
				
				<a id="skip" href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--skip merlin__button--proceed"><?php echo esc_html__( 'Skip','accelerated-mobile-pages' ); ?></a>
				
				<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next button-next" data-callback="save_logo">
					<span class="merlin__button--loading__text"><?php echo esc_html__( 'Save','accelerated-mobile-pages' ); ?></span><?php echo ampforwp_loading_spinner(); ?>
				</a>
				
				
				<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
			</footer>
		</form>
	<?php
	}
	
	function step5(){
		global $ampforwp_install_config;
		$stepDetails = $ampforwp_install_config['steps'][$ampforwp_install_config['current_step']['step_id']];
		?>

		<div class="merlin__content--transition">

			<div class="amp_branding"></div>
			<svg class="icon icon--checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
				<circle class="icon--checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="icon--checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
			</svg>
			
			<h1><?php echo esc_html__($stepDetails['title'],'accelerated-mobile-pages'); ?></h1>

			<p><?php echo isset($stepDetails['description'])? esc_html__($stepDetails['description'],'accelerated-mobile-pages') : ''; ?></p>
			
			
			
		</div>
		<form action="" method="post">
			
			<ul class="merlin__drawer--import-content">
				<?php 
					echo $stepDetails['fields']; // escaped above
				?>
			</ul>
			

			<footer class="merlin__content__footer">
				<?php ampforwp_skip_button(); ?>
				
				<a id="skip" href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--skip merlin__button--proceed"><?php echo esc_html__( 'Skip','accelerated-mobile-pages' ); ?></a>
				
				<a href="<?php echo esc_url( ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--next button-next" data-callback="save_logo">
					<span class="merlin__button--loading__text"><?php echo esc_html__( 'Save','accelerated-mobile-pages' ); ?></span><?php echo ampforwp_loading_spinner(); ?>
				</a>
				
				<?php wp_nonce_field( 'ampforwp_install_nonce' ); ?>
			</footer>
		</form>
	<?php
	}
	
	
	
	
	
	
	
	
	
	function ampforwp_save_steps_data(){
		if(!wp_verify_nonce( $_REQUEST['wpnonce'], 'ampforwp_install_nonce' ) ) {
	        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
	        die;
	    }
		// Exit if the user does not have proper permissions
		if(! current_user_can( 'manage_options' ) ) {
			return ;
		}
		$redux_builder_amp = get_option('redux_builder_amp');
		if($redux_builder_amp!=''){
			foreach($_POST as $postKey=>$postValue){
				if($postKey=='opt-media' && $postValue!=""){
					
					$postValue = json_decode(stripcslashes($postValue),true);
					$redux_builder_amp[$postKey] = sanitize_text_field($postValue);
				}elseif(isset($redux_builder_amp[$postKey]) && $postValue!=""){
					$redux_builder_amp[$postKey] = sanitize_text_field($postValue);
				} 
			} 
		}
		update_option('redux_builder_amp',$redux_builder_amp);
		wp_send_json(
			array(
				'done' => 1,
				'message' => "Stored Successfully",
			)
		);
	}
	
	
	function ampforwp_skip_button(){
		?>
		<a href="<?php echo esc_url(  ampforwp_step_next_link() ); ?>" class="merlin__button merlin__button--skip"><?php echo esc_html__( 'Skip','accelerated-mobile-pages' ); ?></a>
		<?php
	}
	function ampforwp_finish_page() {
		global $ampforwp_install_config;
		// Theme Name.
		$plugin_title 					= $ampforwp_install_config['plugin_title'];
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

			<div class="amp_branding"></div>
			
			<h1><?php echo esc_html__( 'Setup Done. Have fun!','accelerated-mobile-pages' ); ?></h1>

			<p><?php echo wp_kses(  'Basic Setup has been done. Navigate to AMP options panel to access all the options.','ampforwp_install' ); ?></p>

		</div> 

		<footer class="merlin__content__footer merlin__content__footer--fullwidth">
			
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=amp_options' ) ); ?>" class="merlin__button merlin__button--blue merlin__button--fullwidth merlin__button--popin"><?php echo esc_html__( 'Let\'s Go','accelerated-mobile-pages' ); ?></a>
			
			
			<ul class="merlin__drawer merlin__drawer--extras">

				<li><?php //echo wp_kses( $link_1, $allowed_html_array ); ?></li>
				<li><?php //echo wp_kses( $link_2, $allowed_html_array ); ?></li>
				<li><?php //echo wp_kses( $link_3, $allowed_html_array ); ?></li>

			</ul>

		</footer>

	<?php
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function ampforwp_loading_spinner(){
		global $ampforwp_install_config;
		$spinner = esc_url(AMPFORWP_PLUGIN_DIR. $ampforwp_install_config['installer_dir']. '/assets/images/spinner.php');

		// Retrieve the spinner.
		get_template_part(  $spinner );
	}
	
	function ampforwp_svg_sprite() {
		global $ampforwp_install_config;
		// Define SVG sprite file.
		$svg = esc_url(AMPFORWP_PLUGIN_DIR. $ampforwp_install_config['installer_dir'] . '/assets/images/sprite.svg') ;

		// If it exists, include it.
		if ( file_exists( $svg ) ) {
			require_once apply_filters( 'merlin_svg_sprite', $svg );
		}
	}
	function ampforwp_step_next_link() {
		global $ampforwp_install_config;
		$step = $ampforwp_install_config['current_step']['step_id'] + 1;

		return add_query_arg( 'step', $step );
	}
	
	function ampforwp_install_header() {
		global $ampforwp_install_config;
		
		// Get the current step.
		$current_step = strtolower( $ampforwp_install_config['steps'][$ampforwp_install_config['current_step']['step_id']]['title'] ); ?>

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
		?>	 
		</body>
		<?php do_action( 'admin_footer' ); ?>
		<?php do_action( 'admin_print_footer_scripts' ); ?>
		</html>
		<?php
	}
	
	function ampforwp_makesvg( $args = array() ){
		// Make sure $args are an array.
		if ( empty( $args ) ) {
			return __( 'Please define default parameters in the form of an array.', 'accelerated-mobile-pages' );
		}

		// Define an icon.
		if ( false === array_key_exists( 'icon', $args ) ) {
			return __( 'Please define an SVG icon filename.', 'accelerated-mobile-pages' );
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
		$svg = '<svg class="icon icon--' . esc_attr( $args['icon'] ) . '"' . esc_attr($aria_hidden) . esc_attr($aria_labelledby) . ' role="img">';

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
		global $ampforwp_install_config;
		?>
		<ol class="dots">

			<?php for( $i = 1; $i<$ampforwp_install_config['total_steps']; $i++ ) :

				$class_attr = '';
				$show_link = false;

				if ( $i === $ampforwp_install_config['current_step']['step_id'] ) {
					$class_attr = 'active';
				} elseif ( $ampforwp_install_config['current_step']['step_id'] >  $i) {
					$class_attr = 'done';
					$show_link = true;
				} ?>

				<li class="<?php echo esc_attr( $class_attr ); ?>">
					<a href="<?php echo esc_url( add_query_arg( 'step', $i ) ); ?>" title="<?php echo esc_attr( $ampforwp_install_config['current_step']['title'] ); ?>"></a>
				</li>

			<?php endfor; ?>

		</ol>
		<?php
	}
?>