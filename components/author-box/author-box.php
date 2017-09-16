<?php 
function ampforwp_framework_get_author_box( $author_url){ 
global $post;		
$author_avatar_url = $author_url;
$post_author = get_userdata($post->post_author);
if($author_avatar_url == null){
	$author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 70 ) );
} ?>
    <div class="amp-author">
        <amp-img src="<?php echo $author_avatar_url; ?>" width="70" height="70" layout="fixed"></amp-img>     
        <strong><?php echo esc_html( $post_author->display_name ); ?></strong>
        <?php echo $post_author->description; ?>
    </div>
<?php }