<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Simple_Taxonomy_Search
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
    $_tests_dir = '/tmp/wordpress-tests-lib';
}

//* give access to tests_add_filter() function.
require_once( $_tests_dir . '/includes/functions.php' );

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );
/**
 * Manually load the plugin being tested.
 *
 * Callback for WordPress 'muplugins_loaded' action.
 *
 * @return void
 */
function _manually_load_plugin() {

    //* set dummy value to prevent sts() from automatically loading
    $GLOBALS['sts'] = 1;

    require( dirname( dirname( __FILE__ ) ) . '/simple-taxonomy-search.php' );
    
}

//* start up the WP testing environment.
require( $_tests_dir . '/includes/bootstrap.php' );
