<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Callbacks for adding content to an AMP template

function amp_post_template_add_title( $amp_template ) {
	$title = $amp_template->get( 'document_title' );
	$title = str_replace('&#8211;', '-', $title);
	$title = apply_filters( 'ampforwp_modify_title', $title );
	?>
	<title><?php echo esc_html( $title ); ?></title>
	<?php
}

if( (class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) ){
	if ('yoast' == ampforwp_get_setting('ampforwp-seo-selection') && ! is_singular() ){
		add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
	}
	if(false == get_theme_support( 'title-tag' )){
		add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_title' );
	}
} else {
	add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
	add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_title' );
}
function amp_post_template_add_canonical( $amp_template ) {
	
	if (function_exists('aioseo') && ((aioseo()->pro && (version_compare(AIOSEO_VERSION,'4.2.6')>=0)) || (!aioseo()->pro && (version_compare(AIOSEO_VERSION,'4.2.4')>0)))) {
		return;
	 }
	?>
	<link rel="canonical" href="<?php echo esc_url( apply_filters('ampforwp_modify_rel_url',$amp_template->get( 'canonical_url' ) ) ); ?>" />
   <?php
}
if(false==ampforwp_get_setting('hide-amp-version-from-source')){
	add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_meta_generator' );
	function amp_post_template_add_meta_generator() {
		?>
		<meta name="generator" content="AMP for WP <?php echo esc_attr(AMPFORWP_VERSION) ?>" />
	<?php
	}
}

add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_cached_link' );
function amp_post_template_add_cached_link($amp_template) {
	$design = "swift";
	if(ampforwp_get_setting("ampforwp_font_icon")=="swift-icons" && (ampforwp_get_setting('amp-design-selector')==3 || ampforwp_get_setting('amp-design-selector')==4)){
		if(ampforwp_get_setting('amp-design-selector')!=4){
			$design = "design-".ampforwp_get_setting('amp-design-selector');
		}
		$font_url = AMPFORWP_PLUGIN_DIR_URI."templates/design-manager/$design/fonts/icomoon.ttf";
	?>
		<link rel="preload" as="font" href="<?php echo esc_url($font_url); ?>" type="font/ttf" crossorigin>
	<?php
	}
	?>
	<link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
		<?php
			$thumb_id = get_post_thumbnail_id(ampforwp_get_the_ID());
			$image_size = ampforwp_get_setting('swift-featued-image-size');
			$image = wp_get_attachment_image_src( $thumb_id, $image_size );
			if($image!="" && isset($image[0]) && ampforwp_get_setting('swift-featued-image')){
				if(function_exists('_imagify_init')){
					$image[0] = esc_url($image[0]).".webp";
				}
				if(function_exists('webp_express_process_post')){
					$img_url_webp = '';
				 	$img_url = $image[0];
					if(!preg_match('/\.webp/', $img_url)){
						$config = \WebPExpress\Config::loadConfigAndFix();
						if($config['destination-folder'] == 'mingled'){
							$img_url_webp = $img_url;
						}else{
							$img_url_webp = preg_replace('/http(.*?)\/wp-content(.*?)/', 'http$1/wp-content/webp-express/webp-images$2', $img_url);
							if($config['destination-structure'] == 'doc-root'){
								$img_url_webp = preg_replace('/http(.*?)\/wp-content(.*?)/', 'http$1/wp-content/webp-express/webp-images/doc-root/wp-content$2', $img_url);
							}
						}
						$image[0] = esc_url($img_url_webp).".webp";
				    }
				}
				?>
				<link rel="preload" href="<?php echo esc_url($image[0]);?>" as="image">
			<?php } ?>
		<?php
		$scripts = $amp_template->get( 'amp_component_scripts', array() );
		foreach ( $scripts as $element => $script ) : 
			if (strpos($script, "amp-experiment") || strpos($script, "amp-dynamic-css-classes")) { 
		?>
			<link rel="preload" as="script" href="<?php echo esc_url( $script ); ?>">
		<?php } 
		endforeach; 

		// IF GOOGLE FONT EXIST.
		$font_urls = $amp_template->get( 'font_urls', array() );
		foreach ( $font_urls as $slug => $url ) : 
			if (strpos($url, "fonts.googleapis.com")) { 
		?>
			<link rel="preconnect dns-prefetch" href="https://fonts.gstatic.com/" crossorigin>
	<?php } endforeach;
}

add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_scripts' );
function amp_post_template_add_scripts( $amp_template ) {
	$scripts = $amp_template->get( 'amp_component_scripts', array() );
	$scripts = apply_filters('ampforwp_set_amp_custom_type_script',$scripts);
	foreach ( $scripts as $element => $script ) : 
		$custom_type = ($element == 'amp-mustache') ? 'template' : 'element'; ?>
		<script custom-<?php echo esc_attr( $custom_type ); ?>="<?php echo esc_attr( $element ); ?>" src="<?php echo esc_url( $script ); ?>" async></script>
	<?php endforeach; ?>
	<script src="<?php echo esc_url( $amp_template->get( 'amp_runtime_script' ) ); ?>" async></script>
	<?php
}

add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_fonts' );
function amp_post_template_add_fonts( $amp_template ) {
	$font_urls = $amp_template->get( 'font_urls', array() );
	foreach ( $font_urls as $slug => $url ) : ?>
		<link rel="stylesheet" href="<?php echo esc_url( $url ); ?>">
	<?php endforeach;
}

add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_boilerplate_css' );
function amp_post_template_add_boilerplate_css( $amp_template ) {
	?>
	<style amp-runtime></style>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<?php
}
if(ampforwp_get_setting('ampforwp-sd-switch') && !function_exists('ampforwp_with_scheme_app_output') && !function_exists('saswp_schema_markup_output') && ( ampforwp_get_setting('ampforwp-seo-selection') != "rank_math" || ! ampforwp_get_setting('ampforwp-seo-rank_math-schema')) && ! class_exists('SQ_Classes_ObjController') ):
add_action( 'amp_post_template_footer', 'AMPforWP\\AMPVendor\\amp_post_template_add_schemaorg_metadata' );
function amp_post_template_add_schemaorg_metadata( $amp_template ) {
	$metadata = $amp_template->get( 'metadata' );
	if ( empty( $metadata ) ) {
		return;
	}
	if ( isset($metadata['description']) ) {
		$metadata['description'] = str_replace("&nbsp;", "", $metadata['description']);
	}
	if ( isset($metadata['articleBody']) ) {
		$metadata['articleBody'] = str_replace("&nbsp;", "", $metadata['articleBody']);
		$metadata['articleBody'] = trim(preg_replace('/\s+/', ' ', $metadata['articleBody']));
		$metadata['articleBody'] = preg_replace('/(&lt;.+?&gt;)/', '', $metadata['articleBody']);
	}
	$seo_sel = ampforwp_get_setting('ampforwp-seo-selection');
	if( (ampforwp_get_setting('ampforwp-seo-yoast-schema') == false && ampforwp_get_setting('ampforwp-seo-selection') == 'yoast') || empty($seo_sel) ){
	?>
	<script type="application/ld+json"><?php echo wp_json_encode( $metadata, JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
	}
}
endif;

add_action( 'amp_post_template_css', 'AMPforWP\\AMPVendor\\amp_post_template_add_styles', 99 );
function amp_post_template_add_styles( $amp_template ) {
	$styles = $amp_template->get( 'post_amp_styles' );
	if ( ! empty( $styles ) ) {
		echo '/* Inline styles */' . PHP_EOL;
		foreach ( $styles as $selector => $declarations ) {
			$declarations = implode( ';', $declarations ) . ';';
			$declarations = preg_replace('/\/[*]/', '$1$2', $declarations);
			printf( '%1$s{%2$s}', $selector, $declarations );
		}
	}
}

add_action( 'amp_post_template_data', 'AMPforWP\\AMPVendor\\amp_post_template_add_analytics_script' );
function amp_post_template_add_analytics_script( $data ) {
	if ( ! empty( $data['amp_analytics'] ) ) {
		$data['amp_component_scripts']['amp-analytics'] = 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js';
	}
	return $data;
}

add_action( 'amp_post_template_footer', 'AMPforWP\\AMPVendor\\amp_post_template_add_analytics_data' );
function amp_post_template_add_analytics_data( $amp_template ) {
	$analytics_entries = $amp_template->get( 'amp_analytics' );
	if ( empty( $analytics_entries ) ) {
		return;
	}

	foreach ( $analytics_entries as $id => $analytics_entry ) {
		if ( ! isset(  $analytics_entry['attributes'], $analytics_entry['config_data'] ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( esc_html__( 'Analytics entry for %s is missing one of the following keys:  `attributes`, or `config_data` (array keys: %s)', 'accelerated-mobile-pages' ), esc_html( $id ), esc_html( implode( ', ', array_keys( $analytics_entry ) ) ) ), '0.3.2' );
			continue;
		}

		$script_element = AMP_HTML_Utils::build_tag( 'script', array(
			'type' => 'application/json',
		), wp_json_encode( $analytics_entry['config_data'] ) );

		$amp_analytics_attr = $analytics_entry['attributes'];

		echo AMP_HTML_Utils::build_tag( 'amp-analytics', $amp_analytics_attr, $script_element );
	}
}
