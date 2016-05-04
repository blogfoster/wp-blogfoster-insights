<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.blogfoster.com/
 * @since      1.0.0
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/public
 */
class Blogfoster_Insights_Public {

  /**
   * The name of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The name of this plugin.
   */
  private $plugin_name;

  /**
   * The slug of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_slug    The slug of this plugin.
   */
  private $plugin_slug;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $plugin_version;

  /**
   * The settings of the plugin as stored in the WP options table, else default settings.
   *
   * @since    1.0.0
   * @access   private
   * @var      array    $plugin_settings    The settings of the plugin
   */
  private $plugin_settings;


  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $name, $slug, $version, $settings ) {

    $this->plugin_name = $name;
    $this->plugin_slug = $slug;
    $this->plugin_version = $version;
    $this->plugin_settings = $settings;

  }

  /**
   * Print the traffic tracker snippet with the stored website ID
   *
   * @since    1.0.0
   */
  public function print_insights_snippet () {
    $id = absint( $this->plugin_settings[ 'website_id' ] );
    if ( !$id ) {
      return;
    }

    $snippet = '
      <script type="text/javascript">
        (function(window, document){
          window._blogfoster=window._blogfoster || {};
          window._blogfoster.insights=window._blogfoster.insights || {};
          window._blogfoster.insights.websiteId=%d;
          var t="https://insights.blogfoster.com/v1/" + window._blogfoster.insights.websiteId + ".js";
          var e=document, s=e.createElement("script"), a=e.getElementsByTagName("script")[0];
          s.type="text/javascript"; s.defer=true; s.async=true; s.src=t; a.parentNode.insertBefore(s,a);
        })(window, document);
      </script>
      <noscript>
        <p><img src="https://insights.blogfoster.com/v1/931.png" style="border:0;" alt="" /></p>
      </noscript>
    ';

    printf($snippet, $id, $id);
  }
}
