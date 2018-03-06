<?php
class BasicTest extends WP_UnitTestCase {
  // Check that that activation doesn't break
  function test_plugin_activated() {
    $this->assertTrue( is_plugin_active( PLUGIN_PATH ) );
  }
  public function testTrueIsTrue()
	{
	    $foo = true;
    	$this->assertTrue($foo);
	}
}