<!doctype html>
    <html lang="en" prefix="op: http://media.facebook.com/op#">
    <?php global $redux_builder_amp; ?>
    <head>
      <meta charset="utf-8">
      <link rel="canonical" href="<?php the_permalink(); ?>">
      <meta property="op:markup_version" content="v1.0">
      <?php if (isset($redux_builder_amp['fb-instant-article-ads']) && $redux_builder_amp['fb-instant-article-ads'] ){ ?>
        <!-- automatic ad placement -->
        <meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=<?php echo esc_attr(ampforwp_get_ia_ad_density()); ?>">
      <?php } ?>
      <?php if ( isset($redux_builder_amp['fbia-header-text-area']) && $redux_builder_amp['fbia-header-text-area'] ) {
          echo $redux_builder_amp['fbia-header-text-area'];
      }do_action('ampforwp_fbia_head');?>
    </head>
    <body>
        <article>
            <header>
                <!-- title -->
        <h1><?php the_title(); ?></h1>
        <?php if ( function_exists('tie_get_postdata') && tie_get_postdata( 'tie_post_sub_title' ) ) { ?>
                <!-- Subtitle -->
        <h2><?php echo esc_html(tie_get_postdata( 'tie_post_sub_title' )); ?></h2>
        <?php } ?>
        <!-- kicker -->
        <h3 class="op-kicker">
                   <?php $categories = get_the_category();
                   if ( ! empty( $categories ) ) {
                       echo esc_html( $categories[0]->name );   
                    } ?>
                </h3>

                <!-- publication date/time -->
        <time class="op-published" datetime="<?php echo get_the_date("c"); ?>"><?php echo get_the_date(get_option('date_format') . ", " . get_option('time_format')); ?></time>

        <!-- modification date/time -->
        <time class="op-modified" datetime="<?php echo get_the_modified_date("c"); ?>"><?php echo get_the_modified_date(get_option('date_format') . ", " . get_option('time_format')); ?></time>
        <?php if ( true == $redux_builder_amp['ampforwp-instant-article-author-meta'] ) { ?>
          <!-- author(s) -->
            <address>
                <a><?php the_author_meta('display_name'); ?></a>
            </address>
        <?php } ?>
        <!-- cover -->
        <?php if(has_post_thumbnail($post->ID)):
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
          $attachment = get_post(get_post_thumbnail_id($post->ID));
          $thumbnail_url = $thumb[0];
        ?>
                    <figure>
                        <img src="<?php echo esc_url($thumbnail_url); ?>" />
                        <?php if (strlen(apply_filters("the_content", $attachment->post_excerpt)) > 0):
                            if ( $attachment->post_excerpt ) { ?>
                                <figcaption><?php echo apply_filters("the_content", $attachment->post_excerpt); ?></figcaption>
                                <?php 
                            }
                        endif; ?>
                    </figure>
        <?php endif; ?>
                <?php if (isset($redux_builder_amp['fb-instant-article-ads']) && $redux_builder_amp['fb-instant-article-ads'] ){
                  if(isset($redux_builder_amp['fb-instant-article-ad-type']) && '1' === $redux_builder_amp['fb-instant-article-ad-type']){
                        if(isset($redux_builder_amp['fb-instant-article-ad-id']) && $redux_builder_amp['fb-instant-article-ad-id']){ ?>
                            <!-- facebook audience network ad -->
                            <figure class="op-ad">
                                <iframe width="300" height="250" style="border:0; margin:0;" src="https://www.facebook.com/adnw_request?placement=<?php echo esc_attr(ampforwp_get_ia_placement_id()); ?>&adtype=banner300x250"></iframe>
                            </figure>
                    <?php } }
                    elseif(isset($redux_builder_amp['fb-instant-article-ad-type']) && '2' === $redux_builder_amp['fb-instant-article-ad-type']){
                          $custom_iframe_url = '';
                          if(isset($redux_builder_amp['fb-instant-article-custom-iframe-ad']) && !empty($redux_builder_amp['fb-instant-article-custom-iframe-ad'])){
                            $custom_iframe_url = $redux_builder_amp['fb-instant-article-custom-iframe-ad'];
                          } ?>
                            <!-- facebook custom iframe ad -->
                            <figure class="op-ad">
                                <iframe width="300" height="250" style="border:0; margin:0;" src="<?php echo esc_url($custom_iframe_url); ?>"></iframe>
                            </figure>
                   <?php }
                  elseif(isset($redux_builder_amp['fb-instant-article-ad-type']) && '3' === $redux_builder_amp['fb-instant-article-ad-type']){
                          $custom_iframe_url = '';
                          if(isset($redux_builder_amp['fb-fb-instant-article-custom-embed-ad']) && !empty($redux_builder_amp['fb-instant-article-custom-embed-ad'])){
                            $custom_iframe_url = $redux_builder_amp['fb-instant-article-custom-embed-ad'];
                          } ?>
                            <!-- facebook custom embed ad -->
                            <figure class="op-ad">
                                <iframe width="300" height="250" style="border:0; margin:0;"><?php echo $redux_builder_amp['fb-instant-article-custom-embed-ad']; ?></iframe>
                            </figure>
                   <?php } } ?>
            </header>

            <!-- body -->
            <?php if ( isset($redux_builder_amp['fbia-body-text-area']) && $redux_builder_amp['fbia-body-text-area'] ) {
              echo $redux_builder_amp['fbia-body-text-area'];
            }do_action('ampforwp_fbia_body');?>
            <?php
            global $more;
            // Make it 1 to allow the full article
            $more = 1; 
            echo apply_filters('ampforwp_fbia_content', apply_filters('the_content', get_the_content())); ?>
            <?php if (isset($redux_builder_amp['fb-instant-article-analytics']) && $redux_builder_amp['fb-instant-article-analytics'] ){
                  if(isset($redux_builder_amp['fb-instant-article-analytics-code']) && $redux_builder_amp['fb-instant-article-analytics-code'] ) {?>
                      <!-- Analytics code -->
                          <figure class="op-tracker">
                            <iframe>
                              <?php echo ampforwp_get_ia_analytics_code(); ?>
                            </iframe>
                          </figure>
            <?php } } ?>
            <footer>
              <?php if ( isset($redux_builder_amp['fbia-footer-text-area']) && $redux_builder_amp['fbia-footer-text-area'] ) {
                  echo $redux_builder_amp['fbia-footer-text-area'];
              }do_action('ampforwp_fbia_footer');?>
              <?php if( isset($redux_builder_amp['ampforwp-ia-related-articles']) && true == $redux_builder_amp['ampforwp-ia-related-articles'] ) {
                if ( ! empty( $categories ) ) { 
                  $categories_ids = wp_list_pluck( $categories, 'term_id' );
                  // Get the four latest posts.
                  $query_args = array(
                    'category__in'           => $categories_ids,
                    'post__not_in'           => array( get_the_ID() ),
                    'posts_per_page'         => 4, // FB uses 4 related articles.
                    'ignore_sticky_posts'    => true, // Turn off sticky posts.
                    'order'                  => 'DESC',
                    'orderby'                => 'date',
                    'no_found_rows'          => true,
                    'post_type'              => get_post_type(),
                    'post_status'            => 'publish',
                  );
                }
                $query_args = apply_filters('ampforwp_ia_related_articles_query_args', $query_args);
                $related_articles_loop = new WP_Query( $query_args );
                $related_articles = $related_articles_loop->get_posts();
                if ( $related_articles_loop->have_posts() ) :?>
                  <ul class="op-related-articles">
                    <?php foreach ( $related_articles as $related_article ) : ?>
                      <li><a href="<?php echo esc_url( get_permalink( $related_article ) ); ?>"></a></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              <?php } ?>
              <?php if( true == $redux_builder_amp['ampforwp-instant-article-author-bio']){ ?>
                <aside>
                  <p><?php the_author_meta('display_name'); ?></p> 
                  <p><?php the_author_meta('description'); ?></p>
                </aside>
              <?php } ?>
            </footer>
        </article>
    </body>
</html>