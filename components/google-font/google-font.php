<?php
add_action( 'amp_post_template_css', 'ampforwp_theme_support_fonts' );
function ampforwp_theme_support_fonts(){
 global $redux_builder_amp;
 $amp_font_selector = ampforwp_get_setting('amp_font_selector');
if(1==ampforwp_get_setting('ampforwp-google-font-switch') && ( $amp_font_selector==1 || empty($amp_font_selector) ) ) {?>
<?php
 if( !ampforwp_levelup_compatibility('levelup_theme_and_elementor') ){ ?>
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 300;font-display: auto;src: local('Poppins Light'), local('Poppins-Light'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Light.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 400;font-display: auto;src: local('Poppins Regular'), local('Poppins-Regular'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Regular.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 500;font-display: auto;src: local('Poppins Medium'), local('Poppins-Medium'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Medium.ttf');} 
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 600;font-display: auto;src: local('Poppins SemiBold'), local('Poppins-SemiBold'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-SemiBold.ttf'); }
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 700;font-display: auto;src: local('Poppins Bold'), local('Poppins-Bold'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Bold.ttf'); }
<?php } // levelup condition ends ?>
<?php } ?>

body{<?php 
	$fontFamily = "font-family: Arial, Helvetica, sans-serif;";
if( 1==ampforwp_get_setting('ampforwp-google-font-switch')){
	$fontFamily = "font-family: 'Poppins', sans-serif;";
	if( $amp_font_selector != 1 && !empty( $amp_font_selector )){ 
		$fontFamily = "font-family: '". $amp_font_selector ."';";
	}
}
echo sanitize_text_field($fontFamily);

?>
font-size: 16px; line-height:1.25; }
	<?php if(is_single() ) { ?>
		.cntn-wrp{
		<?php
		$amp_font_selector_content_single = ampforwp_get_setting('amp_font_selector_content_single');
		 $fontFamily = "font-family: Arial, Helvetica, sans-serif";
		if(1==ampforwp_get_setting('ampforwp-google-font-switch')){
			 $fontFamily = "font-family: 'Poppins', sans-serif;";
			if( $amp_font_selector_content_single != 1 && !empty($amp_font_selector_content_single)){
				$fontFamily = "font-family: '".$amp_font_selector_content_single."';";
			}  
		}
		echo sanitize_text_field($fontFamily);
		?>
		}
<?php
 	}

}