<?php get_header(); ?>

	<div id="contentwrap">
 		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
      <div class="<?php if($redux_builder_amp['enable-amp-ads-1'] == true) { ?> ad-1-wrapper <?php }?>">
        <?php if($redux_builder_amp['enable-single-post-meta'] == true) { ?>
          <div class="postmeta">
            <p>By <a href="#"> <?php the_author_meta( 'display_name' ); ?> </a> on <?php the_time( get_option( 'date_format' ) ) ?>   <span>Posted in <?php the_category( ', ' ) ?></span></p>
          </div>
         <?php } ?>
      </div>
        
		<div id="title">
			<h2><?php the_title(); ?></h2>
		</div>

		<div class="post"> 

  <div class="sticky_social">
    <amp-social-share type="twitter"
        width="50"
        height="28"> </amp-social-share>
    <amp-social-share type="gplus"
        width="50"
        height="28"></amp-social-share>
    <amp-social-share type="email"
        width="50"
        height="28"></amp-social-share>
    <amp-social-share type="pinterest"
        width="50"
        height="28"></amp-social-share>
    <amp-social-share type="linkedin"
        width="50"
        height="28"></amp-social-share>
    <amp-social-share type="facebook"
        width="50"
        height="28"></amp-social-share>
  </div>
  
  <?php echo isa_amp_featured_img(); ?>

      <?php if($redux_builder_amp['enable-amp-ads-3'] == true)  { ?>
        <div class="amp-ad-wrapper">
          <amp-ad class="amp-ad-3"
          <?php if($redux_builder_amp['enable-amp-ads-select-3'] == 1) : ?>
            width=300 height=250
          <?php elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 2) :?>
            width=336 height=280
          <?php elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 3) :?>
            width=728 height=90 
          <?php elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 4) :?>
            width=300 height=600
          <?php elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 5) :?>
            width=320 height=100
          <?php endif?>
            type="adsense"
            data-ad-client="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-client-3']; ?>"
            data-ad-slot="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-slot-3']; ?>">
          </amp-ad>  
        </div>
      <?php } ?>

      <?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
        <div class="sticky_social">          
          <?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
            <amp-social-share type="facebook"   width="50" height="28"></amp-social-share>
          <?php } ?>
          <?php if($redux_builder_amp['enable-single-twitter-share'] == true)  { ?>
            <amp-social-share type="twitter"    width="50" height="28"></amp-social-share>
          <?php } ?>
          <?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
            <amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
          <?php } ?>
          <?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
            <amp-social-share type="email"      width="50" height="28"></amp-social-share>
          <?php } ?>
          <?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
            <amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
          <?php } ?>
          <?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
            <amp-social-share type="linkedin"   width="50" height="28"></amp-social-share>
          <?php } ?>
        </div>
      <?php } ?>


			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<p>&after=</p>&next_or_number=number&pagelink=Page %' ); ?>

      <?php if($redux_builder_amp['enable-amp-ads-4'] == true) { ?>
        <div class="amp-ad-wrapper">
          <amp-ad class="amp-ad-4"
            <?php if($redux_builder_amp['enable-amp-ads-select-4'] == 1) : ?>
              width=300 height=250
            <?php elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 2) :?>
              width=336 height=280
            <?php elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 3) :?>
              width=728 height=90
            <?php elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 4) :?>
              width=300 height=600
            <?php elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 5) :?>
              width=320 height=100
            <?php endif?>
            type="adsense"
            data-ad-client="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-client-4']; ?>"
            data-ad-slot="<?php   echo $redux_builder_amp['enable-amp-ads-text-feild-slot-4']; ?>">
          </amp-ad>    
        </div>    
      <?php } ?>            

    </div>
    
		<div id="posttags">
			<p><?php the_tags( 'Tags: ', ', ' ); ?></p>
		</div>
		
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>

		<?php endwhile; ?>
		<?php endif;?>
 	</div>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php the_permalink(); ?>"
  },
  "headline": "Article headline",
  "image": {
    "@type": "ImageObject",

<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0];
?>
    "url": "<?php echo $thumb_url ?>",
    "height": 1024,
    "width": 1024
  },
  "datePublished": "<?php echo the_time('c'); ?>",
  "dateModified": "<?php echo the_time('c'); ?>",
  "author": {
    "@type": "Person",
    "name": "<?php the_author_meta( 'nickname', $author_id ); ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo get_bloginfo( 'name' ); ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php $site_logo = get_theme_mod('custom_logo'); echo wp_get_attachment_url($site_logo) ?>",
      "width": 600,
      "height": 60
    }
  },
  "description": "A most wonderful article"
}

 

</script>
<?php get_footer(); ?>
