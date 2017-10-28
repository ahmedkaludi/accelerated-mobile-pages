<?php global $redux_builder_amp; ?>
<header id="#top" class="amp-wp-header">
  <div class="ampforwp-logo-area" >
    <?php
    do_action('ampforwp_header_top_design1');
    if( $redux_builder_amp['amp-on-off-support-for-non-amp-home-page'] ) {
            if( $redux_builder_amp['amp-mobile-redirection'] ) { ?>
              <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ).'?nonamp=1'); ?>" rel="nofollow">
            <?php } else { ?>
              <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) ); ?>">
            <?php }
    } else { ?>
            <?php if($redux_builder_amp['ampforwp-homepage-on-off-support']) { ?>
                <a href="<?php echo esc_url( trailingslashit( trailingslashit( $this->get( 'home_url' ) ) )  . AMPFORWP_AMP_QUERY_VAR ); ?>">
            <?php } else {
            if( $redux_builder_amp['amp-mobile-redirection'] ) { ?>
              <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ).'?nonamp=1'); ?>" rel="nofollow">
            <?php } else { ?>
              <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) ); ?>" >
            <?php }
            }
      } ?>

      <?php if ( isset($redux_builder_amp['opt-media']['url'] ) && true == ($redux_builder_amp['opt-media']['url'])) {
          $logo_id =  attachment_url_to_postid($redux_builder_amp['opt-media'] ['url']);
          $logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true) ;
          if($logo_alt){
            $alt = $logo_alt;
          }
          else {
            $alt = get_bloginfo('name');
          }
          if($redux_builder_amp['ampforwp-custom-logo-dimensions'] == true)  { ?>

            <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="<?php echo $redux_builder_amp['opt-media-width']; ?>" height="<?php echo $redux_builder_amp['opt-media-height']; ?>" alt="<?php echo $alt; ?>" class="amp-logo"></amp-img>

          <?php } else { ?>

            <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="<?php echo $alt; ?>" class="amp-logo"></amp-img>

          <?php } ?>
      <?php } else {
        echo esc_html( $this->get( 'blog_name' ) );
      } ?>
    </a>

    <?php
    if($redux_builder_amp['amp-on-off-support-for-non-amp-home-page']){
    ?>
    <a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
    <?php }else{ ?>

    <?php if($redux_builder_amp['ampforwp-homepage-on-off-support']) { ?>

    <a href="<?php echo esc_url( trailingslashit( trailingslashit( $this->get( 'home_url' ) ) ) . AMPFORWP_AMP_QUERY_VAR ); ?>">

    <?php } else {?>

    <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) .'?nonamp=1'); ?>" rel="nofollow">

    <?php }
    } ?>
        <?php $site_icon_url = $this->get( 'site_icon_url' );
            if ( $site_icon_url ) : ?>
            <amp-img src="<?php echo esc_url( $site_icon_url ); ?>" width="32" height="32" class="amp-wp-site-icon"></amp-img>
        <?php endif; ?>
    </a>
    <?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
    <div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
        <a href="#" class="toggle-text">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <?php } ?>
    <?php do_action('ampforwp_header_search'); ?>
    <?php do_action('ampforwp_call_button');
    do_action('ampforwp_header_bottom_design1'); ?>



  </div>
</header>
<?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div> <?php
        $menu = wp_nav_menu( array(
                                  'theme_location' => 'amp-menu' ,
                                  'echo' => false) );
        echo strip_tags( $menu , '<ul><li><a>'); ?>
  </div>
</amp-sidebar>
<?php }
do_action('ampforwp_design_1_after_header');