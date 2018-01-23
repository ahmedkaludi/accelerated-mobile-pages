<?php 
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
        $post_types   = array();

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

// Endpoint
add_filter('ampforwp_modify_rel_canonical','ampforwp_cpt_modify_rel_canonical_new');
if ( ! function_exists('ampforwp_cpt_modify_rel_canonical_new') ) {
    function ampforwp_cpt_modify_rel_canonical_new( $url ) {
        global $redux_builder_amp, $wp;
        $post_types = "";
        $current_cpt_url = "";
        if ( isset($redux_builder_amp['ampforwp-custom-type']) ) {
            $post_types = $redux_builder_amp['ampforwp-custom-type'];
        }
        // If Option "Make endpoint ?amp" is Off then return.
        if ( ! $redux_builder_amp['ampforwp-custom-type-amp-endpoint'] ) {
            return $url;
        }
        if ( is_post_type_archive( $post_types ) || is_singular( $post_types ) ) {
            $current_cpt_url = home_url( $wp->request );
            $url      = trailingslashit( $current_cpt_url ) . '?amp=1';
            return $url;
        }
        return $url;
    }
}