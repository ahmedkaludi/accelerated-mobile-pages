<?php

class AMPFORWP_Blurb_Widget extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		parent::__construct(
			'ampforwp-blurb',
			__( 'AMP Blurb Module', 'accelerated-mobile-pages' ),
			array( // 
				'classname'		=>	'ampforwp-blurb',
				'description'	=>	__( 'Displays Icon, headline and description. Best for showing features.', 'accelerated-mobile-pages' )
			)
		);
 
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Add static written Jquery
		add_action( 'admin_footer', array( $this, 'footer_scritps') );


	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();


        echo $before_widget;
        
        $output .= '<div class="amp-wp-content amp_cb_module amp_cb_blurb">';
        
		if ( $title ) {
            $output .=  '<div class="amp_module_title">';
            $output .=  $title;
            $output .=  '</div>';
            }

        $output .= '<div class="flex-grid">'; 
        
		foreach( $features as $feature ) {
			$output .= '<div class="clmn">';
				if ( $feature['image'] ) {
					$output .= '<img src="'. $feature['image'] .'" height="80" width="80" alt="" />';
				} 
                $output .= '<div class="amp_cb_content">';
                $output .= '<h4>'.$feature['title'].'</h4>';
				$output .= '<p>'.$feature['description'].'</p>';
				$output .= '</div>';
			$output .= '</div>';
		}
            $output .=  '</div></div>'; // flex-grid & amp_cb_module
		$sanitizer = new AMPFORWP_Content( $output, array(), 
			apply_filters( 'ampforwp_content_sanitizers',array( 'AMP_Img_Sanitizer' => array(),'AMP_Style_Sanitizer' => array() ) ) );
		$sanitized_output 		= $sanitizer->get_amp_content();

		if( $sanitized_output ) {  
			echo $sanitized_output;
		} 

		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The new instance of values to be generated via the update.
	 * @param	array	old_instance	The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);

		foreach($new_instance['features'] as $feature){
			$feature['title'] = strip_tags($feature['title']);
			$feature['description'] = strip_tags($feature['description']);
			$feature['image'] = strip_tags($feature['image']);
		}
		$instance['features'] = $new_instance['features'];

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array) $instance
		); 

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : ''; ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>


		<?php

		$features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); ?>
		<span class="ampforwp-blurb-additional">
			<?php
		    $c = 0;
		    if ( count( $features ) > 0 ) {
		        foreach( $features as $feature ) {
		            if ( isset( $feature['title'] ) || isset( $feature['description'] ) ) { ?>
		            <div class="widget">
		            	<div class="widget-top"><div class="widget-title"><h3><?php echo $feature['title'];?><span class="in-widget-title"></span></h3></div>
		            	</div>

			            <div class="widget-inside">
							<p>
								<label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][title]'; ?>"><?php _e( 'Title:' ); ?></label>
								<input class="widefat" id="<?php echo $this->get_field_id( 'features' ) .'-'. $c.'-title'; ?>" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][title]'; ?>" type="text" value="<?php echo $feature['title']; ?>" />
								<label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][description]'; ?>"><?php _e( 'Description:' ); ?></label>

								<textarea  class="widefat" id="<?php echo $this->get_field_id( 'features' ) .'-'. $c.'-description'; ?>" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][description]'; ?>" rows="6" cols="50"><?php echo $feature['description']; ?></textarea> <span class="clear"></span>
							</p>
							<p>
								<label for="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][image]'; ?>"><?php _e( 'Image:' ); ?></label>
								<input type="button" class="select-img-<?php echo $c;?> button left" style="width:auto;" value="Select Image" onclick="ampSelectImage('<?php echo $c;?>');"/>
								<input type="button" style="display:none" name="removeimg" id="remove-img-<?php echo $c;?>" class="button button-secondary remove-img-button" data-count-type="<?php echo $c;?>"  value="Remove Image" onclick="removeImage('<?php echo $c;?>')">
								<img src="<?php echo $instance['features']["$c"]['image']  ?>" class="preview-image block-image-<?php echo $c;?>" >
								<input type="hidden" id="amp-img-field-<?php echo $c;?>" class="img<?php echo $c;?>" style="width:auto;" name="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][image]'; ?>" id="<?php echo $this->get_field_name( 'features' ) . '['.$c.'][image]';?>'" value="<?php echo $instance['features']["$c"]['image']  ?>" />
							</p>
							<p>	<a class="ampforwp-blurb-remove delete button left"><?php _e('Remove Feature','accelerated-mobile-pages')?></a> </p>
						</div>
					</div>
					<?php
		                $c = $c +1;
		            }
		        }
		    }  ?>
		</span>

		<a class="ampforwp-blurb-add button left">  <?php _e('Add Feature','accelerated-mobile-pages'); ?> </a>

		<?php 

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param		boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {

	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {

	} // end deactivate

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
        
        
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');


		wp_enqueue_script( 'ampforwp-builder-script',  plugins_url('/modules/js/amp.js' , dirname(__FILE__) ) , array( 'jquery' ), false, true );

	} // end register_admin_scripts

	public function footer_scritps() { ?>

		<style>
			.ampforwp-blurb-add:hover{
				cursor: pointer;
			}
			.ampforwp-blurb-add.button {
				margin-bottom: 10px;
			}
			.ampforwp-blurb-additional .preview-image {
				max-width:100%;
				width : 70px;
				height : 70px;
			}
            #toplevel_page_amp_options a .wp-menu-image:before{display: none}
            
            body #toplevel_page_amp_options .wp-menu-image{
                    background-image:
                        url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjMxNHB4IiBoZWlnaHQ9IjMxNXB4IiB2aWV3Qm94PSIwIDAgMzE0IDMxNSIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgIDwhLS0gR2VuZXJhdG9yOiBTa2V0Y2ggNDEgKDM1MzI2KSAtIGh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaCAtLT4KICAgIDx0aXRsZT5TaGFwZTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSIyNjA3MSIgZmlsbD0iI0ZGNEM0QyI+CiAgICAgICAgICAgIDxnIGlkPSJDYXBhXzEiPgogICAgICAgICAgICAgICAgPGcgaWQ9Il94MzJfNDAuX1Bvd2VyIj4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMTU3LjAwNywwIEM3MC4yOTIsMCAwLDcwLjI5MiAwLDE1Ny4wMDcgQzAsMjQzLjcxNSA3MC4yOTIsMzE0LjAxNCAxNTcuMDA3LDMxNC4wMTQgQzI0My43MTYsMzE0LjAxNCAzMTQuMDE0LDI0My43MTUgMzE0LjAxNCwxNTcuMDA3IEMzMTQuMDE0LDcwLjI5MiAyNDMuNzE2LDAgMTU3LjAwNywwIFogTTE1Ny4wMDcsMjgyLjYxMiBDODcuNjM0LDI4Mi42MTIgMzEuNDAyLDIyNi4zNzIgMzEuNDAyLDE1Ny4wMDcgQzMxLjQwMiw4Ny42MzQgODcuNjM0LDMxLjQwMiAxNTcuMDA3LDMxLjQwMiBDMjI2LjM3MSwzMS40MDIgMjgyLjYxMSw4Ny42MzQgMjgyLjYxMSwxNTcuMDA3IEMyODIuNjEyLDIyNi4zNzIgMjI2LjM3MiwyODIuNjEyIDE1Ny4wMDcsMjgyLjYxMiBaIE0yMDQuMTExLDE0MS4zNjggTDE2My40NzksMTQxLjUzMyBDMTU5LjEzOSwxNDEuNTUzIDE1Ny41NDQsMTM4LjYyMyAxNTkuOTA1LDEzNC45NzkgTDIwMy4zOTcsNjguMTA5IEMyMDguMTI2LDYwLjg0MSAyMDYuOTg0LDU5LjkyMiAyMDAuODYxLDY2LjA1MyBMMTA1LjMwNSwxNjEuNiBDOTkuMTcyLDE2Ny43MzIgMTAxLjIzMiwxNzIuNjc2IDEwOS45MDYsMTcyLjY0MSBMMTQyLjY3OSwxNzIuNTA4IEMxNTEuMzQ3LDE3Mi40NzIgMTU0LjU1MiwxNzguMzM1IDE0OS44MjQsMTg1LjYwNSBMMTA2LjMzNCwyNTIuNDc3IEMxMDMuOTcyLDI1Ni4xMTIgMTA0LjU0MiwyNTYuNTgxIDEwNy42MiwyNTMuNTI3IEwxNzUuOTE1LDE4NS43MTcgQzE3OC45ODgsMTgyLjY1OSAxODMuOTUsMTc3LjY4NiAxODYuOTgzLDE3NC41OTYgTDIwOC43ODgsMTUyLjQ4NSBDMjE0Ljg3NSwxNDYuMzE3IDIxMi43NzUsMTQxLjMzIDIwNC4xMTEsMTQxLjM2OCBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICAgICAgICAgIDwvZz4KICAgICAgICAgICAgPC9nPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+) !important;
    background-repeat: no-repeat;
    background-position: center;
    -webkit-background-size: 20px auto;
    background-size: 20px auto;
}
.amp_content_builder .redux-group-tab-link-a span:after {
    content: "NEW";
    color: #fff;
    font-size: 10px;
    background: #4452a7;
    padding: 4px 7px;
    border-radius: 30px;
    font-weight: normal;
    position: relative;
    top: -1px;
    left: 5px;
}
</style>
<?php }

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {

	} // end register_widget_scripts

} // end class


add_action( 'widgets_init', function(){
	register_widget( 'AMPFORWP_Blurb_Widget' );
});