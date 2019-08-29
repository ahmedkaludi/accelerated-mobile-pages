<?php
if ( ( (is_single() && 1 == ampforwp_get_setting('ampforwp-bread-crumb')) || (is_page() && ampforwp_get_setting('ampforwp_pages_breadcrumbs')) ) && !checkAMPforPageBuilderStatus(get_the_ID()) ) {  
	include_once( AMP_FRAMEWORK_COMOPNENT_DIR_PATH.'/breadcrumb/breadcrumb.php' );
    echo amp_breadcrumb_output();
} ?>