<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-walker-nav-menu.php';

function amp_menu_html($echo, $menu_args, $type){
	$theme_location = 'amp-menu';
	if ( 'amp-alternative-menu' == $type ) {
		$theme_location = 'amp-alternative-menu';
	}
	if( has_nav_menu( 'amp-menu' ) || has_nav_menu( 'amp-footer-menu' ) || has_nav_menu( 'amp-alternative-menu' ) ) {
		if ( !empty($menu_args) && isset($menu_args['walker']) ) {
			$menu_args['walker'] = new Ampforwp_Walker_Nav_Menu();
		}
		if (empty($menu_args)){
			$menu_args = array(
	            'theme_location' => $theme_location,
	            'container'=>'aside',
	            'menu'=>'ul',
	            'menu_class'=>'amp-menu',
	            'echo' => false,
				'walker' => new Ampforwp_Walker_Nav_Menu()
	        );
		}
	    $menu_html_content = wp_nav_menu( $menu_args );
	    $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
	    $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	    $sanitized_menu =  $sanitizer_obj->get_amp_content();

	    $menu_cache = true;
	    if ( class_exists('Sitepress') ) {
	    	 $menu_cache = false;
	    }
	    if(defined('QTX_VERSION')){ // FOR qTranslate-X 
	    	 $menu_cache = false;
	    }
	    $menu_cache = apply_filters('ampforwp_menu_cache',$menu_cache);
	    if ($menu_cache) {
		    if ( 'header' == $type ) {
		    	set_transient('ampforwp_header_menu', $sanitized_menu, 14*DAY_IN_SECONDS );
		    }
		    elseif ('footer' == $type) {
		    	set_transient('ampforwp_footer_menu', $sanitized_menu, 15*DAY_IN_SECONDS );
		    }
		}
    	return $sanitized_menu;
	}
}

//Load styling for Menu

add_action('amp_post_template_css','amp_menu_styles',11); 
function amp_menu_styles(){ 

	?>
	<?php  if ( class_exists('AmpforwpAmpLayouts') || ( in_array(ampforwp_get_setting('amp-design-selector'), array('1', '2', '3', '4'))  )) { 
		?>
 	.amp-menu input{display:none;}.amp-menu li.menu-item-has-children ul{display:none;}.amp-menu li{position:relative;display:block;}.amp-menu > li a{display:block;}
<?php } // AMP Layouts condition ends
	 if(! in_array(ampforwp_get_setting('amp-design-selector'), array('1', '2', '3', '4'))  ) { ?>
	 	aside{width:150px}
	    .amp-menu{list-style-type:none;margin:0px;padding:0}.amp-menu li{position:relative;display:block}.amp-menu li.menu-item-has-children ul{display:none}.amp-menu li.menu-item-has-children>ul>li{padding-left:10px}.amp-menu>li a{padding:7px;display:block;margin-bottom:1px}.amp-menu>li ul{list-style-type:none;margin:0;padding:0;position:relative}
		/** Dropdown CSS **/
		amp-sidebar{padding:15px;}
		.amp-sidebar-close{border-radius: 100%;cursor:pointer;}
		.amp-search-wrapper{margin-bottom:15px;}
		.amp-menu li.menu-item-has-children ul{display:none;margin:0;}
		.amp-menu li.menu-item-has-children ul, .amp-menu li.menu-item-has-children ul ul{font-size:14px;}
		.amp-menu input{display:none;}
		.amp-menu [id^=drop]:checked + label + ul{ display: block;}
		.amp-menu .toggle:after{content:'\25be';position:absolute;padding: 10px 15px 10px 30px;right:0;font-size:18px;color:#ed1c24;top:0px;z-index:10000;line-height:1;cursor:pointer;}
	<?php } // designs condition ends here
       //UberMenu 3 Custom CSS  
       if(function_exists('ubermenu_get_nav_menu_args')){
              $menu_element_color = '#ffffff';
              $ubermenu_cont_wth = '80%';
              $cont_padding = '24px';
              $design_selector = ampforwp_get_setting('amp-design-selector');
              if($design_selector == '4'){
                $menu_element_color = ampforwp_get_setting('swift-element-overlay-color-control','rgba');
                $cont_padding = '7px';

              }elseif($design_selector == '3'){

 				$menu_element_color = ampforwp_get_setting('amp-opt-color-rgba-menu-elements-color','rgba');
 				$ubermenu_cont_wth = '70%';

              }elseif($design_selector == '2'){

              	$menu_element_color = ampforwp_get_setting('amp-d2-menu-color','rgba');
              	$ubermenu_cont_wth = '50%';

              }else{
                $menu_element_color = ampforwp_get_setting('amp-d1-menu-color','rgba');
                $ubermenu_cont_wth = '50%';
              }
         ?>
	         .amp-menu li.ubermenu-has-submenu-drop ul {
	            display: none;
	         }

	         ul.ubermenu-submenu {
			    margin-left: 10px;
			    color: <?php echo ampforwp_sanitize_color($menu_element_color); ?>;
			    line-height: 3;
	          }
	          .ubermenu-custom-content amp-img{
	             width:240px;
	             height:240px;
	           }
	         .ubermenu-content-block,.ubermenu-custom-content {
			    color: <?php echo ampforwp_sanitize_color($menu_element_color); ?>;
			    line-height: 2;
			    padding: 0px <?php echo esc_html($cont_padding); ?>;
			    width: <?php echo esc_html($ubermenu_cont_wth); ?>;
	          } 
       <?php 
      } // ubermenu css ends here.
 } // function ends