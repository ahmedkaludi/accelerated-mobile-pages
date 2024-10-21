<?php 
add_action( 'add_meta_boxes', function() {
	add_meta_box( 'ampforwp_select_post_metabox', 'Select Infinite Scroll Post', 'ampforwp_select_post_meta', 'post' );
} );

// displaying the fields inside
function ampforwp_select_post_meta( $post ) {
		$infinite_posts = ampforwp_get_infinite_scroll_post_on_id();
		$exclude_id = array();
		$exclude_id[] = ampforwp_get_the_ID();
		/* $arguments = array(
			"post__not_in"=>$exclude_id,
			"orderby" => "ID", 
			"order" => "DESC",
			"posts_per_page" => 10
		);
		$posts_array = get_posts($arguments); */
		$posts_array = array();
		?>
			<div class="ampforwp-dd">
				<div>
					<div class="ampforwp-post-tag-box">
						<input type="text" placeholder="Type post title to search..." id="ampforwp-post-sb" onkeyup="ampforwpFilterPost()" onfocus="ampforwpShowPostDD()">
						<input type="hidden" id="ampforwp_filtered_post_nounce" name="ampforwp_filtered_post_nounce" value="<?php echo wp_create_nonce( 'ampforwp_filtered_post_nounce' )?>"/>
						<input type="hidden" id="ampforwp_filtered_this_post_id" value='<?php echo ampforwp_get_the_ID()?>'/>
						<input type="hidden" id="ampforwp_filtered_post_ids" name="ampforwp_filtered_post_ids" value='<?php echo (!empty($infinite_posts))? json_encode($infinite_posts):"[]";?>'/>
						<div style="margin:10px 5px" id="ampforwp-post-tag-ihtml">
							<?php foreach ($infinite_posts as $key => $value) {?>
								<p class="ampforwp-tag-sp"><?php echo $value->title;?><span style="cursor:pointer;float:right" onclick="ampforwp_remove_item(<?php echo $key?>)">x</span></p>
							<?php }?>
						</div>
						<p id="afwp-post-tag-error" style="color:red;margin-left:10px"></p>
					</div>
					<ul id="ampforwp-dd-content">
					<?php
						foreach ($posts_array as $key => $value) {?>
							<li onclick="ampforwp_select_post_item(this.value,<?php echo $value->ID?>,'<?php echo $value->post_title?>')"><?php echo $value->post_title; ?></li>
							<?php
						}
					?>
					</ul>
				</div>
			</div>
		<?php
}
