<?php
require_once AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-walker-nav-menu.php';

function amp_menu_html($echo){
	if( has_nav_menu( 'amp-menu' ) ) {
	    $menu_html_content = wp_nav_menu( array(
	            'theme_location' => 'amp-menu',
	            'container'=>'aside',
	            'menu'=>'ul',
	            'menu_class'=>'amp-menu',
	            'echo' => false,
				'walker' => new Ampforwp_Walker_Nav_Menu()
	        ) );
	    $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
	    $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	    $sanitized_menu =  $sanitizer_obj->get_amp_content();
    	return $sanitized_menu;
	}
}

//Load styling for Menu
add_action('amp_post_template_css','amp_menu_styles',11); 
function amp_menu_styles(){
	$atf 	= '';
	$design = ampforwp_get_setting('amp-design-selector');
	if ( ( $design == ('1') ) || ( $design == ('2')  ) || ( $design == ('3')  ) || ( $design == ('4')  )  ) {}
	else {
		$atf = true;?>
		.amp-menu input{display:none;}
		.amp-menu .toggle:after{content:'\25be';position:absolute;padding: 10px 15px 10px 30px;right:0;font-size:18px;color:#ed1c24;top:0px;z-index:10000;line-height:1;cursor:pointer;}
		<?php
 	}
 	if ( ! defined('AMPFORWP_LAYOUTS_URL') ) { ?>
		/** Dropdown CSS **/
		amp-sidebar{padding:15px;}
		.amp-sidebar-close{border-radius: 100%;cursor:pointer;}
		.amp-search-wrapper{margin-bottom:15px;}
		.amp-menu li.menu-item-has-children ul{display:none;margin:0;}
		.amp-menu li.menu-item-has-children ul, .amp-menu li.menu-item-has-children ul ul{font-size:14px;}
		.amp-menu input{display:none;}
		.amp-menu [id^=drop]:checked + label + ul{ display: block;}
		<?php
	} elseif( $atf && defined('AMPFORWP_LAYOUTS_URL') ){?>

		/** Dropdown CSS **/
		amp-sidebar{padding:15px;}
		.amp-sidebar-close{border-radius: 100%;cursor:pointer;}
		.amp-search-wrapper{margin-bottom:15px;}
		.amp-menu li.menu-item-has-children ul{display:none;margin:0;}
		.amp-menu li.menu-item-has-children ul, .amp-menu li.menu-item-has-children ul ul{font-size:14px;}
		.amp-menu input{display:none;}
		.amp-menu [id^=drop]:checked + label + ul{ display: block;}

		<?php
	}?>
	// AMP theme framework and AMP layouts and this is required
	aside{width:150px}.amp-menu{list-style-type:none;margin:0;padding:0}.amp-menu li{position:relative;display:block}.amp-menu li.menu-item-has-children ul{display:none}.amp-menu li.menu-item-has-children:hover>ul{display:}.amp-menu li.menu-item-has-children>ul>li{padding-left:10px}.amp-menu>li a{padding:7px;display:block;margin-bottom:1px}.amp-menu>li ul{list-style-type:none;margin:0;padding:0;position:relative}.amp-menu input{display:none;}<?php 
}