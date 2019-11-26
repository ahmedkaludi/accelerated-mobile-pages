<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
if (!comments_open() || $redux_builder_amp['ampforwp-disqus-comments-support'] || $redux_builder_amp['ampforwp-facebook-comments-support']) {
  return;
} ?>

<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
	<div class="comment-button-wrapper ampforwp-comment-button">
			<a href="<?php echo esc_url(ampforwp_comment_button_url()); ?>" rel="nofollow"><?php echo esc_attr(ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment' )); ?></a>
	</div>
<?php } ?>