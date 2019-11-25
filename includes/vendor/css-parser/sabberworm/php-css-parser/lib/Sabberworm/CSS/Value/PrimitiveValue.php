<?php

namespace Sabberworm\CSS\Value;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
abstract class PrimitiveValue extends Value {
    public function __construct($iLineNo = 0) {
        parent::__construct($iLineNo);
    }

}