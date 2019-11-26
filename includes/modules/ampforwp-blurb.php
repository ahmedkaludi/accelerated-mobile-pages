<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
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
			esc_html__( 'AMP Blurb Module', 'accelerated-mobile-pages' ),
			array( // 
				'classname'		=>	'ampforwp-blurb',
				'description'	=>	esc_html__( 'Displays Icon, headline and description. Best for showing features.', 'accelerated-mobile-pages' )
			)
		);
 
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

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
        $output = "";

		extract( $args, EXTR_SKIP );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();


        echo $before_widget;
        
        $output .= '<div class="amp-wp-content amp_cb_module amp_cb_blurb">';
        
		if ( $title ) {
            $output .=  '<div class="amp_module_title"><span>';
            $output .=  esc_html( $title );
            $output .=  '</span></div>';
            }

        $output .= '<div class="flex-grid">'; 
        
		foreach( $features as $feature ) {
			$output .= '<div class="clmn">';
				if ( $feature['image'] ) {
					$output .= '<img src="'. esc_url($feature['image']) .'" height="80" width="80" alt="" />';
				} 
                $output .= '<div class="amp_cb_content">';
                $output .= '<h4>'.esc_html( $feature['title']).'</h4>';
				$output .= '<p>' .esc_html( $feature['description']).'</p>';
				$output .= '</div>';
			$output .= '</div>';
		}
            $output .=  '</div></div>'; // flex-grid & amp_cb_module
		$sanitizer = new AMPFORWP_Content( $output, array(), 
			apply_filters( 'ampforwp_content_sanitizers',array( 'AMP_Img_Sanitizer' => array(),'AMP_Style_Sanitizer' => array() ) ) );
		$sanitized_output 		= $sanitizer->get_amp_content();

		if( $sanitized_output ) {  
			echo $sanitized_output; // amphtml content, no kses
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
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>


		<?php

		$features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); ?>
		<span class="ampforwp-blurb-additional">
			<?php
		    $c = 0;
		    if ( count( $features ) > 0 ) {
		        foreach( $features as $feature ) {
		            if ( isset( $feature['title'] ) || isset( $feature['description'] ) ) { ?>
		            <div class="widget">
		            	<div class="widget-top"><div class="widget-title"><h3><?php echo esc_attr($feature['title']);?><span class="in-widget-title"></span></h3></div>
		            	</div>

			            <div class="widget-inside">
							<p>
								<label for="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][title]'; ?>"><?php esc_attr_e( 'Title:' ); ?></label>
								<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'features' )) .'-'. $c.'-title'; ?>" name="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][title]'; ?>" type="text" value="<?php echo esc_attr($feature['title']); ?>" />
								<label for="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][description]'; ?>"><?php esc_attr_e( 'Description:' ); ?></label>

								<textarea  class="widefat" id="<?php echo esc_attr($this->get_field_id( 'features' )) .'-'. $c.'-description'; ?>" name="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][description]'; ?>" rows="6" cols="50"><?php echo esc_attr($feature['description']); ?></textarea> <span class="clear"></span>
							</p>
							<p>
								<label for="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][image]'; ?>"><?php esc_attr_e( 'Image:' ); ?></label>
								<input type="button" class="select-img-<?php echo esc_attr($c);?> button left" style="width:auto;" value="Select Image" onclick="ampSelectImage('<?php echo esc_attr($c);?>');"/>
								<input type="button" style="display:none" name="removeimg" id="remove-img-<?php echo esc_attr($c);?>" class="button button-secondary remove-img-button" data-count-type="<?php echo esc_attr($c);?>"  value="Remove Image" onclick="removeImage('<?php echo esc_attr($c);?>')">
								<img src="<?php echo esc_url($instance['features']["$c"]['image'])  ?>" class="preview-image block-image-<?php echo esc_attr($c);?>" >
								<input type="hidden" id="amp-img-field-<?php echo esc_attr($c);?>" class="img<?php echo esc_attr($c);?>" style="width:auto;" name="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][image]'; ?>" id="<?php echo esc_attr($this->get_field_name( 'features' )) . '['.$c.'][image]';?>'" value="<?php echo esc_attr($instance['features']["$c"]['image'])  ?>" />
							</p>
							<p>	<a class="ampforwp-blurb-remove delete button left"><?php esc_attr_e('Remove Feature','accelerated-mobile-pages')?></a> </p>
						</div>
					</div>
					<?php
		                $c = $c +1;
		            }
		        }
		    }  ?>
		</span>

		<a class="ampforwp-blurb-add button left">  <?php esc_attr_e('Add Feature','accelerated-mobile-pages'); ?> </a>

		<?php 

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
        
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        $builder_data['amp_icon_check'] = AMPFORWP_IMAGE_DIR . '/amp-icon-check.png';
        wp_localize_script( 'ampforwp-builder-script', 'builder_script_data', $builder_data );
		wp_enqueue_script( 'ampforwp-builder-script',  plugins_url('/modules/js/amp.js' , dirname(__FILE__) ) , array( 'jquery' ), false, true );

	} // end register_admin_scripts


} // end class


add_action( 'widgets_init', 'ampforwp_register_blurb_widget' );
function ampforwp_register_blurb_widget(){
	register_widget( 'AMPFORWP_Blurb_Widget' );
}