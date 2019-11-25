<?php

namespace Sabberworm\CSS;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
interface Renderable {
	public function __toString();
	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat);
	public function getLineNo();
}