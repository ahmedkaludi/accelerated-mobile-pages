<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
function ampforwp_get_pb_comment_list($moduleFrontHtml, $moduleTemplate, $contentArray){
	$output = '';
	if($moduleTemplate['name']!="comments"){return $moduleFrontHtml; }
	if (ampforwp_get_setting('wordpress-comments-support')) {
			global $post;
			$comments = $max_page =  "";
			$postID = $post->ID;
			$output = '<div class="pb-comments">';
			$order = get_option( 'comment_order');
			$comments = get_comments(array(
					'post_id' => intval($postID),
					'status' => 'approve',
					'order' =>esc_attr($order)
			));

			if ( $comments ) {
				$output .= '<div {{if_id}}id="{{id}}"{{ifend_id}} class="pb-comments-wrapper {{if_user_class}}{{user_class}}{{ifend_user_class}}">
		            <h3><span>'.ampforwp_get_setting('amp-translator-view-comments-text').'</span></h3>
		            <ul>';
					foreach ($comments as $key => $value) {
							$avatar             = get_avatar_url( $value->comment_author_email);
							$output .='<li>';
							if(ampforwp_get_setting('ampforwp-display-avatar')){
								$output .='<div class="fn"><img src="'.esc_url($avatar).'" height="50" width="50"/></div>';
							}
							$output .='<div class="pbc-auth-info"><div class="pbc-auth-name"><b class="fn">'.esc_attr($value->comment_author).'</b></div>';
							$output .='<span>'.esc_attr(date('F d, Y H:i:s', strtotime($value->comment_date))).'</span></div>';
							$output .='<p class="pbc-comment">'.wp_kses_post($value->comment_content).'</p>';
							$output .='</li>';	
					} 	
				$output .='</ul>'; 
				$output .='</div>';
			} 
		$output .='</div>';
	}
	return $output;
}
add_filter("ampforwp_extension_pagebuilder_module_template",'ampforwp_get_pb_comment_list' ,10,3);
$output_html = "{{Comment_HTML}}";
$css = '.pb-comments-wrapper ul li{list-style-type:none;position:relative;} .pbc-auth-info{position:absolute;top:2px;left:56px;} .pbc-auth-name{margin-bottom:5px}.pbc-comment{margin-top:10px;margin-bottom:10px;} .pb-comments-wrapper h3{margin-bottom: 16px;line-height:35px;border-bottom: 1px solid #d7d7d7;}';
return array(
		'label' =>'Comments',
		'name' =>'comments',
		'default_tab'=> 'advanced',
		'tabs' => array(
              'advanced' => 'Advanced'
         ),
		
		'fields' => array(
					array(
								'type'		=>'text',
								'name'		=>"id",
								'label'		=>'ID',
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),
					array(
							'type'		=>'text',
							'name'		=>"user_class",
							'label'		=>'Class',
							'tab'		=>'advanced',
							'default'	=>'',
							'content_type'=>'html'
						),
			),
		'front_template'=> $output_html,
		'front_css'=> '',
		'front_common_css'=>$css,
	);
?>