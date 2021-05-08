<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_framework_get_post_pagination( $args = '' ) {

	wp_reset_postdata();
	global $page, $numpages, $multipage, $more, $redux_builder_amp;
	$next_class = $previous_class = '';
	$defaults = array(
		'before'           => '<p>' . ( '<span>'. ampforwp_translation($redux_builder_amp['amp-translator-page-text'], 'Page') .':</span>' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next page'),
		'previouspagelink' => ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous page'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	$params = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments used in retrieving page links for paginated posts.
	 * @param array $params An array of arguments for page links for paginated posts.
	 */
	$r = apply_filters( 'ampforwp_framework_get_post_pagination_args', $params );
	if ( isset($params['next_class']) ) {
		$next_class = $params['next_class'];
	}
	if ( isset($params['previous_class']) ) {
		$previous_class = $params['previous_class'];
	}
	$output = '';
	if ( $multipage ) {
		if ( 'number' == $r['next_or_number'] ) {
			$output .= $r['before'];
			for ( $i = 1; $i <= $numpages; $i++ ) {
				$link = $r['link_before'] . str_replace( '%', '<span>'.$i.'</span>', $r['pagelink'] ) . $r['link_after'];
				if ( $i != $page || ! $more && 1 == $page ) {
					$link = ampforwp_framework_get_post_paginated_link( $i ) . $link . '</a>';
				}
				/**
				 * Filters the HTML output of individual page number links.
				 * @param string $link The page number HTML output.
				 * @param int    $i    Page number for paginated posts' page links.
				 */
				$link = apply_filters( 'ampforwp_framework_get_post_pagination_link', $link, $i );

				// Use the custom links separator beginning with the second link.
				$output .= ( 1 === $i ) ? ' ' : $r['separator'];
				$output .= $link;
			}
			$output .= $r['after'];
		} elseif ( $more ) {
			$output .= $r['before'];
			$prev = $page - 1;
			if ( $prev > 0 ) {
				$link = ampforwp_framework_get_post_paginated_link( $prev, $previous_class ) . $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a>';
				$output .= apply_filters( 'ampforwp_framework_get_post_pagination_link', $link, $prev );
			}
			$next = $page + 1;
			if ( $next <= $numpages ) {
				if ( $prev ) {
					$output .= $r['separator'];
				}
				$link = ampforwp_framework_get_post_paginated_link( $next, $next_class ) . $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a>';
				$output .= apply_filters( 'ampforwp_framework_get_post_pagination_link', $link, $next );
			}
			$output .= $r['after'];
		}
	}

	/**
	 * Filters the HTML output of page links for paginated posts.
	 * @param string $output HTML output of paginated posts' page links.
	 * @param array  $args   An array of arguments.
	 */
	$html = apply_filters( 'ampforwp_framework_get_post_pagination', $output, $args );
		if ( $r['echo'] ) {
			echo ($html);
		}
		return $html;
}

/**
 * Helper function for ampforwp_framework_get_post_pagination().
 * @access private
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int $i Page number.
 * @return string Link.
 */
function ampforwp_framework_get_post_paginated_link( $i, $args = '' ) {
	global $wp_rewrite;
	$post = get_post();
	$query_args = array();
	if ( isset($args) ) {
		$class = "class='".esc_attr($args)."'";
	}
	if ( 1 == $i ) {
		$url = get_permalink();
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
			$url = add_query_arg( 'page', $i, get_permalink() );
		elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
			$url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
		else
			$url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
	}

	if ( is_preview() ) {

		if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
			$query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
			$query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
		}

		$url = get_preview_post_link( $post, $query_args, $url );
	}
	return '<a href="' . esc_url(trailingslashit( $url) ) . '?amp" ' . $class . '>';
}

add_filter('ampforwp_modify_rel_canonical','amp_paginated_post_modify_amphtml');
function amp_paginated_post_modify_amphtml($url) {
	$mob_pres_link = false;
    if(function_exists('ampforwp_mobile_redirect_preseve_link')){
      $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
    }
	if( is_single() && (false == ampforwp_get_setting('ampforwp-amp-takeover') && $mob_pres_link == false )){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			if($post_paginated_page){
				$url = get_permalink();
				$new_url = $url."$post_paginated_page/?amp";
				return esc_url($new_url);
			}
		} 
	return $url;
}

//add_action('amp_post_template_head','amp_paginated_post_modify_canonical',9);
function amp_paginated_post_modify_canonical(){
		if(is_single()){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			if($post_paginated_page){
				remove_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
				add_action('amp_post_template_head','amp_paginated_post_rel_canonical');
			}
		}
}
function amp_paginated_post_rel_canonical(){
		$post_paginated_page='';
		$new_canonical_url = '';
		global $post;
	    $current_post_id = $post->ID;
	    $new_canonical_url = get_permalink($current_post_id);
	    $new_canonical_url = trailingslashit($new_canonical_url);
		$post_paginated_page = get_query_var('page');
		if($post_paginated_page){?>
			<link rel="canonical" href="<?php echo esc_url($new_canonical_url.$post_paginated_page) ?>/" /><?php  } 
}
