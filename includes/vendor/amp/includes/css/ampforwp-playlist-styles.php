<?php
add_action('amp_post_template_css','ampforwp_playlist');
function ampforwp_playlist(){ ?>
.amp-carousel-slide .wp-playlist-current-item{display: inline-flex;align-items: center;margin-bottom: 20px;}
.amp-carousel-slide .wp-playlist-caption{margin-left:20px;}
 .amp-carousel-slide{background: #ccc;padding: 10px;border-radius: 3px;box-sizing: border-box;}
.wp-playlist-tracks{background: #f1f1f1;width: 100%;margin-top: 10px;padding: 30px;margin-bottom:20px;box-sizing: border-box;}
.wp-playlist-item{margin-bottom:15px;font-size: 16px;line-height: 1.4;}
.wp-playlist-item a{color:#333;}
.amp-carousel-slide amp-audio audio{width:100%;}
.wp-playlist-caption{cursor: pointer;} 
.wp-playlist-item.wp-playlist-playing, .wp-playlist-item.wp-playlist-playing a{color:#00b900;}
@media(max-width:500px){
	.wp-playlist-tracks {padding:20px;}
}
<?php }