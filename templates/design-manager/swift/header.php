<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp ?>
<?php amp_header_core() ?>
<?php
do_action( 'levelup_head');
if( !ampforwp_levelup_compatibility('hf_builder_head') ){
    $header_type = ampforwp_get_setting('header-type');
    if(!defined('AMPFORWP_LAYOUTS_FILE')){
        if( !in_array($header_type,array(1,2,3,10)) ) {
            $header_type = 1;
        }
    }
?>
<?php if($header_type == '1'){?>
<?php do_action('ampforwp_admin_menu_bar_front'); 
      do_action('ampforwp_reading_progress_bar'); ?>
<header class="header h_m h_m_1">
    <?php do_action('ampforwp_header_top_design4'); ?>
    <input type="checkbox" id="offcanvas-menu" on="change:AMP.setState({ offcanvas_menu: (event.checked ? true : false) })"  [checked] = "offcanvas_menu"  class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="m-scrl">
                <div class="menu-heading clearfix">
                    <label for="offcanvas-menu" class="c-btn"></label>
                </div><!--end menu-heading-->
                <?php if (ampforwp_get_setting('menu-search' ) && ampforwp_get_setting('menu-search-before-menu') ){ ?>
                    <div class="m-srch">
                        <?php amp_search();?>
                    </div>
                <?php } ?>
                <?php if ( amp_menu(false) ) : ?>
                    <nav class="m-menu">
                       <?php amp_menu();?>
                    </nav><!--end slide-menu -->
                <?php endif; ?>
                <?php do_action('ampforwp_after_amp_menu');?>

                <?php if (ampforwp_get_setting('menu-search' ) && ampforwp_get_setting('menu-search-after-menu') ){ ?>
                    <div class="m-srch">
                        <?php amp_search();?>
                    </div>
                <?php } ?>
                <?php if ( true == $redux_builder_amp['menu-social'] ) { ?>
                <div class="m-s-i">
                    <ul>
                        <?php if($redux_builder_amp['enbl-fb']){?>
                        <li>
                            <a title="facebook" class="s_fb" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-fb-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-tw']){?>
                        <li>
                            <a title="twitter" class="s_tw" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-tw-prfl-url']); ?>">
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-gol']){?>
                        <li>
                            <a title="google plus" class="s_gp" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-gol-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-lk']){?>
                        <li>
                            <a title="linkedin" class="s_lk" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-lk-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-pt']){?>
                        <li>
                            <a title="pinterest" class="s_pt" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-pt-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-yt']){?>
                        <li>
                            <a title="youtube" class="s_yt" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-yt-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-inst']){?>
                        <li>
                            <a title="instagram" class="s_inst" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-inst-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-vk']){?>
                        <li>
                            <a title="vkontakte" class="s_vk" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-vk-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-rd']){?>
                        <li>
                            <a title="reddit" class="s_rd" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-rd-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-tbl']){?>
                        <li>
                            <a title="tumblr" class="s_tbl" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enbl-tbl-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                         <?php if(ampforwp_get_setting('enbl-telegram')){?>
                        <li>
                            <a title="telegram" class="s_telegram" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url(ampforwp_get_setting('enbl-telegram-prfl-url')); ?>"></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <?php if( true == $redux_builder_amp['amp-swift-menu-cprt']){?>
                <div class="cp-rgt">
                    <?php amp_non_amp_link(); ?>
                </div>
                <?php } ?>
            </div><!-- /.m-srl -->
        </aside><!--end menu-container-->
        <label for="offcanvas-menu" class="fsc"></label>
        <div class="cntr">
            <div class="head h_m_w">
                <?php  if(ampforwp_get_setting('ampforwp-amp-menu-swift') == true) {?>
                <div class="h-nav">
                    <label for="offcanvas-menu" class="t-btn"></label>
                </div><!--end menu-->
                <?php } ?>
                <div class="logo">
                    <?php amp_logo(); ?>
                </div><!-- /.logo -->
                <div class="h-1">
                    <?php if( true == $redux_builder_amp['amp-swift-search-feature'] ){ ?>
                        <div class="h-srch h-ic">
                            <a title="search" class="lb icon-src" href="#search"></a>
                            <div class="lb-btn"> 
                                <div class="lb-t" id="search">
                                   <?php amp_search();?>
                                   <a title="close" class="lb-x" href="#"></a>
                                </div> 
                            </div>
                        </div><!-- /.search -->
                    <?php } ?>
                    <?php if( isset( $redux_builder_amp['amp-swift-cart-btn'] ) && true == $redux_builder_amp['amp-swift-cart-btn'] ) { ?>
                        <div class="h-shop h-ic">
                            <a href="<?php echo esc_url(ampforwp_wc_cart_page_url()); ?>" class="isc"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a title="call telephone" href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']);?>"></a>
                        </div>
                    <?php } ?> 
                    <?php do_action('ampforwp_header_elements') ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php do_action('ampforwp_header_bottom_design4'); ?>
</header>
<?php } ?>
<?php if($header_type == '2'){
    do_action('ampforwp_reading_progress_bar'); ?>
<header class="header-2 h_m h_m_1">
    <?php do_action('ampforwp_header_top_design4'); ?>
    <input type="checkbox" id="offcanvas-menu"  on="change:AMP.setState({ offcanvas_menu: (event.checked ? true : false) })"  [checked] = "offcanvas_menu"  class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="m-scrl">

                <div class="menu-heading clearfix">
                    <label for="offcanvas-menu" class="c-btn"></label>
                </div><!--end menu-heading-->
                <?php if (ampforwp_get_setting('menu-search' ) && ampforwp_get_setting('menu-search-before-menu') ){ ?>
                    <div class="m-srch">
                        <?php amp_search();?>
                    </div>
                <?php } ?>
                <?php if ( amp_menu(false) ) : ?>
                    <nav class="m-menu">
                       <?php amp_menu();?>
                    </nav><!--end slide-menu -->
                <?php endif; ?>
                <?php do_action('ampforwp_after_amp_menu');?>
                <?php if( true == ampforwp_get_setting('signin-button') && '2' == ampforwp_get_setting('cta-responsive-view')){?>
                    <div class="h-sing cta-res">
                        <a target="_blank" <?php ampforwp_nofollow_cta_header_link(); ?> href="<?php echo esc_url(ampforwp_get_setting('signin-button-link'))?>"><?php echo esc_html__(ampforwp_get_setting('signin-button-text'), 'accelerated-mobile-pages'); ?></a>
                    </div>
                    <?php } ?>
                <?php if (ampforwp_get_setting('menu-search' ) && ampforwp_get_setting('menu-search-after-menu') ){ ?>
                <div class="m-srch">
                    <?php amp_search();?>
                </div>
                <?php } ?>
                <?php if ( true == $redux_builder_amp['menu-social'] ) { ?>
                <div class="m-s-i">
                    <ul>
                        <?php if($redux_builder_amp['enbl-fb']){?>
                        <li>
                            <a title="facebook" class="s_fb" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-fb-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-tw']){?>
                        <li>
                            <a title="twitter" class="s_tw" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-tw-prfl-url']); ?>">
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-gol']){?>
                        <li>
                            <a title="google plus" class="s_gp" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-gol-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-lk']){?>
                        <li>
                            <a title="linkedin" class="s_lk" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-lk-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-pt']){?>
                        <li>
                            <a title="pinterest" class="s_pt" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-pt-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-yt']){?>
                        <li>
                            <a title="youtube" class="s_yt" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-yt-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-inst']){?>
                        <li>
                            <a title="instagram" class="s_inst" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-inst-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-vk']){?>
                        <li>
                            <a title="vkontakte" class="s_vk" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-vk-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-rd']){?>
                        <li>
                            <a title="reddit" class="s_rd" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-rd-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-tbl']){?>
                        <li>
                            <a title="tumblr" class="s_tbl" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-tbl-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                          <?php if(ampforwp_get_setting('enbl-telegram')){?>
                        <li>
                            <a title="telegram" class="s_telegram" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url(ampforwp_get_setting('enbl-telegram-prfl-url')); ?>"></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <?php if( true == $redux_builder_amp['amp-swift-menu-cprt']){?>
                <div class="cp-rgt">
                    <?php amp_non_amp_link(); ?>
                </div>
                <?php } ?>
            </div><!-- /.m-srl -->
        </aside><!--end menu-container-->
        <label for="offcanvas-menu" class="fsc"></label>
        <div class="cntr">
            <div class="head-2 h_m_w">
                <?php  if(ampforwp_get_setting('ampforwp-amp-menu-swift') == true) {?>
                <div class="h-nav">
                   <label for="offcanvas-menu" class="t-btn"></label>
                </div><!-- /.left-nav -->
                <?php } ?>
                <div class="h-logo">
                    <?php amp_logo(); ?>
                </div>
                <div class="h-2">
                    <?php if( ampforwp_get_setting('signin-button-text') && ampforwp_get_setting('signin-button-link') ){
                    $new_tab = '';
                    if (ampforwp_get_setting('signin-button-new-tab')) {
                        $new_tab = 'target=_blank';
                    }?>
                    <div class="h-sing">
                        <a <?php echo esc_html($new_tab); ?> <?php ampforwp_nofollow_cta_header_link(); ?> href="<?php echo esc_url(ampforwp_get_setting('signin-button-link'))?>"><?php echo esc_html__(ampforwp_get_setting('signin-button-text'), 'accelerated-mobile-pages'); ?></a>
                    </div>
                    <?php } ?>
                    <?php if( isset( $redux_builder_amp['amp-swift-cart-btn'] ) && true == $redux_builder_amp['amp-swift-cart-btn'] ) { ?>
                        <div class="h-shop h-ic">
                            <a href="<?php echo ampforwp_wc_cart_page_url(); ?>" class="isc"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a title="call telephone" href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']);?>"></a>
                        </div>
                    <?php } ?>    
                    <?php do_action('ampforwp_header_elements') ?>
                </div>
            </div>
        </div>
    </div>
    <?php do_action('ampforwp_header_bottom_design4'); ?>
</header>
<?php } ?>
<?php if($header_type == '3'){
    do_action('ampforwp_reading_progress_bar'); ?>
<header class="header-3 h_m h_m_1">
    <?php do_action('ampforwp_header_top_design4'); ?>
    <input type="checkbox" id="offcanvas-menu"  on="change:AMP.setState({ offcanvas_menu: (event.checked ? true : false) })"  [checked] = "offcanvas_menu"  class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="m-scrl">
                <div class="menu-heading clearfix">
                    <label for="offcanvas-menu" class="c-btn"></label>
                </div><!--end menu-heading-->
                <?php if (ampforwp_get_setting('menu-search' ) && ampforwp_get_setting('menu-search-before-menu') ){ ?>
                    <div class="m-srch">
                        <?php amp_search();?>
                    </div>
                <?php } ?>
                <?php if ( amp_menu(false) ) : ?>
                    <nav class="m-menu">
                       <?php amp_menu();?>
                    </nav><!--end slide-menu -->
                <?php endif; ?>
                <?php do_action('ampforwp_after_amp_menu');?>
                <?php if (ampforwp_get_setting('menu-search' ) && ampforwp_get_setting('menu-search-after-menu') ){ ?>
                <div class="m-srch">
                    <?php amp_search();?>
                </div>
                <?php } ?>
                <?php if ( true == $redux_builder_amp['menu-social'] ) { ?>
                <div class="m-s-i">
                    <ul>
                        <?php if($redux_builder_amp['enbl-fb']){?>
                        <li>
                            <a title="facebook" class="s_fb" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-fb-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-tw']){?>
                        <li>
                            <a title="twitter" class="s_tw" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-tw-prfl-url']); ?>">
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-gol']){?>
                        <li>
                            <a title="google plus" class="s_gp" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-gol-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-lk']){?>
                        <li>
                            <a title="linkedin" class="s_lk" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-lk-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-pt']){?>
                        <li>
                            <a title="pinterest" class="s_pt" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-pt-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-yt']){?>
                        <li>
                            <a title="youtube" class="s_yt" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-yt-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-inst']){?>
                        <li>
                            <a title="instagram" class="s_inst" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-inst-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-vk']){?>
                        <li>
                            <a title="vkontakte" class="s_vk" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-vk-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-rd']){?>
                        <li>
                            <a title="reddit" class="s_rd" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-rd-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if($redux_builder_amp['enbl-tbl']){?>
                        <li>
                            <a title="tumblr" class="s_tbl" target="_blank" href="<?php echo esc_url($redux_builder_amp['enbl-tbl-prfl-url']); ?>"></a>
                        </li>
                        <?php } ?>
                        <?php if(ampforwp_get_setting('enbl-telegram')){?>
                        <li>
                            <a title="telegram" class="s_telegram" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url(ampforwp_get_setting('enbl-telegram-prfl-url')); ?>"></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <?php if( true == $redux_builder_amp['amp-swift-menu-cprt']){?>
                <div class="cp-rgt">
                    <?php amp_non_amp_link(); ?>
                </div>
                <?php } ?>
            </div><!-- /.m-srl -->
        </aside><!--end menu-container-->
        <label for="offcanvas-menu" class="fsc"></label>
        <div class="cntr">
            <div class="head-3 h_m_w">
                <div class="h-logo">
                    <?php amp_logo(); ?>
                </div>
                <div class="h-3">
                    <?php if( true == $redux_builder_amp['amp-swift-search-feature'] ){ ?>
                        <div class="h-srch h-ic">
                            <a class="lb icon-src" href="#search"></a>
                            <div class="lb-btn"> 
                                <div class="lb-t" id="search">
                                   <?php amp_search();?>
                                   <a class="lb-x" href="#"></a>
                                </div> 
                            </div>
                        </div><!-- /.search -->
                    <?php } ?>
                    <?php if( isset( $redux_builder_amp['amp-swift-cart-btn'] ) && true == $redux_builder_amp['amp-swift-cart-btn'] ) { ?>
                        <div class="h-shop h-ic">
                            <a href="<?php echo ampforwp_wc_cart_page_url(); ?>" class="isc"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']);?>"></a>
                        </div>
                    <?php } ?>
                    <?php do_action('ampforwp_header_elements') ?>
                    <?php  if(ampforwp_get_setting('ampforwp-amp-menu-swift') == true) {?>
                    <div class="h-nav">
                       <label for="offcanvas-menu" class="t-btn"></label>
                    </div><!-- /.left-nav --> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php do_action('ampforwp_header_bottom_design4'); ?>
</header>
<?php }
do_action("ampforwp_advance_header_layout_options");
}
 ?>
<div class="content-wrapper">
<?php
if(!ampforwp_levelup_compatibility('hf_builder_head') ){
 if($redux_builder_amp['primary-menu']){?>
<div class="p-m-fl">
<?php if ( amp_alter_menu(false) ) : ?>
  <div class="p-menu">
    <?php amp_alter_menu(true); ?>
  </div>
  <?php endif; ?>
 <?php do_action('ampforwp_after_primary_menu');  ?>
</div>
<?php } 
}?>

