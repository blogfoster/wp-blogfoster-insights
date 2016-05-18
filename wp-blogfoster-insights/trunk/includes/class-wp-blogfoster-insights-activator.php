<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.blogfoster.com/
 * @since      1.0.0
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/includes
 */
class Blogfoster_Insights_Activator {

  /**
   * Short Description. (use period)
   *
   * Long Description.
   *
   * @since    1.0.0
   */
  public static function activate() {

    // store the flag into the db to trigger the display of a message after activation
    set_transient( 'wp-blogfoster-insights-show-message', '1', 60 );

  }

}
