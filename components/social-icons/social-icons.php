<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_framework_get_social_icons($selected_social_icons){

	/* TODO: 
    1: Connect with options panel
	2: Add icons for email, line and whatsapp
	*/
	global $post, $redux_builder_amp;
	$twitter_url 	= '';
	$thumb_id 		= '';
	$image 			= '';
	$post_id = $post->ID;
	$desc = $post->post_excerpt; 
	 if (ampforwp_has_post_thumbnail( $post_id ) ){
	 	$image = ampforwp_get_post_thumbnail( 'url', 'full' );
	 }

	if(!ampforwp_is_associative($selected_social_icons)){
		$icons_list_temp = array();
		foreach ($selected_social_icons as $key => $icons) {
			$icons_list_temp[$icons] = ''; 
		}
		$selected_social_icons = $icons_list_temp;
	}

 	$social_icons_names = array();
	$url = get_the_permalink();
	$title = esc_attr( rawurlencode( get_the_title() ) );
	if(false == ampforwp_get_setting('enable-single-twitter-share-link')){
		$twitter_url = get_the_permalink();
	}
	else
		$twitter_url = wp_get_shortlink();
	foreach ($selected_social_icons as $key => $value) {
	 	$social_icons_names[] = $key;	 
	 }
	

	if( isset($selected_social_icons['twitter'] ) && null == $selected_social_icons['twitter'] ){
	 	$selected_social_icons['twitter'] = 'https://twitter.com/intent/tweet?url='. $twitter_url.'&text='. $title .' ';
	 	//https://twitter.com/intent/tweet?url={url}&text={title}&via={via}&hashtags={hashtags}
	}

	if( isset($selected_social_icons['facebook'] ) && null == $selected_social_icons['facebook'] ){
	 	$selected_social_icons['facebook'] = 'https://www.facebook.com/sharer.php?u='. $url. '';
	 	//or https://www.facebook.com/dialog/share?app_id={app_id}&display=page&href={url}&redirect_uri={redirect_url}
	}
	if( isset($selected_social_icons['pinterest'] ) && null == $selected_social_icons['pinterest'] ){
	 	$selected_social_icons['pinterest'] = 'https://pinterest.com/pin/create/bookmarklet/?media='.$image.'&url='.$url.'&description='.$title.'';
	 	//https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}&is_video={is_video}&description={title}
	}
	if( isset($selected_social_icons['linkedin']) && $selected_social_icons['linkedin'] == null){
	 	$selected_social_icons['linkedin'] = 'https://www.linkedin.com/shareArticle?url='. $url. '&title='. $title .'';
	 	//https://www.linkedin.com/shareArticle?url={url}&title={title}
	}

	if( isset($selected_social_icons['reddit']) && $selected_social_icons['reddit'] == null){
	 	$selected_social_icons['reddit'] = 'https://reddit.com/submit?url='. $url. '&title='. $title .'';
	 	//https://reddit.com/submit?url={url}&title={title}
	}
	if( isset($selected_social_icons['VKontakte']) && $selected_social_icons['VKontakte'] == null){
	 	$selected_social_icons['VKontakte'] = 'https://vk.com/share.php?url='. $url. '';
	 	//http://vk.com/share.php?url={url}
	}
	if( isset($selected_social_icons['Odnoklassniki']) && $selected_social_icons['Odnoklassniki'] == null){
	 	$selected_social_icons['Odnoklassniki'] = 'https://ok.ru/dk?st.cmd=addShare&st._surl='. $url. '';
	}
	
	if( isset($selected_social_icons['tumblr']) && $selected_social_icons['tumblr'] == null){
	 	$selected_social_icons['tumblr'] = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl='. $url. '&title='. $title .'&caption='.$desc.'';
	 	//https://www.tumblr.com/widgets/share/tool?canonicalUrl={url}&title={title}&caption={desc}
	}
	if ( isset($selected_social_icons['telegram']) && null == $selected_social_icons['telegram'] ) {
	 	$selected_social_icons['telegram'] = 'https://telegram.me/share/url?url='. $url. '&text='. $title .'';
	 	//https://telegram.me/share/url?url={url}&text={title}
	}
	if ( isset($selected_social_icons['StumbleUpon']) && null == $selected_social_icons['StumbleUpon'] ) {
	 	$selected_social_icons['StumbleUpon'] = 'http://www.stumbleupon.com/submit?url='. $url. '&title='. $title .'';
	 	//http://www.stumbleupon.com/submit?url={url}&title={title}
	}
	if ( isset($selected_social_icons['Wechat']) && null == $selected_social_icons['Wechat'] ) {
	 	$selected_social_icons['Wechat'] = 'http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url='. $url. '';
	 	// http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url={url}
	}
	if ( isset($selected_social_icons['Viber']) && null == $selected_social_icons['Viber'] ) {
	 	$selected_social_icons['Viber'] = 'viber://forward?text='. $url. '';
	 	//viber://forward?text={url}
	}
 
	 	 ?>	
	<?php do_action('ampforwp_before_social_icons_hook'); ?>
	<div class="a-so">
	     <ul>
	        <?php if( ( in_array( 'twitter' , $selected_social_icons,true)  || in_array('twitter', $social_icons_names,true) ) && !empty($selected_social_icons['twitter'])  ) { ?> 
	        <a href="<?php echo esc_url($selected_social_icons['twitter'])  ?>" target ="_blank"><li class="icon-twitter"></li></a>
	        <?php } ?>

	        <?php if( (in_array('facebook', $selected_social_icons,true) || in_array('facebook', $social_icons_names,true)) && !empty($selected_social_icons['facebook']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['facebook'])  ?>" target ="_blank"><li class="icon-facebook"></li></a>
	        <?php } ?> 

	        <?php if( ( in_array( 'pinterest' , $selected_social_icons,true ) || in_array( 'pinterest', $social_icons_names,true )) && !empty($selected_social_icons['pinterest']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['pinterest'])  ?>" target ="_blank"><li class="icon-pinterest"></li></a>
	        <?php } ?>

	        <?php if( (in_array( 'linkedin' , $selected_social_icons,true ) || in_array( 'linkedin' , $social_icons_names,true )) && !empty($selected_social_icons['linkedin']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['linkedin'])  ?>" target ="_blank"><li class="icon-linkedin"></li></a>
	        <?php } ?> 

	        <?php if( (in_array( 'youtube' , $selected_social_icons,true ) || in_array( 'youtube' , $social_icons_names,true )) && !empty($selected_social_icons['youtube']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['youtube'])  ?>" target ="_blank"><li class="icon-youtube-play"></li></a>
	        <?php } ?> 

	        <?php if( (in_array( 'instagram' , $selected_social_icons,true ) || in_array( 'instagram' , $social_icons_names,true )) && !empty($selected_social_icons['instagram']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['instagram'])  ?>" target ="_blank">  <li class="icon-instagram"></li></a>
	        <?php } ?> 

	        <?php if( ( in_array( 'reddit' , $selected_social_icons,true ) || in_array( 'reddit' , $social_icons_names,true )) && !empty($selected_social_icons['reddit']) ) { ?> 
	        <a href="<?php echo esc_url($selected_social_icons['reddit'])  ?>" target ="_blank"><li class="icon-reddit-alien"></li></a>
	        <?php } ?> 

	        <?php if( ( in_array( 'VKontakte' , $selected_social_icons,true ) || in_array( 'VKontakte' , $social_icons_names,true ) ) && !empty($selected_social_icons['VKontakte']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['VKontakte'])  ?>" target ="_blank"><li class="icon-vk"></li></a>
	        <?php } ?>

	        <?php if( ( in_array( 'Odnoklassniki' , $selected_social_icons,true ) || in_array( 'Odnoklassniki' , $social_icons_names,true ) ) && !empty($selected_social_icons['Odnoklassniki']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['Odnoklassniki'])  ?>" target ="_blank"><li class="icon-Odnoklassniki"></li></a>
	        <?php } ?>  

	        <?php if( (in_array( 'snapchat' , $selected_social_icons,true ) || in_array( 'snapchat' , $social_icons_names,true ) ) && !empty($selected_social_icons['snapchat']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['snapchat'])  ?>" target ="_blank"><li class="icon-snapchat-ghost"></li></a>
	        <?php } ?> 

 			<?php if( (in_array( 'tumblr' , $selected_social_icons,true ) || in_array( 'tumblr' , $social_icons_names,true )) && !empty($selected_social_icons['tumblr']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['tumblr'])  ?>" target ="_blank"><li class="icon-tumblr"></li></a>
	        <?php } ?>

	        <?php if ( (in_array( 'telegram' , $selected_social_icons,true ) || in_array( 'telegram' , $social_icons_names,true )) && ! empty($selected_social_icons['telegram']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['telegram']); ?>" target ="_blank"><li class="icon-telegram"></li></a>
	        <?php } ?> 

	        <?php if ( (in_array( 'StumbleUpon' , $selected_social_icons,true ) || in_array( 'StumbleUpon' , $social_icons_names,true )) && ! empty($selected_social_icons['StumbleUpon']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['StumbleUpon']); ?>" target ="_blank"><li class="icon-StumbleUpon"></li></a>
	        <?php } ?> 

	        <?php if ( (in_array( 'Wechat' , $selected_social_icons,true ) || in_array( 'Wechat' , $social_icons_names,true )) && !empty($selected_social_icons['Wechat']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['Wechat']); ?>" target ="_blank"><li class="icon-Wechat"></li></a>
	        <?php } ?> 

	        <?php if ( (in_array( 'Viber' , $selected_social_icons,true ) || in_array( 'Viber' , $social_icons_names,true )) && ! empty($selected_social_icons['Viber']) ) { ?>
	        <a href="<?php echo esc_url($selected_social_icons['Viber']); ?>" target ="_blank"><li class="icon-Viber"></li></a>
	        <?php } ?> 

	        <?php if( (in_array( 'facebook-like' , $selected_social_icons,true ) || in_array( 'facebook-like' , $social_icons_names,true ))  ) { ?>
	        	<amp-facebook-like width=90 height=28
				 	layout="fixed"
				 	data-size="large"
				    data-layout="button_count"
				    data-href="<?php echo esc_url(get_the_permalink()); ?>">
				</amp-facebook-like>
	        <?php } ?> 
	        </ul>
	  	</div>
	  	<?php do_action('ampforwp_after_social_icons_hook'); ?>	
<?php 
}

function ampforwp_is_associative(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}
//Load styling for social icons

add_action('amp_post_template_css','amp_social_styles',11); 


function amp_social_styles(){ 
$icon_url = plugin_dir_url(__FILE__);
$icon_url = ampforwp_font_url($icon_url);
?>
@font-face {
  font-family: 'icomoon';
  font-display: swap;
  src:  url('<?php echo esc_url($icon_url) ?>fonts/icomoon.eot');
  src:  url('<?php echo esc_url($icon_url) ?>fonts/icomoon.eot') format('embedded-opentype'),
    url('<?php echo esc_url($icon_url) ?>fonts/icomoon.ttf') format('truetype'),
    url('<?php echo esc_url($icon_url) ?>fonts/icomoon.woff') format('woff'),
    url('<?php echo esc_url($icon_url) ?>fonts/icomoon.svg') format('svg');
  font-weight: normal;
  font-style: normal;
}

[class^="icon-"], [class*=" icon-"]{ font-family: 'icomoon'; speak: none; font-style: normal; font-weight: normal; font-variant: normal; text-transform: none; line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.icon-twitter:before{ content: "\f099";background:#1da1f2 }
.icon-facebook:before{ content: "\f09a";background:#3b5998 }
.icon-facebook-f:before{ content: "\f09a";background:#3b5998 }
.icon-pinterest:before{ content: "\f0d2";background:#bd081c }
.icon-google-plus:before{ content: "\f0d5";background:#dd4b39 }
.icon-linkedin:before{ content: "\f0e1";background:#0077b5 }
.icon-youtube-play:before{ content: "\f16a";background:#cd201f }
.icon-instagram:before{ content: "\f16d";background:#c13584 }
.icon-tumblr:before{ content: "\f173";background:#35465c }
.icon-vk:before{ content: "\f189";background:#45668e }
.icon-whatsapp:before{ content: "\f232";background:#075e54 }
.icon-reddit-alien:before{ content: "\f281";background:#ff4500 }
.icon-snapchat-ghost:before{ content: "\f2ac"; background:#fffc00 }
.a-so{ font-size: 15px; display: inline-block; }
.a-so ul{ list-style-type:none; padding:0;margin:0; text-align:center }
.a-so li{ box-sizing: initial; display:inline-block; }
.a-so li:before{box-sizing: initial;color: #fff;display: inline-block;width: 18px;height: 18px;line-height: 18px;}
amp-facebook-like{top:8px;}

<?php }