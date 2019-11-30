<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_framework_get_author_box( $args=array() ) { 
// Simple Author Box compatibility #2268
if( class_exists('Simple_Author_Box') && !isset($args['author_info']) ){
    return;
}
global $post, $redux_builder_amp;
$post_author = get_userdata($post->post_author);
if ( ! is_array($args) ) {
    $args = array();
}

$avatar = false; //To show author Avater
$author_pub_name = false; //To show author name
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
$author_image_wrapper = '';

if ( isset($args['author_pub_name']) ) {
    $author_pub_name = $args['author_pub_name'];
}

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
    <div class="amp-author <?php echo esc_attr($class); ?>">
        <?php if ( $avatar ) {
    $author_avatar_url = ampforwp_get_wp_user_avatar();
    if( null == $author_avatar_url ){
       $author_avatar_url = get_avatar_url( $post_author->ID, array( 'size' => $avatar_size ) );
    } ?>
        <div class="amp-author-image <?php echo esc_attr($author_image_wrapper); ?>">
            <amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?>src="<?php echo esc_url($author_avatar_url); ?>" width="<?php echo esc_attr($avatar_size); ?>" height="<?php echo esc_attr($avatar_size); ?>" layout="fixed"></amp-img> 
        </div>
        <?php } ?>
        <?php echo '<div class="author-details '. esc_attr($author_wrapper_class) .'">';
        if ( true == ampforwp_get_setting('ampforwp-author-page-url') ){
            if ( function_exists('coauthors_posts_links') ) {
                if( $author_pub_name  ){
	                $author_link = (true == ampforwp_get_setting('ampforwp-archive-support'))? esc_url(ampforwp_url_controller($author_link)) :  esc_url($author_link);
	                echo '<span class="author-name">' .esc_html($author_prefix) . ' <a href="'. esc_url($author_link).'" title="'. esc_html($author_name).'"> ' .esc_html( $author_name ).'</a></span>';
                    echo ampforwp_yoast_twitter_handle();
                }
            }
            else {
                if( $author_pub_name  ){
                    echo '<span class="author-name">' .esc_html($author_prefix) . ' <a href="'. esc_url(ampforwp_url_controller($author_link)).'" title="'. esc_html($author_name).'"> ' .esc_html( $author_name ).'</a></span>';
                    echo ampforwp_yoast_twitter_handle();
                }
            }
        }
        else{
            if( $author_pub_name  ){
                echo '<span class="author-name">' . esc_html($author_prefix) . esc_html( $author_name ) . '</span>';
                echo  ampforwp_yoast_twitter_handle();
            }
        }

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
            if( true == ampforwp_get_setting('amp-author-box-description') ){
                $allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>';
                echo "<p>".strip_tags($post_author->description,$allowed_tags)."</p>";
            }
        } ?>
        </div>
    </div>
<?php 
    if(is_singular() && ( isset($args['ads_below_the_author']) && true == $args['ads_below_the_author'] )){
            do_action('ampforwp_below_author_box');
        }
    }