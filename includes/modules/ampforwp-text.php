<?php

class AMPFORWP_Text_Widget extends WP_Widget {

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
			'ampforwp-text',
			__( 'AMPforWP Text Module', 'accelerated-mobile-pages' ),
			array( // 
				'classname'		=>	'ampforwp-text',
				'description'	=>	__( 'Pulls in the featured classes to display within the widget.', 'accelerated-mobile-pages' )
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Classes' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();

		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		$output = "";

		foreach( $features as $feature ) {

			$output .= '<div class="class-highlight"  >';
				$output .= '<h4>'.$feature['title'].'</h4>';
							
				$output .= '<p>'.$feature['description'].'</p>';
			$output .= '</div>';
		}
		$sanitizer = new AMPFORWP_Content( $output, array(), 
			apply_filters( 'ampforwp_content_sanitizers',array( 'AMP_Img_Sanitizer' => array(),'AMP_Style_Sanitizer' => array(),'AMP_Twitter_Embed_Handler' => array(),
				'AMP_YouTube_Embed_Handler' => array(),
				'AMP_Instagram_Embed_Handler' => array(),
				'AMP_Vine_Embed_Handler' => array(),
				'AMP_Facebook_Embed_Handler' => array(),
				'AMP_Gallery_Embed_Handler' => array(), ),$this->post ),
			apply_filters( 'amp_content_sanitizers', array(
				 'AMP_Style_Sanitizer' => array(),
				 'AMP_Blacklist_Sanitizer' => array(),
				/* 'AMP_Img_Sanitizer' => array(),*/
				 'AMP_Video_Sanitizer' => array(),
				 'AMP_Audio_Sanitizer' => array(),
				 'AMP_Iframe_Sanitizer' => array(
					 'add_placeholder' => true,	)), $this->post)
				 );
		$sanitized_output = $sanitizer->get_amp_content();

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
		<span class="ampforwp-text-additional">
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
							
							<p>	<a class="ampforwp-text-remove delete button left"><?php _e('Remove Feature','accelerated-mobile-pages')?></a> </p>
						</div>
					</div>
					<?php
		                $c = $c +1;
		            }
		        }
		    }  ?>
		</span>

		<a class="ampforwp-text-add button left">  <?php _e('Add Feature','accelerated-mobile-pages'); ?> </a>

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

		wp_enqueue_script( 'ampforwp-builder-script',  plugins_url('/modules/js/amp.js' , dirname(__FILE__) ) , array( 'jquery' ), false, true );

	} // end register_admin_scripts

	public function footer_scritps() { ?>

		<style>
			.ampforwp-text-add:hover{
				cursor: pointer;
			}
			.ampforwp-text-add.button {
				margin-bottom: 10px;
			}
			
		</style>


		<?php
	}

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
	register_widget( 'AMPFORWP_Text_Widget' );
});



 