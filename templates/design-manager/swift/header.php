<?php global $redux_builder_amp ?>
<?php amp_header_core() ?>
<?php
do_action( 'levelup_head');
if( !ampforwp_levelup_compatibility('hf_builder_head') ){
?>
<?php if($redux_builder_amp['header-type'] == '1'){?>
<header class="header h_m h_m_1">
    <?php do_action('ampforwp_header_top_design4'); ?>
    <input type="checkbox" id="offcanvas-menu" class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="m-scrl">
                <div class="menu-heading clearfix">
                    <label for="offcanvas-menu" class="c-btn"></label>
                </div><!--end menu-heading-->

                <?php if ( amp_menu(false) ) : ?>
                    <nav class="m-menu">
                       <?php amp_menu();?>
                    </nav><!--end slide-menu -->
                <?php endif; ?>
                <?php do_action('ampforwp_after_amp_menu');?>

                <?php if ($redux_builder_amp['menu-search'] ) { ?>
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
                <div class="h-nav">
                    <label for="offcanvas-menu" class="t-btn"></label>
                </div><!--end menu-->
                <div class="logo">
                    <?php amp_logo(); ?>
                </div><!-- /.logo -->
                <div class="h-1">
                    <?php if( true == $redux_builder_amp['amp-swift-search-feature'] ){ ?>
                        <div class="h-srch h-ic">
                            <a title="search" class="lb icon-search" href="#search"></a>
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
                            <a href="<?php echo esc_url(ampforwp_wc_cart_page_url()); ?>" class="icon-shopping-cart"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a title="call telephone" href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']);?>"></a>
                        </div>
                    <?php } ?> 
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php do_action('ampforwp_header_bottom_design4'); ?>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-type'] == '2'){?>
<header class="header-2 h_m h_m_1">
    <?php do_action('ampforwp_header_top_design4'); ?>
    <input type="checkbox" id="offcanvas-menu" class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="m-scrl">
                <div class="menu-heading clearfix">
                    <label for="offcanvas-menu" class="c-btn"></label>
                </div><!--end menu-heading-->
                <?php if ( amp_menu(false) ) : ?>
                    <nav class="m-menu">
                       <?php amp_menu();?>
                    </nav><!--end slide-menu -->
                <?php endif; ?>
                <?php do_action('ampforwp_after_amp_menu');?>
                <?php if ( $redux_builder_amp['menu-search'] ) { ?>
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
                <div class="h-nav">
                   <label for="offcanvas-menu" class="t-btn"></label>
                </div><!-- /.left-nav -->
                <div class="h-logo">
                    <?php amp_logo(); ?>
                </div>
                <div class="h-2">
                    <?php if($redux_builder_amp['signin-button-text'] && $redux_builder_amp['signin-button-link']){?>
                    <div class="h-sing">
                        <a target="_blank" href="<?php echo esc_url($redux_builder_amp['signin-button-link'])?>"><?php echo esc_attr($redux_builder_amp['signin-button-text']) ?></a>
                    </div>
                    <?php } ?>
                    <?php if( isset( $redux_builder_amp['amp-swift-cart-btn'] ) && true == $redux_builder_amp['amp-swift-cart-btn'] ) { ?>
                        <div class="h-shop h-ic">
                            <a href="<?php echo ampforwp_wc_cart_page_url(); ?>" class="icon-shopping-cart"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a title="call telephone" href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']);?>"></a>
                        </div>
                    <?php } ?>    
                </div>
            </div>
        </div>
    </div>
    <?php do_action('ampforwp_header_bottom_design4'); ?>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-type'] == '3'){?>
<header class="header-3 h_m h_m_1">
    <?php do_action('ampforwp_header_top_design4'); ?>
    <input type="checkbox" id="offcanvas-menu" class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="m-scrl">
                <div class="menu-heading clearfix">
                    <label for="offcanvas-menu" class="c-btn"></label>
                </div><!--end menu-heading-->
                <?php if ( amp_menu(false) ) : ?>
                    <nav class="m-menu">
                       <?php amp_menu();?>
                    </nav><!--end slide-menu -->
                <?php endif; ?>
                <?php do_action('ampforwp_after_amp_menu');?>
                <?php if ( $redux_builder_amp['menu-search'] ) { ?>
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
                            <a class="lb icon-search" href="#search"></a>
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
                            <a href="<?php echo ampforwp_wc_cart_page_url(); ?>" class="icon-shopping-cart"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']);?>"></a>
                        </div>
                    <?php } ?>
                    <div class="h-nav">
                       <label for="offcanvas-menu" class="t-btn"></label>
                    </div><!-- /.left-nav --> 
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
<?php if ( amp_menu(false) ) : ?>
  <div class="p-menu">
    <?php amp_menu(); ?>
  </div>
  <?php endif; ?>
 <?php do_action('ampforwp_after_primary_menu');  ?>
</div>
<?php } 
}?>

