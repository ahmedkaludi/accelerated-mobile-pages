<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_ajax_amppb_color_picker','amppb_color_picker');
function amppb_color_picker(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
	// Exit if the user does not have proper permissions
	if(! current_user_can( 'editor' ) ) {
	return ;
	}
	wp_enqueue_style( 'wp-color-picker' );
	echo '<input type="text" value="#bada55" class="color-field"/><script>$(\'.color-field\').wpColorPicker()</script>';
}

add_action('wp_ajax_amppb_textEditor', 'amppb_textEditor');
function amppb_textEditor(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
   // Exit if the user does not have proper permissions
	if(! current_user_can( 'editor' ) ) {
	return ;
	}
	//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
   echo wp_editor( '', 'My_TextAreaID_22',      $settings = array( 'tinymce'=>true, 'textarea_name'=>'name77', 'wpautop' =>false,   'media_buttons' => true ,   'teeny' => false, 'quicktags'=>true, )   );    exit;
}

add_action("wp_ajax_enable_amp_pagebuilder", "enable_amp_pagebuilder");
function enable_amp_pagebuilder(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
	// Exit if the user does not have proper permissions
	// check user permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('User do not have access','accelerated-mobile-pages')));
        die;
	}

	if ( function_exists( 'ampforwp_user_access_check' ) && !ampforwp_user_access_check() ) {
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Access Denied','accelerated-mobile-pages')));
        die;
	}

	if(isset($_POST['postId'])){
		$postId = intval($_POST['postId']);
	}else{
		echo wp_json_encode(array('status'=>"500", 'Message'=>esc_html__("post id not found",'accelerated-mobile-pages')));
		die;
	}
	if ( function_exists( 'ampforwp_user_post_access_check' ) && !ampforwp_user_post_access_check(intval( wp_unslash( $_POST['postId'] ) ) ) ) {
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('You dont have permission to edit this post','accelerated-mobile-pages')));
        die;
	}
	if(isset($postId) && get_post_meta($postId,'use_ampforwp_page_builder', true)!=='yes' && current_user_can('edit_posts')){
		update_post_meta($postId, 'use_ampforwp_page_builder','yes');
		echo wp_json_encode(array('status'=>200, 'Message'=>esc_html__("Pagebuilder Started successfully",'accelerated-mobile-pages')));
	}else{
		echo wp_json_encode(array('status'=>200, 'Message'=>esc_html__("Pagebuilder Started successfully",'accelerated-mobile-pages')));
	}
	exit;
}

add_action( 'wp_ajax_amppb_export_layout_data', 'amppb_export_layout_data');
function amppb_export_layout_data(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
	// Exit if the user does not have proper permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo wp_json_encode(array("status"=>300,"message"=>esc_html__('User do not have access','accelerated-mobile-pages')));
        die;
	}
	header( 'content-type: application/json' );
	/* phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date */
	header( 'Content-Disposition: attachment; filename=layout-' . date( 'dmY' ) . '.json' );
	
	if ( function_exists('sanitize_textarea_field') ) {
		/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated */
		$export_data = sanitize_textarea_field(wp_unslash( $_POST['export_layout_data'] ));
	}
	else{
		/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
		$unsan_export_data = wp_unslash( $_POST['export_layout_data'] );
		$export_data = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $unsan_export_data ) ));
	}
	//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $export_data; // escaped above
	
	wp_die();
}
add_action( 'wp_ajax_amppb_save_layout_data', 'amppb_save_layout_data');
function amppb_save_layout_data(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
	// Exit if the user does not have proper permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo wp_json_encode(array("status"=>300,"message"=>esc_html__('User not have authority','accelerated-mobile-pages')));
        die;
	}

	if ( function_exists( 'ampforwp_user_access_check' ) && !ampforwp_user_access_check() ) {
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Access Denied','accelerated-mobile-pages')));
        die;
	}

/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash */
	$layoutname = sanitize_text_field($_POST['layoutname']);
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	$layoutdata = wp_slash($_POST['layoutdata']);
	$postarr = array(
				'post_title'   =>$layoutname,
				'post_content' =>$layoutdata,
				'post_author'  => 1,
				'post_status'  =>'publish',
				'post_type'    =>'amppb_layout'
					);
	wp_insert_post( $postarr );


	$allPostLayout = array();
	$args = array(
				'posts_per_page'   => 200,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'amppb_layout',
				'post_status'      => 'publish'
				);
	$posts_array = get_posts( $args );
	if(count($posts_array)>0){
		foreach ($posts_array as $key => $layoutData) {
		$allPostLayout[] = array('post_title'=>$layoutData->post_title,
								'post_id'=>$layoutData->ID,
								'post_content'=>$layoutData->post_content,
									);
		}
	}
	echo wp_json_encode(array("status"=>200, "data"=>$allPostLayout));
	exit;
}

add_action( 'wp_ajax_amppb_remove_saved_layout_data', 'amppb_remove_saved_layout_data');
function amppb_remove_saved_layout_data(){
/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated */
	$layoutid = intval($_POST['layoutid']);

	// Exit if the user does not have proper permissions
	if ( !current_user_can( 'delete_post', $layoutid ) ) {
		echo wp_json_encode(array("status"=>300,"message"=>esc_html__('User not have authority','accelerated-mobile-pages')));
		die;
	}

	check_ajax_referer( 'verify_pb', 'verify_nonce' );
	$users = wp_get_current_user();
	$roles = $users->roles;
	if(in_array("administrator", $roles) || in_array("editor", $roles)||in_array("author", $roles)|| in_array("contributor", $roles)){
		$is_delete = wp_delete_post($layoutid);
		$allPostLayout = array();
		$args = array(
					'posts_per_page'   => 200,
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => 'amppb_layout',
					'post_status'      => 'publish'
					);
		$posts_array = get_posts( $args );
		if(count($posts_array)>0){
			foreach ($posts_array as $key => $layoutData) {
			$allPostLayout[] = array('post_title'=>$layoutData->post_title,
									'post_id'=>$layoutData->ID,
									'post_content'=>$layoutData->post_content,
										);
			}
		}
		if ( $is_delete ) {
			echo wp_json_encode(array("status"=>200,"data"=>$allPostLayout));
			exit;
		}
		else{
			echo wp_json_encode(array("status"=>404,"data"=>$allPostLayout));
			exit;
		}	
	}else{
		echo wp_json_encode(array("status"=>403,"data"=>array()));
		exit;
	}	
}

// Ajax action to refresh the user image
add_action( 'wp_ajax_ampforwp_get_image', 'ampforwp_get_image');
function ampforwp_get_image() {
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')
	));
        die;
    }
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo wp_json_encode(array("status"=>300,"message"=>esc_html__('User not have authority','accelerated-mobile-pages')
	));
        die;
	}

	if ( function_exists( 'ampforwp_user_access_check' ) && !ampforwp_user_access_check() ) {
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Access Denied','accelerated-mobile-pages')));
        die;
	}
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated */
	if ( function_exists( 'ampforwp_user_post_access_check' ) && !ampforwp_user_post_access_check(intval( wp_unslash( $_GET['postId'] ) ) ) ) {
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('You dont have permission','accelerated-mobile-pages')));
        die;
	}
/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated */
	$get_id = intval($_GET['id']);
    if(isset($get_id)){
		if(strpos($get_id,",") !== false){
			$get_ids = explode(",", $get_id);
			
			if(count($get_ids)>0){
				foreach($get_ids as $id){
					$image = wp_get_attachment_image( $id, 'full', false, array( 'id' => 'ampforwp-preview-image' ) );
					$image_src = wp_get_attachment_image_src($id, 'full', false);
					$data[] = array(
						'image'    => $image,
						'detail'	   => $image_src
					);

				}
			}
		}else{
			/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated */
			$id = intval($_GET['id']);
			$image = wp_get_attachment_image( $id, 'full', false, array( 'id' => 'ampforwp-preview-image' ) );
			$image_src = ampforwp_get_attachment_id($id,'thumbnail');
			$image_src_full = ampforwp_get_attachment_id($id,'full');
			$svg = pathinfo($image_src_full[0], PATHINFO_EXTENSION) == 'svg' ? true : false;
			if ( $svg ) {
				$image_src_full[1] = 50;
				$image_src_full[2] = 50;
			}
			$data = array(
				'image'    => $image,
				'detail'   => $image_src,
				'front_image'=> $image_src_full,
			);
		}
        wp_send_json_success( $data );
        exit;
    } else {
        wp_send_json_error();
        exit;
    }
}


add_action( 'wp_ajax_ampforwp_icons_list_format', 'ampforwp_icons_list_format');
function ampforwp_icons_list_format(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo wp_json_encode(array("status"=>300,"message"=>esc_html__('User not have authority','accelerated-mobile-pages')));
        die;
	}
	$amp_icons_css_array = include AMPFORWP_PLUGIN_DIR .'includes/icons/amp-icons.php';

	foreach ($amp_icons_css_array as $key=>$value ) {
		$amp_icons_list[] = array('name'=>$key); 
	}
	echo wp_json_encode(array('success'=>true,'data'=>$amp_icons_list));
	exit;
}
add_action( 'wp_ajax_ampforwp_pb_taxonomy', 'ampforwp_pb_taxonomy');
function ampforwp_pb_taxonomy(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,	WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
    $taxs = array();
    $post = '';
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash */
	$post = sanitize_text_field($_POST['selected_val']);
    $taxs = get_object_taxonomies( $post );
    $return = array();
    if(!empty($taxs)){
    	foreach ($taxs as $taxonomy) {
	    	$taxonomies = get_taxonomy( $taxonomy );
	    	$return[esc_attr($taxonomies->name)] = esc_html($taxonomies->labels->singular_name);
	    }
    }
    $return['recent_option']= 'Recent Posts';
	echo wp_json_encode(array('success'=>true,'data'=>$return));
	exit;
    
}
add_action( 'wp_ajax_ampforwp_pb_cats', 'ampforwp_pb_cats');
function ampforwp_pb_cats(){
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
	$cats = array();
	$taxonomy = '';
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated,WordPress.Security.ValidatedSanitizedInput.MissingUnslash */
	$taxonomy = sanitize_text_field($_POST['selected_val']);
	$terms = get_terms(array(
					'taxonomy'=>$taxonomy,
				   'orderby' => 'name',     
                   'order'   => 'ASC',
                   'number'  => 500   
               ) );
	$return = array();
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ($terms as $key => $value) {
			$return[$value->term_id] = $value->name;
		}
	}
	$return['recent_option']= 'Recent Posts';
	echo wp_json_encode(array('success'=>true,'data'=>$return));
	exit;
}

add_action( 'wp_ajax_ampforwp_dynaminc_css', 'ampforwp_dynaminc_css' );
add_action( 'wp_ajax_nopriv_ampforwp_dynaminc_css', 'ampforwp_dynaminc_css' );

function ampforwp_dynaminc_css() {
	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	if(!isset($_REQUEST['verify_nonce']) || !wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo wp_json_encode(array("status"=>300,"message"=>esc_html__('Request not valid','accelerated-mobile-pages')));
        die;
    }
    if(!is_admin()){
    	echo wp_json_encode(array("status"=>300,"message"=>esc_html__('user not valid','accelerated-mobile-pages')));
        die;	
    }
    $amp_icons_css_array = include AMPFORWP_PLUGIN_DIR .'includes/icons/amp-icons.php';
    header("Content-type: text/css; charset: UTF-8");
	foreach ($amp_icons_css_array as $key=>$value ) {
		//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo  $value;
	}
    exit;
}

/**
 * Check if the current logged-in user has any of the allowed roles.
 *
 * This function retrieves the roles assigned to the current user and compares them
 * with a list of allowed roles. It returns true if there is an intersection between
 * the user's roles and the allowed roles, indicating that the user has the required access.
 *
 * @return bool True if the user has at least one of the allowed roles, false otherwise.
 */
function ampforwp_user_access_check() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $allowed_roles = ampforwp_get_setting('ampforwp-role-based-access');
        
        if ( !empty( array_intersect( $allowed_roles, $current_user->roles ) ) ) {
            return true;
        }
    }
    
    return false;
}

/**
 * Check if the current logged-in user has access to the specified post.
 *
 * This function checks if the logged-in user has one of the default allowed roles (administrator or editor)
 * or if the user is the author of the post with the given ID. It returns true if either condition is met,
 * indicating that the user has access to the post.
 *
 * @param int $post_id The ID of the post to check access for.
 * @return bool True if the user has access to the post, false otherwise.
 */
function ampforwp_user_post_access_check( $post_id ) {

    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $default_allowed_roles = ['administrator', 'editor'];


        if ( array_intersect( $default_allowed_roles, $current_user->roles ) ) {
            return true; 
        }


        $post = get_post( $post_id );

        if ( $post && $post->post_author == $current_user->ID ) {
            return true; 
        }
    }

    return false; 
}
