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
if(empty($post_author)){
    return;
}
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
$author_name = apply_filters('ampforwp_modify_author_name',$author_name);
$and_text = '';
$avatar_size_weight = $avatar_size_height = '';
$and_text = ampforwp_translation($redux_builder_amp['amp-translator-and-text'], 'and' );
if ( function_exists('coauthors') ) { 
    $author_name = coauthors($and_text,$and_text,null,null,false);
}
$author_link = get_author_posts_url($post_author->ID);
if ( function_exists('coauthors_posts_links') ) {
    $author_link = coauthors_posts_links($and_text,$and_text,null,null,false);
}
$author_image_wrapper = $alt = '';

if ( isset($args['author_pub_name']) ) {
    $author_pub_name = $args['author_pub_name'];
}

if ( isset($args['avatar']) ) {
    $avatar = $args['avatar'];
}
if ( isset($args['avatar_size']) ) {
    $avatar_size = ampforwp_get_setting('amp-author-bio-image-width');
    $avatar_size_width = ampforwp_get_setting('amp-author-bio-image-width');
    $avatar_size_height = ampforwp_get_setting('amp-author-bio-image-height');
    if (empty($avatar_size_width)) {
       $avatar_size_width = 60;
    }
    if (empty($avatar_size_height)) {
       $avatar_size_height = 60;
    }
    if (empty($avatar_size)) {
       $avatar_size_width = 60;
    }
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
$is_author_link_amp = true;
if ( isset( $args['is_author_link_amp']) ) {
      $is_author_link_amp = $args['is_author_link_amp'];
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
        <?php if ( $avatar && true == ampforwp_get_setting('amp-author-bio-image')) {
    $author_avatar_url = ampforwp_get_wp_user_avatar();
    if( null == $author_avatar_url ){
       $author_avatar_url = get_avatar_url( $post_author->ID, array( 'size' => $avatar_size ) );
    } 
    if(class_exists('WP_User_Avatar_Functions') && defined('PPRESS_VERSION_NUMBER') && version_compare(PPRESS_VERSION_NUMBER,'3.0', '<')){
        $image = get_wp_user_avatar();
        if (!empty($image)) {
            preg_match_all( '@alt="([^"]+)"@' , $image, $match );
            $alt = array_pop($match);
            $alt = implode(" ", $alt);
            $alt = explode(" ", $alt);
            if(class_exists('transposh_plugin') && isset($_GET['lang']) && isset($alt[1]) ){
                $alt = 'alt=' . $alt[1];
            }
            elseif (isset($alt[0])) {
                $alt = 'alt=' . $alt[0];
            }
        }
    }
    ?>
        <div class="amp-author-image <?php echo esc_attr($author_image_wrapper); ?>">
            <amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?>src="<?php echo esc_url($author_avatar_url); ?>" <?php echo esc_attr($alt); ?> width="<?php echo esc_attr($avatar_size_width); ?>" height="<?php echo esc_attr($avatar_size_height); ?>" layout="fixed"></amp-img> 
        </div>
        <?php } ?>
        <?php echo '<div class="author-details '. esc_attr($author_wrapper_class) .'">';
        if ( true == ampforwp_get_setting('ampforwp-author-page-url') ){
            if ( function_exists('coauthors_posts_links') ) {
                if( $author_pub_name  ){
                    $author_link_ = $author_link;
                    if($is_author_link_amp==true && ampforwp_get_setting('ampforwp-archive-support')){
                        $author_link_ = ampforwp_url_controller($author_link);
                        if($author_link_)
                        {
                            echo '<span class="author-name">' .esc_html($author_prefix) . ' <a href="'. esc_url($author_link_).'" title="'. esc_html($author_name).'"> ' .esc_html( $author_name ).'</a></span>';  
                        }
                        else
                        {
                            echo $author_link; // this is html
                        }
                    }
                    echo ampforwp_yoast_twitter_handle();
                }
            }
            else {
                if( $author_pub_name  ){
                    if($is_author_link_amp==true && ampforwp_get_setting('ampforwp-archive-support')){
                        $author_link = ampforwp_url_controller($author_link);
                    }
                    echo '<span class="author-name">' .esc_html($author_prefix) . ' <a href="'. esc_url($author_link).'" title="'. esc_html($author_name).'"> ' .esc_html( $author_name ).'</a></span>';
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
                $author_description = "<p>".strip_tags($post_author->description,$allowed_tags)."</p>";
                $author_description = apply_filters( 'ampforwp_author_description', $author_description);
                echo $author_description;
            }
        } ?>
        </div>
    </div>
<?php 
    if(is_singular() && ( isset($args['ads_below_the_author']) && true == $args['ads_below_the_author'] )){
            do_action('ampforwp_below_author_box');
        }
    }