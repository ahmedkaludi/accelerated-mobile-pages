<div class="amp-wp-article-header amp-wp-article-category ampforwp-meta-taxonomy ">
<?php	global $redux_builder_amp;
			$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
		<?php do_action('ampforwp_before_meta_taxonomy_hook',$this); ?>
		<div class="amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
				<?php
				//if RTL is OFF
				if(!$redux_builder_amp['amp-rtl-select-option']) {
						 global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'] .' ', 'accelerated-mobile-pages' ));
							}

				foreach ($ampforwp_tags as $tag) {
				if( isset($redux_builder_amp['ampforwp-archive-support']) && $redux_builder_amp['ampforwp-archive-support'] && isset($redux_builder_amp['ampforwp-cats-tags-links-single']) && $redux_builder_amp['ampforwp-cats-tags-links-single']) {
					   echo ('<span class="amp-tag-'.$tag->term_id.'"><a href="'. user_trailingslashit( trailingslashit( get_tag_link( $tag->term_id ) ) . 'amp' ) . '" >'.$tag->name .'</a></span>');//#934
          		} else {
                      echo ('<span>'.$tag->name .'</span>');
          			}
				}

				//if RTL is ON
				if($redux_builder_amp['amp-rtl-select-option']) {
						 global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'] .' ', 'accelerated-mobile-pages' ));
							}
				?>

		</div>
<?php endif;?>
</div>

<?php

if( array_key_exists( 'amp-author-description' , $redux_builder_amp ) && is_single() ) {
	if( $redux_builder_amp['amp-author-description'] ) { ?>
	<div class="amp-wp-content amp_author_area ampforwp-meta-taxonomy">
	    <div class="amp_author_area_wrapper">
	        <?php $post_author = $this->get( 'post_author' );
	            if ( $post_author ) {
	            	//If Avatar is set up in WP user avatar: grab it
	            	$author_avatar_url = ampforwp_get_wp_user_avatar();
	            	//Else : Get the Gravatar
	            	if($author_avatar_url == null){
	            		$author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 70 ) );
	            	}
	                if ( $author_avatar_url ) { ?>
	                    <amp-img src="<?php echo $author_avatar_url; ?>" width="70" height="70" layout="fixed"></amp-img>
	                    <?php
	                } ?>
	                <strong><?php echo esc_html( $post_author->display_name ); ?></strong>: <?php echo  $post_author->description ; ?>

	        <?php } ?>
	    </div>
	</div> <?php
	}
}

do_action('ampforwp_after_meta_taxonomy_hook',$this);