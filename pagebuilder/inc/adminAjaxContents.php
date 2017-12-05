<?php
add_action('wp_ajax_amppb_textEditor', function(){
    wp_editor( '', 'My_TextAreaID_22',      $settings = array( 'tinymce'=>true, 'textarea_name'=>'name77', 'wpautop' =>false,   'media_buttons' => true ,   'teeny' => false, 'quicktags'=>true, )   );    exit;
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