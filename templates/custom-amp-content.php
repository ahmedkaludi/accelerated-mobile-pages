<?php
use AMPforWP\AMPVendor\AMP_Content;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Adding Custom meta Sanitizer to sanitize the custom content added throught tinymce post meta
add_filter( 'amp_post_template_data', 'ampforwp_custom_post_content_sanitizer', 10, 2 );

function ampforwp_custom_post_content_sanitizer( $data, $post ) {
    global $redux_builder_amp;

      if ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] === 0 ) {
          return $data;
      }

      global $post;
      $amp_current_post_id = get_the_ID();
      if ( ampforwp_is_front_page() && ampforwp_get_frontpage_id() ) {
          //Custom AMP Editor Support for WPML  #1138
           include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
           if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
            $amp_current_post_id = get_option('page_on_front');
            
           }
           else {
              $amp_current_post_id = ampforwp_get_frontpage_id();
            }
      }
      // Custom AMP Editor Support for Polylang #1779
      if ( ampforwp_polylang_front_page() ) {
        $amp_current_post_id = pll_get_post(get_option('page_on_front'));
      }
    	$amp_custom_post_content_input = get_post_meta($amp_current_post_id, 'ampforwp_custom_content_editor', true);
      $amp_custom_post_content_input = html_entity_decode($amp_custom_post_content_input);
      $amp_custom_post_content_check = get_post_meta($amp_current_post_id, 'ampforwp_custom_content_editor_checkbox', true);

      	if ( empty( $amp_custom_post_content_input ) ) {
            $data['ampforwp_amp_content'] = false;
            return $data;
        }

        if ( 'yes' === $amp_custom_post_content_check ) {
          $amp_custom_content = new AMP_Content( $amp_custom_post_content_input,
              apply_filters( 'amp_content_embed_handlers', array(
                      'AMP_Reddit_Embed_Handler'     => array(),
          				    'AMP_Twitter_Embed_Handler'     => array(),
          				    'AMP_YouTube_Embed_Handler'     => array(),
                  'AMP_DailyMotion_Embed_Handler' => array(),
                  'AMP_Vimeo_Embed_Handler'       => array(),
                  'AMP_SoundCloud_Embed_Handler'  => array(),
          				    'AMP_Instagram_Embed_Handler'   => array(),
          				    'AMP_Vine_Embed_Handler'        => array(),
          				    'AMP_Facebook_Embed_Handler'    => array(),
                  'AMP_Pinterest_Embed_Handler'   => array(),
          				    'AMP_Gallery_Embed_Handler'     => array(),
                      'AMP_Playlist_Embed_Handler'    => array(),
                      'AMP_Tiktok_Embed_Handler'=>array(),
              ) ),
              apply_filters(  'amp_content_sanitizers', array(
          				    'AMP_Style_Sanitizer'     => array(),
          				    'AMP_Blacklist_Sanitizer' => array(),
          				    'AMP_Img_Sanitizer'       => array(),
          				    'AMP_Video_Sanitizer'     => array(),
          				    'AMP_Audio_Sanitizer'     => array(),
                  'AMP_Playbuzz_Sanitizer'  => array(),
          				    'AMP_Iframe_Sanitizer'    => array(
          					       'add_placeholder' => true,
          				    ),
              )  )
          );

          if ( $amp_custom_content ) {
          	$data['ampforwp_amp_content'] = $amp_custom_content->get_amp_content();
          	$data['amp_component_scripts'] = $amp_custom_content->get_amp_scripts();
          	$data['post_amp_styles'] = $amp_custom_content->get_amp_styles();
          }
        }

  return $data;
}


function ampforwp_custom_content_meta_register() {
    global $redux_builder_amp;
    global $post_id;

    if( ampforwp_role_based_access_options() == true && ( current_user_can('edit_posts') || current_user_can('edit_pages') ) ){
        if ( $redux_builder_amp['amp-on-off-for-all-posts'] ) {
          add_meta_box( 'custom_content_editor', esc_html__( 'Custom AMP Editor', 'accelerated-mobile-pages' ), 'amp_content_editor_title_callback', 'post','normal', 'default' );
        }

        $frontpage_id = ampforwp_get_the_ID();
        if ( true == ampforwp_get_setting('amp-on-off-for-all-pages') || ( true == ampforwp_get_setting('amp-frontpage-select-option') && $post_id == $frontpage_id )) {
          add_meta_box( 'custom_content_editor', esc_html__( 'Custom AMP Editor','accelerated-mobile-pages' ), 'amp_content_editor_title_callback', 'page','normal', 'default' );
        }
        // Custom AMP Editor for Custom Post Types
        $post_types = ampforwp_get_all_post_types();
        if ( $post_types ) {
          foreach ( $post_types  as $post_type ) {
            if ( 'post' !== $post_type && 'page' !== $post_type ) {
              add_meta_box( 'custom_content_editor', esc_html__( 'Custom AMP Editor', 'accelerated-mobile-pages' ), 'amp_content_editor_title_callback', $post_type ,'normal', 'default' );
            }
          }
        }

        // Assign Pagebuilder Meta Box // Legecy pagebuilder
        if ( function_exists('ampforwp_custom_theme_files_register') ) {
          add_meta_box( 'custom_content_sidebar', esc_html__( 'AMP Page Builder', 'accelerated-mobile-pages' ), 'amp_content_sidebar_callback', 'page','side', 'default' );
        }  
    }

}
add_action('add_meta_boxes','ampforwp_custom_content_meta_register');

function amp_content_sidebar_callback( $post ) {
  global $post;
  global $redux_builder_amp;
  $current_post_id = $post->ID;

  wp_nonce_field( basename( __FILE__) , 'custom_content_sidebar_nonce' );
  $amp_content_sidebar = get_post_meta($current_post_id, 'ampforwp_custom_sidebar_select', true);
  $amp_content_sidebar = esc_attr($amp_content_sidebar); ?>
  <select name="ampforwp_custom_sidebar_select" id="ampforwp-sidebars-page-sidebar-name">
      <option <?php if ( isset ( $amp_content_sidebar ) ) selected( $amp_content_sidebar, 'none' ); ?> value="none"><?php esc_attr_e( 'None', 'accelerated-mobile-pages' ); ?></option>
      <option <?php if ( isset ( $amp_content_sidebar ) ) selected( $amp_content_sidebar, 'layout-builder' ); ?> value="layout-builder"><?php esc_attr_e( 'Page Builder (AMP)', 'accelerated-mobile-pages' ); ?></option>
  </select>
<p>Assign an AMP Page Builder Widget Area which will be used AMP page.<br /><a href="https://ampforwp.com/tutorials/page-builder">(Need Help?)</a></p>

  <?php 
}

function amp_content_editor_title_callback( $post ) {
  global $post;
  global $redux_builder_amp;
  $amp_current_post_id = $post->ID;
  if ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) {
    $amp_current_post_id = ampforwp_get_frontpage_id();
  }

  wp_nonce_field( basename( __FILE__) , 'amp_content_editor_nonce' );
  $amp_content_on_off = get_post_meta($amp_current_post_id, 'ampforwp_custom_content_editor_checkbox', true);
  $amp_content_on_off = esc_attr($amp_content_on_off);
  ?>
  <!--HTML content starts here-->

    <label for="meta-checkbox">
    	<p>
        <input type="checkbox" name="ampforwp_custom_content_editor_checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $amp_content_on_off ) ) checked( $amp_content_on_off, 'yes' ); ?> />
    		<?php esc_attr_e( 'Use This Content as AMP Content','accelerated-mobile-pages' )?>   </p>
        <p><?php esc_attr_e('If you want to add some special tags, then please use normal HTML into this area, it will automatically convert them into AMP compatible tags.','accelerated-mobile-pages') ?></p>
    </label>
  <div class="amp-editor-content" id="amp-editor-checker" style="background: #FFF59D;padding: 8px 14px;width:96%;margin-bottom:12px;"><b>Note: </b> <span id="ampforwp-amp-content-error-msg">AMP contents is blank, Please enter content</span></div>
  <!--HTML content Ends here-->
  <?php
  $content = get_post_meta ( $amp_current_post_id, 'ampforwp_custom_content_editor', true );
  $content = html_entity_decode($content);
  $editor_id = 'ampforwp_custom_content_editor';
  wp_editor( $content, $editor_id );
}

// Save Rating Meta Field function
function amp_content_editor_meta_save( $post_id ) {
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
         return ;
    }
  // Checks save status
    $is_autosave    = wp_is_post_autosave( $post_id );
    $is_revision    = wp_is_post_revision( $post_id );
    $is_valid_nonce = (isset( $_POST['amp_content_editor_nonce'] ) && wp_verify_nonce( $_POST[ 'amp_content_editor_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }

    //if there is data to be saved to DB
    // Save data of Custom AMP Editor
    if ( isset( $_POST['ampforwp_custom_content_editor'] ) ) {
      $unsan_ampforwp_custom_content_editor = htmlentities($_POST[ 'ampforwp_custom_content_editor' ]);
      $ampforwp_custom_content_editor = sanitize_post( $unsan_ampforwp_custom_content_editor );
      update_post_meta($post_id, 'ampforwp_custom_content_editor',  $ampforwp_custom_content_editor );
    }
    // Save data of Custom AMP Editor CheckBox
    if ( isset( $_POST['ampforwp_custom_content_editor'] ) ) { 
      $ampforwp_custom_editor_checkbox = null;      
      if ( isset($_POST['ampforwp_custom_content_editor_checkbox']) ) {
        $ampforwp_custom_editor_checkbox = sanitize_text_field($_POST[ 'ampforwp_custom_content_editor_checkbox' ]);
      }

      update_post_meta($post_id, 'ampforwp_custom_content_editor_checkbox', $ampforwp_custom_editor_checkbox ); 
    }

    // Save data of Sidebar Select
    if ( isset( $_POST['ampforwp_custom_sidebar_select'] ) ) {
      $ampforwp_custom_sidebar_select = sanitize_text_field($_POST['ampforwp_custom_sidebar_select'] );
        update_post_meta($post_id, 'ampforwp_custom_sidebar_select', $ampforwp_custom_sidebar_select );
    }
}
add_action ( 'save_post' , 'amp_content_editor_meta_save' );
//Add Button
add_action('admin_head', 'ampforwp_add_my_tc_button');
function ampforwp_add_my_tc_button() {
    global $typenow;
    // check user permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
    return;
    }
    // verify the post type

    $posts = array();
    $post_types = ampforwp_get_all_post_types();
    if ( $post_types ) {
      foreach ( $post_types  as $post_type ) {
        $posts[] = $post_type;
      }
    }
       
    if ( ! in_array( $typenow, $posts ) )
        return;
    // check if WYSIWYG is enabled
    if ( get_user_option('rich_editing') == 'true') {
        add_filter('mce_buttons', 'ampforwp_register_my_tc_button');
        add_filter("mce_external_plugins", "ampforwp_add_tinymce_plugin");
    }
}
//Load the js file
function ampforwp_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['ampforwp_tc_button'] = plugins_url( '/custom-amp-content-button.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
    return $plugin_array;
}
//Register the Button
function ampforwp_register_my_tc_button( $buttons ) {
   array_push($buttons, "|", "ampforwp_tc_button");
   return $buttons;
}
//Style to hide Button in the main Editor
add_action('admin_head', function( ) { ?>
    <style type="text/css">
       #wp-content-editor-container .mce-container .mce-ampforwp-copy-content-button{
          display: none;
        }
      .dashicons-clipboard:before{
          font: 400 18px/1.25 dashicons;
       }
       .mce-ampforwp-copy-content-button .mce-txt{
          margin-left: 5px;
       }
    </style>   
<?php });
