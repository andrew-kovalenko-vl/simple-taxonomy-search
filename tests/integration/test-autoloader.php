<?php
/**
 * Autoloader test for Simple Taxonomy Search WordPress plugin.
 *
 * @package Simple_Taxonomy_Search
 */

class AutoloaderTest extends WP_UnitTestCase {

    public function test_autoloader_file_exists() {
        $this->assertFileExists( STS_DIR . '/includes/autoloader.php' );
    }

    /**
     * @covers sts_autoloader()
     */
    public function test_sts_autoloader_exists() {
        $this->assertTrue( function_exists( 'sts_autoloader' ) );
    }

}
