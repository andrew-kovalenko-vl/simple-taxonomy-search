<?php
/**
 * Global constants test for Simple Taxonomy Search WordPress plugin.
 *
 * @package Simple_Taxonomy_Search
 */

class ConstantsTest extends WP_UnitTestCase {

    public function test_constant_STS_FILE_exists() {
        $this->assertNotEmpty( STS_FILE );
    }

    public function test_constant_STS_DIR_exists() {
        $this->assertNotEmpty( STS_DIR );
    }

}
