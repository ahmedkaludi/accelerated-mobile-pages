<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
function ampforwp_get_pb_comment_list(){
	$output = '';
	if (ampforwp_get_setting('wordpress-comments-support')) {
			global $post;
			$comments = $max_page =  "";
			$postID = $post->ID;
			$output = '<div class="pb-comments">';
			$order = get_option( 'comment_order');
			$comments = get_comments(array(
					'post_id' => $postID,
					'status' => 'approve',
					'order' =>$order
			));

			if ( $comments ) {
				$output .= '<div id="pb-comments" class="pb-comments-wrapper">
		            <h3><span>View Comments</span></h3>
		            <ul>';
					foreach ($comments as $key => $value) {
						if($value->user_id!=0){
							$avatar             = get_avatar_url( $value->comment_author_email);
							$output .='<li>';
							if(ampforwp_get_setting('ampforwp-display-avatar')){
								$output .='<div class="fn"><img src="'.esc_url($avatar).'" height="50" width="50"/></div>';
							}
							$output .='<div class="pbc-auth-info"><div class="pbc-auth-name"><b class="fn">'.esc_attr($value->comment_author).'</b></div>';
							$output .='<span>'.esc_attr(date('F d, Y H:i:s', strtotime($value->comment_date))).'</span></div>';
							$output .='<p class="pbc-comment">'.$value->comment_content.'</p>';
							$output .='</li>';
						}	
					} 	
				$output .='</ul>'; 
				$output .='</div>';
			} 
		
		$output .='</div>';
	}
	return $output;
}
$output_html = ampforwp_get_pb_comment_list();
$css = '.pb-comments-wrapper ul li{list-style-type:none;position:relative;} .pbc-auth-info{position:absolute;top:2px;left:56px;} .pbc-auth-name{margin-bottom:5px}.pbc-comment{margin-top:10px;margin-bottom:10px;} .pb-comments-wrapper h3{margin-bottom: 16px;line-height:35px;border-bottom: 1px solid #d7d7d7;}';
return array(
		'label' =>'Comments',
		'name' =>'comments',
		'fields' => array(
						array(		
		 						
	 						),
			),
		'front_template'=> $output_html,
		'front_css'=> $css,
		'front_common_css'=>'',
	);
?>