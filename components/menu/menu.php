<?php
function amp_menu_html(){
if( has_nav_menu( 'amp-menu' ) ) {
    wp_nav_menu( array(
            'theme_location' => 'amp-menu',
            'container'=>'aside',
            'menu'=>'ul',
            'menu_class'=>'amp-menu',
        ) );
}
}

//Load styling for Menu
add_action('amp_post_template_css','amp_menu_styles',11); 
function amp_menu_styles(){ ?>
            aside {
              width: 150px;
            }
            .amp-menu {
              list-style-type: none;
              margin: 0;
              padding: 0;
            }
            .amp-menu a {
              color: #333;
            }
            .amp-menu a:hover {
              color: #000 ;
            }
            .amp-menu li {
              position: relative;
              display: block;
            }
            .amp-menu li.menu-item-has-children ul {
              display: none;
            }
            .amp-menu li.menu-item-has-children:hover > ul {
              display: block ;
            }
            .amp-menu li.menu-item-has-children > ul > li {
              padding-left: 10px ;
            }
            .amp-menu li.menu-item-has-children:after {
                content: "";
                position: absolute;
                padding: 20px;
                right: 0;
                background: red;
                top: 0;
                z-index: 10000;
            }
            .amp-menu > li a {
              text-decoration: none;
              padding: 7px 10px;
              display: block;
              margin-bottom: 1px;
            }
            .amp-menu > li ul {
              list-style-type: none;
              margin: 0;
              padding: 0;
              position: relative;
            }
            .amp-menu > li ul, .amp-menu > li ul {
              border-left: 1px solid #fff;
            }

            .amp-menu li a {
              -webkit-transition: all 0.2s ease-in-out;
              -moz-transition: all 0.2s ease-in-out;
              transition: all 0.2s ease-in-out;
            }
            .amp-menu > li > a {
              background: #e5e5e5;
            }
            .amp-menu > li > li a {
              background: #e5e5e5;
            }
            .amp-menu > li > li a {
              background: #e5e5e5;
            }

            .amp-menu li:hover a {
              background: #ccc;
            }
            .amp-menu li:hover li:hover > a {
              background: #ccc;
            }
<?php }