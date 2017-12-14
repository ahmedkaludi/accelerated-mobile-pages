<?php
add_action('wp_ajax_amppb_color_picker',function(){
	wp_enqueue_style( 'wp-color-picker' );
	echo '<input type="text" value="#bada55" class="color-field"/><script>$(\'.color-field\').wpColorPicker()</script>';

});

add_action('wp_ajax_amppb_textEditor', function(){
   echo wp_editor( '', 'My_TextAreaID_22',      $settings = array( 'tinymce'=>true, 'textarea_name'=>'name77', 'wpautop' =>false,   'media_buttons' => true ,   'teeny' => false, 'quicktags'=>true, )   );    exit;
});

add_action( 'wp_ajax_amppb_export_layout_data', 'amppb_export_layout_data');
function amppb_export_layout_data(){
	header( 'content-type: application/json' );
	header( 'Content-Disposition: attachment; filename=layout-' . date( 'dmY' ) . '.json' );
	
	$export_data = wp_unslash( $_POST['export_layout_data'] );
	echo $export_data;
	
	wp_die();
}
add_action( 'wp_ajax_amppb_save_layout_data', 'amppb_save_layout_data');
function amppb_save_layout_data(){
	$layoutname = $_POST['layoutname'];
	$layouturl = $_POST['layouturl'];
	$layoutdata = $_POST['layoutdata'];
	$postarr = array(
				'post_title'   =>$layoutname,
				'post_content' =>$layoutdata,
				'post_excerpt' =>$layouturl,
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
								'post_excerpt'=>$layoutData->post_excerpt
									);
		}
	}
	echo json_encode(array("status"=>200, "data"=>$allPostLayout));
	exit;
}



// Ajax action to refresh the user image
add_action( 'wp_ajax_ampforwp_get_image', 'ampforwp_get_image');
function ampforwp_get_image() {
    if(isset($_GET['id']) ){
		if(strpos($_GET['id'],",") !== false){
			$get_ids = explode(",", $_GET['id']);
			
			if(count($get_ids)>0){
				foreach($get_ids as $id){
					$image = wp_get_attachment_image( $id, 'medium', false, array( 'id' => 'ampforwp-preview-image' ) );
					$image_src = wp_get_attachment_image_src($id, 'medium', false);
					$data[] = array(
						'image'    => $image,
						'detail'	   => $image_src
					);

				}
			}
		}else{
			$image = wp_get_attachment_image( $_GET['id'], 'medium', false, array( 'id' => 'ampforwp-preview-image' ) );
			$image_src = wp_get_attachment_image_src($_GET['id'], 'medium', false);
			$data = array(
				'image'    => $image,
				'detail'   => $image_src
			);
		}
        wp_send_json_success( $data );
        exit;
    } else {
        wp_send_json_error();
        exit;
    }
}