<?php
// Adding Custom meta Sanitizer to sanitize the custom content added throught tinymce post meta
add_filter( 'amp_post_template_data', 'ampforwp_custom_post_content_sanitizer', 10, 2 );

function ampforwp_custom_post_content_sanitizer( $data, $post ) {
    global $redux_builder_amp;

      if( is_home() && $redux_builder_amp['amp-frontpage-select-option'] == 0 ){
          return $data;
      }

      global $post;
      $amp_current_post_id = get_the_ID() ;
      if ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) {
        $amp_current_post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
      }
    	$amp_custom_post_content_input 	= get_post_meta($amp_current_post_id, 'ampforwp_custom_content_editor', true);
      $amp_custom_post_content_check  = get_post_meta($amp_current_post_id, 'ampforwp_custom_content_editor_checkbox', true);

      	if ( empty( $amp_custom_post_content_input ) ) {
            $data['ampforwp_amp_content'] = false;
            return $data;
        }

        if ( $amp_custom_post_content_check === 'yes') {
          $amp_custom_content = new AMP_Content( $amp_custom_post_content_input,
              apply_filters( 'amp_content_embed_handlers', array(
          				'AMP_Twitter_Embed_Handler' => array(),
          				'AMP_YouTube_Embed_Handler' => array(),
          				'AMP_Instagram_Embed_Handler' => array(),
          				'AMP_Vine_Embed_Handler' => array(),
          				'AMP_Facebook_Embed_Handler' => array(),
          				'AMP_Gallery_Embed_Handler' => array(),
              ) ),
              apply_filters(  'amp_content_sanitizers', array(
          				 'AMP_Style_Sanitizer' => array(),
          				 'AMP_Blacklist_Sanitizer' => array(),
          				 'AMP_Img_Sanitizer' => array(),
          				 'AMP_Video_Sanitizer' => array(),
          				 'AMP_Audio_Sanitizer' => array(),
          				 'AMP_Iframe_Sanitizer' => array(
          					 'add_placeholder' => true,
          				 ),
              )  )
          );

          if ( $amp_custom_content ) {
          	$data[ 'ampforwp_amp_content' ] = $amp_custom_content->get_amp_content();
          	$data['amp_component_scripts'] 	= $amp_custom_content->get_amp_scripts();
          	$data['post_amp_styles'] 		= $amp_custom_content->get_amp_styles();
          }
        }

  return $data;
}


function ampforwp_custom_content_meta_register() {

  add_meta_box( 'custom_content_editor', __( 'Custom AMP Editor', 'accelerated-mobile-pages' ), 'amp_content_editor_title_callback', 'post','normal', 'default' );

  global $redux_builder_amp;
  if($redux_builder_amp['amp-on-off-for-all-pages']){
    add_meta_box( 'custom_content_editor', __( 'Custom AMP Editor','accelerated-mobile-pages' ), 'amp_content_editor_title_callback', 'page','normal', 'default' );
  }

  // Assign Pagebuilder Meta Box
  if ( $redux_builder_amp['ampforwp-content-builder'] ) {
    add_meta_box( 'custom_content_sidebar', __( 'AMP Page Builder', 'accelerated-mobile-pages' ), 'amp_content_sidebar_callback', 'page','side', 'default' );
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
      <option <?php if ( isset ( $amp_content_sidebar ) ) selected( $amp_content_sidebar, 'none' ); ?> value="none"><?php _e( 'None', 'accelerated-mobile-pages' ); ?></option>
      <option <?php if ( isset ( $amp_content_sidebar ) ) selected( $amp_content_sidebar, 'layout-builder' ); ?> value="layout-builder"><?php _e( 'Page Builder (AMP)', 'accelerated-mobile-pages' ); ?></option>
  </select>
<p>Assign an AMP Page Builder Widget Area which will be used AMP page.<br /><a href="https://ampforwp.com/tutorials/page-builder">(Need Help?)</a></p>

  <?php 
}

function amp_content_editor_title_callback( $post ) {
  global $post;
  global $redux_builder_amp;
  $amp_current_post_id = $post->ID;
  if ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) {
    $amp_current_post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
  }

  wp_nonce_field( basename( __FILE__) , 'amp_content_editor_nonce' );
  $amp_content_on_off = get_post_meta($amp_current_post_id, 'ampforwp_custom_content_editor_checkbox', true);
  $amp_content_on_off = esc_attr($amp_content_on_off);
  ?>
  <!--HTML content starts here-->

    <label for="meta-checkbox">
    	<p>
        <input type="checkbox" name="ampforwp_custom_content_editor_checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $amp_content_on_off ) ) checked( $amp_content_on_off, 'yes' ); ?> />
    		<?php echo __( 'Use This Content as AMP Content','accelerated-mobile-pages' )?>   </p>
        <?php echo __('<p>If you want to add some special tags, then please use normal HTML into this area, it will automatically convert them into AMP compatible tags.</p>','accelerated-mobile-pages') ?>
    </label>

  <!--HTML content Ends here-->
  <?php
  $content 		= get_post_meta ( $amp_current_post_id, 'ampforwp_custom_content_editor', true );
  $editor_id 	= 'ampforwp_custom_content_editor';
  wp_editor( $content, $editor_id );
}

// Save Rating Meta Field function
function amp_content_editor_meta_save ( $post_id ) {
  // Checks save status
    $is_autosave    = wp_is_post_autosave( $post_id );
    $is_revision    = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'amp_content_editor_nonce' ] ) && wp_verify_nonce( $_POST[ 'amp_content_editor_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    //if there is data to be saved to DB
    // Save data of Custom AMP Editor
    if ( isset( $_POST['ampforwp_custom_content_editor'] ) ) {
      update_post_meta($post_id, 'ampforwp_custom_content_editor', $_POST[ 'ampforwp_custom_content_editor' ] );
    }
    // Save data of Custom AMP Editor CheckBox
    if ( isset( $_POST['ampforwp_custom_content_editor'] ) ) {
        update_post_meta($post_id, 'ampforwp_custom_content_editor_checkbox', $_POST[ 'ampforwp_custom_content_editor_checkbox' ] );
    }


    // Save data of Sidebar Select
    if ( isset( $_POST['ampforwp_custom_sidebar_select'] ) ) {
        update_post_meta($post_id, 'ampforwp_custom_sidebar_select', $_POST[ 'ampforwp_custom_sidebar_select' ] );
    }
}

add_action ( 'save_post' , 'amp_content_editor_meta_save' );
