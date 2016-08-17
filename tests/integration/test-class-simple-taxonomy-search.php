<?php
/**
 * Simple_Taxonomy_Search class tests for Simple Taxonomy Search WordPress plugin.
 *
 * @package Simple_Taxonomy_Search
 */

class Class_Simple_Taxonomy_Search_Test extends WP_UnitTestCase {

    /**
     * @covers Simple_Taxonomy_Search::append_callbacks()
     */
    public function test_append_callbacks() {

        global $wp_filter;

        $sts = new Simple_Taxonomy_Search();
        $sts->append_callbacks();

        $posts_join_tag = _wp_filter_build_unique_id( 'posts_join', array( $sts, 'posts_join' ), 10 );
        $this->assertarrayHasKey( $posts_join_tag, $wp_filter['posts_join'][10] );

        $posts_where_tag = _wp_filter_build_unique_id( 'posts_where', array( $sts, 'posts_where' ), 10 );
        $this->assertarrayHasKey( $posts_where_tag, $wp_filter['posts_where'][10] );

        $posts_groupby_tag = _wp_filter_build_unique_id( 'posts_groupby', array( $sts, 'posts_groupby' ), 10 );
        $this->assertarrayHasKey( $posts_groupby_tag, $wp_filter['posts_groupby'][10] );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_join()
     */
    public function test_posts_join() {

        global $wp_query, $wp_the_query, $wpdb;

        //* will set is_main_query() to true
        $wp_the_query = $wp_query;

        //* will set is_search() to true
        $wp_the_query->is_search = true;

        $sts      = new Simple_Taxonomy_Search();
        $join     = '';
        $expected = "
                LEFT JOIN
                (
                    `{$wpdb->term_relationships}`
                    INNER JOIN
                        `{$wpdb->term_taxonomy}` ON `{$wpdb->term_taxonomy}`.term_taxonomy_id = `{$wpdb->term_relationships}`.term_taxonomy_id
                    INNER JOIN
                        `{$wpdb->terms}` ON `{$wpdb->terms}`.term_id = `{$wpdb->term_taxonomy}`.term_id
                )
                ON `{$wpdb->posts}`.ID = `{$wpdb->term_relationships}`.object_id ";

        $join = $sts->posts_join( $join, $wp_the_query );

        $this->assertEquals( $expected, $join );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_join()
     */
    public function test_posts_join_not_is_main_query() {

        global $wp_the_query;

        //* will set is_search() to true
        $wp_the_query->is_search = true;

        $sts  = new Simple_Taxonomy_Search();
        $join = '';

        $join = $sts->posts_join( $join, $wp_the_query );

        $this->assertEquals( '', $join );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_join()
     */
    public function test_posts_join_not_is_search() {

        global $wp_query, $wp_the_query;

        $wp_the_query = $wp_query;

        $sts  = new Simple_Taxonomy_Search();
        $join = '';

        $join = $sts->posts_join( $join, $wp_the_query );

        $this->assertEquals( '', $join );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_join()
     */
    public function test_posts_join_not_is_search_not_is_main_query() {

        global $wp_the_query;

        $sts  = new Simple_Taxonomy_Search();
        $join = '';

        $join = $sts->posts_join( $join, $wp_the_query );

        $this->assertEquals( '', $join );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_where()
     */
    public function test_posts_where() {

        global $wp_query, $wp_the_query, $wpdb;

        $wp_the_query = $wp_query;
        $wp_the_query->is_search = true;
        $wp_the_query->query_vars['s'] = 'sample';

        $sts        = new Simple_Taxonomy_Search();
        $where      = '';
        $expected   = " OR (
                            `{$wpdb->term_taxonomy}`.taxonomy IN( 'category', 'post_tag' )
                            AND
                            `{$wpdb->terms}`.name LIKE '%" . esc_sql( get_query_var( 's' ) ) . "%'
                        )";

        $where = $sts->posts_where( $where, $wp_the_query );

        $this->assertEquals( $expected, $where );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_where()
     */
    public function test_posts_where_not_is_main_query() {

        global $wp_the_query;

        $wp_the_query->is_search = true;
        $wp_the_query->query_vars['s'] = 'sample';

        $sts      = new Simple_Taxonomy_Search();
        $where    = '';
        $expected = '';

        $where = $sts->posts_where( $where, $wp_the_query );

        $this->assertEquals( $expected, $where );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_where()
     */
    public function test_posts_where_not_is_search() {

        global $wp_query, $wp_the_query;

        $wp_the_query = $wp_query;

        $sts      = new Simple_Taxonomy_Search();
        $where    = '';
        $expected = '';

        $where = $sts->posts_where( $where, $wp_the_query );

        $this->assertEquals( $expected, $where );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_where()
     */
    public function test_posts_where_not_is_main_query_not_is_search() {

        global $wp_the_query;

        $sts      = new Simple_Taxonomy_Search();
        $where    = '';
        $expected = '';

        $where = $sts->posts_where( $where, $wp_the_query );

        $this->assertEquals( $expected, $where );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_groupby()
     */
    public function test_posts_groupby() {

        global $wp_query, $wp_the_query, $wpdb;

        $wp_the_query = $wp_query;
        $wp_the_query->is_search = true;
        $wp_the_query->query_vars['s'] = 'sample';

        $sts      = new Simple_Taxonomy_Search();
        $groupby  = '';
        $expected = "`{$wpdb->posts}`.ID";

        $groupby = $sts->posts_groupby( $groupby, $wp_the_query );

        $this->assertEquals( $expected, $groupby );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_groupby()
     */
    public function test_posts_groupby_not_is_main_query() {

        global $wp_the_query;

        $wp_the_query->is_search = true;
        $wp_the_query->query_vars['s'] = 'sample';

        $sts      = new Simple_Taxonomy_Search();
        $groupby  = '';
        $expected = '';

        $groupby = $sts->posts_groupby( $groupby, $wp_the_query );

        $this->assertEquals( $expected, $groupby );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_groupby()
     */
    public function test_posts_groupby_not_is_search() {

        global $wp_query, $wp_the_query;

        $wp_the_query = $wp_query;

        $sts      = new Simple_Taxonomy_Search();
        $groupby  = '';
        $expected = '';

        $groupby = $sts->posts_groupby( $groupby, $wp_the_query );

        $this->assertEquals( $expected, $groupby );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_groupby()
     */
    public function test_posts_groupby_not_is_main_query_and_not_is_search() {

        global $wp_the_query;

        $sts      = new Simple_Taxonomy_Search();
        $groupby  = '';
        $expected = '';

        $groupby = $sts->posts_groupby( $groupby, $wp_the_query );

        $this->assertEquals( $expected, $groupby );

    }

    /**
     * @covers Simple_Taxonomy_Search::posts_where_taxonomies()
     */
    public function test_posts_where_taxonomies() {

        $sts = new Simple_Taxonomy_Search();

        $this->assertEquals( array( "'category'", "'post_tag'" ), $sts->posts_where_taxonomies() );

    }

}
