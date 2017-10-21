<?php 
function ampforwp_framework_get_author_box( $author_url,$args=array()){ 
global $post, $redux_builder_amp;		
$author_avatar_url = $author_url;
$post_author = get_userdata($post->post_author);
if($author_avatar_url == null){
	$author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 70 ) );
}
$avatar_width = 40;
$avatar_height = 40;
$author_description = true;
if(isset($args['avatar_width'])){
	$avatar_width = $args['avatar_width'];
}
if(isset($args['avatar_height'])){
	$avatar_height = $args['avatar_height'];
}
if(isset($args['author_description'])){
	$author_description = $args['author_description'];
}


$author_prefix = $author_wrapper_class = '';
$author_link = '#';
if(isset( $args['author_prefix'])){
	  $author_prefix = $args['author_prefix'];
}
$suffix = ampforwp_translation($redux_builder_amp['amp-translator-by-text'] , $author_prefix );
if(isset( $args['author_link'])){
	  $author_link = $args['author_link'];
}
if(isset( $args['author_wrapper_class'])){
	  $author_wrapper_class = $args['author_wrapper_class'];
}

 ?>
    <div class="amp-author">
        <amp-img src="<?php echo $author_avatar_url; ?>" width="<?php echo $avatar_width; ?>" height="<?php echo $avatar_height; ?>" layout="fixed"></amp-img>     
        
        <?php echo '<span class="'. $author_wrapper_class .'">'.$suffix . '<a href="'. $author_link.'"> ' .esc_html( $post_author->display_name ).'</a></span>'; ?>
        <?php if($author_description){
        	echo $post_author->description;
        } ?>
        <span class="posted-time"><?php echo esc_html( get_the_date() ); ?></span>
    </div>
<?php }