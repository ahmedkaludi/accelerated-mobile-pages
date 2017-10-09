<?php 
function ampforwp_framework_get_social_icons($selected_social_icons){ 

	/* TODO: 
    1: Connect with options panel
	2: Add icons for email, line and whatsapp
	*/
	global $post, $redux_builder_amp;
	$twitter_url = '';
	$post_id = $post->ID;
	$desc = $post->post_excerpt; 
	 if (has_post_thumbnail( $post_id ) ){
	 	$thumb_id = get_post_thumbnail_id($post_id);
		$image = wp_get_attachment_image_src( $thumb_id, 'full' ); 
	 }
 	$social_icons_names = array();
	$url = get_the_permalink();
	$title = get_the_title();
	if(isset($redux_builder_amp['enable-single-twitter-share-link']) && $redux_builder_amp['enable-single-twitter-share-link']){
		$twitter_url = get_the_permalink();
	}
	else
		$twitter_url = wp_get_shortlink();
	foreach ($selected_social_icons as $key => $value) {
	 	$social_icons_names[] = $key;	 
	 }
	 if($selected_social_icons['twitter'] == null){
	 	$selected_social_icons['twitter'] = 'https://twitter.com/intent/tweet?url='. $twitter_url.'&text='. $title .' ';
	 	//https://twitter.com/intent/tweet?url={url}&text={title}&via={via}&hashtags={hashtags}
	 }
	 if($selected_social_icons['facebook'] == null){
	 	$selected_social_icons['facebook'] = 'https://www.facebook.com/sharer.php?u='. $url. '';
	 	//or https://www.facebook.com/dialog/share?app_id={app_id}&display=page&href={url}&redirect_uri={redirect_url}
	 }
	 if($selected_social_icons['pinterest'] == null){
	 	$selected_social_icons['pinterest'] = 'https://pinterest.com/pin/create/bookmarklet/?media='.$image.' &url='. $url.'&description='. $title .'';
	 	//https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}&is_video={is_video}&description={title}
	 }
	 if($selected_social_icons['google-plus'] == null){
	 	$selected_social_icons['google-plus'] = 'https://plus.google.com/share?url='. $url. '';
	 	//https://plus.google.com/share?url={url}
	 }
	 if($selected_social_icons['linkedin'] == null){
	 	$selected_social_icons['linkedin'] = 'https://www.linkedin.com/shareArticle?url='. $url. '&title='. $title .'';
	 	//https://www.linkedin.com/shareArticle?url={url}&title={title}
	 }

	 if($selected_social_icons['reddit'] == null){
	 	$selected_social_icons['reddit'] = 'https://reddit.com/submit?url='. $url. '&title='. $title .'';
	 	//https://reddit.com/submit?url={url}&title={title}
	 }
	 if($selected_social_icons['VKontakte'] == null){
	 	$selected_social_icons['VKontakte'] = 'http://vk.com/share.php?url='. $url. '';
	 	//http://vk.com/share.php?url={url}
	 }
	 
	 if($selected_social_icons['tumblr'] == null){
	 	$selected_social_icons['tumblr'] = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl='. $url. '&title='. $title .'&caption='.$desc.'';
	 	//https://www.tumblr.com/widgets/share/tool?canonicalUrl={url}&title={title}&caption={desc}
	 }
 
	 	 ?>	
	<div class="amp-social">
	     <ul>
	        <?php if( in_array( 'twitter' , $selected_social_icons,true)  || in_array('twitter', $social_icons_names,true)  ) { ?> 
	        <a href="<?php echo $selected_social_icons['twitter']  ?>" target ="_blank"><li class="icon-twitter"></li></a>
	        <?php } ?>

	        <?php if( in_array('facebook', $selected_social_icons,true) || in_array('facebook', $social_icons_names,true)) { ?>
	        <a href="<?php echo $selected_social_icons['facebook']  ?>" target ="_blank"><li class="icon-facebook"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'pinterest' , $selected_social_icons,true ) || in_array( 'pinterest', $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['pinterest']  ?>" target ="_blank"><li class="icon-pinterest"></li></a>
	        <?php } ?>

	        <?php if( in_array( 'google-plus' , $selected_social_icons,true ) || in_array( 'google-plus' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['google-plus']  ?>" target ="_blank"><li class="icon-google-plus"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'linkedin' , $selected_social_icons,true ) || in_array( 'linkedin' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['linkedin']  ?>" target ="_blank"><li class="icon-linkedin"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'youtube' , $selected_social_icons,true ) || in_array( 'youtube' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['youtube']  ?>" target ="_blank"><li class="icon-youtube-play"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'instagram' , $selected_social_icons,true ) || in_array( 'instagram' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['instagram']  ?>" target ="_blank">  <li class="icon-instagram"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'reddit' , $selected_social_icons,true ) || in_array( 'reddit' , $social_icons_names,true ) ) { ?> 
	        <a href="<?php echo $selected_social_icons['reddit']  ?>" target ="_blank"><li class="icon-reddit-alien"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'VKontakte' , $selected_social_icons,true ) || in_array( 'VKontakte' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['VKontakte']  ?>" target ="_blank"><li class="icon-vk"></li></a>
	        <?php } ?> 

	        <?php if( in_array( 'snapchat' , $selected_social_icons,true ) || in_array( 'snapchat' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['snapchat']  ?>" target ="_blank"><li class="icon-snapchat-ghost"></li></a>
	        <?php } ?> 

 			<?php if( in_array( 'tumblr' , $selected_social_icons,true ) || in_array( 'tumblr' , $social_icons_names,true ) ) { ?>
	        <a href="<?php echo $selected_social_icons['tumblr']  ?>" target ="_blank"><li class="icon-tumblr"></li></a>
	        <?php } ?> 
	        </ul>
	  	</div>	
<?php 
}
//Load styling for social icons
add_action('amp_post_template_css','amp_social_styles',11); 
function amp_social_styles(){ ?>

/* Social icons */
@font-face {
  font-family: 'icomoon';
  src:  url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.eot?b9qrme');
  src:  url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.eot?b9qrme#iefix') format('embedded-opentype'),
    url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.ttf?b9qrme') format('truetype'),
    url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.woff?b9qrme') format('woff'),
    url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.svg?b9qrme#icomoon') format('svg');
  font-weight: normal;
  font-style: normal;
}

[class^="icon-"], [class*=" icon-"]{ font-family: 'icomoon'; speak: none; font-style: normal; font-weight: normal; font-variant: normal; text-transform: none; line-height: 1;

  /* Better Font Rendering =========== */
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
.amp-social{ font-size: 15px; display: inline-block; }
.amp-social ul{ list-style-type:none; padding:0;margin:0; text-align:center }
.amp-social li{ box-sizing: initial; display:inline-block; }
.amp-social li:before{ box-sizing: initial; color:#fff; padding: 6px; display: inline-block; border-radius: 70px; width: 18px; height: 18px; line-height: 20px; text-align: center; }

<?php }