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
            <div class="srch">
                <a class="lb" href="#ovelay">
                    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU2Ljk2NiA1Ni45NjYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU2Ljk2NiA1Ni45NjY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPHBhdGggZD0iTTU1LjE0Niw1MS44ODdMNDEuNTg4LDM3Ljc4NmMzLjQ4Ni00LjE0NCw1LjM5Ni05LjM1OCw1LjM5Ni0xNC43ODZjMC0xMi42ODItMTAuMzE4LTIzLTIzLTIzcy0yMywxMC4zMTgtMjMsMjMgIHMxMC4zMTgsMjMsMjMsMjNjNC43NjEsMCw5LjI5OC0xLjQzNiwxMy4xNzctNC4xNjJsMTMuNjYxLDE0LjIwOGMwLjU3MSwwLjU5MywxLjMzOSwwLjkyLDIuMTYyLDAuOTIgIGMwLjc3OSwwLDEuNTE4LTAuMjk3LDIuMDc5LTAuODM3QzU2LjI1NSw1NC45ODIsNTYuMjkzLDUzLjA4LDU1LjE0Niw1MS44ODd6IE0yMy45ODQsNmM5LjM3NCwwLDE3LDcuNjI2LDE3LDE3cy03LjYyNiwxNy0xNywxNyAgcy0xNy03LjYyNi0xNy0xN1MxNC42MSw2LDIzLjk4NCw2eiIgZmlsbD0iIzAwMDAwMCIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="16" height="16"/></amp-img>
                </a>
                <div class="lb-btn"> 
                    <div class="lb-t" id="ovelay">
                       <?php amp_search();?>
                       <a class="lb-x" href="#"></a>
                    </div> 
                </div>
            </div><!-- /.search -->
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
            <div class="h-sing">
                <a href="#">Sign up free</a>
            </div>
        </div>
    </div>
</header>
<?php } ?>

<?php amp_sidebar(['action'=>'start',
    'id'=>'sidebar',
    'layout'=>'nodisplay',
    'side'=>'left'
] ); ?>
<div class="amp-close-btn">
    <?php amp_sidebar(['action'=>'close-button']); ?>
</div>
<div class="m-menu">
    <?php amp_menu(); ?>
    <div class="menu-btn">
        <a href="#">Get Started Free</a>
    </div>
</div>
<?php amp_sidebar(['action'=>'end']); ?>

<div class="content-wrapper">