<?php 
function ampforwp_framework_get_author_box( $args=array() ) { 
global $post, $redux_builder_amp;
$post_author = get_userdata($post->post_author);
if ( ! is_array($args) ) {
    $args = array();
}

$avatar = false; //To show author Avater
$avatar_size = 40;
$author_description = false;
$class = $author_prefix = $author_wrapper_class = '';
$show_date = false;
$show_time = false;
$author_name = $post_author->display_name;
$and_text = '';
$and_text = ampforwp_translation($redux_builder_amp['amp-translator-and-text'], 'and' );
if ( function_exists('coauthors') ) { 
    $author_name = coauthors($and_text,$and_text,null,null,false);
}
$author_link = get_author_posts_url($post_author->ID);
if ( function_exists('coauthors_posts_links') ) {
    $author_link = coauthors_posts_links($and_text,$and_text,null,null,false);
}
//var_dump($and);die;
$author_image_wrapper = '';

if ( isset($args['avatar']) ) {
    $avatar = $args['avatar'];
}
if ( isset($args['avatar_size']) ) {
    $avatar_size = $args['avatar_size'];
}
if ( isset($args['class']) ) {
	$class = $args['class'];
}
if ( isset($args['author_description']) ) {
	$author_description = $args['author_description'];
}


if ( isset( $args['author_prefix']) ) {
      $author_prefix = $args['author_prefix'];
}
//$author_prefix = ampforwp_translation($redux_builder_amp['amp-translator-by-text'] , $author_prefix );

if ( isset( $args['author_link']) ) {
	  $author_link = $args['author_link'];
}
if ( isset( $args['author_wrapper_class']) ) {
	  $author_wrapper_class = $args['author_wrapper_class'];
}

if ( isset($args['author_image_wrapper']) ) {
    $author_image_wrapper = $args['author_image_wrapper'];
}
if ( isset($args['show_date']) ) {
    $show_date = $args['show_date'];
}
if ( isset($args['show_time']) ) {
    $show_time = $args['show_time'];
}

 ?>
    <div class="amp-author <?php echo $class; ?>">
        <?php if ( $avatar ) {
$author_avatar_url = get_avatar_url( $post_author->ID, array( 'size' => $avatar_size ) );
            ?>
        <div class="amp-author-image <?php echo $author_image_wrapper; ?>">
            <amp-img src="<?php echo esc_url($author_avatar_url); ?>" width="<?php echo $avatar_size; ?>" height="<?php echo $avatar_size; ?>" layout="fixed"></amp-img> 
        </div>
        <?php } ?>
        <?php echo '<div class="author-details '. $author_wrapper_class .'">';
        if ( true == $redux_builder_amp['ampforwp-author-page-url'] ){
            if ( function_exists('coauthors_posts_links') ) {
                echo '<span class="author-name">' .$author_prefix . $author_link . ' </span>';
            }
            else {
                echo '<span class="author-name">' .$author_prefix . ' <a href="'. esc_url(ampforwp_url_controller($author_link)).'"> ' .esc_html( $author_name ).'</a></span>';
            }
        }
        else
            echo '<span class="author-name">' . $author_prefix . esc_html( $author_name ) . '</span>';

        //to show date and time
        if ( $show_date || $show_time ) {
         echo '<span class="posted-time"> ';
                if ( $show_date ) {
                   echo esc_html( get_the_date() ) . ' ';
                }
                if ( $show_time ) {
                    echo esc_html( get_the_time());
                }
         echo '</span>';
        }
        if ( $author_description ) {
        	echo "<p>".$post_author->description."</p>";
        } ?>
        </div>
    </div>
<?php }