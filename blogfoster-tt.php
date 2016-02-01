<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.webaccessibility.de/
 * @since             1.0.0
 * @package           Blogfoster_Tt
 *
 * @wordpress-plugin
 * Plugin Name:       blogfoster Traffic Tracker
 * Plugin URI:        http://www.blogfoster.com/
 * Description:       For blogfoster affiliates: Let count your page views for blogfoster easily.
 * Version:           1.0.0
 * Author:            Martin Stehle
 * Author URI:        http://www.webaccessibility.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blogfoster-tt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blogfoster-tt-activator.php
 */
function activate_blogfoster_tt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blogfoster-tt-activator.php';
	Blogfoster_Tt_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blogfoster-tt-deactivator.php
 */
function deactivate_blogfoster_tt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-blogfoster-tt-deactivator.php';
	Blogfoster_Tt_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_blogfoster_tt' );
register_deactivation_hook( __FILE__, 'deactivate_blogfoster_tt' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-blogfoster-tt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blogfoster_tt() {

	$plugin = new Blogfoster_Tt();
	$plugin->run();

}
run_blogfoster_tt();
