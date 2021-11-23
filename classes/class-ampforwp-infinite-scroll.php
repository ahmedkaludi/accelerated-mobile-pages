<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
* Class: To enable Infinite Scroll in AMP
* Note: For performance reasons the component will render a maximum of three documents (total) on screen at one time. This limit may be changed or removed in the future.
* Read more about it here: https://www.ampproject.org/docs/reference/components/amp-next-page 
*/
if( ! class_exists('AMPforWP_Infinite_Scroll') ) {

	class AMPforWP_Infinite_Scroll
	{
		private $paged;
		private $is_single = false;
		private $is_loop = false;
		function __construct()
		{
			$this->is_single = true == $this->is_single() ? $this->is_single() : $this->is_single;
			$this->is_loop = true == $this->is_loop() ? $this->is_loop() : $this->is_loop;
			$this->paged = $this->paged();
			if ( $this->is_single && 'post' === get_post_type(ampforwp_get_the_ID()) ){
				// amp-next-page experiment meta tag
				add_action('amp_experiment_meta', array( $this, 'amp_experiment_meta') );
				// amp-next-page script
				add_filter('ampforwp_post_template_data', array( $this , 'amp_infinite_scroll_script') );
				// amp-next-page tag
				if ( 4 != ampforwp_get_setting('amp-design-selector') || (class_exists('AmpforwpAmpLayouts')) && 3 == ampforwp_get_setting('single-design-type') )
					add_action('ampforwp_above_related_post', array( $this , 'amp_next_page') );
				else 
					add_action('ampforwp_single_design_type_handle', array( $this , 'amp_next_page') );
			}
			if ( $this->is_loop ) {
				// amp-next-page experiment meta tag
				add_action('amp_experiment_meta', array( $this, 'amp_experiment_meta') );
				// amp-next-page script
				add_filter('ampforwp_post_template_data', array( $this , 'amp_infinite_scroll_script') );				
				// amp-next-page tag
				add_action('ampforwp_loop_before_pagination', array( $this , 'amp_next_page') );
				// Next Posts Link
				add_filter('ampforwp_next_posts_link', array( $this , 'next_posts_link') , 10 , 2 );
			}
		}
		public function is_single() {
			if ( is_single() && true == ampforwp_get_setting('ampforwp-infinite-scroll-single') ) {
				return true;
			}
			return false;
		}
		public function is_loop() {
			$script = true;
			if ( (ampforwp_is_home() || is_archive()) && (true == ampforwp_get_setting('ampforwp-infinite-scroll-home') || true == ampforwp_get_setting('ampforwp-wcp-infinite-scroll') ) ) {
				if( function_exists('is_product_category') && is_product_category() || function_exists('is_product_tag') && is_product_tag() || function_exists('is_shop') && is_shop()){
					$script = false;
				}
				$script = apply_filters('ampforwp_modify_infinite_scroll_script', $script);
				return $script;
			}
			return false;
		} 
		public function paged() {
			$paged = get_query_var( 'paged' );
			$page = get_query_var( 'page' );
			if ( $paged ) {
			    return intval($paged);
			} elseif ( $page ) {
			    return intval($page);
			} else {
			    return 1;
			}
		}
		public function amp_experiment_meta() {
			echo '<meta name="amp-experiments-opt-in" content="amp-next-page">';
		}

		public function amp_infinite_scroll_script( $data ) {
			if ( empty( $data['amp_component_scripts']['amp-next-page'] ) ) {
				$data['amp_component_scripts']['amp-next-page'] = 'https://cdn.ampproject.org/v0/amp-next-page-0.1.js';
			}
			return $data;
		}

		public function amp_next_page() { 
			$loop_link = $first_url = $first_title = $first_image = $second_url = $second_image = $second_title ='';
			$single_links = $single_titles = $single_images = $classes = $pages = array();
			if ( $this->is_loop ) {
				$loop_link 	= $this->loop_link();
				$loop_link1 = $loop_link2 = '';
				$loop_link1	= $loop_link.($this->paged+1);
				$loop_link2 = $loop_link.($this->paged+2);
				if ( true == ampforwp_get_setting('amp-core-end-point') ) {
					$loop_link1 = ampforwp_url_controller($loop_link1);
					$loop_link2 = ampforwp_url_controller($loop_link2);
				}
				$pages[] = array('title'=>'','image'=>'','ampUrl'=>$loop_link1);
				$pages[] = array('title'=>'','image'=>'','ampUrl'=>$loop_link2);
			}
			if ( $this->is_single ) {
				$pages = $this->single_post();
			}
			$classes = $this->hide();
			?>
			<amp-next-page>
			  	<script type="application/json">
			    {
			      	"pages": <?php echo json_encode($pages)?>,
				    "hideSelectors": <?php echo $classes?>
		    	}
			  	</script>
			</amp-next-page>
		<?php }
		public function single_post() {
			global $post;
			$pages = array();
			$exclude_ids = ampforwp_exclude_posts();
			$exclude_ids[] = $post->ID;
			$query_args =  array(
				'post_type'           => get_post_type(),
				'orderby'             => 'date',
				'ignore_sticky_posts' => 1,
				'paged'               => esc_attr($this->paged),
				'post__not_in' 		  => $exclude_ids,
				'has_password' => false ,
				'post_status'=> 'publish',
				'posts_per_page' => 2,
				'no_found_rows'	=> true
			  );
			if (ampforwp_get_setting('ampforwp-infinite-scroll-single') && ampforwp_get_setting('ampforwp-infinite-scroll-single-category')){
				$categories = get_the_category($post->ID);
				if ($categories) {
					$category_ids = array();
					foreach($categories as $individual_category){ 
						$category_ids[] = $individual_category->cat_ID;
					}	
					if(class_exists( 'WPSEO_Options' )){
						$primary_cat = get_post_meta(ampforwp_get_the_ID(), '_yoast_wpseo_primary_category', true);
						if (isset($primary_cat)) {
							$primary_cat = explode( " ", $primary_cat);
							$category_ids = array_intersect($category_ids,
	                       $primary_cat);
						}
					}	
				}
				$query_args['category__in'] = $category_ids;
			}
			if (ampforwp_get_setting('ampforwp-infinite-scroll-single') && ampforwp_get_setting('ampforwp-infinite-scroll-single-tag')){
				$tags = get_the_tags(ampforwp_get_the_ID());
				if ($tags) {
					$tags_ids = array();
					foreach($tags as $individual_tag){ 
						$tags_ids[] = $individual_tag->term_id;
					}
				}
				$query_args['tag__in'] = $tags_ids;
			}
			$query_args = apply_filters('ampforwp_infinite_scroll_query_args', $query_args);
			$query = new WP_Query( $query_args );
			while ($query->have_posts()) {
				$query->the_post();
				$pages[] = array('title'=>get_the_title(),'image'=>ampforwp_get_post_thumbnail('url', 'full'),'ampUrl'=>ampforwp_url_controller( get_permalink() ));
			}
			wp_reset_postdata();
			return $pages;
		}

		public function loop_link() {
			global $wp;
			$amp_url = trailingslashit(home_url($wp->request));
			if( $this->paged < 2 ) {
				$amp_url = trailingslashit($amp_url.'page');
			}
			else
				$amp_url = str_replace('/'.$this->paged, '', $amp_url);
			return $amp_url;	
		}
		public function hide() {
			$classes = array();
			$design = ampforwp_get_setting('amp-design-selector');
			if ( 1 == $design ) {
				$classes = array("#pagination",".related_posts", ".amp-wp-footer",".amp-wp-header",".f-w");
			}
			if ( 2 == $design ) {
				$classes = array("#headerwrap","#pagination","#footer",".nav_container",".related_posts",".f-w");
			}
			if ( 3 == $design ) {
				$classes = array("#headerwrap",".relatedpost",".footer_wrapper",".pagination-holder",".f-w");
			}
			if ( 4 == $design ) {
				$classes = array(".p-m-fl",".loop-pagination",".footer",".r-pf",".srp ul",".srp h3","#pagination",".h_m_w", ".f-w");
			}
			$classes = (array) apply_filters('ampforwp_infinite_scroll_exclude_items', $classes);
			return json_encode($classes);
		}
		public function next_posts_link( $next_link , $paged ) {
			// Change the next link to paged+3
			// reason: amp-next-page will show the results for 3 pages
			$next_link = preg_replace('/'.($paged+1).'/', ($paged+3), $next_link);
			//Pagination + infinite scroll creates 404 links #5167
			preg_match_all('/<a href="(.*?)"(.*?)<\/a>/', $next_link, $match);
			$url = $match[1][0];
			$headers = get_headers($url, 1);
			if(isset($headers[0]) && !stripos($headers[0], "200 OK")){
			  return;
			} 
			return $next_link;
		}
	}
	// Initiate the Class
	new AMPforWP_Infinite_Scroll();
}