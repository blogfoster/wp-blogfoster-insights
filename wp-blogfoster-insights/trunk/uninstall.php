<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://www.blogfoster.com/
 * @since      1.0.0
 *
 * @package    Blogfoster_Insights
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}

/**
* Delete options from the database while deleting the plugin files
* Run before deleting the plugin
*
* @since   1.0.0
*/
// remove settings
if ( is_multisite() ) {

  $sites = wp_get_sites();

  if ( empty ( $sites ) ) return;

  foreach ( $sites as $site ) {
    // switch to next blog
    switch_to_blog( $site[ 'blog_id' ] );
    // remove settings
    delete_option( 'wp-blogfoster-insights-options' );
  }
  // restore the current blog, after calling switch_to_blog()
  restore_current_blog();
} else {
  // remove settings
  delete_option( 'wp-blogfoster-insights-options' );
}
