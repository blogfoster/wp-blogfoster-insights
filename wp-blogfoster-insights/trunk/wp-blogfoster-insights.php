<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.blogfoster.com/
 * @since             1.0.0
 * @package           Blogfoster_Insights
 *
 * @wordpress-plugin
 * Plugin Name:       blogfoster Insights
 * Plugin URI:        https://github.com/blogfoster/wp-blogfoster-insights
 * Description:       Integrate blogfoster Insights into your WordPress blog.
 * Version:           1.0.2
 * Author:            blogfoster
 * Author URI:        http://www.blogfoster.com/
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       wp-blogfoster-insights
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/wp-class-blogfoster-insights-activator.php
 */
function activate_blogfoster_insights() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-blogfoster-insights-activator.php';
  Blogfoster_Insights_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-blogfoster-insights-deactivator.php
 */
function deactivate_blogfoster_insights() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-blogfoster-insights-deactivator.php';
  Blogfoster_Insights_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blogfoster_insights' );
register_deactivation_hook( __FILE__, 'deactivate_blogfoster_insights' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-blogfoster-insights.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blogfoster_insights() {

  $plugin = new Blogfoster_Insights();
  $plugin->run();

}

run_blogfoster_insights();
