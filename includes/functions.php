<?php
/**
 * Global functions for Simple Taxonomy Search WordPress plugin.
 *
 * @since 1.0.0
 * @package Simple_Taxonomy_Search
 */

/**
 * Get the global Simple_Taxonomy_Search object.
 *
 * If the object does not exist, one will be created.
 *
 * @since 1.0.0
 *
 * @return Simple_Taxonomy_Search The current gobal Simple_Taxonomy_Search object.
 */
function sts() {

    if ( ! isset( $GLOBALS['sts'] ) ) {

        $GLOBALS['sts'] = new Simple_Taxonomy_Search();
        $GLOBALS['sts']->append_callbacks();

    }

    return $GLOBALS['sts'];

}
