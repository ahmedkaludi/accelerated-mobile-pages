<?php
/**
* Class: To enable Infinite Scroll in AMP
* Note: For performance reasons the component will render a maximum of three documents (total) on screen at one time. This limit may be changed or removed in the future.
* Read more about it here: https://www.ampproject.org/docs/reference/components/amp-next-page 
*/
if( ! class_exists('AMPforWP_Infinite_Scroll') ) {

	class AMPforWP_Infinite_Scroll
	{
		private $paged;
		function __construct()
		{
			// Experiment meta tag
			add_action('amp_experiment_meta', array( $this, 'amp_experiment_meta') );
			// amp-next-page script
			add_filter('amp_post_template_data', array( $this , 'amp_infinite_scroll_script') );
			// amp-next-page tag
			add_action('ampforwp_loop_before_pagination', array( $this , 'amp_next_page') );
			// Next Posts Link
			add_filter('ampforwp_next_posts_link', array( $this , 'next_posts_link') , 10 , 2 );
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
			if ( get_query_var( 'paged' ) ) {
			    $this->paged = get_query_var('paged');
			} elseif ( get_query_var( 'page' ) ) {
			    $this->paged = get_query_var('page');
			} else {
			    $this->paged = 1;
			} ?>

			<amp-next-page>
			  	<script type="application/json">
			    {
			      	"pages": [{
				          "title": "",
				          "image": "",
				          "ampUrl": "<?php echo esc_url(ampforwp_url_controller(get_home_url()).'page/'.($this->paged+1)) ?>"
				        },
				        {
				          "title": "",
				          "image": "",
				          "ampUrl": "<?php echo esc_url(ampforwp_url_controller(get_home_url()).'page/'.($this->paged+2)) ?>"
				        }
				    ],
				    "hideSelectors": [
				        ".p-m-fl",
				        ".loop-pagination",
				        ".footer"
				    ]
		    	}
			  	</script>
			</amp-next-page>
		<?php }

		public function next_posts_link( $next_link , $paged ) {
			$this->paged = $paged;
			// Change the next link to paged+3
			// reason: amp-next-page will show the results for 3 pages
			$next_link = preg_replace('/'.($paged+1).'/', ($paged+3), $next_link);

			return $next_link;
		}
	}
	// Initiate the Class
	new AMPforWP_Infinite_Scroll();
}