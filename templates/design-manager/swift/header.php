<?php global $redux_builder_amp?>
<?php amp_header_core() ?>
<?php if($redux_builder_amp['header-type'] == '1'){?>
  <header class="header">
    <div class="cntr">
        <div class="head">
            <div class="h-nav">
               <?php amp_sidebar(['action'=>'open-button']); ?>
            </div><!-- /.left-nav -->
            <div class="logo">
                <?php amp_logo(); ?>
            </div><!-- /.logo -->
            <div class="h-1">
                <div class="h-srch h-ic">
                    <a class="lb" href="#search"></a>
                    <div class="lb-btn"> 
                        <div class="lb-t" id="search">
                           <?php amp_search();?>
                           <a class="lb-x" href="#"></a>
                        </div> 
                    </div>
                </div><!-- /.search -->
                <div class="h-shop h-ic">
                    <a href="#"></a>
                </div>
                <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                    <div class="h-call h-ic">
                        <a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield'];?>"></a>
                    </div>
                <?php } ?> 
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-type'] == '2'){?>
<header class="header-2">
    <div class="cntr">
        <div class="head-2">
            <div class="h-nav">
               <?php amp_sidebar(['action'=>'open-button']); ?>
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
                <div class="h-shop h-ic">
                    <a href="#"></a>
                </div>
                <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                    <div class="h-call h-ic">
                        <a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield'];?>"></a>
                    </div>
                <?php } ?>    
            </div>
        </div>
    </div>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-type'] == '3'){?>
<header class="header-3">
    <div class="cntr">
        <div class="head-3">
            <div class="h-logo">
                <?php amp_logo(); ?>
            </div>
            <div class="h-3">
                <div class="h-nav">
                   <?php amp_sidebar(['action'=>'open-button']); ?>
                </div><!-- /.left-nav -->
                <div class="h-srch h-ic">
                    <a class="lb" href="#search"></a>
                    <div class="lb-btn"> 
                        <div class="lb-t" id="search">
                           <?php amp_search();?>
                           <a class="lb-x" href="#"></a>
                        </div> 
                    </div>
                </div><!-- /.search -->
                <div class="h-shop h-ic">
                    <a href="#"></a>
                </div>
                <?php if ( true == $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
                    <div class="h-call h-ic">
                        <a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield'];?>"></a>
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
</header>
<?php } ?>
<?php if($redux_builder_amp['header-position-type'] == '1'){?>
<?php amp_sidebar(['action'=>'start',
    'id'=>'sidebar',
    'layout'=>'nodisplay',
    'side'=>'left'
] ); ?>
<?php } ?>
<?php if($redux_builder_amp['header-position-type'] == '2'){?>
<?php amp_sidebar(['action'=>'start',
    'id'=>'sidebar',
    'layout'=>'nodisplay',
    'side'=>'right'
] ); ?>
<?php } ?>
<div class="amp-close-btn">
    <?php amp_sidebar(['action'=>'close-button']); ?>
</div>
<div class="m-menu">
    <?php amp_menu(); ?>
</div>
<?php amp_sidebar(['action'=>'end']); ?>

<div class="content-wrapper">
<?php if($redux_builder_amp['primary-menu']){?>
<div class="p-m-fl">
    <div class="p-menu">
        <?php amp_menu(); ?>
    </div>
</div>
<?php } ?>