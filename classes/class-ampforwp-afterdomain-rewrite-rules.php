<?php

/**
 * Class to generate the custom AMP start/end points
 *
 * @since 1.0.0
 */
class AmpforWP_Rewrite_Rules {

	/**
	 *
	 * Store list of permastructs keys
	 *
	 * @see register_extra_permastruct_hooks
	 * @since   1.0.0
	 *
	 * @var array
	 */
	protected $exclude_extra_permastructs = array(

		// Default WP Functionality.
		'category'          => true,
		'post_tag'          => true,
		'post_format'       => true,

		// WooCommerce.
		'product_variation' => true,
		'shop_order_refund' => true,

		// Visual Composer.
		'vc_grid_item'      => true,
	);

	/**
	 * Store high priority rewrite rules.
	 *
	 * @since 1.4.0
	 *
	 * @var array
	 */
	protected $top_level_rules = array();

	/**
	 * Store start pints rules like <amp>/category/slug
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $start_points = array();

	/**
	 * Store custom end pints rules.
	 *
	 * @since 1.4.0
	 *
	 * @var array
	 */
	protected $end_points = array();

	/**
	 * AMP_WP constructor.
	 *
	 * @since 1.4.0
	 */
	public function init() {

		add_action( 'init', array( $this, 'add_rewrite_rules_hooks' ), 9e4 );
	}

	/**
	 * Append hooks to when generating rewrite rules
	 *
	 * @since 1.0.0
	 */
	public static function add_rewrite_rules_hooks() {

		$this->append_post_type_archive_rules();
		$this->register_generator_hooks();
	}

	/**
	 * Add rewrite rules for post type archive pages.
	 */
	protected function append_post_type_archive_rules() {

		global $wp_rewrite;
		$post_type_archive_ep_mask = EP_ROOT; // i'm not sure!
		foreach ( get_post_types( array( '_builtin' => false ) ) as $post_type ) {
			if ( isset( $wp_rewrite->extra_rules_top[ $post_type . '/?$' ] ) ) {
				$regex = $post_type . '/?$';
				$query = $wp_rewrite->extra_rules_top[ $post_type . '/?$' ];
			} elseif ( isset( $wp_rewrite->extra_rules_top[ '/' . $post_type . '/?$' ] ) ) {
				$regex = '/' . $post_type . '/?$';
				$query = $wp_rewrite->extra_rules_top[ '/' . $post_type . '/?$' ];
			} else {
				continue;
			}

			foreach ( $this->start_points as $sp ) {
				if ( ! $sp[0] & $post_type_archive_ep_mask ) {
					continue;
				}
				if ( ! $rule = $this->post_type_archive_start_point_rule( $regex, $query, $sp ) ) {
					continue;
				}
				$wp_rewrite->extra_rules_top[ $rule[0] ] = $rule[1];
			}

			foreach ( $this->end_points as $sp ) {
				if ( ! $sp[0] & $post_type_archive_ep_mask ) {
					continue;
				}
				if ( ! $rule = $this->post_type_archive_end_point_rule( $regex, $query, $sp ) ) {
					continue;
				}
				$wp_rewrite->extra_rules_top[ $rule[0] ] = $rule[1];
			}
		}
	}

	/**
	 * @return bool
	 */
	protected function post_type_archive_start_point_rule( $regex, $query, $sp ) {
		$query = $query . '&' . $sp[2] . '=1';
		$match = $sp[1] . '/' . ltrim( $regex, '/' );

		return array( $match, $query );
	}

	/**
	 * @return bool
	 */
	protected function post_type_archive_end_point_rule( $regex, $query, $ep ) {

		$match  = trim( $regex, '/?$' ) . '/';
		$match .= $ep[1] . '/?$';
		$query  = $query . '&' . $ep[2] . '=1';

		return array( $match, $query );
	}

	protected function register_generator_hooks() {

		foreach (
			array(
				'post_rewrite_rules',
				'date_rewrite_rules',
				'root_rewrite_rules',
				'comments_rewrite_rules',
				'search_rewrite_rules',
				'author_rewrite_rules',
				'page_rewrite_rules',
				'category_rewrite_rules',
				'post_tag_rewrite_rules',
				'post_format_rewrite_rules',
			) as $hook
		) {
			add_filter( $hook, array( $this, 'generate_rewrite_rules' ), 9999 );
		}
		add_action( 'root_rewrite_rules', array( $this, 'register_extra_permastruct_hooks' ) );
		add_filter( 'rewrite_rules_array', array( $this, 'append_high_priority_rules' ) );
	}

	/**
	 * Generate Rewrite Rules for Start Point & End Point.
	 *
	 * @param array $rewrite_rules
	 *
	 * @since 1.4.0
	 * @return array
	 */
	public function generate_rewrite_rules( $rewrite_rules ) {
		$current_ep = $this->current_ep_mask();
		$results    = array();
		$vars       = array();

		/**
		 * Iterate through all WordPress rewrite rules.
		 */
		$unwanted_rewrite_rules = array( 'amp(/(.*))?/?$',
											'([^/]+)/amp(/(.*))?/?$',
											'([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/amp(/(.*))?/?$',
											'([0-9]{4})/([0-9]{1,2})/amp(/(.*))?/?$',
											'([0-9]{4})/amp(/(.*))?/?$',
											'author/([^/]+)/amp(/(.*))?/?$',
											'(.?.+?)/amp(/(.*))?/?$',
											'category/(.+?)/amp(/(.*))?/?$',
											'tag/([^/]+)/amp(/(.*))?/?$',
											'amppb-layout/([^/]+)/amp(/(.*))?/?$' 
										);
		$unwanted_rewrite_rules = apply_filters('ampforwp_remove_unwanted_rewrite_rules',$unwanted_rewrite_rules);
		foreach ($unwanted_rewrite_rules as $key => $value) {
			 unset($rewrite_rules[$value]);
		}
		foreach ( $rewrite_rules as $regex => $query ) {
			wp_parse_str( $query, $vars );
			if ( isset( $vars['feed'] ) ) { // Skip feeds regex.
				$results[ $regex ] = $query;
				continue;
			}  
			/**
			 * Generate Start Point for Current Rule.
			 */
			foreach ( $this->start_points as $ep ) {

				// Skip Duplicated Items.
				if ( preg_match( '/' . preg_quote( $ep[1] ) . '/', $query ) ) {
					continue;
				}

				if ( ! ( $ep[0] & $current_ep ) ) {
					continue;
				}

				if ( ! $rule = $this->generate_start_point_rule( $regex, $query, $ep ) ) {
					continue;
				}

				$results[ $rule[0] ] = $rule[1];
			}

			/**
			 * Generate End Point for Current Rule.
			 */
			foreach ( $this->end_points as $ep ) {

				// Skip Duplicated Items.
				if ( preg_match( '/' . preg_quote( $ep[1] ) . '/', $query ) ) {
					continue;
				}

				if ( ! ( $ep[0] & $current_ep ) ) {
					continue;
				}

				if ( ! $rule = $this->generate_end_point_rule( $regex, $query, $ep ) ) {
					continue;
				}

				if ( strstr( $regex, '(.?.+?)(?:/([0-9]+))?' ) && ! $this->numeric_permalink_structure() ) {
					$this->top_level_rules[ $rule[0] ] = $rule[1];
				} elseif ( strstr( $rule[0], '[^/]+' ) || substr( $rule[0], 0, 6 ) === '(.+?)/' || strstr( $rule[0], ']+)' ) ) {
					$results[ $rule[0] ] = $rule[1];
				} else {
					$this->top_level_rules[ $rule[0] ] = $rule[1];
				}
			}

			$results[ $regex ] = $query;
		}
		 
		//print_r($results);  
		return $results;
	}

	/**
	 * Get Endpoint Mask of Rewrite Groups
	 *
	 * To-do: add support for EP_DAY, EP_MONTH, EP_YEAR
	 * To-do: detect EP_ATTACHMENT
	 *
	 * @global  WP_Rewrite  $wp_rewrite WordPress Rewrite Component.
	 * @since   1.4.0
	 *
	 * @return  int
	 */
	protected function current_ep_mask() {

		global $wp_rewrite;
		$current_filter = current_filter();

		switch ( $current_filter ) {
			case 'post_rewrite_rules':
				$ep_mask = EP_PERMALINK;
				break;
			case 'date_rewrite_rules':
				$ep_mask = EP_DATE;
				break;
			case 'root_rewrite_rules':
				$ep_mask = EP_ROOT;
				break;
			case 'comments_rewrite_rules':
				$ep_mask = EP_COMMENTS;
				break;
			case 'search_rewrite_rules':
				$ep_mask = EP_SEARCH;
				break;
			case 'author_rewrite_rules':
				$ep_mask = EP_AUTHORS;
				break;
			case 'page_rewrite_rules':
				$ep_mask = EP_PAGES;
				break;
			case 'category_rewrite_rules':
				$ep_mask = EP_CATEGORIES;
				break;
			case 'post_tag_rewrite_rules':
				$ep_mask = EP_TAGS;
				break;
			default:
				$ep_mask = EP_NONE;
				if ( preg_match( '/(.+)_rewrite_rules$/', $current_filter, $matched ) ) {
					if ( isset( $wp_rewrite->extra_permastructs[ $matched[1] ]['ep_mask'] ) ) {
						$ep_mask = max(
							$wp_rewrite->extra_permastructs[ $matched[1] ]['ep_mask'],
							1
						);
					}
				}
		}

		return $ep_mask;
	}

	/**
	 * @param   string $regex
	 * @param   string $query
	 * @param   array  $ep
	 *
	 * @since   1.4.0
	 * @return  array
	 */
	protected function generate_start_point_rule( $regex, $query, $ep ) {

		$url_prefix = self::url_prefix();
		$epregex    = $ep[1] . '/';

		if ( $url_prefix && preg_match( "#^($url_prefix)(.+)$#", $regex, $match ) ) {
			$match = $match[1] . $epregex . ltrim( $match[2], '/' );
		} else {
			$match = $epregex . ltrim( $regex, '/' );
		}
		$query = $query . '&' . $ep[2] . '=1';

		return array( $match, $query );
	}

	/**
	 * @since   1.4.0
	 * @return  string
	 */
	protected static function url_prefix() {
		static $url_prefix;

		if ( ! isset( $url_prefix ) ) {
			$permalink_structure = get_option( 'permalink_structure' );
			$url_prefix          = substr( $permalink_structure, 0, strpos( $permalink_structure, '%' ) );
			$url_prefix          = preg_quote( ltrim( $url_prefix, '/' ), '#' );
		}

		return $url_prefix;
	}

	/**
	 * @param   string $regex
	 * @param   string $query
	 * @param   array  $ep
	 *
	 * @since   1.4.0
	 * @return  array
	 */
	public function generate_end_point_rule( $regex, $query, $ep ) {

		$query = $query . '&' . $ep[2] . '=1';
		if ( substr( $regex, - 3 ) === '/?$' ) {
			$match = substr( $regex, 0, - 3 );
		} else {
			$match = $regex;
		}

		if ( strstr( $regex, '([^/]+)(?:/([0-9]+))?' ) ) {
			list( $before, $after ) = explode( '([^/]+)(?:/([0-9]+))?', $regex );
			$match                  = $before . '([^/]+)/' . $ep[1] . '(?:/([0-9]+))?' . $after;
		} elseif ( strstr( $regex, 'page/?([0-9]{1,})' ) ) {
			list( $before, $after ) = explode( 'page/?([0-9]{1,})', $regex );
			$match                  = $before . $ep[1] . '/page/?([0-9]{1,})' . $after;
		} elseif ( strstr( $regex, '/comment-page-([0-9]{1,})' ) ) {
			list( $before, $after ) = explode( 'comment-page-([0-9]{1,})', $regex );
			$match                  = $before . $ep[1] . '/comment-page-([0-9]{1,})' . $after;
		} else {
			$match = rtrim( $match, '/' ) . '/' . $ep[1] . '/?$';
		}

		return array( $match, $query );
	}

	/**
	 * Register "{$permastructname}_rewrite_rules" Filters
	 *
	 * @param   array $rules      Root rewrite rules
	 *
	 * @global  WP_Rewrite $wp_rewrite WordPress rewrite component.
	 * @since   1.0.0
	 *
	 * @return  array
	 */
	public function register_extra_permastruct_hooks( $rules ) {

		global $wp_rewrite;

		// Remove Exclude Items From extra_permastructs
		$extra_permastruct = array_diff_key( $wp_rewrite->extra_permastructs, $this->get_exclude_extra_permastructs() );

		foreach ( $extra_permastruct as $permastructname => $struct ) {
			if ( empty( $struct['walk_dirs'] ) ) {
				continue;
			}
			if ( ! has_filter( "{$permastructname}_rewrite_rules", array( $this, 'generate_rewrite_rules' ) ) ) {
				add_filter( "{$permastructname}_rewrite_rules", array( $this, 'generate_rewrite_rules' ), 9999 );
			}
		}

		return $rules;
	}

	/**
	 * Get list of extra_permastructs to skip append startpoint
	 *
	 * @see     exclude_extra_permastructs
	 *
	 * @since   1.0.0
	 * @return  array
	 */
	public function get_exclude_extra_permastructs() {
		return $this->exclude_extra_permastructs;
	}

	/**
	 * @param   array $rules
	 *
	 * @since   1.4.0
	 * @return  array
	 */
	public function append_high_priority_rules( $rules ) {
		return array_merge( $this->top_level_rules, $rules );
	}

	/**
	 * Increase rewrite query vars preg_index index number
	 *
	 * @param   string $query
	 *
	 * @global  WP_Rewrite $wp_rewrite WordPress Rewrite Component.
	 *
	 * @since   1.4.0
	 *
	 * @return string
	 */
	protected function increase_pattern_preg_index( $query ) {

		global $wp_rewrite;

		$pattern = preg_quote( $wp_rewrite->preg_index( 'PLACEHOLDER' ) );
		$pattern = '/' . str_replace( 'PLACEHOLDER', '(\\d+)', $pattern ) . '/';
		$query   = preg_replace_callback( $pattern, array( $this, '_increase_preg_index_replace_callback' ), $query );

		return $query;
	}

	/**
	 * Callback for preg_replace_callback to
	 * Increase rewrite query vars preg_index index number
	 *
	 * @see     increase_pattern_preg_index
	 * @see     WP_Rewrite::preg_index
	 *
	 * @param   string $matched
	 *
	 * @global  WP_Rewrite $wp_rewrite WordPress Rewrite Component.
	 *
	 * @since   1.4.0
	 *
	 * @return string
	 */
	protected function _increase_preg_index_replace_callback( $matched ) {

		global $wp_rewrite;

		$index = intval( $matched[1] );

		return $wp_rewrite->preg_index( $index + 1 );
	}

	/**
	 * Set list of extra_permastructs to skip append startpoint
	 * Note: Not in use anymore
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $permastructname
	 */
	public function set_exclude_extra_permastructs( $permastructname ) {

		foreach ( (array) $permastructname as $name ) {
			$this->exclude_extra_permastructs[ $name ] = true;
		}
	}

	/**
	 * Flush exclude permastructs storage
	 * Note: Not in use anymore
	 *
	 * @since 1.0.0
	 *
	 * @return bool always true
	 */
	public function flush_exclude_extra_permastructs() {

		$this->exclude_extra_permastructs = array();

		return true;
	}

	/**
	 * Add Rewrite Rule.
	 *
	 * @param   string $name
	 * @param   int    $places
	 *
	 * @see     add_rewrite_endpoint for parameters documentation
	 *
	 * @global  WP  $wp Current WordPress environment instance.
	 *
	 * @since   1.4.0
	 */
	public function add_start_point( $name, $places ) {

		global $wp;
		$query_var            = $name;
		$this->start_points[] = array( $places, $name, $query_var );
		$wp->add_query_var( $query_var );

	} // add_start_point

	/**
	 * Add Rewrite Rule.
	 *
	 * @param   string $name
	 * @param   int    $places
	 *
	 * @see     add_rewrite_endpoint    for parameters documentation
	 *
	 * @global  WP      $wp Current WordPress environment instance.
	 *
	 * @since   1.4.0
	 */
	public function add_end_point( $name, $places ) {

		global $wp;

		$query_var          = $name;
		$this->end_points[] = array( $places, $name, $query_var );
		$wp->add_query_var( $query_var );
	} // add_end_point
	
	/**
	 * Check If a permalink structure contains any numeric rewrite tag like: %year%, %monthnum%, %day%
	 *
	 * @since 1.5.6
	 * @return bool
	 */
	protected function numeric_permalink_structure() {
		global $wp_rewrite;
		static $result;
		if ( ! isset( $result ) ) {
			$permalink_structure = str_replace( $wp_rewrite->rewritecode, $wp_rewrite->rewritereplace, get_option( 'permalink_structure' ) );
			$result              = strstr( $permalink_structure, '([0-9]' ) !== false;
		}
		return $result;
	}
}
// AmpforWP_Rewrite_Rules
$GLOBALS['ampforwp_rewrite_rules'] = new AmpforWP_Rewrite_Rules();
$GLOBALS['ampforwp_rewrite_rules']->init();

/**
 * Add a Start Point to Rewrite Rules
 *
 * @global  AmpforWP_Rewrite_Rules    $AmpforWP_Rewrite_Rules AMP WP Rewrite API
 * @param   string $name
 * @param   int    $places
 *
 * @since   1.0.0
 */
function ampforwp_add_rewrite_start_point( $name, $places ) {

	global $ampforwp_rewrite_rules;
	$ampforwp_rewrite_rules->add_start_point( $name, $places );
}

/**
 * Add a End Point to Rewrite Rules
 *
 * @global  AmpforWP_Rewrite_Rules    $AmpforWP_Rewrite_Rules AMP WP Rewrite API
 *
 * @param   string $name
 * @param   int    $places
 *
 * @since   1.4.0
 */
function ampforwp_add_rewrite_end_point( $name, $places ) {
	global $ampforwp_rewrite_rules;
	$ampforwp_rewrite_rules->add_end_point( $name, $places );
}

add_action( 'init',   'ampforwp_add_rewrite',99  );
add_action( 'init',  'ampforwp_append_index_rewrite_rule',99   );

function ampforwp_add_rewrite() {
		ampforwp_add_rewrite_start_point( AMPFORWP_AMP_QUERY_VAR, EP_ALL );
		// "Automattic AMP for WordPress" Plugin Compatibility
		$amp_query_variable = defined( 'AMP_QUERY_VAR' ) ? AMP_QUERY_VAR : AMPFORWP_AMP_QUERY_VAR;
		ampforwp_add_rewrite_end_point( $amp_query_variable, EP_ALL );
}
function ampforwp_append_index_rewrite_rule() {
		add_rewrite_rule( AMPFORWP_AMP_QUERY_VAR . '/?$', 'index.php?amp=index', 'top' );
}