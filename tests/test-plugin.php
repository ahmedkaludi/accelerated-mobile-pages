<?php
class PluginTest extends WP_UnitTestCase {
  	// Check that that activation doesn't break
  	function test_plugin_activated() {
    	$this->assertTrue( is_plugin_active( PLUGIN_PATH ) );
  	}
	function test_trailingslashit_should_add_slash_when_none_is_present() {
		$this->assertSame( 'foo/', trailingslashit( 'foo' ) );
	}
	public function test_user_with_editor_role_can_edit_others_posts() {
		$user_id = self::factory()->user->create( array(
		    'role' => 'editor',
		) );

		$this->assertTrue( user_can( $user_id, 'edit_others_posts' ) );
	}
	public function test_term_query_count() {
	    $tags = self::factory()->term->create_many( 3, array(
	        'taxonomy' => 'post_tag',
	    ) );
	 
	    $term_query = new WP_Term_Query();
	    $actual = $term_query->query( array(
	        'taxonomy' => 'post_tag',
	    'fields' => 'count',
	    ) );
	 
	    $this->assertSame( 3, $actual );
	}

}