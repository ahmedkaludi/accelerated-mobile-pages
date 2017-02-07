<div class="amp-wp-content amp-wp-article-tags amp-wp-article-category ampforwp-meta-taxonomy ">
<?php	global $redux_builder_amp;
			$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
		<div class="amp-wp-meta amp-wp-content ampforwp-tax-tag">
				<?php foreach ($ampforwp_tags as $tag) {
						echo '<span>'. $tag->name .'</span>';
				} ?>
		</div>
<?php endif;?>
</div>
<div class="amp-wp-content amp_author_area">
<div class="amp-wp-content amp_author_area_wrapper">
    <?php $post_author = $this->get( 'post_author' ); ?>
    <?php if ( $post_author ) : 
        $string = get_avatar($post_author->user_email);
        $token = strtok($string, " ");
        $token = strtok(" ");
        $token = strtok(" "); ?>
        <?php if ( function_exists( 'get_avatar_url' ) ) : ?>
        <amp-img <?php echo $token; ?> width="70" height="70" layout="fixed"></amp-img>
        <?php endif; ?>
        <strong><?php echo esc_html( $post_author->display_name ); ?></strong>: <?php echo esc_html( $post_author->description ); ?>
    <?php endif; ?>    
</div>
</div>