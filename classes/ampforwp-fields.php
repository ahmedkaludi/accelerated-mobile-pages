<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $amp_ux_fields;
require_once AMPFORWP_PLUGIN_DIR."classes/class-ampforwp-fields.php";
$ampforwp_fields = new AMPforWP_Fields();
$ampforwp_fields->createFields($amp_ux_fields);
?>