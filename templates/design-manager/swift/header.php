<?php global $redux_builder_amp ?>
<?php amp_header_core() ?>
<?php if($redux_builder_amp['header-type'] == '1'){?>
<header class="header h_m h_m_1">
    <input type="checkbox" id="offcanvas-menu" class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="menu-heading clearfix">
                <label for="offcanvas-menu" class="c-btn"></label>
            </div><!--end menu-heading-->
            <nav class="m-menu">
               <?php amp_menu(); ?>
            </nav><!--end slide-menu -->
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
                            <a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield'];?>"></a>
                        </div>
                    <?php } ?> 
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-type'] == '2'){?>
<header class="header-2 h_m h_m_1">
    <input type="checkbox" id="offcanvas-menu" class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="menu-heading clearfix">
                <label for="offcanvas-menu" class="c-btn"></label>
            </div><!--end menu-heading-->
            <nav class="m-menu">
               <?php amp_menu(); ?>
            </nav><!--end slide-menu -->
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
                        <a target="_blank" href="<?php echo $redux_builder_amp['signin-button-link']?>"><?php echo $redux_builder_amp['signin-button-text'] ?></a>
                    </div>
                    <?php } ?>
                    <?php if( isset( $redux_builder_amp['amp-swift-cart-btn'] ) && true == $redux_builder_amp['amp-swift-cart-btn'] ) { ?>
                        <div class="h-shop h-ic">
                            <a href="<?php echo ampforwp_wc_cart_page_url(); ?>" class="icon-shopping-cart"></a>
                        </div>
                    <?php } ?>
                    <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                        <div class="h-call h-ic">
                            <a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield'];?>"></a>
                        </div>
                    <?php } ?>    
                </div>
            </div>
        </div>
    </div>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-type'] == '3'){?>
<header class="header-3 h_m h_m_1">
    <input type="checkbox" id="offcanvas-menu" class="tg" />
    <div class="hamb-mnu">
        <aside class="m-ctr">
            <div class="menu-heading clearfix">
                <label for="offcanvas-menu" class="c-btn"></label>
            </div><!--end menu-heading-->
            <nav class="m-menu">
               <?php amp_menu(); ?>
            </nav><!--end slide-menu -->
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
                            <a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield'];?>"></a>
                        </div>
                    <?php } ?>
                    <div class="h-nav">
                       <label for="offcanvas-menu" class="t-btn"></label>
                    </div><!-- /.left-nav --> 
                </div>
            </div>
        </div>
    </div>
</header>
<?php }
do_action("ampforwp_advance_header_layout_options");
 ?>
<div class="content-wrapper">
<?php if($redux_builder_amp['primary-menu']){?>
<div class="p-m-fl">
    <div class="p-menu">
        <?php amp_menu(); ?>
    </div>
</div>
<?php } ?>

