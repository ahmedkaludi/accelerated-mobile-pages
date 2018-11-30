<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_ajax_amppb_color_picker','amppb_color_picker');
function amppb_color_picker(){
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
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
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
   // Exit if the user does not have proper permissions
	if(! current_user_can( 'editor' ) ) {
	return ;
	}
   echo wp_editor( '', 'My_TextAreaID_22',      $settings = array( 'tinymce'=>true, 'textarea_name'=>'name77', 'wpautop' =>false,   'media_buttons' => true ,   'teeny' => false, 'quicktags'=>true, )   );    exit;
}

add_action("wp_ajax_enable_amp_pagebuilder", "enable_amp_pagebuilder");
function enable_amp_pagebuilder(){
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
	// Exit if the user does not have proper permissions
	// check user permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
    	echo json_encode(array("status"=>300,"message"=>'User do not have access'));
        die;
	}
	if(isset($_POST['postId'])){
		$postId = $_POST['postId'];
	}else{
		echo json_encode(array('status'=>"500", 'Message'=>"post id not found"));
	}
	if(isset($postId) && get_post_meta($postId,'use_ampforwp_page_builder', true)!=='yes'){
		update_post_meta($postId, 'use_ampforwp_page_builder','yes');
		echo json_encode(array('status'=>200, 'Message'=>"Pagebuilder Started successfully"));
	}else{
		echo json_encode(array('status'=>200, 'Message'=>"Pagebuilder Started successfully"));
	}
	exit;
}

add_action( 'wp_ajax_amppb_export_layout_data', 'amppb_export_layout_data');
function amppb_export_layout_data(){
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
	// Exit if the user does not have proper permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo json_encode(array("status"=>300,"message"=>'User do not have access'));
        die;
	}
	header( 'content-type: application/json' );
	header( 'Content-Disposition: attachment; filename=layout-' . date( 'dmY' ) . '.json' );
	
	$export_data = wp_unslash( $_POST['export_layout_data'] );
	echo $export_data;
	
	wp_die();
}
add_action( 'wp_ajax_amppb_save_layout_data', 'amppb_save_layout_data');
function amppb_save_layout_data(){
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
	// Exit if the user does not have proper permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo json_encode(array("status"=>300,"message"=>'User not have authority'));
        die;
	}
	$layoutname = sanitize_text_field($_POST['layoutname']);
	$layoutdata = sanitize_text_field($_POST['layoutdata']);
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
				'posts_per_page'   => -1,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'amppb_layout',
				'post_status'      => 'publish'
				);
	$posts_array = get_posts( $args );
	if(count($posts_array)>0){
		foreach ($posts_array as $key => $layoutData) {
		$allPostLayout[] = array('post_title'=>$layoutData->post_title,
								'post_content'=>$layoutData->post_content,
									);
		}
	}
	echo json_encode(array("status"=>200, "data"=>$allPostLayout));
	exit;
}



// Ajax action to refresh the user image
add_action( 'wp_ajax_ampforwp_get_image', 'ampforwp_get_image');
function ampforwp_get_image() {
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo json_encode(array("status"=>300,"message"=>'User not have authority'));
        die;
	}
    if(isset($_GET['id']) ){
		if(strpos($_GET['id'],",") !== false){
			$get_ids = explode(",", $_GET['id']);
			
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
			$image = wp_get_attachment_image( $_GET['id'], 'full', false, array( 'id' => 'ampforwp-preview-image' ) );
			$image_src = ampforwp_get_attachment_id($_GET['id'],'thumbnail');
			$image_src_full = ampforwp_get_attachment_id($_GET['id'],'full');
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
	if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		echo json_encode(array("status"=>300,"message"=>'User not have authority'));
        die;
	}
	$amp_icons_css_array = include AMPFORWP_PLUGIN_DIR .'includes/icons/amp-icons.php';

	foreach ($amp_icons_css_array as $key=>$value ) {
		$amp_icons_list[] = array('name'=>$key); 
	}
	echo json_encode(array('success'=>true,'data'=>$amp_icons_list));
	exit;
}

add_action( 'wp_ajax_ampforwp_dynaminc_css', 'ampforwp_dynaminc_css' );
add_action( 'wp_ajax_nopriv_ampforwp_dynaminc_css', 'ampforwp_dynaminc_css' );

function ampforwp_dynaminc_css() {
	if(!isset($_REQUEST['verify_nonce']) || !wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_pb' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
    if(!is_admin()){
    	echo json_encode(array("status"=>300,"message"=>'user not valid'));
        die;	
    }
    $amp_icons_css_array = include AMPFORWP_PLUGIN_DIR .'includes/icons/amp-icons.php';
    header("Content-type: text/css; charset: UTF-8");
	foreach ($amp_icons_css_array as $key=>$value ) {
		echo  $value;
	}
    exit;
}
