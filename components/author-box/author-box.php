<?php 
function ampforwp_framework_get_author_box($args=array()){ 
global $post, $redux_builder_amp;
$post_author = get_userdata($post->post_author);
if(! is_array($args) ){
    $args = array();
}


$avatar_width = 40;
$avatar_height = 40;
$author_description = true;
$show_author_image = true;
$author_prefix = $author_wrapper_class = '';
$show_date = true;
$show_time = true;

if(isset($args['avatar_width'])){
	$avatar_width = $args['avatar_width'];
}
if(isset($args['avatar_height'])){
	$avatar_height = $args['avatar_height'];
}
if(isset($args['author_description'])){
	$author_description = $args['author_description'];
}
$author_avatar_url = get_avatar_url( $post_author->ID, array( 'size' => $avatar_width ) );

$author_link = get_author_posts_url($post_author->ID);
if(isset( $args['author_prefix'])){
	  $author_prefix = $args['author_prefix'];
}
$prefix = ampforwp_translation($redux_builder_amp['amp-translator-by-text'] , $author_prefix );
if(isset( $args['author_link'])){
	  $author_link = $args['author_link'];
}
if(isset( $args['author_wrapper_class'])){
	  $author_wrapper_class = $args['author_wrapper_class'];
}
if(isset($args['show_author_image'])){
    $show_author_image = $args['show_author_image'];
}
if(isset($args['author_image_wrapper'])){
    $author_image_wrapper = $args['author_image_wrapper'];
}
if(isset($args['show_date'])){
    $show_date = $args['show_date'];
}
if(isset($args['show_time'])){
    $show_time = $args['show_time'];
}

 ?>
    <div class="amp-author">
        <?php if($show_author_image){ ?>
        <div class="amp-author-image <?php echo $author_image_wrapper; ?>">
            <amp-img src="<?php echo $author_avatar_url; ?>" width="<?php echo $avatar_width; ?>" height="<?php echo $avatar_height; ?>" layout="fixed"></amp-img> 
        </div>
        <?php } ?>
        <?php echo '<div class="'. $author_wrapper_class .'">
                        <span class="author-name">'
                        .$prefix . '<a href="'. $author_link.AMPFORWP_AMP_QUERY_VAR.'"> ' .esc_html( $post_author->display_name ).'</a>
                        </span>';
                if($show_date){
                    echo '<span class="posted-time"> '. esc_html( get_the_date() ).' ' .($show_time? esc_html( get_the_time()) : '' ).'</span>';
                }
        if($author_description){
        	echo "<p>".$post_author->description."</p>";
        } ?>
        </div>
    </div>
<?php }