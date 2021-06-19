<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AMPFORWP_AMP_Code_Widget extends WP_Widget {
  protected $registered = false;
  protected $default_instance = array(
    'title'   => '',
    'content' => '',
  );

  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array(
      'classname'   => 'AMPFORWP_AMP_Code_Widget',
      'description' => esc_html__('You can add the AMP code in this widget which will appear in AMP Pages','accelerated-mobile-pages')
     );
    parent::__construct( 'AMPFORWP_AMP_Code_Widget', esc_html__('Custom AMP Code','accelerated-mobile-pages'), $widget_options );
  }

  public function _register_one( $number = -1 ) {
    parent::_register_one( $number );
    if ( $this->registered ) {
      return;
    }
    $this->registered = true;

    wp_add_inline_script( 'custom-html-widgets', sprintf( 'wp.customHtmlWidgets.idBases.push( %s );', wp_json_encode( $this->id_base ) ) );
    add_action( 'admin_footer-widgets.php', array( 'AMPFORWP_AMP_Code_Widget', 'render_control_template_scripts' ) );
  }


  public function widget( $args, $instance ) {
    $simulated_text_widget_instance = array_merge(
      $instance,
      array(
        'text'   => isset( $instance['content'] ) ? $instance['content'] : '',
        'filter' => false, // Because wpautop is not applied.
        'visual' => false, // Because it wasn't created in TinyMCE.
      )
    );
    unset( $simulated_text_widget_instance['content'] ); // Was moved to 'text' prop.

    /** This filter is documented in wp-includes/widgets/class-wp-widget-text.php */
    $content = apply_filters( 'widget_text', $instance['content'], $simulated_text_widget_instance, $this );

    // Adds 'noopener' relationship, without duplicating values, to all HTML A elements that have a target.
    $content = wp_targeted_link_rel( $content );
    $args['before_widget'] = preg_replace( '/(?<=\sclass=["\'])/', 'widget_text ', $args['before_widget'] );

    echo $args['before_widget'];
    echo '<div class="textwidget custom-html-widget">'; // The textwidget class is for theme styling compatibility.
    echo $content;
    echo '</div>';
    echo $args['after_widget'];
}
  
  public function form( $instance ) {
  $instance = wp_parse_args( (array) $instance, $this->default_instance );
  ?>
  <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" class="title sync-input" type="hidden" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
  <textarea id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" class="content sync-input" hidden><?php echo esc_textarea( $instance['content'] ); ?></textarea>
  <?php 
  }
  public static function render_control_template_scripts() { ?>
    <script type="text/html" id="tmpl-widget-custom-html-control-fields">
      <# var elementIdPrefix = 'el' + String( Math.random() ).replace( /\D/g, '' ) + '_' #>

      <p>
        <label for="{{ elementIdPrefix }}title"><?php esc_html_e( 'Title:' ); ?></label>
        <input id="{{ elementIdPrefix }}title" type="text" class="widefat title">
      </p>

      <p>
        <label for="{{ elementIdPrefix }}content" id="{{ elementIdPrefix }}content-label"><?php esc_html_e( 'Content:' ); ?></label>
        <textarea id="{{ elementIdPrefix }}content" class="widefat code content" rows="16" cols="20"></textarea>
      </p>

      <?php if ( ! current_user_can( 'unfiltered_html' ) ) : ?>
        <?php
        $probably_unsafe_html = array( 'script', 'iframe', 'form', 'input', 'style' );
        $allowed_html         = wp_kses_allowed_html( 'post' );
        $disallowed_html      = array_diff( $probably_unsafe_html, array_keys( $allowed_html ) );
        ?>
        <?php if ( ! empty( $disallowed_html ) ) : ?>
          <# if ( data.codeEditorDisabled ) { #>
            <p>
              <?php _e( 'Some HTML tags are not permitted, including:' ); ?>
              <code><?php echo implode( '</code>, <code>', $disallowed_html ); ?></code>
            </p>
          <# } #>
        <?php endif; ?>
      <?php endif; ?>

      <div class="code-editor-error-container"></div>
    </script>
    <?php
  }     

  public function update( $new_instance, $old_instance ) {
    $instance = array_merge( $this->default_instance, $old_instance );
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    if ( current_user_can( 'unfiltered_html' ) ) {
      $instance['content'] = $new_instance['content'];
    } else {
      $instance['content'] = wp_kses_post( $new_instance['content'] );
    }
    return $instance;
  }
}

// Register the widget.
function ampforwp_register_amp_code_widget() {
  register_widget( 'AMPFORWP_AMP_Code_Widget' );
}
add_action( 'widgets_init', 'ampforwp_register_amp_code_widget' );

?>