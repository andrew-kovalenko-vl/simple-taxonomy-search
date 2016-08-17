<?php
/**
 * Autoloader for Simple Taxonomy Search WordPress plugin.
 *
 * @since 1.0.0
 * @package Simple_Taxonomy_Search
 */

spl_autoload_register( 'sts_autoloader' );
/**
 * Autoload plugin classes.
 *
 * Callback for spl_autoload_register().
 *
 * @see http://php.net/manual/en/function.spl-autoload-register.php
 *
 * @since 1.0.0
 *
 * @param  string $class The class name.
 * @return void
 */
function sts_autoloader( $class ) {

    $classes = array(
        'Simple_Taxonomy_Search' => 'class.simple-taxonomy-search.php',
    );

    if ( isset( $classes[ $class ] ) ) {

        $path = sprintf( '%s/classes/%s', STS_DIR, $classes[ $class ] );

        include( $path );

    }

}
