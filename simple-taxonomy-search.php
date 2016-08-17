<?php
/**
 * Plugin Name: Simple Taxonomy Search
 * Version: 1.0.1
 * Description: Extend WordPress searches in search aginst taxonomy terms.
 * Author: Ryan Meier
 * Author URI: https://www.rfmeier.net/
 * Plugin URI: https://www.rfmeier.net/
 * Text Domain: simple-taxonomy-search
 * Domain Path: /languages
 *
 * @package Simple_Taxonomy_Search
 */

//* absolute plugin file path
define( 'STS_FILE', __FILE__ );

//* absolute plugin directory path
define( 'STS_DIR', dirname( STS_FILE ) );

//* include autoloader
include_once( STS_DIR . '/includes/autoloader.php' );

//* include global functions
include_once( STS_DIR . '/includes/functions.php' );

//* start...
sts();
