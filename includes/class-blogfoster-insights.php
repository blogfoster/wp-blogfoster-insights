<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.blogfoster.com/
 * @since      1.0.0
 *
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Blogfoster_Insights
 * @subpackage Blogfoster_Insights/includes
 */
class Blogfoster_Insights {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Blogfoster_Insights_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

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
   * The slug of the plugin's settings in the WP options table
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $settings_db_slug    The options slug n of the plugin.
   */
  private $settings_db_slug;

  /**
   * The settings of the plugin as stored in the WP options table, else default settings.
   *
   * @since    1.0.0
   * @access   private
   * @var      array    $plugin_settings    The settings of the plugin as stored in the WP options table, else default settings.
   */
  private $plugin_settings;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {

    $this->plugin_name = 'blogfoster Insights';
    $this->plugin_slug = 'blogfoster-insights';
    $this->plugin_version = '1.0.0';
    $this->settings_db_slug = $this->plugin_slug . '-options';
    $this->plugin_settings = $this->get_plugin_settings();

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();

  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Blogfoster_Insights_Loader. Orchestrates the hooks of the plugin.
   * - Blogfoster_Insights_i18n. Defines internationalization functionality.
   * - Blogfoster_Insights_Admin. Defines all hooks for the admin area.
   * - Blogfoster_Insights_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {

    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-blogfoster-insights-loader.php';

    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-blogfoster-insights-i18n.php';

    /**
     * The class responsible for defining all actions that occur in the admin area.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-blogfoster-insights-admin.php';

    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-blogfoster-insights-public.php';

    $this->loader = new Blogfoster_Insights_Loader();

  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Blogfoster_Insights_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function set_locale() {

    $plugin_i18n = new Blogfoster_Insights_i18n();
    $plugin_i18n->set_domain( $this->get_plugin_slug() );

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks() {

    $plugin_admin = new Blogfoster_Insights_Admin( $this->get_plugin_name(), $this->get_plugin_slug(), $this->get_plugin_version(), $this->get_settings_db_slug(), $this->get_plugin_settings() );

    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    // Add the options page and menu item.
    $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

    // Add an action link pointing to the options page.
    $plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . 'blogfoster-insights.php' );
    $this->loader->add_action( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

    // define the options
    $this->loader->add_action( 'admin_init', $plugin_admin, 'register_options' );

    // hook on displaying a message after plugin activation
    // if single activation via link or multisite activation
    if ( isset( $_GET[ 'activate' ] ) or isset( $_GET[ 'activate-multi' ] ) ) {
      $plugin_was_activated = get_transient( 'blogfoster-insights-show-message' );
      if ( false !== $plugin_was_activated ) {
        $this->loader->add_action( 'admin_notices', $plugin_admin, 'display_activation_message' );
        delete_transient( 'blogfoster-insights-show-message' );
      }
    }
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks() {

    $plugin_public = new Blogfoster_Insights_Public( $this->get_plugin_name(), $this->get_plugin_slug(), $this->get_plugin_version(), $this->get_plugin_settings() );

    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'print_insights_snippet' );

  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The slug of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The slug of the plugin.
   */
  public function get_plugin_slug() {
    return $this->plugin_slug;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Blogfoster_Tt_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_plugin_version() {
    return $this->plugin_version;
  }

  /**
   * Return the options slug in the WP options table.
   *
   * @since     1.0.0
   *
   * @return    Plugin slug variable.
   */
  public function get_settings_db_slug() {
    return $this->settings_db_slug;
  }

  /**
   * Get current or default settings
   *
   * @since    2.0
   */
  public function get_plugin_settings() {

    // try to load current settings. If they are not in the DB return set default settings
    $settings = get_option( $this->settings_db_slug, false );
    // if empty array set and store default values
    if ( false === $settings ) {
      // store default values in the db as a single and serialized entry
      add_option(
        $this->settings_db_slug,
        array(
          'website_id' => '',
        )
      );
    }
    // try to load current settings again. Now there should be the data
    $settings = get_option( $this->settings_db_slug );

    // return settings
    return $settings;
  }

}
