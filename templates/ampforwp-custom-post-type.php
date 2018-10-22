<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$ampforwp_cpt_plugin_check = is_plugin_active( 'amp-custom-post-type/amp-custom-post-type.php' );
if ( false == $ampforwp_cpt_plugin_check ) {   
    // Get all the post types and update them in the options
    add_action('admin_init', 'ampforwp_cpt_generate_postype_new');
    if ( ! function_exists('ampforwp_cpt_generate_postype_new' ) ) { 
        function ampforwp_cpt_generate_postype_new(){
            ampforwp_cpt_post_types_new();
        }
    }

    if ( ! function_exists('ampforwp_cpt_post_types_new') ) {
        function ampforwp_cpt_post_types_new(){
            $args       = "";
            $get_post_types = "";
            $post_types   = $options = array();

            $args = array(
                'public' => true,
            );

            $get_post_types = get_post_types( $args, 'objects');
            foreach ( $get_post_types  as $post_type ) {
                $name = $post_type->name;
                $value = $post_type->label;
                if ( 'post' === $name || 'page' === $name || 'attachment' === $name || 'guest-author' === $name || 'amp-cta' === $name || 'wprss_feed_item' === $name || 'wprss_feed' === $name || 'amp-optin' === $name ) {
                    continue;
                }
                $post_types[ $name ] = $value;
            }

            $post_types = apply_filters( 'ampforwp_cpt_modify_post_types', $post_types );

            $options = get_option('ampforwp_cpt_generated_post_types');
            if ( ! is_array($post_types) ) {
                $post_types = (array) $post_types;
            }
            if ( ! is_array($options) ) {
                $options = (array) $options;
            }
                $count_current_pt = count( $post_types );
                $count_saved_pt = count( $options);

                if ( $count_current_pt > $count_saved_pt ) {
                $array_1 = (array) $post_types;
                $array_2 = (array) $options;
                }

                else {
                $array_1 = (array) $options;
                $array_2 = (array) $post_types;
                }

                if ( array_diff( $array_1, $array_2 ) ) {
                    update_option('ampforwp_cpt_generated_post_types',$post_types);
                }
        }
    }
}