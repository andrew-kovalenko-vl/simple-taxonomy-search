<?php
/**
 * Global functions test for Simple Taxonomy Search WordPress plugin.
 *
 * @package Simple_Taxonomy_Search
 */

class FunctionsTest extends WP_UnitTestCase {

    public function test_autoloader_file_exists() {
        $this->assertFileExists( STS_DIR . '/includes/functions.php' );
    }

    /**
     * @covers sts()
     */
    public function test_sts() {

        unset( $GLOBALS['sts'] );

        $this->assertTrue( is_a( sts(), 'Simple_Taxonomy_Search' ) );
        
    }

}
