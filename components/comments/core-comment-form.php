<?php
if(ampforwp_get_setting('ampforwp-facebook-comments-support')==false && ampforwp_get_setting('ampforwp-disqus-comments-support')==false && ampforwp_get_setting('ampforwp-vuukle-comments-support')==false && ampforwp_get_setting('ampforwp-spotim-comments-support')==false){
	if(ampforwp_get_setting('ampforwp-cmt-section_core') == 1 && comments_open()){
		add_action('ampforwp_before_comment_hook_core','ampforwp_comment_form_core');
	}
	else{
		if( ampforwp_get_setting('ampforwp-cmt-section_core') == 2 && comments_open()) {
			add_action('ampforwp_after_comment_hook_core','ampforwp_comment_form_core');
		}
}
}
function ampforwp_comment_form_core( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$login_url = ampforwp_findInternalUrl(get_permalink( $post_id ));

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' .  esc_html__( ampforwp_get_setting('amp-comments-translator-name-text_core'), 'accelerated-mobile-pages') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' .  esc_html__( ampforwp_get_setting('amp-comments-translator-email-text_core'), 'accelerated-mobile-pages') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' .  esc_html__( ampforwp_get_setting('amp-comments-translator-website-text_core'), 'accelerated-mobile-pages') . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
	);

	$required_text = sprintf( ' ' . esc_html__( ampforwp_get_setting('amp-comments-translator-required-fields-text_core'), 'accelerated-mobile-pages') . '%s', '<span class="required">*</span>' );
	$nonce = wp_create_nonce( "ampforwp_comment_publish" );
	$submit_url =  admin_url('admin-ajax.php?action=amp_comment_submit');
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p [class]="formData.submit.success" class="comment-form-comment"><label for="comment">' . esc_html__( ampforwp_get_setting('amp-comments-translator-Comment-text_core'), 'accelerated-mobile-pages') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>
		<input type="hidden" name="amp_cptch_hidden" value="1" ><input type="hidden" name="amp_cmnt_nonce" value="'.$nonce.'">',

		'must_log_in'          => '<p class="must-log-in">' . sprintf('You must be <a href="%s">logged in</a> to post a comment.',
		                              esc_url(wp_login_url( apply_filters( 'the_permalink', $login_url )),'accelerated-mobile-pages')
		                          ) . '</p>',

		'logged_in_as'         => '<p [class]="formData.submit.success" class="logged-in-as">' . sprintf(
		                               '<a href="%s" aria-label="%s">'.ampforwp_get_setting('amp-comments-translator-loggedin-text_core').' %s</a>. <a href="%s">'. ampforwp_get_setting('amp-comments-translator-logout-text_core') .'?</a>',
		                              esc_url(get_edit_user_link(),'accelerated-mobile-pages'),
		                              sprintf('Logged in as %s. Edit your profile.', esc_html__($user_identity,'accelerated-mobile-pages')),
		                              esc_html__($user_identity,'accelerated-mobile-pages'),
		                              esc_url(wp_logout_url( apply_filters( 'the_permalink', $login_url ) ),'accelerated-mobile-pages')
		                          ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' .  	esc_html__( ampforwp_get_setting('amp-comments-translator-your-email-address-text_core'), 'accelerated-mobile-pages') . '</span>'. ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'action'               => $submit_url,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_form'           => 'comment-form',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'title_reply'          => ampforwp_get_setting('amp-comments-translator-leave-a-reply_core'),
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s','accelerated-mobile-pages' ),
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h3>',
		'cancel_reply_before'  => ' <small>',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => esc_html__( ampforwp_get_setting('amp-comments-translator-cancel-reply-text_core'), 'accelerated-mobile-pages'),
		'label_submit'         => esc_html__( ampforwp_get_setting('amp-comments-translator-post-comment-text_core'), 'accelerated-mobile-pages'),
		'submit_button'        => '<input on="tap:amp-comment-body.hide,reply-title.hide" name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" role="submit" tabindex="2"/>',
		'submit_field'         => '<p id="ampCommentsButton" [class]="formData.submit.success" class="form-submit">%1$s %2$s</p>',
		'format'               => 'xhtml',
	);

	
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	$args = array_merge( $defaults, $args );

	if ( comments_open( $post_id ) ) : ?>
		<?php
	
		$submit_url = $args['action'].'?amp';
		$actionXhrUrl = preg_replace('#^https?:#', '', $submit_url);

		do_action( 'comment_form_before' );
		?>
		<div id="respond" class="comment-respond ampforwp-comments amp-wp-content">
			<?php
			echo $args['title_reply_before'];

			comment_form_title( $args['title_reply'], $args['title_reply_to'] );

			echo $args['cancel_reply_before'];

			echo $args['cancel_reply_after'];

			echo $args['title_reply_after'];

			if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
				echo $args['must_log_in'];
				
				do_action( 'comment_form_must_log_in_after' );
			else : ?>
				<form action-xhr="<?php echo esc_url( $actionXhrUrl ); ?>" target="_top" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>"  on="submit-error:AMP.setState({FormData: submit.success})" >
				<div id="amp-comment-body">
					<?php
				
					do_action( 'comment_form_top' );

					if ( is_user_logged_in() ) :
					
						echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

					
						do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

					else :

						echo $args['comment_notes_before'];

					endif; 
			
					$comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];
				
					$comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

			
					$comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

			
					$first_field = reset( $comment_field_keys );
					$last_field  = end( $comment_field_keys );

					foreach ( $comment_fields as $name => $field ) {

						if ( 'comment' === $name ) {

		
							echo apply_filters( 'comment_form_field_comment', $field );

							echo $args['comment_notes_after'];

						} elseif ( ! is_user_logged_in() ) {

							if ( $first_field === $name ) {
							
								do_action( 'comment_form_before_fields' );
							}

						
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

							if ( $last_field === $name ) {
							
								do_action( 'comment_form_after_fields' );
							}
						}
					}

					$submit_button = sprintf(
						$args['submit_button'],
						esc_attr( $args['name_submit'] ),
						esc_attr( $args['id_submit'] ),
						esc_attr( $args['class_submit'] ),
						esc_attr( $args['label_submit'] )
					);

					$submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

					$submit_field = sprintf(
						$args['submit_field'],
						$submit_button,
						get_comment_id_fields( $post_id )				
					);
				
					echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

					?>
			 
					<input type="hidden" name="comment_parent" id="comment_parent" [value]="amp_comment_parent">
				</div>
					<div submit-success>
						<template type="amp-mustache">
							{{response}}
						</template>
					</div>					 
					<div submit-error>
						<template type="amp-mustache">
					  	{{response}}
						</template>
					</div>
		</form>


			<?php endif; ?>
		</div><!-- #respond -->
		<?php
		
		do_action( 'comment_form_after' );
	else :
		do_action( 'comment_form_comments_closed' );
	endif;
}