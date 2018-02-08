<?php
function amp_menu_html(){
	if( has_nav_menu( 'amp-menu' ) ) {
	    $menu_html_content = wp_nav_menu( array(
	            'theme_location' => 'amp-menu',
	            'container'=>'aside',
	            'menu'=>'ul',
	            'menu_class'=>'amp-menu',
	            'echo' => false,
	        ) );
	    $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
	    $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	    $sanitized_menu =  $sanitizer_obj->get_amp_content();
	    echo $sanitized_menu;
	}
}

//Load styling for Menu
add_action('amp_post_template_css','amp_menu_styles',11); 
function amp_menu_styles(){ ?>
    aside{width:150px}.amp-menu{list-style-type:none;margin:0;padding:0}.amp-menu li{position:relative;display:block}.amp-menu li.menu-item-has-children ul{display:none}.amp-menu li.menu-item-has-children:hover>ul{display:block}.amp-menu li.menu-item-has-children>ul>li{padding-left:10px}.amp-menu li.menu-item-has-children:after{content:" > ";position:absolute;padding:10px;right:0;top:0;z-index:10000;line-height:1;}.amp-menu>li a{padding:7px;display:block;margin-bottom:1px}.amp-menu>li ul{list-style-type:none;margin:0;padding:0;position:relative}
<?php }