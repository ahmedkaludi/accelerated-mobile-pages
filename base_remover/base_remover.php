<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 
// check for plugin using plugin name
$old_plugin = AMPFORWP_MAIN_PLUGIN_DIR.'amp-category-base-remover/amp-category-base-remover.php';
if ( is_plugin_active( $old_plugin ) ) {
    //plugin is activated
	deactivate_plugins($old_plugin);
	add_action( 'admin_notices', 'ampforwp_catagory_base_removal_admin_notice' );
} 

function ampforwp_catagory_base_removal_admin_notice(){
	?>
	<div class="notice notice-success is-dismissible">
        <p><?php esc_html_e( 'AMP Category Base URL Remover plugin has De-activated, <br> Category removal option is added in our core plugin <a href="#">Click here to view details</a>', 'accelerated-mobile-pages' ); ?></p>
    </div>
	<?php
}
 
add_filter( 'init', 'ampforwp_url_base_rewrite_rules', 100 );
function ampforwp_url_base_rewrite_rules(){
	global $redux_builder_amp;
	global $wp_rewrite;
	$categoryBaseRewrite = 0;
	$tagBaseRewrite = 0;
	
	if( isset($redux_builder_amp['ampforwp-category-base-removel-link']) ) {
		$categoryBaseRewrite = $redux_builder_amp['ampforwp-category-base-removel-link'];
	}
	if( isset($redux_builder_amp['ampforwp-tag-base-removal-link']) ) {
		$tagBaseRewrite = $redux_builder_amp['ampforwp-tag-base-removal-link'];
	}
	if($categoryBaseRewrite === '1'){
		add_action( 'created_category', 'amp_flush_rewrite_rules', 999 );
		add_action( 'edited_category', 'amp_flush_rewrite_rules', 999 );
		add_action( 'delete_category', 'amp_flush_rewrite_rules', 999 ); 
		add_filter( 'category_rewrite_rules', 'ampforwp_category_url_rewrite_rules');
	}elseif($categoryBaseRewrite === '0'){
		remove_action( 'created_category', 'amp_flush_rewrite_rules' , 999 );
		remove_action( 'edited_category', 'amp_flush_rewrite_rules' , 999 );
		remove_action( 'delete_category', 'amp_flush_rewrite_rules' , 999 );
		remove_filter( 'category_rewrite_rules', 'ampforwp_category_url_rewrite_rules');
		
	}
	if( $tagBaseRewrite === '1'){
		add_action( 'created_post_tag', 'amp_flush_rewrite_rules' , 999 );
		add_action( 'edited_post_tag', 'amp_flush_rewrite_rules', 999 );
		add_action( 'delete_post_tag', 'amp_flush_rewrite_rules', 999 );
		add_filter( 'post_tag_rewrite_rules', 'ampforwp_tag_url_rewrite_rules' );
	}elseif( $tagBaseRewrite === '0' ) {
		remove_action( 'created_post_tag', 'amp_flush_rewrite_rules' , 999 );
		remove_action( 'edited_post_tag', 'amp_flush_rewrite_rules', 999 );
		remove_action( 'delete_post_tag', 'amp_flush_rewrite_rules', 999 );
		remove_filter( 'post_tag_rewrite_rules', 'ampforwp_tag_url_rewrite_rules' ); 
	} 
}




function amp_flush_rewrite_rules( $hard=true ) {
	global $wp_rewrite;
    $wp_rewrite->flush_rules( $hard );
}

function ampforwp_category_url_rewrite_rules( $rewrite ) {
	global $redux_builder_amp, $wp_rewrite;
	$categoryBaseRewrite = $redux_builder_amp['ampforwp-category-base-removel-link'];
	$categories = get_categories( array( 'hide_empty' => false ) );
	if(is_array( $categories ) && ! empty( $categories ) ) {
		
		
		foreach ( $categories as $category ) {
			$category_nicename = $category->slug;
			if (  $category->parent === $category->cat_ID ) {
				$category->parent = 0;
			} elseif ( 0 !== $category->parent ) {
				$category_nicename = get_category_parents(  $category->parent, false, '/', true  ) . $category_nicename;
			}
			$category_nicename = trim($category_nicename);
			
			$rewrite[ '('.$category_nicename.')'.'/amp/?$' ] = 'index.php?amp&category_name=$matches[1]';
			$rewrite[ '('.$category_nicename.')'.'/amp/' . $wp_rewrite->pagination_base . '/?([0-9]{1,})/?$' ] = 'index.php?amp&category_name=$matches[1]&paged=$matches[2]';
		
			// Redirect support from Old Category Base
			$old_category_base = get_option( 'category_base' ) ? get_option( 'category_base' ) : 'category';
			$old_category_base = trim( $old_category_base, '/' );
			$rewrite[ $old_category_base . '/(.*)$' ] = 'index.php?category_redirect=$matches[1]';
			
		}
	}
	return $rewrite;
}

 
function ampforwp_tag_url_rewrite_rules( $rewrite ) {
	$tags = get_terms('post_tag', array('hide_empty' => false));
	if(is_array( $tags ) && ! empty( $tags ) ) {
	 	foreach ( $tags as $tag ) {
	 		$tag_nicename = trim($tag->slug);
	 		$rewrite[ '('.$tag_nicename.')'.'/amp/?$' ] = 'index.php?amp&tag=$matches[1]';
	 		$rewrite[ '('.$tag_nicename.')'.'/amp/page/?([0-9]{1,})/?$' ] = 'index.php?amp&tag=$matches[1]&paged=$matches[2]'; 
		}
	}
	
	return $rewrite;
}