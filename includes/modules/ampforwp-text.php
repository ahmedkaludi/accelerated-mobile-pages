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


		add_action( 'ampforwp_tinymce_editor', array( $this, 'editor' ), 10, 4 );


		add_action('current_screen',array($this, 'hide_editor'), 50);




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


		$text = ( ! empty( $instance['text'] ) ) ? $instance['text'] : '';

		// $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();

		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		$output = "";

		// foreach( $features as $feature ) {

		// 	$output .= '<div class="class-highlight"  >';
		// 		$output .= '<h4>'.$feature['title'].'</h4>';
							
		// 		$output .= '<p>'.$feature['text'].'</p>';
		// 	$output .= '</div>';
		// }


			$output .= '<div class="class-highlight"  >';
				$output .= '<p>'. $text .'</p>';
			$output .= '</div>';

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
		$instance['text'] = $new_instance['text']; 
		$instance['widget_id'] = $new_instance['widget_id']; 

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

		<p>

			<?php  $text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';

			do_action( 'ampforwp_tinymce_editor', $instance['text'], $this->get_field_id( 'text' ), $this->get_field_name( 'text' ), $instance['type'] );?>

			<input type="hidden" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_id( 'text' ); ?>" type="text" value="<?php echo $text; ?>" /> 
			<input type="hidden" class="widefat ampforwp-widget-editor-id" id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_id( 'widget_id' ); ?>" type="text" value="<?php echo $this->number ?>" />
		</p>

		<?php 

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions

	<?php  $text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';

		do_action( 'ampforwp_tinymce_editor', $instance['text'], $this->get_field_id( 'text' ), $this->get_field_name( 'text' ), $instance['type'] );?>
 
		<textarea type="hidden" class="widefat hide" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" cols="30" rows="10"> <?php echo $text; ?> </textarea>
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

	public function editor( $text, $editor_id, $name = '', $type = 'visual' ) {
		wp_editor( $text, $editor_id, array( 'textarea_name' => $name, 'default_editor' => $type == 'visual' ? 'tmce' : 'html' ) );
	}

	public function hide_editor() {
		$screen = get_current_screen(); 
		if( $screen->id === "widgets" ) {
			add_filter( 'user_can_richedit' , '__return_false', 50 );
		}
	}


} // end class


add_action( 'widgets_init', function(){
	register_widget( 'AMPFORWP_Text_Widget' );
});



 