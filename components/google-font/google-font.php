<?php
add_action( 'amp_post_template_css', 'ampforwp_theme_support_fonts' );
function ampforwp_theme_support_fonts(){
 global $redux_builder_amp; ?>
<?php if(1==ampforwp_get_setting('ampforwp-google-font-switch') && ( !isset($redux_builder_amp['amp_font_selector']) || $redux_builder_amp['amp_font_selector'] == 1 || empty($redux_builder_amp['amp_font_selector']) ) ) {?>
<?php
 if(!function_exists('if_levelup_has_builder') || (function_exists('if_levelup_has_builder') && !if_levelup_has_builder())  && 'Level UP'!=$theme->name){ ?>
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 300;font-display: auto;src: local('Poppins Light'), local('Poppins-Light'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Light.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 400;font-display: auto;src: local('Poppins Regular'), local('Poppins-Regular'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Regular.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 500;font-display: auto;src: local('Poppins Medium'), local('Poppins-Medium'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Medium.ttf');} 
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 600;font-display: auto;src: local('Poppins SemiBold'), local('Poppins-SemiBold'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-SemiBold.ttf'); }
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 700;font-display: auto;src: local('Poppins Bold'), local('Poppins-Bold'), url('<?php echo ampforwp_font_url(plugin_dir_url(__FILE__)) ?>fonts/Poppins-Bold.ttf'); }
<?php } // levelup condition ends ?>
<?php } ?>

body{<?php 
	$fontFamily = "font-family: 'Arial, Helvetica, sans-serif';";
if( 1==ampforwp_get_setting('ampforwp-google-font-switch')){
	$fontFamily = "font-family: 'Poppins', sans-serif;";
	if(ampforwp_get_setting('amp_font_selector') != 1 && !empty($redux_builder_amp['amp_font_selector'])){ 
		$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector']."';";
	}
}
echo $fontFamily;

?>
font-size: 16px; line-height:1.25; }
	<?php if(is_single() ) { ?>
		.cntn-wrp{
		<?php
		 $fontFamily = "font-family: 'Arial, Helvetica, sans-serif'";
		if(1==ampforwp_get_setting('ampforwp-google-font-switch')){
			 $fontFamily = "font-family: 'Poppins', sans-serif;";
			if(isset($redux_builder_amp['amp_font_selector_content_single']) && $redux_builder_amp['amp_font_selector_content_single'] != 1 && !empty($redux_builder_amp['amp_font_selector_content_single'])){ 
				$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector_content_single']."';";
			}  
		}
		echo $fontFamily;
		?>
		}
<?php
 	}

}